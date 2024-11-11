<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php require('inc/links.php'); 
        

  ?>
  <title><?php echo $settings_r['site_title']?>-BOOKING</title>

</head>
<body class="bg-light" >

<?php require('inc/header.php');
if(!(isset($_SESSION['login'])&&$_SESSION['login']==true)){
  redirect("index.php");
}
   ?>






<div class="container">
  <div class="row">
    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold ">BOOKINGS</h2>
    </div>

    <?php
        $query="SELECT bo.*,bd.* FROM `book_now` bo
        INNER JOIN `bookin_details` bd ON bo.booking_id = bd.booking_id
        WHERE ((bo.booking_status='booked') 
        OR (bo.booking_status='cancelled'))
        AND bo.user_id=? ORDER BY bo.booking_id DESC";

        $result = select($query,[$_SESSION['uId']],'i');

        while($data=mysqli_fetch_assoc($result))
        {
          $date=date("d-m-Y",strtotime($data['date_time']));
          $checkin=date("d-m-Y",strtotime($data['check_in']));
          $checkout=date("d-m-Y",strtotime($data['check_out']));

          $status_bg="";
          $btn="";

          if($data['booking_status']=='booked'){
            $status_bg="bg-success";
            if($data['arrival']==0){
              if($data['rate_review']==0){
              $btn="
              <button type='button' onclick='review_hall($data[booking_id],$data[hall_id])' class='btn btn-dark btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#review'>
              Rate & Review</button>
              ";
              }
            }
            else{
              $btn="<button onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none'>
              cancel Booking</button>";
            }
          }
          else {
            $status_bg="bg-danger";
         
           
          }

          echo<<<bookings
            <div class='col-md-4 px-4 mb-4'>
             <div class='bg bg-white p-3 rounded shadow-sm'>
                <h5 class='fw-bold'>$data[hall_name]<h5>
                <p>$data[price]₹</p>
                <p>
                  <b>Check in: </b> $checkin<br>
                  <b>Check out: </b> $checkout
                </p>
                <p>
                  <b>Amount: </b> $data[price]₹<br>
                  <b>Date: </b> $date
                </p>
                <p>
                  <span class='badge $status_bg'>$data[booking_status]<span>
                  
                </p>
                $btn
             </div>
            </div> 
          bookings;
          
        }

    ?>
  </div>
</div>

<div class="modal fade" id="review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="review-form">
     <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">
              <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i>	Rate & Review
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Rate</label>
          <select class="form-select shadow-none" name="rating">
            <option value="5">Excellent</option>
            <option value="4">Good</option>
            <option value="3">ok</option>
            <option value="2">poor</option>
            <option value="1">bad</option>
          </select>
         </div>
         <div class="mb-4">
             <label for="exampleInputEmail1" class="form-label">Review</label>
             <textarea  name="review" rows="3" class="form-control shadow-none" required ></textarea>
         </div>

         <input type="hidden" name="booking_id">
         <input type="hidden" name="hall_id">
      
        <div class="text-end">
	           <button type="submit" class="btn btn-dark btn-sm shadow-none">Submit</button>
          </div>
     </div>
     </div>
    </form>
  </div>
</div>

<?php
 if(isset($_GET['cancel_status'])){
  alert('success','Booking cancelled!');
 }
 else if(isset($_GET['review_status'])){
  alert('success','Thank you for Ratting & Review!');
 }
?>
    <?php require('inc/footer.php'); ?>

<script>

  function cancel_booking(id)
  {
    if(confirm('Are you sure to cancel booking?'))
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/cancel_booking.php",true);
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');


      xhr.onload = function(){
       if(this.responseText==1){
        window.location.href="bookings.php?cancel_status=true";
       }
       else{
        alert('error','Cancellation failed!');
       }
      }

    xhr.send('cancel_booking&id='+id);
  }
 }
  
 let review_form =document.getElementById('review-form');

 function review_hall(bid,hid)
 {
  review_form.elements['booking_id'].value=bid;
  review_form.elements['hall_id'].value=hid;
 }

 review_form.addEventListener('submit',function(e){
  e.preventDefault();

  let data = new FormData();
  data.append('review_form','');
  data.append('rating',review_form.elements['rating'].value);
  data.append('review',review_form.elements['review'].value);
  data.append('booking_id',review_form.elements['booking_id'].value);
  data.append('hall_id',review_form.elements['hall_id'].value);
 
 

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/review_hall.php",true);

  xhr.onload=function(){
    if(this.responseText==1){
      
      window.location.href='bookings.php?review_status=true';
  
    }
    else{
      var myModal =document.getElementById('review');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      alert('error',"Rating & Review failed!");
      
    }
  }
  xhr.send(data);
 });
  </script>
</body>
</html>