<!DOCTYPE html>
<html>
<head>
    <style>
        td{
            border:1px solid grey;
        }
    </style>
</head>
<?php
$c=mysqli_connect("localhost","root","","7akora");

 echo "<a href='cpanel.php'>back</a>"
?>

<form method="post" action="showorders.php">

    <?php


    $q2="select * from orders;";
    $x=mysqli_query($c,$q2);
    $data=array(array());

    while($a=mysqli_fetch_assoc($x)){
        $data[]=$a;
    }


    echo "<br><br><table>
<tr>
<td>del</td>
<td>rec</td>
<td>PID</td>
<td>customer</td>
<td>location</td>
<td>phone</td>
<td>quantity</td>
<td>total</td>
<td>date</td>

</tr>";

    foreach($data as $product){
        if($product['OID']!="") {
            echo "<tr>";
            $PID=$product['PID'];
            $q2="select pname,price from products where PID=$PID;";
            $x=mysqli_query($c,$q2);
            while($a=mysqli_fetch_assoc($x)){
                $price=$a['price'];
                $pname=$a['pname'];
            }

            $id = $product['OID'];
            $rec = $product['rec'];
            $name = $product['customerName'];
            $location = $product['location'];
            $phone = $product['phone'];
            $quan=$product['quantity'];
            $total=$price*$quan;
            $date=$product['date'];
            $not=$product['notification'];



            echo "<td><input type='submit' name='$id' value='X'></td>";

            if (isset($_POST[$id])) {
                $q3 = "delete from orders where OID=$id;";
                mysqli_query($c, $q3);
                header("location:showorders.php");
            }

            echo "<td><input type='submit' name='r_$id' value='delevered' ";
            if($rec==1) echo " disabled";
            echo "></td>";

            if (isset($_POST['r_'.$id])) {
                $q4= "update orders set rec=1 where OID=$id;";
                mysqli_query($c, $q4);
                header("location:showorders.php");
            }
if($not==1){
    echo "<td style='color:red;'>$pname</td>";
    echo "<td style='color:red;'>$name</td>";
    echo "<td style='color:red;'>$location</td>";
    echo "<td style='color:red;'>$phone</td>";
    echo "<td style='color:red;'>$quan</td>";
    echo "<td style='color:red;'>$total</td>";
    echo "<td style='color:red;'>$date</td>";
}
      else {
          echo "<td>$pname</td>";
          echo "<td>$name</td>";
          echo "<td>$location</td>";
          echo "<td>$phone</td>";
          echo "<td>$quan</td>";
          echo "<td>$total</td>";
          echo "<td>$date</td>";
      }



            echo "</tr>";
        }

    }
    echo "</table>";


    $q5="update orders set notification=0 where notification=1;";
    mysqli_query($c,$q5);

    ?>




</form>
</html>