# How to contribute

Thanks for contributing to assert! Just follow these single guidelines:

- You must use [feature / topic branches](https://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows) to ease the merge of contributions.
- Coding standard compliance must be ensured before committing or opening pull requests by running `composer assert:cs-fix` or `composer assert:cs-lint` in the root directory of this repository.
- After adding new assertions regenerate the [README.md](README.md) and the docblocks by running `composer assert:generate-docs` on the command line.
- After adding new non release relevant artifacts you must ensure they are export ignored in the [.gitattributes](.gitattributes) file.

