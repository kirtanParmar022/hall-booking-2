<?php

       

require('../ADMIN/inc/db_confing.php');
require('../ADMIN/inc/essentials.php');

if(isset($_POST['register']))
{
    $data = filteration($_POST);

    // match password and confirm password feild 

    if($data['pass']!=$data['cpass']){
        echo 'pass_mismatch';
        exit;
    }

    // check user exists or not 
    
    $u_exist = select("SELECT * FROM `user_creds` 
    WHERE `email`=? OR `mobilenumber`=? LIMIT 1",[$data['email'],$data['phonenum']],'ss');

    if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] ==$data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // upload user image to server

    $img = uplodImage($_FILES['profile'],USERS_FOLDER);
    
    if($img=='inv_img'){
        echo'inv_img';
        exit;
    }
     elseif($img=='upd_failed'){
        echo'upd_failed';
        exit;
     }

     

        $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

        $query="INSERT INTO `user_creds`( `name`, `email`, `address`, `mobilenumber`, `pincod`, `dob`, `profile`, `password`) VALUES (?,?,?,?,?,?,?,?)";

        $values=[$data['name'],$data['email'],$data['address'],$data['phonenum'],$data['pincode'],$data['dob'],
                 $img, $enc_pass];

        if(insert($query,$values,'ssssssss')){
            echo 1;
        }         
         else{
            echo'ins_failed';
         }
 }


 if(isset($_POST['login']))
 {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_creds` 
    WHERE `email`=? OR `mobilenumber`=? LIMIT 1",[$data['email_mob'],$data['email_mob']],'ss');

    if(mysqli_num_rows($u_exist)==0)
    {
        echo'inv_email_mob';
       
    }
    else
    {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            if(!password_verify($data['pass'],$u_fetch['password'])){
            echo'invalid_pass';
        }
        else{
            session_start();
            $_SESSION['login']=true;
            $_SESSION['uId']=$u_fetch['id'];
            $_SESSION['uName']=$u_fetch['name'];
            $_SESSION['uPic']=$u_fetch['profile'];
            $_SESSION['uphone']=$u_fetch['phonenum'];
            echo 1;
          }
      }
    }
 }

 if(isset($_POST['forgot']))
 {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_creds` 
    WHERE  `mobilenumber`=?  LIMIT 1",[$data['email_mob']],'s');

    if(mysqli_num_rows($u_exist)==0)
    {
        echo'inv_email_mob';
       
    }
    else
    {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{

            if($data['dob']!=$u_fetch['dob']){
            echo'invalid_dob';
            }
            else if($data['new_pass']!=$data['cpass']){
                echo 'mismatch';
                exit;
            }else{
            $enc_pass = password_hash($data['new_pass'],PASSWORD_BCRYPT);
 
      
 
    
            $query="UPDATE `user_creds` SET `password`=?  WHERE `mobilenumber`=? limit 1";
            $values=[$enc_pass,$data['email_mob']];
        
            if(update($query,$values,'ss')){
              
                echo 1;
            }
            else{
                echo 0;
            }
           } 
        }
        
      }
    }


?>