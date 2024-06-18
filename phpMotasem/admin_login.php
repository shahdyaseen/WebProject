<?php

if(isset($_POST['login'])){
    $user=$_POST['user1'];
    $password=$_POST['password1'];
    $c=mysqli_connect("localhost","root","","7akora");

    $q="select * from admins where username='$user';";
    $x=mysqli_query($c,$q);
    while($a=mysqli_fetch_assoc($x)){
        $userfromdata=$a['username'];
        $passfromdata=$a['password'];
    }
    if($user!=$userfromdata) echo "username does not exist";
    else if($password!=$passfromdata) echo "wrong password";
    else{

        if(!empty($_POST['remember1'])){
            setcookie("user1",$user,time()+10000000);
            setcookie("password1",$password,time()+10000000);
        }
        else{
            setcookie("user1","");
            setcookie("password1","");

        }

        header("location:../htmlAdmin/cartPanel.html");

    }




}