<?php
include "../db/conf.php";     

mysql_connect($dbhost,$dbuser,$dbpass) or die("Dont connect to server");
mysql_select_db($dbname) or die ("Dont connect to bd");
mysql_query("SET character_set_results='utf8';");
mysql_query("SET character_set_client='utf8';");
mysql_query("SET character_set_connection='utf8';");

$db=$_GET['db'];
$itemsArray = array_reverse(explode(',', $_GET['items']));

for($item = 1; $item <= count($itemsArray); $item++) 
    {
    $aaa=count($itemsArray)-$item+1;
    $sql = "UPDATE ".$db." SET num=" . $aaa . " WHERE id=" . $itemsArray[$item-1] . " LIMIT 1";
    mysql_query($sql) or die('Перемещение не выполнено');
    }
echo 'Порядок был успешно изменен.';
   
?>
