<?php
//fill these 3 variables correctly to create database and tables just by running this php file.
 
 $server='localhost'; //normally localhost
 $user='mysql user'; // mysql user -- could be root or any user with necessary privileges to create DB
 $password ='mysql user password'; // well.. mysql user password.

 /*	or use the following sql code by yourself:
 A:CREATE DATABASE IF NOT EXISTS dblogin;
 -----------------------------------------------------------------------------------------------
 B:CREATE TABLE `dblogin`.`Usuarios` ( `user` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `password` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `privileges` INT NOT NULL , UNIQUE (`user`, `email`) ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
 */

//connecting to mysql
$mysqli = new mysqli($server,$user,$password);
//creating database and tables
if(!$mysqli->connect_errno){
	if(!$mysqli->select_db('dblogin')){
	$sql="CREATE DATABASE IF NOT EXISTS dblogin;";
	if($mysqli->query($sql)===true){
		echo "Database successfully created...";
		}else echo "Can't create database";
		$mysqli->select_db('dblogin');
	$sql="CREATE TABLE `dblogin`.`Usuarios` ( `user` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `password` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `privileges` INT NOT NULL , UNIQUE (`user`, `email`) ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
	if($mysqli->query($sql))
		echo '<br> ...and database tables created successfully! Installation complete!';
	else{echo '...error creating database tables';}
	}else{echo "Database already exists";}
}else{
	echo "Fail connecting to database";
}





?>