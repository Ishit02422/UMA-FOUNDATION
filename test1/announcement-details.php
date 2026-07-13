<?php
session_start();
include '../connect.php';

if(!isset($_GET['id'])){ header('Location:announcement.php'); exit; }
$id = (int)$_GET['id'];

$q = mysqli_query($con,"SELECT * FROM tbl_announcement WHERE id='$id' LIMIT 1");
if(!$q || mysqli_num_rows($q)==0){ header('Location:announcement.php'); exit; }
$row = $q->fetch_assoc();

// Fetch more announcements
$moreQ = mysqli_query($con,"SELECT * FROM tbl_announcement WHERE id!='$id' ORDER BY declaration_date DESC LIMIT 4");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo htmlspecialchars($row['title']);?> - Uma Foundation</title>
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
.nav-links a:hover,.nav-links a.active{color:#fff;background:rgba(255,255,255,.07);}
.nav-btn{background:linear-gradient(135deg,#6366f1,#8b5cf6)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important;}

.page{position:relative;z-index:10;padding:90px 24px 60px;max-width:880px;margin:0 auto;}

.back-link{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.4);font-size:.84rem;text-decoration:none;margin-bottom:24px;transition:color .2s;}
.back-link:hover{color:#a5b4fc;}

/* DETAIL CARD */
.detail-card{background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:20px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.4);margin-bottom:40px;}
.detail-img{width:100%;height:320px;object-fit:cover;display:block;}
.detail-img-placeholder{width:100%;height:200px;background:linear-gradient(135deg,rgba(99,102,241,.1),rgba(139,92,246,.05));display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(99,102,241,.3);}
.detail-body{padding:36px;}

.detail-meta{display:flex;flex-wrap:wrap;gap:16px;margin-bottom:24px;}
.meta-chip{display:flex;align-items:center;gap:7px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.15);color:#a5b4fc;padding:7px 14px;border-radius:20px;font-size:.78rem;font-weight:600;}
.meta-chip i{color:#6366f1;}
.ann-badge{display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,rgba(99,102,241,.15),rgba(139,92,246,.1));border:1px solid rgba(99,102,241,.25);color:#a5b4fc;padding:5px 14px;border-radius:20px;font-size:.75rem;font-weight:700;margin-bottom:16px;}

.detail-title{font-size:1.7rem;font-weight:800;color:#fff;line-height:1.3;margin-bottom:20px;}
.detail-divider{height:1px;background:rgba(255,255,255,.06);margin:24px 0;}
.detail-desc{font-size:.95rem;color:rgba(255,255,255,.65);line-height:1.9;}

/* MORE SECTION */
.more-section h3{font-size:1rem;font-weight:700;color:#fff;margin-bottom:20px;display:flex;align-items:center;gap:9px;}
.more-section h3 i{color:#6366f1;}
.more-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;}
.more-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;transition:all .3s;text-decoration:none;}
.more-card:hover{border-color:rgba(99,102,241,.3);transform:translateY(-3px);}
.more-card img{width:100%;height:130px;object-fit:cover;display:block;}
.more-card-ph{width:100%;height:130px;background:linear-gradient(135deg,rgba(99,102,241,.08),rgba(139,92,246,.04));display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:rgba(99,102,241,.3);}
.more-body{padding:14px;}
.more-title{font-size:.88rem;font-weight:700;color:#fff;margin-bottom:6px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.more-date{font-size:.75rem;color:rgba(255,255,255,.35);display:flex;align-items:center;gap:5px;}
.more-date i{color:#6366f1;}

.footer-bar{position:relative;z-index:10;background:#0a0d14;border-top:1px solid rgba(255,255,255,.06);padding:20px;text-align:center;color:rgba(255,255,255,.3);font-size:.8rem;}
@media(max-width:768px){.nav{padding:0 16px;}.nav-links{display:none;}.detail-title{font-size:1.3rem;}.detail-body{padding:20px;}}
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
      <li><a href="../login.php" class="nav-btn">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

<div class="page">
  <a href="announcement.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Announcements</a>

  <div class="detail-card">
    <?php if(!empty($row['image'])): ?>
      <img src="../<?php echo htmlspecialchars($row['image']);?>" class="detail-img" alt="<?php echo htmlspecialchars($row['title']);?>" onerror="this.style.display='none';this.nextSibling.style.display='flex';">
      <div class="detail-img-placeholder" style="display:none;"><i class="fa fa-image"></i></div>
    <?php else: ?>
      <div class="detail-img-placeholder"><i class="fa fa-bullhorn"></i></div>
    <?php endif; ?>

    <div class="detail-body">
      <div class="ann-badge"><i class="fa fa-bullhorn"></i> Announcement</div>
      <h1 class="detail-title"><?php echo htmlspecialchars($row['title']);?></h1>

      <div class="detail-meta">
        <div class="meta-chip"><i class="fa fa-calendar"></i><?php echo date('d M Y', strtotime($row['declaration_date']));?></div>
        <?php if(!empty($row['last_date'])): ?>
        <div class="meta-chip"><i class="fa fa-clock"></i>Last Date: <?php echo date('d M Y', strtotime($row['last_date']));?></div>
        <?php endif; ?>
        <?php if(!empty($row['start_date'])): ?>
        <div class="meta-chip"><i class="fa fa-calendar-check"></i>Starts: <?php echo date('d M Y', strtotime($row['start_date']));?></div>
        <?php endif; ?>
      </div>

      <div class="detail-divider"></div>
      <div class="detail-desc"><?php echo nl2br(htmlspecialchars($row['description']));?></div>
    </div>
  </div>

  <!-- More Announcements -->
  <?php if($moreQ && mysqli_num_rows($moreQ)>0): ?>
  <div class="more-section">
    <h3><i class="fa fa-layer-group"></i> More Announcements</h3>
    <div class="more-grid">
      <?php while($m=$moreQ->fetch_assoc()): ?>
      <a href="announcement-details.php?id=<?php echo $m['id'];?>" class="more-card">
        <?php if(!empty($m['image'])): ?>
          <img src="../<?php echo htmlspecialchars($m['image']);?>" onerror="this.style.display='none';this.nextSibling.style.display='flex';" alt="">
          <div class="more-card-ph" style="display:none;"><i class="fa fa-bullhorn"></i></div>
        <?php else: ?>
          <div class="more-card-ph"><i class="fa fa-bullhorn"></i></div>
        <?php endif; ?>
        <div class="more-body">
          <div class="more-title"><?php echo htmlspecialchars($m['title']);?></div>
          <div class="more-date"><i class="fa fa-calendar"></i><?php echo date('d M Y',strtotime($m['declaration_date']));?></div>
        </div>
      </a>
      <?php endwhile; ?>
    </div>
  </div>
  <?php endif; ?>
</div>

<footer class="footer-bar">&copy; 2024 Uma Foundation. All Rights Reserved.</footer>
</body>
</html>
