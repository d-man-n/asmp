<script type="text/javascript">
    function remArticle(id, num, type)
        {
        $('#dataArticle'+num).load("/docs/article.php?event=dataArticle&del=1&id="+id+"&num="+num+"&type="+type);
        }
</script>
                                                                                                                                                                                                                                                                                            
<?php
$result=$db->query("SELECT * FROM `REQUEST` WHERE `ID`='?i'", $_GET['id']);
$data_request=$result->fetch_assoc();
$_SESSION['req_id']=$data_request['ID'];
$result_ship=$db->query("SELECT * FROM `SHIP` WHERE `ID`='?i'", $data_request['ID_SHIP']);
$data_ship=$result_ship->fetch_assoc();
$result_company=$db->query("SELECT * FROM `COMPANY` WHERE `ID`='?i'", $data_request['ID_COMPANY']);
$data_company=$result_company->fetch_assoc();
$result_flag=$db->query("SELECT * FROM `DIC_COUNTRY` WHERE `ID`='?i'", $data_request['ID_COUNTRY']);
$data_flag=$result_flag->fetch_assoc();
$result_ice=$db->query("SELECT * FROM `DIC_ICE_CATEGORY` WHERE `ID`='?i'", $data_request['ID_ICE_CAT']);
$data_ice=$result_ice->fetch_assoc();
$result_sol=$db->query("SELECT * FROM `SOLUTION` WHERE `ID_REQUEST`='?i'", $data_request['ID']);
$data_sol=$result_sol->fetch_assoc();
$_SESSION['sol_id']=$data_sol['ID'];
$result_sol_doc=$db->query("SELECT `DOCUMENT`.`URI` AS URI FROM `LNK_DOC_SOLUTION` LEFT JOIN `DOCUMENT` ON `LNK_DOC_SOLUTION`.`ID_DOCUMENT`=`DOCUMENT`.`ID` WHERE `LNK_DOC_SOLUTION`.`IS_DELETED`=0 AND `LNK_DOC_SOLUTION`.`ID_SOLUTION`='?i'", $data_sol['ID']);
$data_sol_doc=$result_sol_doc->fetch_assoc();

if ($data_request['SOLUTION']==3)
    {
    $result_sol_art1=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`  
				LEFT JOIN `DIC_ARTICLE`	ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE` 
				WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $data_sol['ID']);
    $article1="<ul id=sortable1 style=\"list-style: none;\">";
    while ($data_sol_art1=$result_sol_art1->fetch_assoc()){$article1=$article1."<li id=".$data_sol_art1['ID']." style=\"margin-top: 5px;\"><button onclick=\"remArticle(".$data_sol_art1['ID'].", 1, 1);\">X</button> ".$data_sol_art1['TEXT_RUS']." (".$data_sol_art1['TEXT_ENG'].")</li>";}
    $article1=$article1."</ul><p id=info1>&nbsp;</p>";
    }
else
    {
    $result_sol_art1=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`  
				LEFT JOIN `DIC_ARTICLE`	ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE` 
				WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' AND `DIC_ARTICLE`.`TYPE`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $data_sol['ID'], 2);
    $article1="<ul id=sortable style=\"list-style: none;\">";
    while ($data_sol_art1=$result_sol_art1->fetch_assoc()){$article1=$article1."<li id=".$data_sol_art1['ID']." style=\"margin-top: 5px;\"><button onclick=\"remArticle(".$data_sol_art1['ID'].", 1, 2);\">X</button> ".$data_sol_art1['TEXT_RUS']." (".$data_sol_art1['TEXT_ENG'].")</li>";}
    $article1=$article1."</ul><p id=info1>&nbsp;</p>";
    $result_sol_art2=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`  
				LEFT JOIN `DIC_ARTICLE`	ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE` 
				WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' AND `DIC_ARTICLE`.`TYPE`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $data_sol['ID'], 3);
    $article2="<ul id=sortable2 style=\"list-style: none;\">";
    while ($data_sol_art2=$result_sol_art2->fetch_assoc()){$article2=$article2."<li id=".$data_sol_art2['ID']." style=\"margin-top: 5px;\"><button onclick=\"remArticle(".$data_sol_art2['ID'].", 2, 3);\">X</button> ".$data_sol_art2['TEXT_RUS']." (".$data_sol_art2['TEXT_ENG'].")</li>";}
    $article2=$article2."</ul><p id=info2>&nbsp;</p>";
    
    }


function dataArticle($num, $type)
    {
    global $article1;
    global $article2;
    if ($num==1){$article=$article1;}
    elseif ($num==2){$article=$article2;}
    echo "<div id=\"dataArticle".$num."\">".$article."</div>
	    <input type=\"text\" id=\"numberArticle".$num."\" size=\"90\">&nbsp;<button id=\"enterNumberArticle".$num."\">Далее</button>&nbsp;<button id=\"enterNewArticle".$num."\">Новая</button></p>
	    <div id=\"addArticle".$num."\">
		<input type=hidden id=\"article_type".$num."\" value=".$type.">
		<table>
		    <tr>
		        <td><font class=main>Текст на русском:</font></td>
		        <td><input type=text id=\"article_text_rus".$num."\" size=\"90\"></td>
		    </tr><tr>
		        <td><font class=main>Текст на английском:</font></td>
		        <td><input type=text id=\"article_text_eng".$num."\" size=\"90\"></td>
		    </tr>
		</table>
		<button id=\"saveArticle".$num."\">Сохранить</button>&nbsp;<button id=\"canselArticle".$num."\">Отменить</button>
	    </div>
	    <p></p>
	    <script type=\"text/javascript\">noneArticle(".$num.");</script>";
    }

    
?>
<p></p>
<div style="position: relative; width: 900px; margin: 0 auto; padding: 10px; border: 1px solid #000000;">
<div style="position: relative; width: 100px; margin: 0 auto;"><img src="/images/logo.png" width=70></div>
<p align=center>МИНИСТЕРСТВОТРАНСПОРТАРОССИЙСКОЙФЕДЕРАЦИИ<br>
<?if ($data_request['LANG_SOL']==2){echo "MINISTRY OF TRANSPORT OF THE RUSSIAN FEDERATION<br><br>";}?>
ФЕДЕРАЛЬНОЕ АГЕНСТВО МОРСКОГО И РЕЧНОГО ТРАНСПОРТА<br>
<?if ($data_request['LANG_SOL']==2){echo "FEDERAL AGENCY OF MARITIME AND RIVER TRANSPORT<br><br>";}?>
ФЕДЕРАЛЬНОЕ ГОСУДАРСТВЕННОЕ КАЗЕННОЕ УЧРЕЖДЕНИЕ<br>
<?if ($data_request['LANG_SOL']==2){echo "FEDERALSTATEINSTITUTION<br><br>";}?>
<font style="font: bold 25px times;">Администрация Северного морского пути</font>
<?if ($data_request['LANG_SOL']==2){echo "<br><font style=\"font: normal 20px times;\">The Northern Sea Route Administration</font>";}?>
</p>
<?if ($data_request['SOLUTION']==1 || $data_request['SOLUTION']==2){?>
<p align=center><font style="font: bold 25px times;">Р А З Р Е Ш Е Н И Е № <input type="text" id="solution_num" name="solution_num" value="<?echo $data_sol['SOLUTION_NUM'];?>" style="width: 100px; height: 30px;"></font>
<?
//"
if ($data_request['LANG_SOL']==2){echo "<br><font style=\"font: normal 20px times;\">P E R M I S S I O N</font>";}?>
</p>
<p align=center>на плавание в акватории Северного морского пути судна (судов)<br>
категории ледовых усилений <?echo $data_ice['ICE_CATEGORY'];?>
<?if ($data_request['LANG_SOL']==2){echo "<br>for the ice strengthening category ".$data_ice['ICE_CATEGORY']." ship(s) to navigate in the water area of the Northern Sea Route";}?>
</p>

<p align=center>Выдано: в соответствии с Правилами плавания в акватории Северного морского пути, 2013 г.,
<?if ($data_request['LANG_SOL']==2){echo "<br>The permission is issued according to the Rules of the navigation in the water area of the Northern Sea Route, 2013";}?>
</p>

<p align=center>на основании заявления от <?echo $data_request['REQ_DATE'];?> № <?echo $data_request['REQ_NUM'];?> <?echo $data_company['NAME_RUS'];?> 
<?if ($data_request['LANG_SOL']==2){echo "<br>basedonthe applicationdatedfrom thе ".$data_request['REQ_DATE']." № ".$data_request['REQ_NUM']." ".$data_company['NAME_ENG'];}?>
</p>

<?}else{?>
<p align=center><font style="font: bold 25px times;">У В Е Д О М Л Е Н И Е № <input type="text" id="solution_num" name="solution_num" value="<?echo $data_sol['SOLUTION_NUM'];?>" style="width: 100px; height: 30px;"></font>
<?
//"
if ($data_request['LANG_SOL']==2){echo "<br><font style=\"font: normal 20px times;\">NOTIFICATION</font>";}?>
</p>

<p align=center>об отказе выдачи разрешения на плавание судна<br>
в акватории Северного морского пути
<?if ($data_request['LANG_SOL']==2){echo "<br>of refusal to obtain the permission to navigate in the water area of the Northern Sea Route";}?>
</p>

<p align=center>Выдано: в соответствии с Правилами плавания в акватории Северного морского пути, 2013 г.,
<?if ($data_request['LANG_SOL']==2){echo "<br>The notification is issued in accordance with the Rules of navigation in the water area of the<br>Northern Sea Route, 2013";}?>
</p>

<p align=center>по результатам рассмотрения заявления от <?echo $data_request['REQ_DATE'];?> № <?echo $data_request['REQ_NUM'];?>
<?if ($data_request['LANG_SOL']==2){echo "<br>by the results of consideration of the application from the ".$data_request['REQ_DATE'];}?>
</p>

<p align=center> <?echo "<u>".$data_company['NAME_RUS']."</u>";?> 
<?if ($data_request['LANG_SOL']==2){echo "<br><u>".$data_company['NAME_ENG']."</u>";}?>
</p>
<?}?>
<table align=center cellspacing="0" cellpadding="0" width=90%>
    <tr>
	<td style="border: 1px solid #000000; border-right: none; text-align: center;"><b>Название судна
	<?if ($data_request['LANG_SOL']==2){echo "<br>(Name of the ship)";}?>
	</b></td>
	<td style="border: 1px solid #000000; border-right: none; text-align: center;"><b>Номер ИМО
	<?if ($data_request['LANG_SOL']==2){echo "<br>(IMO number)";}?>
	</b></td>
	<td style="border: 1px solid #000000; border-right: none; text-align: center;"><b>Флаг
	<?if ($data_request['LANG_SOL']==2){echo "<br>(Flag)";}?>
	</b></td>
	<td style="border: 1px solid #000000; border-right: none; text-align: center;"><b>Категория<br>ледовых<br>усилений
	<?if ($data_request['LANG_SOL']==2){echo "<br>(Category of ice<br>strengthening)";}?>
	</b></td>
	<td style="border: 1px solid #000000; text-align: center;"><b>Валовая<br>вместимость
	<?if ($data_request['LANG_SOL']==2){echo "<br>(Gross tonnage)";}?>
	</b></td>
    </tr>
    <tr>
	<td style="border: 1px solid #000000; border-right: none; border-top: none; text-align: center;"><?if ($data_request['LANG_SOL']==2){echo $data_ship['NAME_ENG'];}else{echo $data_ship['NAME_RUS'];}?></td>
	<td style="border: 1px solid #000000; border-right: none; border-top: none; text-align: center;"><?echo $data_ship['IMO'];?></td>
	<td style="border: 1px solid #000000; border-right: none; border-top: none; text-align: center;"><?if ($data_request['LANG_SOL']==2){echo $data_flag['NAME_ENG'];}else{echo $data_flag['NAME_RUS'];}?></td>
	<td style="border: 1px solid #000000; border-right: none; border-top: none; text-align: center;"><?echo $data_ice['ICE_CATEGORY'];?></td>
	<td style="border: 1px solid #000000; border-top: none; text-align: center;"><?echo $data_request['GROSS_TONNAGE'];?></td>
    </tr>
</table>

<?if ($data_request['SOLUTION']==1 || $data_request['SOLUTION']==2){?>
<p align=left><font style="font: bold 18px times;">Маршрут плавания (район работ):</font><br>
<?if ($data_request['LANG_SOL']==2){echo "<font style=\"font: bold 18px times;\">Route of navigation (area of works)</font><br>";}?>
<?dataArticle(2,3);?>
</p>

<?if ($data_request['LANG_SOL']==2) {?>
<table align=center cellspacing="0" cellpadding="0" width=90%>
<tr><td>
<p align=left><font style="font: bold 18px times;">Разрешено:</font></td><td>
<p align=left><font style="font: bold 18px times;">It ispermitted the following:</font>
</td></tr>    
</table>
<?}else {?>
<p align=left><font style="font: bold 18px times;">Разрешено:</font><br>
<?}?>
<?dataArticle(1,2);?>


<p align=left>Тип ледовых условий (легкий, средний, тяжелый) на участках акватории СМП определяется по официальному прогнозу Росгидромета, размещенному на сайте Администрации СМП.</p>
<?if ($data_request['LANG_SOL']==2){echo "<p align=left>Type of ice conditions (light, medium, heavy) on the sea ways of the NSR water area is to be determined by the official forecast of Roshydromet.</p>";}?>

<table>
    <tr>
	<td align=center>Срок действия РАЗРЕШЕНИЯ:</td>
	<td align=center>с</td>
	<td align=center rowspan=2><input type="text" size="10" id="solution_permited_from" name="solution_permited_from" value="<?echo $data_sol['PERMITED_FROM'];?>"></td>
	<td align=center>по</td> 
	<td align=center rowspan=2><input type="text" size="10" id="solution_permited_to" name="solution_permited_to" value="<?echo $data_sol['PERMITED_TO'];?>"></td>
    </tr>
    <tr>
	<td align=center><?if ($data_request['LANG_SOL']==2){echo "PERMISSION isvalid";}?></td>
	<td align=center><?if ($data_request['LANG_SOL']==2){echo "from";}?></td>
	<td align=center><?if ($data_request['LANG_SOL']==2){echo "to";}?></td> 
    </tr>
</table>
<p align=left><font style="font: bold 14px times;">Форма ежедневного доклада капитана судна в Администрацию СМП на 12.00 московского времени (пункт 42 Правил плавания в акватории СМП) размещена на сайте Администрации СМП.</font></p> 
<?if ($data_request['LANG_SOL']==2){echo "<p align=left><font style=\"font: bold 14px times;\">Form of  daily reporting of the ship`s master to the Northern Sea Route Administration at 12:00 Moscow time ( item 42 of the Rules of navigation in the water area of the Northern Sea Route) is placed on the NSRA official web-site.</font></p>";}?>
<?}else{?>

<p align=left>Судну отказано в выдаче разрешения по следующим основаниям:</p>
<?if ($data_request['LANG_SOL']==2) {?>
<p align=left>This ship is refused with the permission to navigate in the water area of the Northern Sea Route due to:</p>
<?
}
dataArticle(1,1);
}
?>
<table  cellspacing="0" cellpadding="0" border="0" width=95%>
    <tr>
	<td align=left>
	    Руководитель Администрации<br>
	    Северного морского пути
<?if ($data_request['LANG_SOL']==2){echo "<br>Head of the NSR Administration";}?>
	</td>
	<td align=right>		 
	    Д.С. Смирнов
<?if ($data_request['LANG_SOL']==2){echo "<br>D. Smirnov";}?>
	</td>
    </tr>
</table>
<p align=left>г. Москва <input type="text" size="10" id="solution_date" name="solution_date" value="<?echo $data_sol['SOLUTION_DATE'];?>">
<?if ($data_request['LANG_SOL']==2){echo "<br>Moscow";}?>
</p>

</div>
<div id="solution_save" style=""></div>
<div style="position: relative; width: 900px; margin: 10px auto;">
    <div style="position: relative; float: left; width: 445px; margin: 10px auto;">
	<button id="addfile">Сформировать документ</button>
    </div>
    <div style="position: relative; float: left; width: 445px; margin: 10px auto;">
	<div id="file_save">
<?
//"
if ($data_sol_doc['URI']==""){echo "<h1>Документ не сформирован!</h1>";}
else 
    {
    echo "<a href=\"/files/resolution/".$data_sol_doc['URI']."\">Скачать документ</a>";
    if ($data_request['EDIT_SOL']==1){echo " <font style=\"font: bold 15px arial; color: #ff0000;\">ТРЕБУЕТСЯ ОБНОВИТЬ ДОКУМЕНТ</font>";}
    
    }
?>	
	</div>
    </div>
    <div style="position: relative; float: left; width: 900px; margin: 10px auto;"><h1><a href="/"><<НАЗАД</a></h1></div>
    <div style="clear: both;"></div>
</div>