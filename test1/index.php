<?php
session_start();
// Prevent browser from showing stale/blank page via bfcache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include '../connect.php';
function formatDate($d,$f){$dt=new DateTime($d);return $dt->format($f);}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Uma Foundation - Home</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;overflow-x:hidden;}

/* BG */
.glob-bg{position:fixed;inset:0;background:#0d1117;z-index:0;}
.glob-bg::before{content:'';position:absolute;top:-120px;right:-120px;width:600px;height:600px;background:radial-gradient(circle,rgba(99,102,241,.12) 0%,transparent 65%);border-radius:50%;}
.glob-bg::after{content:'';position:absolute;bottom:-100px;left:-100px;width:450px;height:450px;background:radial-gradient(circle,rgba(139,92,246,.08) 0%,transparent 65%);border-radius:50%;}

/* NAV */
.nav{position:fixed;top:0;width:100%;z-index:999;background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 40px;height:64px;display:flex;align-items:center;justify-content:space-between;}
.logo{font-size:1.2rem;font-weight:800;color:#fff;text-decoration:none;display:flex;align-items:center;gap:9px;}
.logo-icon{width:34px;height:34px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;}
.nav-links{display:flex;gap:4px;list-style:none;align-items:center;}
.nav-links a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.86rem;font-weight:500;padding:6px 12px;border-radius:8px;transition:all .2s;}
.nav-links a:hover,.nav-links a.active{color:#fff;background:rgba(255,255,255,.07);}
.dropdown{position:relative;}
.dd-menu{display:none;position:absolute;top:calc(100% + 8px);left:0;background:#161b27;border:1px solid rgba(255,255,255,.08);border-radius:12px;min-width:175px;box-shadow:0 16px 40px rgba(0,0,0,.5);overflow:hidden;}
.dropdown:hover .dd-menu{display:block;}
.dd-menu a{display:block;padding:10px 16px;color:rgba(255,255,255,.6);font-size:.84rem;transition:all .2s;}
.dd-menu a:hover{background:rgba(99,102,241,.1);color:#fff;}
.nav-btn{background:linear-gradient(135deg,#6366f1,#8b5cf6)!important;color:#fff!important;border-radius:8px!important;font-weight:600!important;}
.nav-btn:hover{box-shadow:0 4px 16px rgba(99,102,241,.35)!important;transform:translateY(-1px)!important;}

/* HERO */
.hero{position:relative;z-index:10;min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:100px 20px 80px;}
.hero-content{max-width:720px;}
.hero-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.3);color:#a5b4fc;padding:6px 16px;border-radius:30px;font-size:.78rem;font-weight:600;margin-bottom:24px;letter-spacing:.5px;}
.hero h1{font-size:clamp(2.5rem,6vw,4rem);font-weight:800;line-height:1.15;color:#fff;margin-bottom:20px;}
.hero h1 .accent{background:linear-gradient(135deg,#6366f1,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero p{font-size:1.05rem;color:rgba(255,255,255,.55);line-height:1.8;margin-bottom:36px;max-width:560px;margin-left:auto;margin-right:auto;}
.hero-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}
.btn-primary{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;padding:13px 28px;border-radius:10px;font-weight:700;font-size:.95rem;text-decoration:none;transition:all .3s;display:inline-flex;align-items:center;gap:8px;}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.4);}
.btn-ghost{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.75);padding:13px 28px;border-radius:10px;font-weight:500;font-size:.95rem;text-decoration:none;transition:all .3s;display:inline-flex;align-items:center;gap:8px;}
.btn-ghost:hover{background:rgba(255,255,255,.09);border-color:rgba(255,255,255,.2);color:#fff;}
.hero-stats{display:flex;gap:48px;justify-content:center;margin-top:56px;padding-top:40px;border-top:1px solid rgba(255,255,255,.07);}
.stat .n{font-size:2rem;font-weight:800;color:#fff;}
.stat .l{font-size:.78rem;color:rgba(255,255,255,.4);margin-top:3px;}

/* SECTION */
.section{position:relative;z-index:10;padding:80px 20px;}
.section.alt{background:#0f1117;}
.container{max-width:1160px;margin:0 auto;}
.sec-head{text-align:center;margin-bottom:48px;}
.sec-badge{display:inline-block;background:rgba(99,102,241,.12);color:#a5b4fc;border:1px solid rgba(99,102,241,.25);border-radius:20px;padding:5px 14px;font-size:.74rem;font-weight:700;margin-bottom:12px;letter-spacing:1px;}
.sec-head h2{font-size:2rem;font-weight:800;color:#fff;}
.sec-head p{color:rgba(255,255,255,.45);font-size:.95rem;margin-top:8px;}

/* SERVICE CARDS */
.svc-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(185px,1fr));gap:16px;}
.svc-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;padding:26px 18px;text-align:center;transition:all .3s;text-decoration:none;display:block;}
.svc-card:hover{border-color:rgba(99,102,241,.4);transform:translateY(-5px);box-shadow:0 12px 30px rgba(99,102,241,.1);}
.svc-icon{width:52px;height:52px;background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(139,92,246,.2));border:1px solid rgba(99,102,241,.2);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.2rem;color:#a5b4fc;transition:all .3s;}
.svc-card:hover .svc-icon{background:linear-gradient(135deg,#6366f1,#8b5cf6);border-color:transparent;color:#fff;}
.svc-card h4{font-size:.95rem;font-weight:700;color:#fff;margin-bottom:7px;}
.svc-card p{font-size:.8rem;color:rgba(255,255,255,.4);line-height:1.6;}

/* ANN SECTION */
.ann-grid{display:grid;grid-template-columns:250px 1fr;gap:24px;align-items:start;}
.ann-sidebar{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;padding:20px;}
.ann-sidebar h3{font-size:.9rem;font-weight:700;color:#a5b4fc;margin-bottom:14px;display:flex;align-items:center;gap:7px;}
.ann-list{list-style:none;}
.ann-list li{padding:8px 0;border-bottom:1px solid rgba(255,255,255,.04);}
.ann-list li:last-child{border:none;}
.ann-list a{color:rgba(255,255,255,.55);text-decoration:none;font-size:.83rem;display:flex;align-items:center;gap:7px;transition:color .2s;}
.ann-list a:hover{color:#a5b4fc;}
.ann-list a::before{content:'›';color:#6366f1;font-size:1rem;font-weight:700;}
.view-all{display:inline-flex;align-items:center;gap:6px;margin-top:14px;background:rgba(99,102,241,.1);color:#a5b4fc;padding:8px 16px;border-radius:8px;font-size:.8rem;font-weight:600;text-decoration:none;transition:all .3s;border:1px solid rgba(99,102,241,.2);}
.view-all:hover{background:rgba(99,102,241,.2);color:#fff;}
.ann-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px;}
.ann-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;transition:all .3s;}
.ann-card:hover{border-color:rgba(99,102,241,.35);box-shadow:0 8px 24px rgba(99,102,241,.08);}
.ann-card img{width:100%;height:135px;object-fit:cover;opacity:.85;}
.ann-body{padding:14px 16px;}
.ann-date{font-size:.72rem;color:#a5b4fc;font-weight:700;margin-bottom:5px;}
.ann-card h4{font-size:.9rem;font-weight:700;color:#fff;margin-bottom:5px;}
.ann-card p{font-size:.78rem;color:rgba(255,255,255,.4);line-height:1.6;}

/* STATS */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-top:48px;}
.stat-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:24px 16px;text-align:center;}
.stat-card .n{font-size:2.2rem;font-weight:800;background:linear-gradient(135deg,#a5b4fc,#c4b5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.stat-card .l{font-size:.82rem;color:rgba(255,255,255,.4);margin-top:5px;}

/* CONTACT */
.contact-grid{display:grid;grid-template-columns:1fr 290px;gap:32px;align-items:start;}
.contact-box{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;padding:28px;}
.contact-box h3{font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:20px;}
.cf-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;}
.cf-inp{width:100%;padding:11px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:10px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.87rem;outline:none;transition:all .3s;}
.cf-inp::placeholder{color:rgba(255,255,255,.22);}
.cf-inp:focus{border-color:#6366f1;background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.12);}
.ci-item{display:flex;gap:12px;margin-bottom:16px;align-items:flex-start;}
.ci-icon{width:36px;height:36px;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.2);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#a5b4fc;font-size:.85rem;flex-shrink:0;}
.ci-item h6{font-size:.73rem;color:rgba(255,255,255,.4);margin-bottom:2px;}
.ci-item span,.ci-item a{font-size:.85rem;color:rgba(255,255,255,.7);}

/* FOOTER */
.footer-bar{position:relative;z-index:10;background:#0a0d14;border-top:1px solid rgba(255,255,255,.06);padding:24px 40px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:14px;}
.footer-logo{font-size:1.1rem;font-weight:800;color:#fff;display:flex;align-items:center;gap:8px;}
.footer-logo span{color:#a5b4fc;}
.footer-bar p{font-size:.8rem;color:rgba(255,255,255,.3);}
.footer-links{display:flex;gap:16px;}
.footer-links a{color:rgba(255,255,255,.35);font-size:.8rem;text-decoration:none;transition:color .2s;}
.footer-links a:hover{color:#a5b4fc;}

.scroll-top{position:fixed;bottom:24px;right:24px;width:40px;height:40px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;font-size:.9rem;box-shadow:0 4px 16px rgba(99,102,241,.4);transition:all .3s;z-index:999;}
.scroll-top:hover{transform:scale(1.1);}

@media(max-width:900px){.ann-grid,.contact-grid{grid-template-columns:1fr;}.nav-links{display:none;}.hero-stats{gap:24px;}}
@media(max-width:600px){.cf-row{grid-template-columns:1fr;}.stats-grid{grid-template-columns:1fr 1fr;}}
</style>
</head>
<body>
<div class="glob-bg"></div>

<!-- NAV -->
<nav class="nav">
  <a href="#" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
  <ul class="nav-links">
    <li><a href="#" class="active">Home</a></li>
    <li><a href="hallbooking.php">Hall Booking</a></li>
    <li><a href="donationform.php">Donation</a></li>
    <li class="dropdown">
      <a href="#">Announcement <i class="fa fa-chevron-down" style="font-size:.6rem;margin-left:3px"></i></a>
      <div class="dd-menu">
        <a href="announcement.php"><i class="fa fa-calendar" style="margin-right:7px;color:#a5b4fc"></i>Events</a>
        <a href="scholarship.php"><i class="fa fa-graduation-cap" style="margin-right:7px;color:#a5b4fc"></i>Scholarship</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="#">Apply <i class="fa fa-chevron-down" style="font-size:.6rem;margin-left:3px"></i></a>
      <div class="dd-menu">
        <a href="request.php"><i class="fa fa-users" style="margin-right:7px;color:#a5b4fc"></i>Committee Member</a>
        <a href="request.php"><i class="fa fa-user-tie" style="margin-right:7px;color:#a5b4fc"></i>Committee Major</a>
      </div>
    </li>
    <?php if(isset($_SESSION['id'])): ?>
      <li><a href="../Ajax_file/profile.php">Profile</a></li>
      <li><a href="../logout.php" class="nav-btn">Logout</a></li>
    <?php else: ?>
      <li><a href="../Registration.php">Register</a></li>
      <li><a href="../login.php" class="nav-btn">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-content">
    <div class="hero-badge"><i class="fa fa-star"></i>Uma Foundation &mdash; Serving Since 2014</div>
    <h1>Manage Your Community<br>with <span class="accent">Smart Tools.</span></h1>
    <p>An all-in-one digital platform for events, scholarships, hall bookings, donations, and community management — all in one place.</p>
    <div class="hero-btns">
      <?php if(isset($_SESSION['id'])): ?>
        <a href="../Ajax_file/profile.php" class="btn-primary"><i class="fa fa-user"></i>My Profile</a>
        <a href="request.php" class="btn-ghost"><i class="fa fa-paper-plane"></i>Apply Now</a>
      <?php else: ?>
        <a href="../Registration.php" class="btn-primary"><i class="fa fa-user-plus"></i>Get Started — Free</a>
        <a href="../login.php" class="btn-ghost"><i class="fa fa-right-to-bracket"></i>Sign In</a>
      <?php endif; ?>
    </div>
    <div class="hero-stats">
      <div class="stat"><div class="n">500+</div><div class="l">Members</div></div>
      <div class="stat"><div class="n">50+</div><div class="l">Events</div></div>
      <div class="stat"><div class="n">₹10L+</div><div class="l">Donations</div></div>
      <div class="stat"><div class="n">10+</div><div class="l">Years</div></div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="section alt" id="services">
  <div class="container">
    <div class="sec-head">
      <div class="sec-badge">SERVICES</div>
      <h2>Everything Your Community Needs</h2>
      <p>Comprehensive digital tools for every community activity</p>
    </div>
    <div class="svc-grid">
      <a href="hallbooking.php" class="svc-card"><div class="svc-icon"><i class="fa fa-building"></i></div><h4>Hall Booking</h4><p>Book community halls for events and gatherings easily online.</p></a>
      <a href="donationform.php" class="svc-card"><div class="svc-icon"><i class="fa fa-heart"></i></div><h4>Donation</h4><p>Contribute to community welfare and support those in need.</p></a>
      <a href="announcement.php" class="svc-card"><div class="svc-icon"><i class="fa fa-bullhorn"></i></div><h4>Announcements</h4><p>Stay updated with latest events and news from Uma Foundation.</p></a>
      <a href="scholarship.php" class="svc-card"><div class="svc-icon"><i class="fa fa-graduation-cap"></i></div><h4>Scholarship</h4><p>Financial support for deserving students in our community.</p></a>
      <a href="request.php" class="svc-card"><div class="svc-icon"><i class="fa fa-users"></i></div><h4>Committee Apply</h4><p>Apply to become a committee member or major.</p></a>
    </div>
  </div>
</section>

<!-- ANNOUNCEMENTS -->
<section class="section" id="events">
  <div class="container">
    <div class="sec-head">
      <div class="sec-badge">LATEST</div>
      <h2>Upcoming Events</h2>
      <p>Stay connected with our community activities</p>
    </div>
    <div class="ann-grid">
      <div class="ann-sidebar">
        <h3><i class="fa fa-list-ul"></i>Quick List</h3>
        <ul class="ann-list">
          <?php $q="SELECT * FROM tbl_announcement WHERE status=1 ORDER BY id DESC LIMIT 10"; $r=mysqli_query($con,$q); while($row=mysqli_fetch_assoc($r)):?>
          <li><a href="announcement.php"><?php echo htmlspecialchars($row['title']);?></a></li>
          <?php endwhile;?>
        </ul>
        <a href="announcement.php" class="view-all"><i class="fa fa-arrow-right"></i>View All</a>
      </div>
      <div class="ann-cards">
        <?php $q2="SELECT * FROM tbl_announcement WHERE status=1 ORDER BY id DESC LIMIT 4"; $r2=mysqli_query($con,$q2); while($row=mysqli_fetch_assoc($r2)): $d=!empty($row['from_date'])?date('d M Y',strtotime($row['from_date'])):'';?>
        <div class="ann-card">
          <?php if(!empty($row['image'])):?><img src="../<?php echo $row['image'];?>" alt="" onerror="this.style.display='none'"><?php endif;?>
          <div class="ann-body">
            <?php if($d):?><div class="ann-date"><i class="fa fa-calendar" style="margin-right:4px"></i><?php echo $d;?></div><?php endif;?>
            <h4><?php echo htmlspecialchars($row['title']);?></h4>
            <p><?php echo htmlspecialchars(substr($row['description'],0,90)).(strlen($row['description'])>90?'...':'');?></p>
          </div>
        </div>
        <?php endwhile;?>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="section alt">
  <div class="container">
    <div class="sec-head">
      <div class="sec-badge">IMPACT</div>
      <h2>Uma Foundation in Numbers</h2>
      <p>Making a lasting difference every day</p>
    </div>
    <div class="stats-grid">
      <div class="stat-card"><div class="n">500+</div><div class="l">Community Members</div></div>
      <div class="stat-card"><div class="n">94%</div><div class="l">Satisfaction Rate</div></div>
      <div class="stat-card"><div class="n">₹10L+</div><div class="l">Donations Collected</div></div>
      <div class="stat-card"><div class="n">50+</div><div class="l">Events Organized</div></div>
      <div class="stat-card"><div class="n">100+</div><div class="l">Scholarships Given</div></div>
      <div class="stat-card"><div class="n">10+</div><div class="l">Years of Service</div></div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="section" id="contact">
  <div class="container">
    <div class="sec-head">
      <div class="sec-badge">CONTACT</div>
      <h2>Get In Touch</h2>
      <p>We'd love to hear from you</p>
    </div>
    <div class="contact-grid">
      <div class="contact-box">
        <h3><i class="fa fa-envelope" style="color:#a5b4fc;margin-right:8px"></i>Send a Message</h3>
        <form>
          <div class="cf-row">
            <input class="cf-inp" type="text" placeholder="Your Name">
            <input class="cf-inp" type="email" placeholder="Your Email">
          </div>
          <input class="cf-inp" type="text" placeholder="Subject" style="width:100%;margin-bottom:12px;">
          <textarea class="cf-inp" style="min-height:100px;resize:vertical;margin-bottom:14px;" placeholder="Your message..."></textarea>
          <button type="submit" class="btn-primary" style="border:none;font-family:'Inter',sans-serif;"><i class="fa fa-paper-plane"></i>Send Message</button>
        </form>
      </div>
      <div class="contact-box">
        <h3>Contact Info</h3>
        <div class="ci-item"><div class="ci-icon"><i class="fa fa-phone"></i></div><div><h6>Phone</h6><span>+91 79 2630 1234</span></div></div>
        <div class="ci-item"><div class="ci-icon"><i class="fa fa-envelope"></i></div><div><h6>Email</h6><span>info@umafoundation.org</span></div></div>
        <div class="ci-item"><div class="ci-icon"><i class="fa fa-location-dot"></i></div><div><h6>Address</h6><span>Jaspur, Ahmedabad - 382421, Gujarat, India</span></div></div>
        <div class="ci-item"><div class="ci-icon"><i class="fa fa-globe"></i></div><div><h6>Website</h6><a href="https://uma-foundation.onrender.com" style="color:#a5b4fc;">uma-foundation.onrender.com</a></div></div>
      </div>
    </div>
  </div>
</section>

<footer class="footer-bar">
  <div class="footer-logo"><i class="fa fa-graduation-cap" style="color:#6366f1"></i>Uma <span>Foundation</span></div>
  <p>&copy; 2024 Uma Foundation. All Rights Reserved.</p>
  <div class="footer-links"><a href="#">Privacy</a><a href="#">Terms</a><a href="#contact">Contact</a></div>
</footer>

<a href="#home" class="scroll-top"><i class="fa fa-arrow-up"></i></a>

<script>
const obs=new IntersectionObserver(entries=>entries.forEach((e,i)=>{if(e.isIntersecting){setTimeout(()=>{e.target.style.opacity='1';e.target.style.transform='translateY(0)';},i*70);}}),{threshold:.1});
document.querySelectorAll('.svc-card,.ann-card,.stat-card').forEach(el=>{el.style.opacity='0';el.style.transform='translateY(20px)';el.style.transition='opacity .5s ease,transform .5s ease';obs.observe(el);});
window.addEventListener('scroll',()=>{const n=document.querySelector('.nav');n.style.background=window.scrollY>40?'rgba(13,17,23,.98)':'rgba(13,17,23,.92)';});

document.querySelector('.contact-box form')?.addEventListener('submit', function(e){
  e.preventDefault();
  alert('Thank you! Your message has been sent successfully. We will get back to you soon.');
  this.reset();
});
</script>
</body>
</html>