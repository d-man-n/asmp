<?
$list=$_GET['list'];
if (isset($_GET['aid'])){$list="admin";}

switch ($list)
    {
    case admin:
	{
	include "docs/admin.php";
	break;
	}

    case auth:
	{
	include "auth.php";
	break;
	}
	
    default:
	{
        require_once "docs/home.php";
	break;
	}
    }
    

?>