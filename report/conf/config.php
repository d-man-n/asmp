<?
date_default_timezone_set('Europe/Moscow');
$date=date("Y-m-d");
$time=date("H:i:s");
$fileslist_dir="files/fileslist/";
$zayavka_dir="files/zayavka/";
//Connect to  MySQL
$dbhost = "localhost";
$dbusername = "root";
$dbpass = "b43b82";
$dbname = "nsra";
$db_pref="sp";
mysql_connect($dbhost,$dbusername,$dbpass) or die("Dont connect to server");
mysql_select_db($dbname) or die ("Dont connect to bd");
mysql_query("SET character_set_results='utf8';");
mysql_query("SET character_set_client='utf8';");
mysql_query("SET character_set_connection='utf8';");

?>

