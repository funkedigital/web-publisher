#!/bin/sh
# Easy Install SWP Theme
# Use:
# ./install-theme -b FEATURE-BRANCH -t TENANTID -g https://github.com/SuperdeskWebPublisher/theme-dailyNews/
#
# without params default values are used.

# default values
BRANCH="vrt-wmn"
TENANT="b94k0f"
GIT="https://github.com/funkedigital/fdl-magazine"

# grab the options
while getopts b:g:t: option; do
  case "${option}" in

  b) BRANCH=${OPTARG} ;;
  g) GIT=${OPTARG} ;;
  t) TENANT=${OPTARG} ;;
  esac
done

#

printf '\n\n\nStarting install theme for tenant: %s with branch: %s\n\n' "$TENANT" "$BRANCH"

# check for npm
if [ ! $(command -v npm) ]; then
  printf "Installing npm...\n"
  apk add npm
else
  printf "Found npm...\n"
fi

echo "Removing old theme checkout folder."
rm -rf fdl-magazine

git clone "$GIT" &&
  cd fdl-magazine/ &&
  git checkout "$BRANCH"

npm install -g gulp &&
  npm i &&
  gulp &&
  cd ..

printf "Removing old theme resource in SWP.\n"
rm -rf src/SWP/Bundle/FixturesBundle/Resources/themes/fdl-magazine/

printf "Copy new build theme to SWP resources.\n"
cp -R fdl-magazine/ src/SWP/Bundle/FixturesBundle/Resources/themes/fdl-magazine

printf "Installing and activating new build theme for tenant %s\n\n\nPLEASE BE PATIENT, IT TAKES A WHILE!\nStarted at %s" "$TENANT" "$(date)"
cd /var/www/publisher && php bin/console swp:theme:install "$TENANT" src/SWP/Bundle/FixturesBundle/Resources/themes/fdl-magazine/ -f --activate
