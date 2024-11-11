<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php require('inc/links.php'); ?>
<title><?php echo $settings_r['site_title']?>-CONTACT US</title>
  



</head>
<body class="bg-light" >

<?php require('inc/header.php'); ?>
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">Contact us</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
   if you have any query than contact us!<br>
 
  </p>
</div>



<div class="container">
  <div class="row">
         
  <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4 ">
            <iframe class="w-100 rounded mb-4" src="<?php echo $contact_r['iframe']?>"  height="320px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <h5>Address</h5>
              <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="d-inline-block text-decoration-none mb-3">
                <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address']?>
              </a>
            <h5 class="mt-4"> Call us</h5>
                <a href="tel:<?php echo $contact_r['pn1']?>" class="d-inline-block  text-decoration-none ">
                  <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1']?>
                </a><br>
                <a href="tel: <?php echo $contact_r['pn2']?>" class="d-inline-block mb-2 text-decoration-none ">
                  <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn2']?>
                </a><br>
            <h5 class="mt-4 d-inline-block  text-decoration-none text-dark"> Email</h5><br>
            <a href="mailto: <?php echo $contact_r['email']?>" >
              <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email']?>
            </a>
            <h5> Follow us</h5>
            <a href="<?php echo $contact_r['twitter']?>" class="d-inline-block  bg-light fs-3 p-2 ">
                 <i class="bi bi-twitter"></i>  
              </a>
              <a href="<?php echo $contact_r['fb']?>" class="d-inline-block  bg-light fs-3 p-2 ">
                 <i class="bi bi-facebook"></i>  
              </a>
              <a href="<?php echo $contact_r['insta']?>" class="d-inline-block  bg-light fs-3 p-2 ">
                 <i class="bi bi-instagram"></i>  
              </a>
          </div>
          </div>
  
  
          <div class="col-lg-6 col-md-6 px-4">
            <div class="bg-white rounded shadow p-4 ">
                <form method="POST">
                  <h5> Send a Message</h5>
                  <div class="mt-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Name</label>
                    <input name="name" require type="text" class="form-control shadow-none" >
                  </div>
                  <div class="mt-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Email</label>
                    <input name="email" require type="email" class="form-control shadow-none" >
                  </div>
                  <div class="mt-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Subject</label>
                    <input name="subject" require type="text" class="form-control shadow-none" >
                  </div>
                  <div class="mt-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Message</label>
                    <textarea name="message" require class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                  </div>
                  <button name="send"  type="submit" class="btn text-dark custom-bg mt-3">Send</button>
                </form>
            </div>
          </div>
         
          
         
          
                             
    </div>
</div>

<?php

    if(isset($_POST['send']))
    {
      $frm_data =($_POST);


      $q="INSERT INTO `user_queries`( `name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
      $values=[$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

      $res=insert($q, $values, "ssss");
      if($res==1){
        alert('success','Mail sent!');
      }else{
        alert('error','server Down! Try again later.');
      }

    }
?>
  <?php require('inc/footer.php'); ?>


      
</body>
</html>