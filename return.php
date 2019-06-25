<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$gra_num = $_GET['gra_num'];
$year_show = $_GET['year_show'];

$sql_return = "UPDATE doc SET doc.status = 0 WHERE gra_num = '$gra_num' AND year_show ='$year_show' LIMIT 1";

if($mysqli->query($sql_return) === TRUE){
    echo '<script type="text/javascript">
            window.location=document.referrer;
        </script>';
    }
else{
    echo '<script type="text/javascript">
            window.alert('.$mysqli ->error.');
            window.history.go(-1);
        </script>';
}

