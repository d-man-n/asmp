<?php
session_start();
require_once('../db/Mysql.php');
require_once('../db/Mysql/Exception.php');
require_once('../db/Mysql/Statement.php');
require_once('../db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
                      ->setDatabaseName($dbname);
                      
$a=date("YmdHis");
                      
$targetFolder =  $_GET['uploaddir'];
$tempFile = $_FILES['uploadfile']['tmp_name'];
$name_file=$a."-".rand(100,999).".".pathinfo($_FILES["uploadfile"]["name"], PATHINFO_EXTENSION);

$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
$targetFile = rtrim($targetPath,'/') . '/' .$name_file;
        
        
 
if (move_uploaded_file($tempFile,$targetFile)) 
    { 
    if ($_SESSION['tmp']==1)
        {
        $data_document=array('REQ_ID'=>$_GET['req_id'], 'ID_DOC_TYPE'=>0, 'URI'=>$name_file, 'TS_CREATED'=>date("Y-m-d H:i:s"), 'TS_UPDATED'=>date("Y-m-d H:i:s"), 'TS_DELETED'=>date("Y-m-d H:i:s"), 'IS_DELETED'=>'0');
        $db->query("INSERT INTO `DOCUMENT_TMP` SET ?As", $data_document);
        }
    else
	{
        $data_document=array('ID_DOC_TYPE'=>0, 'URI'=>$name_file, 'TS_CREATED'=>date("Y-m-d H:i:s"), 'TS_UPDATED'=>date("Y-m-d H:i:s"), 'TS_DELETED'=>date("Y-m-d H:i:s"), 'IS_DELETED'=>'0');
        $db->query("INSERT INTO `DOCUMENT` SET ?As", $data_document);
        $new_doc_id=$db->getLastInsertId();
        $data_lnk_document=array('ID_REQUEST'=>$_SESSION['req_id'], 'ID_DOCUMENT'=>$new_doc_id, 'TS_CREATED'=>date("Y-m-d H:i:s"), 'TS_UPDATED'=>date("Y-m-d H:i:s"), 'TS_DELETED'=>date("Y-m-d H:i:s"), 'IS_DELETED'=>'0');
        $db->query("INSERT INTO `LNK_DOC_REQUEST` SET ?As", $data_lnk_document);
        }
    } 
else {
    echo "error";
}
?>