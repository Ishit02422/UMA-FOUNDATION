<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate OTP</title>
    <link rel="stylesheet" href="styles1.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-image: url('test1/assets/images/meetings-bg.jpg'); /* Adjust the path as necessary */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
h2 {
    margin-bottom: 20px;
    font-size: 2em;
    color: black; /* Dark blue */
}
button.btn {
    background-color: black; /* Dark blue */
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background 0.3s;
    width: 100%;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Validate OTP</h2>
        <p style="text-align: center; margin-bottom: 20px; color: #555;">Sent to: <?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : "Session Email Not Found"; ?></p>
        <form id="user-form">
            <div class="input-box">
                <label for="otp">OTP:</label>
                <input type="text" name="otp" id="otp" required maxlength="6">
                <input type="text" name="getotp" id="getotp" required maxlength="6" hidden>
            </div>
            <button type="submit" name="btnsubmitt" class="btn">Validate OTP</button>
        </form>
        <script>
            $(document).ready(function(){
                $.ajax({
                url: './Authentication/otp.php',
                method: 'POST',
                data:{
                    'email':'<?php echo $_SESSION["email"];?>'
                },
                success: function(response) {
                    if(response.indexOf("ERROR") === -1 && response.trim() !== "")
                    {
                        document.getElementById("getotp").value=response.trim();
                    }
                    else
                    {
                        alert("OTP sending failed: " + response);
                    }
                },
                error: function(error) {
                    alert('There was an error submitting the form.');
                }
            });
                $("#user-form").on("submit",function(e){
                    e.preventDefault();
                    if(document.getElementById('getotp').value==document.getElementById('otp').value)
                    {
                        $.ajax({
                url: './Ajax_file/verifymember.php',
                method: 'POST',
                data:{
                  
                },
                success: function(response) {
                    if(response!=false)
                    {
                       alert("user verified successfully");
                       window.location='login.php';
                    }
                    else
                    {
                        alert(response);
                    }
            },
                error: function(error) {
                    alert('There was an error submitting the form.');
                }
            });
                    }
                })
            });
        </script>
    </div>
</body>
</html>
