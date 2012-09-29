#!/bin/bash

GEN_PATH=D:/Toni/Dev/PHP/phpdao-2.6
PROJECT_PATH=C:/wamp/www/salao
SCRIPT=C:/wamp/www/salao/extras/script_criar_banco.sql

echo "Drop an create database 'salao'..."
mysql -u root <<EOF
	drop database if exists salao;
	create database salao;
EOF

echo "Run script sql..."
mysql -u root salao < $SCRIPT

cd $GEN_PATH
php generate.php
cp $GEN_PATH/generated/include_dao.php $PROJECT_PATH
rm -rf $PROJECT_PATH/class
cp -Rap $GEN_PATH/generated/class $PROJECT_PATH/class