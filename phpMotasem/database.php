<?php
$c=mysqli_connect("localhost","root","","7akora");
$q1="create table admins (
    username varchar(10),
    password varchar(10)
);";

$q2="create table products(
    PID int primary key ,
    type varchar (10),
    pname varchar(20),
    description varchar(100),
    price double,
    pic varchar(20)
);";
$q3="create table orders (
    OID int primary key auto_increment,
   UID int, PID int, location varchar(20),phone varchar(20), quantity int,
    total double,date date, notification bit,rec bit,
    foreign key (PID) references products(PID),foreign key (UID) references users(UID)
);";
$q4="insert into admins values('motasem','123');";


$q5="create table users (
    UID int primary key auto_increment,
    username varchar(10) unique ,
    password varchar(10)
);";


$q6="create table cart (
    CID int primary key auto_increment,
    UID int, PID int,foreign key (PID) references products(PID),foreign key (UID) references users(UID)
);";


mysqli_query($c,$q1);
mysqli_query($c,$q2);
mysqli_query($c,$q5);
mysqli_query($c,$q3);
mysqli_query($c,$q4);
mysqli_query($c,$q6);

?>
