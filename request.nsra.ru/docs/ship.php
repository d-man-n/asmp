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

        $result=$db->query("SELECT * FROM `SHIP` WHERE `IMO` LIKE '?s%' OR `CALL_SIGN` LIKE '?s%' OR `MMSI` LIKE '?s%' OR `RMRS` LIKE '?s%' OR `RRR` LIKE '?s%'", $term, $term, $term, $term, $term);
        $i=0;
        while ($data=$result->fetch_assoc())
            {
            $aaa[$i]=$data['IMO'];
            $i++;
            $aaa[$i]=$data['CALL_SIGN'];
            $i++;
            $aaa[$i]=$data['MMSI'];
            $i++;
            $aaa[$i]=$data['RMRS'];
            $i++;
            $aaa[$i]=$data['RRR'];
            $i++;
            }
        }
    $pattern = '/^'.preg_quote($term).'/iu';
    echo json_encode(preg_grep($pattern, $aaa));
    }

if ($_GET['event']=="editShip")
    {
    $db->query("DELETE FROM `SHIP_TMP` WHERE `SESSION_ID`='?s'", session_id());
    if ($_GET['id']!="")
	{
	$result=$db->query("SELECT * FROM `SHIP` WHERE `ID`='?i'", $_GET['id']);
	$data=$result->fetch_assoc();
	$new_data_ship=array('SESSION_ID'=>session_id(),'NAME_RUS'=>$data['NAME_RUS'],'NAME_ENG'=>$data['NAME_ENG'],'IMO'=>$data['IMO'],'CALL_SIGN'=>$data['CALL_SIGN'],'MMSI'=>$data['MMSI'],'RMRS'=>$data['RMRS'],'RRR'=>$data['RRR'],
			    'CODE'=>'','CDATE'=>date("Y-m-d H:i:s"));
	}
    else
	{
	$new_data_ship=array('SESSION_ID'=>session_id(),'NAME_RUS'=>'','NAME_ENG'=>'','IMO'=>'','CALL_SIGN'=>'','MMSI'=>'','RMRS'=>'','RRR'=>'','CODE'=>'',
                            'CDATE'=>date("Y-m-d H:i:s"));
        }
    $db->query("INSERT INTO `SHIP_TMP` SET ?As", $new_data_ship);
    }

if ($_GET['event']=="save_tmp")
    {
    if ($db->query("UPDATE `SHIP_TMP` SET `".$_GET['field']."`='?s' WHERE `SESSION_ID`='?s'", $_GET['value'], session_id())){echo "<b><font style=\"color: #".rand(100000,999999).";\">Сохранено</font></b>";}
    }

if ($_GET['event']=="saveShip")
    {
    $result_tmp=$db->query("SELECT * FROM `SHIP_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_tmp=$result_tmp->fetch_assoc();
    $result_old=$db->query("SELECT `ID`, `IS_DELETED` FROM `SHIP` WHERE `NAME_RUS`='?s' AND `NAME_ENG`='?s' AND `IMO`='?s' AND `CALL_SIGN`='?s' AND `MMSI`='?s' AND `RMRS`='?s' AND `RRR`='?s'", 
					    $data_tmp['NAME_RUS'], $data_tmp['NAME_ENG'], $data_tmp['IMO'], $data_tmp['CALL_SIGN'], $data_tmp['MMSI'], $data_tmp['RMRS'], $data_tmp['RRR']);
    if ($result_old->getNumRows()>0)
	{
	$data_old=$result_old->fetch_assoc();
	if ($data_old['IS_DELETED']==0){ echo "Такое судно уже есть.";}
	else {$db->query("UPDATE `SHIP` SET `IS_DELETED`=0 WHERE `ID`='?i'",$data_old['ID']); echo "Судно восстановлено из удаленных";}
	$new_id=$data_old['ID'];
	}
    else
	{
	$new_data_ship=array("NAME_RUS"=>$data_tmp['NAME_RUS'],"NAME_ENG"=>$data_tmp['NAME_ENG'],"IMO"=>$data_tmp['IMO'],"CALL_SIGN"=>$data_tmp['CALL_SIGN'], "MMSI"=>$data_tmp['MMSI'],"RMRS"=>$data_tmp['RMRS'],
			"RRR"=>$data_tmp['RRR'],'CODE'=>'','TS_CREATED'=>date("Y-m-d H:i:s"),'TS_UPDATED'=>date("Y-m-d H:i:s"),'TS_DELETED'=>date("Y-m-d H:i:s"),'IS_DELETED'=>'0');
	if ($db->query("INSERT INTO `SHIP` SET ?As", $new_data_ship)){echo "<b>Добавлена новая запись!</b>";}
        $new_id=$db->getLastInsertId();
        }
    if ($_SESSION['tmp']==1){$db->query("UPDATE `REQUEST_TMP` SET `ID_SHIP`='?i' WHERE `SESSION_ID`='?s'", $new_id, session_id());}
    else{$db->query("UPDATE `REQUEST` SET `ID_SHIP`='?i' WHERE `ID`='?i'", $new_id, $_SESSION['req_id']);}
    echo "<script type=\"text/javascript\">$('#request_id_ship').val('".$new_id."')</script>";
    $db->query("DELETE FROM `SHIP_TMP` WHERE `SESSION_ID`='?s'", session_id());
    }

if ($_GET['event']=="dataShip")
    {
    if ($_GET['cancel']==1)
	{
	$db->query("DELETE FROM `SHIP_TMP` WHERE `SESSION_ID`='?s'", session_id());
	$result=$db->query("SELECT * FROM `SHIP` WHERE `ID`='?i'", $_GET['id']);
	}
    elseif ($_GET['id_ship']>0){$result=$db->query("SELECT * FROM `SHIP` WHERE `ID`='?i'", $_GET['id_ship']);}
    else {$result=$db->query("SELECT * FROM `SHIP` WHERE `IMO`='?s' OR `CALL_SIGN`='?s' OR `MMSI`='?s' OR `RMRS`='?s' OR `RRR`='?s'", $_GET['id'], $_GET['id'], $_GET['id'], $_GET['id'], $_GET['id']);}
    if ($result->getNumRows()>1)
	{
	echo "<h1>Найдено несколько соответствий. Уточните.</h1>
	    <table width=100%>
		<tr class=\"selhship\">
		    <td>Название</td>
		    <td>ИМО</td>
		    <td>Позывной</td>
		    <td>MMSI</td>
		    <td>RMRS</td>
		    <td>RRR</td>
		</tr>";
	while ($data=$result->fetch_assoc())
	    {
	echo "<tr onclick=\"$('#dataShip').load('/docs/ship.php?event=dataShip&id_ship=".$data['ID']."');\" class=\"selship\">
		    <td>".$data['NAME_RUS']."</td>
		    <td>".$data['IMO']."</td>
		    <td>".$data['CALL_SIGN']."</td>
		    <td>".$data['MMSI']."</td>
		    <td>".$data['RMRS']."</td>
		    <td>".$data['RRR']."</td>
		</tr>";
	    }
	echo "</table>
		<script type=\"text/javascript\">noneObj('Ship');</script>";
	}
    else
	{
	$data=$result->fetch_assoc();
	if ($result->getNumRows()==0){echo "<font class=\"main\">Судно не найдено.</font>";}
	else
    	    {
    	    if ($_SESSION['tmp']==1){$db->query("UPDATE `REQUEST_TMP` SET `ID_SHIP`='?i' WHERE `SESSION_ID`='?s'", $data['ID'], session_id());}
    	    else{$db->query("UPDATE `REQUEST` SET `ID_SHIP`='?i' WHERE `ID`='?i'", $data['ID'], $_SESSION['req_id']);}
    	    }
	echo "<input type=\"hidden\" id=\"request_id_ship\" name=\"request_id_ship\" value=\"".$data['ID']."\">
	<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"950\" align=\"center\">
            <tr>
                <td align=\"left\" style=\"width: 217px;\"><font class=\"main\">2.1 Название судна на русском языке:</font></td>
                <td align=\"left\"><input type=\"text\" size=\"25\" class=\"Ship\" id=\"ship_name_rus\" name=\"ship_name_rus\" value=\"".$data['NAME_RUS']."\"></td>
    	        <td align=\"right\"><font class=\"main\">2.2 Название судна на английском языке:</font></td>
    	        <td align=\"left\"><input type=\"text\" size=\"25\" class=\"Ship\" id=\"ship_name_eng\" name=\"ship_name_eng\" value=\"".$data['NAME_ENG']."\"></td>
            </tr>
            <tr>
                <td colspan=\"4\">
        	    <font class=\"main\">2.3 Номер ИМО:</font> &nbsp; <input type=\"text\" size=\"20\" class=\"Ship\" id=\"ship_imo\" name=\"ship_imo\" value=\"".$data['IMO']."\"> &nbsp;&nbsp;
                    <font class=\"main\">2.4 Позывной:</font> &nbsp; <input type=\"text\" size=\"20\" class=\"Ship\" id=\"ship_call_sign\" name=\"ship_call_sign\" value=\"".$data['CALL_SIGN']."\"> &nbsp;&nbsp;
                    <font class=\"main\">2.5 MMSI:</font> &nbsp; <input type=\"text\" size=\"20\" class=\"Ship\" id=\"ship_mmsi\" name=\"ship_mmsi\" value=\"".$data['MMSI']."\">
                </td>
            </tr>
                <tr>
	            <td align=\"left\"><font class=\"main\">2.6 Рег. номер РМРС:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"25\" class=\"Ship\" id=\"ship_rmrs\" name=\"ship_rmrs\" value=\"".$data['RMRS']."\"></td>
                    <td align=\"right\"><font class=\"main\">2.7 Рег. номер РРР:</font></td>
                    <td align=\"left\"><input type=\"text\" size=\"25\" class=\"Ship\" id=\"ship_rrr\" name=\"ship_rrr\" value=\"".$data['RRR']."\"></td>
                </tr>
            </table>";
    if ($result->getNumRows()==0){echo "<script type=\"text/javascript\">noneObj('Ship');</script>";}
    else {echo "<script type=\"text/javascript\">saveEdit('Ship');</script>";}
	}
    }
?>