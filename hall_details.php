<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title']?>-Hall DETAILS</title>

</head>
<body class="bg-light" >

<?php require('inc/header.php'); ?>

<?php
  if(!isset($_GET['id'])){
    redirect("ourhall.php");
  }

  $data = filteration($_GET);

  $hall_res = select("SELECT * FROM `halls` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');
 
  if(mysqli_num_rows($hall_res)==0){
    redirect("ourhall.php");
  }
   
  $hall_data = mysqli_fetch_assoc($hall_res);
?>


<div class="container">
  <div class="row">

    <div class="col-12 my-5 mb-4 px-4">
      <h2 class="fw-bold "><?php echo $hall_data['name']?></h2>
    </div>
      
    <div class="col-lg-7 col-md-12 px-4 ">
        <div id="hallcarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
                $hall_img = HALLS_IMG_PATH."thumbnail.jpg";
                $img_q = mysqli_query($con,"SELECT *FROM `hall_image` 
                WHERE `hall_id`='$hall_data[id]'");
      
                if(mysqli_num_rows($img_q)>0)
                {
                  $active_class= 'active';

                  while($img_res = mysqli_fetch_assoc($img_q))
                  {
                    echo"<div class='carousel-item $active_class'>
                            <img src='".HALLS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                        </div>";
                        $active_class='';
                  }
                    
                }
                else{
                  echo "<div class='carousel-item active'>
                        <img src='$hall_img' class='d-block w-100'>
                        </div>";
                }
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hallcarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hallcarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="col-lg-5 col-md-12 px-4">
      <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body">
          <?php
            
            echo<<<price
            <h4>$hall_data[price]₹ per Day</h4>
            price;

            $rating_q="SELECT AVG(ratting) AS `avg_ratting` FROM `ratting_review`
            WHERE `hall_id`='$hall_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

           $rating_res=mysqli_query($con,$rating_q);
           $rating_fetch= mysqli_fetch_assoc($rating_res);

           $rating_data="";
            if($rating_fetch['avg_ratting']!=NULL)
            {
             

              for($i=0;$i<=$rating_fetch['avg_ratting'];$i++){
                $rating_data .=" <i class='bi bi-star-fill text-warning'></i>";
              }

            
            }
            echo<<<rating
              <div class='mb-3'>
              $rating_data
              </div>  
            rating;

            $fea_q =mysqli_query($con,"SELECT f.name FROM `features` f 
            INNER JOIN `hall_features` hfea ON f.id=hfea.features_id
            WHERE hfea.hall_id ='$hall_data[id]'");

            $features_data ="";
            while($fea_row = mysqli_fetch_assoc($fea_q)){
            $features_data .="<span class='badge rounded-pill bg-light text-dark  text-wrap me-1'>
            $fea_row[name]
            </span>";
            } 
            
            echo<<<features
              <div class="mb-3">
              <h6 class="mb-1">Features</h6>
              $features_data
              </div>
            features; 
            
            $fac_q =mysqli_query($con,"SELECT f.name FROM `facilitys` f 
            INNER JOIN `hall_facilitys` hfac ON f.id=hfac.facilitys_id 
            WHERE hfac.hall_id ='$hall_data[id]'");

            $facilitys_data ="";
            while($fac_row= mysqli_fetch_assoc($fac_q)){
            $facilitys_data .="<span class='badge rounded-pill bg-light text-dark  text-wrap me-1'>
            $fac_row[name]
            </span>";
            } 

            echo<<<facilitys
              <div class="mb-3">
              <h6 class="mb-1">Facilitys</h6>
              $facilitys_data
              </div>
            facilitys;

            echo<<<guest
              <div class="mb-3">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                $hall_data[people]
                </span>
              </div>   
            guest;
            
            echo<<<area
              <div class="mb-3">
                <h6 class="mb-1">Area</h6>
                <span class='badge rounded-pill bg-light text-dark  text-wrap me-1'>
                $hall_data[area] sq.ft.
                </span>
              </div
            area;
          

            $book_btn="";
            if(!$settings_r['shutdown']){
              $login=0;
              if(isset($_SESSION['login'])&&$_SESSION['login']==true)
              {
                $login=1;
              }
              $book_btn="<button onclick='checklogintobook($login,$hall_data[id])' class='btn  w-100 text-wighte custom-bg shadow-none mb-1'>Book Now</button>";
            }

            echo<<<book
                <button  class="btn  w-100 text-wighte custom-bg shadow-none mb-1"></button>
                $book_btn
            book;
          ?>  
        </div>
      </div>            
    </div>

    <div class="col-lg-12 mt-4 px-4">
      <div class="mb-5">
        <h5 class="fw-bold">Description</h5>
        <p>
          <?php echo $hall_data['description'] ?>
        </p> 
      </div>
      <div class="mb-1">
          <h5 class="fw-bold">Reviews & Ratings</h5>
          <?php
            $review_q="SELECT rr.*,uc.name AS uname, uc.profile, r.name AS hname FROM `ratting_review` rr
            INNER JOIN `user_creds` uc ON rr.user_id=uc.id
            INNER JOIN `halls` r ON rr.hall_id=r.id
            WHERE rr.hall_id ='$hall_data[id]'
            ORDER BY `sr_no` DESC LIMIT 15";

            $review_res=mysqli_query($con,$review_q);
            $img_path=USERS_IMG_PATH;
          
            if(mysqli_num_rows($review_res)==0){
              echo 'No reviews yet!';
            }
            else{
              while($row=mysqli_fetch_assoc($review_res))
              {
                 echo<<<data
                 <div class='mb-4'>
                      <div class=" d-flex align-items-center mb-2">
                      <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="30px">
                        <h5 class="m-0 ms-2">$row[uname]</h5>
                      </div>
                      <p class="bm-1">
                        $row[review]
                      </p>
                      <div >
                       $rating_data
                      </div>
                  </div>
                 data;
              }
          }
          ?>
          
      </div>
    </div>
  
  </div>
</div>
    <?php require('inc/footer.php'); ?>


      
</body>
</html>