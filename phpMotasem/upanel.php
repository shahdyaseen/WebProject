<html>
<form method="post" action="upanel.php">
    <?php
    session_start();
    $myname=$_SESSION['user'];
    echo "Welcome $myname <hr>";
    echo "<a href='cart.php'>go to cart</a><br><br>";

    $c=mysqli_connect("localhost","root","","7akora");
    $q="select * from products;";
    $x=mysqli_query($c,$q);
    $data=array(array());
    while($a=mysqli_fetch_assoc($x)){
        $data[]=$a;
    }
    foreach($data as  $product) {
        $id = $product['PID'];
        $pname = $product['pname'];
        $type = $product['type'];
        $description = $product['description'];
        $price = $product['price'];
        $pic = $product['pic'];
        if ($id != ''){
            echo "<img src='$pic' style='width:100px;'><br>";
            echo "$pname <br> $type <br> $description <br> $price <br>";
            echo "<input type='submit' name='$id' value='add to cart'><hr>";
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
</form>
</html>