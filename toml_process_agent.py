import sys
import json
import tomllib
from pathlib import Path
from typing import Any, Dict


def recursive_merge(base: Dict[str, Any], update: Dict[str, Any]) -> Dict[str, Any]:
    result = base.copy()
    for key, value in update.items():
        if key in result and isinstance(result[key], dict) and isinstance(value, dict):
            result[key] = recursive_merge(result[key], value)
        else:
            result[key] = value
    return result


def process_toml(toml_path: Path) -> Dict[str, Any]:
    with open(toml_path, 'r') as f:
        content = f.read()
    
    lines = content.split('\n')
    includes = []
    filtered_lines = []
    
    for line in lines:
        stripped = line.strip()
        if stripped.startswith('@include '):
            include_file = stripped[9:].strip()
            includes.append(include_file)
        else:
            filtered_lines.append(line)
    
    base_content = '\n'.join(filtered_lines)
    toml_data = tomllib.loads(base_content)
    
    base_dir = toml_path.parent
    for include_file in includes:
        include_path = base_dir / include_file
        if include_path.exists():
            included_data = process_toml(include_path)
            toml_data = recursive_merge(toml_data, included_data)
    
    return toml_data


def main():
    if len(sys.argv) != 2:
        print("Error: Expected exactly one argument", file=sys.stderr)
        sys.exit(1)
    
    cli_arg = sys.argv[1]
    toml_file = Path(cli_arg)
    
    if not toml_file.exists():
        print(f"Error: File '{cli_arg}' does not exist", file=sys.stderr)
        sys.exit(1)
    
    toml_content = process_toml(toml_file)
    json_content = json.dumps(toml_content, indent=2)
    print(json_content)


if __name__ == "__main__":
    main()
