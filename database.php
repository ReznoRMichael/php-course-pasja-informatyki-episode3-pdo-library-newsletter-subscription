<?php

$config = require_once 'config.php'; // nazwanie tablicy zaimportowanej z pliku config.php przy pomocy return

try
{
	// tworzenie nowego obiektu klasy PDO (new) z 4 argumentami inicjalizującymi
	$db = new PDO("mysql:host={$config['host']};dbname={$config['database']};charset=utf8", $config['user'], $config['password'], [
		PDO::ATTR_EMULATE_PREPARES => false, // czy zapytania MySQL maja byc przygotowane na serwerze czy w bibliotece PDO; false = serwer MySQL
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		] );
}
catch(PDOException $error)
{
	//echo $error;
	echo $error -> GetMessage();
	exit('<br>Database error');
}
