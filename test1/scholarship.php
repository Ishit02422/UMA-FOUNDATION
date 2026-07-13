<?php
session_start();
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Scholarships - Uma Foundation</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #0d1117; color: #e6edf3; }

    /* ===== NAVBAR ===== */
    .navbar {
      position: fixed; top: 0; width: 100%; z-index: 1000;
      background: rgba(13,17,23,0.92);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.07);
      padding: 0 40px; height: 64px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .navbar .logo { font-size: 1.2rem; font-weight: 800; color: #fff; text-decoration: none; display:flex; align-items:center; gap:9px; }
    .navbar .logo-icon { width:32px; height:32px; background:linear-gradient(135deg,#6366f1,#8b5cf6); border-radius:8px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:.85rem; }
    .nav-links { display: flex; gap: 4px; list-style: none; align-items:center; }
    .nav-links a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.86rem; font-weight: 500; padding:6px 12px; border-radius:8px; transition: all 0.2s; }
    .nav-links a:hover, .nav-links a.active { color: #fff; background: rgba(255,255,255,0.07); }
    .nav-btn { background: linear-gradient(135deg,#6366f1,#8b5cf6) !important; color: #fff !important; padding: 7px 18px; border-radius: 8px; font-weight: 600 !important; }

    /* ===== HERO ===== */
    .hero {
      min-height: 100vh;
      background: #0d1117;
      display: flex; align-items: center; justify-content: center;
      position: relative; overflow: hidden; text-align: center;
      padding: 100px 20px 60px;
    }
    .hero::before { content:''; position:absolute; top:-100px; right:-100px; width:550px; height:550px; background:radial-gradient(circle,rgba(99,102,241,.15) 0%,transparent 65%); border-radius:50%; }
    .hero::after { content:''; position:absolute; bottom:-80px; left:-80px; width:400px; height:400px; background:radial-gradient(circle,rgba(139,92,246,.08) 0%,transparent 65%); border-radius:50%; }
    .floating-shapes { display:none; }
    .hero-content { position: relative; z-index: 2; max-width: 700px; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.3);
      color: #a5b4fc; padding: 6px 18px; border-radius: 30px; font-size: 0.78rem; font-weight: 600; letter-spacing:.5px;
      margin-bottom: 24px;
    }
    .hero h1 {
      font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.15; color:#fff;
      margin-bottom: 18px;
    }
    .hero h1 .accent { background: linear-gradient(135deg,#6366f1,#a78bfa); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
    .hero p { font-size: 1rem; color: rgba(255,255,255,0.5); margin-bottom: 40px; line-height:1.8; max-width:540px; margin-left:auto; margin-right:auto; }
    .hero-stats { display: flex; gap: 48px; justify-content: center; padding-top:32px; border-top:1px solid rgba(255,255,255,0.07); }
    .stat-item { text-align: center; }
    .stat-num { font-size: 2rem; font-weight: 800; color: #fff; }
    .stat-label { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-top:3px; }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* ===== CARDS SECTION ===== */
    .section { padding: 80px 20px; background: #0f1117; }
    .section-header { text-align: center; margin-bottom: 52px; }
    .section-header .tag {
      display: inline-block; background: rgba(99,102,241,0.12); color: #a5b4fc;
      border: 1px solid rgba(99,102,241,0.25); border-radius: 20px;
      padding: 5px 16px; font-size: 0.74rem; font-weight: 700; margin-bottom: 14px; letter-spacing: 1px;
    }
    .section-header h2 { font-size: 2rem; font-weight: 800; color: #fff; }
    .section-header p { color: rgba(255,255,255,0.45); font-size: 0.95rem; margin-top: 8px; }
    .container { max-width: 1160px; margin: 0 auto; }
    .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; }
    .scholarship-card {
      background: #161b27; border: 1px solid rgba(255,255,255,0.07);
      border-radius: 16px; padding: 28px; position: relative; overflow: hidden;
      transition: all 0.3s;
    }
    .scholarship-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg,#6366f1,#a78bfa); opacity: 0; transition: opacity 0.3s;
    }
    .scholarship-card:hover { transform: translateY(-5px); border-color: rgba(99,102,241,0.35); box-shadow: 0 16px 48px rgba(99,102,241,0.1); }
    .scholarship-card:hover::before { opacity: 1; }
    .card-icon {
      width: 52px; height: 52px; border-radius: 13px; display: flex; align-items: center; justify-content: center;
      background: linear-gradient(135deg,rgba(99,102,241,0.2),rgba(139,92,246,0.2)); border:1px solid rgba(99,102,241,0.2);
      font-size: 1.3rem; color: #a5b4fc; margin-bottom: 18px; transition:all 0.3s;
    }
    .scholarship-card:hover .card-icon { background:linear-gradient(135deg,#6366f1,#8b5cf6); border-color:transparent; color:#fff; }
    .card-tag { display: inline-block; background: rgba(99,102,241,0.1); color: #a5b4fc; border-radius: 10px; padding: 3px 12px; font-size: 0.73rem; font-weight: 700; margin-bottom: 12px; }
    .card-title { font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 10px; }
    .card-desc { color: rgba(255,255,255,0.5); font-size: 0.87rem; line-height: 1.7; margin-bottom: 18px; }
    .card-meta { display: flex; flex-direction: column; gap: 7px; margin-bottom: 20px; }
    .meta-row { display: flex; align-items: center; gap: 9px; font-size: 0.82rem; color: rgba(255,255,255,0.45); }
    .meta-row i { color: #6366f1; width: 15px; }
    .card-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    .btn-primary-gold {
      flex: 1; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff;
      border: none; border-radius: 10px; padding: 10px 18px; font-size: 0.87rem; font-weight: 700;
      cursor: pointer; text-decoration: none; text-align: center; transition: all 0.3s;
      display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-primary-gold:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.35); }
    .btn-outline {
      background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.7);
      border-radius: 10px; padding: 10px 16px; font-size: 0.87rem; font-weight: 500;
      cursor: pointer; text-decoration: none; text-align: center; transition: all 0.3s;
      display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-outline:hover { border-color: rgba(99,102,241,0.4); color: #a5b4fc; }

    /* ===== EMPTY STATE ===== */
    .empty-state { text-align: center; padding: 70px 20px; background: #161b27; border: 1px solid rgba(255,255,255,0.07); border-radius: 20px; grid-column: 1/-1; }
    .empty-icon { width: 80px; height: 80px; background: rgba(99,102,241,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #a5b4fc; margin: 0 auto 20px; }
    .empty-state h3 { font-size: 1.4rem; color: #fff; margin-bottom: 8px; }
    .empty-state p { color: rgba(255,255,255,0.45); font-size: 0.9rem; }

    /* ===== HOW IT WORKS ===== */
    .steps-section { padding: 80px 20px; background: #0d1117; }
    .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 48px; }
    .step-card { text-align: center; padding: 28px 20px; background:#161b27; border:1px solid rgba(255,255,255,0.07); border-radius:14px; transition:all 0.3s; }
    .step-card:hover { border-color:rgba(99,102,241,0.35); transform:translateY(-4px); }
    .step-num { width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg,#6366f1,#8b5cf6); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 800; color: #fff; margin: 0 auto 18px; }
    .step-card h4 { font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 8px; }
    .step-card p { font-size: 0.83rem; color: rgba(255,255,255,0.45); line-height: 1.6; }

    /* ===== FOOTER ===== */
    .footer-bar { background: #0a0d14; text-align: center; padding: 22px; color: rgba(255,255,255,0.35); font-size: 0.82rem; border-top: 1px solid rgba(255,255,255,0.06); }
    .footer-bar span { color: #a5b4fc; }

    /* ===== SCROLL TO TOP ===== */
    .scroll-top { position: fixed; bottom: 24px; right: 24px; width: 40px; height: 40px; background: linear-gradient(135deg,#6366f1,#8b5cf6); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 0.9rem; box-shadow: 0 4px 16px rgba(99,102,241,0.4); transition: transform 0.3s; }
    .scroll-top:hover { transform: scale(1.1); }

    @media (max-width: 768px) {
      .navbar { padding: 0 20px; }
      .nav-links { display: none; }
      .cards-grid { grid-template-columns: 1fr; }
      .hero-stats { gap: 25px; }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="index.php" class="logo"><div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>Uma Foundation</a>
  <ul class="nav-links">
    <li><a href="../index.php">Home</a></li>
    <li><a href="hallbooking.php">Hall Booking</a></li>
    <li><a href="donationform.php">Donation</a></li>
    <li><a href="announcement.php">Events</a></li>
    <li><a href="scholarship.php" class="active">Scholarship</a></li>
    <?php if (isset($_SESSION["id"])) { ?>
      <li><a href="../logout.php" class="nav-btn">Logout</a></li>
    <?php } else { ?>
      <li><a href="../login.php" class="nav-btn">Login</a></li>
    <?php } ?>
  </ul>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  <div class="hero-content">
    <div class="hero-badge"><i class="fa fa-star"></i> Uma Foundation Scholarship Program</div>
    <h1>Empowering Bright<br>Futures Through<br>Education</h1>
    <p>Uma Foundation is committed to supporting deserving students in our community with financial assistance and scholarships.</p>
    <div class="hero-stats">
      <div class="stat-item">
        <div class="stat-num">100+</div>
        <div class="stat-label">Students Supported</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">₹5L+</div>
        <div class="stat-label">Scholarships Given</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">10+</div>
        <div class="stat-label">Years of Service</div>
      </div>
    </div>
  </div>
</section>

<!-- SCHOLARSHIP CARDS -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="tag">OPEN SCHOLARSHIPS</div>
      <h2>Available Opportunities</h2>
      <p>Apply now before the deadline closes</p>
    </div>
    <div class="cards-grid">
    <?php
      $query = "SELECT a.*, at.type_name FROM tbl_announcement a
                LEFT JOIN tbl_announcement_type at ON a.type_id = at.id
                WHERE at.type_name LIKE '%Scholar%'
                ORDER BY a.declaration_date DESC";
      $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);

      if ($count > 0):
        $icons = ['fa-award', 'fa-medal', 'fa-trophy', 'fa-star', 'fa-graduation-cap'];
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)):
          $fromDate = !empty($row['from_date']) ? date('d M Y', strtotime($row['from_date'])) : 'N/A';
          $toDate = !empty($row['to_date']) ? date('d M Y', strtotime($row['to_date'])) : 'N/A';
          $declDate = !empty($row['declaration_date']) ? date('d M Y', strtotime($row['declaration_date'])) : 'N/A';
          $icon = $icons[$i % count($icons)]; $i++;
    ?>
      <div class="scholarship-card">
        <div class="card-icon"><i class="fa <?php echo $icon; ?>"></i></div>
        <span class="card-tag">Scholarship</span>
        <div class="card-title"><?php echo htmlspecialchars($row['title']); ?></div>
        <div class="card-desc"><?php echo htmlspecialchars($row['description']); ?></div>
        <div class="card-meta">
          <div class="meta-row"><i class="fa fa-calendar-alt"></i> Announced: <?php echo $declDate; ?></div>
          <div class="meta-row"><i class="fa fa-clock"></i> Apply By: <?php echo $toDate; ?></div>
          <div class="meta-row"><i class="fa fa-calendar-check"></i> From: <?php echo $fromDate; ?></div>
        </div>
        <div class="card-actions">
          <?php if (isset($_SESSION['id'])): ?>
            <a href="scholarship_apply.php?id=<?php echo $row['id']; ?>" class="btn-primary-gold">
              <i class="fa fa-paper-plane"></i> Apply Now
            </a>
          <?php else: ?>
            <a href="../login.php" class="btn-primary-gold">
              <i class="fa fa-sign-in-alt"></i> Login to Apply
            </a>
          <?php endif; ?>
          <?php if (!empty($row['form'])): ?>
          <a href="scholarship_apply.php?id=<?php echo $row['id']; ?>" class="btn-outline" target="_blank">
              <i class="fa fa-file-pen"></i> Form
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; else: ?>
      <div class="empty-state">
        <div class="empty-icon"><i class="fa fa-graduation-cap"></i></div>
        <h3>No Scholarships Available Right Now</h3>
        <p>New scholarship announcements will appear here. Check back soon or contact Uma Foundation for more info.</p>
      </div>
    <?php endif; ?>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="steps-section">
  <div class="container">
    <div class="section-header">
      <div class="tag">PROCESS</div>
      <h2>How to Apply</h2>
      <p>Simple 4-step process to get your scholarship</p>
    </div>
    <div class="steps-grid">
      <div class="step-card">
        <div class="step-num">1</div>
        <h4>Register & Login</h4>
        <p>Create your account on Uma Foundation portal and complete your profile.</p>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <h4>Browse Scholarships</h4>
        <p>Find the scholarship that matches your education level and needs.</p>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <h4>Submit Application</h4>
        <p>Fill in the application form and upload required documents online.</p>
      </div>
      <div class="step-card">
        <div class="step-num">4</div>
        <h4>Get Notified</h4>
        <p>Committee reviews your application and you'll be notified of the result.</p>
      </div>
    </div>
  </div>
</section>

<div class="footer-bar">
  &copy; 2024 <span>Uma Foundation</span>. All Rights Reserved. | Empowering Communities Through Education.
</div>

<a href="#" class="scroll-top"><i class="fa fa-arrow-up"></i></a>

<script>
  // Scroll animation
  const cards = document.querySelectorAll('.scholarship-card, .step-card');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) {
        setTimeout(() => {
          e.target.style.opacity = '1';
          e.target.style.transform = 'translateY(0)';
        }, i * 80);
      }
    });
  }, { threshold: 0.1 });

  cards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(card);
  });
</script>
</body>
</html>
