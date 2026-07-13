<?php
    include "connect.php";

   // if(empty($_SESSION['username']) & empty($_SESSION['password'])){
        //header("Location:login.php");
   // }

    if (isset($_POST["change"])) {
        $newpassword = $_POST["newpassword"];
        $confirmpassword = $_POST["confirmpassword"];

        if ($newpassword == $confirmpassword) {
            $id = $_SESSION['uid'];

            $query = "select * from tbl_user where uid=$id and password = '$oldpassword'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $query = "update tbl_user set password = '$newpassword' where uid = $id";

                if (mysqli_query($con, $query)) {
                    $_SESSION["msg"] = "Password changed successfully";
                    header("location: changepassword.php");
                    exit();
                } else {
                    $_SESSION["msg"] = "Error";
                    header("location: changepassword.php");
                    exit();
                }
            } else {
                $_SESSION["msg"] = "Password does not match.";
                header("location: changepassword.php");
                exit();
            }
            } else {
                $_SESSION["msg"] = "Password and new password not match";
                header("location: changepassword.php");
                exit();
        }
    }
?>