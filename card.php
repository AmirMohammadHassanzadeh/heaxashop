<?php
include("init/init.php") ; 

// get products 
$user =  $_SESSION['user'] ; 

$sql = "SELECT * FROM `solds` WHERE customer_id ='$user->ID'" ; 
$query = $connection->query($sql) ; 
$products = $query->fetchAll(PDO::FETCH_OBJ) ; 

//var_dump($products) ; 

$count = count($products) ; 
 
 
 $mahsoolat = [] ; 



for( $i = 0 ; $i <= $count-1 ; $i++ )
{
   $product_catgory = $products[$i]->product_catgory  ; 

   $product_id = $products[$i]->product_id ; 

   $sql = "SELECT * FROM `$product_catgory` WHERE ID = '$product_id'  " ; 

   $query = $connection->query($sql) ; 

   $C_product = $query->fetchAll(PDO::FETCH_OBJ) ; 

   array_push( $mahsoolat , $C_product ) ; 

  

}




 //  for product price  /// 
 function price()
{
  global $mahsoolat ; 
  global $products ; 
  $ALL_price = 0 ;
  for( $g = 0 ; $g <= count( $mahsoolat )-1 ; $g++ )
  {
     $ALL_price += $mahsoolat[$g][0]->price * $products[$g]->count ;
     
  }
  //var_dump($ALL_price)  ;
  return number_format($ALL_price) ; 
}



if(isset($_GET['status']) and $_GET['status'] == 'delete' and isset($_GET['id']) )
{
   $sql = "DELETE  FROM `solds` WHERE ID='{$_GET['id']}' " ; 

   $connection->exec($sql) ; 
  
   header("location:http://localhost/heaxashop/card.php"); 

   //header("Refresh: 0 ") ; 

}

if( isset($_POST['send_data']) )
{
  $_SESSION['mahsoolat'] = $products ; 
  $_SESSION['date'] =  date('m/d h:i') ; 
}



?>




<header> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style> @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
 </style> </header>
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="index.php" class="text-body">
                  <i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have <?php echo $count ; ?> items in your cart</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>

                <?php     
                
                for( $i = 0 ; $i <= count( $mahsoolat )-1 ; $i++ )
                {
                  $f_price = number_format($mahsoolat[$i][0]->price * $products[$i]->count) ; 
                  echo
                  "
                  <div class='card mb-3'>
                  <div class='card-body'>
                    <div class='d-flex justify-content-between'>
                      <div class='d-flex flex-row align-items-center'>
                        <div>
                          <img
                            src='{$mahsoolat[$i][0]->image}'
                            class='img-fluid rounded-3' alt='Shopping item' style='width: 65px;'>
                        </div>
                        <div class='ms-3'>
                          <h5> {$mahsoolat[$i][0]->name} </h5>
                          <p class='small mb-0'>{$mahsoolat[$i][0]->content}</p>
                        </div>
                      </div>
                      <div class='d-flex flex-row align-items-center'>
                        <div style='width: 50px;'>
                          <h5 class='fw-normal mb-0'> {$products[$i]->count  } </h5> 
                        </div>
                        <div style='width: 80px;'>
                          <h5 class='mb-0'>{$f_price}</h5>
                          
                        </div>
                        <div class='btn' > <a href='?status=delete&id={$products[$i]->ID}'> 🗑️ </a> </div >
                        <a href='#!' style='color: #cecece;'><i class='fas fa-trash-alt'></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                  ";
                }

                 ?>
                  



              </div>
              <div class="col-lg-5">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>

                    </div>

                    <p class="small mb-2">Card type</p>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                    <form class="mt-4">
                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                          placeholder="Cardholder's Name" />
                        <label class="form-label" for="typeName">Cardholder's Name</label>
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                          placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                        <label class="form-label" for="typeText">Card Number</label>
                      </div>

                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                              placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg"
                              placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                          </div>
                        </div>
                      </div>

                    </form>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2"> $.0 </p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2"> <?php  echo "$" .  price() ; ?>  </p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2"> <?php  echo "$" .  price() ; ?>  </p>
                    </div>
                    <form action="" method="post" >

                    <button name="send_data"  class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span> <?php  echo "$" .  price() ; ?> </span>
                        <span>  <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>

                    </form>
                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  <?php   if( isset($_POST['send_data']) ){echo"  alert(' its done ')  " ; } ?>
</script>