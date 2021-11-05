<?php
session_start();
require_once '../PHPWord.php';
require_once('../db/Mysql.php');
require_once('../db/Mysql/Exception.php');
require_once('../db/Mysql/Statement.php');
require_once('../db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);

$db->query("UPDATE `REQUEST` SET `EDIT_SOL`=0 WHERE `ID`='?i'", $_SESSION['req_id']);
$result=$db->query("SELECT * FROM `REQUEST` WHERE `ID`='?i'", $_SESSION['req_id']);
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
$result_sol_doc=$db->query("SELECT `DOCUMENT`.`URI` AS URI, `DOCUMENT`.`ID` AS ID, `LNK_DOC_SOLUTION`.`ID` AS ID_LNK FROM `LNK_DOC_SOLUTION` 
			    LEFT JOIN `DOCUMENT` ON `LNK_DOC_SOLUTION`.`ID_DOCUMENT`=`DOCUMENT`.`ID` WHERE `LNK_DOC_SOLUTION`.`IS_DELETED`=0 AND `LNK_DOC_SOLUTION`.`ID_SOLUTION`='?i'", $data_sol['ID']);
$data_sol_doc=$result_sol_doc->fetch_assoc();

if ($data_request['SOLUTION']==3)
    {
    $result_sol_art1=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`
                                    LEFT JOIN `DIC_ARTICLE` ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE`
                                    WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $data_sol['ID']);
    $article1="";
    while ($data_sol_art1=$result_sol_art1->fetch_assoc())
	{
	if ($data_request['LANG_SOL']==1){$article1=$article1."<w:p><w:pPr><w:pStyle w:val=\"ListParagraph\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art1['TEXT_RUS']."</w:t></w:r></w:p>";}
	elseif ($data_request['LANG_SOL']==2){$article1=$article1."<w:p><w:pPr><w:pStyle w:val=\"ListParagraph\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art1['TEXT_RUS']."<w:br/>".$data_sol_art1['TEXT_ENG']."</w:t></w:r></w:p>";}
	}
    }
else
    {
    $result_sol_art1=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`
                                    LEFT JOIN `DIC_ARTICLE` ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE`
	                            WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' AND `DIC_ARTICLE`.`TYPE`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $data_sol['ID'], 2);
    $article1="";
    while ($data_sol_art1=$result_sol_art1->fetch_assoc())
	{
	if ($data_request['LANG_SOL']==1){$article1=$article1."<w:p><w:pPr><w:pStyle w:val=\"ListParagraph\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art1['TEXT_RUS']."</w:t></w:r></w:p>";}
	elseif ($data_request['LANG_SOL']==2){$article1=$article1."<w:p><w:pPr><w:pStyle w:val=\"ListParagraph\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art1['TEXT_RUS']."<w:br/>".$data_sol_art1['TEXT_ENG']."</w:t></w:r></w:p>";}
	}

    $result_sol_art2=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`
	                            LEFT JOIN `DIC_ARTICLE` ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE`
                                    WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' AND `DIC_ARTICLE`.`TYPE`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $data_sol['ID'], 3);
    $article21="";
    $article22="";
    while ($data_sol_art2=$result_sol_art2->fetch_assoc())
	{
	if ($data_request['LANG_SOL']==1){$article2=$article2."<w:p><w:pPr><w:pStyle w:val=\"ListParagraph\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art2['TEXT_RUS']."</w:t></w:r></w:p>";}
	elseif ($data_request['LANG_SOL']==2)
	    {
	    $article2=$article2."<w:p><w:pPr><w:pStyle w:val=\"ListP\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art2['TEXT_RUS']."</w:t></w:r></w:p>";
	    $article22=$article22."<w:p><w:pPr><w:pStyle w:val=\"ListParagraph\"/><w:numPr><w:ilvl w:val=\"0\"/><w:numId w:val=\"1\"/></w:numPr></w:pPr><w:r><w:t>".$data_sol_art2['TEXT_ENG']."</w:t></w:r></w:p>";
	    }
	}
    }


if ($data_request['LANG_SOL']==1)
    {
    if ($data_request['SOLUTION']==1 || $data_request['SOLUTION']==2){$doc_templ="resolution_rus.docx";}
    if ($data_request['SOLUTION']==3){$doc_templ="notification_rus.docx";}
    }
if ($data_request['LANG_SOL']==2)
    {
    if ($data_request['SOLUTION']==1 || $data_request['SOLUTION']==2){$doc_templ="resolution_eng.docx";}
    if ($data_request['SOLUTION']==3){$doc_templ="notification_eng.docx";}
    }
    

$PHPWord = new PHPWord();
$document = $PHPWord->loadTemplate('../files/templ/'.$doc_templ); //шаблон
$document->setValue('n1', $data_sol['SOLUTION_NUM']); //Номер решения
$document->setValue('n3', $data_ice['ICE_CATEGORY']); //Ледовая категория
$document->setValue('n31', $data_ice['ICE_CATEGORY']); //Ледовая категория
$document->setValue('n5', $data_request['REQ_DATE']); //Дата заявления
$document->setValue('n51', $data_request['REQ_DATE']); //Дата заявления
$document->setValue('n6', $data_request['REQ_NUM']); //Номер заявления
$document->setValue('n61', $data_request['REQ_NUM']); //Номер заявления
$document->setValue('n7', $data_company['NAME_RUS']); //Заявитель
$document->setValue('n71', $data_company['NAME_ENG']); //Заявитель
if ($data_request['LANG_SOL']==1){$document->setValue('n8', $data_ship['NAME_RUS']);} //Название судна
elseif ($data_request['LANG_SOL']==2){$document->setValue('n8', $data_ship['NAME_ENG']);} //Название судна
$document->setValue('n9', $data_ship['IMO']); //Имо номер судна
if ($data_request['LANG_SOL']==1){$document->setValue('n10', $data_flag['NAME_RUS']);} //Флаг судна
elseif ($data_request['LANG_SOL']==2){$document->setValue('n10', $data_flag['NAME_ENG']);} //Флаг судна
$document->setValue('n11', $data_ice['ICE_CATEGORY']); //Ледовая категория
$document->setValue('n12', $data_request['GROSS_TONNAGE']); //Валовая вместимость
$document->setValue('n13', $article2); //Маршрут плавания
$document->setValue('n131', $article22); //Маршрут плавания
//$document->setValue('n131', str_replace("\n", "<w:br />", $data_sol_art1['TEXT_ENG'])); //Маршрут плавания
$document->setValue('n14', $article1); //Разрешено
//$document->setValue('n141', $article12); //Разрешено
$document->setValue('n15', date("d.m.Y", strtotime($data_sol['PERMITED_FROM']))); //Дата с
$document->setValue('n151', date("d.m.Y", strtotime($data_sol['PERMITED_FROM']))); //Дата с
$document->setValue('n16', date("d.m.Y", strtotime($data_sol['PERMITED_TO']))); //Дата по
$document->setValue('n161', date("d.m.Y", strtotime($data_sol['PERMITED_TO']))); //Дата по
$document->setValue('n17', date("d.m.Y", strtotime($data_sol['SOLUTION_DATE']))); //Дата заявления

$doc_name=date("YmdHis").".docx";
$document->save('../files/resolution/'.$doc_name);
if ($data_sol_doc['ID']>0)
    {
    $db->query("UPDATE `DOCUMENT` SET `URI`=\"arch-".$data_sol_doc['URI']."\", `IS_DELETED`=1, `TS_DELETED`=\"".date("Y-m-d H:i:s")."\" WHERE `ID`='?i'", $data_sol_doc['ID']);
    $db->query("UPDATE `LNK_DOC_SOLUTION` SET `IS_DELETED`=1, `TS_DELETED`=\"".date("Y-m-d H:i:s")."\" WHERE `ID`='?i'", $data_sol_doc['ID_LNK']);
    rename ('../files/resolution/'.$data_sol_doc['URI'], '../files/resolution/arch-'.$data_sol_doc['URI']);
    echo "<font style=\"color: #".rand(100000,999999).";\">Документ обновлен!</font><br>";
    }
echo "<a href=/files/resolution/".$doc_name.">Скачать документ</a>";
$data_new_sol_doc=array('ID_DOC_TYPE'=>0,'URI'=>$doc_name,'TS_CREATED'=>date("Y-m-d H:iS"),'TS_UPDATED'=>date("Y-m-d H:iS"),'TS_DELETED'=>date("Y-m-d H:iS"),'IS_DELETED'=>0);
$db->query("INSERT INTO `DOCUMENT` SET ?As", $data_new_sol_doc);
$new_sol_doc_id=$db->getLastInsertId();
$data_new_sol_doc_lnk=array('ID_SOLUTION'=>$data_sol['ID'],'ID_DOCUMENT'=>$new_sol_doc_id,'TS_CREATED'=>date("Y-m-d H:iS"),'TS_UPDATED'=>date("Y-m-d H:iS"),'TS_DELETED'=>date("Y-m-d H:iS"),'IS_DELETED'=>0);
$db->query("INSERT INTO `LNK_DOC_SOLUTION` SET ?As", $data_new_sol_doc_lnk);
?>
