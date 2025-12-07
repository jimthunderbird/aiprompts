import sys
import tomllib
from pathlib import Path


def merge_toml_content(toml_file_path):
    """Read TOML file and merge any @include directives."""
    base_path = Path(toml_file_path).parent
    
    with open(toml_file_path, 'r') as f:
        lines = f.readlines()
    
    merged_lines = []
    for line in lines:
        stripped = line.strip()
        if stripped.startswith('@include '):
            include_file = stripped.split('@include ', 1)[1].strip()
            include_path = base_path / include_file
            
            if not include_path.exists():
                print(f"Error: Include file '{include_path}' not found", file=sys.stderr)
                sys.exit(1)
            
            with open(include_path, 'r') as inc_f:
                merged_lines.extend(inc_f.readlines())
        else:
            merged_lines.append(line)
    
    toml_content = ''.join(merged_lines)
    
    # Validate it's valid TOML
    try:
        tomllib.loads(toml_content)
    except tomllib.TOMLDecodeError as e:
        print(f"Error: Invalid TOML content: {e}", file=sys.stderr)
        sys.exit(1)
    
    return toml_content


def main():
    if len(sys.argv) != 2:
        print("Usage: script.py <toml_file>", file=sys.stderr)
        sys.exit(1)
    
    toml_file = Path(sys.argv[1])
    
    if not toml_file.exists():
        print(f"Error: File '{toml_file}' does not exist", file=sys.stderr)
        sys.exit(1)
    
    if not toml_file.is_file():
        print(f"Error: '{toml_file}' is not a file", file=sys.stderr)
        sys.exit(1)
    
    if toml_file.suffix.lower() != '.toml':
        print(f"Error: '{toml_file}' is not a TOML file", file=sys.stderr)
        sys.exit(1)
    
    toml_content = merge_toml_content(toml_file)
    print(toml_content)


if __name__ == '__main__':
    main()
