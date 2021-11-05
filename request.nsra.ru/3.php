<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
require_once('db/Mysql.php');
require_once('db/Mysql/Exception.php');
require_once('db/Mysql/Statement.php');
require_once('db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);

$query=$db->query("SELECT ID, NAME_RUS, NAME_ENG FROM COMPANY");
while ($row=$query->fetch_assoc())
    {
    echo $row['NAME_RUS']."<br>";
//    $db->query("UPDATE COMPANY SET NAME_RUS='?s', NAME_ENG='?s' WHERE ID='?i'", str_replace("\"\"", "\"", $row['NAME_RUS']), str_replace("\"\"", "\"", $row['NAME_ENG']), $row['ID']);
    }
?>
