<?php
session_start();
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Donation - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;}
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-120px;right:-120px;width:550px;height:550px;background:radial-gradient(circle,rgba(99,102,241,.13) 0%,transparent 65%);border-radius:50%;}
.bg::after{content:'';position:absolute;bottom:-80px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(139,92,246,.08) 0%,transparent 65%);border-radius:50%;}

/* NAV */
.nav{position:fixed;top:0;width:100%;z-index:999;background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.logo{font-size:1.15rem;font-weight:800;color:#fff;text-decoration:none;display:flex;align-items:center;gap:9px;}
.logo-icon{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;}
.nav-links{display:flex;gap:4px;list-style:none;align-items:center;}
.nav-links a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.86rem;font-weight:500;padding:6px 12px;border-radius:8px;transition:all .2s;}
.nav-links a:hover,.nav-links a.active{color:#fff;background:rgba(255,255,255,.07);}
.nav-btn{background:linear-gradient(135deg,#6366f1,#8b5cf6)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important;}

/* HERO */
.hero{position:relative;z-index:10;padding:110px 20px 60px;text-align:center;}
.hero-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.3);color:#a5b4fc;padding:6px 16px;border-radius:30px;font-size:.78rem;font-weight:600;margin-bottom:20px;letter-spacing:.5px;}
.hero h1{font-size:clamp(2rem,5vw,3rem);font-weight:800;color:#fff;line-height:1.2;margin-bottom:14px;}
.hero h1 .accent{background:linear-gradient(135deg,#6366f1,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero p{font-size:.95rem;color:rgba(255,255,255,.5);max-width:580px;margin:0 auto;line-height:1.8;}

/* MAIN LAYOUT */
.page{position:relative;z-index:10;max-width:1100px;margin:0 auto;padding:0 20px 80px;display:grid;grid-template-columns:1fr 340px;gap:28px;align-items:start;}

/* DONATION CARDS */
.cards-section h2{font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:20px;display:flex;align-items:center;gap:9px;}
.cards-section h2 i{color:#6366f1;}
.donation-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.don-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:22px 20px;transition:all .3s;position:relative;overflow:hidden;}
.don-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#6366f1,#a78bfa);opacity:0;transition:opacity .3s;}
.don-card:hover{border-color:rgba(99,102,241,.35);transform:translateY(-3px);box-shadow:0 10px 28px rgba(99,102,241,.1);}
.don-card:hover::before{opacity:1;}
.don-icon{width:42px;height:42px;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.95rem;color:#a5b4fc;margin-bottom:14px;}
.don-name{font-size:.9rem;font-weight:700;color:#fff;margin-bottom:4px;}
.don-price{font-size:1.2rem;font-weight:800;background:linear-gradient(135deg,#a5b4fc,#c4b5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:14px;}
.qty-wrap{display:flex;align-items:center;gap:8px;margin-bottom:14px;}
.qty-wrap label{font-size:.72rem;color:rgba(255,255,255,.4);font-weight:600;text-transform:uppercase;}
.qty-input{width:70px;padding:7px 10px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:8px;color:#e6edf3;font-size:.88rem;font-family:'Inter',sans-serif;outline:none;text-align:center;}
.qty-input:focus{border-color:#6366f1;}
.btn-donate{width:100%;padding:10px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:9px;font-size:.87rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:7px;}
.btn-donate:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(99,102,241,.35);}

/* CUSTOM DONATION */
.custom-card{background:#161b27;border:1px solid rgba(99,102,241,.2);border-radius:14px;padding:22px 20px;margin-top:16px;}
.custom-card h3{font-size:.95rem;font-weight:700;color:#fff;margin-bottom:14px;display:flex;align-items:center;gap:8px;}
.custom-card h3 i{color:#a5b4fc;}
.custom-row{display:flex;gap:10px;align-items:flex-end;}
.custom-inp-wrap{flex:1;}
.custom-inp-wrap label{font-size:.72rem;color:rgba(255,255,255,.4);font-weight:600;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:7px;}
.custom-inp{width:100%;padding:11px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.9rem;outline:none;transition:all .3s;}
.custom-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);}
.custom-inp::placeholder{color:rgba(255,255,255,.2);}

/* SIDEBAR */
.sidebar{display:flex;flex-direction:column;gap:18px;}
.info-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:22px;}
.info-card h3{font-size:.92rem;font-weight:700;color:#fff;margin-bottom:16px;display:flex;align-items:center;gap:8px;padding-bottom:12px;border-bottom:1px solid rgba(255,255,255,.06);}
.info-card h3 i{color:#6366f1;}
.info-item{display:flex;gap:10px;margin-bottom:14px;align-items:flex-start;}
.info-item:last-child{margin-bottom:0;}
.info-icon{width:32px;height:32px;background:rgba(99,102,241,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.8rem;color:#a5b4fc;flex-shrink:0;}
.info-item h6{font-size:.72rem;color:rgba(255,255,255,.4);font-weight:600;margin-bottom:2px;}
.info-item p{font-size:.84rem;color:rgba(255,255,255,.7);line-height:1.5;}

.quote-card{background:linear-gradient(135deg,rgba(99,102,241,.1),rgba(139,92,246,.06));border:1px solid rgba(99,102,241,.2);border-radius:14px;padding:22px;}
.quote-card p{font-size:.85rem;color:rgba(255,255,255,.65);font-style:italic;line-height:1.7;}
.quote-card cite{display:block;margin-top:10px;font-size:.75rem;color:#a5b4fc;font-weight:600;font-style:normal;}

.modes-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:22px;}
.modes-card h3{font-size:.92rem;font-weight:700;color:#fff;margin-bottom:14px;display:flex;align-items:center;gap:8px;padding-bottom:12px;border-bottom:1px solid rgba(255,255,255,.06);}
.modes-card h3 i{color:#6366f1;}
.mode-item{display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.04);}
.mode-item:last-child{border:none;}
.mode-icon{width:28px;height:28px;background:rgba(99,102,241,.1);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.75rem;color:#a5b4fc;}
.mode-item span{font-size:.83rem;color:rgba(255,255,255,.6);}

/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
.modal-overlay.show{display:flex;}
.modal{background:#161b27;border:1px solid rgba(99,102,241,.25);border-radius:18px;padding:32px;max-width:380px;width:90%;text-align:center;}
.modal-icon{width:60px;height:60px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.4rem;color:#fff;margin:0 auto 16px;}
.modal h3{font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:8px;}
.modal p{font-size:.85rem;color:rgba(255,255,255,.5);margin-bottom:20px;}
.modal-btns{display:flex;gap:10px;}
.modal-confirm{flex:1;padding:11px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:9px;font-family:'Inter',sans-serif;font-weight:700;cursor:pointer;transition:all .3s;}
.modal-confirm:hover{box-shadow:0 6px 18px rgba(99,102,241,.35);}
.modal-cancel{flex:1;padding:11px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.6);border-radius:9px;font-family:'Inter',sans-serif;font-weight:500;cursor:pointer;transition:all .3s;}
.modal-cancel:hover{border-color:rgba(239,68,68,.3);color:#f87171;}

.footer-bar{position:relative;z-index:10;background:#0a0d14;border-top:1px solid rgba(255,255,255,.06);padding:20px 40px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;}
.footer-bar .fl{font-size:1rem;font-weight:800;color:#fff;display:flex;align-items:center;gap:7px;}
.footer-bar p{font-size:.8rem;color:rgba(255,255,255,.3);}

.alert-box{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);border-radius:10px;padding:11px 14px;margin-bottom:16px;font-size:.83rem;color:#f87171;display:flex;align-items:center;gap:8px;}

@media(max-width:900px){.page{grid-template-columns:1fr;}.donation-grid{grid-template-columns:1fr;}.nav-links{display:none;}}
</style>
</head>
<body>
<div class="bg"></div>

<!-- NAV -->
<nav class="nav">
  <a href="index.php" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="hallbooking.php">Hall Booking</a></li>
    <li><a href="donationform.php" class="active">Donation</a></li>
    <li><a href="announcement.php">Events</a></li>
    <li><a href="scholarship.php">Scholarship</a></li>
    <?php if(isset($_SESSION['id'])): ?>
      <li><a href="../logout.php" class="nav-btn">Logout</a></li>
    <?php else: ?>
      <li><a href="../Registration.php">Register</a></li>
      <li><a href="../login.php" class="nav-btn">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

<!-- HERO -->
<div class="hero" style="position:relative;z-index:10;">
  <div class="hero-badge"><i class="fa fa-heart"></i> Support Uma Foundation</div>
  <h1>Make a <span class="accent">Difference</span><br>With Your Donation</h1>
  <p>Your contribution supports our community — from temple construction to scholarships, your generosity creates lasting impact.</p>
</div>

<!-- MAIN CONTENT -->
<div class="page">
  <div class="cards-section">
    <h2><i class="fa fa-gift"></i> Choose Your Donation</h2>

    <div class="donation-grid" id="donationGrid">
    <?php
      $icons = ['fa-building-columns','fa-om','fa-star','fa-sun','fa-hand-holding-heart','fa-seedling'];
      $i = 0;
      $q = "SELECT * FROM tbl_donation_type WHERE status=1";
      $r = mysqli_query($con,$q);
      while($row = $r->fetch_assoc()):
        if($row['Name'] != 'custom'):
          $icon = $icons[$i % count($icons)]; $i++;
    ?>
      <div class="don-card">
        <div class="don-icon"><i class="fa <?php echo $icon;?>"></i></div>
        <div class="don-name"><?php echo htmlspecialchars($row['Name']);?></div>
        <div class="don-price">₹<?php echo number_format($row['price'],2);?></div>
        <?php if($row['quantitychangable']==1): ?>
        <div class="qty-wrap">
          <label>Qty</label>
          <input type="number" class="qty-input" id="qty_<?php echo $row['id'];?>" value="1" min="1" max="100">
        </div>
        <?php endif; ?>
        <button class="btn-donate" onclick="donate('<?php echo $row['Name'];?>',<?php echo $row['price'];?>,<?php echo $row['quantitychangable'];?>,<?php echo $row['id'];?>)">
          <i class="fa fa-heart"></i> Donate Now
        </button>
      </div>
    <?php endif; endwhile; ?>
    </div>

    <!-- Custom Donation -->
    <?php
      $qc = "SELECT * FROM tbl_donation_type WHERE Name='custom' AND status=1 LIMIT 1";
      $rc = mysqli_query($con,$qc);
      $custom = $rc->fetch_assoc();
      if($custom):
    ?>
    <div class="custom-card">
      <h3><i class="fa fa-pen-to-square"></i> Custom Amount</h3>
      <div class="custom-row">
        <div class="custom-inp-wrap">
          <label>Enter Amount (₹100 – ₹1,00,000)</label>
          <input type="number" class="custom-inp" id="customAmount" placeholder="e.g. 5000" min="100" max="100000" value="100">
        </div>
        <button class="btn-donate" style="width:auto;padding:11px 22px;white-space:nowrap;" onclick="donateCustom(<?php echo $custom['id'];?>)">
          <i class="fa fa-heart"></i> Donate
        </button>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="quote-card">
      <p>"I also want to be the foundation pillar in the construction of Jagatjanani Maa Umiya's historical temple — I am also the foundation pillar."</p>
      <cite>— Uma Foundation</cite>
    </div>

    <div class="info-card">
      <h3><i class="fa fa-circle-info"></i> Tax Benefits</h3>
      <div class="info-item">
        <div class="info-icon"><i class="fa fa-file-invoice"></i></div>
        <div><h6>80G Deduction</h6><p>Donations eligible under Section 80G of Income Tax Act, 1961.</p></div>
      </div>
      <div class="info-item">
        <div class="info-icon"><i class="fa fa-id-card"></i></div>
        <div><h6>PAN Required</h6><p>Provide your PAN number to receive the 80G certificate.</p></div>
      </div>
      <div class="info-item">
        <div class="info-icon"><i class="fa fa-shield-halved"></i></div>
        <div><h6>Secure Payment</h6><p>All transactions are secure and verified.</p></div>
      </div>
    </div>

    <div class="modes-card">
      <h3><i class="fa fa-credit-card"></i> Payment Modes</h3>
      <div class="mode-item"><div class="mode-icon"><i class="fa fa-building"></i></div><span>Bank Transfer / NEFT / RTGS</span></div>
      <div class="mode-item"><div class="mode-icon"><i class="fa fa-qrcode"></i></div><span>UPI / Google Pay / PhonePe</span></div>
      <div class="mode-item"><div class="mode-icon"><i class="fa fa-money-bill"></i></div><span>Cash at Office or Temple (Jaspur)</span></div>
      <div class="mode-item"><div class="mode-icon"><i class="fa fa-envelope"></i></div><span>Demand Draft / Cheque</span></div>
    </div>

    <div class="info-card">
      <h3><i class="fa fa-phone"></i> Need Help?</h3>
      <div class="info-item">
        <div class="info-icon"><i class="fa fa-phone"></i></div>
        <div><h6>Phone</h6><p>+91 79 2630 1234</p></div>
      </div>
      <div class="info-item">
        <div class="info-icon"><i class="fa fa-envelope"></i></div>
        <div><h6>Email</h6><p>info@umafoundation.org</p></div>
      </div>
    </div>
  </div>
</div>

<!-- CONFIRM MODAL -->
<div class="modal-overlay" id="donateModal">
  <div class="modal">
    <div class="modal-icon"><i class="fa fa-heart"></i></div>
    <h3 id="modalTitle">Confirm Donation</h3>
    <p id="modalDesc">Are you sure you want to proceed?</p>
    <div class="modal-btns">
      <button class="modal-confirm" id="modalConfirm">Yes, Donate!</button>
      <button class="modal-cancel" onclick="closeModal()">Cancel</button>
    </div>
  </div>
</div>

<footer class="footer-bar">
  <div class="fl"><i class="fa fa-graduation-cap" style="color:#6366f1"></i>Uma Foundation</div>
  <p>&copy; 2024 Uma Foundation. All Rights Reserved.</p>
</footer>

<script>
let pendingUrl = '';

function donate(name, price, changeable, id) {
  let qty = 1;
  if(changeable == 1) {
    qty = parseInt(document.getElementById('qty_'+id)?.value) || 1;
  }
  const total = price * qty;
  if(total > 100000) {
    alert('Amount above ₹1,00,000 cannot be donated directly. Please contact our head office.');
    return;
  }
  <?php if(!isset($_SESSION['id'])): ?>
  window.location='../login.php'; return;
  <?php endif; ?>
  pendingUrl = 'donation.php?doname='+encodeURIComponent(name)+'&doquan='+qty+'&doprice='+total;
  document.getElementById('modalTitle').textContent = 'Confirm: '+name;
  document.getElementById('modalDesc').textContent = 'Amount: ₹'+total.toLocaleString('en-IN')+(qty>1?' (Qty: '+qty+')':'');
  document.getElementById('donateModal').classList.add('show');
  $.ajax({url:'../Ajax_file/storetypeid.php',data:{typeid:id},type:'POST'});
}

function donateCustom(id) {
  const amt = parseInt(document.getElementById('customAmount').value);
  if(isNaN(amt)||amt<100){alert('Minimum donation amount is ₹100.');return;}
  if(amt>100000){alert('Amount above ₹1,00,000 cannot be donated directly.');return;}
  <?php if(!isset($_SESSION['id'])): ?>
  window.location='../login.php'; return;
  <?php endif; ?>
  pendingUrl = 'donation.php?doname=custom&doquan=1&doprice='+amt;
  document.getElementById('modalTitle').textContent = 'Custom Donation';
  document.getElementById('modalDesc').textContent = 'Amount: ₹'+amt.toLocaleString('en-IN');
  document.getElementById('donateModal').classList.add('show');
  $.ajax({url:'../Ajax_file/storetypeid.php',data:{typeid:id},type:'POST'});
}

document.getElementById('modalConfirm').onclick = function(){
  if(pendingUrl) window.location = pendingUrl;
};

function closeModal(){
  document.getElementById('donateModal').classList.remove('show');
}
document.getElementById('donateModal').addEventListener('click', function(e){
  if(e.target===this) closeModal();
});
</script>
</body>
</html>