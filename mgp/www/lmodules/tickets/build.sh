echo 'Compilo modulo...'
java -jar $PLATAFORMA/AyaxPHPClass.jar tickets.xml MYSQL
java -jar $PLATAFORMA/AyaxPHPClass.jar denuncias.xml MYSQL
java -jar $PLATAFORMA/AyaxPHPClass.jar reclamos.xml MYSQL
java -jar $PLATAFORMA/AyaxPHPClass.jar solicitudes.xml MYSQL
java -jar $PLATAFORMA/AyaxPHPClass.jar quejas.xml MYSQL

