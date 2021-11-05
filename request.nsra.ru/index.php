<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
session_start();
require_once('db/Mysql.php');
require_once('db/Mysql/Exception.php');
require_once('db/Mysql/Statement.php');
require_once('db/conf.php');

$db = Database_Mysql::create($dbhost, $dbuser, $dbpass)
           ->setCharset('utf8')
           ->setDatabaseName($dbname);
$lang="ru";
?>
<head>
<title><?echo "$title";?></title>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="ru">
    <meta name="Resource-type" content="document">
    <meta name="document-state" content="dynamic">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="/js/ajaxupload.3.5.js" ></script>

    <script type="text/javascript">
	$(document).ready(function()
            {
            $('#map').cycle({
                    fx: 'fade',
                    timeout:  5000
                    });
            });
    </script>
    
</head>
<body>
<div style="position: absolute; top: 0; width: 100%; height: 48px; background-color: #00114a; z-index: -1;"></div>
<div style="position: absolute; top: 48px; left: 0; width: 50%; height: 180px; background: url(/images/top_bg2.png) repeat-x; z-index: -1;"></div>
<div style="position: absolute; top: 48px; right: 0; width: 50%; height: 180px; background: url(/images/top_bg3.png) repeat-x; z-index: -1;"></div>
<div style="position: absolute; top: 228; width: 100%; height: 565px; background: url(/images/bg_left.png) repeat-x; z-index: -1;"></div>
<div style="position: relative; width: 1280px; height: 95%; margin: 0 auto; padding: 0;">
    <div style="position: relative; width: 100%; height: 48px; background: url(/images/top_line.png) no-repeat;">
        <div style="position:relative; float:right; right: 120; top:1;">
	    <a href="http://www.morflot.ru" target='_blank'><img src=/images/famrt_ru1.png border=0 onmouseout="this.src='/images/famrt_ru1.png';" onmouseover="this.src='/images/famrt_on_ru1.png';"></a>
        </div>
	<div style="position:relative; float:right; right: 200; top:1;">
	    <a href="http://www.mintrans.ru" target='_blank'><img src=/images/mintrans_en.png border=0 onmouseout="this.src='/images/mintrans_en.png';" onmouseover="this.src='/images/mintrans_on_en.png';"></a>
	</div>
    </div>
    <div style="position: relative; width: 100%; height: 180px; background: url(/images/top_bg_ru.png) no-repeat;">
        <div style="position:relative; float:left; left: 65;"><a href="http://asmp.morflot.ru"><img src=/images/logo3.png border=0></a></div>
        <div id=map style="position:relative; float:right; right: 0;">
	    <img src=/images/map1.png border=0>
	    <img src=/images/map2.png border=0 style="display:none;">
	</div>
    </div>
    <div style="position: relative; width: 100%; min-height: 565px; background: url(/images/bg.png) no-repeat;"><?include "main.php";?></div>    
</div>
</body>
</html>