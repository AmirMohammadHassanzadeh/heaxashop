<?php 

include("init/init.php") ; 

if (isset($_POST['username']) and isset($_POST['password']) ) {

  $username = $_POST['username'];

  $password = $_POST['password'];

  $email    = $_POST['email'] ;

  $birth_date = $_POST['birth_date'];
  
  $ft_name = $_POST['ft_name'];

  $la_name = $_POST['la_name']; 

  $time = time_zone() ;

  if (strlen($username) < 3 || strlen($password) < 8 ) {

    $eror = " cheack Your UserName or Password which one is  too small ";

  }elseif( strlen( strlen($username) > 30 || strlen($password) > 16 ) )
  {

    $eror = " your username or password is too long please smallet than  " ; 

  }

  if( !$eror )
  {
    $sql = " SELECT * FROM `user` WHERE username LIKE '%$username%' OR email LIKE '%$email%' ";

    $query = $connection->query($sql);

    $result = $query->fetchColumn();

    var_dump($result);
    
  }
  if( $result == true )
  {
    
    $eror = " this username or email is in used try agine " ; 

  }






  if ( !$result ) {

    $hash_password = 'Ca X%-g><}}Q278#uxw+mQ!-$s81_pD:(lx=NTz+xtYI5l7tNMi2:[4to&XA* +|';

    $password = md5($hash_password . $password . $hash_password);

    $sql = " INSERT INTO `user` 
    ( username ,  password , email , ft_name , la_name , birthdate , create_at  )
    VALUES
    ( '$username' , '$password' , '$email' , '$ft_name' , '$la_name' , '$birth_date' , '$time'  )
    ";

    $query = $connection->exec($sql);

    if ($query) {

      header("location:http://localhost/heaxashop/login.php");

    } else {

      $eror = " Your Username or Password is Unvalid Please Try agine ";

    }

  }
}



?>

<!DOCTYPE html>
<html lang="en">
<? include("short_code/loginheader.php");  ?>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="post" >
      <h4 class="alert alert-danger" style=" margin-top: 10px ; color: red;">
      <?php echo isset($eror) ? "$eror" : ''; ?>
      </h4>
        <h3>Login Here</h3>


        <label for="username">Username</label>
        <input required type="text" placeholder="User Name" name="username" class="inp" id="username">

        <label for="password">Password</label>
        <input required type="password" placeholder="Password" name="password" class="inp" id="password">
          
        <label for="email"> Email </label>
        <input required type="email" placeholder=" Email" name="email" class="inp" id="email">

        <label for="username">FirestName</label>
        <input required type="text" placeholder="User Name" name="ft_name" class="inp" id="username">

        <label for="username">LastName</label>
        <input required type="text" placeholder="User Name" name="la_name" class="inp" id="username">

        <label for="username">BirthDate</label>
        <input required type="date" placeholder="User Name" name="birth_datr" class="inp" id="username">
        
        <!-- <label for="remember"> Do'not Forger Me </label> -->
        <!-- <input type="checkbox" id="remember" style=" height: 20px; width: 10%;" > -->

        <button type="submit" >Sign In</button>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
</body>

  <!--Stylesheet-->
  <style media="screen">
    *,
*:before,
*:after{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
body{
  background-color: #080710;
  height: 1000px;
}
.background{
  width: 430px;
  height: 500px;
  position: absolute;
  transform: translate(-50%,-50%);
  left: 50%;
  top: 50%;
}
.background .shape{
  height: 200px;
  width: 200px;
  position: absolute;
  border-radius: 50%;
}
.shape:first-child{
  background: linear-gradient(
      #1845ad,
      #23a2f6
  );
  left: -80px;
  top: -80px;
}
.shape:last-child{
  background: linear-gradient(
      to right,
      #ff512f,
      #f09819
  );
  right: -30px;
  bottom: -80px;
}
form{
  margin-top: 100px ;
  height: 800px;
  width: 400px;
  background-color: rgba(255,255,255,0.13);
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 50%;
  border-radius: 10px;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255,255,255,0.1);
  box-shadow: 0 0 40px rgba(8,7,16,0.6);
  padding: 50px 35px;
}
form *{
  font-family: 'Poppins',sans-serif;
  color: #ffffff;
  letter-spacing: 0.5px;
  outline: none;
  border: none;
}
form h3{
  font-size: 32px;
  font-weight: 500;
  line-height: 42px;
  text-align: center;
}

label{
  display: block;
  margin-top: 30px;
  font-size: 16px;
  font-weight: 500;
}
.inp{
  display: block;
  height: 50px;
  width: 100%;
  background-color: rgba(255,255,255,0.07);
  border-radius: 3px;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 14px;
  font-weight: 300;
}
::placeholder{
  color: #e5e5e5;
}
button{
  margin-top: 100px;
  width: 100%;
  background-color: #ffffff;
  color: #080710;
  padding: 15px 0;
  font-size: 18px;
  font-weight: 600;
  border-radius: 5px;
  cursor: pointer;
}
.social{
margin-top: 30px;
display: flex;
}
.social div{
background: red;
width: 150px;
border-radius: 3px;
padding: 5px 10px 10px 5px;
background-color: rgba(255,255,255,0.27);
color: #eaf0fb;
text-align: center;
}
.social div:hover{
background-color: rgba(255,255,255,0.47);
}
.social .fb{
margin-left: 25px;
}
.social i{
margin-right: 4px;
}

  </style>
</html>
