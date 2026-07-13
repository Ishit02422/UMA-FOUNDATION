<?php
session_start();
include '../connect.php';

if(!isset($_SESSION['role'])){
    echo "<script>alert('Please login first.');window.location='../login.php';</script>"; exit;
}
if($_SESSION['role']=='cMajor'){
    echo "<script>alert('Committee Major cannot make further requests.');window.location='index.php';</script>"; exit;
}
if($_SESSION['role']!='Member' && $_SESSION['role']!='cMember'){
    echo "<script>alert('Unauthorised Page.');window.location='index.php';</script>"; exit;
}

$role    = $_SESSION['role'];
$user_id = $_SESSION['id'];

// Fetch user info
$uq = mysqli_query($con,"SELECT * FROM tbl_user WHERE id='$user_id' LIMIT 1");
$user = $uq ? $uq->fetch_assoc() : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Apply Request - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;}
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(99,102,241,.13) 0%,transparent 65%);border-radius:50%;}

/* NAV */
.nav{position:fixed;top:0;width:100%;z-index:999;background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.logo{font-size:1.1rem;font-weight:800;color:#fff;text-decoration:none;display:flex;align-items:center;gap:9px;}
.logo-icon{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;}
.nav-links{display:flex;gap:4px;list-style:none;align-items:center;}
.nav-links a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.86rem;font-weight:500;padding:6px 12px;border-radius:8px;transition:all .2s;}
.nav-links a:hover,.nav-links a.active{color:#fff;background:rgba(255,255,255,.07);}
.nav-btn{background:linear-gradient(135deg,#6366f1,#8b5cf6)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important;}

/* PAGE */
.page{position:relative;z-index:10;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:90px 20px 60px;}
.wrapper{width:100%;max-width:560px;}

/* ROLE BADGE */
.role-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.25);color:#a5b4fc;padding:6px 16px;border-radius:30px;font-size:.78rem;font-weight:600;margin-bottom:28px;}

/* CARD */
.card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:20px;overflow:hidden;box-shadow:0 24px 60px rgba(0,0,0,.5);}
.card-top{background:linear-gradient(135deg,rgba(99,102,241,.12),rgba(139,92,246,.06));border-bottom:1px solid rgba(255,255,255,.06);padding:28px 32px;}
.card-top h2{font-size:1.15rem;font-weight:700;color:#fff;margin-bottom:5px;}
.card-top p{font-size:.82rem;color:rgba(255,255,255,.4);}
.card-body{padding:32px;}

/* WHAT YOU GET */
.apply-for{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:28px;}
<?php if($role=='cMember'): ?>
.apply-for{grid-template-columns:1fr;}
<?php endif; ?>
.role-option{background:rgba(99,102,241,.06);border:2px solid rgba(99,102,241,.15);border-radius:12px;padding:18px;cursor:pointer;transition:all .3s;position:relative;}
.role-option:hover,.role-option.selected{border-color:#6366f1;background:rgba(99,102,241,.1);}
.role-option .role-icon{width:44px;height:44px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#fff;margin-bottom:12px;}
.role-option h4{font-size:.92rem;font-weight:700;color:#fff;margin-bottom:4px;}
.role-option p{font-size:.77rem;color:rgba(255,255,255,.45);line-height:1.5;}
.role-option .check{position:absolute;top:12px;right:12px;width:20px;height:20px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:none;align-items:center;justify-content:center;font-size:.7rem;color:#fff;}
.role-option.selected .check{display:flex;}

/* FORM */
.divider{height:1px;background:rgba(255,255,255,.06);margin:24px 0;}
.form-group{margin-bottom:18px;}
.form-group label{display:block;font-size:.72rem;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:8px;letter-spacing:.6px;text-transform:uppercase;}
.form-inp{width:100%;padding:12px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:10px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.88rem;outline:none;transition:all .3s;}
.form-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.1);}
.form-inp::placeholder{color:rgba(255,255,255,.2);}
textarea.form-inp{resize:vertical;min-height:100px;line-height:1.6;}

.info-box{background:rgba(99,102,241,.06);border:1px solid rgba(99,102,241,.15);border-radius:10px;padding:14px 16px;margin-bottom:22px;display:flex;gap:10px;align-items:flex-start;}
.info-box i{color:#a5b4fc;margin-top:2px;}
.info-box p{font-size:.8rem;color:rgba(255,255,255,.5);line-height:1.6;}

.btn-submit{width:100%;padding:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-size:.95rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:9px;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}
.btn-submit:disabled{opacity:.6;transform:none;cursor:not-allowed;}

/* SUCCESS */
.success-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
.success-overlay.show{display:flex;}
.success-box{background:#161b27;border:1px solid rgba(99,102,241,.2);border-radius:20px;padding:40px;text-align:center;max-width:380px;width:90%;}
.success-icon{width:65px;height:65px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.7rem;color:#fff;margin:0 auto 18px;}
.success-box h3{font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:8px;}
.success-box p{font-size:.84rem;color:rgba(255,255,255,.45);margin-bottom:20px;}
.btn-home{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;padding:11px 24px;border-radius:9px;font-weight:700;text-decoration:none;font-size:.88rem;}

@media(max-width:640px){.apply-for{grid-template-columns:1fr;}.nav{padding:0 16px;}.nav-links{display:none;}.card-body{padding:20px;}.card-top{padding:22px 20px;}}
</style>
</head>
<body>
<div class="bg"></div>
<nav class="nav">
  <a href="index.php" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="hallbooking.php">Hall Booking</a></li>
    <li><a href="donationform.php">Donation</a></li>
    <li><a href="announcement.php">Events</a></li>
    <li><a href="../logout.php" class="nav-btn">Logout</a></li>
  </ul>
</nav>

<div class="page">
  <div class="wrapper">
    <div class="role-badge">
      <i class="fa fa-user-shield"></i>
      Logged in as: <strong><?php echo $_SESSION['role'];?></strong>
    </div>

    <div class="card">
      <div class="card-top">
        <h2><i class="fa fa-paper-plane" style="color:#6366f1;margin-right:8px"></i>Committee Role Request</h2>
        <p>Apply to become a Committee Member or Committee Major of Uma Foundation.</p>
      </div>
      <div class="card-body">

        <!-- ROLE SELECTION -->
        <div class="apply-for" id="roleOptions">
          <?php if($role=='Member'): ?>
          <div class="role-option selected" id="opt_cMember" onclick="selectRole('cMember')">
            <div class="check"><i class="fa fa-check"></i></div>
            <div class="role-icon"><i class="fa fa-users"></i></div>
            <h4>Committee Member</h4>
            <p>Help manage events, assist in community activities and support foundation work.</p>
          </div>
          <div class="role-option" id="opt_cMajor" onclick="selectRole('cMajor')">
            <div class="check"><i class="fa fa-check"></i></div>
            <div class="role-icon"><i class="fa fa-user-tie"></i></div>
            <h4>Committee Major</h4>
            <p>Lead the committee, approve member requests and oversee foundation operations.</p>
          </div>
          <?php elseif($role=='cMember'): ?>
          <div class="role-option selected" id="opt_cMajor" onclick="selectRole('cMajor')">
            <div class="check"><i class="fa fa-check"></i></div>
            <div class="role-icon"><i class="fa fa-user-tie"></i></div>
            <h4>Upgrade to Committee Major</h4>
            <p>As an existing committee member, apply to become a Committee Major and lead the team.</p>
          </div>
          <?php endif; ?>
        </div>

        <input type="hidden" id="selectedRole" value="<?php echo $role=='cMember'?'cMajor':'cMember';?>">

        <div class="divider"></div>

        <div class="info-box">
          <i class="fa fa-circle-info"></i>
          <p>Your request will be reviewed by the admin. You will be notified once your request is approved or rejected. Please provide a valid reason for your application.</p>
        </div>

        <form id="requestForm">
          <input type="hidden" name="request" id="requestInput" value="<?php echo $role=='cMember'?'cMajor':'cMember';?>">
          <div class="form-group">
            <label>Your Name</label>
            <input class="form-inp" type="text" value="<?php echo htmlspecialchars($user['name']??'');?>" disabled>
          </div>
          <div class="form-group">
            <label>Reason for Applying</label>
            <textarea class="form-inp" name="reason" id="reason" placeholder="Briefly explain why you want to join the committee..." required></textarea>
          </div>
          <button type="submit" class="btn-submit" id="submitBtn">
            <i class="fa fa-paper-plane"></i> Submit Request
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- SUCCESS MODAL -->
<div class="success-overlay" id="successOverlay">
  <div class="success-box">
    <div class="success-icon"><i class="fa fa-check"></i></div>
    <h3>Request Submitted!</h3>
    <p>Your committee role request has been submitted. The admin will review and get back to you soon.</p>
    <a href="index.php" class="btn-home"><i class="fa fa-home"></i> Go to Home</a>
  </div>
</div>

<script>
function selectRole(role){
  document.querySelectorAll('.role-option').forEach(el=>el.classList.remove('selected'));
  const el=document.getElementById('opt_'+role);
  if(el) el.classList.add('selected');
  document.getElementById('selectedRole').value=role;
  document.getElementById('requestInput').value=role;
}

document.getElementById('requestForm').addEventListener('submit',function(e){
  e.preventDefault();
  const reason=document.getElementById('reason').value.trim();
  if(!reason){alert('Please enter a reason for applying.');return;}
  const btn=document.getElementById('submitBtn');
  btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> Submitting...';
  const fd=new FormData(this);
  $.ajax({
    url:'../Ajax_file/request.php',
    type:'POST',
    data:fd,
    processData:false,
    contentType:false,
    success:function(res){
      // Backend returns 'Request submitted successfully.' on success
      if(res && res.toLowerCase().indexOf('error')===-1){
        document.getElementById('successOverlay').classList.add('show');
      } else {
        alert(res||'Something went wrong. Please try again.');
        btn.disabled=false;
        btn.innerHTML='<i class="fa fa-paper-plane"></i> Submit Request';
      }
    },
    error:function(){
      alert('Network error. Please try again.');
      btn.disabled=false;
      btn.innerHTML='<i class="fa fa-paper-plane"></i> Submit Request';
    }
  });
});
</script>
</body>
</html>