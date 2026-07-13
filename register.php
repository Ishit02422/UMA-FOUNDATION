<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $username = $_POST['username'];
    $pass = $_POST['password'];
    $email=$_POST['email'];

    if (!empty($email) && !empty($pass)) {
        
        $username = mysqli_real_escape_string($con, $username);
        $pass = mysqli_real_escape_string($con, $pass);
        $email = mysqli_real_escape_string($con, $email);
        
        $hashed_pass = md5($pass);
        $role='Member';
        $sql = "INSERT INTO user_table (username,Email,Password,role) VALUES ('$username','$email','$hashed_pass','$role')";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Registration successful!');window.location='login.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "<script>alert('All fields are required!')</script>";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Uma Foundation</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li class="current"><a href="register.php">Registration</a></li>
                    <li><a href="test1/announcement.php">Events</a></li>
                    <li><a href="scholarships.php">Scholarships</a></li>
                    <li><a href="test1/hallbooking.php">Hall Booking</a></li>
                    <li><a href="donation.php">Donations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <form action="register.php" method="post">
            <div id="register">
                <h1 class="form-title">Register</h1>
                <div class="input-box">
                    <i class='bx bxs-user-circle'></i>
                    <select name="role" required>
                        <option value="">Select Role</option>
                        <option value="CommitteeMajor" name="CommitteeMajor">Committee Major</option>
                        <option value="CommitteeMember" name="CommitteeMember">Committee Member</option>
                        <option value="Member" name="Member">Member</option>
                    </select>
                </div>

                <div class="input-box">
                    <i class='bx bxs-user'></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <i class='bx bx-envelope'></i>
                    <input type="email" name="email" placeholder="xyz@gmail.com" required>
                </div>

                <div class="input-box">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                
                <input type="submit" class="btn" value="Register" name="register">
            </div>
        </form>
    </div>

    <footer>
        <p>Uma Foundation, &copy; 2024</p>
    </footer>
</body>
</html>
