<?php
require('inc/essentials.php');
require('inc/db_confing.php');

adminlogin();
session_regenerate_id(true);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Halls</title>
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
           <h4 class="mb-4">Halls<h4> 
            <div class="card border-0 shadow-sm mb-4 overflow-hidden"  >
              <div class="card-body">
                <div class="text-end mb-4">
                      <button type="button" class="btn btn-dark shodowe-none btn-sn" data-bs-toggle="modal" data-bs-target="#add-hall">
                          <i class="bi bi-plus-square"></i> Add
                       </button>
                </div>
                <div class="table-responsive-lg" style="height: 450px; overflow-y:scroll;">
                 <table class="table table-hover border text-center">
                  <thead >
                    <tr class="bg-dark font-size: 10pt  text-light">
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Area</th>
                      <th scope="col">Guests</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="hall-data">
                  </tbody>
                </table>
                </div>
              </div>
            </div>     
        </div>
    </div>
  </div>
  
        <!-- Add Hall model -->

            <div class="modal fade" id="add-hall" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <form id="add_hall_form" autocomplete="off">
                  <div class="modal-content ">
                        <div class="modal-header">
                          <h5 class="modal-title" >Add Hall</h5>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="exampleInputEmail1" class="form-label fw-bold">Name</label>
                              <input type="text" id="name"   class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="exampleInputEmail1" class="form-label fw-bold">Area</label>
                              <input type="number" id="area"   class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="exampleInputEmail1" class="form-label fw-bold">Price</label>
                              <input type="number" id="price"   class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="exampleInputEmail1" class="form-label fw-bold">People</label>
                              <input type="number" id="people"   class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-bold">Features</label>
                            <div class="row">
                              <?php
                              $res= selectAll('features');
                              while($opt = mysqli_fetch_assoc($res)){
                                echo"
                                <div class ='col-md-3 mb-1'>
                                <label>
                                  <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                  $opt[name]
                                </label>
                                </div>
                                ";
                              }
                              ?>
                            </div>
                            </div>
                            <div class="col-12 mb-3">
                              <label for="exampleInputEmail1" class="form-label fw-bold">Facility</label>
                              <div class="row">
                                <?php
                                $res= selectAll('facilitys');
                                while($opt = mysqli_fetch_assoc($res)){
                                  echo"
                                  <div class ='col-md-3 mb-1'>
                                    <label>
                                      <input type='checkbox' name='facility' value='$opt[id]' class='form-check-input shadow-none'>
                                      $opt[name]
                                    </label>
                                  </div>
                                  ";
                                }
                                ?>
                              </div>
                            </div>
                            <div class="col-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-bold">Description</label>
                            <textarea name="desc" row="4" class="form-control shadow-none" required></textarea>
                          </div>
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="reset"  class="btn btn-light text-secondary" data-bs-dismiss="modal">cancel</button>
                          <button type="submit" onclick="" class="btn custom-bg text-wight  ">submit</button>
                        </div>
                  </div>
                </form>
              </div>
            </div>

        <!-- Edit Hall model -->

        <div class="modal fade" id="edit-hall" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <form id="edit_hall_form" autocomplete="off">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" >Edit Hall</h5>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">Name</label>
            <input type="text" id="name"   class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">Area</label>
            <input type="number" id="area"   class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">Price</label>
            <input type="number" id="price"   class="form-control shadow-none" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">People</label>
            <input type="number" id="people"   class="form-control shadow-none" required>
          </div>
          <div class="col-12 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">Features</label>
            <div class="row">
              <?php
              $res= selectAll('features');
              while($opt = mysqli_fetch_assoc($res))
              {
                echo"<div class ='col-md-3 mb-1'>
                        <label><input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>$opt[name]
                        </label>
                    </div>";
              }
              ?>
            </div>
          </div>
          <div class="col-12 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">Facility</label>
            <div class="row">
            <?php
            $res= selectAll('facilitys');
            while($opt = mysqli_fetch_assoc($res)){
              echo"
              <div class ='col-md-3 mb-1'>
                <label>
                  <input type='checkbox' name='facility' value='$opt[id]' class='form-check-input shadow-none'>
                  $opt[name]
                </label>
              </div>
              ";
            }
            ?>
            </div>
          </div>
          <div class="col-12 mb-3">
            <label for="exampleInputEmail1" class="form-label fw-bold">Description</label>
            <textarea name="desc" row="4" class="form-control shadow-none" required></textarea>
              </div>
          <div>
          <input type="hidden" id="hall_id" >
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="reset"  class="btn btn-light text-secondary" data-bs-dismiss="modal">cancel</button>
        <button type="submit" onclick="" class="btn custom-bg text-wight  ">submit</button>
        </div>
        </div>
        </form>
        </div>
        </div>


        <!-- manage hall image modal  -->

        <div class="modal fade" id="hall_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" >Hall Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div id="image-alert"></div>
        <div class="border-bottom border-3 pb-3 mb-3">
        <form id="add_image_form">
        <label  class="form-label fw-bold">Add Image</label>
        <input type="file" name="image"   accept=".jpg,.png,.jpeg" class="form-control shadow-none mb-3" required>
        <button type="submit" onclick="" class="btn custom-bg text-wight  ">Add</button>
        <input type="hidden" name="hall_id">
        </form>
        </div>
        </div>
        <div class="table-responsive-lg" style="height: 450px; overflow-y:scroll;">
        <table class="table table-hover border text-center">
        <thead >
        <tr class="bg-dark sticky-top text-light">
        <th scope="col" width="60%">Image</th>
        <th scope="col">Thumb</th>
        <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody id="hall-image-data">
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>


           
<?php
require('inc/script.php');
?>  
<script src="script/halls.js"></script>

</body>
</html>