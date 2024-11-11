<?php


require('../inc/db_confing.php');
require('../inc/essentials.php');
adminlogin();




if(isset($_POST['get_bookings']))
{
  $frm_data=filteration($_POST);

  $limit=6;
  $page=$frm_data['page'];
  $start=($page-1)*$limit;


 $query ="SELECT bo.*,bd.* FROM `book_now` bo
 INNER JOIN `bookin_details` bd ON bo.booking_id = bd.booking_id
 WHERE ((bo.booking_status='booked') OR(bo.booking_status='cancelled'))
 AND  (bd.phonenumber LIKE ? OR bd.user_name LIKE ?)
 ORDER BY bo.booking_id DESC";
 
 $res = select($query,["%$frm_data[search]%","%$frm_data[search]%"],'ss');

 $limit_query=$query ." LIMIT $start,$limit";
 $limit_res= select($limit_query,["%$frm_data[search]%","%$frm_data[search]%"],'ss');

 $i=$start+1;
 $table_data="";

 $total_rows=mysqli_num_rows($res);


 if($total_rows==0){
  $output=json_encode(["table_data"=>"<b>No Data Found!</b>","pagination"=>'']);
  echo $output;
  exit;
 }

 while($data=mysqli_fetch_assoc($limit_res))
 {
  $date=date("d-m-Y",strtotime($data['date_time']));
  $checkin=date("d-m-Y",strtotime($data['check_in']));
  $checkout=date("d-m-Y",strtotime($data['check_out']));

  if($data['booking_status']=='booked'){
    $status_bg='bg-success';
  }
  else{
    $status_bg='bg-danger';
  }
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
     <b>Date:</b> $date 
   </td>
   <td>
     <span class='badge $status_bg'>$data[booking_status]</span>
   </td>
  </tr> 
  ";

  $i++;
 }



$pagination="";

if($total_rows>$limit)
{
  $total_pages=$total_rows/$limit;

  $disabled=($page==1)?"disabled":"";
  $prev=$page-1;
  $pagination.="<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'>prev</button></li>";

  $disabled=($page==$total_pages)?"disabled":"";
  $next=$page+1;
  $pagination.="<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link shadow-none'>Next</button></li>";
}
$output=json_encode(["table_data"=>$table_data,"pagination"=>$pagination]);
 echo $output ;
}






?>