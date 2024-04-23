<?php

include("init/init.php") ; 

$user = $_SESSION['user'] ; 

if(isset( $_GET['post'] ) and isset($_GET['product']) )
{
    $product_name = $_GET['product'] ; 

    $product_ID = $_GET['post'] ; 

    $sql ="SELECT * FROM `$product_name` WHERE ID=$product_ID  " ; 

    $query = $connection->query($sql) ; 

    $result = $query->fetchAll(PDO::FETCH_OBJ) ; 

    $product=$result[0] ; 

}



if(  isset($_GET['status']) and $_GET['status'] == "view"  )
{

    
    $sql  = " SELECT view FROM `$product_name` WHERE ID=$product_ID   " ; 
   
    $query=$connection->query($sql) ; 

    $res = $query->fetch() ;
    
    
    $view = $res[0] + 1 ; 

    $SQL = " UPDATE `$product_name` SET  view = '$view'  WHERE ID='$product_ID' ";
    
    $rst = $connection->exec($SQL);

    header("location:single-product.php?post=$product_ID&product=$product_name") ; 


}



if( isset( $_GET['status'] ) and  $_GET['status'] == 'addtocard' and isset($_GET['post']) )
{
     $product_id = $_GET['post'] ; 
     $product_catgory = $_GET['product'] ; 
     $user_id = $user->ID; 
     $p_count = $_GET['count'] ;

    $sql ="INSERT INTO `solds` (customer_id , product_id , product_catgory , count) VALUES ( '$user_id' , '$product_id' , '$product_catgory' , '$p_count' ) ";
    $query = $connection->exec($sql) ;  
    header('location:http://localhost/heaxashop/index.php') ; 
}














?>



<!DOCTYPE html>
<html lang="en">

        <?PHP include("short_code/header.php") ;   ?> 

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Single Product Page</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <div class="left-images">
                    <img src="<?php echo $product->image ?>" alt="">
                    <!-- <img src="assets/images/single-product-02.jpg" alt=""> -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content">
                    <h4><?php echo $name = $product->name ?> </h4>
                    <span class="price"> <?php echo '$' . $product->price ?> </span>
                    <ul class="stars">
                        <?php 
                                       $stars = $product->stars ; 
                                        if(isset($stars))
                                   {
                                        if( $stars > 5 )
                                        {
                                            $stars = 5 ;
                                        }
                                        for( $i = 0 ; $i < $stars ; $i++  )
                                        {
                                            echo "<li><i class='fa fa-star'></i></li>" ; 
                                        }
                                    }

                                        ?>
                    </ul>
                    <span> <?php echo  $product->content ?></span>
                    <div class="quote">
                        <i class="fa fa-quote-left"></i><p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore. </p>
                    </div>
                    <div class="quantity-content">
                        <div class="left-content">
                            <h6>No. of Orders</h6>
                        </div>
                        <div class="right-content">
                                 
                            <div class="quantity buttons_added">
                                <form  method="post" >
                                <input type="button" value="-" class="minus"><input type="number"  step="1" min="1" max="10" name="num" value="<?php echo isset($_POST['num'] ) ? "{$_POST['num']}" : "1" ;  ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><button type="button" value="+" class="plus"> + </button>
                                <button> OK </button>
                                </form>
                            </div>
                            

                        </div>
                    </div>
                    <div class="total">
                        <?php $count = isset($_POST['num']) ? "{$_POST['num']}" : "1" ; ?>
                        <h4>Total:$<?php echo $total_price = number_format($product->price * $count )?></h4>
                        <?php $c_product=$_GET['product'] ?>
                        <div class="main-border-button">   <a href="<?php echo "?status=addtocard&count=$count&product=$c_product&post=" . $product->ID;  ?>">    Add To Card   </a>   </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="assets/images/white-logo.png" alt="hexashop ecommerce templatemo">
                        </div>
                        <ul>
                            <li><a href="#">16501 Collins Ave, Sunny Isles Beach, FL 33160, United States</a></li>
                            <li><a href="#">hexashop@company.com</a></li>
                            <li><a href="#">010-020-0340</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="#">Men’s Shopping</a></li>
                        <li><a href="#">Women’s Shopping</a></li>
                        <li><a href="#">Kid's Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2022 HexaShop Co., Ltd. All Rights Reserved. 
                        
                        <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    <script src="assets/js/quantity.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>
