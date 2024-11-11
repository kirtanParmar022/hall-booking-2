<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title']?>-CONFIRM BOOKING</title>

</head>
<body class="bg-light" >

<?php require('inc/header.php'); ?>

<!-- /*
check hall id from url is present or not shutdown mode is active or not
user is logged in or not*/ -->


<?php
  if(!isset($_GET['id'])|| $settings_r['shutdown']==true){
    redirect("ourhall.php");
  }
  else if(!(isset($_SESSION['login'])&&$_SESSION['login']==true)){
    redirect("ourhall.php");
  }

  // filter and get hall and user data

  $data = filteration($_GET);

  $hall_res = select("SELECT * FROM `halls` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');
 
  if(mysqli_num_rows($hall_res)==0){
    redirect("ourhall.php");
  }
   
  $hall_data = mysqli_fetch_assoc($hall_res);

  $_SESSION['hall']=[
    "id"=>$hall_data['id'],
    "name"=>$hall_data['name'],
    "price"=>$hall_data['price'],
    "payment"=>null,
    "available"=>false,
  ];

  $user_res= select("SELECT * FROM  `user_creds` WHERE `id`=? LIMIT 1",
  [$_SESSION['uId']],'i');
  $user_data = mysqli_fetch_assoc($user_res);
 
?>


<div class="container">
  <div class="row">

    <div class="col-12 my-5 mb-4 px-4">
      <h2 class="fw-bold ">CONFIRM BOOKING</h2>
    </div>
      
    <div class="col-lg-7 col-md-12 px-4 ">
     
          <?php 
          $hall_thumb = HALLS_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($con,"SELECT *FROM `hall_image` 
          WHERE `hall_id`='$hall_data[id]' 
          AND `thumb`='1'");

          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $hall_thumb = HALLS_IMG_PATH.$thumb_res['image'];  
          }
          echo<<<data
            <div class=" card p-3 shadow-sm rounded">
              <img src="$hall_thumb" class="img-fluid rounded mb-3">
              <h5>$hall_data[name]<h5>
              <h6>$hall_data[price]₹ per day<h6>
            </div>
          data;
          ?>
      </div>
    
    <div class="col-lg-5 col-md-12 px-4">
      <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body">
          <form action="book_now.php" method="POST" id="booking_form">
            <h6 class="mb-3">BOOKING DETAILS</h6>
            <div class="row">
              <div class="col-md-6 mb-1">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none mb-2" required >
              </div>
              <div class="col-md-6 mb-1">
                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                <input name="phonnum" type="number" value="<?php echo $user_data['mobilenumber'] ?>" class="form-control shadow-none" required >
              </div>
              <div class="col-md-12 mb-1">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                <textarea name="address"  class="form-control shadow-none mb-2" rows="1" required><?php echo $user_data['address'] ?></textarea>
              </div>
              <div class="col-md-6 mb-1">
                <label for="exampleInputEmail1" class="form-label">Check-in</label>
                <input name="checkin" onchange="check_availability()" type="date"  class="form-control shadow-none" required >
              </div>
              <div class="col-md-6 mb-4">
                <label for="exampleInputEmail1" class="form-label">Check-out</label>
                <input name="checkout" onchange=" check_availability()" type="date"  class="form-control shadow-none" required >
              </div>
              <div class="col-md-12">
                <div class="spinner-border mb-3 text-info d-none" id="info_loader" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
                <h6 class="mb-3 text-danger" id="pay_info">Provide check-in & Check-out date! </h6>
                <button name="pay_now" class="btn w-100 text-dark  custom-bg shadow-none" disabled>Book Now</button>
              </div>
            </div> 
          </form>
        </div>
      </div>            
    </div>

   </div>
</div>
    <?php require('inc/footer.php'); ?>

<script>
  let booking_form = document.getElementById('booking_form');
  let info_loader=document.getElementById('info_loader');
  let pay_info=document.getElementById('pay_info');

  function check_availability()
  {
    let checkin_val = booking_form.elements['checkin'].value;
    let checkout_val = booking_form.elements['checkout'].value;

    booking_form.elements['pay_now'].setAttribute('disabled',true);


    // booking_form.elements['pay_now'].setAttribute('disabled',true);

    if(checkin_val!='' && checkout_val!='')
    {
      pay_info.classList.add('d-none');
      pay_info.classList.replace('text-dark','text-danger');
      info_loader.classList.remove('d-none');
             
      let data = new FormData();

      data.append('check_availability','');
      data.append('check_in',checkin_val);
      data.append('check_out',checkout_val);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/confirm_booking.php",true);

      xhr.onload = function()
      {
      
        let data = JSON.parse(this.responseText);
       

        if(data.status=='check_in_out_equle'){
          pay_info.innerText="You cannot check-out on the same day!";
        }
        else if(data.status=='check_out_earlier'){
          pay_info.innerText="check-out date is earlier than check-in date!";
        }
        else if(data.status=='check_in_earlier'){
          pay_info.innerText="check-in date is earliar than today's date!";
        }
        else if(data.status=='unavailable'){
          pay_info.innerText=" Hall not available for this check-in date!";
        }
        else{
          pay_info.innerHTML="No. of Days: "+data.days+"<br>Total Amount to pay: ₹"+data.payment;
          pay_info.classList.replace('text-danger','text-dark');
          booking_form.elements['pay_now'].removeAttribute('disabled');
        }
        pay_info.classList.remove('d-none');
        info_loader.classList.add('d-none');
      }
      xhr.send(data);
      }


  }
</script>
      
</body>
</html>