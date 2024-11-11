<?php


require('../inc/db_confing.php');
require('../inc/essentials.php');
adminlogin();



if(isset($_POST['add_features'])){
    $frm_data =filteration($_POST);
    $q="INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$frm_data['name']];
        $res = insert($q,$values,'s');
        echo $res;


}

if(isset($_POST['get_features'])){
  $res= selectAll('features');
  $i=1;
  while($row = mysqli_fetch_assoc($res))
  { 
   
    echo <<<data
        <tr>
          <td>$i</td>
          <td>$row[name]</td>
          <td>
          <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
          <i class="bi bi-trash"></i> Delete
          </button>
          </td>
        </tr>
      data;
      $i++;
  }
}

if(isset($_POST['rem_feature'])){
  $frm_data =filteration($_POST);
  $values = [$frm_data['rem_feature']];

  $check_q = select('SELECT*FROM `hall_features` WHERE`features_id`=?',[$frm_data['rem_feature']],'i');

  if(mysqli_num_rows($check_q)==0){
    $q = "DELETE FROM `features` WHERE `id`=?";
    $res = update($q,$values,'i');
    echo $res;
  }
  else{
    echo 'hall_added';
  }
 
}


if(isset($_POST['add_facility'])){
  $frm_data =filteration($_POST);
$img_r = uplodSVGImage($_FILES['icon'],FACILITYS_FOLDER);
     
    if($img_r =='inv_img'){
      echo $img_r;
    }
    else if($img_r=='inv_size'){
      echo $img_r;
    }
    else if ($img_r=='upd_failed'){
      echo $img_r;
    }
    else{
      $q = "INSERT INTO `facilitys`(`icon`, `name`, `description`)  VALUES (?,?,?)";
      $values = [$img_r,$frm_data['name'],$frm_data['desc']];
      $res = insert($q,$values,'sss');
      echo $res;
    }

}

if(isset($_POST['get_facilitys'])){
  $res= selectAll('facilitys');
  $i=1;
  $path =FACILITYS_IMG_PATH;
  while($row = mysqli_fetch_assoc($res))
  { 
   
    echo <<<data
        <tr class="align-middel">
          <td>$i</td>
          <td><img src="$path$row[icon]" width="100px"></td>
          <td>$row[name]</td>
          <td>$row[description]</td>
          <td>
          <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
          <i class="bi bi-trash"></i> Delete
          </button>
          </td>
        </tr>
      data;
      $i++;
  }
}

if(isset($_POST['rem_facility'])){
  $frm_data =filteration($_POST);
  $values = [$frm_data['rem_facility']];

  $check_q = select('SELECT*FROM `hall_facilitys` WHERE`facilitys_id`=?',[$frm_data['rem_facility']],'i');

  if(mysqli_num_rows($check_q)==0){
    $pre_q="SELECT * FROM `facilitys` WHERE `id`=?";
    $res =select($pre_q,$values,'i');
    $img = mysqli_fetch_assoc($res);
  
    if(deleteImage($img['icon'],FACILITYS_FOLDER)){
      $q = "DELETE FROM `facilitys` WHERE `id`=?";
      $res = update($q,$values,'i');
      echo $res;
    }
    else{
      echo 0;
    }
  }
  else{
    echo 'hall_added';
  }
 

  

 
}
?>