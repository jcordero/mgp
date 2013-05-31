#!/bin/bash

# Envio de mails
/opt/local/bin/php -dinclude_path=.:/Users/jcordero/plataforma4/Plataforma4/includes:/Users/jcordero/plataforma4_sites/mgp_git/mgp/www/includes -f /Users/jcordero/plataforma4/Plataforma4/modules/messaging/email_process.php
