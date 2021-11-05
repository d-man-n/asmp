<?
session_start();
//echo     "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
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

        $result=$db->query("SELECT * FROM `DIC_ARTICLE` WHERE TYPE='?i' AND (LOWER(`TEXT_RUS`) LIKE '%?s%' OR LOWER(`TEXT_ENG`) LIKE '%?s%')",$_GET['type'], strtolower($term), strtolower($term));
        $i=0;
        while ($data=$result->fetch_assoc())
            {
	    if (strstr(mb_strtolower($data['TEXT_RUS'], 'utf-8'), mb_strtolower($term, 'utf-8'))) $aaa[$i]=$data['TEXT_RUS'];
	    elseif (strstr(mb_strtolower($data['TEXT_ENG'], 'utf-8'), mb_strtolower($term, 'utf-8'))) $aaa[$i]=$data['TEXT_ENG'];
            $i++;
            }
        }
    echo json_encode($aaa);
    }

elseif ($_GET['event']=="dataArticle")
    {
    if ($_GET['del']==1){$db->query("DELETE FROM `SOLUTION_ARTICLE` WHERE ID='?i'", $_GET['id']);}
    else
	{
	if ($_GET['new']==1)
	    {
	    $new_art=array('TYPE'=>$_GET['type'],'TEXT_RUS'=>$_GET['text_rus'],'TEXT_ENG'=>$_GET['text_eng'], 'TS_CREATED'=>date("Y-m-d H:i:s"), 'TS_UPDATED'=>date("Y-m-d H:i:s"),'TS_DELETED'=>date("Y-m-d H:i:s"), 'IS_DELETED'=>0);
	    $db->query("INSERT INTO `DIC_ARTICLE` SET ?As", $new_art);
	    $art_id=$db->getLastInsertId();
	    }
	else
	    {
	    $result_id=$db->query("SELECT `ID` FROM `DIC_ARTICLE` WHERE `TEXT_RUS` LIKE '%?s%' OR `TEXT_ENG` LIKE '%?s%'", $_GET['id'], $_GET['id']);
	    $data_id=$result_id->fetch_assoc();
	    $art_id=$data_id['ID'];
	    }
	$result_num=$db->query("SELECT MAX(`NUM`) AS mnum FROM `SOLUTION_ARTICLE` WHERE `ID_SOLUTION`='?i'", $_SESSION['sol_id']);
	$data_num=$result_num->fetch_assoc();
	$num=$data_num['mnum'];
	if (!isset($num)) $num=0;
	$num++;
    
	$new_sol_art=array('ID_SOLUTION'=>$_SESSION['sol_id'],'ID_ARTICLE'=>$art_id,'NUM'=>$num, 'TS_CREATED'=>date("Y-m-d H:i:s"), 'TS_UPDATED'=>date("Y-m-d H:i:s"),'TS_DELETED'=>date("Y-m-d H:i:s"), 'IS_DELETED'=>0);
	$db->query("INSERT INTO `SOLUTION_ARTICLE` SET ?As", $new_sol_art);
	}
    $result_sol_art=$db->query("SELECT `DIC_ARTICLE`.`TEXT_RUS` AS TEXT_RUS, `DIC_ARTICLE`.`TEXT_ENG` AS TEXT_ENG, `SOLUTION_ARTICLE`.`ID` AS ID FROM `SOLUTION_ARTICLE`
                                    LEFT JOIN `DIC_ARTICLE` ON `DIC_ARTICLE`.`ID` = `SOLUTION_ARTICLE`.`ID_ARTICLE`
                                                                    WHERE `SOLUTION_ARTICLE`.`ID_SOLUTION`='?i' AND `DIC_ARTICLE`.`TYPE`='?i' ORDER BY `SOLUTION_ARTICLE`.`NUM`", $_SESSION['sol_id'], $_GET['type']);
    echo "<ul style=\"list-style: none;\">";
    while ($data_sol_art=$result_sol_art->fetch_assoc()){echo "<li style=\"margin-top:5px;\"><button onclick=\"remArticle(".$data_sol_art['ID'].", ".$_GET['num'].", ".$_GET['type'].");\">X</button> ".$data_sol_art['TEXT_RUS']." (".$data_sol_art['TEXT_ENG'].")</li>";}
    echo "</ul>";                                                                                                    
    
            
    }
?>
