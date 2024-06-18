
<?php
if(isset($_POST['ok'])){
    $user=$_POST['name'];
    $pass=$_POST['pass'];

    $c=mysqli_connect("localhost","root","","7akora");
$q="insert into users (username,password) values('$user','$pass');";
mysqli_query($c,$q);
echo "<script>
window.alert('done');
window.location.href='user_login.php';
</script>";
}