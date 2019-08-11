<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$reg_num = $_POST['reg_num'];
$gra_num = $_POST['gra_num'];
$fac_id = $_POST['fac_id'];
$fac_code = $_POST['fac_code']; //in case of others fac add
$from_sub_num = $_POST['from_sub_num'];
$from_run_num = $_POST['from_run_num'];
$fac_code_full = $_POST['fac_code'];
$datepicker = $_POST['datepicker'];
$dear_to = $_POST['dear_to'];
$title = $_POST['title'];
$staff_id = $_POST['staff_id'];
$tips_othersfac = $_POST['tips-othersfac'];

$doc_year = substr($datepicker,6,4);
$doc_month = substr($datepicker,3,2);
$doc_day = substr($datepicker,0,2);
$doc_date = $doc_year.'/'.$doc_month.'/'.$doc_day;

$sql_check = "SELECT reg_num FROM doc WHERE ((reg_num='$reg_num' AND reg_num!='00000') OR gra_num='$gra_num') AND year_show='$doc_year'+543";
$sql_insert = "INSERT INTO doc(reg_num,gra_num,date,fac_id,from_sub_num,from_run_num,dear_to_id,title,staff_id,year_show) 
                VALUES('$reg_num','$gra_num','$doc_date','$fac_id','$from_sub_num','$from_run_num','$dear_to','$title','$staff_id','$doc_year'+543)";
$sql_insert_others_fac = "INSERT INTO others_fac(gra_num,year_show,fac_name,fac_code_full)
                            VALUES('$gra_num','$doc_year'+543,'$tips_othersfac','$fac_code_full')";
$sql_insert_tips = "INSERT INTO tips(gra_num,tips,year_show)
            VALUES('$gra_num','$tips_othersfac','$doc_year'+543)";

$query_check = $mysqli-> query($sql_check);
if(($query_check-> num_rows)>0){
    echo '<script type="text/javascript">
            window.location.href = "edit.php?saved=existed";
        </script>';
    }
else{
    if ($mysqli->query($sql_insert) === TRUE){
        if($fac_id=='999'){
            if($mysqli->query($sql_insert_others_fac)===TRUE){
                echo '<script type="text/javascript">
                    window.location.href = "edit.php?saved=ok&type=savewithothers";
                </script>'; 
            }
            else{
                echo '<script type="text/javascript">
                window.alert('.$mysqli ->error.');
                window.location.href = "edit.php?saved=error&type=errorwithothers";
            </script>';
            }
        }
        else{
            if($tips_othersfac!=""){
                if($mysqli->query($sql_insert_tips)===TRUE){
                    echo '<script type="text/javascript">
                    window.location.href = "edit.php?saved=ok&type=savewithtips";
                </script>'; 
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "edit.php?saved=error&type=errorwithothers";
                </script>';
                }
            }
        }
        echo '<script type="text/javascript">
                    window.location.href = "edit.php?saved=ok";
                </script>';
    }
    else{
        echo '<script type="text/javascript">
        window.alert('.$mysqli ->error.');
        window.location.href = "edit.php?saved=error";
    </script>';
    }
}
?>