    <div class="container-fluid bg-dark text-light p-3 d-flex align-center justify-content-between sticky-top">
        <h3 class="mb-0 h-font">Hall Booking</h3>
        <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
    </div>
    <div class="col-lg-2 bg-dark border-top border-3 border-secondary " id="dashboard-menu" >
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <div class="container-fluid flex-lg-column align-items-stretch  ">
        <h4 class="mt-2  text-light" >ADMIN PANNEL</h4>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
          <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                    <a class="nav-link text-light" href="dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item">
                    <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between " type="button" data-bs-toggle="collapse" data-bs-target="#bookinglinks">
                       <span>Bookings</span> 
                       <span><i class="bi bi-caret-down-fill"></i></span> 
                    </button>
                  <div class="collapse  px-3 small mb-1" id="bookinglinks">
                     <ul class="nav nav-pills flex-column rounded border border-secondary">
                        <li class="nav-items">
                          <a class="nav-link text-white" href="new_bookings.php">New Bookings</a>    
                        </li>   
                        <li class="nav-items">
                          <a class="nav-link text-white" href="records_bookings.php">Bookings Records</a>    
                        </li>   
                     </ul>      
                  </div>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light " href="users.php">User</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light " href="user_querise.php">User Queries</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light " href="rate_review.php">Rattings & Review</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light " href="halls..php">Hall</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light " href="facility&features.php">Facility & Features</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light" href="carousel.php">Carousel</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-light" href="setting.php">settings</a>
              </li>
          </ul>
       </div>
     </div>
    </nav> 
 </div> 