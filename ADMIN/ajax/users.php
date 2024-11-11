<?php


require('../inc/db_confing.php');
require('../inc/essentials.php');
adminlogin();




if(isset($_POST['get_users']))
{
  $res = selectAll('user_creds');
  $i=1;
  $path=USERS_IMG_PATH;

  $data ="";

  while($row = mysqli_fetch_assoc($res))
{
  $del_btn="<button type='button'  onclick='remove_user($row[id])' class='btn btn-danger shodowe-none btn-sm'>
  <i class='bi bi-trash'></i> ";

  $status="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>
  active</button>";

  if(!$row['status']){
    $status="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>
    inactive</button>";
  }

  $date=date("d-m-Y",strtotime($row['date_time']));
  $data.="
  <tr class='align-middle'>
  <td>$i</td>
  <td>
   <img src='$path$row[profile]' width='55px'>
   <br>
   $row[name]
  </td>
  <td>$row[email]</td>
  <td>$row[mobilenumber]</td>
  <td>$row[address]($row[pincod])</td>
  <td>$row[dob]</td>
  <td>$status</td>
  <td>$date</td>
  <td>$del_btn</td>
  </tr>
  ";
  $i++;
}

 echo $data;
}


if(isset($_POST['toggle_status']))
{
  $frm_data = filteration($_POST);

  $q = "UPDATE `user_creds` SET `status`=? WHERE `id`=?";
  $v = [$frm_data['value'],$frm_data['toggle_status']];

  if(update($q,$v,'ii')){
    echo 1;
  }else{
    echo 0;
  }
}


if(isset($_POST['remove_user']))
{
  $frm_data = filteration($_POST);

  $res =update("DELETE FROM `user_creds` WHERE `id`=?",[$frm_data['user_id']],'i');

  if($res){
    echo 1;
  }
  else{
    echo 0;
  }
}

if(isset($_POST['search_user']))
{
  $frm_data = filteration($_POST);

  $query="SELECT * FROM `user_creds` WHERE `name` LIKE ?";
  $res = select($query,["%$frm_data[name]%"],'s');
  $i=1;
  $path=USERS_IMG_PATH;

  $data ="";

  while($row = mysqli_fetch_assoc($res))
{
  $del_btn="<button type='button'  onclick='remove_user($row[id])' class='btn btn-danger shodowe-none btn-sm'>
  <i class='bi bi-trash'></i> ";

  $status="<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>
  active</button>";

  if(!$row['status']){
    $status="<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>
    inactive</button>";
  }

  $date=date("d-m-Y",strtotime($row['date&time']));
  $data.="
  <tr class='align-middle'>
  <td>$i</td>
  <td>
   <img src='$path$row[profile]' width='55px'>
   <br>
   $row[name]
  </td>
  <td>$row[email]</td>
  <td>$row[mobilenumber]</td>
  <td>$row[address]($row[pincod])</td>
  <td>$row[dob]</td>
  <td>$status</td>
  <td>$date</td>
  <td>$del_btn</td>
  </tr>
  ";
  $i++;
}

 echo $data;
}

?>