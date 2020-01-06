
    git clone https://github.com/funkedigital/fdl-magazine /var/www/
    cd /var/www/fdl-magazine
    npm i
    gulp
    cp -R /var/www/fdl-magazine/ /var/www/publisher/src/SWP/Bundle/FixturesBundle/Resources/themes/fdl-magazine/
    cd /var/www/publisher/etc/docker
    sudo docker-compose exec php php bin/console swp:theme:install sxl34v src/SWP/Bundle/FixturesBundle/Resources/themes/fdl-magazine/ -f --activate
    echo "flush_all\nquit\n" | nc localhost 11211
    cd /var/www/publisher