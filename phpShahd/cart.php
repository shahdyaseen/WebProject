<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>

    <title>7AKORA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Css/homeStyle.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="icon" href="../icons/logo.png">
    <script src="../javaScript/homeJS.js"></script>


</head>

<?php
$date=date("Y-m-d");
session_start();
$myname=$_SESSION['user'];
//echo "<a href='../htmlUser/home.html'>الرجوع</a><hr>";
?>
<body>

<section id="headerSc">
    <div id="mainMenu">


        <ul id="menuList">
            <div class="liContainer">
                <li><a class="" href="../htmlUser/contactus.html">تواصل معنا</a></li>
                <li><a class="" href="../htmlUser/aboutUs.html">قصتنا</a></li>
                <li> <a class="" href="../htmlUser/categories.html">منتجاتنا</a></li>
                <li> <a class="active" href="../htmlUser/home.html">الرئيسية</a></li>
            </div>

            <div class="logoContainer">
                <img src="../icons/logo.png" >

            </div>
        </ul>

    </div>
</section>






<form class="containerOrder" method="post" action="../phpMotasem/cart.php">
   <div class="rowContainer">
       <div class="inputInformation">
       <select  class="locationSelect" name="dlocation" onchange="this.form.submit()">
        <?php
        if(isset($_POST['dlocation'])){
            $d=$_POST['dlocation'];
            echo "<option>$d</option>";
        }
        ?>
        <option value="20">الضفة (20)</option>
        <option value="30">القدس (30)</option>
        <option value="70">اراضي الداخل (70)</option>
    </select>

    <input type="text" class="inputText" name="location" placeholder=" الموقع " required>
    <input type="text" class="inputText" name="phone" placeholder="رقم الهاتف " required>

    <br>
    <button class="orderButton" name="purchase">تأكيد الطلب</button>

       </div>


       <div>
           <table class='tableCart'>

               <tr>
                   <th class='imgTable'><h5>صورة المنتج</h5> </th>
                   <th class='productNameTable'><h5>اسم المنتج</h5> </th>
                   <th class='priceTable'><h5>السعر</h5> </th>
                   <th> </th>

               </tr>


    <?php
    $dlocation = isset($_POST['dlocation']) ? $_POST['dlocation'] : '0';

$c=mysqli_connect("localhost","root","","7akora");
$q2="select UID from users where username='$myname';";
$x2=mysqli_query($c,$q2);
while($a2=mysqli_fetch_assoc($x2)){
    $UID=$a2['UID'];
}


$q3="select * from cart where UID=$UID;";
$x3=mysqli_query($c,$q3);
$data=array(array());
while($a3=mysqli_fetch_assoc($x3)){
    $data[]=$a3;
}

//var_dump($data);
//echo "<table class='tableCart'>
//
//  <tr>
//        <th class='imgTable'> صورة المنتج</th>
//        <th class='productNameTable'> اسم المنتج</th>
//        <th class='priceTable'> السعر</th>
//        <th> </th>
//
//    </tr>
//";
$sum=0;

foreach ($data as $cart){
    if (!empty($cart['CID'])) {
        $CID = $cart['CID'];

        if (!empty($cart['PID'])) {
            $PID = $cart['PID'];

            if ($PID != '') {
                $q4 = "select * from products where PID=$PID;";
                $x4 = mysqli_query($c, $q4);

                while ($a4 = mysqli_fetch_assoc($x4)) {
                    $pname = $a4['pname'];
                    $img=$a4['pic'];
                    $price = $a4['price'];
                }
                if ($CID != '')
                {
                    echo "<tr>";

                    echo "<td class='imgTable'><img src='$img'></td>";
                    echo "<td class='productNameTable'>$pname</td>";
                    echo "<td class='priceTable'>$price</td>";

                    echo "<td><input class='removeFromCart' type='submit' name='$CID' value='ازالة من السلة'></td>";
                    if (isset($_POST[$CID])) {
                        $q5 = "delete from cart where CID=$CID;";
                        mysqli_query($c, $q5);
                        header("location:cart.php");
                    }
//                    echo "<td class='priceTable'>$price</td>";
//                    echo "<td class='productNameTable'>$pname</td>";
//                    echo "<td class='imgTable'><img src='$img'></td>";

                    $sum += $price;

                    echo "</tr>";
                }
            }
        }
}
}
$sum+=$dlocation;
echo "<tr><td colspan='3'>المجموع = $sum</td></tr></table>";
?>


<?php

if(isset($_POST['purchase'])){

$location=$_POST['location'];
$phone=$_POST['phone'];
//echo"$location <br> $phone";
foreach ($data as $purchase){

$ID=$purchase['PID'];
$CC=$purchase['CID'];
if($CC!=''){
    $q6="insert into orders(UID,PID,location,phone,quantity,total,date,notification,rec)
values($UID,$ID,'$location','$phone',1,1,'$date',1,0);";
    $q7="delete from cart where CID=$CC;";
    mysqli_query($c,$q6);
    mysqli_query($c,$q7);
    echo "<script>
window.alert('purchased');
window.location.href='userPanel.php';
</script>";
    }
}

}
?>
           </table>
       </div>
   </div>
</form>




</body>

</html>