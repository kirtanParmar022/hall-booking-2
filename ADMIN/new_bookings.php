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
    
    <title>Admin Panel - New Bookings</title>
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
           <h4 class="mb-4">New Bookings<h4> 
            <div class="card border-0 shadow-sm mb-4 overflow-hidden"  >
              <div class="card-body">

                <div class="text-end mb-4">
                     <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="search">
                </div>

                <div class="table-responsive" >
                 <table class="table table-hover border" >
                  <thead >
                    <tr class="bg-dark font-size: 10pt  text-light">
                      <th scope="col">#</th>
                      <th scope="col">User Details</th>
                      <th scope="col">Hall Details</th>
                      <th scope="col">Booking Details</th>
                      <th scope="col">Action</th>

                    </tr>
                  </thead>
                  <tbody id="table-data">
                  </tbody>
                </table>
                </div>
              </div>
            </div>     
        </div>
    </div>
  </div>
  
      
  

           
<?php
require('inc/script.php');
?>  
<script src="script/new_bookings.js"></script>

</body>
</html>