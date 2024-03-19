<?php 
session_start() ; 

    // تابع رمزنگاری دوطرفه AES
    function encrypt($data, $key)
    {

      $cipher = "AES-256-CBC";

      $iv_length = openssl_cipher_iv_length($cipher);

      $iv = openssl_random_pseudo_bytes($iv_length);

      $encrypted = openssl_encrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);

      $encrypted = base64_encode($iv . $encrypted);

      return $encrypted;

    }

    function decrypt($data, $key) {

        $cipher = "AES-256-CBC";

        $data = base64_decode($data);

        $iv_length = openssl_cipher_iv_length($cipher);

        $iv = substr($data, 0, $iv_length);

        $data = substr($data, $iv_length);

        $decrypted = openssl_decrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        
        return $decrypted;
    }


function get_user_inf ()
{
    $user_id = "" ; 
    if( isset( $_SESSION['user-id'] ) )
    { 
      
        return $user_id = $_SESSION['user-id'] ; 
    
    } 

    elseif(  isset( $_COOKIE['user_id'] )  )
    {
        $key = ']vnA5fNxnZ($E5 9ea+:*}O#s.}Z1}Q_B=?2#Jmw`/y92>cEBs0o.#D)A;ef(<v3';
        $receivedCookie = $_COOKIE['user_id'];
        return $decryptedCookie = decrypt($receivedCookie, $key);

    
    }else
    {
        return false ; 
    }

}


//تابع چک کردن یوزر بودن کاربر 
function user_login_inf () 
{

    if( get_user_inf () )
    { 
        return true ; 

    } else
    {
        return false ;  
    }
}

function is_user_login () 
{
    if( user_login_inf() == false  )
    {
        header('location:http://localhost/heaxashop/login.php') ; 
    }
}

function time_zone()
{
    date_default_timezone_set("Asia/Tehran");
    return $time = date("Y:m:d H:i:s");

}

function is_it_admin ()
{
    if( isset($_SESSION['admin-inf']) )
    {
        return true ;

    }else
    {

        return false ; 


    }

}

function admin_login()
{
    if( is_it_admin() == false )
    {
        header("location:http://localhost/heaxashop/admins_login.php") ; 
    }
}


 





?>