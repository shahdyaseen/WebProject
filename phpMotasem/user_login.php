
<?php

if(isset($_POST['login'])){
    $user=$_POST['user'];
    $password=$_POST['password'];
    $c=mysqli_connect("localhost","root","","7akora");

    $q="select * from users where username='$user';";
    $x=mysqli_query($c,$q);
    while($a=mysqli_fetch_assoc($x)){
        $userfromdata=$a['username'];
        $passfromdata=$a['password'];
    }
    if($user!=$userfromdata) echo "username does not exist";
    else if($password!=$passfromdata) echo "wrong password";
    else{

        if(!empty($_POST['remember'])){
            setcookie("user",$user,time()+10000000);
            setcookie("password",$password,time()+10000000);
        }
        else{
            setcookie("user","");
            setcookie("password","");

        }
        session_start();
        $_SESSION['user']=$user;


        header("location:../phpMotasem/userPanelHoodie.php");

    }




}