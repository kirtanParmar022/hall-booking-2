<?php

       

require('../ADMIN/inc/db_confing.php');
require('../ADMIN/inc/essentials.php');

if(isset($_POST['info_form']))
{
    $data = filteration($_POST);
    session_start();

   
    $query="UPDATE `user_creds` SET `name`=?,`address`=?,`pincod`=?,`dob`=?  WHERE `id`=?";
    $values=[$data['name'],$data['address'],$data['pincode'],$data['dob'],$_SESSION['uId']];

    if(update($query,$values,'sssss')){
        $_SESSION['uname']=$data['name'];
        echo 1;
    }
    else{
        echo 0;
    }

 }

 if(isset($_POST['profile_form']))
{
   
    session_start();
    $img = uplodImage($_FILES['profile'],USERS_FOLDER);
    
    if($img=='inv_img'){
        echo'inv_img';
        exit;
    }
     elseif($img=='upd_failed'){
        echo'upd_failed';
        exit;
     }

     
    $u_exist = select("SELECT `profile` FROM `user_creds` 
    WHERE  `id`=? LIMIT 1",[$_SESSION['uId']],'s');

    $u_fetch = mysqli_fetch_assoc($u_exist);

    deleteImage($u_fetch['profile'],USERS_FOLDER);

   
    $query="UPDATE `user_creds` SET `profile`=?  WHERE `id`=?";
    $values=[$img,$_SESSION['uId']];

    if(update($query,$values,'ss')){
       $_SESSION['uPic']=$img;
        echo 1;
    }
    else{
        echo 0;
    }

 }

 if(isset($_POST['pass_form']))
 {
    $data = filteration($_POST);
     session_start();
    
     if($data['new_pass']!=$data['confirm_pass']){
        echo 'mismatch';
        exit;
     }
 
     $enc_pass = password_hash($data['new_pass'],PASSWORD_BCRYPT);
 
      
 
    
     $query="UPDATE `user_creds` SET `password`=?  WHERE `id`=? limit 1";
     $values=[$enc_pass,$_SESSION['uId']];
 
     if(update($query,$values,'ss')){
       
         echo 1;
     }
     else{
         echo 0;
     }
 
  }

?>