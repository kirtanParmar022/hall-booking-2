<?php

       

require('../ADMIN/inc/db_confing.php');
require('../ADMIN/inc/essentials.php');

date_default_timezone_set("Asia/kolkata");
session_start();

if(!(isset($_SESSION['login'])&&$_SESSION['login']==true)){
    redirect("index.php");
  }

if(isset($_POST['review_form']))
{
    $frm_data = filteration($_POST);

    $upd_query="UPDATE `book_now` SET `rate_review`=?
        WHERE `booking_id`=? AND `user_id`=?";

        $upd_values=[1,$frm_data['booking_id'],$_SESSION['uId']];

        $upd_res=update($upd_query,$upd_values,'iii');

        $ins_query="INSERT INTO `ratting_review`(`booking_id`, `hall_id`, `user_id`, `ratting`, `review`) VALUES (?,?,?,?,?)";

        $ins_values=[$frm_data['booking_id'],$frm_data['hall_id'],$_SESSION['uId'],$frm_data['rating'],$frm_data['review']];

        $ins_result = insert($ins_query,$ins_values,'iiiis');
        echo $ins_result;

}
    
 ?>