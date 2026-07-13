<?php
session_start();
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    echo "<script>alert('Session expired. Please use Forgot Password first.');window.location='../login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Change Password - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;display:flex;align-items:center;justify-content:center;}
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(99,102,241,.13) 0%,transparent 65%);border-radius:50%;}
.bg::after{content:'';position:absolute;bottom:-80px;left:-80px;width:350px;height:350px;background:radial-gradient(circle,rgba(139,92,246,.08) 0%,transparent 65%);border-radius:50%;}

.wrapper{position:relative;z-index:10;width:100%;max-width:440px;padding:20px;}
.card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:38px;box-shadow:0 24px 60px rgba(0,0,0,.5);}
.logo-wrap{display:flex;align-items:center;gap:10px;margin-bottom:28px;}
.logo-icon{width:36px;height:36px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:.9rem;color:#fff;}
.logo-wrap span{font-size:1rem;font-weight:800;color:#fff;}
.card h2{font-size:1.2rem;font-weight:700;color:#fff;margin-bottom:6px;}
.card p{font-size:.82rem;color:rgba(255,255,255,.4);margin-bottom:28px;}

.form-group{margin-bottom:18px;position:relative;}
.form-group label{display:block;font-size:.72rem;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:8px;letter-spacing:.6px;text-transform:uppercase;}
.inp-wrap{position:relative;}
.form-inp{width:100%;padding:12px 42px 12px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:10px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.88rem;outline:none;transition:all .3s;}
.form-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.1);}
.form-inp::placeholder{color:rgba(255,255,255,.2);}
.eye-btn{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,.35);cursor:pointer;font-size:.9rem;transition:color .2s;padding:0;}
.eye-btn:hover{color:#a5b4fc;}

.strength-bar{height:4px;background:rgba(255,255,255,.06);border-radius:2px;margin-top:8px;overflow:hidden;}
.strength-fill{height:100%;border-radius:2px;width:0%;transition:all .4s;}
.strength-label{font-size:.72rem;color:rgba(255,255,255,.35);margin-top:5px;}

.match-msg{font-size:.75rem;margin-top:6px;display:none;}
.match-ok{color:#34d399;} .match-err{color:#f87171;}

.btn-submit{width:100%;padding:13px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-size:.95rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:9px;margin-top:4px;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}
.btn-submit:disabled{opacity:.6;transform:none;cursor:not-allowed;}

.success-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
.success-overlay.show{display:flex;}
.success-box{background:#161b27;border:1px solid rgba(99,102,241,.2);border-radius:20px;padding:40px;text-align:center;max-width:360px;width:90%;}
.sicon{width:65px;height:65px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.7rem;color:#fff;margin:0 auto 18px;}
.success-box h3{font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:8px;}
.success-box p{font-size:.84rem;color:rgba(255,255,255,.45);margin-bottom:20px;}
.btn-login{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;padding:11px 24px;border-radius:9px;font-weight:700;text-decoration:none;font-size:.88rem;}
</style>
</head>
<body>
<div class="bg"></div>
<div class="wrapper">
  <div class="card">
    <div class="logo-wrap">
      <div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>
      <span>Uma Foundation</span>
    </div>
    <h2>Set New Password</h2>
    <p>Create a strong new password for your account.</p>

    <form id="newpasswordform">
      <div class="form-group">
        <label>New Password</label>
        <div class="inp-wrap">
          <input class="form-inp" type="password" id="password" name="password" placeholder="Min 8 chars, uppercase, number, symbol">
          <button type="button" class="eye-btn" onclick="togglePwd('password','eyeA')"><i class="fa fa-eye" id="eyeA"></i></button>
        </div>
        <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
        <div class="strength-label" id="strengthLabel">Password strength</div>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <div class="inp-wrap">
          <input class="form-inp" type="password" id="newpassword" name="newpassword" placeholder="Re-enter your password">
          <button type="button" class="eye-btn" onclick="togglePwd('newpassword','eyeB')"><i class="fa fa-eye" id="eyeB"></i></button>
        </div>
        <div class="match-msg" id="matchMsg"></div>
      </div>
      <button type="submit" class="btn-submit" id="submitBtn"><i class="fa fa-lock"></i> Change Password</button>
    </form>
  </div>
</div>

<div class="success-overlay" id="successOverlay">
  <div class="success-box">
    <div class="sicon"><i class="fa fa-check"></i></div>
    <h3>Password Changed!</h3>
    <p>Your password has been updated successfully. Please login with your new password.</p>
    <a href="../login.php" class="btn-login"><i class="fa fa-right-to-bracket"></i> Go to Login</a>
  </div>
</div>

<script>
function togglePwd(id,eyeId){
  const inp=document.getElementById(id);
  const eye=document.getElementById(eyeId);
  if(inp.type==='password'){inp.type='text';eye.className='fa fa-eye-slash';}
  else{inp.type='password';eye.className='fa fa-eye';}
}

document.getElementById('password').addEventListener('input',function(){
  const v=this.value;
  let s=0,lbl='',color='';
  if(v.length>=8)s++;
  if(/[A-Z]/.test(v))s++;
  if(/\d/.test(v))s++;
  if(/[@$!%*?&]/.test(v))s++;
  const pct=[0,25,50,75,100][s];
  const colors=['','#ef4444','#f59e0b','#3b82f6','#10b981'];
  const labels=['','Weak','Fair','Good','Strong'];
  document.getElementById('strengthFill').style.width=pct+'%';
  document.getElementById('strengthFill').style.background=colors[s]||'';
  document.getElementById('strengthLabel').textContent=s?labels[s]:'Password strength';
  checkMatch();
});

document.getElementById('newpassword').addEventListener('input',checkMatch);

function checkMatch(){
  const p=document.getElementById('password').value;
  const n=document.getElementById('newpassword').value;
  const m=document.getElementById('matchMsg');
  if(!n){m.style.display='none';return;}
  m.style.display='block';
  if(p===n){m.textContent='✓ Passwords match';m.className='match-msg match-ok';}
  else{m.textContent='✗ Passwords do not match';m.className='match-msg match-err';}
}

document.getElementById('newpasswordform').addEventListener('submit',function(e){
  e.preventDefault();
  const p=document.getElementById('password').value;
  const n=document.getElementById('newpassword').value;
  if(p!==n){alert('Passwords do not match!');return;}
  if(p.length<8){alert('Password must be at least 8 characters.');return;}
  const btn=document.getElementById('submitBtn');
  btn.disabled=true;btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> Updating...';
  $.ajax({
    url:'../Ajax_file/changepassword.php',
    method:'POST',
    data:{email:'<?php echo isset($_SESSION["email"])?$_SESSION["email"]:"";?>',password:p},
    success:function(res){
      if(res==true||res=='true'||res.trim()=='1'||res.trim()=='true'){
        document.getElementById('successOverlay').classList.add('show');
      } else {
        alert('Error: '+res);
        btn.disabled=false;btn.innerHTML='<i class="fa fa-lock"></i> Change Password';
      }
    }
  });
});
</script>
</body>
</html>