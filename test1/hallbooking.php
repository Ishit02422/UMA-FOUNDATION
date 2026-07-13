<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['id'])){
    echo "<script>alert('Please login first.');window.location='../login.php';</script>";
    exit;
}
$user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Hall Booking - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;}
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(99,102,241,.13) 0%,transparent 65%);border-radius:50%;}
.bg::after{content:'';position:absolute;bottom:-80px;left:-80px;width:350px;height:350px;background:radial-gradient(circle,rgba(139,92,246,.08) 0%,transparent 65%);border-radius:50%;}

/* NAV */
.nav{position:fixed;top:0;width:100%;z-index:999;background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.logo{font-size:1.1rem;font-weight:800;color:#fff;text-decoration:none;display:flex;align-items:center;gap:9px;}
.logo-icon{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;}
.nav-links{display:flex;gap:4px;list-style:none;align-items:center;}
.nav-links a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.86rem;font-weight:500;padding:6px 12px;border-radius:8px;transition:all .2s;}
.nav-links a:hover,.nav-links a.active{color:#fff;background:rgba(255,255,255,.07);}
.nav-btn{background:linear-gradient(135deg,#6366f1,#8b5cf6)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important;}

/* HERO */
.hero{position:relative;z-index:10;padding:104px 40px 48px;text-align:center;}
.hero-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.3);color:#a5b4fc;padding:6px 16px;border-radius:30px;font-size:.78rem;font-weight:600;margin-bottom:16px;}
.hero h1{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#fff;margin-bottom:10px;}
.hero h1 span{background:linear-gradient(135deg,#6366f1,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero p{color:rgba(255,255,255,.45);font-size:.93rem;max-width:500px;margin:0 auto;}

/* CONTENT */
.content{position:relative;z-index:10;max-width:1100px;margin:0 auto;padding:0 24px 80px;}

.sec-title{font-size:1rem;font-weight:700;color:#fff;margin-bottom:20px;display:flex;align-items:center;gap:9px;}
.sec-title i{color:#6366f1;}

/* HALL CARDS */
.halls-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;margin-bottom:52px;}
.hall-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;transition:all .3s;position:relative;}
.hall-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#6366f1,#a78bfa);opacity:0;transition:opacity .3s;}
.hall-card:hover{border-color:rgba(99,102,241,.3);transform:translateY(-4px);box-shadow:0 12px 36px rgba(99,102,241,.1);}
.hall-card:hover::before{opacity:1;}
.hall-img{width:100%;height:190px;object-fit:cover;display:block;}
.hall-body{padding:22px;}
.hall-name{font-size:1.05rem;font-weight:700;color:#fff;margin-bottom:12px;}
.hall-meta{display:flex;flex-direction:column;gap:7px;margin-bottom:16px;}
.hall-meta-row{display:flex;align-items:center;gap:9px;font-size:.82rem;color:rgba(255,255,255,.5);}
.hall-meta-row i{color:#6366f1;width:14px;}
.hall-price{font-size:1.3rem;font-weight:800;background:linear-gradient(135deg,#a5b4fc,#c4b5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:16px;}
.btn-book{width:100%;padding:11px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:9px;font-size:.88rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:7px;}
.btn-book:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(99,102,241,.35);}
.no-halls{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:40px;text-align:center;color:rgba(255,255,255,.4);font-size:.9rem;}

/* HISTORY TABLE */
.table-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;}
.tbl{width:100%;border-collapse:collapse;}
.tbl thead th{padding:14px 16px;font-size:.72rem;font-weight:700;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.7px;border-bottom:1px solid rgba(255,255,255,.07);background:rgba(255,255,255,.02);}
.tbl tbody td{padding:13px 16px;font-size:.84rem;color:rgba(255,255,255,.7);border-bottom:1px solid rgba(255,255,255,.04);}
.tbl tbody tr:last-child td{border:none;}
.tbl tbody tr:hover td{background:rgba(255,255,255,.02);}
.badge{padding:4px 10px;border-radius:20px;font-size:.72rem;font-weight:700;}
.badge-approved{background:rgba(16,185,129,.12);color:#34d399;border:1px solid rgba(16,185,129,.2);}
.badge-pending{background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2);}
.no-data{text-align:center;color:rgba(255,255,255,.35);padding:30px;font-size:.88rem;}

/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.75);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
.modal-overlay.show{display:flex;}
.modal{background:#161b27;border:1px solid rgba(99,102,241,.2);border-radius:18px;padding:32px;max-width:480px;width:94%;max-height:90vh;overflow-y:auto;}
.modal-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;}
.modal-header h3{font-size:1.05rem;font-weight:700;color:#fff;}
.modal-close{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:7px;color:rgba(255,255,255,.5);width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.9rem;transition:all .2s;}
.modal-close:hover{border-color:rgba(239,68,68,.3);color:#f87171;}
.form-group{margin-bottom:18px;}
.form-group label{display:block;font-size:.72rem;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:8px;letter-spacing:.6px;text-transform:uppercase;}
.form-inp{width:100%;padding:11px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.88rem;outline:none;transition:all .3s;}
.form-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);}
.form-inp[disabled]{opacity:.6;cursor:not-allowed;}
.form-inp::placeholder{color:rgba(255,255,255,.2);}
.payment-note{background:rgba(99,102,241,.06);border:1px dashed rgba(99,102,241,.25);border-radius:10px;padding:14px 16px;margin-bottom:18px;}
.payment-note p{font-size:.8rem;color:rgba(255,255,255,.5);line-height:1.6;}
.payment-note strong{color:#a5b4fc;}
.modal-footer{display:flex;gap:10px;margin-top:6px;}
.btn-confirm{flex:1;padding:12px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:9px;font-family:'Inter',sans-serif;font-weight:700;cursor:pointer;transition:all .3s;}
.btn-confirm:hover{box-shadow:0 6px 18px rgba(99,102,241,.35);}
.btn-cancel{padding:12px 20px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.6);border-radius:9px;font-family:'Inter',sans-serif;font-weight:500;cursor:pointer;transition:all .2s;}
.btn-cancel:hover{border-color:rgba(239,68,68,.3);color:#f87171;}

.footer-bar{position:relative;z-index:10;background:#0a0d14;border-top:1px solid rgba(255,255,255,.06);padding:20px 40px;text-align:center;color:rgba(255,255,255,.3);font-size:.8rem;}
@media(max-width:768px){.nav{padding:0 16px;}.nav-links{display:none;}.content{padding:0 16px 60px;}}
</style>
</head>
<body>
<div class="bg"></div>

<nav class="nav">
  <a href="index.php" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="hallbooking.php" class="active">Hall Booking</a></li>
    <li><a href="donationform.php">Donation</a></li>
    <li><a href="announcement.php">Events</a></li>
    <li><a href="scholarship.php">Scholarship</a></li>
    <?php if(isset($_SESSION['id'])): ?>
      <li><a href="../logout.php" class="nav-btn">Logout</a></li>
    <?php endif; ?>
  </ul>
</nav>

<div class="hero">
  <div class="hero-badge"><i class="fa fa-building"></i> Available Venues</div>
  <h1>Book a <span>Hall</span> for Your Event</h1>
  <p>Reserve premium halls for functions, ceremonies, and gatherings at Uma Foundation.</p>
</div>

<div class="content">
  <!-- AVAILABLE HALLS -->
  <div class="sec-title"><i class="fa fa-building-columns"></i> Available Halls</div>
  <div class="halls-grid">
  <?php
    $h = mysqli_query($con,"SELECT * FROM tbl_hall_master WHERE status=1");
    if($h && mysqli_num_rows($h)>0):
      while($hall=$h->fetch_assoc()):
        $img = !empty($hall['image']) ? '../'.$hall['image'] : 'assets/images/meeting-01.jpg';
  ?>
    <div class="hall-card">
      <img src="<?php echo htmlspecialchars($img);?>" class="hall-img" alt="<?php echo htmlspecialchars($hall['name']);?>" onerror="this.src='assets/images/meeting-01.jpg'">
      <div class="hall-body">
        <div class="hall-name"><?php echo htmlspecialchars($hall['name']);?></div>
        <div class="hall-meta">
          <div class="hall-meta-row"><i class="fa fa-users"></i>Capacity: <strong><?php echo htmlspecialchars($hall['capacity']);?> persons</strong></div>
          <div class="hall-meta-row"><i class="fa fa-location-dot"></i><?php echo htmlspecialchars($hall['address']);?></div>
        </div>
        <div class="hall-price">₹<?php echo number_format($hall['rent']);?> / Day</div>
        <button class="btn-book" onclick="openModal(<?php echo $hall['id'];?>,'<?php echo addslashes($hall['name']);?>','<?php echo $hall['rent'];?>')">
          <i class="fa fa-calendar-check"></i> Book Now
        </button>
      </div>
    </div>
  <?php endwhile; else: ?>
    <div class="no-halls"><i class="fa fa-building" style="font-size:2rem;margin-bottom:12px;display:block;color:rgba(255,255,255,.2)"></i>No halls available currently.</div>
  <?php endif; ?>
  </div>

  <!-- MY BOOKINGS -->
  <div class="sec-title"><i class="fa fa-clock-rotate-left"></i> My Booking History</div>
  <div class="table-card">
    <table class="tbl">
      <thead><tr>
        <th>#</th><th>Hall Name</th><th>Start</th><th>End</th><th>Rent</th><th>Transaction ID</th><th>Date</th><th>Status</th>
      </tr></thead>
      <tbody>
      <?php
        $hq = "SELECT hb.*,h.name hall_name,h.rent FROM tbl_hall_booking hb
               JOIN tbl_hall_master h ON hb.hall_id=h.id
               WHERE hb.uid='$user_id' ORDER BY hb.id DESC";
        $hr = mysqli_query($con,$hq);
        if($hr && mysqli_num_rows($hr)>0):
          $n=1; while($row=$hr->fetch_assoc()):
      ?>
        <tr>
          <td><?php echo $n++;?></td>
          <td><?php echo htmlspecialchars($row['hall_name']);?></td>
          <td><?php echo date('d M Y h:i A',strtotime($row['start_date_time']));?></td>
          <td><?php echo date('d M Y h:i A',strtotime($row['end_date_time']));?></td>
          <td>₹<?php echo number_format($row['rent']);?></td>
          <td><?php echo htmlspecialchars($row['transaction_id']);?></td>
          <td><?php echo date('d M Y',strtotime($row['request_date']));?></td>
          <td><?php echo $row['status']==1?'<span class="badge badge-approved">Approved</span>':'<span class="badge badge-pending">Pending</span>';?></td>
        </tr>
      <?php endwhile; else: ?>
        <tr><td colspan="8" class="no-data"><i class="fa fa-calendar-xmark"></i> No bookings yet.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- BOOKING MODAL -->
<div class="modal-overlay" id="bookModal">
  <div class="modal">
    <div class="modal-header">
      <h3><i class="fa fa-calendar-check" style="color:#6366f1;margin-right:8px"></i>Book Hall</h3>
      <button class="modal-close" onclick="closeModal()"><i class="fa fa-xmark"></i></button>
    </div>
    <input type="hidden" id="modal_hall_id">
    <div class="form-group">
      <label>Hall Name</label>
      <input class="form-inp" id="modal_hall_name" disabled>
    </div>
    <div class="form-group">
      <label>Rent per Day</label>
      <input class="form-inp" id="modal_hall_rent" disabled>
    </div>
    <div class="form-group">
      <label>Start Date & Time</label>
      <input class="form-inp" type="datetime-local" id="start_date_time">
    </div>
    <div class="form-group">
      <label>End Date & Time</label>
      <input class="form-inp" type="datetime-local" id="end_date_time">
    </div>
    <div class="payment-note">
      <p><i class="fa fa-circle-info" style="color:#a5b4fc;margin-right:6px"></i>Pay via UPI to <strong>umafoundation@upi</strong> or scan QR at office. Enter the transaction reference below.</p>
    </div>
    <div class="form-group">
      <label>Transaction ID / Reference No.</label>
      <input class="form-inp" type="number" id="transaction_id" placeholder="Enter UPI reference number">
    </div>
    <div class="modal-footer">
      <button class="btn-confirm" id="confirmBtn" onclick="confirmBooking()"><i class="fa fa-check"></i> Confirm Booking</button>
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
    </div>
  </div>
</div>

<footer class="footer-bar">&copy; 2024 Uma Foundation. All Rights Reserved.</footer>

<script>
function openModal(id,name,rent){
  document.getElementById('modal_hall_id').value=id;
  document.getElementById('modal_hall_name').value=name;
  document.getElementById('modal_hall_rent').value='₹'+Number(rent).toLocaleString('en-IN');
  document.getElementById('start_date_time').value='';
  document.getElementById('end_date_time').value='';
  document.getElementById('transaction_id').value='';
  document.getElementById('bookModal').classList.add('show');
}
function closeModal(){ document.getElementById('bookModal').classList.remove('show'); }
document.getElementById('bookModal').addEventListener('click',function(e){if(e.target===this)closeModal();});

function confirmBooking(){
  const start=document.getElementById('start_date_time').value;
  const end=document.getElementById('end_date_time').value;
  const tid=document.getElementById('transaction_id').value;
  const hall_id=document.getElementById('modal_hall_id').value;
  if(!start||!end){alert('Please select start and end date & time.');return;}
  if(new Date(end)<=new Date(start)){alert('End time must be after start time.');return;}
  if(!tid){alert('Please enter Transaction ID.');return;}
  const btn=document.getElementById('confirmBtn');
  btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> Booking...';
  const fd=new FormData();
  fd.append('hall_id',hall_id);
  fd.append('start_date_time',start);
  fd.append('end_date_time',end);
  fd.append('transaction_id',tid);
  fd.append('request_date','<?php echo date('Y-m-d');?>');
  fd.append('payment_date','<?php echo date('Y-m-d');?>');
  $.ajax({
    url:'../Ajax_file/addhallbooking.php',method:'POST',data:fd,processData:false,contentType:false,
    success:function(res){
      if(res=='1'||res.trim()=='1'){
        alert('Hall booked successfully! Pending admin approval.');
        window.location.reload();
      } else { alert('Error: '+res); btn.disabled=false; btn.innerHTML='<i class="fa fa-check"></i> Confirm Booking'; }
    },
    error:function(){ alert('Network error. Please try again.'); btn.disabled=false; btn.innerHTML='<i class="fa fa-check"></i> Confirm Booking'; }
  });
}
</script>
</body>
</html>
