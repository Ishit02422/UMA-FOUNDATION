<?php
session_start();
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Announcements - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

/* HERO */
.hero{position:relative;z-index:10;padding:104px 40px 52px;text-align:center;}
.hero-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.3);color:#a5b4fc;padding:6px 16px;border-radius:30px;font-size:.78rem;font-weight:600;margin-bottom:16px;}
.hero h1{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;color:#fff;margin-bottom:10px;}
.hero h1 span{background:linear-gradient(135deg,#6366f1,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero p{color:rgba(255,255,255,.45);font-size:.9rem;max-width:480px;margin:0 auto;}

/* CONTENT */
.content{position:relative;z-index:10;max-width:1100px;margin:0 auto;padding:0 24px 80px;}

/* FILTER TABS */
.filter-tabs{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:32px;}
.tab{padding:7px 18px;border-radius:20px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.04);color:rgba(255,255,255,.5);font-size:.82rem;font-weight:600;cursor:pointer;transition:all .2s;}
.tab:hover,.tab.active{background:rgba(99,102,241,.12);border-color:rgba(99,102,241,.3);color:#a5b4fc;}

/* CARDS */
.ann-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:22px;}
.ann-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;transition:all .3s;display:flex;flex-direction:column;}
.ann-card:hover{border-color:rgba(99,102,241,.3);transform:translateY(-4px);box-shadow:0 12px 36px rgba(99,102,241,.1);}
.ann-img{width:100%;height:180px;object-fit:cover;display:block;}
.ann-img-placeholder{width:100%;height:180px;background:linear-gradient(135deg,rgba(99,102,241,.08),rgba(139,92,246,.05));display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:rgba(99,102,241,.3);}
.ann-body{padding:20px;flex:1;display:flex;flex-direction:column;}
.ann-date{display:flex;align-items:center;gap:7px;margin-bottom:12px;}
.date-badge{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:8px;padding:6px 10px;text-align:center;min-width:44px;}
.date-badge .day{font-size:1.1rem;font-weight:800;line-height:1;}
.date-badge .mon{font-size:.62rem;font-weight:600;opacity:.85;}
.ann-type{display:inline-block;background:rgba(99,102,241,.1);color:#a5b4fc;border-radius:20px;padding:3px 10px;font-size:.7rem;font-weight:700;margin-left:auto;}
.ann-title{font-size:1rem;font-weight:700;color:#fff;margin-bottom:8px;line-height:1.4;}
.ann-desc{font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;flex:1;margin-bottom:16px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
.ann-footer{display:flex;align-items:center;justify-content:space-between;}
.ann-meta{font-size:.75rem;color:rgba(255,255,255,.3);display:flex;align-items:center;gap:6px;}
.btn-detail{display:inline-flex;align-items:center;gap:6px;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.2);color:#a5b4fc;padding:7px 14px;border-radius:8px;font-size:.78rem;font-weight:600;text-decoration:none;transition:all .2s;}
.btn-detail:hover{background:rgba(99,102,241,.2);border-color:rgba(99,102,241,.35);}

.empty-state{text-align:center;padding:60px 20px;grid-column:1/-1;}
.empty-icon{width:72px;height:72px;background:rgba(99,102,241,.08);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:rgba(99,102,241,.4);margin:0 auto 18px;}
.empty-state p{color:rgba(255,255,255,.35);font-size:.9rem;}

.footer-bar{position:relative;z-index:10;background:#0a0d14;border-top:1px solid rgba(255,255,255,.06);padding:20px;text-align:center;color:rgba(255,255,255,.3);font-size:.8rem;}
@media(max-width:768px){.nav{padding:0 16px;}.nav-links{display:none;}.content{padding:0 16px 60px;}}
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
    <li><a href="announcement.php" class="active">Events</a></li>
    <li><a href="scholarship.php">Scholarship</a></li>
    <?php if(isset($_SESSION['id'])): ?>
      <li><a href="../logout.php" class="nav-btn">Logout</a></li>
    <?php else: ?>
      <li><a href="../Registration.php">Register</a></li>
      <li><a href="../login.php" class="nav-btn">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

<div class="hero">
  <div class="hero-badge"><i class="fa fa-bullhorn"></i> Latest Updates</div>
  <h1>Community <span>Announcements</span></h1>
  <p>Stay updated with the latest events, news, and activities from Uma Foundation.</p>
</div>

<div class="content">
  <div class="filter-tabs">
    <div class="tab active" onclick="filterCards('all',this)">All</div>
    <div class="tab" onclick="filterCards('event',this)">Events</div>
    <div class="tab" onclick="filterCards('scholarship',this)">Scholarships</div>
    <div class="tab" onclick="filterCards('notice',this)">Notices</div>
  </div>

  <!-- Notice Board (shown when Notices tab is active) -->
  <div id="noticeBoard" style="display:none;margin-bottom:40px;">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px;">
      <div style="background:#161b27;border:1px solid rgba(251,191,36,.15);border-left:4px solid #fbbf24;border-radius:14px;padding:22px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;background:rgba(251,191,36,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fbbf24;"><i class="fa fa-triangle-exclamation"></i></div>
          <span style="font-size:.9rem;font-weight:700;color:#fff;">Membership Policy</span>
        </div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;">All members must renew their membership annually. Failure to renew will result in suspension of privileges including hall booking and scholarship applications.</p>
      </div>
      <div style="background:#161b27;border:1px solid rgba(16,185,129,.15);border-left:4px solid #10b981;border-radius:14px;padding:22px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;background:rgba(16,185,129,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#10b981;"><i class="fa fa-circle-check"></i></div>
          <span style="font-size:.9rem;font-weight:700;color:#fff;">Donation Guidelines</span>
        </div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;">Donations above ₹1,00,000 must be made directly at the head office. Online donations are accepted up to ₹1,00,000 per transaction.</p>
      </div>
      <div style="background:#161b27;border:1px solid rgba(99,102,241,.15);border-left:4px solid #6366f1;border-radius:14px;padding:22px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;background:rgba(99,102,241,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#6366f1;"><i class="fa fa-building-columns"></i></div>
          <span style="font-size:.9rem;font-weight:700;color:#fff;">Hall Booking Rules</span>
        </div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;">Hall bookings must be made at least 7 days in advance. Cancellations within 48 hours of the booking date are non-refundable.</p>
      </div>
      <div style="background:#161b27;border:1px solid rgba(239,68,68,.15);border-left:4px solid #ef4444;border-radius:14px;padding:22px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;background:rgba(239,68,68,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#ef4444;"><i class="fa fa-graduation-cap"></i></div>
          <span style="font-size:.9rem;font-weight:700;color:#fff;">Scholarship Notice</span>
        </div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;">Scholarship applications are open for the current academic year. All required documents must be submitted within the deadline. Incomplete applications will not be considered.</p>
      </div>
      <div style="background:#161b27;border:1px solid rgba(139,92,246,.15);border-left:4px solid #8b5cf6;border-radius:14px;padding:22px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;background:rgba(139,92,246,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#8b5cf6;"><i class="fa fa-users-gear"></i></div>
          <span style="font-size:.9rem;font-weight:700;color:#fff;">Committee Elections</span>
        </div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;">Committee elections are held annually. Members with more than 1 year of membership are eligible to apply. Applications for Committee Major must be approved by Admin.</p>
      </div>
      <div style="background:#161b27;border:1px solid rgba(6,182,212,.15);border-left:4px solid #06b6d4;border-radius:14px;padding:22px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;background:rgba(6,182,212,.1);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#06b6d4;"><i class="fa fa-phone"></i></div>
          <span style="font-size:.9rem;font-weight:700;color:#fff;">Contact Information</span>
        </div>
        <p style="font-size:.82rem;color:rgba(255,255,255,.5);line-height:1.7;">Office hours: Mon–Sat, 10AM–5PM. Email: info@umafoundation.org | Phone: +91-9876543210</p>
      </div>
    </div>
  </div>

  <div class="ann-grid" id="annGrid">

    <?php
    $q = "SELECT * FROM tbl_announcement ORDER BY declaration_date DESC";
    $res = mysqli_query($con, $q);
    if($res && mysqli_num_rows($res) > 0):
      while($row = $res->fetch_assoc()):
        $day = date('d', strtotime($row['declaration_date']));
        $mon = date('M', strtotime($row['declaration_date']));
        $type = 'event';
        $img = !empty($row['image']) ? '../'.$row['image'] : '';
    ?>
    <div class="ann-card" data-type="<?php echo $type;?>">
      <?php if($img): ?>
        <img src="<?php echo htmlspecialchars($img);?>" class="ann-img" alt="<?php echo htmlspecialchars($row['title']);?>" onerror="this.style.display='none';this.nextSibling.style.display='flex';">
        <div class="ann-img-placeholder" style="display:none;"><i class="fa fa-image"></i></div>
      <?php else: ?>
        <div class="ann-img-placeholder"><i class="fa fa-bullhorn"></i></div>
      <?php endif; ?>
      <div class="ann-body">
        <div class="ann-date">
          <div class="date-badge">
            <div class="day"><?php echo $day;?></div>
            <div class="mon"><?php echo strtoupper($mon);?></div>
          </div>
          <span class="ann-type">Event</span>
        </div>
        <div class="ann-title"><?php echo htmlspecialchars($row['title']);?></div>
        <div class="ann-desc"><?php echo htmlspecialchars($row['description']);?></div>
        <div class="ann-footer">
          <div class="ann-meta"><i class="fa fa-calendar"></i><?php echo date('d M Y', strtotime($row['declaration_date']));?></div>
          <a href="announcement-details.php?id=<?php echo $row['id'];?>" class="btn-detail"><i class="fa fa-arrow-right"></i> Read More</a>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <div class="empty-state">
      <div class="empty-icon"><i class="fa fa-bullhorn"></i></div>
      <p>No announcements yet. Check back soon!</p>
    </div>
    <?php endif; ?>
  </div>
</div>

<footer class="footer-bar">&copy; 2024 Uma Foundation. All Rights Reserved.</footer>

<script>
function filterCards(type, el){
  if(type==='scholarship'){ window.location='scholarship.php'; return; }
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
  const nb=document.getElementById('noticeBoard');
  const grid=document.getElementById('annGrid');
  if(type==='notice'){
    nb.style.display='block'; grid.style.display='none'; return;
  }
  nb.style.display='none'; grid.style.display='grid';
  let visible=0;
  document.querySelectorAll('.ann-card').forEach(c=>{
    if(type==='all'||c.dataset.type===type){c.style.display='flex';visible++;}
    else{c.style.display='none';}
  });
  const existing=document.getElementById('noDataMsg');
  if(existing) existing.remove();
  if(visible===0){
    const msg=document.createElement('div');
    msg.id='noDataMsg';
    msg.style.cssText='grid-column:1/-1;text-align:center;padding:40px;color:rgba(255,255,255,.35);font-size:.9rem;';
    msg.innerHTML='<i class="fa fa-inbox" style="font-size:2rem;margin-bottom:12px;display:block;color:rgba(99,102,241,.3)"></i>No '+type+' announcements at this time.';
    grid.appendChild(msg);
  }
}
</script>
</body>
</html>
