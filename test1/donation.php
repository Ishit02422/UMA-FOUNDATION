<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['id'])){ header('Location:../login.php'); exit; }
if(!isset($_GET['doprice'])){ header('Location:donationform.php'); exit; }

$doname  = htmlspecialchars($_GET['doname'] ?? 'Donation');
$doprice = (float)($_GET['doprice'] ?? 0);
$doquan  = (int)($_GET['doquan'] ?? 1);
$user_id = $_SESSION['id'];

// Fetch user info
$uq = mysqli_query($con,"SELECT * FROM tbl_user WHERE id='$user_id' LIMIT 1");
$user = $uq ? $uq->fetch_assoc() : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Complete Donation - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;display:flex;flex-direction:column;}
.bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.bg::before{content:'';position:absolute;top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(99,102,241,.13) 0%,transparent 65%);border-radius:50%;}

/* NAV */
.nav{position:fixed;top:0;width:100%;z-index:999;background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.logo{font-size:1.1rem;font-weight:800;color:#fff;text-decoration:none;display:flex;align-items:center;gap:9px;}
.logo-icon{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;}

/* PAGE */
.page{position:relative;z-index:10;flex:1;display:flex;align-items:center;justify-content:center;padding:100px 20px 60px;}
.wrapper{width:100%;max-width:540px;}

.back-link{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.4);font-size:.84rem;text-decoration:none;margin-bottom:24px;transition:color .2s;}
.back-link:hover{color:#a5b4fc;}

.card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:20px;overflow:hidden;box-shadow:0 24px 60px rgba(0,0,0,.5);}
.card-top{padding:28px 32px;border-bottom:1px solid rgba(255,255,255,.06);}
.card-top h2{font-size:1.15rem;font-weight:700;color:#fff;margin-bottom:4px;}
.card-top p{font-size:.82rem;color:rgba(255,255,255,.4);}
.card-body{padding:28px 32px;}

/* Summary */
.summary{background:rgba(99,102,241,.06);border:1px solid rgba(99,102,241,.12);border-radius:12px;padding:18px;margin-bottom:24px;}
.s-row{display:flex;justify-content:space-between;align-items:center;padding:7px 0;border-bottom:1px solid rgba(255,255,255,.05);}
.s-row:last-child{border:none;padding-top:12px;margin-top:4px;}
.s-row .lbl{font-size:.8rem;color:rgba(255,255,255,.4);}
.s-row .val{font-size:.88rem;font-weight:600;color:#e6edf3;}
.s-row.total .lbl{font-size:.88rem;font-weight:700;color:#a5b4fc;}
.s-row.total .val{font-size:1.2rem;font-weight:800;background:linear-gradient(135deg,#a5b4fc,#c4b5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}

/* UPI box */
.upi-box{background:rgba(16,185,129,.05);border:1px dashed rgba(16,185,129,.25);border-radius:12px;padding:18px;margin-bottom:22px;}
.upi-box h4{font-size:.85rem;font-weight:700;color:#34d399;margin-bottom:10px;display:flex;align-items:center;gap:7px;}
.upi-row{display:flex;align-items:center;justify-content:space-between;background:rgba(0,0,0,.2);border-radius:8px;padding:10px 14px;margin-bottom:8px;}
.upi-id{font-size:.9rem;font-weight:700;color:#fff;letter-spacing:.5px;}
.copy-btn{background:rgba(99,102,241,.15);border:1px solid rgba(99,102,241,.2);color:#a5b4fc;padding:5px 12px;border-radius:6px;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;font-family:'Inter',sans-serif;}
.copy-btn:hover{background:rgba(99,102,241,.25);}
.upi-note{font-size:.77rem;color:rgba(255,255,255,.4);line-height:1.6;}
.amount-chip{display:inline-flex;align-items:center;gap:5px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.2);color:#a5b4fc;padding:4px 12px;border-radius:20px;font-size:.8rem;font-weight:700;}

/* Form */
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:.72rem;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:8px;letter-spacing:.6px;text-transform:uppercase;}
.form-inp{width:100%;padding:12px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:10px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.88rem;outline:none;transition:all .3s;}
.form-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.1);}
.form-inp[disabled]{opacity:.55;cursor:not-allowed;}
.form-inp::placeholder{color:rgba(255,255,255,.2);}

.divider{height:1px;background:rgba(255,255,255,.06);margin:20px 0;}

.btn-submit{width:100%;padding:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-size:.95rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:9px;margin-top:4px;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}
.btn-submit:disabled{opacity:.6;transform:none;cursor:not-allowed;}

/* Success */
.success-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);}
.success-overlay.show{display:flex;}
.success-box{background:#161b27;border:1px solid rgba(99,102,241,.2);border-radius:20px;padding:40px;text-align:center;max-width:380px;width:90%;}
.sicon{width:70px;height:70px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:#fff;margin:0 auto 20px;}
.success-box h3{font-size:1.2rem;font-weight:700;color:#fff;margin-bottom:8px;}
.success-box p{font-size:.84rem;color:rgba(255,255,255,.45);margin-bottom:20px;}
.receipt-id{font-size:.8rem;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.2);color:#a5b4fc;padding:8px 16px;border-radius:8px;margin-bottom:20px;font-family:monospace;}
.btn-home{display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;padding:11px 24px;border-radius:9px;font-weight:700;text-decoration:none;font-size:.88rem;}
</style>
</head>
<body>
<div class="bg"></div>
<nav class="nav">
  <a href="index.php" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
</nav>

<div class="page">
  <div class="wrapper">
    <a href="donationform.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Donations</a>

    <div class="card">
      <div class="card-top">
        <h2><i class="fa fa-heart" style="color:#6366f1;margin-right:8px"></i>Complete Your Donation</h2>
        <p>Review and confirm your contribution to Uma Foundation</p>
      </div>
      <div class="card-body">

        <!-- Summary -->
        <div class="summary">
          <div class="s-row"><span class="lbl">Donation Type</span><span class="val"><?php echo $doname;?></span></div>
          <div class="s-row"><span class="lbl">Quantity</span><span class="val"><?php echo $doquan;?></span></div>
          <div class="s-row"><span class="lbl">Date</span><span class="val"><?php echo date('d M Y');?></span></div>
          <div class="s-row total"><span class="lbl">Total Amount</span><span class="val">₹<?php echo number_format($doprice,2);?></span></div>
        </div>

        <!-- Razorpay Info -->
        <div class="upi-box" style="background:rgba(99,102,241,.05); border-color:rgba(99,102,241,.25);">
          <h4><i class="fa fa-shield"></i> Secure Online Payment</h4>
          <p class="upi-note">
            You are about to securely donate <span class="amount-chip">₹<?php echo number_format($doprice,2);?></span> via Razorpay. Supported methods include UPI, Credit/Debit Cards, and Net Banking.
          </p>
        </div>

        <!-- Donor Form -->
        <form id="donationForm">
          <div class="form-group">
            <label>Your Name</label>
            <input class="form-inp" type="text" id="donor_name" value="<?php echo htmlspecialchars($user['name']??'');?>" placeholder="Full name" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-inp" type="email" id="donor_email" value="<?php echo htmlspecialchars($user['email']??'');?>" placeholder="your@email.com" required>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input class="form-inp" type="tel" id="donor_phone" value="<?php echo htmlspecialchars($user['phone']??'');?>" placeholder="10-digit mobile" maxlength="10" required>
          </div>

          <button type="submit" class="btn-submit" id="submitBtn">
            <i class="fa fa-credit-card"></i> Pay Securely with Razorpay
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="success-overlay" id="successOverlay">
  <div class="success-box">
    <div class="sicon"><i class="fa fa-check"></i></div>
    <h3>Donation Successful! 🎉</h3>
    <p>Thank you <strong style="color:#fff" id="thankName"></strong> for your generous contribution to Uma Foundation.</p>
    <div class="receipt-id" id="receiptId"></div>
    <p style="margin-bottom:20px">A receipt will be sent to your email shortly.</p>
    <a href="index.php" class="btn-home"><i class="fa fa-home"></i> Go to Home</a>
  </div>
</div>

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.getElementById('donationForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const name  = document.getElementById('donor_name').value.trim();
  const email = document.getElementById('donor_email').value.trim();
  const phone = document.getElementById('donor_phone').value.trim();
  if(!name || !email || !phone){ alert('Please fill all fields.'); return; }

  const btn = document.getElementById('submitBtn');
  btn.disabled = true;
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Initializing Payment...';

  // 1. Create Razorpay Order
  $.ajax({
    url: 'verifydonationpayment.php',
    type: 'POST',
    data: { name: name, amount: <?php echo $doprice; ?> },
    dataType: 'json',
    success: function(res) {
      if(res.error) {
        alert(res.error);
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-credit-card"></i> Pay Securely with Razorpay';
        return;
      }
      
      // 2. Open Razorpay Checkout
      var options = {
        "key": "rzp_test_TCIyxi95KsBYIP", 
        "amount": res.amount, 
        "currency": "INR",
        "name": "Uma Foundation",
        "description": "Donation for <?php echo addslashes($doname); ?>",
        "order_id": res.order_id,
        "handler": function (response) {
            // 3. Save Donation to Database on Success
            const fd = new FormData();
            fd.append('doname', '<?php echo addslashes($doname);?>');
            fd.append('doquan', '<?php echo $doquan;?>');
            fd.append('doprice', '<?php echo $doprice;?>');
            fd.append('donor_name', name);
            fd.append('donor_email', email);
            fd.append('donor_phone', phone);
            fd.append('payment_id', response.razorpay_payment_id);
            fd.append('order_id', response.razorpay_order_id);
            fd.append('signature', response.razorpay_signature);

            // Use the payment_handler or savedonation
            $.ajax({
              url: '../Ajax_file/savedonation.php',
              type: 'POST',
              data: fd,
              processData: false,
              contentType: false,
              success: function(saveRes) {
                document.getElementById('thankName').textContent = name;
                document.getElementById('receiptId').textContent = 'Receipt ID: ' + response.razorpay_payment_id;
                document.getElementById('successOverlay').classList.add('show');
              }
            });
        },
        "prefill": {
            "name": name,
            "email": email,
            "contact": phone
        },
        "theme": { "color": "#6366f1" },
        "modal": {
            "ondismiss": function(){
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-credit-card"></i> Pay Securely with Razorpay';
            }
        }
      };
      
      var rzp1 = new Razorpay(options);
      rzp1.open();
    },
    error: function(err) {
      alert("Failed to initialize payment gateway.");
      btn.disabled = false;
      btn.innerHTML = '<i class="fa fa-credit-card"></i> Pay Securely with Razorpay';
    }
  });
});
</script>
</body>
</html>