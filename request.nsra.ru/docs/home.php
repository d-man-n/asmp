<?php
switch($_GET['event'])
    {
    case spr:
	{
	require_once('docs/spr.php');
	break;
	}
	
    case edit:
	{
	require_once('docs/request_edit.php');
	break;
	}

    case view:
	{
	require_once('docs/request_view.php');
	break;
	}
	
    case solution:
	{
	require_once('docs/request_sol.php');
	break;
	}
	
    default:
	{
	echo "<h1>Заявки</h1>";
	echo "<p><a href=\"/index.php?event=edit\" style=\"text-align: left; background: #cecece; padding: 5px 10px;\">Новая заявка</a></p>";
	echo "<p><a href=\"/docs/request_save.php\" style=\"text-align: left; background: #cecece; padding: 5px 10px;\">Выгрузить в Excel</a></p>";
	echo "<p><a href=\"/index.php?event=spr\" style=\"text-align: left; background: #cecece; padding: 5px 10px;\">Справочники</a></p>";
	$result_req=$db->query("SELECT `COMPANY`.`NAME_RUS` AS CNAME, 
					`SHIP`.`NAME_RUS` AS SNAME_RUS, 
					`SHIP`.`NAME_ENG` AS SNAME_ENG, 
					`DIC_COUNTRY`.`NAME_RUS` AS FNAME, 
					`DIC_ICE_CATEGORY`.`ICE_CATEGORY` AS INAME, 
					`REQUEST`.`ID` AS ID,
					`REQUEST`.`ASMP_NUM` AS ASMP_NUM,
					`REQUEST`.`REQ_NUM` AS REQ_NUM,
					`REQUEST`.`REQ_NUM_RCPT` AS REQ_NUM_RCPT,
					`REQUEST`.`SOLUTION` AS SOLUTION,
					`REQUEST`.`EDIT_SOL` AS EDIT_SOL,
					`REQUEST`.`REQ_DATE_CREATE` AS REQ_DATE_CREATE
				    FROM `REQUEST`
				    LEFT JOIN `COMPANY` ON `REQUEST`.`ID_COMPANY`=`COMPANY`.`ID` 
				    LEFT JOIN `SHIP` ON `REQUEST`.`ID_SHIP`=`SHIP`.`ID`
				    LEFT JOIN `DIC_COUNTRY` ON `REQUEST`.`ID_COUNTRY`=`DIC_COUNTRY`.`ID`
				    LEFT JOIN `DIC_ICE_CATEGORY` ON `REQUEST`.`ID_ICE_CAT`=`DIC_ICE_CATEGORY`.`ID`");

	echo "<table border=0 cellpadding=\"0\" cellspacing=\"0\" width=100% style=\"border: 1px solid #c8defa;\">
		<tr class=list>
            	    <td width=5% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; padding:3px;\"><font class=main2>№ п/п судна</font></td>
            	    <td width=10% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Название судна</font></td>
            	    <td width=20% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Судовладелец</font></td>
            	    <td width=10% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Флаг</font></td>
            	    <td width=5% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Ледовый класс</font></td>
            	    <td width=10% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Исходящий № заявления</font></td>
            	    <td width=10% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Входящий № заявления</font></td>
            	    <td width=15% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Дата принятия заявления к рассмотрению</font></td>
            	    <td width=5% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Просмотр</font></td>
            	    <td width=5% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Ред.</font></td>
            	    <td width=5% align=center style=\"border-top: 1px solid #c8defa; border-bottom: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 3px;\"><font class=main2>Разрешение<br>/Отказ</font></td>
    		</tr>";
	while ($data_req=$result_req->fetch_assoc())
	    {
	    if ($data_req['SOLUTION']==0){$bg_solution="none";}
	    if ($data_req['SOLUTION']==1){$bg_solution="#81cdf8";}
	    if ($data_req['SOLUTION']==2){$bg_solution="#6d7ba6";}
	    if ($data_req['SOLUTION']==3){$bg_solution="#e4a8a6";}
	    if ($data_req['EDIT_SOL']==1){$edit_sol="<br><font style=\"color: #ff0000;\">Документ не сформирован или не обновлен</font>";}
	    else {$edit_sol="";}
	    
    	    echo "<tr style=\"background:".$bg_solution.";\">
		    <td align=center style=\"border-top: 1px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['ASMP_NUM']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['SNAME_RUS']."<br>(".$data_req['SNAME_ENG'].")</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['CNAME']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['FNAME']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['INAME']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['REQ_NUM']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['REQ_NUM_RCPT']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><font class=main1>".$data_req['REQ_DATE_CREATE']."</font></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><a href=\"/index.php?event=view&id=".$data_req['ID']."\"><img src=\"/images/view.png\" border=0 width=30></a></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\"><a href=\"/index.php?event=edit&id=".$data_req['ID']."\"><img src=\"/images/edit.png\" border=0 width=30></a></td>
		    <td align=center style=\"border-top: 1px solid #c8defa; border-left: 2px solid #c8defa; padding: 5px;\">";
	    if ($data_req['SOLUTION']!=0){echo "<a href=\"/index.php?event=solution&id=".$data_req['ID']."\"><img src=\"/images/solution.png\" border=0 width=30></a>".$edit_sol;}
	    echo "  </td>
		</tr>";
	    }
	echo "</table>";

	echo "<table style=\"margin: 20px;\">
    		<tr>
        	    <td style=\"width: 20px; background: none; border: 1px solid #bebebe;\"></td>
        	    <td> - Новая заявка</td>
    		</tr>
    		<tr>
        	    <td style=\"width: 20px; background: #81cdf8;\"></td>
        	    <td> - Первоначальное разрешение</td>
	        </tr>
	        <tr>
	            <td style=\"width: 20px; background: #e4a8a6;\"></td>
	            <td> - Отказ</td>
	        </tr>
	        <tr>
        	    <td style=\"width: 20px; background: #6d7ba6;\"></td>
	            <td> - Продление разрешения</td>
        	</tr>
	    </table>";
	}
    }
    
?>