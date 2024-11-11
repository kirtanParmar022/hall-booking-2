<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<?php require('inc/links.php'); ?>
<title><?php echo $settings_r['site_title']?>-HOME</title>

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<style>
  
	
.h-line{
  width: 150px;
  margin: 0 auto; 
  height: 1.7px;
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

<?php require('inc/header.php'); ?>


<div class="container-fluid">
  <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php
         $res= selectAll('carousel');
          while($row = mysqli_fetch_assoc($res))
          { 
            $path = CAROUSEL_IMG_PATH;
            echo <<<data
             <div class="swiper-slide">
              <img src="$path$row[image]" class="w-100 d-block">
             </div>
            data;
          }
        ?>
      </div>
  </div>   
</div>

  <!-- Availability -->
  <div class="container availability-form bg-white">
  <div class="row">
    <div class="col-lg-12 bg-wight shadow p-4 rounded">
      <h5 class="mb-4">Check Booking Availability</h5>
      <form action="ourhall.php">
        <div class="row align-items-end">
           <div class="col-lg-4 mb-3">
              <label  class="form-label " style="font-weight:500;">Check-in</label>
              <input type="date" class="form-control shadow-none" name="checkin" required >
           </div>
           <div class="col-lg-4 mb-3">
              <label for="exampleInputEmail1" class="form-label " style="font-weight:500;">Check-Out</label>
              <input type="date" class="form-control shadow-none" name="checkout" required>
           </div>
           <div class="col-lg-3 mb-3">
            <label for="exampleInputEmail1" class="form-label " style="font-weight:500;">Guests</label>
            <input type="number" name="guests"  class="form-control shadow-none " >
           </div>
           <input type="hidden" name="check_availability">
         <div class="col-lg-1 mb-lg-3 mb-2">
           <button type="submit" class="btn text-wight shadow-none custom-bg">Submit</button>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
  <!-- HALLS -->
  <h2 class="mt-5 pt-4 text-center fw-bold h-font">OUR HALLS</h2>
  <div class="container">
    <div class="row">
  <?php
        $hall_res = select("SELECT * FROM `halls` WHERE `status`=? AND `removed`=?  ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

        while($hall_data = mysqli_fetch_assoc($hall_res))
        {
          // get features of halls 

          $fea_q =mysqli_query($con,"SELECT f.name FROM `features` f 
            INNER JOIN `hall_features` hfea ON f.id=hfea.features_id
            WHERE hfea.hall_id ='$hall_data[id]'");

          $features_data ="";
          while($fea_row = mysqli_fetch_assoc($fea_q)){
            $features_data .="<span class='badge rounded-pill bg-light text-dark  text-wrap me-1'>
            $fea_row[name]
            </span>";
          }  

          // get facility of halls 
          $fac_q =mysqli_query($con,"SELECT f.name FROM `facilitys` f 
          INNER JOIN `hall_facilitys` hfac ON f.id=hfac.facilitys_id 
          WHERE hfac.hall_id ='$hall_data[id]'");

          $facilitys_data ="";
          while($fac_row= mysqli_fetch_assoc($fac_q)){
            $facilitys_data .="<span class='badge rounded-pill bg-light text-dark  text-wrap me-1'>
            $fac_row[name]
            </span>";
          }

          // get thumbnail of halls

          $hall_thumb = HALLS_IMG_PATH."thumbnail.jpg";
          $thumb_q = mysqli_query($con,"SELECT *FROM `hall_image` 
          WHERE `hall_id`='$hall_data[id]' 
          AND `thumb`='1'");

          if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $hall_thumb = HALLS_IMG_PATH.$thumb_res['image'];  
          }

          $book_btn="";
         
          if(!$settings_r['shutdown']){
            $login=0;
            if(isset($_SESSION['login'])&&$_SESSION['login']==true)
            {
              $login=1;
            }
            $book_btn="<button onclick='checklogintobook($login,$hall_data[id])' class='btn btn-sm text-wight custom-bg shadow-none'>Book Now</button>";
            
          }

          $rating_q="SELECT AVG(ratting) AS `avg_ratting` FROM `ratting_review`
            WHERE `hall_id`='$hall_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

           $rating_res=mysqli_query($con,$rating_q);
           $rating_fetch= mysqli_fetch_assoc($rating_res);

           $rating_data="";
            if($rating_fetch['avg_ratting']!=NULL)
            {
              $rating_data=" <div class='rating mb-4'>
              <h6 class='mb-1'>Rating</h6>
              <span class='badge rounded-pill bg-light'>";

              for($i=0;$i<$rating_fetch['avg_ratting'];$i++){
                $rating_data .=" <i class='bi bi-star-fill text-warning'></i>";
              }

              $rating_data .="</span>
              </div>";
            }
          
          // print hall cards 

          echo<<<data
          <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width:350px; margin:auto;">
              <img src="$hall_thumb" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">$hall_data[name]</h5>
                <h6 class="card-subtitle mb-4 text-muted">$hall_data[price]₹ per Day</h6>
                <div class="features mb-4">
                  <h6 class="mb-1">Features</h6>
                  $features_data
                </div>
                <div class="features mb-4">
                  <h6 class="mb-1">Facilities</h6>
                  $facilitys_data
                </div>
                $rating_data
                <div class="d-flex justify-content-between mb-2">
                  $book_btn
                  <a href='hall_details.php?id=$hall_data[id]' class='btn btn-sm btn-outline-dark text-wight '>More Details</a>
                </div>
              </div>
            </div>
          </div>
          data;
        }
     ?>
  <div class="col-lgl-12 text-center mt-5">
  <a href="ourhall.php" class="btn btn-sm btn-outline-dark text-wight ">More Halls >></a>
</div>
</div>
  </div>
  <!-- Facility -->

  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Our Facility</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
    <?php
    $res = selectAll('facilitys');
    $path = FACILITYS_IMG_PATH;
    while($row= mysqli_fetch_assoc($res)){
      echo<<<data
        <div class="col-lg-2 col-md-2 text-center bg-wight rounded shadow py-4 my-3">
        <img src="$path$row[icon]" width="60px">
          <h5 class="mt-3">$row[name]</h5>
        </div>
      data;
    }
    ?>
        
    <div class="col-lgl-12 text-center mt-5">
        <a href="facility.php" class="btn btn-sm btn-outline-dark text-wight ">More Facility >></a>
      </div>
  </div>
  </div>
  <!-- TESTIMONIALS-->

  <h2 class="mt-5 pt-4 text-center fw-bold h-font">TESTIMONIALS</h2>
  <div class="container">
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">
         <?php
          $review_q="SELECT rr.*,uc.name AS uname, uc.profile, r.name AS hname FROM `ratting_review` rr
          INNER JOIN `user_creds` uc ON rr.user_id=uc.id
          INNER JOIN `halls` r ON rr.hall_id=r.id
          ORDER BY `sr_no` DESC LIMIT 6";

          $review_res=mysqli_query($con,$review_q);
          $img_path=USERS_IMG_PATH;
         
          if(mysqli_num_rows($review_res)==0){
            echo 'No reviews yet!';
          }
          else{
            while($row=mysqli_fetch_assoc($review_res))
            {
              $stars="<i class='bi bi-star-fill text-warning '></i> ";
              for($i=1;$i<$row['ratting'];$i++){
                $stars .=" <i class=' bi bi-star-fill text-warning'></i>";
              }
              echo<<<slide
                <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="30px">
                  <h6 class="m-0 ms-2">$row[uname]</h6>
                </div>
                <p>
                $row[review]
               </p>
                <div class="rating">
                 $stars
                </div>
              </div>
           
              slide;
            }
          }
         ?>

      </div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="col-lgl-12 text-center mt-5">
      <a href="about.php" class="btn btn-sm btn-outline-dark text-wight ">Know more >> </a>
    </div>
  </div>

  <!-- Reach us-->
 

  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Reach us</h2>
  <div class="container">
    <div class="row">
          <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
            <iframe class="w-100 rounded" src="<?php echo $contact_r['iframe']?>"  height="320px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
     <div class="col-lg-4 col-md-4">
          <div class="bg-white  rounded mb-4 ">
            <h5> Call us</h5>
            <a href="tel: <?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1']?></a><br>
            <a href="tel: <?php echo $contact_r['pn2']?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn2']?></a><br><br><br><br>
          <div class="bg-white  rounded mb-0 ">
            <h5> Follow us</h5>
            <?php
            if($contact_r['twitter']!=''){
              echo<<<data
              <a href="$contact_r[twitter]" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-twitter"></i>  Twitter
              </span>
              </a><br>
            data;
            }
            ?>
              <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 ">
                <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-facebook"></i>  Facebook
                </span>
              </a><br>
              <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-">
                <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-instagram"></i>  Instagram
                </span>
              </a>
          </div>
        </div> 
    </div>
  </div>
  </div>

  <?php require('inc/footer.php'); ?>


 
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