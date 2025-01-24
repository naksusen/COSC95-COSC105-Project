<?php 

$conn = mysqli_connect("localhost", "root", "", "g-arat");

if (!function_exists('roleConfirm'))   
{function roleConfirm($loggedin, $email) {
  if (isset($loggedin) && $loggedin == true) {
      //$email = $_SESSION['email'];
      $sql = "Select * from users where email='$email'";
      $result = mysqli_query(mysqli_connect("localhost", "root", "", "g-arat"), $sql);
      $row = mysqli_fetch_assoc($result);
      if($row['role']=="User") {
        echo "<script>
        alert('You don't have admin privileges.');
        </script>";
        header("location: index.php");
      }
    } else {
      session_destroy();
        header("location: login.php");
    }
}}

if(mysqli_connect_error()){
    echo "<script>alert('Cannot connect to database!');</script>";
    exit();
}



?>