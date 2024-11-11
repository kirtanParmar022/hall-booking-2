<?php



        require('../ADMIN/inc/db_confing.php');
        require('../ADMIN/inc/essentials.php');
        date_default_timezone_set("Asia/kolkata");
     
        session_start();

      if(isset($_GET['fetch_halls']))
      { 
        // check availability data decode
        $chk_avail = json_decode($_GET['chk_avail'],true);

        // checkin and checkout filter validations
        if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
        {
            $today_date= new DateTime(date("Y-m-d"));
            $checkin_date = new DateTime($chk_avail['checkin']);
            $checkout_date= new DateTime($chk_avail['checkout']);
        
            if($checkin_date == $checkout_date){
                echo"<h3 class='text-center text-danger'>Inavalid Dates!</h3>";
                exit;
             }
            else if($checkout_date < $checkin_date){
                echo"<h3 class='text-center text-danger'>Inavalid Dates!</h3>";
                exit;
            }
            else if($checkin_date < $today_date){
                echo"<h3 class='text-center text-danger'>Inavalid Dates!</h3>";
                exit;
            }
        }
        
        // guests data decode
        $guests = json_decode($_GET['guest'],true);
        $guest=($guests['guest']!='')? $guests['guest']:0;


        // facility data decode
        $facility_list=json_decode($_GET['facility_list'],true);
         
        // count no. of halls and output variable to store hall cards
        $count_halls=0;
        $output="";

        // fetching settings table check website is shutdown or not
        $settings_q ="SELECT * FROM `settings` WHERE `sr_no`=1";
        $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q));

        // query for hall cards with guest filter
        $hall_res = select("SELECT * FROM `halls` WHERE `people`>=? AND `status`=? AND `removed`=?",[$guest,1,0],'iii');

        while($hall_data = mysqli_fetch_assoc($hall_res))
        {
            // check availability filter
            if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
            {
                $tb_query="SELECT COUNT(*) AS `total_bookings` FROM `book_now`
                WHERE booking_status=? AND hall_id=?
                AND check_out > ? AND check_in < ?";

                $values=['success',$hall_data['id'],$chk_avail['checkin'],$chk_avail['checkout']];

                $tb_fetch=mysqli_fetch_assoc(select($tb_query,$values,'siss'));

             

                if(($hall_data['quantity']-$tb_fetch['total_bookings'])==0){
                   continue;
                }
            }

             // get facility of halls with filter
                $fac_count=0;
                             
                $fac_q =mysqli_query($con,"SELECT f.name , f.id FROM `facilitys` f 
                INNER JOIN `hall_facilitys` hfac ON f.id=hfac.facilitys_id 
                WHERE hfac.hall_id ='$hall_data[id]'");

                $facilitys_data ="";
                while($fac_row= mysqli_fetch_assoc($fac_q)){

                    if(in_array($fac_row['id'],$facility_list['facilitys'])){
                        $fac_count++;
                    }

                    $facilitys_data .="<span class='badge rounded-pill bg-light text-dark  text-wrap me-1'>
                    $fac_row[name]
                    </span>";
                }

                if(count($facility_list['facilitys'])!=$fac_count){
                    continue;
                }

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
            $book_btn="<button onclick='checklogintobook($login,$hall_data[id])' class='btn btn-sm w-100 text-wight custom-bg shadow-none mb-2'>Book Now</button>";
            
        }
        // print hall cards 

          $output.="
            <div class='card mb-4 border-0 shadow'>
                <div class='row g-0 p-3 align-items-center'>
                    <div class='col-md-5 mb-lg-0 mb-md-0 '>
                    <img src='$hall_thumb' class='img-fluid rounded'>
                    </div>
                    <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                    <h5 class='mb-3 mt-0 fw-8'>$hall_data[name]</h5>
                    <div class='features mb-3'>
                        <h6 class='mb-3 fw-8'>Features</h6>
                        $features_data
                    </div>
                    <div class='facilitys mb-3'>
                        <h6 class='mb-1'>Facilties</h6>
                        $facilitys_data
                    </div>
                    <div class='facilitys mb-3'>
                        <h6 class='mb-1'>Guests</h6>
                        $hall_data[people]
                    </div>
                    </div> 
                    <div class='col-md-2 text-align-center'>
                    <h6 class='mb-4 fw-bold'>$hall_data[price]₹ per Day</h6>
                    $book_btn
                    <a href='hall_details.php?id=$hall_data[id]' class='btn btn-sm w-100 btn-outline-dark text-wight'>More Details</a>
                    </div>
                </div>
            </div>
        ";

        $count_halls++;
        }
        if($count_halls>0){
            echo $output;
        }
        else{
            echo"<h3 class='text-center text-danger'>No Halls Found!</h3>";
        }
      }
    
     ?>