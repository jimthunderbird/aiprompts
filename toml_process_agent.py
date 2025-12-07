#!/usr/bin/env python3
import sys
import re
from pathlib import Path
import toml


def recursive_merge(base, update):
    """Recursively merge update dict into base dict"""
    for key, value in update.items():
        if key in base and isinstance(base[key], dict) and isinstance(value, dict):
            recursive_merge(base[key], value)
        else:
            base[key] = value
    return base


def process_includes(content, base_path):
    """Process @include directives and merge TOML files"""
    lines = content.split('\n')
    include_pattern = re.compile(r'^\s*@include\s+(.+\.toml)\s*$')
    
    merged_content = {}
    current_lines = []
    
    for line in lines:
        match = include_pattern.match(line)
        if match:
            # Parse accumulated lines before this include
            if current_lines:
                current_toml = toml.loads('\n'.join(current_lines))
                merged_content = recursive_merge(merged_content, current_toml)
                current_lines = []
            
            # Process included file
            include_file = match.group(1).strip()
            include_path = base_path / include_file
            
            if include_path.exists():
                included_content = include_path.read_text()
                # Recursively process includes in included file
                included_data = process_includes(included_content, include_path.parent)
                merged_content = recursive_merge(merged_content, included_data)
        else:
            current_lines.append(line)
    
    # Parse remaining lines
    if current_lines:
        current_toml = toml.loads('\n'.join(current_lines))
        merged_content = recursive_merge(merged_content, current_toml)
    
    return merged_content


def main():
    if len(sys.argv) != 2:
        print("Error: Expected exactly one command-line argument", file=sys.stderr)
        sys.exit(1)
    
    cli_arg = sys.argv[1]
    
    if not cli_arg.strip():
        print("Error: Argument cannot be empty", file=sys.stderr)
        sys.exit(1)
    
    toml_file = Path(cli_arg)
    
    if not toml_file.exists():
        print(f"Error: File '{cli_arg}' does not exist", file=sys.stderr)
        sys.exit(1)
    
    content = toml_file.read_text()
    base_path = toml_file.parent if toml_file.parent != Path('.') else Path.cwd()
    
    toml_content = process_includes(content, base_path)
    
    print(toml.dumps(toml_content))


if __name__ == "__main__":
    main()
