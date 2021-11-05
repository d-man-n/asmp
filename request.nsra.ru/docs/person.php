<?
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
    if (!empty($_GET['term']))       
	{
        $term = $_GET['term'];

        $result=$db->query("SELECT * FROM `PERSON` WHERE `SHORTNAME_RUS` LIKE '?s%' OR `SHORTNAME_ENG` LIKE '?s%' OR `NAME_RUS` LIKE '?s%' OR `NAME_ENG` LIKE '?s%'", $term, $term, $term, $term);
        $i=0;
        while ($data=$result->fetch_assoc())
            {
            $aaa[$i]=$data['SHORTNAME_RUS'];
            $i++;
            $aaa[$i]=$data['SHORTNAME_ENG'];
            $i++;
            $aaa[$i]=$data['NAME_RUS'];
            $i++;
            $aaa[$i]=$data['NAME_ENG'];
            $i++;
            }
        }
    $pattern = '/^'.preg_quote($term).'/iu';
    echo json_encode(preg_grep($pattern, $aaa));
    }

if ($_GET['event']=="editPerson")
    {
    $db->query("DELETE FROM `PERSON_TMP` WHERE `SESSION_ID`='?s'", session_id());
    if ($_GET['id']!="")
        {
        $result=$db->query("SELECT * FROM `PERSON` WHERE `ID`='?i'", $_GET['id']);
        $data=$result->fetch_assoc();
        $new_data_person=array('SESSION_ID'=>session_id(),'NAME_RUS'=>$data['NAME_RUS'],'SHORTNAME_RUS'=>$data['SHORTNAME_RUS'],'NAME_ENG'=>$data['NAME_ENG'],'SHORTNAME_ENG'=>$data['SHORTNAME_ENG'],'PHONE'=>$data['PHONE'],
    				'FAX'=>$data['FAX'],'EMAIL'=>$data['EMAIL'],'CODE'=>'','CDATE'=>date("Y-m-d H:i:s"));
        }
    else
        {
        $new_data_person=array('SESSION_ID'=>session_id(),'NAME_RUS'=>'','SHORTNAME_RUS'=>'','NAME_ENG'=>'','SHORTNAME_ENG'=>'','PHONE'=>'','FAX'=>'','EMAIL'=>'','CODE'=>'',
                            'CDATE'=>date("Y-m-d H:i:s"));
        }
    $db->query("INSERT INTO `PERSON_TMP` SET ?As", $new_data_person);
    }

if ($_GET['event']=="save_tmp")
    {
    if ($db->query("UPDATE `PERSON_TMP` SET `".$_GET['field']."`='?s' WHERE `SESSION_ID`='?s'", $_GET['value'], session_id())){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}
    }

if ($_GET['event']=="savePerson")
    {
    $result_tmp=$db->query("SELECT * FROM `PERSON_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_tmp=$result_tmp->fetch_assoc();
    $result_old=$db->query("SELECT `ID`, `IS_DELETED` FROM `PERSON` WHERE `NAME_RUS`='?s' AND `SHORTNAME_RUS`='?s' AND `NAME_ENG`='?s' AND `SHORTNAME_ENG`='?s'",
                                            $data_tmp['NAME_RUS'], $data_tmp['SHORTNAME_RUS'], $data_tmp['NAME_ENG'], $data_tmp['SHORTNAME_ENG']);
    if ($result_old->getNumRows()>0)
        {
        $data_old=$result_old->fetch_assoc();
        if ($data_old['IS_DELETED']==0){ echo "Такой заявитель уже есть.";}
        else {$db->query("UPDATE `PERSON` SET `IS_DELETED`=0 WHERE `ID`='?i'",$data_old['ID']); echo "Заявитель восстановлен из удаленных";}
        $new_id=$data_old['ID'];
        }
    else
        {
        $new_data_person=array("NAME_RUS"=>$data_tmp['NAME_RUS'],"SHORTNAME_RUS"=>$data_tmp['SHORTNAME_RUS'],"NAME_ENG"=>$data_tmp['NAME_ENG'],"SHORTNAME_ENG"=>$data_tmp['SHORTNAME_ENG'], "PHONE"=>$data_tmp['PHONE'],
    				"FAX"=>$data_tmp['FAX'],"EMAIL"=>$data_tmp['EMAIL'],'CODE'=>'','TS_CREATED'=>date("Y-m-d H:i:s"),'TS_UPDATED'=>date("Y-m-d H:i:s"),'TS_DELETED'=>date("Y-m-d H:i:s"),'IS_DELETED'=>'0');
        if ($db->query("INSERT INTO `PERSON` SET ?As", $new_data_person)){echo "<b>Добавлена новая запись!</b>";}
        $new_id=$db->getLastInsertId();
        }
    if ($_SESSION['tmp']==1){$db->query("UPDATE `REQUEST_TMP` SET `ID_PERSON`='?i' WHERE `SESSION_ID`='?s'", $new_id, session_id());}
    else{$db->query("UPDATE `REQUEST` SET `ID_PERSON`='?i' WHERE `ID`='?i'", $new_id, $_SESSION['req_id']);}
    echo "<script type=\"text/javascript\">$('#request_id_person').val('".$new_id."')</script>";
    $db->query("DELETE FROM `PERSON_TMP` WHERE `SESSION_ID`='?s'", session_id());
    }

if ($_GET['event']=="dataPerson")
    {
    if ($_GET['cancel']==1)
        {
        $db->query("DELETE FROM `PERSON_TMP` WHERE `SESSION_ID`='?s'", session_id());
        $result=$db->query("SELECT * FROM `PERSON` WHERE `ID`='?i'", $_GET['id']);
        }
    else {$result=$db->query("SELECT * FROM `PERSON` WHERE `NAME_RUS`='?s' OR `SHORTNAME_RUS`='?s' OR `NAME_ENG`='?s' OR `SHORTNAME_ENG`='?s'", $_GET['id'], $_GET['id'], $_GET['id'], $_GET['id']);}
    $data=$result->fetch_assoc();
    if ($result->getNumRows()==0){echo "<font class=\"main\">Заявитель не найден.</font>";}
    else
        {
        if ($_SESSION['tmp']==1){$db->query("UPDATE `REQUEST_TMP` SET `ID_PERSON`='?i' WHERE `SESSION_ID`='?s'", $data['ID'], session_id());}
        else{$db->query("UPDATE `REQUEST` SET `ID_PERSON`='?i' WHERE `ID`='?i'", $data['ID'], $_SESSION['req_id']);}
        }


    echo "<input type=\"hidden\" id=\"request_id_person\" name=\"request_id_person\" value=\"".$data['ID']."\">
            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"950\" align=\"center\">
                <tr>
                    <td align=\"left\"><font class=\"main\">Полные ФИО заявителя на русском языке:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_name_rus\" name=\"person_name_rus\" value=\"".$data['NAME_RUS']."\"></td>
                    <td align=\"right\"><font class=\"main\">Краткие ФИО заявителя на русском языке:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_shortname_rus\" name=\"person_shortname_rus\" value=\"".$data['SHORTNAME_RUS']."\"></td>
                </tr>
                <tr>
                    <td align=\"left\"><font class=\"main\">Полные ФИО заявителя на английском языке:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_name_eng\" name=\"person_name_eng\" value=\"".$data['NAME_ENG']."\"></td>
                    <td align=\"right\"><font class=\"main\">Краткие ФИО заявителя на английском языке:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_shortname_eng\" name=\"person_shortname_eng\" value=\"".$data['SHORTNAME_ENG']."\"></td>
                </tr>
                <tr>
                    <td align=\"left\"><font class=\"main\">Телефон заявителя:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_phone\" name=\"person_phone\" value=\"".$data['PHONE']."\"></td>
                    <td align=\"right\"><font class=\"main\">Факс заявителя:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_fax\" name=\"person_fax\" value=\"".$data['FAX']."\"></td>
                </tr>
                <tr>
                    <td align=\"left\"><font class=\"main\">Email заявителя:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"20\" class=\"Person\" id=\"person_email\" name=\"person_email\" value=\"".$data['EMAIL']."\"></td>
                </tr>
            </table>";
    if ($result->getNumRows()==0){echo "<script type=\"text/javascript\">noneObj('Person');</script>";}
    else {echo "<script type=\"text/javascript\">saveEdit('Person');</script>";}
    }
?>
