<?php
session_start();
if(empty($_SESSION['username']) & empty($_SESSION['password'])){
    echo "<script> window.location = 'login.php'</script>";
}
include('connect.php');

$query = "SELECT cmajor_request.status,cmajor_request.mid,cmajor_request.rid FROM cmajor_request,cm_request where cm_request.rid = cmajor_request.rid";
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
                <li><a href="cmajor_request_list.php">Community Major Request</a></li>
                <li><button onclick="location.href='logout.php'">Logout</button></li> 
            </ul>
        </nav>
</header>
    <main>
        <h2>Request List</h2>
        <table  >
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php $id = $row['mid']; $rid = $row['rid']; echo $row['name']; ?></td>
                    <td><?php if($row['status']=="Pending"){echo "<form action='#' method='post'>
                <input type='hidden' name='mid' value='".$row['mid']."'>
                <input type='hidden' name='rid' value='".$row['rid']."'>
                <input type='submit' name='accept' value='accept'>
                <input type='submit' name='reject' value='reject'>
            ";if(isset($_POST['accept'])){
                $sql = "update cmajor_request set status='Accepted' where mid=".$_POST['mid']."";
                $result = mysqli_query($con, $sql);
                $sql = "update cm_request set role='cMajor' where rid=".$_POST['rid']."";
                $result = mysqli_query($con, $sql);
                if($result){
                    echo "<script> window.location='cmajor_request_list.php'  </script>";
                }
            }
            if(isset($_POST['reject'])){
                $sql = "update cmajor_request set status='Rejected' where mid=".$_POST['mid']."";
                $result = mysqli_query($con, $sql);
                if($result){
                    echo "<script> window.location='cmajor_request_list.php'  </script>";
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