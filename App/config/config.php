<?php
session_start();
// url
define('BASEURL','http://localhost/Presensi-Online/public/');


$app_path = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
$app_path = preg_replace('/config/', '', $app_path);
$app_path = preg_replace('/App\\\/', '', $app_path);
// define('APPPATH', $app_path[0]);
define('BASEPATH',"/".$app_path[0]."/");

// db
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'Lucver1092');
define('DBNAME', 'db_presensi_ppg');