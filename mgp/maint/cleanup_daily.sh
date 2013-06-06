#!/bin/bash
find /Users/jcordero/plataforma4_sites/mgp/temp/* -mtime +1 -exec rm {} \;
find /Users/jcordero/plataforma4_sites/mgp/www/temp/* -mtime +1 -exec rm {} \;
