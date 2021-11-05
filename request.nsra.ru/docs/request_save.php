<?php
session_start();
require_once('../db/Mysql.php');
require_once('../db/Mysql/Exception.php');
require_once('../db/Mysql/Statement.php');
require_once('../db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);

header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header("Content-Disposition: attachment;filename=".date("dmYHis")."-export.xls");
header("Content-Transfer-Encoding: binary ");
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html>
	<head>
	    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
	    <meta name=\"author\" content=\"zabey\" />
	    <title>Заявки</title>
	</head>
	<body>";
$result_req=$db->query("SELECT `COMPANY`.`NAME_RUS` AS CNAME, 
				`SHIP`.`NAME_RUS` AS SNAME_RUS, 
				`SHIP`.`NAME_ENG` AS SNAME_ENG, 
				`SHIP`.`IMO` AS IMO, 
				`SHIP`.`CALL_SIGN` AS CALL_SIGN, 
				`SHIP`.`MMSI` AS MMSI, 
				`SHIP`.`RMRS` AS RMRS, 
				`SHIP`.`RRR` AS RRR, 
				`DIC_COUNTRY`.`NAME_RUS` AS FNAME, 
				`DIC_COUNTRY`.`ISO_A3_CODE` AS FCODE, 
				`DIC_ICE_CATEGORY`.`ICE_CATEGORY` AS INAME, 
				`REQUEST`.`ID` AS ID,
				`REQUEST`.`ASMP_NUM` AS ASMP_NUM,
				`REQUEST`.`REQ_NUM` AS REQ_NUM,
				`REQUEST`.`REQ_NUM_RCPT` AS REQ_NUM_RCPT,
				`REQUEST`.`SOLUTION` AS SOLUTION,
				`REQUEST`.`REQ_DATE_CREATE` AS REQ_DATE_CREATE,
				`REQUEST`.`DATE_SOLUTION` AS DATE_SOLUTION
			    FROM `REQUEST`
			    LEFT JOIN `COMPANY` ON `REQUEST`.`ID_COMPANY`=`COMPANY`.`ID` 
			    LEFT JOIN `SHIP` ON `REQUEST`.`ID_SHIP`=`SHIP`.`ID`
			    LEFT JOIN `DIC_COUNTRY` ON `REQUEST`.`ID_COUNTRY`=`DIC_COUNTRY`.`ID`
			    LEFT JOIN `DIC_ICE_CATEGORY` ON `REQUEST`.`ID_ICE_CAT`=`DIC_ICE_CATEGORY`.`ID`");

	echo "<table border=1>
		<tr>
            	    <th>№ п/п судна</th>
            	    <th>Название судна (RUS)</th>
            	    <th>Название судна (ENG)</th>
            	    <th>ИМО</th>
            	    <th>Позывной</th>
            	    <th>MMSI</th>
            	    <th>РМРС</th>
            	    <th>РРР</th>
            	    <th>Судовладелец</th>
            	    <th>Флаг</th>
            	    <th>Код флага</th>
            	    <th>Ледовый класс</th>
            	    <th>Исходящий № заявления</th>
            	    <th>Входящий № заявления</th>
            	    <th>Дата принятия заявления к рассмотрению</th>
            	    <th>Тип заявки</th>
            	    <th>Дата разрешения, отказа</th>
            	    <th>Срок действия разрешения</th>
    		</tr>";
	while ($data_req=$result_req->fetch_assoc())
	    {
	    if ($data_req['SOLUTION']==0){$solution="Новая";}
	    if ($data_req['SOLUTION']==1){$solution="Первоначальное разрешение";}
	    if ($data_req['SOLUTION']==2){$solution="Проделние разрешения";}
	    if ($data_req['SOLUTION']==3){$solution="Отказ";}
	    
	    if ($data_req['SOLUTION']==1 || $data_req['SOLUTION']==2)
		{
		$result_sol=$db->query("SELECT * FROM `SOLUTION` WHERE `ID_REQUEST`='?i'", $data_req['ID']);
		$data_sol=$result_sol->fetch_assoc();
		$date_sol="С ".$data_sol['PERMITED_FROM']." по ".$data_sol['PERMITED_TO'];
		}
	    else {$date_sol="";}
    	    echo "<tr>
		    <td>".$data_req['ASMP_NUM']."</td>
		    <td>".$data_req['SNAME_RUS']."</td>
		    <td>".$data_req['SNAME_ENG']."</td>
		    <td>".$data_req['IMO']."</td>
		    <td>".$data_req['CALL_SIGN']."</td>
		    <td>".$data_req['MMSI']."</td>
		    <td>".$data_req['RMRS']."</td>
		    <td>".$data_req['RRR']."</td>
		    <td>".$data_req['CNAME']."</td>
		    <td>".$data_req['FNAME']."</td>
		    <td>".$data_req['FCODE']."</td>
		    <td>".$data_req['INAME']."</td>
		    <td>".$data_req['REQ_NUM']."</td>
		    <td>".$data_req['REQ_NUM_RCPT']."</td>
		    <td>".$data_req['REQ_DATE_CREATE']."</td>
		    <td>".$solution."</td>
		    <td>".$data_req['DATE_SOLUTION']."</td>
		    <td>".$date_sol."</td>
		</tr>";
	    }
	echo "</table>";
?>