<?
switch ($_GET['event2'])
    {
    case add:
	{
        echo "<form method=post><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"950\" align=\"center\">
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Название на русском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"name_rus\"></textarea></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Название на английском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"name_eng\"></textarea></td>
		</tr>";
	if ($_GET['tb']=="COMPANY")	
	    echo "<tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Адрес компании на русском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"company_address_rus\"></textarea></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Адрес компании на английском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"company_address_eng\"></textarea></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Телефон компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"40\" name=\"company_phone\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Факс компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"40\" name=\"company_fax\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Email адрес компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"68\"name=\"company_email\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Должность руководителя компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"68\" name=\"company_head_post\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">ФИО руководителя компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"68\" name=\"company_head_name\"></td>
	        </tr>";
	elseif ($_GET['tb']=="SHIP")	
	    echo "<tr>
	            <td align=\"left\"><font class=\"main\">Номер ИМО:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"20\" name=\"ship_imo\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">Позывной:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"20\" name=\"ship_call_sign\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">MMSI:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"20\" name=\"ship_mmsi\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">Рег. номер РМРС:</font></td>
	    	    <td align=\"left\"><input type=\"text\" size=\"25\" name=\"ship_rmrs\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">Рег. номер РРР:</font></td>
	    	    <td align=\"left\"><input type=\"text\" size=\"25\" name=\"ship_rrr\"></td>
                </tr>";
	elseif ($_GET['tb']=="DIC_ARTICLE")
	    echo "<tr>
	            <td align=\"left\"><font class=\"main\">Тип записи:</font></td>
	            <td align=\"left\">
	        	<SELECT name=\"article_type\">
	        	    <option value=1>Отказ</option>
	        	    <option value=2>Разрешено</option>
	        	    <option value=3>Маршрут</option>
	        	</SELECT>
	    	    </td>
	        </tr>";
	                                                                                                                                                                                                                            
	echo	"<tr>
		    <td align=left><input type=submit name=ok value=\"Создать\"></td>
		</tr> 
	    </table></form>";
	if ($_POST['ok'])
	    {
	    if ($_GET['tb']=="COMPANY") $db->query("INSERT INTO ".$_GET['tb']." SET `IMO`='?s', `NAME_RUS`='?s', `NAME_ENG`='?s', `ADDRESS_RUS`='?s', `ADDRESS_ENG`='?s', `PHONE`='?s', `FAX`='?s', `EMAIL`='?s', `HEAD_POST`='?s', `HEAD_NAME`='?s', `CODE`='?i', `TS_CREATED`='?s', `TS_UPDATED`='?s', `TS_DELETED`='?s', `IS_DELETED`='?i'",
						"111", str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']), str_replace("\"", "&quot;", $_POST['company_address_rus']), 
						str_replace("\"", "&quot;", $_POST['company_address_eng']), $_POST['company_phone'], $_POST['company_fax'], $_POST['company_email'], 
						str_replace("\"", "&quot;", $_POST['company_head_post']), str_replace("\"", "&quot;", $_POST['company_head_name']), "111",
						date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
	    elseif ($_GET['tb']=="SHIP") $db->query("INSERT INTO ".$_GET['tb']." SET `NAME_RUS`='?s', `NAME_ENG`='?s', `IMO`='?s', `CALL_SIGN`='?s', `MMSI`='?s', `RMRS`='?s', `RRR`='?s', CODE='?i', `TS_CREATED`='?s', `TS_UPDATED`='?s', `TS_DELETED`='?s', `IS_DELETED`='?i'",
						str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']),
						$_POST['ship_imo'], $_POST['ship_call_sign'], $_POST['ship_mmsi'], $_POST['ship_rmrs'], $_POST['ship_rrr'], "111",
						date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
	    elseif ($_GET['tb']=="DIC_ARTICLE") $db->query("INSERT INTO ".$_GET['tb']." SET `TYPE`='?i', `TEXT_RUS`='?s', `TEXT_ENG`='?s', `TS_CREATED`='?s', `TS_UPDATED`='?s', `TS_DELETED`='?s', `IS_DELETED`='?i'",
						$_POST['article_type'], str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']), 
						date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
	    elseif ($_GET['tb']=="DIC_DOC_TYPE") $db->query("INSERT INTO ".$_GET['tb']." SET `NAME_RUS`='?s', `NAME_ENG`='?s', `TS_CREATED`='?s', `TS_UPDATED`='?s', `TS_DELETED`='?s', `IS_DELETED`='?i'",
						str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']),
						date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 0);
	    echo "<script language='Javascript'>
		     function reload() {location = \"/index.php?event=spr&event2=view&tb=".$_GET['tb']."\"}; setTimeout('reload()', 0);
	        </script>";
	    }
	break;
	}
	
    case edit:
	{
	$query_tb=$db->query("SELECT * FROM ".$_GET['tb']." WHERE ID='?i'", $_GET['id']);
	$row_tb=$query_tb->fetch_assoc();
	if ($row_tb['TEXT_RUS']!=""){$row_tb['NAME_RUS']=$row_tb['TEXT_RUS'];}
	if ($row_tb['TEXT_ENG']!=""){$row_tb['NAME_ENG']=$row_tb['TEXT_ENG'];}

	if ($row_tb['TYPE']==1){$art_type1=" SELECTED "; $art_type2=""; $art_type3="";}
	elseif ($row_tb['TYPE']==2){$art_type1=""; $art_type2=" SELECTED "; $art_type3="";}
	elseif ($row_tb['TYPE']==3){$art_type1=""; $art_type2=""; $art_type3=" SELECTED ";}
	
        echo "<form method=post><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"950\" align=\"center\">
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Название на русском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"name_rus\">".$row_tb['NAME_RUS']."</textarea></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Название на английском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"name_eng\">".$row_tb['NAME_ENG']."</textarea></td>
		</tr>";
	if ($_GET['tb']=="COMPANY")	
	    echo "<tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Адрес компании на русском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"company_address_rus\">".$row_tb['ADDRESS_RUS']."</textarea></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Адрес компании на английском языке:</font></td>
	            <td align=\"left\"><textarea cols=\"70\" rows=\"2\" name=\"company_address_eng\">".$row_tb['ADDRESS_ENG']."</textarea></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Телефон компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"40\" name=\"company_phone\" value=\"".$row_tb['PHONE']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Факс компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"40\" name=\"company_fax\" value=\"".$row_tb['FAX']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Email адрес компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"68\"name=\"company_email\" value=\"".$row_tb['EMAIL']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">Должность руководителя компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"68\" name=\"company_head_post\" value=\"".$row_tb['HEAD_POST']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\" valign=\"top\"><font class=\"main\">ФИО руководителя компании:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"68\" name=\"company_head_name\" value=\"".$row_tb['HEAD_NAME']."\"></td>
	        </tr>";
	elseif ($_GET['tb']=="SHIP")	
	    echo "<tr>
	            <td align=\"left\"><font class=\"main\">Номер ИМО:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"20\" name=\"ship_imo\" value=\"".$row_tb['IMO']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">Позывной:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"20\" name=\"ship_call_sign\" value=\"".$row_tb['CALL_SIGN']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">MMSI:</font></td>
	            <td align=\"left\"><input type=\"text\" size=\"20\" name=\"ship_mmsi\" value=\"".$row_tb['MMSI']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">Рег. номер РМРС:</font></td>
	    	    <td align=\"left\"><input type=\"text\" size=\"25\" name=\"ship_rmrs\" value=\"".$row_tb['RMRS']."\"></td>
	        </tr>
	        <tr>
	            <td align=\"left\"><font class=\"main\">Рег. номер РРР:</font></td>
	    	    <td align=\"left\"><input type=\"text\" size=\"25\" name=\"ship_rrr\" value=\"".$row_tb['RRR']."\"></td>
                </tr>";
	elseif ($_GET['tb']=="DIC_ARTICLE")
	    echo "<tr>
	            <td align=\"left\"><font class=\"main\">Тип записи:</font></td>
	            <td align=\"left\">
	        	<SELECT name=\"article_type\">
	        	    <option value=1 ".$art_type1.">Отказ</option>
	        	    <option value=2 ".$art_type2.">Разрешено</option>
	        	    <option value=3 ".$art_type3.">Маршрут</option>
	        	</SELECT>
	    	    </td>
	        </tr>";
	                                                                                                                                                                                                                            
	echo	"<tr>
		    <td align=left><input type=submit name=ok value=\"Сохранить\"></td>
		</tr> 
	    </table></form>";
	echo	"<form method=post><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"950\" align=\"center\"><tr>
		    <td align=right><input type=submit name=okdel value=\"Удалить без возможности восстановления\" onclick=\"return confirm('Вы уверены?');\"></td>
		</tr> 
	    </table></form>";

	if ($_POST['okdel'])
	    {
	    $db->query("DELETE FROM ".$_GET['tb']." WHERE ID='?i'", $_GET['id']);
	    echo "<script language='Javascript'>
		     function reload() {location = \"/index.php?event=spr&event2=view&tb=".$_GET['tb']."\"}; setTimeout('reload()', 0);
	        </script>";
	    }

	if ($_POST['ok'])
	    {
	    if ($_GET['tb']=="COMPANY") $db->query("UPDATE ".$_GET['tb']." SET `NAME_RUS`='?s', `NAME_ENG`='?s', `ADDRESS_RUS`='?s', `ADDRESS_ENG`='?s', `PHONE`='?s', `FAX`='?s', `EMAIL`='?s', `HEAD_POST`='?s', `HEAD_NAME`='?s' WHERE ID='?i'",
						str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']), str_replace("\"", "&quot;", $_POST['company_address_rus']), 
						str_replace("\"", "&quot;", $_POST['company_address_eng']), $_POST['company_phone'], $_POST['company_fax'], $_POST['company_email'], 
						str_replace("\"", "&quot;", $_POST['company_head_post']), str_replace("\"", "&quot;", $_POST['company_head_name']), $_GET['id']);
	    elseif ($_GET['tb']=="SHIP") $db->query("UPDATE ".$_GET['tb']." SET `NAME_RUS`='?s', `NAME_ENG`='?s', `IMO`='?s', `CALL_SIGN`='?s', `MMSI`='?s', `RMRS`='?s', `RRR`='?s' WHERE ID='?i'",
						str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']),
						$_POST['ship_imo'], $_POST['ship_call_sign'], $_POST['ship_mmsi'], $_POST['ship_rmrs'], $_POST['ship_rrr'], $_GET['id']);
	    elseif ($_GET['tb']=="DIC_ARTICLE") $db->query("UPDATE ".$_GET['tb']." SET `TYPE`='?i', `TEXT_RUS`='?s', `TEXT_ENG`='?s' WHERE ID='?i'",
						$_POST['article_type'], str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']), $_GET['id']);
	    elseif ($_GET['tb']=="DIC_DOC_TYPE") $db->query("UPDATE ".$_GET['tb']." SET `NAME_RUS`='?s', `NAME_ENG`='?s' WHERE ID='?i'",
						str_replace("\"", "&quot;", $_POST['name_rus']), str_replace("\"", "&quot;", $_POST['name_eng']), $_GET['id']);
	    echo "<script language='Javascript'>
		     function reload() {location = \"/index.php?event=spr&event2=view&tb=".$_GET['tb']."\"}; setTimeout('reload()', 0);
	        </script>";
	    }
	break;
	}
	
    case del:
	{
	$db->query("UPDATE ".$_GET['tb']." SET IS_DELETED='?i' WHERE ID='?i'", $_GET['del'], $_GET['id']);
	echo "<script language='Javascript'>
	         function reload() {location = \"/index.php?event=spr&event2=view&tb=".$_GET['tb']."\"}; setTimeout('reload()', 0);
	     </script>";
	break;
	}
	
    case view:
	{
	echo "<p><a href=\"/index.php?event=spr\" style=\"text-align: left; background: #cecece; padding: 5px 10px;\"><< Назад</a></p>";        
	echo "<p><a href=\"/index.php?event=spr&event2=add&tb=".$_GET['tb']."\" style=\"text-align: left; background: #cecece; padding: 5px 10px;\">НОВАЯ</a></p>";        
	$query_tb=$db->query("SELECT * FROM ".$_GET['tb']."");
	echo "<ul style=\"list-style: none;\">";
	while ($row_tb=$query_tb->fetch_assoc())
	    {
	    if ($row_tb['TEXT_RUS']!=""){$row_tb['NAME_RUS']=$row_tb['TEXT_RUS'];}

	    if ($row_tb['IS_DELETED']==0) 
		{
		$del="<a href=\"/index.php?event=spr&event2=del&tb=".$_GET['tb']."&del=1&id=".$row_tb['ID']."\" onclick=\"return confirm('Вы уверены?');\"><img src=images/delete.png border=0 width=20 height=20></a>";
		$style="000000";
		}
	    else 
		{
		$del="<a href=\"/index.php?event=spr&event2=del&tb=".$_GET['tb']."&del=0&id=".$row_tb['ID']."\" onclick=\"return confirm('Вы уверены?');\"><img src=images/undo.png border=0 width=20 height=20></a>";
		$style="ff0000";
		}
		
	    echo "<li>".$del."&nbsp;<a href=\"/index.php?event=spr&event2=edit&tb=".$_GET['tb']."&id=".$row_tb['ID']."\" style=\"color: #".$style.";\">".$row_tb['NAME_RUS']."</a></li>";
	    }
	echo "</ul>";
	break;
	}
	
    default:
	{
	echo "<ul style=\"list-style: none;\">
		<li><a href=\"/index.php?event=spr&event2=view&tb=COMPANY\">Компании</a></li>
		<li><a href=\"/index.php?event=spr&event2=view&tb=SHIP\">Суда</a></li>
		<li><a href=\"/index.php?event=spr&event2=view&tb=DIC_ARTICLE\">Статьи</a></li>
		<li><a href=\"/index.php?event=spr&event2=view&tb=DIC_DOC_TYPE\">Типы документов</a></li>
	    </ul>";
	echo "<p><a href=\"/\" style=\"text-align: left; background: #cecece; padding: 5px 10px;\"><< Назад</a></p>";        
	break;
	}
    }


?>