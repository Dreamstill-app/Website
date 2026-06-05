# AGENTS.md

Guidance for AI agents working in this repository.

## Repository overview

This is a minimal placeholder repository. The only tracked project file is `Read-me-lol` (contents: `lol`). There is no application source, package manifest, container stack, or test suite.

## Development commands

There are no project-specific install, lint, test, or run scripts. Standard git and shell tooling are sufficient.

| Task | Command | Notes |
|------|---------|--------|
| View project content | `cat Read-me-lol` | Sole artifact |
| Git status | `git status` | Normal git workflow |

## Cursor Cloud specific instructions

- **Dependencies:** None. The VM update script is a no-op (`true`).
- **Services:** Nothing to start. No databases, APIs, or dev servers are defined in this repo.
- **Lint / test / build:** Not applicable until real code and tooling are added.
- **Hello-world check:** Run `cat Read-me-lol` and confirm output is `lol`. That validates checkout and file access for this stub.
- **Future work:** When adding an app, update this section with real install commands, required services, and how to run lint/tests/dev servers. Keep the update script limited to dependency refresh only (e.g. `npm install`, `uv sync`).
