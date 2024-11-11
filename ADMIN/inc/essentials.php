<?php
// frontend purpose data
 
define('SITE_URL','http://127.0.0.1/hallbooking/');
define('ABOUT_IMG_PATH',SITE_URL.'img/about/');
define('CAROUSEL_IMG_PATH',SITE_URL.'img/carousel/');
define('FACILITYS_IMG_PATH',SITE_URL.'img/facilitys/');
define('HALLS_IMG_PATH',SITE_URL.'img/halls/');
define('USERS_IMG_PATH',SITE_URL.'img/users/');

// backend upload process needs this data
define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/hallbooking/img/');
define('ABOUT_FOLDER','about/');
define('CAROUSEL_FOLDER','carousel/');
define('FACILITYS_FOLDER','facilitys/');
define('HALLS_FOLDER','halls/');
define('USERS_FOLDER','users/');

function adminlogin(){
    session_start();
    if(!(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']==true)){
        echo "
        <script>
        window.location.href='index.php';
        </script>";
        exit;
    }
}
function redirect($url){
    echo "
    <script>window.location.href='$url';
    </script>";
    exit;
}
function alert($type, $msg)
{
    $bs_class=($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
             <strong class"me-3">$msg</strong> 
             <button type="button " class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    alert;
}

function uplodImage($image,$folder)
{
    $valid_mime=['image/jpeg','image/png','image/webp'];
    $img_mime =$image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img';//inavalid image mime or foarmate
    }
    else if (($image['size']/(102*1024*1024))>2){
        return 'inv_size';//invalid image size graterthan 3mb
    }
    else{
        $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname ='IMG_'.random_int(11111,99999).".$ext";

        $img_path=UPLOAD_IMAGE_PATH.$folder.$rname;
       if(move_uploaded_file($image['tmp_name'],$img_path)){
        return $rname;
       }
       else{
        return 'upd_failed';
       }
    }
}

function deleteImage($image,$folder)
{
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }
    else{
        return false;
    }
}

function uplodSVGImage($image,$folder)
{
    $valid_mime=['image/svg+xml'];
    $img_mime =$image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img';//inavalid image mime or foarmate
    }
    else if (($image['size']/(102*1024))>1){
        return 'inv_size';//invalid image size graterthan 1mb
    }
    else{
        $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname ='IMG_'.random_int(11111,99999).".$ext";

        $img_path=UPLOAD_IMAGE_PATH.$folder.$rname;
       if(move_uploaded_file($image['tmp_name'],$img_path)){
        return $rname;
       }
       else{
        return 'upd_failed';
       }
    }
}

function uploaduserimage($image)
{
    $valid_mime=['image/jpeg','image/png','image/webp'];
    $img_mime =$image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img';//inavalid image mime or foarmate
    }
    
    else{
        $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname ='IMG_'.random_int(11111,99999).".jpeg";

        $img_path=UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

        if($ext=='png'|| $ext=='PNG'){
            $img = imagecreatefrompng($image['tnp_name']);
        }
        else if($ext=='webp'|| $ext=='WEBP'){
            $img =  imagecreatefromwebp($image['tnp_name']);
        }
        else {
            $img =  imagecreatefromjpeg($image['tnp_name']);
        }
       if(imagejpeg($img,$img_path,75)){
        return $rname;
       }
       else{
        return 'upd_failed';
       }
    }
}
?>