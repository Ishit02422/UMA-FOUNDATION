<?php
    session_start();
        include 'connect.php';
        include 'change-password-db.php';

    if(empty($_SESSION['username']) & empty($_SESSION['password'])){
    //    header("Location:login.php");
}

?>
<!DocTYPE HTML>
<html>
    <head>
        <title> Change Password </title>
        <link rel="stylesheet" href="style2.css"> 
        <style>
            /* Fullscreen background styling */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #2C2F33;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Form container styling */
form {
    background-color: #F0F0F0;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    width: 350px;
    text-align: center;
}

/* Heading styling */
h1 {
    color: black;
    margin-bottom: 20px;
    text-align: center;
}

/* Table styling */
table {
    width: 100%;
}

/* Table cells */
td {
    padding: 10px;
    font-size: 14px;
}

/* Input field styling */
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Submit button styling */
input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #000000;
    color: #FFFFFF;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

/* Button hover effect */
input[type="submit"]:hover {
    background-color: #333333;
}

/* Message display styling */
.message {
    color: red;
    text-align: center;
    margin-bottom: 15px;
}

        </style>       

    </head>
    <body>
       

        <form method="post">
        <h1 align="center"> Change Password </h1>
            <table align="center">
                <?php
                    if(isset($_SESSION["msg"])){ 
                ?>
                <tr> 
                    <td colspan="2" align="center"> <?php echo $_SESSION["msg"]; ?> </td>
                </tr>
                <?php
                    unset($_SESSION["msg"]);
                    } 
                ?>

                <tr>
                    <td> New Password </td>
                    <td>
                        <input type="password" name="newpassword">
                    </td>
                </tr>

                <tr>
                    <td> Confirm Password </td>
                    <td>
                        <input type="password" name="confirmpassword">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="change" value="Change Password">
                    </td>
                </tr>

            </table>
        </form>
    </body>
</html>