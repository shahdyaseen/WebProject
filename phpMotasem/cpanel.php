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
$q5="select notification from orders;";
$x3=mysqli_query($c,$q5);
$count=0;
while($b=mysqli_fetch_assoc($x3)){
    if($b['notification']==1)$count++;
}
if($count!=0) echo "<a href='showorders.php' style='color:red;'>show orders + $count</a>";
else echo "<a href='showorders.php'>show orders</a>"
?>

<form method="post" action="cpanel.php" enctype="multipart/form-data">

    <div>
    <select name="type">
        <option>Cloth</option>
        <option>Mug</option>
        <option>Bag</option>
    </select>
    <input type="text" name="PID" placeholder="Product ID">
    <input type="text" name="pname" placeholder="Product Name">
    <textarea name="description"></textarea>
    <input type="text" name="price" placeholder="Product Price">
    <input type="file" name="pic">
    <input type="submit" name="add" value="Add product">
    </div>
  <?php

  //if(!file_exists("products")) mkdir("products");
  if (isset($_POST['add'])){
      $pname = $_POST['pname'];
      $PID=$_POST['PID'];
      $type = $_POST['type'];
      $description=$_POST['description'];
      $price=$_POST['price'];
      $file=$_FILES['pic'];
      $tmpname=$file['tmp_name'];
      $oldname=$file['name'];
      $arr=explode(".",$oldname);
      $newname="products/".$PID.".".$arr[1];


      $q="insert into products values($PID,'$type','$pname','$description',$price,'$newname');";
      mysqli_query($c,$q);


      if(move_uploaded_file($tmpname,$newname)){

          header("location:cpanel.php");
      }
      else echo "error loading files";

  }


    $q2="select * from products;";
    $x=mysqli_query($c,$q2);
    $data=array(array());

    while($a=mysqli_fetch_assoc($x)){
        $data[]=$a;
    }


    echo "<br><br><table>
<tr>
<td>del</td>
<td>PID</td>
<td>type</td>
<td>pname</td>
<td>description</td>
<td>price</td>
</tr>";

    foreach($data as $product){
if($product['PID']!="") {
    echo "<tr>";
    $id = $product['PID'];
    $t = $product['type'];
    $name = $product['pname'];
    $des = $product['description'];
    $pr = $product['price'];

    echo "<td><input type='submit' name='$id' value='X'></td>";

    if (isset($_POST[$id])) {
        $q3 = "delete from products where PID=$id;";
        mysqli_query($c, $q3);
        header("location:cpanel.php");
    }

    echo "<td>$id</td>";
    echo "<td>$t</td>";
    echo "<td>$name</td>";
    echo "<td>$des</td>";
    echo "<td><input type='text' name='p_$id' value='$pr'></td>";

    if(isset($_POST['update'])){
        $newprice=$_POST['p_'.$id];
        $q4="update products set price=$newprice where PID=$id;";
        mysqli_query($c, $q4);
        header("location:cpanel.php");
    }

    echo "</tr>";
}

    }
echo "</table>";
    ?>

<button name="update">update changes</button>


</form>
</html>