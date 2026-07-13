<?php
session_start();
if(empty($_SESSION['username']) & empty($_SESSION['password'])){
    echo "<script> window.location = 'login.php'</script>";
}
include('connect.php');

$query = "SELECT tbl_user.name,cm_request.status,cm_request.rid,cm_request.uid FROM cm_request,tbl_user where tbl_user.uid = cm_request.uid";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Uma Foundation</title>
    <link rel="stylesheet" href="style2.css"> 
    <style>
        table,td,tr,th{
            border: 2px solid black;
         }
    </style>
</head>
<body>
<header>
        <h1>Uma Foundation</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="test1/announcement.php">Events</a></li>
                <li><a href="test1/hallbooking.php">Hall Booking</a></li>
                <li><a href="donation.php">Donation</a></li>
                <li><a href="cm_request_list.php">Community Member Requests</a></li>
                <li><button onclick="location.href='logout.php'">Logout</button></li> 
            </ul>
        </nav>
</header>
    <main>
        <h2>Request List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php $id = $row['rid']; $uid = $row['uid']; echo $row['name']; ?></td>
                    <td><?php if($row['status']=="Pending"){echo "<form action='#' method='post'>
                <input type='hidden' name='rid' value='".$row['rid']."'>
                <input type='hidden' name='uid' value='".$row['uid']."'>
                <input type='submit' name='accept' value='accept'>
                <input type='submit' name='reject' value='reject'>
            ";if(isset($_POST['accept'])){
                $sql = "update cm_request set status='Accepted' where rid=".$_POST['rid']."";
                $result = mysqli_query($con, $sql);
                $sql = "update tbl_user set role='cMember' where uid=".$_POST['uid']."";
                $result = mysqli_query($con, $sql);
                if($result){
                    echo "<script> window.location='cm_request_list.php'  </script>";
                }
            }
            if(isset($_POST['reject'])){
                $sql = "update cm_request set status='Rejected' where rid=".$_POST['rid']."";
                $result = mysqli_query($con, $sql);
                if($result){
                    echo "<script> window.location='cm_request_list.php'  </script>";
                }
            }echo  "</form>";} else { echo $row['status'];}?></td>
                </tr> 
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
    <?php
    
    ?>
    <footer>
        <p>&copy; 2024 Uma Foundation. All rights reserved.</p>
    </footer>
</body>
</html>