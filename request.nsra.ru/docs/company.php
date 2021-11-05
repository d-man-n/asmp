<?php
session_start();
require_once('../db/Mysql.php');
require_once('../db/Mysql/Exception.php');
require_once('../db/Mysql/Statement.php');
require_once('../db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);

if ($_GET['event']=="ac")
    {
    $term = $_GET['term'];
    if (!empty($_GET['term']))
        {
        $result=$db->query("SELECT * FROM `COMPANY` WHERE LOWER(`NAME_RUS`) LIKE '%?s%' OR LOWER(`NAME_ENG`) LIKE '%?s%'", strtolower($term), strtolower($term));
        $i=0;
	while ($data=$result->fetch_assoc())
    	    {
    	    if (strstr(mb_strtolower($data['NAME_RUS'], 'utf-8'), mb_strtolower($term, 'utf-8'))) $aaa[$i]=$data['NAME_RUS'];
    	    elseif (strstr(mb_strtolower($data['NAME_ENG'], 'utf-8'), mb_strtolower($term, 'utf-8'))) $aaa[$i]=$data['NAME_ENG'];
    	    $i++;
	    }
	}
    echo json_encode($aaa);
                                                                                                    
//    if (!empty($_GET['term']))
//        {
//        $term = $_GET['term'];
//        $result=$db->query("SELECT * FROM `COMPANY` WHERE `NAME_RUS` LIKE '%?s%' OR `NAME_ENG` LIKE '%?s%'", $term, $term);
//        $i=0;
//        while ($data=$result->fetch_assoc())
//            {
//            $aaa[$i]=$data['NAME_RUS'];
//            $i++;
//            $aaa[$i]=$data['NAME_ENG'];
//            $i++;
//            }
//        }
//    $pattern = '/^'.preg_quote($term).'/iu';
//    echo json_encode(preg_grep($pattern, $aaa));
//    echo json_encode($aaa);
    }

if ($_GET['event']=="editCompany")
    {
    $db->query("DELETE FROM `COMPANY_TMP` WHERE `SESSION_ID`='?s'", session_id());
    if ($_GET['id']!="")
        {
        $result=$db->query("SELECT * FROM `COMPANY` WHERE `ID`='?i'", $_GET['id']);
        $data=$result->fetch_assoc();
        $new_data_company=array('SESSION_ID'=>session_id(),'IMO'=>$data['IMO'],'NAME_RUS'=>$data['NAME_RUS'],'NAME_ENG'=>$data['NAME_ENG'],'ADDRESS_RUS'=>$data['ADDRESS_RUS'],'ADDRESS_ENG'=>$data['ADDRESS_ENG'],'PHONE'=>$data['PHONE'],
    				'FAX'=>$data['FAX'],'EMAIL'=>$data['EMAIL'],'HEAD_POST'=>$data['HEAD_POST'],'HEAD_NAME'=>$data['HEAD_NAME'],'CODE'=>'','CDATE'=>date("Y-m-d H:i:s"));
        }
    else
        {
        $new_data_company=array('SESSION_ID'=>session_id(),'IMO'=>'','NAME_RUS'=>'','NAME_ENG'=>'','ADDRESS_RUS'=>'','ADDRESS_ENG'=>'','PHONE'=>'','FAX'=>'','EMAIL'=>'','HEAD_POST'=>'','HEAD_NAME'=>'','CODE'=>'',
                            'CDATE'=>date("Y-m-d H:i:s"));
        }
    $db->query("INSERT INTO `COMPANY_TMP` SET ?As", $new_data_company);
    }

if ($_GET['event']=="save_tmp")
    {
    if ($db->query("UPDATE `COMPANY_TMP` SET `".$_GET['field']."`='?s' WHERE `SESSION_ID`='?s'", $_GET['value'], session_id())){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}
    }

if ($_GET['event']=="saveCompany")
    {
    $result_tmp=$db->query("SELECT * FROM `COMPANY_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_tmp=$result_tmp->fetch_assoc();
    $result_old=$db->query("SELECT `ID`, `IS_DELETED` FROM `COMPANY` WHERE `NAME_RUS`='?s' AND `NAME_ENG`='?s' AND `ADDRESS_RUS`='?s' AND `ADDRESS_ENG`='?s' AND `PHONE`='?s' AND `FAX`='?s' AND `EMAIL`='?s' AND `HEAD_POST`='?s' AND `HEAD_NAME`='?s'",
                                            $data_tmp['NAME_RUS'], $data_tmp['NAME_ENG'], $data_tmp['ADDRESS_RUS'], $data_tmp['ADDRESS_ENG'], $data_tmp['PHONE'], $data_tmp['FAX'], $data_tmp['EMAIL'], $data_tmp['HEAD_POST'],  $data_tmp['HEAD_NAME']);
    if ($result_old->getNumRows()>0)
        {
        $data_old=$result_old->fetch_assoc();
        if ($data_old['IS_DELETED']==0){ echo "Такая компания уже есть.";}
        else {$db->query("UPDATE `COMPANY` SET `IS_DELETED`=0 WHERE `ID`='?i'",$data_old['ID']); echo "Компания восстановлена из удаленных";}
        $new_id=$data_old['ID'];
        }
    else
        {
        $new_data_company=array("IMO"=>$data_tmp['IMO'],"NAME_RUS"=>$data_tmp['NAME_RUS'],"NAME_ENG"=>$data_tmp['NAME_ENG'],"ADDRESS_RUS"=>$data_tmp['ADDRESS_RUS'],"ADDRESS_ENG"=>$data_tmp['ADDRESS_ENG'], "PHONE"=>$data_tmp['PHONE'],
    				"FAX"=>$data_tmp['FAX'],"EMAIL"=>$data_tmp['EMAIL'],"HEAD_POST"=>$data_tmp['HEAD_POST'],"HEAD_NAME"=>$data_tmp['HEAD_NAME'],'CODE'=>'','TS_CREATED'=>date("Y-m-d H:i:s"),'TS_UPDATED'=>date("Y-m-d H:i:s"),'TS_DELETED'=>date("Y-m-d H:i:s"),'IS_DELETED'=>'0');
        if ($db->query("INSERT INTO `COMPANY` SET ?As", $new_data_company)){echo "<b>Добавлена новая запись!</b>";}
        $new_id=$db->getLastInsertId();
        }
    if ($_SESSION['tmp']==1){$db->query("UPDATE `REQUEST_TMP` SET `ID_COMPANY`='?i' WHERE `SESSION_ID`='?s'", $new_id, session_id());}
    else{$db->query("UPDATE `REQUEST` SET `ID_COMPANY`='?i' WHERE `ID`='?i'", $new_id, $_SESSION['req_id']);}
    echo "<script type=\"text/javascript\">$('#request_id_company').val('".$new_id."')</script>";
    $db->query("DELETE FROM `COMPANY_TMP` WHERE `SESSION_ID`='?s'", session_id());
    }

if ($_GET['event']=="dataCompany")
    {
    if ($_GET['cancel']==1)
        {
        $db->query("DELETE FROM `COMPANY_TMP` WHERE `SESSION_ID`='?s'", session_id());
        $result=$db->query("SELECT * FROM `COMPANY` WHERE `ID`='?i'", $_GET['id']);
        }
    else {$result=$db->query("SELECT * FROM `COMPANY` WHERE `NAME_RUS`='?s' OR `NAME_ENG`='?s'", $_GET['id'], $_GET['id']);}
    $data=$result->fetch_assoc();
    if ($result->getNumRows()==0){echo "<font class=\"main\">Компания не найдена.</font>";}
    else
        {
        if ($_SESSION['tmp']==1){$db->query("UPDATE `REQUEST_TMP` SET `ID_COMPANY`='?i' WHERE `SESSION_ID`='?s'", $data['ID'], session_id());}
        else{$db->query("UPDATE `REQUEST` SET `ID_COMPANY`='?i' WHERE `ID`='?i'", $data['ID'], $_SESSION['req_id']);}
        }

    echo "<input type=\"hidden\" id=\"request_id_company\" name=\"request_id_company\" value=\"".$data['ID']."\">
	<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"950\" align=\"center\">
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.1 Название компании на русском языке:</font></td>
                <td align=\"left\"><textarea cols=\"70\" rows=\"2\" class=\"Company\" id=\"company_name_rus\" name=\"company_name_rus\">".$data['NAME_RUS']."</textarea></td>
            </tr>
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.2 Название компании на английском языке:</font></td>
                <td align=\"left\"><textarea cols=\"70\" rows=\"2\" class=\"Company\" id=\"company_name_eng\" name=\"company_name_eng\">".$data['NAME_ENG']."</textarea></td>
            </tr>
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.3 Адрес компании на русском языке:</font></td>
                <td align=\"left\"><textarea cols=\"70\" rows=\"2\" class=\"Company\" id=\"company_address_rus\" name=\"company_address_rus\">".$data['ADDRESS_RUS']."</textarea></td>
            </tr>
    	    <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.4 Адрес компании на английском языке:</font></td>
                <td align=\"left\"><textarea cols=\"70\" rows=\"2\" class=\"Company\" id=\"company_address_eng\" name=\"company_address_eng\">".$data['ADDRESS_ENG']."</textarea></td>
            </tr>
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.5 Телефон компании:</font></td>
                <td align=\"left\"><input type=\"text\" size=\"40\" class=\"Company\" id=\"company_phone\" name=\"company_phone\" value=\"".$data['PHONE']."\"></td>
            </tr>
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.6 Факс компании:</font></td>
                <td align=\"left\"><input type=\"text\" size=\"40\" class=\"Company\" id=\"company_fax\" name=\"company_fax\" value=\"".$data['FAX']."\"></td>
            </tr>
            <tr>
    	        <td align=\"left\" valign=\"top\"><font class=\"main\">1.7 Email адрес компании:</font></td>
                <td align=\"left\"><input type=\"text\" size=\"68\" class=\"Company\" id=\"company_email\" name=\"company_email\" value=\"".$data['EMAIL']."\"></td>
            </tr>
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.8 Должность руководителя компании:</font></td>
                <td align=\"left\"><input type=\"text\" size=\"68\" class=\"Company\" id=\"company_head_post\" name=\"company_head_post\" value=\"".$data['HEAD_POST']."\"></td>
            </tr>
            <tr>
                <td align=\"left\" valign=\"top\"><font class=\"main\">1.9 ФИО руководителя компании:</font></td>
                <td align=\"left\"><input type=\"text\" size=\"68\" class=\"Company\" id=\"company_head_name\" name=\"company_head_name\" value=\"".$data['HEAD_NAME']."\"></td>
            </tr>
        </table>";
    if ($result->getNumRows()==0){echo "<script type=\"text/javascript\">noneObj('Company');</script>";}
    else {echo "<script type=\"text/javascript\">saveEdit('Company');</script>";}
    }
?>