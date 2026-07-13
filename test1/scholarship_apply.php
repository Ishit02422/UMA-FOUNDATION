<?php
session_start();
include '../connect.php';

if(!isset($_SESSION['id'])){
    echo "<script>alert('Please login first.');window.location='../login.php';</script>"; exit;
}
if(!isset($_GET['id'])){
    header('Location:scholarship.php'); exit;
}

$sch_id  = (int)$_GET['id'];
$user_id = $_SESSION['id'];

// Fetch scholarship details
$sq = mysqli_query($con,"SELECT * FROM tbl_announcement WHERE id='$sch_id' LIMIT 1");
if(!$sq || mysqli_num_rows($sq)==0){ header('Location:scholarship.php'); exit; }
$sch = $sq->fetch_assoc();

// Fetch user info
$uq = mysqli_query($con,"SELECT * FROM tbl_user WHERE id='$user_id' LIMIT 1");
$user = $uq ? $uq->fetch_assoc() : [];

// Handle form submit
$msg = ''; $msgType = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $fname      = mysqli_real_escape_string($con,$_POST['fname']??'');
    $email      = mysqli_real_escape_string($con,$_POST['email']??'');
    $phone      = mysqli_real_escape_string($con,$_POST['phone']??'');
    $dob        = mysqli_real_escape_string($con,$_POST['dob']??'');
    $school     = mysqli_real_escape_string($con,$_POST['school']??'');
    $percentage = floatval($_POST['percentage']??0);
    $income     = floatval($_POST['income']??0);
    $reason     = mysqli_real_escape_string($con,$_POST['reason']??'');
    $date       = date('Y-m-d');

    // Handle file upload
    $doc_path = '';
    if(isset($_FILES['document']) && $_FILES['document']['error']==0){
        $ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
        $fname_file = 'scholarship_'.time().'.'.$ext;
        $upload_dir = '../scholarship_docs/';
        if(!is_dir($upload_dir)) {
            @mkdir($upload_dir, 0777, true);
        } else {
            @chmod($upload_dir, 0777); // Attempt to fix permission issue on Render
        }
        if(@move_uploaded_file($_FILES['document']['tmp_name'], $upload_dir.$fname_file)) {
            $doc_path = 'scholarship_docs/'.$fname_file;
        }
    }

    // Actual columns: uid, aid, adhar_card_image, status, school_unviersity_name,
    // previous_year_marksheet, current_year_std, father_income, mother_income,
    // pan_card_no_father, pan_card_no_mother, occupation_father, occupation_mother,
    // bank_name, bank_ifsc_code, account_no, income_certificate, fees_receipt
    $adhar = $doc_path; // using doc upload as adhar_card_image
    $sql = "INSERT INTO tbl_scholarship 
            (uid, aid, adhar_card_image, status, school_unviersity_name, 
             previous_year_marksheet, current_year_std, 
             father_income, mother_income,
             pan_card_no_father, pan_card_no_mother,
             occupation_father, occupation_mother,
             bank_name, bank_ifsc_code, account_no,
             income_certificate, fees_receipt)
            VALUES 
            ('$user_id','$sch_id','$adhar','0','$school',
             '$percentage','N/A',
             '$income','0',
             '','',
             '','',
             '','',0,
             '','$doc_path')";
    if(mysqli_query($con,$sql)){
        $msg = 'success';
    } else {
        $msgType='error'; $msg='Application could not be saved: '.mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Apply for Scholarship - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;}
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(99,102,241,.13) 0%,transparent 65%);border-radius:50%;}

.nav{position:fixed;top:0;width:100%;z-index:999;background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.logo{font-size:1.1rem;font-weight:800;color:#fff;text-decoration:none;display:flex;align-items:center;gap:9px;}
.logo-icon{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;}
.nav-links{display:flex;gap:4px;list-style:none;align-items:center;}
.nav-links a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.86rem;font-weight:500;padding:6px 12px;border-radius:8px;transition:all .2s;}
.nav-links a:hover{color:#fff;background:rgba(255,255,255,.07);}
.nav-btn{background:linear-gradient(135deg,#6366f1,#8b5cf6)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important;}

.page{position:relative;z-index:10;padding:90px 20px 60px;max-width:640px;margin:0 auto;}
.back-link{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.4);font-size:.84rem;text-decoration:none;margin-bottom:20px;transition:color .2s;}
.back-link:hover{color:#a5b4fc;}

/* SCH INFO */
.sch-info{background:linear-gradient(135deg,rgba(99,102,241,.1),rgba(139,92,246,.05));border:1px solid rgba(99,102,241,.2);border-radius:14px;padding:20px 24px;margin-bottom:24px;}
.sch-info h2{font-size:1.05rem;font-weight:700;color:#fff;margin-bottom:8px;}
.sch-meta{display:flex;gap:16px;flex-wrap:wrap;}
.sch-meta span{font-size:.78rem;color:rgba(255,255,255,.45);display:flex;align-items:center;gap:5px;}
.sch-meta i{color:#6366f1;}

/* FORM CARD */
.card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:18px;overflow:hidden;box-shadow:0 20px 50px rgba(0,0,0,.4);}
.card-top{padding:24px 28px;border-bottom:1px solid rgba(255,255,255,.06);}
.card-top h3{font-size:1rem;font-weight:700;color:#fff;}
.card-top p{font-size:.8rem;color:rgba(255,255,255,.4);margin-top:4px;}
.card-body{padding:28px;}

.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.form-full{grid-column:1/-1;}
.form-group{display:flex;flex-direction:column;}
.form-group label{font-size:.72rem;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:8px;letter-spacing:.6px;text-transform:uppercase;}
.form-inp{padding:11px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.88rem;outline:none;transition:all .3s;}
.form-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.1);}
.form-inp::placeholder{color:rgba(255,255,255,.2);}
textarea.form-inp{resize:vertical;min-height:90px;line-height:1.6;}
.form-inp[type="file"]{padding:8px;}
.form-inp[type="file"]::-webkit-file-upload-button{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;padding:6px 14px;border-radius:6px;font-family:'Inter',sans-serif;font-size:.8rem;cursor:pointer;margin-right:10px;}

.divider{height:1px;background:rgba(255,255,255,.06);margin:22px 0;}
.btn-submit{width:100%;padding:13px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-size:.95rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:9px;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}

/* Success */
.success-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
.success-overlay.show{display:flex;}
.success-box{background:#161b27;border:1px solid rgba(99,102,241,.2);border-radius:20px;padding:40px;text-align:center;max-width:380px;width:90%;}
.sicon{width:70px;height:70px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:#fff;margin:0 auto 18px;}
.success-box h3{font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:8px;}
.success-box p{font-size:.83rem;color:rgba(255,255,255,.45);margin-bottom:20px;}
.btn-home{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;padding:11px 24px;border-radius:9px;font-weight:700;text-decoration:none;font-size:.88rem;}

.err-msg{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#f87171;border-radius:9px;padding:12px 16px;margin-bottom:18px;font-size:.83rem;}

@media(max-width:580px){.form-grid{grid-template-columns:1fr;}.nav{padding:0 16px;}.nav-links{display:none;}}
</style>
</head>
<body>
<div class="bg"></div>
<nav class="nav">
  <a href="index.php" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="scholarship.php" >Scholarship</a></li>
    <li><a href="../logout.php" class="nav-btn">Logout</a></li>
  </ul>
</nav>

<div class="page">
  <a href="scholarship.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Scholarships</a>

  <!-- Scholarship Info -->
  <div class="sch-info">
    <h2><i class="fa fa-graduation-cap" style="color:#6366f1;margin-right:8px"></i><?php echo htmlspecialchars($sch['title']);?></h2>
    <div class="sch-meta">
      <span><i class="fa fa-calendar-check"></i>Apply By: <?php echo date('d M Y',strtotime($sch['last_date']??$sch['declaration_date']));?></span>
      <span><i class="fa fa-circle-info"></i><?php echo htmlspecialchars(substr($sch['description'],0,80)).'...';?></span>
    </div>
  </div>

  <div class="card">
    <div class="card-top">
      <h3><i class="fa fa-file-pen" style="color:#6366f1;margin-right:8px"></i>Scholarship Application Form</h3>
      <p>Fill all fields carefully. Incomplete applications may be rejected.</p>
    </div>
    <div class="card-body">
      <?php if($msgType=='error'): ?>
        <div class="err-msg"><i class="fa fa-circle-exclamation"></i> <?php echo $msg;?></div>
      <?php endif; ?>

      <form id="applyForm" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
          <div class="form-group">
            <label>Full Name</label>
            <input class="form-inp" type="text" name="fname" value="<?php echo htmlspecialchars($user['name']??'');?>" placeholder="Your full name" required>
          </div>
          <div class="form-group">
            <label>Date of Birth</label>
            <input class="form-inp" type="date" name="dob" value="<?php echo $user['dob']??'';?>" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-inp" type="email" name="email" value="<?php echo htmlspecialchars($user['email']??'');?>" placeholder="your@email.com" required>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input class="form-inp" type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']??'');?>" placeholder="10-digit mobile" required>
          </div>
          <div class="form-group form-full">
            <label>School / College / Institution</label>
            <input class="form-inp" type="text" name="school" placeholder="Name of your institution" required>
          </div>
          <div class="form-group">
            <label>Last Exam % / CGPA</label>
            <input class="form-inp" type="number" name="percentage" placeholder="e.g. 85.5" step="0.01" min="0" max="100" required>
          </div>
          <div class="form-group">
            <label>Annual Family Income (₹)</label>
            <input class="form-inp" type="number" name="income" placeholder="e.g. 200000" required>
          </div>
          <div class="form-group form-full">
            <label>Why do you deserve this scholarship?</label>
            <textarea class="form-inp" name="reason" placeholder="Briefly explain your need and achievements..." required></textarea>
          </div>
          <div class="form-group form-full">
            <label>Supporting Document (PDF/Image)</label>
            <input class="form-inp" type="file" name="document" accept=".pdf,.jpg,.jpeg,.png">
          </div>
        </div>
        <div class="divider"></div>
        <button type="submit" class="btn-submit"><i class="fa fa-paper-plane"></i> Submit Application</button>
      </form>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="success-overlay <?php echo $msg=='success'?'show':'';?>" id="successOverlay">
  <div class="success-box">
    <div class="sicon"><i class="fa fa-check"></i></div>
    <h3>Application Submitted!</h3>
    <p>Your scholarship application has been submitted successfully. Our team will review and contact you soon.</p>
    <a href="scholarship.php" class="btn-home"><i class="fa fa-arrow-left"></i> Back to Scholarships</a>
  </div>
</div>
</body>
</html>
