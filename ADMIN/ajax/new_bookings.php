<?php


require('../inc/db_confing.php');
require('../inc/essentials.php');
adminlogin();




if(isset($_POST['get_bookings']))
{

  $frm_data=filteration($_POST);
 $query ="SELECT bo.*,bd.* FROM `book_now` bo
 INNER JOIN `bookin_details` bd ON bo.booking_id = bd.booking_id
 WHERE (bd.phonenumber LIKE ? OR bd.user_name LIKE ?)
 AND bo.booking_status=?  ORDER BY bo.booking_id ASC";
 
 $res = select($query,["%$frm_data[search]%","%$frm_data[search]%",'success'],'sss');
 $i=1;
 $table_data="";
 if(mysqli_num_rows($res)==0){
  echo "<b>No Data Found!</b>";
  exit;
 }

 while($data=mysqli_fetch_assoc($res))
 {
  $date=date("d-m-Y",strtotime($data['date_time']));
  $checkin=date("d-m-Y",strtotime($data['check_in']));
  $checkout=date("d-m-Y",strtotime($data['check_out']));

  $table_data.="
  <tr>
   <td>$i</td>
   <td>
    <b> Name:</b>$data[user_name]
    <br>
    <b> Mobile No.:</b>$data[phonenumber]
    <br>
   </td>
   <td>
    <b>Hall:</b>$data[hall_name]
    <br>
    <b>Price:<b>$data[price]₹
   </td>
   <td>
     <b>Check in:</b>$checkin
     <br>
     <b>Check out:</b>$checkout
     <br>
     <b>Date:</b> $date 
   </td>
   <td>
   <button type='button' onclick='assign_hall($data[booking_id])' class='btn text-dark btn-sm fw-bold custom-bg shadow-none'>
    <i class='bi bi-check2-square'></i> Assign Hall
  </button>
   <br>
   <button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-outline-danger mt-2 btn-sm fw-bold  shadow-none'>
   <i class='bi bi-trash'></i>Cancel Booking
   </button>
   </td>
  </tr> 
  ";

  $i++;
 }
 echo $table_data;
}


if(isset($_POST['assign_hall']))
{
  $frm_data = filteration($_POST);

   $query ="UPDATE `book_now` SET `booking_status`=? WHERE `booking_id`=?";
   $values=['booked',$frm_data['booking_id']];
   $res =update($query,$values,'si');
   echo $res;

  }
if(isset($_POST['cancel_booking']))
{
  $frm_data = filteration($_POST);

   $query ="UPDATE `book_now` SET `booking_status`=? WHERE `booking_id`=?";
   $values=['cancelled',$frm_data['booking_id']];
   $res =update($query,$values,'si');
   echo $res;

  }




?>