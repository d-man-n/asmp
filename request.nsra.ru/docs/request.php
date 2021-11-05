<?
session_start();
require_once('../db/Mysql.php');
require_once('../db/Mysql/Exception.php');
require_once('../db/Mysql/Statement.php');
require_once('../db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);

if ($_GET['event']=="save")
    {
    if ($_SESSION['tmp']==1){if ($db->query("UPDATE `REQUEST_TMP` SET `".$_GET['field']."`='?s' WHERE `SESSION_ID`='?s'", $_GET['value'], session_id())){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}}
    else
	{
	if ($db->query("UPDATE `REQUEST` SET `".$_GET['field']."`='?s', `EDIT_SOL`=1 WHERE `ID`='?i'", $_GET['value'], $_SESSION['req_id'])){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}
	if ($_GET['field']=="SOLUTION")
	    {
    	    $result=$db->query("SELECT `ID` FROM `SOLUTION` WHERE `ID_REQUEST`='?i%'", $_SESSION['req_id']);
	    if ($result->getNumRows()>0)
		{
		$data=$result->fetch_assoc();
		$db->query("DELETE FROM `SOLUTION` WHERE `ID`='?i'", $data['ID']);
		$db->query("DELETE FROM `SOLUTION_ARTICLE` WHERE `ID_SOLUTION`='?i'", $data['ID']);
		$db->query("DELETE FROM `LNK_DOC_SOLUTION` WHERE `ID_SOLUTION`='?i'", $data['ID']);
		}
	    if ($_GET['value']>0)
		{
		$data_new_sol=array('ID_REQUEST'=>$_SESSION['req_id'],'SOLUTION_NUM'=>'','SOLUTION_DATE'=>date("Y-m-d"),'PERMITED_FROM'=>'0000-00-00','PERMITED_TO'=>'0000-00-00',
				    'ID_SIGNER_POST'=>0,'ID_SIGNER_PERSON'=>0,'ID_TYPE'=>0,'NAV_ROUTE_RUS'=>'','NAV_ROUTE_ENG'=>'',
				    'TS_CREATED'=>date("Y-m-d H:iS"),'TS_UPDATED'=>date("Y-m-d H:iS"),'TS_DELETED'=>date("Y-m-d H:iS"),'IS_DELETED'=>0);
		$db->query("INSERT INTO `SOLUTION` SET ?As", $data_new_sol);
		$new_sol_id=$db->getLastInsertId();
		$data_new_sol_art=array('ID_SOLUTION'=>$new_sol_id,'NUM'=>1,'TEXT_RUS'=>'','TEXT_ENG'=>'','TS_CREATED'=>date("Y-m-d H:iS"),'TS_UPDATED'=>date("Y-m-d H:iS"),'TS_DELETED'=>date("Y-m-d H:iS"),'IS_DELETED'=>0);
		$db->query("INSERT INTO `SOLUTION_ARTICLE` SET ?As", $data_new_sol_art);
		if ($_GET['value']!=3)
		    {
		    $data_new_sol_art=array('ID_SOLUTION'=>$new_sol_id,'NUM'=>2,'TEXT_RUS'=>'','TEXT_ENG'=>'','TS_CREATED'=>date("Y-m-d H:iS"),'TS_UPDATED'=>date("Y-m-d H:iS"),'TS_DELETED'=>date("Y-m-d H:iS"),'IS_DELETED'=>0);
		    $db->query("INSERT INTO `SOLUTION_ARTICLE` SET ?As", $data_new_sol_art);
		    }
		}
	    }
	}
    }

if ($_GET['event']=="sol_save")
    {
    $result=$db->query("SELECT `ID` FROM `SOLUTION` WHERE `ID_REQUEST`='?i%'", $_SESSION['req_id']);
    $data=$result->fetch_assoc();
    
    $db->query("UPDATE `REQUEST` SET `EDIT_SOL`=1 WHERE `ID`='?i'", $_SESSION['req_id']);
    
    if ($_GET['num']>0) {if ($db->query("UPDATE `".$_GET['table']."` SET `".$_GET['field']."`='?s' WHERE `ID_SOLUTION`='?i' AND NUM='?i'", $_GET['value'], $data['ID'], $_GET['num'])){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}}
    else{if ($db->query("UPDATE `".$_GET['table']."` SET `".$_GET['field']."`='?s' WHERE `ID`='?i'", $_GET['value'], $data['ID'])){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}}
    }

if ($_GET['event']=="iceCatInfo")
    {
    $result=$db->query("SELECT * FROM `DIC_ICE_CATEGORY` WHERE `ID`='?i'", $_GET['value']);
    echo $data['NAME_RUS'];
    }

if ($_GET['event']=="ac")
    {
    if (!empty($_GET['term']))
        {
        $term = $_GET['term'];

        $result=$db->query("SELECT * FROM `DIC_PORT` WHERE `NAME_RUS` LIKE '?s%' OR `NAME_ENG` LIKE '?s%' LIMIT 20", $term, $term);
        $i=0;
        while ($data=$result->fetch_assoc())
            {
            $aaa[$i]=$data['NAME_RUS'];
            $i++;
            }
        }
    $pattern = '/^'.preg_quote($term).'/iu';
    echo json_encode(preg_grep($pattern, $aaa));    
    }

if ($_GET['event']=="acSave")
    {
    $result=$db->query("SELECT `ID` FROM `DIC_PORT` WHERE `NAME_RUS`='?s' OR `NAME_ENG`='?s'", $_GET['value'], $_GET['value']);
    $data=$result->fetch_assoc();
    if($_SESSION['tmp']==1){if ($db->query("UPDATE `REQUEST_TMP` SET `".$_GET['field']."`='?i' WHERE `SESSION_ID`='?s'", $data['ID'], session_id())){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}}
    else{if ($db->query("UPDATE `REQUEST` SET `".$_GET['field']."`='?i' WHERE `ID`='?i'", $data['ID'], $_SESSION['req_id'])){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}}
    echo "<script type=\"text/javascript\">$('#request_".strtolower($_GET['field'])."').val('".$data['ID']."')</script>";
    }    

if ($_GET['event']=="addRequest")
    {
    $result_tmp=$db->query("SELECT * FROM `REQUEST_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_tmp=$result_tmp->fetch_assoc();
    
    $result_head=$db->query("SELECT * FROM `COMPANY` WHERE ID='?i'",$data_tmp['ID_COMPANY']);
    $data_head=$result_head->fetch_assoc();
    
    $data_new_req=array('ASMP_NUM'=>$data_tmp['ASMP_NUM'],
            		'REQ_NUM'=>$data_tmp['REQ_NUM'],
            		'REQ_NUM_RCPT'=>$data_tmp['REQ_NUM_RCPT'],
            		'REQ_DATE'=>$data_tmp['REQ_DATE'],
            		'REQ_DATE_CREATE'=>$data_tmp['REQ_DATE_CREATE'],
            		'DATE_SOLUTION'=>$data_tmp['DATE_SOLUTION'],
            		'SOLUTION'=>$data_tmp['SOLUTION'],
            		'DISPLAY_FLAG'=>$data_tmp['DISPLAY_FLAG'],
            		'ID_ROLE'=>$data_tmp['ID_ROLE'],
            		'ID_COMPANY'=>$data_tmp['ID_COMPANY'],
            		'ID_PERSON'=>$data_tmp['ID_PERSON'],
            		'ID_SIGNER_POST'=>$data_tmp['ID_SIGNER_POST'],
            		'ID_SIGNER_PERSON'=>$data_tmp['ID_PERSON'],
            		'ID_SHIP'=>$data_tmp['ID_SHIP'],
            		'ID_LAST_PORT'=>$data_tmp['ID_LAST_PORT'],
            		'ID_FIRST_PORT'=>$data_tmp['ID_FIRST_PORT'],
            		'ROUTE_DESC'=>$data_tmp['ROUTE_DESC'],
            		'EXP_ROUTE_DATE_START'=>$data_tmp['EXP_ROUTE_DATE_START'],
            		'EXP_ROUTE_DATE_END'=>$data_tmp['EXP_ROUTE_DATE_END'],
            		'EXP_CRUE_QTY'=>$data_tmp['EXP_CRUE_QTY'],
            		'EXP_PASSENGER_QTY'=>$data_tmp['EXP_PASSENGER_QTY'],
            		'CARGO_TYPE'=>$data_tmp['CARGO_TYPE'],
            		'CARGO_QTY'=>$data_tmp['CARGO_QTY'],
            		'TUG_OBJECT_DESC'=>$data_tmp['TUG_OBJECT_DESC'],
            		'DANG_CLASS'=>$data_tmp['DANG_CLASS'],
            		'DANG_QTY'=>$data_tmp['DANG_QTY'],
            		'ICE_NAV_EXPERIENCE'=>$data_tmp['ICE_NAV_EXPERIENCE'],
            		'ID_COUNTRY'=>$data_tmp['ID_COUNTRY'],
            		'ID_PORT'=>$data_tmp['ID_PORT'],
            		'ID_SHIP_TYPE'=>$data_tmp['ID_SHIP_TYPE'],
            		'CLASS'=>$data_tmp['CLASS'],
            		'ID_ICE_CAT'=>$data_tmp['ID_ICE_CAT'],
            		'VESSEL_PHONE'=>$data_tmp['VESSEL_PHONE'],
            		'VESSEL_FAX'=>$data_tmp['VESSEL_FAX'],
            		'VESSEL_EMAIL'=>$data_tmp['VESSEL_EMAIL'],
            		'ID_CLASS_SOC'=>$data_tmp['ID_CLASS_SOC'],
            		'VESSEL_LENGTH'=>$data_tmp['VESSEL_LENGTH'],
            		'VESSEL_WIDTH'=>$data_tmp['VESSEL_WIDTH'],
            		'GROSS_TONNAGE'=>$data_tmp['GROSS_TONNAGE'],
            		'DRAGHT'=>$data_tmp['DRAGHT'],
            		'ENGINE_POWER'=>$data_tmp['ENGINE_POWER'],
            		'ICE_BELT_WIDTH'=>$data_tmp['ICE_BELT_WIDTH'],
            		'FUEL_CONSUMPTION'=>$data_tmp['FUEL_CONSUMPTION'],
            		'BOW_CONSTR_DETAIL'=>$data_tmp['BOW_CONSTR_DETAIL'],
            		'STERN_CONSTR_DETAIL'=>$data_tmp['STERN_CONSTR_DETAIL'],
            		'COMPANY_HEAD_POST'=>$data_head['HEAD_POST'],
            		'COMPANY_HEAD_NAME'=>$data_head['HEAD_NAME'],
            		'EDIT_SOL'=>1,
            		'LANG_SOL'=>1,
            		'TS_CREATED'=>date("Y-m-d H:i:s"),
            		'TS_UPDATED'=>date("Y-m-d H:i:s"),
            		'TS_DELETED'=>date("Y-m-d H:i:s"),
            		'IS_DELETED'=>'0');
    $db->query("INSERT INTO `REQUEST` SET ?As", $data_new_req);
    $new_req_id=$db->getLastInsertId();

    $result_doc_tmp=$db->query("SELECT * FROM `DOCUMENT_TMP` WHERE `REQ_ID`='?i'", $data_tmp['ID']);
    while ($data_doc_tmp=$result_doc_tmp->fetch_assoc())
	{
	$data_new_doc=array('ID_DOC_TYPE'=>$data_doc_tmp['ID_DOC_TYPE'], 
			    'URI'=>$data_doc_tmp['URI'], 
			    'TS_CREATED'=>date("Y-m-d H:i:s"), 
			    'TS_UPDATED'=>date("Y-m-d H:i:s"), 
			    'TS_DELETED'=>date("Y-m-d H:i:s"), 
			    'IS_DELETED'=>'0');
	$db->query("INSERT INTO `DOCUMENT` SET ?As", $data_new_doc);
	$new_doc_id=$db->getLastInsertId();
	rename("../files_tmp/".$data_doc_tmp['URI'], "../files/".$data_doc_tmp['URI']);

	$data_req_doc=array('ID_REQUEST'=>$new_req_id, 
			    'ID_DOCUMENT'=>$new_doc_id, 
			    'TS_CREATED'=>date("Y-m-d H:i:s"), 
			    'TS_UPDATED'=>date("Y-m-d H:i:s"), 
			    'TS_DELETED'=>date("Y-m-d H:i:s"), 
			    'IS_DELETED'=>'0');
	$db->query("INSERT INTO `LNK_DOC_REQUEST` SET ?As", $data_req_doc);

	$db->query("DELETE FROM `DOCUMENT_TMP` WHERE `ID`='?i'", $data_doc_tmp['ID']);
	}
    $db->query("DELETE FROM `REQUEST_TMP` WHERE `ID`='?i'", $data_tmp['ID']);
    echo "<script language='Javascript'>
                window.location.href=\"/index.php\";
            </script>";
    }

if ($_GET['event']=="clearRequest")
    {
    $result=$db->query("SELECT * FROM `REQUEST_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data=$result->fetch_assoc();
    $result_doc=$db->query("SELECT * FROM `DOCUMENT_TMP` WHERE `REQ_ID`='?i'", $data['ID']);
    while ($data_doc=$result_doc->fetch_assoc())
	{
	if ($data_doc['URI']!=""){unlink("../files_tmp/".$data_doc['URI']);}
	$db->query("DELETE FROM `DOCUMENT_TMP` WHERE `ID`='?i'",$data_doc['ID']);
	}
    $db->query("DELETE FROM `REQUEST_TMP` WHERE `ID`='?i'",$data['ID']);
    echo "<script language='Javascript'>
                window.location.href=\"/index.php?event=edit\";
            </script>";
    }

?>
