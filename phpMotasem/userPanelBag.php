<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>

        <title>7AKORA</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="../Css/categoriesStyle.css">
        <link rel="stylesheet" href="../Css/homeStyle.css">
        <link rel="icon" href="../icons/logo.png">
        <script src="../javaScript/homeJS.js"></script>
        <script src="../javaScript/categoriesButton.js"></script>
        <script src="../javaScript/cartCategories.js"></script>
        <script src="../javaScript/goToProductPage.js"></script>

    </head>
</head>

<body>

<section id="headerSc">
    <div id="mainMenu">
        <ul id="menuList">
            <div class="liContainer">
                <li><a class="" href="../htmlUser/contactus.html">تواصل معنا</a></li>
                <li><a class="" href="../htmlUser/aboutUs.html">قصتنا</a></li>
                <li> <a class="active" href="../htmlUser/categories.html">منتجاتنا</a></li>
                <li> <a class="" href="../htmlUser/home.html">الرئيسية</a></li>
            </div>

            <div class="logoContainer">
                <img src="../icons/logo.png" >

            </div>
        </ul>


    </div>
</section>

<div class="searchContainer">
    <input type="text" id="searchInput" placeholder="ابحث عن المنتجات..." oninput="filterProducts()">
    <button id="shoppingCart"><img src="../icons/shoppingCart.png"></button>
</div>


<div class="containerCategories">

    <div class="btn-group" >
        <h1>الاقسام</h1>
        <button id="hoodiesActive" class="activeSec" onclick="gotoHoodies()"><h3>قسم الملابس</h3></button>
        <button id="mugsActive" class="noActiveSec" onclick="gotoMugs()"><h3>قسم الاكواب</h3></button>
        <button id="bagsActive" class="noActiveSec" onclick="gotoBags()"><h3>قسم الاكياس</h3></button>
    </div>

    <form method="post" action="userPanelBag.php">
        <?php
        session_start();
        $myname=$_SESSION['user'];
        echo "Welcome $myname <hr>";
        echo "<a href='cart.php'>go to cart</a><br><br>";

        $c=mysqli_connect("localhost","root","","7akora");
        $q="select * from products where type ='حقيبة';";
        $x=mysqli_query($c,$q);
        $data=array(array());


        while($a=mysqli_fetch_assoc($x)){
            $data[]=$a;
        }
        ?>

        <section id="hoodies" >
            <div id="container page-wrapper">
                <div class="page-inner">
                    <div class="row">

                        <?php
                        foreach($data as  $product) {
                            $id = $product['PID'];
                            $pname = $product['pname'];
                            $type = $product['type'];
                            $description = $product['description'];
                            $price = $product['price'];
                            $pic = $product['pic'];
                            if ($id != ''){
//        echo "<img src='$pic' style='width:100px;'><br>";
//    echo "$pname <br> $type <br> $description <br> $price <br>";
//    echo "<input type='submit' name='$id' value='add to cart'><hr>";
//
//



                                ?>

                                <div class="el-wrapper">
                                    <div class="box-up">
                                        <button class="buttonGoToProductPage" onclick="goToProductPage()"><img class="img" src="<?php echo $pic?>" alt=""> </button>
                                        <div class="img-info">
                                            <div class="info-inner">
                                                <span class="p-name"><?php echo $pname?></span>
                                                <span class="p-company">حاكورة</span>
                                            </div>
                                            <div class="a-size">المقاسات المتوفرة :<span class="size">S , M , L , XL</span></div>
                                        </div>
                                    </div>

                                    <div class="box-down">
                                        <div class="h-bg">
                                            <div class="h-bg-inner"></div>
                                        </div>

                                        <a class="cart" href="#" onclick="addToCart(event)">
                                            <span class="price"><?php echo $price?></span>
                                            <span class="add-to-cart">
              <span  class="txt">أضف الى السلة</span>
               </span>
                                        </a>
                                    </div>
                                </div>


                                <?php
                            }
                            if(isset($_POST[$id])){
                                $q2="select UID from users where username='$myname';";
                                $x2=mysqli_query($c,$q2);
                                while($a2=mysqli_fetch_assoc($x2)){
                                    $UID=$a2['UID'];
                                }


                                $q3="insert into cart(UID,PID) values($UID,$id);";
                                mysqli_query($c,$q3);
                                header("location:cart.php");
                            }
                        }
                        ?>

                    </div>
                </div>

            </div>
        </section>


    </form>
</div>



<div class="moreProductButton">
    <button >عرض المزيد</button>
</div>



<section id="footerSc">
    <footer class="footerContents">

        <div class="footerContainer">
            <div id="footerSocial">
                <h3 dir="rtl">تواصل معنا</h3>
                <ul class="imgSocial">
                    <li><a href="https://www.instagram.com/7akora.store?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"> <img src="../icons/instagram.PNG" width="25px"></a></li>
                    <li><a href="https://www.facebook.com/7akora.store1?mibextid=LQQJ4d" target="_blank"><img src="../icons/facebook.PNG" width="25px"></a></li>
                    <li><a href="https://wa.me/message/2KD7SQG2J7P6M1" target="_blank"> <img src="../icons/whatsapp.PNG" width="25px"></a></li>

                </ul>
            </div>


            <hr>
            <div id="copyright">

                حَاكُورَة ٢٠٢٤ ©

            </div>

        </div>

    </footer>
</section>



</body>
</html>