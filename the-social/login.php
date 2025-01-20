<?php
session_start();

   // Database credentials
   $servername = "localhost";
   $username = "root"; // Replace with your database username
   $password = ""; // Replace with your database password
   $dbname = "user_registration"; // Database name
   
$data=mysqli_connect($servername,$username,$password,$dbname);

if($dbname===false){
    die("connection error");

}
if(isset($_POST['submit']))
{
    $id=$_POST['email'];
    $pass=$_POST['password'];

    $sql="SELECT * FROM users WHERE email='".$id."' AND password='".$pass."' ";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);
    if($row)
    {
        header("location:feed.php");
    }else
    {
        header("location:index.php");
    }
}




?>