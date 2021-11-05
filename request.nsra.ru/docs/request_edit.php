<?php
if ($_GET['id']=="")
    {
    echo "<h1 align=center>Новая заявка</h1>";
    $_SESSION['tmp']=1;
    $_SESSION['req_id']=0;
    $uploaddir="/files_tmp/";
    $result=$db->query("SELECT * FROM `REQUEST_TMP` WHERE `SESSION_ID`='?s'", session_id());
    if ($result->getNumRows()==0)
	{
	$result_asmp_num=$db->query("SELECT MAX(ASMP_NUM) AS ASMP_NUM_MAX FROM `REQUEST`");
	$data_asmp_num=$result_asmp_num->fetch_assoc();
    	$result_asmp_num_tmp=$db->query("SELECT MAX(ASMP_NUM) AS ASMP_NUM_MAX FROM `REQUEST_TMP`");
	$data_asmp_num_tmp=$result_asmp_num_tmp->fetch_assoc();
	if ($data_asmp_num['ASMP_NUM_MAX']>=$data_asmp_num_tmp['ASMP_NUM_MAX']){$asmp_num=$data_asmp_num['ASMP_NUM_MAX']+1;}
	else {$asmp_num=$data_asmp_num_tmp['ASMP_NUM_MAX']+1;}
	
	$data_new_req=array('SESSION_ID'=>session_id(), 
		'ASMP_NUM'=>$asmp_num, 
		'REQ_NUM'=>'', 
		'REQ_NUM_RCPT'=>'', 
		'REQ_DATE'=>date("Y-m-d"),
		'REQ_DATE_CREATE'=>date("Y-m-d"),
		'DATE_SOLUTION'=>date("Y-m-d"),
		'SOLUTION'=>'0',
		'DISPLAY_FLAG'=>'1',
		'ID_ROLE'=>'0',
		'ID_COMPANY'=>'0',
		'ID_PERSON'=>'0',
		'ID_SIGNER_POST'=>'0',
		'ID_SIGNER_PERSON'=>'0',
		'ID_SHIP'=>'0',
		'ID_LAST_PORT'=>'0',
		'ID_FIRST_PORT'=>'0',
		'ROUTE_DESC'=>'',
		'EXP_ROUTE_DATE_START'=>date("Y-m-d"),
		'EXP_ROUTE_DATE_END'=>date("Y-m-d"),
		'EXP_CRUE_QTY'=>'0',
		'EXP_PASSENGER_QTY'=>'0',
		'CARGO_TYPE'=>'',
		'CARGO_QTY'=>'0',
		'TUG_OBJECT_DESC'=>'',
		'DANG_CLASS'=>'',
		'DANG_QTY'=>'0',
		'ICE_NAV_EXPERIENCE'=>'',
		'ID_COUNTRY'=>'0',
		'ID_PORT'=>'0',
		'ID_SHIP_TYPE'=>'0',
		'CLASS'=>'',
		'ID_ICE_CAT'=>'0',
		'VESSEL_PHONE'=>'',
		'VESSEL_FAX'=>'',
		'VESSEL_EMAIL'=>'',
		'ID_CLASS_SOC'=>'0',
		'VESSEL_LENGTH'=>'0',
		'VESSEL_WIDTH'=>'0',
		'GROSS_TONNAGE'=>'0',
		'DRAGHT'=>'0',
		'ENGINE_POWER'=>'0',
		'ICE_BELT_WIDTH'=>'0',
		'FUEL_CONSUMPTION'=>'0',
		'BOW_CONSTR_DETAIL'=>'',
		'STERN_CONSTR_DETAIL'=>'',
		'COMPANY_HEAD_POST'=>'',
		'COMPANY_HEAD_NAME'=>'',
		'CDATE'=>date("Y-m-d"));
	$db->query("INSERT INTO `REQUEST_TMP` SET ?As", $data_new_req);
	$result=$db->query("SELECT * FROM `REQUEST_TMP` WHERE `SESSION_ID`='?s'", session_id());
	}
    }
else 
    {
    echo "<h1 align=center>Редактировать заявку</h1>";
    $_SESSION['tmp']=0;
    $_SESSION['req_id']=$_GET['id'];
    $uploaddir="/files/";
    $result=$db->query("SELECT * FROM `REQUEST` WHERE `ID`='?i'", $_GET['id']);
    }

$data_request=$result->fetch_assoc();
?>
<br>
<h1 align="center">Форма заявления</h1>
<br>
<table cellspacing="0" cellpadding="0" border="0" width="1000" align="center">
    <tr>
	<td align="left" width="300"><font class="main">Порядковый номер заявки в системе АСМП:</font></td>
	<td align="left" width="300"><input type="text" size="10" id="request_asmp_num" name="request_asmp_num" value="<?php echo $data_request['ASMP_NUM'];?>"></td>
	<td align="right"><font class="main">Дата поступления заявки:</font></td>
	<td align="left"><input type="text" size="10" id="request_req_date_create" name="request_req_date_create" value="<?php echo $data_request['REQ_DATE_CREATE'];?>"></td>
    </tr>
    <tr>
	<td align="left"><font class="main">Исходящий № заявителя:</font></td>
	<td align="left"><input type="text" size="10" id="request_req_num" name="request_req_num" value="<?php echo $data_request['REQ_NUM'];?>"></td>
	<td align="right"><font class="main">Дата заявления:</font></td>
	<td align="left"><input type="text" size="10" id="request_req_date" name="request_req_date" value="<?php echo $data_request['REQ_DATE'];?>"></td>
    </tr>
    <tr>
	<td align="left"><font class="main">Входящий номер заявления:</font></td>
	<td align="left"><input type="text" size="10" id="request_req_num_rcpt" name="request_req_num_rcpt" value="<?php echo $data_request['REQ_NUM_RCPT'];?>"></td>
	<td align="right"><font class="main">Дата обработки заявки:</font></td>
	<td align="left"><input type="text" size="10" id="request_date_solution" name="request_date_solution" value="<?php echo $data_request['DATE_SOLUTION'];?>"></td>
    </tr>
    <tr>
	<td colspan="4">
	    <div id="tabs">
		<ul>
		    <li><a href="#tabs-1">1. Данные по компании</a></li>
		    <li><a href="#tabs-2">2. Данные по судну</a></li>
		    <li><a href="#tabs-3">3. Данные по маршруту</a></li>
		    <li><a href="#tabs-4">4. Данные о Физ. лице - Заявителе</a></li>
		  </ul>
		<div id="tabs-1">
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		        <tr>
			    <td align="right"><font class="main">Введите фрагмент названия компании и нажмите кнопку &laquo;Далее&raquo;:</font></td>
			    <td align="left"><input type="text" id="numberCompany" size="30">&nbsp;<button id="enterNumberCompany">Далее</button>&nbsp;<button id="enterNewCompany">Новая</button></td>
		        </tr>
		        <tr>
			    <td colspan="2"><hr></td>
		        </tr>
		    </table>
<?php
//"

$result_company_tmp=$db->query("SELECT * FROM `COMPANY_TMP` WHERE `SESSION_ID`='?s'", session_id());
if ($data_request['ID_COMPANY']==0 && $result_company_tmp->getNumRows()==0){$aaa=1;}
if ($result_company_tmp->getNumRows()>0)
    {
    $result_company=$db->query("SELECT * FROM `COMPANY_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_company=$result_company->fetch_assoc();
    $aaa=2;
    }
if ($data_request['ID_COMPANY']>0 && $result_company_tmp->getNumRows()==0)
    {
    $result_company=$db->query("SELECT * FROM `COMPANY` WHERE `ID`='?i'", $data_request['ID_COMPANY']);
    $data_company=$result_company->fetch_assoc();
    $aaa=3;
    }

?>
		    <div id="dataCompany">
			<input type="hidden" id="request_id_company" name="request_id_company" value="<?php echo $data_request['ID_COMPANY'];?>">
			<table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.1 Название компании на русском языке:</font></td>
				<td align="left" valign="top"><textarea cols="70" rows="2" class="Company" id="company_name_rus" name="company_name_rus"><?php echo $data_company['NAME_RUS'];?></textarea></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.2 Название компании на английском языке:</font></td>
				<td align="left" valign="top"><textarea cols="70" rows="2" class="Company" id="company_name_eng" name="company_name_eng"><?php echo $data_company['NAME_ENG'];?></textarea></td>
			    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.3 Адрес компании на русском языке:</font></td>
				<td align="left" valign="top"><textarea cols="70" rows="2" class="Company" id="company_address_rus" name="company_address_rus"><?php echo $data_company['ADDRESS_RUS'];?></textarea></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.4 Адрес компании на английском языке:</font></td>
				<td align="left" valign="top"><textarea cols="70" rows="2" class="Company" id="company_address_eng" name="company_address_eng"><?php echo $data_company['ADDRESS_ENG'];?></textarea></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.5 Телефон компании:</font></td>
				<td align="left" valign="top"><input type="text" size="40" class="Company" id="company_phone" name="company_phone" value="<?php echo $data_company['PHONE'];?>"></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.6 Факс компании:</font></td>
				<td align="left" valign="top"><input type="text" size="40" class="Company" id="company_fax" name="company_fax" value="<?php echo $data_company['FAX'];?>"></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.7 Email адрес компании:</font></td>
				<td align="left" valign="top"><input type="text" size="68" class="Company" id="company_email" name="company_email" value="<?php echo $data_company['EMAIL'];?>"></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.8 Должность руководителя компании:</font></td>
				<td align="left" valign="top"><input type="text" size="68" class="Company" id="company_head_post" name="company_head_post" value="<?php echo $data_company['HEAD_POST'];?>"></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.9 ФИО руководителя компании:</font></td>
				<td align="left" valign="top"><input type="text" size="68" class="Company" id="company_head_name" name="company_head_name" value="<?php echo $data_company['HEAD_NAME'];?>"></td>
		    	    </tr>
			</table>
		    </div>
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
    		        <tr>
			    <td align="right" colspan="2">
			        <div id="saveCompanyDiv" style="position: relative; float: left;"></div>
			        <button id="saveCompany">Сохранить</button>&nbsp;<button id="canselCompany">Отменить</button>
			        <button id="editCompany">Редактировать</button>
			    </td>
		    	</tr>
<?
if ($aaa==1){echo "<script type=\"text/javascript\">noneObj('Company');</script>";}
if ($aaa==2){echo "<script type=\"text/javascript\">newEdit('Company');</script>";}
if ($aaa==3){echo "<script type=\"text/javascript\">saveEdit('Company');</script>";}
?>
		    	<tr>
			    <td align="left" valign="top" width="314"><font class="main">1.10 Роль компании по отношению к судну:</font></td>
			    <td align="left" valign="top">
			        <SELECT style="width: 580px;" id="request_id_role" name="request_id_role">
			    	    <option value="0">Не выбрана
<?php
$result=$db->query("SELECT * FROM `DIC_ROLE`");
while ($data=$result->fetch_assoc())
    {
    if ($data_request['ID_ROLE']==$data['ID']){$selected=" SELECTED ";}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['NAME_RUS'];
    }
?>			   
				</SELECT>
			    </td>
		    	</tr>
		    </table>
		</div>
		<div id="tabs-2">
<?php
$result_ship_tmp=$db->query("SELECT * FROM `SHIP_TMP` WHERE `SESSION_ID`='?s'", session_id());
if ($data_request['ID_SHIP']==0 && $result_ship_tmp->getNumRows()==0){$aaa=1;}
if ($result_ship_tmp->getNumRows()>0)
    {
    $result_ship=$db->query("SELECT * FROM `SHIP_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_ship=$result_ship->fetch_assoc();
    $aaa=2;
    }
if ($data_request['ID_SHIP']>0 && $result_ship_tmp->getNumRows()==0)
    {
    $result_ship=$db->query("SELECT * FROM `SHIP` WHERE `ID`='?i'", $data_request['ID_SHIP']);
    $data_ship=$result_ship->fetch_assoc();
    $aaa=3;
    }
?>
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		        <tr>
			    <td align="right" colspan="2"><font class="main">Введите ИМО, позывной, рег. номер РМРС, РРР или MMSI судна<br> и нажмите кнопку &laquo;Далее&raquo;:</font></td>
			    <td align="left" colspan="2"><input type="text" id="numberShip" size="30">&nbsp;<button id="enterNumberShip">Далее</button>&nbsp;<button id="enterNewShip">Новая</button></td>
		        </tr>
		        <tr>
			    <td colspan="4"><hr></td>
		        </tr>
		    </table>
		    <div id="dataShip">
			<input type="hidden" id="request_id_ship" name="request_id_ship" value="<?php echo $data_request['ID_SHIP'];?>">
		        <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
			    <tr>
				<td align="left" style="width: 217px;"><font class="main">2.1 Название судна на русском языке:</font></td>
				<td align="left"><input type="text" size="25" class="Ship" id="ship_name_rus" name="ship_name_rus" value="<?php echo $data_ship['NAME_RUS']?>"></td>
				<td align="right"><font class="main">2.2 Название судна на английском языке:</font></td>
				<td align="left"><input type="text" size="25" class="Ship" id="ship_name_eng" name="ship_name_eng" value="<?php echo $data_ship['NAME_ENG']?>"></td>
		    	    </tr>
		    	    <tr>
				<td colspan="4">
				    <font class="main">2.3 Номер ИМО:</font> &nbsp; <input type="text" size="20" class="Ship" id="ship_imo" name="ship_imo" value="<?php echo $data_ship['IMO']?>"> &nbsp;&nbsp;
				    <font class="main">2.4 Позывной:</font> &nbsp; <input type="text" size="20" class="Ship" id="ship_call_sign" name="ship_call_sign" value="<?php echo $data_ship['CALL_SIGN']?>"> &nbsp;&nbsp;
				    <font class="main">2.5 MMSI:</font> &nbsp; <input type="text" size="20" class="Ship" id="ship_mmsi" name="ship_mmsi" value="<?php echo $data_ship['MMSI']?>">
				</td>
		    	    </tr>
		    	    <tr>
				<td align="left"><font class="main">2.6 Рег. номер РМРС:</font></td>
				<td align="left"><input type="text" size="25" class="Ship" id="ship_rmrs" name="ship_rmrs" value="<?php echo $data_ship['RMRS']?>"></td>
				<td align="right"><font class="main">2.7 Рег. номер РРР:</font></td>
				<td align="left"><input type="text" size="25" class="Ship" id="ship_rrr" name="ship_rrr" value="<?php echo $data_ship['RRR']?>"></td>
		    	    </tr>
			</table>
		    </div>
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
    		        <tr>
			    <td align="right" colspan="4">
			        <div id="saveShipDiv" style="position: relative; float: left;"></div>
			        <button id="saveShip">Сохранить</button>&nbsp;<button id="canselShip">Отменить</button>
			        <button id="editShip">Редактировать</button>
			    </td>
		    	</tr>
<?
if ($aaa==1){echo "<script type=\"text/javascript\">noneObj('Ship');</script>";}
if ($aaa==2){echo "<script type=\"text/javascript\">newEdit('Ship');</script>";}
if ($aaa==3){echo "<script type=\"text/javascript\">saveEdit('Ship');</script>";}
?>
		        <tr>
			    <td align="left"><font class="main">2.8 Флаг судна:</font></td>
			    <td align="left">
		                <SELECT style="width: 260px;" id="request_id_country" name="request_id_country">
                		    <OPTION value=0>Не выбран
<?
$result=$db->query("SELECT * FROM `DIC_COUNTRY`");
while ($data=$result->fetch_assoc())
    {
    if ($data_request['ID_COUNTRY']==$data['ID']){$selected=" SELECTED ";}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['NAME_RUS'];
    }
?>
				</SELECT>
			    </td>
			    <td align="right"><font class="main">2.9 Порт регистрации:</font></td>
			    <td align="left">
<?php
if ($data_request['ID_PORT']>0)
    {
    $result_port=$db->query("SELECT `NAME_RUS` FROM `DIC_PORT` WHERE ID='?i'", $data_request['ID_PORT']);
    $data_port=$result_port->fetch_assoc();
    $id_port_edit=""; $id_port_readonly="readonly"; $id_port_color="efefef";
    }
else {$id_port_edit="none"; $id_port_readonly=""; $id_port_color="ffffff";}
?>
				<input type="text" style="width: 180px; background: #<?php echo $id_port_color;?>;" id="request_name_port" name="request_name_port" <?php echo $id_port_readonly;?> value="<?php echo $data_port['NAME_RUS']?>">
				<input type="hidden" id="request_id_port" name="request_id_port" value="<?php echo $data_request['ID_PORT'];?>">
				<button id="request_id_port_edit" style="display:<?php echo $id_port_edit;?>;">Ред.</button>
			    </td>
		        </tr>
		        <tr>
			    <td align="left" style="width: 217px;"><font class="main">2.10 Тип судна:</font></td>
			    <td align="left" colspan="3">
		                <SELECT style="width: 500px;" id="request_id_ship_type" name="request_id_ship_type">
                		    <OPTION value=0>Не выбран
<?
$result=$db->query("SELECT * FROM `DIC_SHIP_TYPE`");
while ($data=$result->fetch_assoc())
    {
    if ($data_request['ID_SHIP_TYPE']==$data['ID']){$selected=" SELECTED ";}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['NAME_RUS'];
    }
?>
				</SELECT>
			    </td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.11 Класс.общество:</font></td>
			    <td align="left" colspan=3>
		                <SELECT style="width: 500px;" id="request_id_class_soc" name="request_id_class_soc">
		                    <OPTION value=0>Не выбран
<?php
$result=$db->query("SELECT * FROM `DIC_CLASS_SOC`");
while ($data=$result->fetch_assoc())
    {
    if ($data_request['ID_CLASS_SOC']==$data['ID']){$selected=" SELECTED ";}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['NAME_RUS'];
    }
?>
				</SELECT>
			    </td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.12 Класс судна:</font></td>
			    <td align="left"><input type="text" size="24" id="request_class" name="request_class"  value="<?php echo $data_request['CLASS'];?>"></td>
			    <td align="right"><font class="main">2.13 Категория<br> ледового усиления:</font></td>
			    <td align="left">
		                <SELECT style="width: 210px;" id="request_id_ice_cat" name="request_id_ice_cat">
		                    <OPTION value=0>Не выбрана
<?
$result=$db->query("SELECT * FROM `DIC_ICE_CATEGORY`");
$ice_cat_info="";
while ($data=$result->fetch_assoc())
    {
    if ($data_request['ID_ICE_CAT']==$data['ID']){$selected=" SELECTED "; $ice_cat_info=$data['NAME_RUS'];}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['ICE_CATEGORY'];
    }
?>
				</SELECT>
				<div class="ice_cat_info">?<div class="ice_cat_info_div" style="display: none; "><?php echo $ice_cat_info;?></div></div>
			    </td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.14 Длина наибольшая, м:</font></td>
			    <td align="left"><input type="text" size="10" id="request_vessel_length" name="request_vessel_length" value="<?php echo $data_request['VESSEL_LENGTH'];?>"></td>
			    <td align="right"><font class="main">2.15 Ширина наибольшая, м:</font></td>
			    <td align="left"><input type="text" size="10" id="request_vessel_width" name="request_vessel_width" value="<?php echo $data_request['VESSEL_WIDTH'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.16 Осадка максимальная, м:</font></td>
			    <td align="left"><input type="text" size="10" id="request_draght" name="request_draght" value="<?php echo $data_request['DRAGHT'];?>"></td>
			    <td align="right"><font class="main">2.17 Ширина ледового пояса, м:</font></td>
			    <td align="left"><input type="text" size="10" id="request_ice_belt_width" name="request_ice_belt_width" value="<?php echo $data_request['ICE_BELT_WIDTH'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.18 Валовая вместимость:</font></td>
			    <td align="left"><input type="text" size="10" id="request_gross_tonnage" name="request_gross_tonnage" value="<?php echo $data_request['GROSS_TONNAGE'];?>"></td>
			    <td align="right"><font class="main">2.19 Мощность главной энергетической установки в kW:</font></td>
			    <td align="left"><input type="text" size="10" id="request_engine_power" name="request_engine_power" value="<?php echo $data_request['ENGINE_POWER'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="3"><font class="main">2.20 Суточный расход топлива при следовании судна полным ходом на чистой воде <br>(в метрических тоннах):</font></td>
			    <td align="left"><input type="text" size="24" id="request_fuel_consumption" name="request_fuel_consumption" value="<?php echo $data_request['FUEL_CONSUMPTION'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">2.21 Особенности конструкции<br>носовой оконечности:</font></td>
			    <td align="left"><textarea cols="26" rows="5" id="request_bow_constr_detail" name="request_bow_constr_detail"><?php echo $data_request['BOW_CONSTR_DETAIL'];?></textarea></td>
			    <td align="right" valign="top"><font class="main">2.22 Особенности конструкции<br>кормовой оконечности:</font></td>
			    <td align="left"><textarea cols="27" rows="5" id="request_stern_constr_detail" name="request_stern_constr_detail"><?php echo $data_request['STERN_CONSTR_DETAIL'];?></textarea></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="2"><font class="main">2.23 Судовой спутниковый телефонный номер:</font></td>
			    <td align="left" colspan="2"><input type="text" size="53" id="request_vessel_phone" name="request_vessel_phone" value="<?php echo $data_request['VESSEL_PHONE'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="2"><font class="main">2.24 Номер судового факса:</font></td>
			    <td align="left" colspan="2"><input type="text" size="53" id="request_vessel_fax" name="request_vessel_fax" value="<?php echo $data_request['VESSEL_FAX'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="2"><font class="main">2.25 Адрес судовой электронной почты:</font></td>
			    <td align="left" colspan="2"><input type="text" size="53" id="request_vessel_email" name="request_vessel_email" value="<?php echo $data_request['VESSEL_EMAIL'];?>"></td>
		        </tr>
		    </table>
		</div>
		<div id="tabs-3">
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		        <tr>
			    <td colspan="4"><hr></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.1 Описание предполагаемого маршрута плавания (района и вида работ) в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3"><textarea cols="80" rows="5" id="request_route_desc" name="request_route_desc"><?php echo $data_request['ROUTE_DESC'];?></textarea></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.2 Предполагаемая дата начала плавания в акватории СМП:</font></td>
			    <td align="left" valign="top"><input type="text" size="20" id="request_exp_route_date_start" name="request_exp_route_date_start" value="<?php echo $data_request['EXP_ROUTE_DATE_START'];?>"></td>
			    <td align="right" valign="top"><font class="main">3.3 Предполагаемая дата окончания плавания в акватории СМП:</font></td>
			    <td align="left" valign="top"><input type="text" size="20" id="request_exp_route_date_end" name="request_exp_route_date_end" value="<?php echo $data_request['EXP_ROUTE_DATE_END'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.4 Последний порт захода перед плаванием в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3">
<?php
if ($data_request['ID_LAST_PORT']>0)
    {
    $result_last_port=$db->query("SELECT `NAME_RUS` FROM `DIC_PORT` WHERE ID='?i'", $data_request['ID_LAST_PORT']);
    $data_last_port=$result_last_port->fetch_assoc();
    $id_last_port_edit=""; $id_last_port_readonly="readonly"; $id_last_port_color="efefef";
    }
else {$id_last_port_edit="none"; $id_last_port_readonly=""; $id_last_port_color="ffffff";}
?>
				<input type="text" style="width: 530px; background: #<?php echo $id_last_port_color;?>;" id="request_name_last_port" name="request_name_last_port" <?php echo $id_last_port_readonly;?> value="<?php echo $data_last_port['NAME_RUS']?>">
				<input type="hidden" id="request_id_last_port" name="request_id_last_port" value="<?php echo $data_request['ID_LAST_PORT'];?>">
				<button id="request_id_last_port_edit" style="display:<?php echo $id_last_port_edit;?>;">Редактировать</button>
			    </td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.5 Первый порт захода перед плаванием в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3">
<?php
if ($data_request['ID_FIRST_PORT']>0)
    {
    $result_first_port=$db->query("SELECT `NAME_RUS` FROM `DIC_PORT` WHERE ID='?i'", $data_request['ID_FIRST_PORT']);
    $data_first_port=$result_first_port->fetch_assoc();
    $id_first_port_edit=""; $id_first_port_readonly="readonly"; $id_first_port_color="efefef";
    }
else {$id_first_port_edit="none"; $id_first_port_readonly=""; $id_first_port_color="ffffff";}
?>
				<input type="text" style="width: 530px; background: #<?php echo $id_first_port_color;?>;" id="request_name_first_port" name="request_name_first_port" <?php echo $id_first_port_readonly;?> value="<?php echo $data_first_port['NAME_RUS']?>">
				<input type="hidden" id="request_id_first_port" name="request_id_first_port" value="<?php echo $data_request['ID_FIRST_PORT'];?>">
				<button id="request_id_first_port_edit" style="display:<?php echo $id_first_port_edit;?>;">Редактировать</button>
			    </td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.6 Предполагаемое количество членов экипажа на борту:</font></td>
			    <td align="left" valign="top"><input type="text" size="20" id="request_exp_crue_qty" name="request_exp_crue_qty" value="<?php echo $data_request['EXP_CRUE_QTY'];?>"></td>
			    <td align="right" valign="top"><font class="main">3.7 Предполагаемое количество пассажиров на борту:</font></td>
			    <td align="left" valign="top"><input type="text" size="20" id="request_exp_passenger_qty" name="request_exp_passenger_qty" value="<?php echo $data_request['EXP_PASSENGER_QTY'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.8 Тип перевозимого груза:</font></td>
			    <td align="left" valign="top" colspan="3"><textarea cols="80" rows="3" id="request_cargo_type" name="request_cargo_type"><?php echo $data_request['CARGO_TYPE'];?></textarea></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.9 Планируемое количество (в метрических тоннах) перевозимого груза:</font></td>
			    <td align="left" valign="top" colspan="3"><textarea cols="80" rows="3" id="request_cargo_qty" name="request_cargo_qty"><?php echo $data_request['CARGO_QTY'];?></textarea></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.10 Класс опасного груза:</font></td>
			    <td align="left" valign="top" colspan="3"><input type="text" size="78" id="request_dang_class" name="request_dang_class" value="<?php echo $data_request['DANG_CLASS'];?>"></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.11 Планируемое количество (в метрических тоннах) перевозимого опасного груза:</font></td>
			    <td align="left" valign="top" colspan="3"><textarea cols="80" rows="3" id="request_dang_qty" name="request_dang_qty"><?php echo $data_request['DANG_QTY'];?></textarea></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.12 Наличие у капитана стажа плавания во льдах в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3"><textarea cols="80" rows="3" id="request_ice_nav_experience" name="request_ice_nav_experience"><?php echo $data_request['ICE_NAV_EXPERIENCE'];?></textarea></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.13 Информация о буксируемом объекте:</font></td>
			    <td align="left" valign="top" colspan="3"><textarea cols="80" rows="3" id="request_tug_object_desc" name="request_tug_object_desc"><?php echo $data_request['TUG_OBJECT_DESC'];?></textarea></td>
		        </tr>
		    </table>
		</div>
		<div id="tabs-4">
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
			<tr>
			    <td colspan="2" align="right"><font class="main">Введите фрагмент фамилии заявителя и нажмите кнопку &laquo;Далее&raquo;:</font></td>
			    <td colspan="2" align="left"><input type="text" size="15" id="numberPerson">&nbsp;<button id="enterNumberPerson">Далее</button>&nbsp;<button id="enterNewPerson">Новая</button></td>
		        </tr>
		        <tr>
			    <td colspan="4"><hr></td>
		        </tr>
		    </table>
<?php
//"
$result_person_tmp=$db->query("SELECT * FROM `PERSON_TMP` WHERE `SESSION_ID`='?s'", session_id());
if ($data_request['ID_PERSON']==0 && $result_person_tmp->getNumRows()==0){$aaa=1;}
if ($result_person_tmp->getNumRows()>0)
    {
    $result_person=$db->query("SELECT * FROM `PERSON_TMP` WHERE `SESSION_ID`='?s'", session_id());
    $data_person=$result_person->fetch_assoc();
    $aaa=2;
    }
if ($data_request['ID_PERSON']>0 && $result_person_tmp->getNumRows()==0)
    {
    $result_person=$db->query("SELECT * FROM `PERSON` WHERE `ID`='?i'", $data_request['ID_PERSON']);
    $data_person=$result_person->fetch_assoc();
    $aaa=3;
    }
?>
		    <div id="dataPerson">
			<input type="hidden" id="request_id_person" name="request_id_person" value="<?php echo $data_request['ID_PERSON'];?>">
		        <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
			    <tr>
			        <td align="left"><font class="main">4.1 Полные ФИО заявителя на русском языке:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_name_rus" name="person_name_rus" value="<?php echo $data_person['NAME_RUS'];?>"></td>
			        <td align="right"><font class="main">4.2 Краткие ФИО заявителя на русском языке:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_shortname_rus" name="person_shortname_rus" value="<?php echo $data_person['SHORTNAME_RUS'];?>"></td>
			    </tr>
			    <tr>
			        <td align="left"><font class="main">4.3 Полные ФИО заявителя на английском языке:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_name_eng" name="person_name_eng" value="<?php echo $data_person['NAME_ENG'];?>"></td>
			        <td align="right"><font class="main">4.4 Краткие ФИО заявителя на английском языке:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_shortname_eng" name="person_shortname_eng" value="<?php echo $data_person['SHORTNAME_ENG'];?>"></td>
			    </tr>
			    <tr>
			        <td align="left"><font class="main">4.5 Телефон заявителя:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_phone" name="person_phone" value="<?php echo $data_person['PHONE'];?>"></td>
				<td align="right"><font class="main">4.6 Факс заявителя:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_fax" name="person_fax" value="<?php echo $data_person['FAX'];?>"></td>
			    </tr>
		    	    <tr>	
				<td align="left"><font class="main">4.7 Email заявителя:</font></td>
				<td align="left"><input type="text" size="20" class="Person" id="person_email" name="person_email" value="<?php echo $data_person['EMAIL'];?>"></td>
		    	    </tr>
			</table>		    
		    </div>
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
    		        <tr>
			    <td align="right" colspan="2">
			        <div id="savePersonDiv" style="position: relative; float: left;"></div>
			        <button id="savePerson">Сохранить</button>&nbsp;<button id="canselPerson">Отменить</button>
			        <button id="editPerson">Редактировать</button>
			    </td>
		    	</tr>
<?
if ($aaa==1){echo "<script type=\"text/javascript\">noneObj('Person');</script>";}
if ($aaa==2){echo "<script type=\"text/javascript\">newEdit('Person');</script>";}
if ($aaa==3){echo "<script type=\"text/javascript\">saveEdit('Person');</script>";}
?>
		        <tr>	
		            <td align="left" width="260"><font class="main">4.8 Должность заявителя:</font></td>
			    <td align="left">
			        <SELECT name="request_id_signer_post" id="request_id_signer_post">
				    <OPTION value=0>Не выбрана
<?php
$result=$db->query("SELECT * FROM `DIC_POST`");
while ($data=$result->fetch_assoc())
    {
    if ($data_request['ID_SIGNER_POST']==$data['ID']){$selected=" SELECTED ";}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['NAME_RUS'];
    }
?>
				</SELECT>
			    </td>
		    	</tr>
		    </table>		    
		</div>
	    </div>
	</td>
    </tr>
    <tr>
	<td colspan="4" align="left"><h1>ПРИЛОЖЕННЫЕ ДОКУМЕНТЫ К ЗАЯВКЕ:</h1></td>
    </tr>
    <tr>
	<td colspan="4">
	    <div style="text-align: center;">
    		<div style="width: 920px; margin: 10px auto;">
	            <form>
	                <div id="queue"></div>
	        	<table>
	        	    <tr>
	        		<td>
				    <font class="main">Тип файла:</font>&nbsp;
				    <SELECT style="width: 500px;"  name="document_id_doc_type" id="document_id_doc_type">
					<OPTION value=0>Не выбран
<?php
$result=$db->query("SELECT * FROM `DIC_DOC_TYPE`");
while ($data=$result->fetch_assoc())
    {
    echo "<OPTION value=\"".$data['ID']."\">".$data['NAME_RUS'];
    }
?>
				    </SELECT>
				</td>
			    	<td>
<script type="text/javascript" >
    $(function(){
        var btnUpload=$('#upload');
        var status=$('#status');
        new AjaxUpload(btnUpload, {
            action: '/docs/upload-file.php?req_id=<?php echo $data_request['ID'];?>&uploaddir=<?php echo $uploaddir ?>',
            name: 'uploadfile',
            onSubmit: function(file, ext){
                status.text('Uploading...');
                },
            onComplete: function(file)
        	{
        	status.text('');
        	$('#list').load('/docs/files.php?id=<?php echo $data_request['ID'];?>&type_id='+$('#document_id_doc_type').val());
        	}
            });
        });
</script>
				    <div id="upload" ><span class=upload_bt>Загрузить файл<span></div><span id="status" ></span>
		                    <ul id="files" ></ul>
    	            		</td>
	            	    </tr>
	            	</table>
	            </form>
	        </div>
	        <div id="list" style="text-align: left;">
<?php
if ($_SESSION['tmp']==1){$result=$db->query("SELECT * FROM `DOCUMENT_TMP` WHERE REQ_ID='?i%'", $data_request['ID']);}
else
    {
    $result=$db->query("SELECT `DOCUMENT`.`ID` AS ID, `DOCUMENT`.`ID_DOC_TYPE` AS ID_DOC_TYPE, `DOCUMENT`.`URI` AS URI  FROM `DOCUMENT` 
			    LEFT JOIN `LNK_DOC_REQUEST` ON `LNK_DOC_REQUEST`.`ID_DOCUMENT`=`DOCUMENT`.`ID` WHERE `LNK_DOC_REQUEST`.`ID_REQUEST`='?i'", $data_request['ID']);
    }
echo "<ul style=\"list-style: none;\">";
while ($data=$result->fetch_assoc())
    {
    echo "<li style=\"margin: 5px;\" id=\"".$data['ID']."\">
	    <SELECT style=\"width: 500px;\" onChange=\"saveSel(".$data['ID'].",this.value);\">
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
?>	        
	        </div>
	    </div>
	</td>
    </tr>
    <tr>
	<td colspan="4"><hr><div id="request_save"></div></td>
    </tr>
<?php
if ($_SESSION['tmp']==1)
    {
?>
    <tr>
	<td colspan="2" align="right"><button id="addRequestBt">Сформировать</button></td>
	<td colspan="2" align="left"><button id="clearRequestBt">Очистить</button></td>
    </tr>
<?php 
    } 
else 
    {
    if ($data_request['DISPLAY_FLAG']==1){$display_flag0=""; $display_flag1=" SELECTED ";}
    else{$display_flag0=" SELECTED "; $display_flag1="";}
    if ($data_request['LANG_SOL']==1){$lang_sol2=""; $lang_sol1=" SELECTED ";}
    else{$lang_sol2=" SELECTED "; $lang_sol1="";}

?> 
    <tr>	
        <td align="left"><font class="main">Отображать заявку на сайте:</font></td>
        <td align="left" colspan="3">
            <SELECT name="request_display_flag" id="request_display_flag">
	        <OPTION value=1 <?php echo $display_flag1; ?>>Отображать
	        <OPTION value=0<?php echo $display_flag0; ?>>Не отображать
	    </SELECT>
	</td>
    </tr>
    <tr>	
        <td align="left"><font class="main">Статус заявки:</font></td>
        <td align="left" colspan="3">
            <SELECT name="request_solution" id="request_solution">
	        <OPTION value=0>Новая
<?php
$result=$db->query("SELECT * FROM `DIC_SOLUTION_TYPE`");
while ($data=$result->fetch_assoc())
    {
    if ($data_request['SOLUTION']==$data['ID']){$selected=" SELECTED ";}
    else {$selected="";}
    echo "<OPTION value=\"".$data['ID']."\"".$selected.">".$data['NAME_RUS'];
    }
?>
	    </SELECT>
	</td>
    </tr>
    <tr>	
        <td align="left"><font class="main">Язык документа решения:</font></td>
        <td align="left" colspan="3">
            <SELECT name="request_lang_sol" id="request_lang_sol">
	        <OPTION value=1 <?php echo $lang_sol1; ?>>Русский
	        <OPTION value=2<?php echo $lang_sol2; ?>>Русский\Английский
	    </SELECT>
	</td>
    </tr>
    <tr><td colspan="4" align="left"><h1><a href="/"><<НАЗАД</a></h1></td></tr>
<?php }?>
</table>
