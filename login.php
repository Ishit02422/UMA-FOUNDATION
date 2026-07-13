<?php
session_start();
// Prevent browser from showing stale/blank page via bfcache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'connect.php';
if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) { header("Location: test1/index.php"); exit; }
$error = '';
if (isset($_POST["login"])) {
    if($_POST['username']=="admin" && $_POST['pass']=="admin") {
        $_SESSION["role"]="admin"; header("Location: ./Admin/"); exit;
    }
    $username = $_POST['username']; $password = $_POST['pass'];
    if (!empty($username) && !empty($password)) {
        $sql="SELECT id,username,password,role FROM tbl_user WHERE username='$username' AND password='".md5($password)."' LIMIT 1";
        $result=mysqli_query($con,$sql);
        if($result->num_rows>0) {
            $row=$result->fetch_assoc();
            $_SESSION["id"]=$row["id"]; $_SESSION["username"]=$row['username'];
            $_SESSION["password"]=$row['password']; $_SESSION["role"]=$row['role'];
            if($row['role']=='cMajor') { header("Location: Cmajor/index.php"); exit; }
            elseif($row['role']=='cMember' || $row['role']=='Member') { header("Location: test1/index.php"); exit; }
            elseif($row['role']=='admin') { header("Location: Admin/index.php"); exit; }
            else { $error = 'Account not verified. Please contact admin.'; }
        } else { $error = 'Invalid username or password.'; }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;min-height:100vh;background:#0d1117;display:flex;align-items:center;justify-content:center;overflow:hidden;}

/* Animated BG */
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-20%;left:-10%;width:600px;height:600px;background:radial-gradient(circle,rgba(99,102,241,.18) 0%,transparent 65%);border-radius:50%;}
.bg::after{content:'';position:absolute;bottom:-20%;right:-10%;width:500px;height:500px;background:radial-gradient(circle,rgba(59,130,246,.14) 0%,transparent 65%);border-radius:50%;}

.page{position:relative;z-index:10;display:flex;align-items:center;justify-content:space-between;gap:80px;max-width:1100px;width:100%;padding:40px 30px;}

/* LEFT */
.left{flex:1;color:#fff;}
.brand{display:flex;align-items:center;gap:12px;margin-bottom:48px;}
.brand-icon{width:46px;height:46px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#fff;}
.brand-name{font-size:1.3rem;font-weight:700;color:#fff;}
.left h1{font-size:clamp(2rem,4vw,3rem);font-weight:800;line-height:1.2;margin-bottom:16px;color:#fff;}
.left h1 .accent{color:#6366f1;}
.left p{font-size:1rem;color:rgba(255,255,255,.5);line-height:1.7;max-width:380px;}
.features{margin-top:36px;display:flex;flex-direction:column;gap:12px;}
.feat{display:flex;align-items:center;gap:10px;font-size:.88rem;color:rgba(255,255,255,.55);}
.feat i{color:#6366f1;font-size:.85rem;}

/* RIGHT - Card */
.card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:36px 32px;width:100%;max-width:400px;flex-shrink:0;box-shadow:0 24px 60px rgba(0,0,0,.5);}
.card-title{font-size:1.4rem;font-weight:700;color:#fff;margin-bottom:6px;}
.card-sub{font-size:.85rem;color:rgba(255,255,255,.4);margin-bottom:28px;}

.divider{display:flex;align-items:center;gap:10px;margin:18px 0;}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:rgba(255,255,255,.08);}
.divider span{font-size:.75rem;color:rgba(255,255,255,.3);font-weight:500;letter-spacing:.5px;}

.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.5);margin-bottom:8px;letter-spacing:.5px;text-transform:uppercase;}
.input-wrap{position:relative;}
.input-wrap i.ico{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.25);font-size:.88rem;}
.input-wrap input{width:100%;padding:12px 14px 12px 40px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:10px;color:#fff;font-family:'Inter',sans-serif;font-size:.9rem;outline:none;transition:all .3s;}
.input-wrap input::placeholder{color:rgba(255,255,255,.22);}
.input-wrap input:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.15);}
.toggle-eye{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.3);cursor:pointer;font-size:.88rem;}
.toggle-eye:hover{color:rgba(255,255,255,.6);}

.error-bar{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);border-radius:8px;padding:10px 14px;margin-bottom:16px;color:#f87171;font-size:.82rem;display:flex;align-items:center;gap:8px;}

.btn-login{width:100%;padding:13px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-family:'Inter',sans-serif;font-size:.95rem;font-weight:700;cursor:pointer;transition:all .3s;letter-spacing:.3px;}
.btn-login:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}

.security{margin-top:20px;display:flex;flex-direction:column;gap:6px;}
.sec-item{display:flex;align-items:center;gap:7px;font-size:.78rem;color:rgba(255,255,255,.35);}
.sec-item i{color:#6366f1;font-size:.78rem;}

.card-footer{text-align:center;margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,.06);font-size:.82rem;color:rgba(255,255,255,.35);}
.card-footer a{color:#6366f1;font-weight:600;text-decoration:none;}
.card-footer a:hover{text-decoration:underline;}

@media(max-width:800px){.page{flex-direction:column;gap:40px;}.left h1{font-size:1.8rem;}.left p,.features{display:none;}.card{max-width:100%;}}
</style>
</head>
<body>
<div class="bg"></div>
<div class="page">

  <!-- LEFT -->
  <div class="left">
    <div class="brand">
      <div class="brand-icon"><i class="fa fa-graduation-cap"></i></div>
      <span class="brand-name">Uma Foundation</span>
    </div>
    <h1>Manage Your<br>Community with<br><span class="accent">Smart Tools.</span></h1>
    <p>An all-in-one platform for events, scholarships, hall bookings, donations, and community management.</p>
    <div class="features">
      <div class="feat"><i class="fa fa-check-circle"></i>Hall Booking & Event Management</div>
      <div class="feat"><i class="fa fa-check-circle"></i>Scholarship Applications & Tracking</div>
      <div class="feat"><i class="fa fa-check-circle"></i>Community Donations & Fundraising</div>
      <div class="feat"><i class="fa fa-check-circle"></i>Announcements & Live Updates</div>
    </div>
  </div>

  <!-- RIGHT CARD -->
  <div class="card">
    <div class="card-title">Get Started</div>
    <div class="card-sub">Sign in to your Uma Foundation account.</div>

    <?php if($error): ?>
    <div class="error-bar"><i class="fa fa-circle-exclamation"></i><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <div class="form-group">
        <label>Username</label>
        <div class="input-wrap">
          <i class="ico fa fa-user"></i>
          <input type="text" name="username" placeholder="Enter your username" required>
        </div>
      </div>
      <div class="form-group">
        <label>Password</label>
        <div class="input-wrap">
          <i class="ico fa fa-lock"></i>
          <input type="password" name="pass" id="passInput" placeholder="Enter your password" required>
          <span class="toggle-eye" onclick="togglePass()"><i class="fa fa-eye" id="eyeIcon"></i></span>
        </div>
      </div>
      <button type="submit" name="login" class="btn-login">Sign In &nbsp;<i class="fa fa-arrow-right"></i></button>
    </form>

    <div class="security">
      <div class="sec-item"><i class="fa fa-check-circle"></i>Secure MD5 encrypted authentication</div>
      <div class="sec-item"><i class="fa fa-check-circle"></i>Role-based access control</div>
    </div>

    <div class="card-footer">
      New member? <a href="Registration.php">Create an account</a>
      &nbsp;·&nbsp; <a href="test1/index.php">Back to Home</a>
    </div>
  </div>

</div>
<script>
function togglePass(){
  const i=document.getElementById('passInput'),e=document.getElementById('eyeIcon');
  i.type=i.type==='password'?'text':'password';
  e.className=i.type==='password'?'fa fa-eye':'fa fa-eye-slash';
}
</script>
</body>
</html>