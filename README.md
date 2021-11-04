# HRBS <!-- omit in toc -->
 Hotel Reservation and Billing System

- [GIT](#git)
  - [Allowed characters when naming branches](#allowed-characters-when-naming-branches)
  - [Merging types](#merging-types)
    - [Merge](#merge)
    - [Rebase](#rebase)
  - [Commit naming convention](#commit-naming-convention)
    - [keywords](#keywords)
      - [Example](#example)
- [Xampp Setup](#xampp-setup)
  - [Required extension to be enabled in php.ini](#required-extension-to-be-enabled-in-phpini)

# GIT

## Allowed characters when naming branches
    
    . _ (Pang branch file)
    / (pang branch directory) 

    bawal na naming ng branch

        existing branch:
            dev/admin

        new branch:
            dev/admin/rooms (Ekis 'to. Hindi papayagan ni git) 

## Merging types
### Merge
   - Do this when merging from a sub branch to a main/parent branch. example: <br><br>
   current branch: dev (This is the branch that author/dev is based on)<br>
   merge into current branch: author/dev <br><br>
### Rebase
   -  Do this when there are changes in the main/parent branch and you want to update the changes from the main/parent branch into yours. Example: <br>
   Example: <br><br>
   current branch: author/dev<br>
   (New commits by other author are made in branch "dev" so you need to update your current branch) <br>
   rebase current branch by using branch: dev <br><br>

## Commit naming convention

1. Separate the subject from the body with a blank line
2. Your commit message should not contain any whitespace errors
3. Remove unnecessary punctuation marks
4. Do not end the subject line with a period
5. Capitalize the subject line and each paragraph
6. Use the imperative mood in the subject line
7. Use the body to explain what changes you have made and why you made them.
8. Do not assume the reviewer understands what the original problem was, ensure you add it.
9. Do not think your code is self-explanatory
Follow the commit convention defined by your team

### keywords

- dev
    - when adding new functionalities (scripts, functions, etc.)
- build
    - Changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm)
- feat
    - The new feature you're adding to a particular application
    - new feature for the user
    - not a new feature for build script
- fix
    - A bug fix
    - bug fix for the user
    - not a fix to a build script
- style
    - Feature and updates related to styling
    - formatting, missing semi colons, etc
    - no production code change
- refractor
    - Refactoring a specific section of the codebase
    - refactoring production code
    - eg. renaming a variable
- test
    - Everything related to testing
    - adding missing tests
    - refactoring tests
    - no production code change
- docs
    - Everything related to documentation
- chore
    - Regular code maintenance [ You can also use emojis to represent commit types]
    - Updating grunt tasks etc; no production code change
    - e.g changes to .gitignore

#### Example
    style: dark mode

# Xampp Setup
## Required extension to be enabled in php.ini

    - gd    #This makes changing logo and page cover works. Need 'to para magresize mga image.
