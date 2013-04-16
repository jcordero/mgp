#!/bin/bash

export PLATAFORMA_HOME=/Users/jcordero/plataforma4/Plataforma4
export PLATAFORMA_INC=.:$PLATAFORMA_HOME/includes:/Users/jcordero/plataforma4_sites/mgp_git/mgp/www/includes
export PHP_INI=/opt/local/etc/php5/php.ini

/usr/bin/php -c $PHP_INI -d include_path=$PLATAFORMA_INC -f $PLATAFORMA_HOME/modules/messaging/email_process.php
