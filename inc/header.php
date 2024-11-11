

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticy-top ">
  <div class="container-fluid">
    <a class="navbar-brand; me-5 fw-bold fs-3 shadow active " href="index.php"><?php echo $settings_r['site_title']?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link  me-2 fw-bold  btn btn-light shadow" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  me-2 fw-bold  btn btn-light shadow" aria-current="page" href="ourhall.php">Halls</a>
        </li>
        <li class="nav-item">
          <a  button type="button" class="nav-link  me-2 fw-bold  btn btn-light shadow"  href="facility.php" >Facility</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  me-2 fw-bold  btn btn-light shadow" href="contact.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a button type="button" class="nav-link  me-2 fw-bold  btn btn-light shadow" href="about.php">About</a>
        </li>
      </ul>
      <div class="d-flex">
        <?php
        if(isset($_SESSION['login'])&&$_SESSION['login']==true)
        {
          $path =USERS_IMG_PATH;
          echo<<<data
            <div class="btn-group">
            <button type="button" class="btn btn-outline-dark shadow-non dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <img src="$path$_SESSION[uPic]" style="width:25px; height:25px;"  class="me-1 rounded-circle"> 
            $_SESSION[uName]
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </div>
          data;
        }
         else{
          echo<<<data
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#login">
            Login
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none  " data-bs-toggle="modal" data-bs-target="#regitration">
            Register
            </button>
          data;
         }
    
        ?>
         
      </div>
    </div>
  </div>
</nav> 

<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="login-form">
     <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">
          <i class="bi bi-person-circle fs-3 me-2"></i>	User Login
		    </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div class="modal-body">
         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email / Mobile</label>
          <input type="text" name="email_mob" class="form-control shadow-none" >
         </div>
         <div class="mb-4">
             <label for="exampleInputEmail1" class="form-label">Password</label>
             <input type="password" name="pass" class="form-control shadow-none" >
         </div>
      </div>
          <div class="d-flex align-items-center justify-content-between mb-2 ps-3">
	           <button type="submit" class="btn btn-dark shadow-none">Login</button>
             <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0 me-4" data-bs-toggle="modal" data-bs-target="#forgot">
             Forgot Password
            </button>
          </div>
     </div>
    </form>
  </div>
</div>


<div class="modal fade" id="regitration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  
  <div class="modal-dialog ">
    <div class="modal-content">
		  <form id="register-form" >
          <div class="modal-header">
            <h5 class="modal-title">
            <i class="bi bi-person-vcard-fill fs-3 me-2"></i>	User Regitration
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
	       <div class="mb-3">
           <div class="container-fluid">
            <div class="row">
              <div class="col-md-6  mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input name="name" type="text" class="form-control shadow-none" required >
               </div>
               <div class="col-md-6   mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control shadow-none" required>
               </div>
               <div class="col-md-6  mb-3">
                <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                <input name="phonenum" type="number" class="form-control shadow-none" required>
               </div>
               <div class="col-md-6  mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Photo</label>
                <input name="profile" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-control shadow-none" required>
               </div>
               <div class="col-md-12 mb-3 ">
                <label  class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
               </div>
               <div class="col-md-6  mb-3">
                <label for="exampleInputEmail1" class="form-label">pincode</label>
                <input type="" name="pincode" class="form-control shadow-none" required >
               </div>
               <div class="col-md-6  mb-3">
                <label for="exampleInputEmail1" class="form-label">date of birth</label>
                <input type="date" name="dob" class="form-control shadow-none" required>
               </div>
               <div class="col-md-6   mb-3">
                <label for="exampleInputEmail1" class="form-label">password</label>
               <input type="password" name="pass" class="form-control shadow-none"required>
               </div>
               <div class="col-md-6  mb-3">
                <label for="exampleInputEmail1" class="form-label">comfirm password</label>
                <input type="password" name="cpass" class="form-control shadow-none" required >
               </div>
            </div> 
            </div> 
          </div>    
      </div>
          <div class="text-center mb-2">
	           <button type="submit" class="btn btn-dark shadow-none">Register</button>
          </div>
      </form>
    </div>
  </div>
</div> 





<div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="forgot-form">
     <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">
          <i class="bi bi-person-circle fs-3 me-2"></i>	Forgot Password
		    </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                  <input type="number" name="email_mob" class="form-control shadow-none" required>
                </div>
               <div class="col-md-6 ps-0 mb-3">
                <label for="exampleInputEmail1" class="form-label">date of birth</label>
                <input type="date" name="dob" class="form-control shadow-none" required>
               </div>
               <div class="col-md-6 ps-0 ps-0 mb-3">
                <label for="exampleInputEmail1" class="form-label">New password</label>
               <input type="password" name="new_pass" class="form-control shadow-none"required>
               </div>
               <div class="col-md-6 ps-0 mb-3">
                <label for="exampleInputEmail1" class="form-label">Confirm password</label>
                <input type="password" name="cpass" class="form-control shadow-none" required >
               </div>
            </div>
          </div>  
          <!-- Please Contact Admin →<a href="contact.php" class="text-blue text-decoration-none" > Admin</a> -->
      </div>
      <div class="text-center mb-2">
	           <button type="submit" class="btn btn-dark shadow-none custom-bg">Submit</button>
          </div>
     </div>
    </form>
  </div>
</div>

