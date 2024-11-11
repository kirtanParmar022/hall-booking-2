<?php
require('inc/essentials.php');
require('inc/db_confing.php');

adminlogin();
session_regenerate_id(true);

if(isset($_GET['seen']))
{
  $frm_data= filteration($_GET);

  if($frm_data['seen']=='all'){
    $q="UPDATE `ratting_review` SET `seen`=? ";
    $values =[1];
    if(update($q,$values,'i')){
      alert('success','Mark all as read!');
    }else{
    alert('error','operation failed!');
    }
  }
  else{
    $q="UPDATE `ratting_review` SET `seen`=? WHERE `sr_no`=?";
    $values =[1,$frm_data['seen']];
    if(update($q,$values,'ii')){
      alert('success','Mark as read!');
    }else{
    alert('error','operation failed!');
    }
  }
}
if(isset($_GET['del']))
{
  $frm_data= filteration($_GET);

  if($frm_data['del']=='all'){
    $q="DELETE FROM `ratting_review`  ";
   
    if(mysqli_query($con,$q)){
      alert('success','All Data Deleted!');
    }else{
    alert('error','operation failed!');
    }
  }
  else{
    $q="DELETE FROM `ratting_review`  WHERE `sr_no`=?";
    $values =[$frm_data['del']];
    if(delete($q,$values,'i')){
      alert('success','Data Deleted!');
    }else{
    alert('error','operation failed!');
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rattings & Reviews</title>
    <?php
require('inc/links.php');
?>
<style>
      #dashboard-menu{
      position: fixed;
      height: 100%;
      z-index: 11;
    }

    @media screen and (max-width:991px) {
      #dashboard-menu{
        height: auto;
        width: 100%;
      }

    
    #main-content{
        margin-top:60px ;
      }
  }
</style>
</head>
<body class="bg-light">
<?php
require('inc/header.php');
?>
 
 <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden" >
           <h4 class="mb-4">RATTINGS & REVIEWS<h4> 
           
          
           
            <div class="card border-0 shadow-sm mb-4 overflow-hidden"  >
              <div class="card-body">

              <div class="text-end mb-4">
               <a href='?seen=all' class='btn btn-dark rounded-pill shadow-none btn-sm'>Mark all read</a>
               <a href='?del=all' class='btn btn-danger rounded-pill shadow-none btn-sm'>Delete all </a>
              </div>
                  
                <div class="table-responsive-md" >
                <table class="table table-hover border">
                  <thead class="">
                    <tr class="bg-dark font-size: 10pt  text-light">
                      <th scope="col">#</th>
                      <th scope="col">Hall Name</th>
                      <th scope="col" >User Name</th>
                      <th scope="col" >Ratting</th>
                      <th scope="col" >Review</th>
                      <th scope="col" >Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $q ="SELECT rr.*,uc.name AS uname, r.name AS hname FROM `ratting_review` rr
                      INNER JOIN `user_creds` uc ON rr.user_id=uc.id
                      INNER JOIN `halls` r ON rr.hall_id=r.id
                      ORDER BY `sr_no` DESC";
                      $data = mysqli_query($con,$q);
                      $i=1;

                      while($row= mysqli_fetch_assoc($data)){
                        $date = date('d-m-Y',strtotime($row['date_time']));
                        $seen='';
                        if($row['seen']!=1){
                          $seen="<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Mark as read</a>";
                        }
                        $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";
                        echo<<<query
                        <tr>
                        <td>$i</td>
                        <td>$row[hname]</td>
                        <td>$row[uname]</td>
                        <td>$row[ratting]</td>
                        <td>$row[review]</td>
                        <td>$date</td>
                        <td>$seen</td>
                        
                        </tr>
                        query;
                        $i++;
                      }
                      ?>
                  </tbody>
               </table>
              </div>

              </div>
            </div>     
        </div>
    </div>
  </div>
  

<?php
require('inc/script.php');
?>  
</body>
</html>