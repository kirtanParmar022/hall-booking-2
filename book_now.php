<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title']?>-Booking Done</title>

</head>
<body class="bg-light" >

<?php require('inc/header.php'); ?>

    <div class="col-12 my-5 mb-2 px-4">
        <h2 class="fw-bold bm-6">BOOKING STATUS<h2>
    </div>

    <div class="col-12 px-4">
            <p class="fw-bold alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                Booking Successfully Done!
                <br><br>
                <a href="bookings.php">Go to Bookings</a>
            </p>
    </div>



<?php



date_default_timezone_set("Asia/kolkata");



 if(!(isset($_SESSION['login'])&&$_SESSION['login']==true)){
    redirect("index.php");
  }

  if(isset($_POST['pay_now']))
  {
    // insert booking data into database

    $frm_data=filteration($_POST);

    $query1="INSERT INTO `book_now`(`hall_id`,`user_id`, `check_in`, `check_out`) VALUES (?,?,?,?)";

    insert($query1,[$_SESSION['hall']['id'],$_SESSION['uId'],$frm_data['checkin'],$frm_data['checkout']],'ssss');

    $booking_id=mysqli_insert_id($con);

    $query2="INSERT INTO `bookin_details`( `booking_id`, `hall_name`, `price`, `user_name`, `phonenumber`, `address`) VALUES (?,?,?,?,?,?)";

    insert($query2,[$booking_id,$_SESSION['hall']['name'],$_SESSION['hall']['price'],$frm_data['name'],$frm_data['phonnum'],$frm_data['address']],'isssss');
  }
?>



<?php require('inc/footer.php'); ?>