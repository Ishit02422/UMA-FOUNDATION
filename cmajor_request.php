<html>
    <head>
        <titel></titel>
    </head>
    <body>
    <?php
 session_start();
 if(empty($_SESSION['username']) & empty($_SESSION['password'])){
    header("Location:login.php");
 }
     include "connect.php";

$_SESSION['username'] = $username; 
$_SESSION['password'] = $password; 
//$_SESSION['rid'] = $rid; 

     $rid = $_SESSION['rid'];
     $sql = "select * from cmajor_request where rid = $rid and status='Pending'";

     $result = mysqli_query($con, $sql);
     if($result->num_rows > 0){
        echo "<script> alert('Request Already Sent.');window.location='cm_request.php' </script>";
        //header("Location:member.php");
        exit();
     }
    $sql = "insert into cmajor_request (rid) values ($rid) ";

    $result = mysqli_query($con, $sql);
    if($result){
        echo "<script> alert('Request Send successful.');window.location='cm_request.php' </script>";
        //header("Location:member.php");
    }
?>
    </body>
</html>
