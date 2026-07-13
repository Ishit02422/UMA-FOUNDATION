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

     $id = $_SESSION['uid'];
     $sql = "select * from cm_request where uid = $id and status='Pending'";

     $result = mysqli_query($con, $sql);
     if($result->num_rows > 0){
        echo "<script> alert('Request Already Sent.');window.location='member.php' </script>";
        //header("Location:member.php");
        exit();
     }
    $sql = "insert into cm_request (uid) values ($id) ";

    $result = mysqli_query($con, $sql);
    if($result){
        echo "<script> alert('Request Send successful.');window.location='member.php' </script>";
        //header("Location:member.php");
    }
?>
    </body>
</html>
