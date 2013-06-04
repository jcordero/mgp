#!/bin/bash

export PLATAFORMA_HOME=/plataforma4
export PLATAFORMA_INC=.:$PLATAFORMA_HOME/includes:/plataforma4_sites/mgp/www/includes
export PHP_INI=/etc/php5/apache2/php.ini

# Proceso de eventos
/usr/bin/php -c $PHP_INI -d include_path=$PLATAFORMA_INC -f /plataforma4_sites/mgp/maint/event_bus.php

# Envio de mails
/usr/bin/php -c $PHP_INI -d include_path=$PLATAFORMA_INC -f /plataforma4/modules/messaging/email_process.php

