<?php
$date=date("Y-m-d");
session_start();
$myname=$_SESSION['user'];
echo "Welcome $myname ";
echo "<a href='usserPanelHoodie.php'>back to panel</a><hr>";
?>


<html>
<form method="post" action="cart.php">
    <select name="dlocation" onchange="this.form.submit()">
        <?php
        if(isset($_POST['dlocation'])){
            $d=$_POST['dlocation'];
            echo "<option>$d</option>";
        }
        ?>
        <option value="20">west bank(20)</option>
        <option value="30">Jerusalem(30)</option>
        <option value="70">Occupied Lands(70)</option>
    </select>
<input type="text" name="location" placeholder="enter your location" required>
    <input type="text" name="phone" placeholder="enter your phone" required>

<?php
$dlocation=$_POST['dlocation'];


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
echo "<table>";
$sum=0;

foreach ($data as $cart){

   $CID=$cart['CID'];
   $PID=$cart['PID'];
if($PID!='') {
    $q4 = "select * from products where PID=$PID;";
    $x4 = mysqli_query($c, $q4);

    while ($a4 = mysqli_fetch_assoc($x4)) {
        $pname = $a4['pname'];

        $price = $a4['price'];
    }
    if ($CID != '') {
        echo "<tr>";
        echo "<td><input type='submit' name='$CID' value='remove from cart'></td>";
        if (isset($_POST[$CID])) {
            $q5 = "delete from cart where CID=$CID;";
            mysqli_query($c, $q5);
            header("location:cart.php");
        }
        echo "<td>$pname</td>";
        echo "<td>$price</td>";
        $sum += $price;

        echo "</tr>";
    }
}
}
$sum+=$dlocation;
echo "<tr><td colspan='3'>total= $sum</td></tr></table>";
?>
    <br>

    <button name="purchase">purchase</button>

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
window.location.href='userPanelHoodie.php';
</script>";
    }
}

}
?>
</form>
</html>