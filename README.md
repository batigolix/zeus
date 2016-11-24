# zeus
Sub theme for DGConnect websites

See also DAE-1849

#Add Zeus to project

Note: ensure you do not have duplicates of the zeus theme in different places in your project. This confuses the hell out of Drupal.

## Via make file

`projects[zeus][type] = "theme"
projects[zeus][download][type] = "git"
projects[zeus][download][url] = https://github.com/batigolix/zeus.git
projects[zeus][branch] = "master"
`

## Git clone

Clone the theme in a theme folder (e.g. lib/themes)

`
git clone https://github.com/batigolix/zeus.git
`
## Phing command

For priviliged people there is a phing command available in the digital-agenda-dev project

`./bin/phing clone-zeus'
