<?
session_start();
include "conf/config.php";
?>
<html>
<head>
<title>Форма ежедневного доклада капитана судна</title>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="Resource-type" content="document">
    <meta name="document-state" content="dynamic">
    <link rel="StyleSheet" type="text/css" href="/css/style.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/calendar.js"></script>
</head>
<body>
<div class=home>
<h1 align=center>Форма ежедневного доклада капитана судна</h1>
<?
if (!isset($_GET['send']) || $_GET['send']=="")
    {
    if (!isset($_GET['ship_imo']) || $_GET['ship_imo']=="")
	{
?>
<form method=get>
<table align=center class=data_table>
    <tr>
	<td align=right valign=top><font class=main>Введите ИМО номер (если ИМО отсутствует, то регистровый)</font></td>
	<td align=left valign=top><input type=text name="ship_imo" class=data_field></td>
    </tr>
    <tr>
	<td colspan=2 align=center><input type=submit value="Далее"></td>
    </tr>
</table>
</form>
<?    
	}
    else
	{
	$query_imo=mysql_query("SELECT name_ship, eta, shirota, dolgota, kurs, skorost, ice, t_air, t_water, direct_wind, speed_wind, visibility, height_wave, fuel, water, incident, failure, other FROM ".$db_pref."_grafic WHERE imo=\"".$_GET['ship_imo']."\" ORDER BY date DESC LIMIT 1");
	$row_imo=mysql_fetch_array($query_imo);
	if (mysql_num_rows($query_imo)>0)
	    {
	    echo "<p align=center><font class=main><b>Для упрощения ввода, таблица заполена данными из предыдущего доклада. (Дата сегодняшняя)</font></b></p>";
	    if (strrpos($row_imo['dolgota'], "ВОС")>0 || (strrpos($row_imo['dolgota'], "E")>0 && strrpos($row_imo['dolgota'], "WE")===false)){$dolgota1=" SELECTED "; $dolgota2="";}
	    elseif (strrpos($row_imo['dolgota'], "ЗАП")>0 || strrpos($row_imo['dolgota'], "W")>0){$dolgota1=""; $dolgota2=" SELECTED ";}
	    }
?>
<form method=post>
<table align=center class=data_table>
    <tr>
	<td align=right valign=top><font class=main>Название судна:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"ship_name\" class=\"data_field\" value=\"".$row_imo['name_ship']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Номер имо:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"ship_imo\" class=\"data_field\" value=\"".$_GET['ship_imo']."\" disabled></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Дата/время:</font></td>
	<td align=left valign=top><font class=main><b><?echo date("Y-m-d");?> 12:00</b></font></td>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Ггеографические координаты судна:</font></td>
	<td align=left valign=top>
	    <?echo "<input type=\"text\" maxlength=\"6\" name=\"shirota\" class=\"data_field\" style=\"width: 50px;\" value=\"".preg_replace("/[^0-9,.]/", '', $row_imo['shirota'])."\"> <font class=\"main\">СЕВ;</font> &nbsp; ";?>
	    <?echo "<input type=\"text\" maxlength=\"7\" name=\"dolgota\" class=\"data_field\" style=\"width: 50px;\" value=\"".preg_replace("/[^0-9,.]/", '', $row_imo['dolgota'])."\">";?> 
	    <SELECT name="dolgota_add">
		<option value=1 <?echo $dolgota1;?>>ВОСТ
		<option value=2 <?echo $dolgota2;?>>ЗАП
	    </SELECT>
	</td>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Планируемое время входа судна в акваторию СМП, выхода с акватории СМП или планируемое время прихода в морской порт, находящийся в акватории СМП:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"eta\" class=\"data_field\" value=\"".$row_imo['eta']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Курс судна с точностью до одного градуса:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"kurs\" class=\"data_field\" value=\"".$row_imo['kurs']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Скорость судна с точностью до 0,1 узла:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"skorost\" class=\"data_field\" value=\"".$row_imo['skorost']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Возраст и формы льда, сплоченность и торосистость в баллах:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"ice\" class=\"data_field\" value=\"".$row_imo['ice']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Температура наружного воздуха в градусах цельсия с точностью до одного градуса:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"t_air\" class=\"data_field\" value=\"".$row_imo['t_air']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Температура забортной воды в градусах цельсия с точностью до одного градуса:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"t_water\" class=\"data_field\" value=\"".$row_imo['t_water']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Направление ветра с точностью до 10 градусов:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"direct_wind\" class=\"data_field\" value=\"".$row_imo['direct_wind']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Скорость ветра с точностью до одного метра в секунду:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"speed_wind\" class=\"data_field\" value=\"".$row_imo['speed_wind']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Видимость в морских милях с точностью до одной мили:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"visibility\" class=\"data_field\" value=\"".$row_imo['visibility']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>При следовании судна по чистой воде - высота волны в метрах с точностью до 0,5 метра,<br>при плавании во льдах и отсутствии волнения не заполняется:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"height_wave\" class=\"data_field\" value=\"".$row_imo['height_wave']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Количество топлива на борту судна по сортам тяжелого и легкого в метрических тоннах:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"fuel\" class=\"data_field\" value=\"".$row_imo['fuel']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Количество пресной воды на борту судна в метрических тоннах:</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"water\" class=\"data_field\" value=\"".$row_imo['water']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Сведения о проишествиях с членами экипажа судна, пассажирами или судном (при наличии).<br>При отсутствии таковых сведений не заполняется.</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"incident\" class=\"data_field\" value=\"".$row_imo['incident']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Сведения об обнаруженных неисправностях или отсутствии средств навигационного оборудования (при наличии).<br>При отсутствии таковых сведений не заполняется.</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"failure\" class=\"data_field\" value=\"".$row_imo['failure']."\"></td>";?>
    </tr>
    <tr>
	<td align=right valign=top><font class=main>Иные сведения, относящиеся к безопасности мореплавания и защите морской среды от загрязнения с судов (при наличии).<br>При отсутствии таковых сведений не заполняется.</font></td>
	<?echo "<td align=\"left\" valign=\"top\"><input type=\"text\" name=\"other\" class=\"data_field\" value=\"".$row_imo['other']."\"></td>";?>
    </tr>
    <tr>
	<td align=center colspan=2><input type=submit name=enter value="Отправить"></td>
    </tr>
</table>
</form>
<?
	if (isset($_POST['enter']))
	    {
	    $query_num=mysql_query("SELECT max(num) AS num FROM ".$db_pref."_grafic WHERE date=\"".date("Y-m-d")."\"") or die ("Error num");
	    $row_num=mysql_fetch_array($query_num);
	    $num=$row_num['num'];
	    if (!isset($num)){$num=0;}
	    $num=$num+1;
	    if ($_POST['dolgota_add']==1){$dolgota_add="ВОСТ";}
	    elseif ($_POST['dolgota_add']==2){$dolgota_add="ЗАП";}
	    mysql_query("INSERT INTO ".$db_pref."_grafic (date, num, name_ship, imo, eta, shirota, dolgota, kurs, skorost, ice, t_air, t_water, direct_wind ,speed_wind ,visibility, height_wave, fuel, water, incident, failure, other, display)
				    VALUES (\"".date("Y-m-d")."\", \"".$num."\", \"".$_POST['ship_name']."\", \"".$_POST['ship_imo']."\", \"".$_POST['eta']."\", \"".$_POST['shirota']." СЕВ\", \"".$_POST['dolgota']." ".$dolgota_add."\", 
				    \"".$_POST['kurs']."\", \"".$_POST['skorost']."\", \"".$_POST['ice']."\", \"".$_POST['t_air']."\", \"".$_POST['t_water']."\", \"".$_POST['direct_wind']."\", \"".$_POST['speed_wind']."\", 
				    \"".$_POST['visibility']."\", \"".$_POST['height_wave']."\", \"".$_POST['fuel']."\", \"".$_POST['water']."\", \"".$_POST['incident']."\", \"".$_POST['failure']."\", \"".$_POST['other']."\", 0)");
	    echo "<script language='Javascript'>
	          function reload() {location = \"/?send=end\"}; setTimeout('reload()', 0);
	                </script>";
	    }
	}
    }
else
    {
    echo "<h1 align=center>ДАННЫЕ ОТПРАВЛЕНЫ</h1>
	    <p align=center><a href=\"/\">На начало</a></p>";
    }
?>
</div>
</body>
</html>