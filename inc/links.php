<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/comman.css">

<?php

   session_start();
   date_default_timezone_set("Asia/kolkata");

   require('ADMIN/inc/db_confing.php');
   require('ADMIN/inc/essentials.php');

    $contact_q ="SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $settings_q ="SELECT * FROM `settings` WHERE `sr_no`=?";
    $values =[1];
    $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
    $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));
    
   if($settings_r['shutdown']){
    echo<<<alertbar
        <div class ='bg-danger text-center p-2 fw-bold'>
        <i class="bi bi-exclamation-triangle-fill"></i>
           Booking are temporarily closed!
        </div>
    alertbar;
   }
  ?>