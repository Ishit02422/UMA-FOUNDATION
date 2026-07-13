<?php 
session_start();
if(!isset($_SESSION['id'])){
    echo "<script>alert('Please login first.');window.location='../login.php';</script>"; exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Profile - Uma Foundation</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #0d1117;
            color: #e6edf3;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Background decorative gradient */
        .bg-gradient {
            position: fixed;
            inset: 0;
            background: #0d1117;
            z-index: 0;
        }
        .bg-gradient::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 65%);
            border-radius: 50%;
        }
        .bg-gradient::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(139,92,246,0.1) 0%, transparent 65%);
            border-radius: 50%;
        }

        /* Navigation Header */
        .nav-bar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
            background: rgba(13, 17, 23, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 0 40px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: #fff;
        }
        .nav-links {
            display: flex;
            gap: 6px;
            list-style: none;
            align-items: center;
        }
        .nav-links a {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 0.86rem;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-links a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.07);
        }
        .nav-btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: #fff !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
        }

        /* Container & Card Layout */
        .wrapper {
            position: relative;
            z-index: 10;
            padding: 100px 20px 60px;
            max-width: 760px;
            margin: 0 auto;
            width: 100%;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card {
            background: #161b22;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            width: 100%;
        }
        .card-header {
            padding: 26px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .profile-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        .header-title h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 3px;
        }
        .header-title p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.45);
        }
        .card-body {
            padding: 30px;
        }

        /* Form Controls */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .form-full {
            grid-column: 1 / -1;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-size: 0.72rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.45);
            margin-bottom: 8px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-group label i {
            color: #6366f1;
            font-size: 0.8rem;
        }
        .form-inp {
            padding: 12px 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 9px;
            color: #e6edf3;
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            outline: none;
            transition: all 0.3s;
            width: 100%;
        }
        .form-inp:focus:not([readonly]):not([disabled]) {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.06);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        .form-inp[readonly], .form-inp[disabled] {
            background: rgba(255, 255, 255, 0.01);
            border-color: rgba(255, 255, 255, 0.03);
            color: rgba(255, 255, 255, 0.6);
            cursor: not-allowed;
        }
        textarea.form-inp {
            resize: vertical;
            min-height: 85px;
            line-height: 1.5;
        }
        select.form-inp {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.45)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
        }

        /* Buttons Styling */
        .btn-row {
            display: flex;
            gap: 12px;
            margin-top: 26px;
            flex-wrap: wrap;
        }
        .btn {
            flex: 1;
            min-width: 120px;
            padding: 12px 20px;
            border: none;
            border-radius: 9px;
            font-size: 0.88rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #fff;
            text-decoration: none;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .btn-edit {
            background: linear-gradient(135deg, #10b981, #059669);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }
        .btn-edit:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        }
        .btn-home {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e6edf3;
        }
        .btn-home:hover {
            background: rgba(255, 255, 255, 0.12);
        }
        .btn-logout {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
        }
        .btn-logout:hover {
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        }
        .btn-update {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
        }
        .btn-update:hover {
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
        }

        /* Footer styling */
        .footer {
            margin-top: auto;
            padding: 30px 20px;
            text-align: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(13, 17, 23, 0.6);
            position: relative;
            z-index: 10;
        }

        @media(max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .nav-bar {
                padding: 0 16px;
            }
            .nav-links {
                display: none;
            }
            .btn-row {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="bg-gradient"></div>
    
    <!-- Navigation -->
    <nav class="nav-bar">
        <a href="../index.php" class="logo">
            <div class="logo-icon"><i class="fa-solid fa-house-chimney"></i></div>
            Uma Foundation
        </a>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="#">Hall Booking</a></li>
            <li><a href="../test1/donationform.php">Donation</a></li>
            <li><a href="../test1/announcement.php">Events</a></li>
            <li><a href="../logout.php" class="nav-btn">Logout</a></li>
        </ul>
    </nav>

    <!-- Main Wrapper -->
    <div class="wrapper">
        <div class="card">
            <?php
            include "../connect.php";
            $query = "SELECT * FROM tbl_user WHERE id = '".intval($_SESSION["id"])."'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $initials = strtoupper(substr($user['name'], 0, 1));
            ?>
            <div class="card-header">
                <div class="profile-avatar"><?php echo $initials; ?></div>
                <div class="header-title">
                    <h3>My Profile</h3>
                    <p>Manage and update your account details</p>
                </div>
            </div>
            
            <div class="card-body">
                <form id="profileForm">
                    <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i> Full Name</label>
                            <input class="form-inp" type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly required>
                        </div>
                        
                        <div class="form-group">
                            <label for="uname"><i class="fa-solid fa-circle-user"></i> Username</label>
                            <input class="form-inp" type="text" name="uname" id="uname" value="<?php echo htmlspecialchars($user['username']); ?>" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i> Email Address</label>
                            <input class="form-inp" type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="cno"><i class="fa-solid fa-phone"></i> Contact Number</label>
                            <input class="form-inp" type="tel" name="cno" id="cno" value="<?php echo htmlspecialchars($user['contactno']); ?>" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="gender"><i class="fa-solid fa-venus-mars"></i> Gender</label>
                            <select class="form-inp" name="gender" id="gender" disabled required>
                                <option value="0" <?php echo ($user['gender'] == '0') ? 'selected' : ''; ?>>Male</option>
                                <option value="1" <?php echo ($user['gender'] == '1') ? 'selected' : ''; ?>>Female</option>
                                <option value="3" <?php echo ($user['gender'] != '0' && $user['gender'] != '1') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dob"><i class="fa-solid fa-calendar-days"></i> Date of Birth</label>
                            <input class="form-inp" type="date" name="dob" id="dob" value="<?php echo $user['dob']; ?>" readonly required>
                        </div>

                        <div class="form-group form-full">
                            <label for="address"><i class="fa-solid fa-map-location-dot"></i> Street Address</label>
                            <textarea class="form-inp" name="address" id="address" rows="3" readonly required><?php echo htmlspecialchars($user['address']); ?></textarea>
                        </div>

                        <div class="form-group form-full">
                            <label for="city"><i class="fa-solid fa-city"></i> City</label>
                            <select class="form-inp" name="city" id="city" disabled required>
                                <?php
                                    $cityId = $user['cityid'];
                                    $cityQuery = "SELECT * FROM tbl_city";
                                    $cityResult = mysqli_query($con, $cityQuery);
                                    while ($cityRow = mysqli_fetch_assoc($cityResult)) {
                                        $selected = ($cityRow['id'] == $cityId) ? 'selected' : '';
                                        echo "<option value='{$cityRow['id']}' {$selected}>{$cityRow['name']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn btn-edit" id="editProfile"><i class="fa-solid fa-user-pen"></i> Edit Profile</button>
                        <button type="submit" class="btn btn-update" id="update" hidden><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                        <button type="button" class="btn btn-home" id="home"><i class="fa-solid fa-arrow-left"></i> Home</button>
                        <button type="button" class="btn btn-logout" id="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                    </div>
                </form>
            </div>
            <?php
            } else {
                echo "<div class='card-body'><p class='text-center'>No user data found. Please log in again.</p></div>";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>Copyright © 2026 Uma Foundation. All Rights Reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="../test1/vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#editProfile").click(function(){
                $("#name").removeAttr('readonly');
                $("#uname").removeAttr('readonly');
                $("#cno").removeAttr('readonly');
                $("#gender").removeAttr('disabled');
                $("#email").removeAttr('readonly');
                $("#dob").removeAttr('readonly');
                $("#address").removeAttr('readonly');
                $("#city").removeAttr('disabled');
                $("#update").removeAttr('hidden');
                $("#editProfile").hide();
            });

            $("#home").click(function() {
                window.location.href = '../test1/index.php';
            });

            $("#logout").click(function() {
                window.location.href = '../login.php';
            });

            $('#profileForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: '../updateprofile.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response == true || response.trim() == "1") {
                            alert('Profile updated successfully');
                            location.reload();
                        } else {
                            alert(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error updating profile: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>