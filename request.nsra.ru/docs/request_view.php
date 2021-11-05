<?php
$result=$db->query("SELECT * FROM `REQUEST` WHERE `ID`='?i'", $_GET['id']);
$data_request=$result->fetch_assoc();
?>
<br>
<h1 align="center">Форма заявления</h1>
<br>
<table cellspacing="0" cellpadding="0" border="0" width="1000" align="center">
    <tr>
	<td align="left" width="300"><font class="main">Порядковый номер заявки в системе АСМП:</font></td>
	<td align="left" width="300"><b><?php echo $data_request['ASMP_NUM'];?></td>
	<td align="right"><font class="main">Дата поступления заявки:</font></td>
	<td align="left"><b><?php echo $data_request['REQ_DATE_CREATE'];?></td>
    </tr>
    <tr>
	<td align="left"><font class="main">Исходящий № заявителя:</font></td>
	<td align="left"><b><?php echo $data_request['REQ_NUM'];?></td>
	<td align="right"><font class="main">Дата заявления:</font></td>
	<td align="left"><b><?php echo $data_request['REQ_DATE'];?></td>
    </tr>
    <tr>
	<td align="left"><font class="main">Входящий номер заявления:</font></td>
	<td align="left"><b><?php echo $data_request['REQ_NUM_RCPT'];?></td>
	<td align="right"><font class="main">Дата обработки заявки:</font></td>
	<td align="left"><b><?php echo $data_request['DATE_SOLUTION'];?></td>
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
<?php
$result_company=$db->query("SELECT * FROM `COMPANY` WHERE `ID`='?i'", $data_request['ID_COMPANY']);
$data_company=$result_company->fetch_assoc();
?>
			<table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.1 Название компании на русском языке:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['NAME_RUS'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.2 Название компании на английском языке:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['NAME_ENG'];?></td>
			    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.3 Адрес компании на русском языке:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['ADDRESS_RUS'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.4 Адрес компании на английском языке:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['ADDRESS_ENG'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.5 Телефон компании:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['PHONE'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.6 Факс компании:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['FAX'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.7 Email адрес компании:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['EMAIL'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.8 Должность руководителя компании:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['HEAD_POST'];?></td>
		    	    </tr>
		    	    <tr>
				<td align="left" valign="top"><font class="main">1.9 ФИО руководителя компании:</font></td>
				<td align="left" valign="top"><b><?php echo $data_company['HEAD_NAME'];?></td>
		    	    </tr>
			</table>
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		    	<tr>
			    <td align="left" valign="top" width="314"><font class="main">1.10 Роль компании по отношению к судну:</font></td>
			    <td align="left" valign="top">
<?php
$result=$db->query("SELECT * FROM `DIC_ROLE` WHERE `ID`='?i'", $data_request['ID_ROLE']);
$data=$result->fetch_assoc();
echo "<b>".$data['NAME_RUS'];
?>			   
			    </td>
		    	</tr>
		    </table>
		</div>
		<div id="tabs-2">
<?php
$result_ship=$db->query("SELECT * FROM `SHIP` WHERE `ID`='?i'", $data_request['ID_SHIP']);
$data_ship=$result_ship->fetch_assoc();
?>
		        <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
			    <tr>
				<td align="left" style="width: 217px;"><font class="main">2.1 Название судна на русском языке:</font></td>
				<td align="left"><b><?php echo $data_ship['NAME_RUS']?></td>
				<td align="right"><font class="main">2.2 Название судна на английском языке:</font></td>
				<td align="left"><b><?php echo $data_ship['NAME_ENG']?></td>
		    	    </tr>
		    	    <tr>
				<td colspan="4">
				    <font class="main">2.3 Номер ИМО:</font> &nbsp;<b><?php echo $data_ship['IMO']?> &nbsp;&nbsp;
				    <font class="main">2.4 Позывной:</font> &nbsp;<b><?php echo $data_ship['CALL_SIGN']?> &nbsp;&nbsp;
				    <font class="main">2.5 MMSI:</font> &nbsp;<b><?php echo $data_ship['MMSI']?>
				</td>
		    	    </tr>
		    	    <tr>
				<td align="left"><font class="main">2.6 Рег. номер РМРС:</font></td>
				<td align="left"><b><?php echo $data_ship['RMRS']?></td>
				<td align="right"><font class="main">2.7 Рег. номер РРР:</font></td>
				<td align="left"><b><?php echo $data_ship['RRR']?></td>
		    	    </tr>
			</table>
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		        <tr>
			    <td align="left"><font class="main">2.8 Флаг судна:</font></td>
			    <td align="left">
<?
$result=$db->query("SELECT * FROM `DIC_COUNTRY` WHERE `ID`='?i'",$data_request['ID_COUNTRY']);
$data=$result->fetch_assoc();
echo "<b>".$data['NAME_RUS'];
?>
			    </td>
			    <td align="right"><font class="main">2.9 Порт регистрации:</font></td>
			    <td align="left">
<?php
$result_port=$db->query("SELECT `NAME_RUS` FROM `DIC_PORT` WHERE ID='?i'", $data_request['ID_PORT']);
$data_port=$result_port->fetch_assoc();
echo "<b>".$data_port['NAME_RUS'];
?>
			    </td>
		        </tr>
		        <tr>
			    <td align="left" style="width: 217px;"><font class="main">2.10 Тип судна:</font></td>
			    <td align="left" colspan="3">
<?
$result=$db->query("SELECT * FROM `DIC_SHIP_TYPE` WHERE `ID`='?i'",$data_request['ID_SHIP_TYPE']);
$data=$result->fetch_assoc();
echo "<b>".$data['NAME_RUS'];
?>
			    </td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.11 Класс.общество:</font></td>
			    <td align="left" colspan=3>
<?php
$result=$db->query("SELECT * FROM `DIC_CLASS_SOC` WHERE `ID`='?i'",$data_request['ID_CLASS_SOC']);
$data=$result->fetch_assoc();
echo "<b>".$data['NAME_RUS'];
?>
			    </td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.12 Класс судна:</font></td>
			    <td align="left"><b><?php echo $data_request['CLASS'];?></td>
			    <td align="right"><font class="main">2.13 Категория<br> ледового усиления:</font></td>
			    <td align="left">
<?
$result=$db->query("SELECT * FROM `DIC_ICE_CATEGORY` WHERE `ID`='?i'",$data_request['ID_ICE_CAT']);
$data=$result->fetch_assoc();
echo "<b>".$data['ICE_CATEGORY'];
?>
				<div class="ice_cat_info">?<div class="ice_cat_info_div" style="display: none; "><?php echo $data['NAME_RUS'];?></div></div>
			    </td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.14 Длина наибольшая, м:</font></td>
			    <td align="left"><b><?php echo $data_request['VESSEL_LENGTH'];?></td>
			    <td align="right"><font class="main">2.15 Ширина наибольшая, м:</font></td>
			    <td align="left"><b><?php echo $data_request['VESSEL_WIDTH'];?></td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.16 Осадка максимальная, м:</font></td>
			    <td align="left"><b><?php echo $data_request['DRAGHT'];?></td>
			    <td align="right"><font class="main">2.17 Ширина ледового пояса, м:</font></td>
			    <td align="left"><b><?php echo $data_request['ICE_BELT_WIDTH'];?></td>
		        </tr>
		        <tr>
			    <td align="left"><font class="main">2.18 Валовая вместимость:</font></td>
			    <td align="left"><b><?php echo $data_request['GROSS_TONNAGE'];?></td>
			    <td align="right"><font class="main">2.19 Мощность главной энергетической установки в kW:</font></td>
			    <td align="left"><b><?php echo $data_request['ENGINE_POWER'];?></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="3"><font class="main">2.20 Суточный расход топлива при следовании судна полным ходом на чистой воде <br>(в метрических тоннах):</font></td>
			    <td align="left"><b><?php echo $data_request['FUEL_CONSUMPTION'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">2.21 Особенности конструкции<br>носовой оконечности:</font></td>
			    <td align="left"><b><?php echo $data_request['BOW_CONSTR_DETAIL'];?></td>
			    <td align="right" valign="top"><font class="main">2.22 Особенности конструкции<br>кормовой оконечности:</font></td>
			    <td align="left"><b><?php echo $data_request['STERN_CONSTR_DETAIL'];?></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="2"><font class="main">2.23 Судовой спутниковый телефонный номер:</font></td>
			    <td align="left" colspan="2"><b><?php echo $data_request['VESSEL_PHONE'];?></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="2"><font class="main">2.24 Номер судового факса:</font></td>
			    <td align="left" colspan="2"><b><?php echo $data_request['VESSEL_FAX'];?></td>
		        </tr>
		        <tr>
			    <td align="left" colspan="2"><font class="main">2.25 Адрес судовой электронной почты:</font></td>
			    <td align="left" colspan="2"><b><?php echo $data_request['VESSEL_EMAIL'];?></td>
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
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['ROUTE_DESC'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.2 Предполагаемая дата начала плавания в акватории СМП:</font></td>
			    <td align="left" valign="top"><b><?php echo $data_request['EXP_ROUTE_DATE_START'];?></td>
			    <td align="right" valign="top"><font class="main">3.3 Предполагаемая дата окончания плавания в акватории СМП:</font></td>
			    <td align="left" valign="top"><b><?php echo $data_request['EXP_ROUTE_DATE_END'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.4 Последний порт захода перед плаванием в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3">
<?php
$result_last_port=$db->query("SELECT `NAME_RUS` FROM `DIC_PORT` WHERE ID='?i'", $data_request['ID_LAST_PORT']);
$data_last_port=$result_last_port->fetch_assoc();
echo "<b>".$data_last_port['NAME_RUS'];
?>
			    </td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.5 Первый порт захода перед плаванием в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3">
<?php
$result_first_port=$db->query("SELECT `NAME_RUS` FROM `DIC_PORT` WHERE ID='?i'", $data_request['ID_FIRST_PORT']);
$data_first_port=$result_first_port->fetch_assoc();
echo "<b>".$data_first_port['NAME_RUS'];
?>
			    </td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.6 Предполагаемое количество членов экипажа на борту:</font></td>
			    <td align="left" valign="top"><b><?php echo $data_request['EXP_CRUE_QTY'];?></td>
			    <td align="right" valign="top"><font class="main">3.7 Предполагаемое количество пассажиров на борту:</font></td>
			    <td align="left" valign="top"><b><?php echo $data_request['EXP_PASSENGER_QTY'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.8 Тип перевозимого груза:</font></td>
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['CARGO_TYPE'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.9 Планируемое количество (в метрических тоннах) перевозимого груза:</font></td>
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['CARGO_QTY'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.10 Класс опасного груза:</font></td>
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['DANG_CLASS'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.11 Планируемое количество (в метрических тоннах) перевозимого опасного груза:</font></td>
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['DANG_QTY'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.12 Наличие у капитана стажа плавания во льдах в акватории СМП:</font></td>
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['ICE_NAV_EXPERIENCE'];?></td>
		        </tr>
		        <tr>
			    <td align="left" valign="top"><font class="main">3.13 Информация о буксируемом объекте:</font></td>
			    <td align="left" valign="top" colspan="3"><b><?php echo $data_request['TUG_OBJECT_DESC'];?></td>
		        </tr>
		    </table>
		</div>
		<div id="tabs-4">
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
			<tr>
			    <td colspan="2" align="right"><font class="main">Введите фрагмент фамилии заявителя и нажмите кнопку &laquo;Далее&raquo;:</font></td>
			    <td colspan="2" align="left"><input type="text" size="15" id="namePerson">&nbsp;<button id="enterNamePerson">Далее</button>&nbsp;<button id="enterNewPerson">Новая</button></td>
		        </tr>
		        <tr>
			    <td colspan="4"><hr></td>
		        </tr>
		    </table>
<?php
$result_person=$db->query("SELECT * FROM `PERSON` WHERE `ID`='?i'", $data_request['ID_PERSON']);
$data_person=$result_person->fetch_assoc();
?>
		        <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
			    <tr>
			        <td align="left"><font class="main">4.1 Полные ФИО заявителя на русском языке:</font></td>
				<td align="left"><b><?php echo $data_person['NAME_RUS'];?></td>
			        <td align="right"><font class="main">4.2 Краткие ФИО заявителя на русском языке:</font></td>
				<td align="left"><b><?php echo $data_person['SHORTNAME_RUS'];?></td>
			    </tr>
			    <tr>
			        <td align="left"><font class="main">4.3 Полные ФИО заявителя на английском языке:</font></td>
				<td align="left"><b><?php echo $data_person['NAME_ENG'];?></td>
			        <td align="right"><font class="main">4.4 Краткие ФИО заявителя на английском языке:</font></td>
				<td align="left"><b><?php echo $data_person['SHORTNAME_ENG'];?></td>
			    </tr>
			    <tr>
			        <td align="left"><font class="main">4.5 Телефон заявителя:</font></td>
				<td align="left"><b><?php echo $data_person['PHONE'];?></td>
				<td align="right"><font class="main">4.6 Факс заявителя:</font></td>
				<td align="left"><b><?php echo $data_person['FAX'];?></td>
			    </tr>
		    	    <tr>	
				<td align="left"><font class="main">4.7 Email заявителя:</font></td>
				<td align="left"><b><?php echo $data_person['EMAIL'];?></td>
		    	    </tr>
			</table>		    
		    <table cellspacing="0" cellpadding="0" border="0" width="950" align="center">
		        <tr>	
		            <td align="left" width="260"><font class="main">4.8 Должность заявителя:</font></td>
			    <td align="left">
<?php
$result=$db->query("SELECT * FROM `DIC_POST` WHERE `ID`='?i'",$data_request['ID_SIGNER_POST']);
$data=$result->fetch_assoc();
echo "<b>".$data['NAME_RUS'];
?>
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
	        <div id="list" style="text-align: left;">
<?php
$result=$db->query("SELECT `DOCUMENT`.`ID_DOC_TYPE` AS ID_DOC_TYPE, `DOCUMENT`.`URI` AS URI FROM `LNK_DOC_REQUEST` LEFT JOIN `DOCUMENT` ON `DOCUMENT`.`ID`=`LNK_DOC_REQUEST`.`ID_DOCUMENT` WHERE `LNK_DOC_REQUEST`.`ID_REQUEST`='?i%'", $data_request['ID']);
echo "<table>";
while ($data=$result->fetch_assoc())
    {
    echo "<tr>";
    $result_type=$db->query("SELECT * FROM `DIC_DOC_TYPE` WHERE `ID`='?i'", $data['ID_DOC_TYPE']);
    $data_type=$result_type->fetch_assoc();
    echo "<td>".$data_type['NAME_RUS'].":</td>";
    echo "<td><a href=\"".$files_doc.$data['URI']."\">".$data['URI']."</a></td></tr>";
    }
echo "</table>";
?>	        
	        </div>
	    </div>
	</td>
    </tr>
</table>
<h1><a href="/"><<НАЗАД</a></h1>
