<?php
session_start();
// Prevent browser from showing stale/blank page via bfcache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if(!empty($_SESSION['username']) && !empty($_SESSION['password'])){ header('Location:login.php'); exit; }
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Register - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;}

.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-120px;right:-100px;width:550px;height:550px;background:radial-gradient(circle,rgba(99,102,241,.14) 0%,transparent 65%);border-radius:50%;}
.bg::after{content:'';position:absolute;bottom:-100px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(139,92,246,.09) 0%,transparent 65%);border-radius:50%;}

.page-wrap{position:relative;z-index:10;min-height:100vh;display:flex;align-items:flex-start;justify-content:center;padding:48px 20px;}
.reg-container{width:100%;max-width:700px;}

/* Brand */
.brand{text-align:center;margin-bottom:28px;}
.brand-row{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:10px;}
.brand-icon{width:40px;height:40px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;color:#fff;}
.brand h1{font-size:1.3rem;font-weight:800;color:#fff;}
.brand p{font-size:.83rem;color:rgba(255,255,255,.4);}

/* Card */
.card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:44px 38px;box-shadow:0 24px 60px rgba(0,0,0,.5);}
.card-title{font-size:1.3rem;font-weight:700;color:#fff;margin-bottom:6px;}
.card-sub{font-size:.85rem;color:rgba(255,255,255,.4);margin-bottom:32px;}

/* Section divider */
.sec-div{display:flex;align-items:center;gap:12px;margin:30px 0 22px;}
.sec-div span{font-size:.75rem;color:#a5b4fc;font-weight:700;letter-spacing:.8px;white-space:nowrap;display:flex;align-items:center;gap:6px;}
.sec-div::before,.sec-div::after{content:'';flex:1;height:1px;background:rgba(255,255,255,.06);}

/* Form rows */
.form-row{display:grid;grid-template-columns:1fr;gap:20px;margin-bottom:20px;}
.form-row.single{grid-template-columns:1fr;}
.form-row.triple{grid-template-columns:1fr;}
.form-group{display:flex;flex-direction:column;margin-bottom:6px;}
.form-group label{font-size:.72rem;font-weight:700;color:rgba(255,255,255,.45);margin-bottom:9px;letter-spacing:.6px;text-transform:uppercase;}
.input-wrap{position:relative;}
.input-wrap i.ico{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.2);font-size:.85rem;pointer-events:none;}
.input-wrap input,
.input-wrap select,
.input-wrap textarea{
  width:100%;padding:13px 14px 13px 42px;
  background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.08);
  border-radius:10px;color:#e6edf3;
  font-family:'Inter',sans-serif;font-size:.9rem;
  transition:all .3s;outline:none;line-height:1.5;
}
.input-wrap input::placeholder,.input-wrap textarea::placeholder{color:rgba(255,255,255,.2);}
.input-wrap input:focus,.input-wrap select:focus,.input-wrap textarea:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.13);}
.input-wrap select{padding:11px 13px 11px 38px;-webkit-appearance:none;}
.input-wrap select option{background:#161b27;color:#e6edf3;}
.input-wrap textarea{min-height:80px;resize:vertical;padding-top:11px;}

/* File upload */
.file-zone{border:1px dashed rgba(99,102,241,.3);border-radius:10px;padding:20px;text-align:center;cursor:pointer;transition:all .3s;background:rgba(99,102,241,.04);}
.file-zone:hover{border-color:#6366f1;background:rgba(99,102,241,.08);}
.file-zone i{font-size:1.6rem;color:rgba(99,102,241,.6);margin-bottom:7px;display:block;}
.file-zone p{font-size:.8rem;color:rgba(255,255,255,.4);}
.file-zone span{color:#a5b4fc;font-weight:600;}
.file-zone input[type=file]{display:none;}

/* Errors */
.field-error{font-size:.73rem;color:#f87171;margin-top:5px;display:none;}
.field-error.show{display:block;}
.alert-box{display:none;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);border-radius:10px;padding:11px 14px;margin-bottom:18px;font-size:.83rem;color:#f87171;align-items:center;gap:9px;}
.alert-box.show{display:flex;}

/* Autocomplete */
.autocomplete-suggestions{position:absolute;top:100%;left:0;right:0;z-index:999;background:#1c2333;border:1px solid rgba(99,102,241,.2);border-radius:10px;overflow:hidden;max-height:190px;overflow-y:auto;margin-top:3px;}
.autocomplete-suggestion{padding:9px 13px;cursor:pointer;font-size:.82rem;color:rgba(255,255,255,.7);transition:background .2s;}
.autocomplete-suggestion:hover{background:rgba(99,102,241,.12);color:#a5b4fc;}

/* Buttons */
.btn-row{display:flex;gap:10px;margin-top:22px;}
.btn-submit{flex:2;padding:13px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-size:.92rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:8px;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}
.btn-submit:disabled{opacity:.6;transform:none;cursor:not-allowed;}
.btn-reset{flex:1;padding:13px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.5);border-radius:10px;font-size:.88rem;font-weight:500;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;}
.btn-reset:hover{border-color:rgba(239,68,68,.4);color:#f87171;}

.login-link{text-align:center;margin-top:20px;font-size:.83rem;color:rgba(255,255,255,.4);}
.login-link a{color:#a5b4fc;font-weight:600;text-decoration:none;}
.login-link a:hover{color:#fff;}

@media(max-width:600px){.form-row,.form-row.triple{grid-template-columns:1fr;}.card{padding:24px 18px;}}
</style>
</head>
<body>
<div class="bg"></div>
<div class="page-wrap">
  <div class="reg-container">

    <div class="brand">
      <div class="brand-row">
        <div class="brand-icon"><i class="fa fa-graduation-cap"></i></div>
        <h1>Uma Foundation</h1>
      </div>
      <p>Create your community member account</p>
    </div>

    <div class="card">
      <div class="card-title">Create Account</div>
      <div class="card-sub">Join Uma Foundation — it's free</div>

      <div class="alert-box" id="alertBox"><i class="fa fa-circle-exclamation"></i><span id="alertMsg"></span></div>

      <form class="GG" method="post" enctype="multipart/form-data" novalidate>

        <div class="sec-div"><span><i class="fa fa-user"></i> Personal Info</span></div>
        <div class="form-row">
          <div class="form-group">
            <label>Full Name</label>
            <div class="input-wrap">
              <i class="ico fa fa-user"></i>
              <input name="name" type="text" id="name" placeholder="First Middle Last" required>
            </div>
            <div class="field-error" id="name-error"></div>
          </div>
          <div class="form-group">
            <label>Username</label>
            <div class="input-wrap">
              <i class="ico fa fa-at"></i>
              <input name="uname" type="text" id="uname" placeholder="Choose a username" required>
            </div>
            <div class="field-error" id="uname-error"></div>
          </div>
        </div>

        <div class="form-row triple">
          <div class="form-group">
            <label>Gender</label>
            <div class="input-wrap">
              <i class="ico fa fa-venus-mars"></i>
              <select name="gender" id="gender">
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Date of Birth</label>
            <div class="input-wrap">
              <i class="ico fa fa-calendar"></i>
              <input type="date" id="dob" name="dob" required>
            </div>
            <div class="field-error" id="dob-error"></div>
          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <div class="input-wrap">
              <i class="ico fa fa-phone"></i>
              <input type="tel" id="cno" name="cno" maxlength="10" placeholder="10-digit mobile" required>
            </div>
            <div class="field-error" id="phone-error"></div>
          </div>
        </div>

        <div class="sec-div"><span><i class="fa fa-location-dot"></i> Location</span></div>
        <div class="form-row">
          <div class="form-group">
            <label>Address</label>
            <div class="input-wrap" style="position:relative;">
              <i class="ico fa fa-map-marker-alt" style="top:14px;transform:none;"></i>
              <textarea id="address" name="address" placeholder="Start typing your address..." required></textarea>
              <div id="suggestions" class="autocomplete-suggestions"></div>
            </div>
            <div class="field-error" id="address-error"></div>
          </div>
          <div class="form-group">
            <label>City</label>
            <div class="input-wrap">
              <i class="ico fa fa-city"></i>
              <select name="city" id="city">
                <?php $q="select * from tbl_city"; $r=mysqli_query($con,$q); while($row=$r->fetch_assoc()){echo "<option value='{$row['id']}'>{$row['name']}</option>";} ?>
              </select>
            </div>
            <div class="field-error" id="city-error"></div>
          </div>
        </div>

        <div class="sec-div"><span><i class="fa fa-lock"></i> Account Security</span></div>
        <div class="form-row">
          <div class="form-group">
            <label>Email Address</label>
            <div class="input-wrap">
              <i class="ico fa fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="you@gmail.com" required>
            </div>
            <div class="field-error" id="email-error"></div>
          </div>
          <div class="form-group">
            <label>Password</label>
            <div class="input-wrap">
              <i class="ico fa fa-lock"></i>
              <input type="password" id="password" name="password" placeholder="Min 8 chars, A-Z, 0-9, @#$" required>
            </div>
            <div class="field-error" id="password-error"></div>
          </div>
        </div>

        <div class="sec-div"><span><i class="fa fa-file-pdf"></i> Documents</span></div>
        <div class="form-group" style="margin-bottom:20px;">
          <label>Caste Certificate (PDF only)</label>
          <div class="file-zone" onclick="document.getElementById('file').click()">
            <i class="fa fa-cloud-arrow-up"></i>
            <p><span>Click to upload</span> your Caste Certificate</p>
            <p style="font-size:.73rem;margin-top:3px;opacity:.7;" id="fileName">PDF files only · Max 5MB</p>
          </div>
          <input type="file" id="file" name="file" accept=".pdf" onchange="document.getElementById('fileName').textContent=this.files[0]?this.files[0].name:'PDF files only · Max 5MB'">
          <div class="field-error" id="file-error"></div>
        </div>

        <div class="btn-row">
          <button type="submit" name="submit" id="form-submit" class="btn-submit">
            <i class="fa fa-paper-plane"></i> Register & Get OTP
          </button>
          <button type="reset" class="btn-reset" onclick="clearErrors()">
            <i class="fa fa-rotate-left"></i> Clear
          </button>
        </div>
      </form>

      <div class="login-link">Already a member? <a href="login.php">Sign in here</a></div>
    </div>

  </div>
</div>

<script>
function clearErrors(){document.querySelectorAll('.field-error').forEach(e=>e.classList.remove('show'));document.getElementById('alertBox').classList.remove('show');document.getElementById('fileName').textContent='PDF files only · Max 5MB';}
function showAlert(msg){const b=document.getElementById('alertBox');document.getElementById('alertMsg').textContent=msg;b.classList.add('show');b.scrollIntoView({behavior:'smooth',block:'nearest'});}
function showFieldError(id,msg){const el=document.getElementById(id);el.textContent=msg;el.classList.add('show');}

$(document).ready(function(){
  $('.GG').on('submit',function(e){
    e.preventDefault();
    let valid=true;
    document.querySelectorAll('.field-error').forEach(e=>e.classList.remove('show'));
    document.getElementById('alertBox').classList.remove('show');

    const nameRegex=/^[a-zA-Z]+(\s[a-zA-Z]+){1,2}$/;
    const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex=/^\d{10}$/;
    const passwordRegex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const unameRegex=/^([a-zA-Z]){2,}$/;

    const name=$('#name').val(),email=$('#email').val(),phone=$('#cno').val();
    const dob=$('#dob').val(),password=$('#password').val(),uname=$('#uname').val();
    const file=$('#file').val(),address=$('#address').val().trim();

    const bd=new Date(dob),today=new Date();
    let age=today.getFullYear()-bd.getFullYear();
    const m=today.getMonth()-bd.getMonth();
    if(m<0||(m===0&&today.getDate()<bd.getDate()))age--;
    if(age<1){showFieldError('dob-error','Age must be at least 1 year.');valid=false;}
    if(!nameRegex.test(name)){showFieldError('name-error','Enter First Middle Last name (separated by spaces).');valid=false;}
    if(!unameRegex.test(uname)){showFieldError('uname-error','Username must be at least 2 letters only.');valid=false;}
    if(!emailRegex.test(email)){showFieldError('email-error','Please enter a valid email address.');valid=false;}
    if(!phoneRegex.test(phone)){showFieldError('phone-error','Please enter a valid 10-digit contact number.');valid=false;}
    if(!address){showFieldError('address-error','Address cannot be empty.');valid=false;}
    if(!passwordRegex.test(password)){showFieldError('password-error','Min 8 chars with uppercase, lowercase, number & special char.');valid=false;}
    if(!file){showFieldError('file-error','Please upload your Caste Certificate (PDF only).');valid=false;}

    if(valid){
      const btn=document.getElementById('form-submit');
      btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> Registering...';
      btn.disabled=true;
      const fd=new FormData(this);
      $.ajax({url:'Register_Member.php',method:'POST',data:fd,contentType:false,processData:false,
        success:function(res){
          if(res==true){window.location='registrationotp.php';}
          else if(res=="user exists"){showAlert('This email is already registered. Please login.');}
          else if(res=="Please Upload only PDF file for Certificate!"){showFieldError('file-error','Only PDF files are allowed.');}
          else{showAlert('Error: '+res);}
          btn.innerHTML='<i class="fa fa-paper-plane"></i> Register & Get OTP';
          btn.disabled=false;
        }
      });
    }
  });
});

// Address autocomplete
function debounce(fn,d){let t;return function(...a){clearTimeout(t);t=setTimeout(()=>fn.apply(this,a),d);};}
const fetchSugg=debounce(function(input){
  if(input.length<3){document.getElementById('suggestions').innerHTML='';return;}
  const loc='21.176633196051704,72.83300753723111',key='PEDy9RDQZovqNa0v5z43MovpPUOQNBeXE2RiVdAg';
  fetch(`https://api.olamaps.io/places/v1/autocomplete?location=${loc}&input=${input}&api_key=${key}`,{headers:{'X-Request-Id':'uma-reg'}})
    .then(r=>r.json()).then(data=>{
      const div=document.getElementById('suggestions');div.innerHTML='';
      if(data.predictions&&data.predictions.length>0){
        data.predictions.forEach(p=>{
          const item=document.createElement('div');item.className='autocomplete-suggestion';
          item.textContent=p.description;
          item.addEventListener('click',()=>{
            const {lat,lng}=p.geometry.location;
            callcity(lat,lng);document.getElementById('address').value=p.description;div.innerHTML='';
          });div.appendChild(item);
        });
      }
    }).catch(e=>console.error(e));
},300);
document.getElementById('address').addEventListener('input',function(){fetchSugg(this.value);});

function callcity(lat,lng){
  const key='PEDy9RDQZovqNa0v5z43MovpPUOQNBeXE2RiVdAg';
  fetch(`https://api.olamaps.io/places/v1/reverse-geocode?latlng=${lat}%2C${lng}&api_key=${key}`,{headers:{'X-Request-Id':'uma-reg'}})
    .then(r=>r.json()).then(data=>getcity(data));
}
function getcity(api){
  const res=api.results,seen=new Set();
  for(let i=0;i<res.length;i++){const ac=res[i].address_components;for(let j=0;j<ac.length;j++){if(ac[j].types.includes("locality")){const s=ac[j].long_name;if(!seen.has(s)){seen.add(s);if(matchArea(s)==="ok")return;}}}}
}
function matchArea(name){const sel=document.getElementById('city');for(let i=0;i<sel.options.length;i++){if(sel.options[i].text.toLowerCase()===name.toLowerCase()){sel.value=sel.options[i].value;return"ok";}}return null;}
</script>
</body>
</html>