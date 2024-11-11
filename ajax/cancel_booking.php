<?php

       

require('../ADMIN/inc/db_confing.php');
require('../ADMIN/inc/essentials.php');

date_default_timezone_set("Asia/kolkata");
session_start();

if(!(isset($_SESSION['login'])&&$_SESSION['login']==true)){
    redirect("index.php");
  }

if(isset($_POST['cancel_booking']))
{
    $frm_data = filteration($_POST);

    $query="UPDATE `book_now` SET `booking_status`=?
        WHERE `booking_id`=? AND `user_id`=?";

        $values=['cancelled',$frm_data['id'],$_SESSION['uId']];

        $res=update($query,$values,'sii');

        echo $res;

}
    
 ?>