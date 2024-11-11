<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<?php require('inc/links.php'); ?>
<title><?php echo $settings_r['site_title']?>-ABOUT US</title>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>


</head>
<body class="bg-light" >

<?php require('inc/header.php'); ?>
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">ABOUT US</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Hall Booking System is one stop point to find a perfect venue to <br>
    celebrate Birthday Party, Engagement, Wedding Reception, Anniversary party, <br>
    Baby Shower, Bachelor Party etc. 
    
  </p>
</div>

<div class="container">
 
    <div class="col-lg-12 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
      <h3 class="mb-3">Smart Hall Booking System.</h3>
      <section class="stack-content">
  <p>
	<strong>The Smart Hall Booking System</strong> is the Ahmedabad areas best source for a high quality venue at affordable prices. The Century Club is conveniently located directly off of Highway 153 insuring that it is easy to locate.</p>
<p>
	The Century Club is the perfect fit for all your event needs</p>
<ul>
	<li>
		Wedding Ceremony</li>
	<li>
		Wedding Reception</li>
	<li>
		Rehearsal dinner</li>
	<li>
		Baby Shower</li>
	<li>
		Business Meetings</li>
	<li>
		Sports Banquets</li>
	<li>
		Holiday Parties</li>
	<li>
		Reunions</li>
	<li>
		And much more</li>
</ul>
</section>	
    </div>
    <div class="col-lg-12 col-md-5 mb-4 order-lg-2 order-md-1 order-1">
    <h4 style="font-weight: bolder;margin-top: 35px;">WHY CHOOSE US</h4>
            <ul style="margin-left: -20px;">
            <li>We provide you best Venue options! We have brought together a rich mix of varied venues like banquet halls, conference centers, seminar halls and meeting rooms etc, so you can find what you need for your event.</li>
            <li>No charges, free service is offered to you! You won't be charged anything while receiving a quotation or booking a venue. You will always get the best rates.</li>
            <li>Reliable source! We have verified each venue before listing, so you can be assured to receive what you expect.</li>
           </ul>
  </div>
  </div>
</div>

<div class="container mt-5 ">

  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-wight rounded shadow p-4 border-top border-4 text-center">
        <img src="img/hall.jpg" width="135px">
        <h4 class="mt-3">50+ HALLS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-wight rounded shadow p-4 border-top border-4 text-center">
        <img src="img/customer.jpg" width="75px">
        <h4 class="mt-3">1500+ CUSTOMERS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-wight rounded shadow p-4 border-top border-4 text-center">
        <img src="img/reviews.jpg" width="100px">
        <h4 class="mt-3">300+ REVIEWS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-wight rounded shadow p-4 border-top border-4 text-center">
        <img src="img/staff.jpg" width="100px">
        <h4 class="mt-3">200+ STAFFS</h4>
      </div>
    </div>
  </div>
</div>

<h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3> 
<div class="container p-4">
<div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <?php
         $about_r=selectAll('team_details');
         $path=ABOUT_IMG_PATH;
         while($row= mysqli_fetch_assoc($about_r)){
          echo<<<data
          <div class="swiper-slide bg-white text-center overflow- hidden rounded">
            <img src="$path$row[picture]" class="w-100">
            <h5 class="mt-2">$row[name]</h5>
          </div>
          data;
         }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
</div>
<?php require('inc/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
      var swiper = new Swiper(".mySwiper", {
        effect:"coverflow",
        grabCursor:true,
        centeredSlides:true,
        slidesPerView: "auto",
        
        loop:true,
        coverflowEffect:{
          rotate:50,
          stretch:0,
          depth:100,
          modifier:1,
          slideShadows: false
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            
          },
          768: {
            slidesPerView: 2,
            
          },
          1024: {
            slidesPerView: 3,
           
          },
        },
      });
    </script>
      
</body>
</html>