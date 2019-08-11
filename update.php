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

$prev_reg_num = $_POST['prev_reg_num'];
$prev_year_show = $_POST['prev_year_show'];

$prev_tips = isset($_POST['prev_tips'])? 1 : 0;
$prev_others_fac = isset($_POST['prev_others_fac'])? 1 : 0;
$doc_year = substr($datepicker,6,4);
$doc_month = substr($datepicker,3,2);
$doc_day = substr($datepicker,0,2);
$doc_date = $doc_year.'/'.$doc_month.'/'.$doc_day;

$sql_check = "SELECT reg_num FROM doc WHERE ((reg_num='$reg_num' AND reg_num!='00000') OR gra_num='$gra_num') AND year_show='$doc_year'+543";
$sql_others_fac_check = "SELECT gra_from FROM others_fac WHERE gra_num='$prev_gra_num'";
$sql_tips_check = "";

$sql_update = "UPDATE doc SET reg_num='$reg_num',gra_num='$gra_num',date='$doc_date',fac_id='$fac_id',from_sub_num='$from_sub_num',from_run_num='$from_run_num',dear_to_id='$dear_to',title='$title',staff_id='$staff_id',year_show='$doc_year'+543 
                WHERE gra_num='$gra_num' AND year_show=$prev_year_show'";
$sql_update_others_fac = "UPDATE others_fac SET gra_num='$gra_num',year_show='$doc_year'+543,fac_name='$tips_othersfac',fac_code_full='$fac_code_full')
                            WHERE gra_num='$gra_num' AND year_show=$prev_year_show'";
$sql_update_tips = "UPDATE tips SET gra_num='$gra_num',tips='$tips_othersfac',year_show='$doc_year'+543
                    WHERE gra_num='$gra_num' AND year_show=$prev_year_show'";

$sql_insert_others_fac = "INSERT INTO others_fac(gra_num,year_show,fac_name,fac_code_full)
                            VALUES('$gra_num','$doc_year'+543,'$tips_othersfac','$fac_code_full')";
$sql_insert_tips = "INSERT INTO tips(gra_num,tips,year_show)
                    VALUES('$gra_num','$tips_othersfac','$doc_year'+543)";

$query_others_fac_check = $mysqli-> query($sql_others_fac_check);
$query_tips_check = $mysqli-> query($sql_tips_check);

if((($reg_num==$prev_reg_num && $prev_year_show==($doc_year+543))===FALSE)&&(($query_check-> num_rows)>0)){ //กรณีเปลี่ยนเลขเอกสาร-ปี
        echo '<script type="text/javascript">
                window.location.href = "index.php?saved=existed";
            </script>';
}
else{
    if ($mysqli->query($sql_update) === TRUE){
        if($fac_id=='999'){
            if($prev_others_fac==1){
                if($tips_othersfac!=""){
                    if($mysqli->query($sql_update_others_fac)===TRUE){
                        echo '<script type="text/javascript">
                            window.location.href = "index.php?saved=ok&type=savewithothers";
                        </script>';
                    }
                    else{
                        echo '<script type="text/javascript">
                        window.alert('.$mysqli ->error.');
                        window.location.href = "index.php?saved=error&type=errorwithothers";
                    </script>';
                    }
                }
            }
        }
        else{
            if($prev_tips==1){
                if($tips_othersfac!=""){
                    if($mysqli->query($sql_update_tips)===TRUE){
                        echo '<script type="text/javascript">
                        window.location.href = "index.php?saved=ok&type=savewithtips";
                    </script>'; 
                    }
                    else{
                        echo '<script type="text/javascript">
                        window.alert('.$mysqli ->error.');
                        window.location.href = "index.php?saved=error&type=errorwithtips";
                    </script>';
                    }
                }
                else{
                    if($tips_othersfac!=""){
                    // delete others
                    }
                }
            }        
        }
        echo '<script type="text/javascript">
                    window.location.href = "index.php?saved=ok";
                </script>';
    }
    else{
        echo '<script type="text/javascript">
        window.alert('.$mysqli ->error.');
        window.location.href = "index.php?saved=error";
    </script>';
    }
}
?>