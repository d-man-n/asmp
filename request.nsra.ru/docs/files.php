<?php
session_start();
require_once('../db/Mysql.php');
require_once('../db/Mysql/Exception.php');
require_once('../db/Mysql/Statement.php');
require_once('../db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);
         
if ($_SESSION['tmp']==1){$tdb="_TMP"; $tdir="_tmp";}
else {$tdb=""; $tdir="";}
    
if ($_GET['event']=="savesel")
    {
    if ($db->query("UPDATE `DOCUMENT".$tdb."` SET `ID_DOC_TYPE`='?i' WHERE `ID`='?i'",$_GET['type_id'], $_GET['id'])){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}
    }
    
elseif ($_GET['event']=="delFile")
    {
    echo $_SESSION['tmp'];
    $result=$db->query("SELECT * FROM `DOCUMENT".$tdb."` WHERE `ID`='?i'", $_GET['id']);
    $data=$result->fetch_assoc();
    if ($data['URI']!=""){unlink("../files".$tdir."/".$data['URI']);}
    if ($db->query("DELETE FROM `DOCUMENT".$tdb."` WHERE `ID`='?i'",$_GET['id'])){echo "<b><font style=\"color: #".rand(100000,999999).";\">Удалено</font></b>";}
    if ($_SESSION['tmp']==0){$db->query("DELETE FROM `ID_DOC_REQUEST` WHERE `ID_DOCUMENT`='?i'",$_GET['id']);}
    }
else
    {
    if ($_SESSION['tmp']==1){$result=$db->query("SELECT MAX(ID) AS MID FROM `DOCUMENT_TMP` WHERE REQ_ID='?i'", $_GET['id']);}
    else{$result=$db->query("SELECT MAX(`DOCUMENT`.`ID`) AS MID  FROM `DOCUMENT`
                            LEFT JOIN `LNK_DOC_REQUEST` ON `LNK_DOC_REQUEST`.`ID_DOCUMENT`=`DOCUMENT`.`ID` WHERE `LNK_DOC_REQUEST`.`ID_REQUEST`='?i'", $_GET['id']);}
    $data=$result->fetch_assoc();
    $db->query("UPDATE `DOCUMENT".$tdb."` SET `ID_DOC_TYPE`='?i' WHERE `ID`='?i'", $_GET['type_id'], $data['MID']);

if ($_SESSION['tmp']==1){$result=$db->query("SELECT * FROM `DOCUMENT_TMP` WHERE REQ_ID='?i%'", $_GET['id']);}
else {$result=$db->query("SELECT `DOCUMENT`.`ID` AS ID, `DOCUMENT`.`ID_DOC_TYPE` AS ID_DOC_TYPE, `DOCUMENT`.`URI` AS URI  FROM `DOCUMENT`
                            LEFT JOIN `LNK_DOC_REQUEST` ON `LNK_DOC_REQUEST`.`ID_DOCUMENT`=`DOCUMENT`.`ID` WHERE `LNK_DOC_REQUEST`.`ID_REQUEST`='?i'", $_GET['id']);}
echo "<ul style=\"list-style: none;\">";
while ($data=$result->fetch_assoc())
    {
    echo "<li style=\"margin: 5px;\" id=\"".$data['ID']."\">
            <SELECT style=\"width: 300px;\" onChange=\"saveSel(".$data['ID'].",this.value);\">
                <OPTION value=0>Не выбран";
    $result_type=$db->query("SELECT * FROM `DIC_DOC_TYPE`");
    while ($data_type=$result_type->fetch_assoc())
        {
        if ($data_type['ID']==$data['ID_DOC_TYPE']){$selected=" SELECTED ";}
        else {$selected="";}
        echo "<OPTION value=\"".$data_type['ID']."\"".$selected.">".$data_type['NAME_RUS'];
        }
    echo "</SELECT>&nbsp;&nbsp;&nbsp;".$data['URI']."&nbsp;&nbsp;&nbsp;
            <button onclick=\"delFile(this, ".$data['ID'].");\">&times;</button></li>";
    }
echo "</ul>";

    
    
    
    }
?>