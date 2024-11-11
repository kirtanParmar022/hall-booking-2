<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hotel boking</title>
<?php require('hotelbooking/links.php'); ?>
  

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<style>
	*{font-family: 'Poppins', sans-serif;}
  .h-font{
    font-family:'Meriends', cursive;

  }
 /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.custom-bg{
  background-color: rgb(27, 231, 122);
}

.custom-bg:hover{
  background-color: #f64417;
}
.availability-form{
  margin-top: -30px;
  z-index: 2;
  position:relative ;

}
@media screen and(max-width: 575px) {
  .availability-form{
  margin-top: 25px;
  padding:0 35px;
 
  }
  
}
</style>

</head>
<body class="bg-light" >

<?php require('hotelbooking/header.php'); ?>


<div class="container-fluid">

  <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="img/hallbooking1.jpg" class="w-100 d-block  " />
        </div>
        <div class="swiper-slide">
          <img src="img/hallbooking2.jpg" class="w-100 d-block " />
        </div>
        <div class="swiper-slide">
          <img src="img/hallbooking3.jpg" class="w-100 d-block " />
        </div>
        <div class="swiper-slide">
          <img src="img/hallbooking4.jpg" class="w-100 d-block  " />
        </div>
        <div class="swiper-slide">
          <img src="img/hallbooking5.jpg" class="w-100 d-block  " />
        </div>
      </div>
    
  </div>   
</div>




<div class="container availability-form bg-white">
  <div class="row">
    <div class="col-lg-12 bg-wight shadow p-4 rounded">
      <h5 class="mb-4">Check Booking Availability</h5>
      <form>
        <div class="row align-items-end">
           <div class="col-lg-3 mb-3">
              <label  class="form-label " style="font-weight:500;">Check-in</label>
              <input type="date" class="form-control shadow-none" >
           </div>
           <div class="col-lg-3 mb-3">
              <label for="exampleInputEmail1" class="form-label " style="font-weight:500;">Check-Out</label>
              <input type="date" class="form-control shadow-none" >
           </div>
           <div class="col-lg-3 mb-3">
           <label for="exampleInputEmail1" class="form-label " style="font-weight:500;">Adult</label>
            <select class="form-select shadow-none" >
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
           </select>
           </div>
           <div class="col-lg-2 mb-3">
           <label for="exampleInputEmail1" class="form-label " style="font-weight:500;">Childern</label>
           <select class="form-select shadow-none" >
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
           </select>
           </div>
           <div class="col-lg-1 mb-lg-3 mb-2">
            <button type="submit" class="btn text-wight shadow-none custom-bg">Submit</button>
           </div>
        </div>
      </form>
    </div>
  </div>
</div>
	

<h2 class="mt-5 pt-4 text-center fw-bold h-font">OUR HALLS</h2>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width:350px; margin:auto;">
        <img src="img/hallbooking1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">simple hall name</h5>
          <h6 class="card-subtitle mb-4 text-muted">2000₹ per Night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark  text-wrap">Lighting</span>
            <span class="badge rounded-pill bg-light text-dark  text-wrap">Food</span>
            <span class="badge rounded-pill bg-light text-dark  text-wrap">AC</span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning "></i>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <a href="#" class="btn btn-sm text-wight custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark text-wight ">More Details</a>
          </div>
        </div>
      </div>
 </div>
 <div class="col-lg-4 col-md-6 my-3">
  <div class="card border-0 shadow" style="max-width:350px; margin:auto;">
    <img src="img/hallbooking1.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">simple hall name</h5>
      <h6 class="card-subtitle mb-4 text-muted">2000₹ per Night</h6>
      <div class="features mb-4">
        <h6 class="mb-1">Features</h6>
        <span class="badge rounded-pill bg-light text-dark  text-wrap">Lighting</span>
        <span class="badge rounded-pill bg-light text-dark  text-wrap">Food</span>
        <span class="badge rounded-pill bg-light text-dark  text-wrap">AC</span>
      </div>
      <div class="rating mb-4">
        <h6 class="mb-1">Rating</h6>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning "></i>
      </div>
      <div class="d-flex justify-content-between mb-2">
        <a href="#" class="btn btn-sm text-wight custom-bg shadow-none">Book Now</a>
        <a href="#" class="btn btn-sm btn-outline-dark text-wight ">More Details</a>
      </div>
    </div>
  </div>
</div>




  <div class="col-lg-4 col-md-6 my-3">
    <div class="card border-0 shadow" style="max-width:350px; margin:auto;">
      <img src="img/hallbooking1.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">simple hall name</h5>
        <h6 class="card-subtitle mb-4 text-muted">2000₹ per Night</h6>
        <div class="features mb-4">
          <h6 class="mb-1">Features</h6>
          <span class="badge rounded-pill bg-light text-dark  text-wrap">Lighting</span>
          <span class="badge rounded-pill bg-light text-dark  text-wrap">Food</span>
          <span class="badge rounded-pill bg-light text-dark  text-wrap">AC</span>
        </div>
        <div class="rating mb-4">
          <h6 class="mb-1">Rating</h6>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning "></i>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <a href="#" class="btn btn-sm text-wight custom-bg shadow-none">Book Now</a>
          <a href="#" class="btn btn-sm btn-outline-dark text-wight ">More Details</a>
        </div>
      </div>
    </div>
</div>
</div><div class="col-lgl-12 text-center mt-5">
  <a href="#" class="btn btn-sm btn-outline-dark text-wight ">More Halls >></a>
</div>
</div>



  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Our Facility</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <div class="col-lg-2 col-md-2 text-center bg-wight rounded shadow py-4 my-3">
        <img src="img/wifi-icon.png" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-wight rounded shadow py-4 my-3">
        <img src="img/wifi-icon.png" width="80px">
        <h5 class="mt-3">WiFi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-wight rounded shadow py-4 my-3">
        <img src="img/wifi-icon.png" width="80px">
        <h5 class="mt-3">WiFi</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-wight rounded shadow py-4 my-3">
          <img src="img/wifi-icon.png" width="80px">
          <h5 class="mt-3">WiFi</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-wight rounded shadow py-4 my-3">
          <img src="img/wifi-icon.png" width="80px">
          <h5 class="mt-3">WiFi</h5>
        </div>
      </div>
      <div class="col-lgl-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark text-wight ">More Facility >></a>
      </div>
    </div>
  </div>

  <h2 class="mt-5 pt-4 text-center fw-bold h-font">TESTIMONIALS</h2>
  <div class="container">
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4">
            <h5 >
              <i class="bi bi-person-circle  m-0 ms-2"></i>	User 
            </h5>
          </div>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Sequi quisquam officia labore quis voluptas odio hic in necessitatibus. Maxime, expedita?
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">
              <i class="bi bi-person-circle  m-0 ms-2"></i>	User 
            </h5>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, aperiam! Deserunt ipsa expedita mollitia voluptate at! Possimus, voluptatem dicta dolores cum debitis eos ut, quae odit eligendi officia quos nemo?
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center p-4">
            <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">
              <i class="bi bi-person-circle  m-0 ms-2"></i>	User 
            </h5>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
             Possimus, aperiam! Deserunt ipsa expedita mollitia voluptate at! Possimus,
             voluptatem dicta dolores cum debitis eos ut, quae odit eligendi officia quos nemo?
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="col-lgl-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark text-wight ">Know more >> </a>
    </div>
  </div>


  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Reach us</h2>
  <div class="container">
    <div class="row">
          <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
            <iframe class="w-100 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117975.48217109336!2d71.69306128299796!3d22.476634950792167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39592f8822dba985%3A0xb0cdb8459d27b9b9!2sBhrugupur%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1669543373746!5m2!1sen!2sin"  height="320px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
     <div class="col-lg-4 col-md-4">
          <div class="bg-white  rounded mb-4 "></div>
            <h5> Call us</h5>
            <a href="tel: 919723438185" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>919723438185</a><br>
            <a href="tel: 919723438185" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>919723438185</a><br><br><br><br>
         <div class="bg-white  rounded mb-0 "></div>
            <h5> Follow us</h5>
            <a href="#" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-twitter"></i>  Twitter
              </span>
            </a><br>
              <a href="" class="d-inline-block mb-2 ">
                <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-facebook"></i>  Facebook
                </span>
              </a><br>
              <a href="" class="d-inline-block mb-">
                <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-instagram"></i>  Instagram
                </span>
              </a>
          </div>
        </div> 
    </div>
  </div>


  <?php require('hotelbooking/footer.php'); ?>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by Rohit Govindiya</h6>
 
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <script>
      var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop:true,
        autoplay:{
          deplay:3500,
          disableOnInteraction: false,
        }
       
      });
      var swiper = new Swiper(".swiper-testimonials", {
        effect:"coverflow",
        grabCursor:true,
        centeredSlides:true,
        slidesPerView: "auto",
        slidesPerView:" 3",
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