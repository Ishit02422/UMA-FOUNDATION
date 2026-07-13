<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .input-group {
            font-size: 40px;
        }

        .input-group input {
            border: 1px solid black;
        }

        th,
        td {
            padding-top: 4px;
            padding-bottom: 6px;
            padding-left: 6px;
            padding-right: 6px;
        }

        body {
            background-color: white;
        }
    </style>
</head>

<body>
    <center>
        <h1 class="form_title"> Registration </h1>
        <form id="registrationForm" method="POST" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <div class="input-group">
                        <th> Name: </th>
                        <td> <i class="fas fa-user"></i> <input type="text" name="name" id="name" pattern="[A-Za-z]*" minlength="2" placeholder="Name" title="Please Enter only Alphabet character!" required> </td>
                    </div>
                </tr>

                <tr>
                    <div class="input-group">
                        <th> Gender: </th>
                        <td> <i class="fas fa-venus-mars"></i>
                            <input type="radio" name="gender" value="Male" checked=""> Male
                            <input type="radio" name="gender" value="Female"> Female
                            <input type="radio" name="gender" value="other"> Other
                        </td>
                    </div>
                </tr>

                <tr>
                    <div class="input-group">
                        <th> Date of Birth: </th>
                        <td> <i class="fas fa-calendar"></i> <input type="date" id="dob" name="dob" required title="Please Select Date of Birth!"> </td>
                    </div>
                </tr>

                <tr>
                    <div class="input-group">
                        <th> Contact Number: </th>
                        <td> <i class="fas fa-envelope"></i> <input type="tel" class="form-control" id="cno" name="cno" maxlength="10" minlength="10" pattern="[0-9]{10}" required title="Please Enter only 10 digit Number!"> </td>
                    </div>
                </tr>

                <tr>
                    <div class="input-group">
                        <th> Address: </th>
                        <td> <i class="fas fa-home"></i> <textarea id="address" name="address" rows="4" cols="20" minlength="5" required title="Please Enter your Proper Address!"></textarea> </td>
                    </div>
                </tr>
                
                <tr>
                    <div class="input-group">
                        <th> Email: </th>
                        <td> <i class="fas fa-envelope"></i> <input type="email" name="email" id="email" size="21" placeholder="xyz12@gmail.com" pattern="[a-z0-9._%+\-]+@[a-z0-z0-9.\-]+\.[a-z]{2,}$" required title="Please Enter proper character, special character and digit!"> </td>
                    </div>
                </tr>

                <tr>
                    <div class="input-group">
                        <th> Password: </th>
                        <td> <i class="fas fa-user"></i> <input type="password" id="pass" name="pass" size="21" placeholder="Password" maxlength="8" minlength="8" required title="Please Enter correct password!"> </td>
                    </div>
                </tr>

                <tr>
                    <div class="input-group">
                        <th> Confirm Password: </th>
                        <td> <i class="fas fa-user"></i> <input type="password" id="pass" name="pass" size="21" placeholder="Password" maxlength="8" minlength="8" required title="Please Enter correct password!"> </td>
                    </div>
                </tr> 
                `
                <tr>
                    <th> Caste Certificate </th>
                    <td> <input type="file" id="myfile" name="uploadfile" required title="Upload Caste Certificate!"> </td>
                </tr>

                <tr>
                    <td> </td>
                    <td> <input type="submit" name="submit" value="Submit" required> <input type="reset" name="reset" value="Reset" required> </td>
                </tr>

            </table>
        </form>
    </center>

    <script>
        var todayDate = new Date();
        var month = todayDate.getMonth() + 1;
        var year = todayDate.getUTCFullYear();
        var tdate = todayDate.getDate();
        if (month < 10) {
            month = "0" + month; //'0' + 4 = 04
        }
        if (tdate < 10) {
            tdate = "0" + tdate;
        }
        var maxDate = year + "-" + month + "-" + tdate;
        document.getElementById("dob").setAttribute("max", maxDate)
        console.log(maxDate);
    </script>

</body>

</html>

<?php
    $username = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "project";
    $conn = mysqli_connect($username, $user, $pass, $dbname);
    
    if (!$conn) {
        die("Error!");
    }

    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $contect = $_POST["cno"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "certificate/".$filename;
        move_uploaded_file($tempname, $folder);

        $query = "insert into registration (name,gender,dob,cno,address,email,password,castecertificate) values ('$name','$gender','$dob',$contect,'$address','$email','$pass','$folder');";

        $q = mysqli_query($conn, $query);

        if ($q) {
            echo "Registration successful!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

?>
