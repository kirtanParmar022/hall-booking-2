<?php
require('inc/essentials.php');
adminlogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Carousel</title>
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
           <h4 class="mb-4">CAROUSEL<h4> 
           
          
            <!-- Carousel section -->
            <div class="card border-0 shadow-sm mb-4 overflow-hidden"  >
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                      <h5 class="card-title m-0">Images</h5>
                      <button type="button" class="btn btn-dark shodowe-none btn-sn" data-bs-toggle="modal" data-bs-target="#carousel-s">
                          <i class="bi bi-plus-square"></i> Add
                       </button>
                  </div>
                  <div class="row" id="carousel-data">
                  </div>
              </div>
            </div>
            <!--Carouselmodel  -->
            <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="carousel_s_form">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" >Add Image</h5>
                        </div>
                        <div class="modal-body">
                         
                          <div class=" mb-3 p-0">
                            <label  class="form-label fw-bold">Picture</label>
                            <input type="file" name="carousel_picture"  id="carousel_picture_inp" accept=".jpg,.png,.jpeg" class="form-control shadow-none" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" onclick="carousel_picture.value=''" class="btn btn-light text-secondary" data-bs-dismiss="modal">cancel</button>
                          <button type="submit"  class="btn custom-bg text-wight  ">submit</button>
                        </div>
                  </div>
                </form>
              </div>
            </div>
        </div>     
    </div>
  

<?php
require('inc/script.php');
?>  
<script src="script/carousel.js"></script>
</body>
</html>