<?php
require_once("config.inc");
date_default_timezone_set("Asia/Bangkok");
$reg_num = $_POST['reg_num'];
$gra_num = $_POST['gra_num'];
$fac_id = $_POST['fac_id'];
$from_sub_num = $_POST['from_sub_num'];
$from_run_num = $_POST['from_run_num'];
$datepicker = $_POST['datepicker'];
$dear_to = $_POST['dear_to'];
$title = $_POST['title'];
$staff_id = $_POST['staff_id'];
$tips = $_POST['tips'];

$fac_code_full = $_POST['fac_code']; //in case of others fac add
$others_fac = $_POST['others_fac']; //in case of others fac add

$doc_year = substr($datepicker,6,4);
$doc_month = substr($datepicker,3,2);
$doc_day = substr($datepicker,0,2);
$doc_date = $doc_year.'/'.$doc_month.'/'.$doc_day;

$prev_reg_num = $_POST['prev_reg_num'];
$prev_year_show = $_POST['prev_year_show'];
$prev_tips = isset($_POST['prev_tips'])? 1 : 0;
$prev_others_fac = isset($_POST['prev_others_fac'])? 1 : 0;

$prev_page = $_POST['prev_page'];

// SQL
$sql_check = "SELECT reg_num FROM doc WHERE (reg_num='$reg_num' AND reg_num!='00000') AND year_show='$doc_year'+543";

$sql_update = "UPDATE doc SET reg_num='$reg_num',gra_num='$gra_num',date='$doc_date',fac_id='$fac_id',from_sub_num='$from_sub_num',from_run_num='$from_run_num',dear_to_id='$dear_to',title='$title',staff_id='$staff_id',year_show='$doc_year'+543 
                WHERE gra_num='$gra_num' AND year_show='$prev_year_show'";

$sql_update_others_fac = "UPDATE others_fac SET gra_num='$gra_num',year_show='$doc_year'+543,fac_name='$others_fac',fac_code_full='$fac_code_full')
                          WHERE gra_num='$gra_num' AND year_show='$prev_year_show'";
$sql_update_tips = "UPDATE tips SET gra_num='$gra_num',tips='$tips',year_show='$doc_year'+543
                    WHERE gra_num='$gra_num' AND year_show='$prev_year_show'";

$sql_insert_others_fac = "INSERT INTO others_fac(gra_num,year_show,fac_name,fac_code_full)
                            VALUES('$gra_num','$doc_year'+543,'$others_fac','$fac_code_full')";
$sql_insert_tips = "INSERT INTO tips(gra_num,tips,year_show)
                    VALUES('$gra_num','$tips','$doc_year'+543)";

$sql_delete_others_fac = "DELETE FROM others_fac WHERE gra_num='$gra_num' AND year_show='$prev_year_show'";
$sql_delete_tips = "DELETE FROM tips WHERE gra_num='$gra_num' AND year_show='$prev_year_show'";

//QUERY
$query_check = $mysqli-> query($sql_check);

if((($reg_num==$prev_reg_num && $prev_year_show==($doc_year+543))===FALSE)&&(($query_check-> num_rows)>0)){ //กรณีเปลี่ยนเลขเอกสาร-ปี
    echo '<script type="text/javascript">
            window.location = document.referrer + "&saved=existed";
        </script>';
}
else{
    if ($mysqli->query($sql_update) === TRUE){
        if($prev_others_fac==1){
            if($fac_id=='999'){
                if($mysqli->query($sql_update_others_fac)===TRUE){
                    echo '<script type="text/javascript">
                        window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'&type=updatewithupdateothers";
                    </script>';
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "'.$prev_page.'.php?saved=error&type=errorwithupdateothers";
                </script>';
                }
                //update others_fac record
            }
            else{
                if($mysqli->query($sql_delete_others_fac)===TRUE){
                    echo '<script type="text/javascript">
                        window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'&type=updatewithdeleteothers";
                    </script>';
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "'.$prev_page.'.php?saved=error&type=errorwithdeleteothers";
                </script>';
                }
                // delete records    
            }
        }
        elseif($prev_others_fac==0){
            if($fac_id=='999'){
                if($mysqli->query($sql_insert_others_fac)===TRUE){
                    echo '<script type="text/javascript">
                        window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'&type=updatewithinsertothers";
                    </script>'; 
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "'.$prev_page.'.php?saved=error&type=errorwithinsertothers";";
                </script>';
                }
                //insert others_fac record
            }
        }    
        if($prev_tips==1){
            if($tips!=""){
                if($mysqli->query($sql_update_tips)===TRUE){
                    echo '<script type="text/javascript">
                        window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'&type=updatewithupdatetips";
                    </script>';
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "'.$prev_page.'.php?saved=error&type=errorwithupdatetips";
                </script>';
                }
                // update tips record
            }
            else{
                if($mysqli->query($sql_delete_tips)===TRUE){
                    echo '<script type="text/javascript">
                        window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'&type=updatewithdeletetips";
                    </script>';
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "'.$prev_page.'.php?saved=error&type=errorwithdeletetips";
                </script>';
                }
                // delete records
            }
        }
        elseif($prev_tips==0){
            if($tips!=""){
                if($mysqli->query($sql_insert_tips)===TRUE){
                    echo '<script type="text/javascript">
                        window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'&type=updatewithinserttips";
                        </script>'; 
                }
                else{
                    echo '<script type="text/javascript">
                    window.alert('.$mysqli ->error.');
                    window.location.href = "'.$prev_page.'.php?saved=error&type=errorwithinserttips";";
                    </script>';
                }
                // insert tips record
            }
        }
        echo '<script type="text/javascript">
                    window.location.href = "'.$prev_page.'.php?saved=updated&gra_num='.$gra_num.'";
                </script>';
    }
    else{
        echo '<script type="text/javascript">
        window.alert('.$mysqli ->error.');
        window.location.href = "'.$prev_page.'.php?saved=error";
        </script>';
    }
}

?>