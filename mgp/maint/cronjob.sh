#!/bin/bash
export WWW_HOME=/Users/jcordero/plataforma4_sites/mgp_git/mgp
export PLATAFORMA_HOME=/Users/jcordero/plataforma4/Plataforma4
export PLATAFORMA_INC=.:$PLATAFORMA_HOME/includes:$WWW_HOME/www/includes

export PHP_INI=/opt/local/etc/php54/php.ini
#export PHP_INI=/etc/php5/apache2/php.ini

#echo "Proceso eventos"
/usr/bin/php -c $PHP_INI -d include_path=$PLATAFORMA_INC -f $WWW_HOME/maint/event_bus.php

echo "Envio de mails"
/usr/bin/php -c $PHP_INI -d include_path=$PLATAFORMA_INC -f $PLATAFORMA_HOME/modules/messaging/email_process.php

echo "Proceso terminado"
