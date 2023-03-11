#############################
### Environment variables ###
#############################

# add project vendor/bin to PATH
export PATH=$PATH:$PROJECT_PATH/vendor/bin

###############
### Aliases ###
###############

# list directory contents with colors and sorted
alias ls='ls -la --color=auto --group-directories-first'

#################
### Functions ###
#################

# design
bold=$(tput bold)
red=${bold}$(tput setaf 1)
green=${bold}$(tput setaf 2)
blue=${bold}$(tput setaf 4)
reset=$(tput sgr0)

# Toggle Xdebug for CLI
function xdebug_cli_toggle() {
    if [[ -z "$XDEBUG_TRIGGER" ]]; then
      export XDEBUG_TRIGGER=1
      echo "${green}Xdebug CLI has been activated!${reset}"
    else
      unset XDEBUG_TRIGGER
      echo "${red}Xdebug CLI has been deactivated!${reset}"
    fi
}
