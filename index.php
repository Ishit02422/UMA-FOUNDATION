<script>window.location='test1/index.php'</script>
<?php
    session_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Uma Foundation - Home </title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <header>
        <h1> Uma Foundation </h1>
        <nav>
            <ul>
                <li> <a href="index.php"> Home </a> </li>
                <li> <a href="test1/announcement.php"> Announcement </a> 
                    <!-- <div class="sub-announcemet">
                        <ul>
                            <li> <a href="event.php"> Event </a> </li>
                        </ul>
                    </div> -->
                </li>
                <li> <a href="test1/hallbooking.php"> Hall Booking </a> </li>
                <li> <a href="donation.php"> Donation </a> </li>
                <li> <a href="scholarship.php"> SchoralShip </a> </li>
                <li> <a href="Registration.php"> Registration </a> </li>
                <li> <a href="profile.php"> Profile </a> </li>
                <li> <a href="login.php"> Login </a> </li>
                
            </ul>
        </nav>
    </header>

    <div class="content">
        <?php if (isset($_SESSION['username'])) : ?>
            <p> Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <?php endif; ?>
        <h2>Welcome to Uma Foundation</h2>
        <p>
            The Community Management System aims to develop an innovative and efficient online platform for managing various activities and services within the community.
        </p>
        <p>
            The system will automate and digitize management processes, making it easier for administrators, managers, and members to collaborate, track activities, and
            manage services such as events, scholarships, donations, and hall bookings.
        </p>
    </div>

    <footer>
        <p>&copy; 2024 Uma Foundation. All rights reserved.</p>
    </footer>
</body>

</html>