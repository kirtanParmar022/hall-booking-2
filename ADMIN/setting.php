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
    <title>Admin Panel - setting</title>
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

  /* width */
::-webkit-scrollbar {
  width: 20px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
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
           <h4 class="mb-4">SETTING<h4> 
            <!-- general setting section -->
            <div class="card border-0 shadow-sm mb-4 overflow-hidden"  >
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">General Setting</h5>
                        <button type="button" class="btn btn-dark shodowe-none btn-sn" data-bs-toggle="modal" data-bs-target="#general-s">
                            <i class="bi bi-pencil-square"></i> edit
                          </button>
                    </div>
                    
                      <h6 class="card-subtitle mb-1 fw-bold">site title</h6>
                      <p class=" card-text " id="site_title"></p>
                      <h6 class="card-subtitle mb-1 fw-bold" >About us</h6>
                      <p class=" card-text " id="site_about"></p>
                    
                </div>
                    
            </div>
            <!-- general setting model  -->
            <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              
          <div class="modal-dialog">
              <form id="general_s_form">
                <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" >General Setting</h5>

                      </div>
                      <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fw-bold">site title</label>
                        <input type="text" name="site_title"  id="site_title_inp" class="form-control shadow-none" required>
                      </div>
                      
                        <div class=" mb-3 p-0">
                            <label  class="form-label fw-bold">About us</label>
                            <textarea name="site_about"  id="site_about_inp" class="form-control shadow-none" rows="3" required ></textarea>
                            </div>
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" onclick="site_title.value = general_data.site_title, site_about.value  = general_data.site_about" class="btn btn-light text-secondary" data-bs-dismiss="modal">cancel</button>
                        <button type="submit" onclick="" class="btn custom-bg text-wight  ">submit</button>
                      </div>
                </div>
              </form>
          </div>
                
            </div>
            <!-- shutdown section-->
            <div class="card border-0 shadow-sm mb-4" >
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">shutdown website</h5>
                            <div class="form-check form-switch">
                              <form  >
                              <input  onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown_toggal" >
                              </form>
                            </div>
                        </div>
                          <p class=" card-text " >
                            NO CUSTOMER WILL BE ALLOWED TO BOOK HALL, WHEN SHUTDOWN MODE IS TURNED ON.
                          </p>                   
                    </div>
                        
            </div>
            <!-- contacts section--> 
            <div class="card border-0 shadow-sm mb-4"  >
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                      <h5 class="card-title m-0">Contacts Setting</h5>
                      <button type="button" class="btn btn-dark shodowe-none btn-sn" data-bs-toggle="modal" data-bs-target="#contacts-s">
                          <i class="bi bi-pencil-square"></i> edit
                        </button>
                  </div>
                  <div class="row">
                        <div class="col-lg-6">
                          <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                            <p class=" card-text " id="address"></p>
                          </div>
                          <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                            <p class=" card-text " id="gmap"></p>
                          </div>
                          <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">Phone Number</h6>
                            <p class=" card-text mb-1" >
                              <i class="bi bi-telephone-fill"></i>
                              <span id="pn1">
                              </span>
                            </p>
                            <p class=" card-text " >
                              <i class="bi bi-telephone-fill"></i>
                              <span id="pn2">
                              </span>
                            </p>
                          </div>
                          <div class="mb-4">
                              <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                              <p class=" card-text " id="email"></p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="mb-4">
                            <h6 class="card-subtitle mb-1 fw-bold">social links</h6>
                            <p class=" card-text " >
                              <i class="bi bi-facebook me-1"></i>
                              <span id="fb">
                              </span>
                            </p>
                            <p class=" card-text " >
                                <i class="bi bi-instagram me-1"></i>
                                <span id="insta">
                                </span>
                            </p>
                            <p class=" card-text  " >
                              <i class="bi bi-twitter me-1"></i>
                              <span id="twitter">
                              </span>
                            </p>
                          </div>
                          <div class="mb-4">
                              <h6 class="card-subtitle mb-1 fw-bold">iframe</h6>
                              <iframe  loading="lazy" class="border p-2 w-100" id="iframe" ></iframe>
                          </div>
                        </div>
                  </div>
              </div>
            </div>
            <!-- contacts details model  -->
            <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <form id="contacts_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" >Contacts Setting</h5>
                    </div>
                    <div class="modal-body">
                    <div class="container-fluid p-0">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label  class="form-label fw-bold">Address</label>
                            <input type="text" name="address"  id="address_inp" class="form-control shadow-none" required>
                          </div>
                          <div class="mb-3">
                            <label  class="form-label fw-bold">Google Map Link</label>
                            <input type="text" name="gmap"  id="gmap_inp" class="form-control shadow-none" required>
                          </div>
                          <div class="mb-3">
                            <label  class="form-label fw-bold">Phone Numbers</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                              <input type="number" name="pn1"  id="pn1_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                              <input type="number" name="pn2"  id="pn2_inp" class="form-control shadow-none" required>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label  class="form-label fw-bold">Email</label>
                            <input type="email" name="email"  id="email_inp" class="form-control shadow-none" required>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label  class="form-label fw-bold">social links</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                              <input type="text" name="fb"  id="fb_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                              <input type="text" name="insta"  id="insta_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                              <input type="text" name="twitter"  id="twitter_inp" class="form-control shadow-none" required>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label  class="form-label fw-bold">iframe src </label>
                            <input type="text" name="iframe"  id="iframe_inp" class="form-control shadow-none" required>
                          </div>
                        </div>
                      </div>
                    </div>    
                    </div>
                    <div class="modal-footer">
                      <button type="button" onclick="contacts_inp(contacts_data)" class="btn btn-light text-secondary" data-bs-dismiss="modal">cancel</button>
                      <button type="submit" onclick="" class="btn custom-bg text-wight  ">submit</button>
                    </div>
                </div>
                </form>
              </div>
            </div>
            <!-- Management team setting section -->
            <div class="card border-0 shadow-sm mb-4 overflow-hidden"  >
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                      <h5 class="card-title m-0">Management Team Setting</h5>
                      <button type="button" class="btn btn-dark shodowe-none btn-sn" data-bs-toggle="modal" data-bs-target="#team-s">
                          <i class="bi bi-plus-square"></i> Add
                       </button>
                  </div>
                  <div class="row" id="team-data">
                  </div>
              </div>
            </div>
            <!-- Management Team model  -->
            <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="team_s_form">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" >Add team  Member</h5>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-bold">Name</label>
                            <input type="text" name="member_name"  id="member_name_inp" class="form-control shadow-none" required>
                          </div>
                          <div class=" mb-3 p-0">
                            <label  class="form-label fw-bold">Picture</label>
                            <input type="file" name="member_picture"  id="member_picture_inp" accept=".jpg,.png,.jpeg" class="form-control shadow-none" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn btn-light text-secondary" data-bs-dismiss="modal">cancel</button>
                          <button type="submit" onclick="" class="btn custom-bg text-wight  ">submit</button>
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
<script src="script/setting.js"></script>
</body>
</html>