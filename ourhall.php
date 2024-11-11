<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<?php require('inc/links.php'); ?>
<title><?php echo $settings_r['site_title']?>-OUR HALLS</title>
  
</head>
<body class="bg-light" >

<?php 

  require('inc/header.php');

  $checkin_default="";
  $checkout_default="";
  $guest_default="";

  if(isset($_GET['check_availability']))
  {
    $frm_data=filteration($_GET);

    $checkin_default=$frm_data['checkin'];
    $checkout_default=$frm_data['checkout'];
    $guest_default=$frm_data['guests'];

  }


?>
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR HALLS</h2>
  <div class="h-line bg-dark"></div>
</div>

<div class="container-fluid">
  <div class="row">

    <div class=" col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
       <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
        <div class="container-fluid flex-lg-column align-items-stretch p-1 ">
          <h4 class="mt-2 fw-bold" >Filters</h4>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filter">
              <div class="border bg-light p-4 rounded mb-3">
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:18px ;">
                  <span >Check Availability</span>
                  <button id="chk_avail_btn" onclick="chk_avail_clear()"class="btn btn-sm text-secondary d-none">Reset </button>
                </h5>
                <label  class="form-label " >Check-in</label>
                <input type="date" class="form-control shadow-none" value="<?php echo $checkin_default ?>" id="checkin" onchange="chk_avail_filter()">
                <label  class="form-label " >Check-out</label>
                <input type="date" class="form-control shadow-none mb-3" value="<?php echo $checkout_default ?>" id="checkout" onchange="chk_avail_filter()" >
              </div>
              <div class="border bg-light p-4 rounded mb-3">
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:18px ;">
                  <span > Facility</span>
                  <button id="facility_btn" onclick="facility_clear()"class="btn btn-sm text-secondary d-none">Reset </button>
                </h5>
                <?php
                  $facility_q=selectAll('facilitys');
                  while($row=mysqli_fetch_assoc($facility_q))
                  {
                    echo<<<facility
                      <div class="mb-2">
                        <input type="checkbox" onchange="fetch_halls()" name="facilitys" value="$row[id]" class="form-check-input shadow-none me-1" >
                        <label  class="form-label " for="$row[id]" >$row[name]</label>
                      </div> 
                    facility;
                  }

                ?>
              </div>
              <div class="border bg-light p-4 rounded mb-3">
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:18px ;">
                  <span > Guests</span>
                  <button id="guests_btn" onclick="guests_clear()"class="btn btn-sm text-secondary d-none">Reset </button>
                </h5>
                <input type="number" value="<?php echo $guest_default ?>" id="guests" oninput="guests_filter()" class="form-control shadow-none mb-3" >
              </div>
            </div>
        </div>
      </nav>   
    </div>

    <div class="col-lg-9 col-md-12 px-4" id="hall-data">
      
   </div>
  </div>
</div>  


  <script>

    let hall_data=document.getElementById('hall-data');
    let checkin=document.getElementById('checkin');
    let checkout=document.getElementById('checkout');
    let chk_avail_btn=document.getElementById('chk_avail_btn');


    let guests=document.getElementById('guests');
    let guests_btn=document.getElementById('guests_btn');

    let facility_btn=document.getElementById('facility_btn');


    function fetch_halls()
    {
        let chk_avail=JSON.stringify({
          checkin:checkin.value,
          checkout:checkout.value
        });

        let guest=JSON.stringify({
          guest:guests.value
        });

        let facilitys_list={"facilitys":[]};

        let get_facility=document.querySelectorAll('[name="facilitys"]:checked');
        if(get_facility.length>0)
        {
        get_facility.forEach((facility) => {
          facilitys_list.facilitys.push(facility.value);
          
        });
            facility_btn.classList.remove('d-none');
        }
       else{
        facility_btn.classList.add('d-none');
       }
        facility_list=JSON.stringify(facilitys_list);


        let xhr = new XMLHttpRequest();
        xhr.open("GET","ajax/hall.php?fetch_halls&chk_avail="+chk_avail+"&guest="+guest+"&facility_list="+facility_list,true);

        xhr.onprogress =function(){
          hall_data.innerHTML=`<div class="spinner-border mb-3 text-info d-block mx-auto" id="loader" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
        }

        xhr.onload = function(){
          hall_data.innerHTML=this.responseText;
        }
        xhr.send();
    }

   function chk_avail_filter()
    {
      if(checkin.value!='' && checkout.value!=''){
        fetch_halls();
        chk_avail_btn.classList.remove('d-none');
      }
    }


   function chk_avail_clear()
    {
      checkin.value=''; 
      checkout.value='';
      chk_avail_btn.classList.add('d-none');
      fetch_halls();
     
      }
        
    function guests_filter()
    {
    if(guests.value>0){
      fetch_halls();
      guests_btn.classList.remove('d-none')
     }
    }


    function guests_clear()
    {
      guests.value='';
      guests_btn.classList.add('d-none')
      fetch_halls();
    }

    function facility_clear()
    {
      let get_facility=document.querySelectorAll('[name="facilitys"]:checked');

      get_facility.forEach((facility) => {
         facility.checked=false;
          
        });
            facility_btn.classList.add('d-none');
            fetch_halls();
    }

    window.onload=function(){
      fetch_halls();
    }
      
  </script>
  <?php require('inc/footer.php'); ?>


      
</body>
</html>