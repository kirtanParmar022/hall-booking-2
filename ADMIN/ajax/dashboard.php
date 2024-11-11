<?php


require('../inc/db_confing.php');
require('../inc/essentials.php');
adminlogin();




if(isset($_POST['booking_analytics']))
{

  $frm_data=filteration($_POST);

  $Condition="";

  if($frm_data['period']==1){
    $Condition="WHERE date_time BETWEEN NOW()-INTERVAL 30 DAY AND NOW()";
  }
 else if($frm_data['period']==2){
    $Condition="WHERE date_time BETWEEN NOW()-INTERVAL 90 DAY AND NOW()";
  }
  else if($frm_data['period']==3){
    $Condition="WHERE date_time BETWEEN NOW()-INTERVAL 1 YEAR AND NOW()";
  }

 
  $result=mysqli_fetch_assoc(mysqli_query($con,"SELECT 

  COUNT(booking_id) AS `total_bookings`,

  COUNT(CASE WHEN booking_status= 'booked'  THEN 1 END) AS `active_bookings`,
  COUNT(CASE WHEN booking_status= 'cancelled'  THEN 1 END) AS `cancelled_bookings`

  FROM `book_now` $Condition"));

  $output=json_encode($result);

  echo $output;
  }

  if(isset($_POST['user_analytics']))
  {
  
    $frm_data=filteration($_POST);
  
    $Condition="";
  
    if($frm_data['period']==1){
      $Condition="WHERE date_time BETWEEN NOW()-INTERVAL 30 DAY AND NOW()";
    }
   else if($frm_data['period']==2){
      $Condition="WHERE date_time BETWEEN NOW()-INTERVAL 90 DAY AND NOW()";
    }
    else if($frm_data['period']==3){
      $Condition="WHERE date_time BETWEEN NOW()-INTERVAL 1 YEAR AND NOW()";
    }

    $total_review = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` FROM `ratting_review` $Condition "));

    $total_quries= mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` FROM `user_queries` $Condition "));

    $total_new_reg= mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(id) AS `count` FROM `user_creds` $Condition "));

    $output=['total_queriess'=> $total_quries['count'],
    'total_reviews'=>$total_review['count'],
    'total_new_reg'=> $total_new_reg['count']
   ];

   $output=json_encode($output);

   echo $output;
  } 


?>