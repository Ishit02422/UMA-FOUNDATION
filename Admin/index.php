<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Login is unsuccessful'); window.location='../login.php';</script>";
    exit;
}
include "../connect.php";

// Stats
$totalUsers = mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM tbl_user WHERE role != 'Not Verified'"))[0] ?? 0;
$pendingVerify = mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM tbl_user WHERE role = 'Not Verified'"))[0] ?? 0;
$totalDonations = mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM tbl_donation"))[0] ?? 0;
$totalBookings = mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM tbl_hall_booking"))[0] ?? 0;
$pendingMember = mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM tbl_community_member_request WHERE status=1"))[0] ?? 0;
$pendingMajor = mysqli_fetch_row(mysqli_query($con,"SELECT COUNT(*) FROM tbl_community_major_request WHERE status=1"))[0] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Dashboard - Uma Foundation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;display:flex;}

/* SIDEBAR */
.sidebar{width:240px;min-height:100vh;background:#0a0d14;border-right:1px solid rgba(255,255,255,.07);display:flex;flex-direction:column;position:fixed;left:0;top:0;bottom:0;z-index:100;}
.sidebar-logo{padding:24px 20px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;gap:10px;}
.logo-icon{width:36px;height:36px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0;}
.logo-text{font-size:1rem;font-weight:800;color:#fff;}
.logo-sub{font-size:.7rem;color:rgba(255,255,255,.3);font-weight:500;}

.sidebar-nav{padding:16px 12px;flex:1;}
.nav-label{font-size:.65rem;font-weight:700;color:rgba(255,255,255,.25);letter-spacing:1px;text-transform:uppercase;padding:8px 8px 4px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:rgba(255,255,255,.5);text-decoration:none;font-size:.86rem;font-weight:500;transition:all .2s;margin-bottom:2px;cursor:pointer;}
.nav-item:hover{background:rgba(255,255,255,.05);color:#fff;}
.nav-item.active{background:rgba(99,102,241,.12);color:#a5b4fc;border:1px solid rgba(99,102,241,.18);}
.nav-item i{width:18px;text-align:center;font-size:.85rem;}

.sidebar-footer{padding:16px 12px;border-top:1px solid rgba(255,255,255,.06);}
.admin-chip{display:flex;align-items:center;gap:10px;padding:10px 12px;background:rgba(255,255,255,.04);border-radius:10px;margin-bottom:8px;}
.admin-avatar{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:.8rem;}
.admin-info{flex:1;}
.admin-name{font-size:.82rem;font-weight:700;color:#fff;}
.admin-role{font-size:.7rem;color:rgba(255,255,255,.3);}
.logout-btn{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:rgba(239,68,68,.7);font-size:.84rem;font-weight:500;text-decoration:none;transition:all .2s;width:100%;}
.logout-btn:hover{background:rgba(239,68,68,.08);color:#ef4444;}

/* MAIN */
.main{margin-left:240px;flex:1;min-height:100vh;}
.topbar{background:rgba(13,17,23,.92);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 32px;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar-title{font-size:1.1rem;font-weight:700;color:#fff;}
.topbar-right{display:flex;align-items:center;gap:12px;}
.badge-pill{display:inline-flex;align-items:center;gap:5px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.2);color:#a5b4fc;padding:5px 12px;border-radius:20px;font-size:.75rem;font-weight:600;}

.page-content{padding:32px;}

/* STAT CARDS */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;margin-bottom:32px;}
.stat-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;padding:22px;display:flex;align-items:center;gap:16px;transition:all .3s;}
.stat-card:hover{border-color:rgba(99,102,241,.25);transform:translateY(-2px);}
.stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;}
.stat-icon.indigo{background:rgba(99,102,241,.12);color:#6366f1;}
.stat-icon.emerald{background:rgba(16,185,129,.12);color:#10b981;}
.stat-icon.amber{background:rgba(251,191,36,.12);color:#fbbf24;}
.stat-icon.red{background:rgba(239,68,68,.12);color:#ef4444;}
.stat-icon.purple{background:rgba(139,92,246,.12);color:#8b5cf6;}
.stat-icon.cyan{background:rgba(6,182,212,.12);color:#06b6d4;}
.stat-num{font-size:1.8rem;font-weight:800;color:#fff;line-height:1;}
.stat-label{font-size:.78rem;color:rgba(255,255,255,.4);margin-top:4px;}

/* SECTION */
.section-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;margin-bottom:24px;}
.section-head{padding:18px 24px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;justify-content:space-between;}
.section-head h3{font-size:.95rem;font-weight:700;color:#fff;display:flex;align-items:center;gap:9px;}
.section-head h3 i{color:#6366f1;}
.count-badge{background:rgba(99,102,241,.12);color:#a5b4fc;padding:3px 10px;border-radius:20px;font-size:.73rem;font-weight:700;}

/* TABLE */
.data-table{width:100%;border-collapse:collapse;}
.data-table th{padding:12px 20px;font-size:.72rem;font-weight:700;color:rgba(255,255,255,.3);text-transform:uppercase;letter-spacing:.5px;text-align:left;border-bottom:1px solid rgba(255,255,255,.05);}
.data-table td{padding:14px 20px;font-size:.86rem;color:rgba(255,255,255,.7);border-bottom:1px solid rgba(255,255,255,.04);}
.data-table tr:last-child td{border-bottom:none;}
.data-table tr:hover td{background:rgba(255,255,255,.02);}

.pill{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:.72rem;font-weight:700;}
.pill-red{background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);}
.pill-blue{background:rgba(59,130,246,.1);color:#93c5fd;border:1px solid rgba(59,130,246,.2);}
.pill-amber{background:rgba(251,191,36,.1);color:#fcd34d;border:1px solid rgba(251,191,36,.2);}

.btn-accept{display:inline-flex;align-items:center;gap:6px;padding:7px 16px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;border:none;border-radius:8px;font-family:'Inter',sans-serif;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .2s;}
.btn-accept:hover{transform:translateY(-1px);box-shadow:0 4px 15px rgba(16,185,129,.3);}
.btn-reject{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:rgba(239,68,68,.08);color:#f87171;border:1px solid rgba(239,68,68,.2);border-radius:8px;font-family:'Inter',sans-serif;font-size:.78rem;font-weight:600;cursor:pointer;transition:all .2s;margin-left:6px;}
.btn-reject:hover{background:rgba(239,68,68,.15);}

.empty-row td{text-align:center;padding:32px;color:rgba(255,255,255,.25);font-size:.85rem;}
.empty-row i{font-size:1.5rem;display:block;margin-bottom:8px;color:rgba(99,102,241,.25);}

/* GRID 2 col */
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:24px;}
@media(max-width:900px){.two-col{grid-template-columns:1fr;}}
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>
    <div>
      <div class="logo-text">Uma Foundation</div>
      <div class="logo-sub">Admin Panel</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-label">Main</div>
    <a href="index.php" class="nav-item active"><i class="fa fa-gauge"></i> Dashboard</a>
    <a href="pages/tables/showscholarship.php" class="nav-item"><i class="fa fa-graduation-cap"></i> Scholarships</a>
    <a href="pages/tables/showdonation.php" class="nav-item"><i class="fa fa-hand-holding-heart"></i> Donations</a>
    <a href="pages/tables/showhallbooking.php" class="nav-item"><i class="fa fa-calendar-check"></i> Hall Bookings</a>

    <div class="nav-label" style="margin-top:12px;">Content</div>
    <a href="pages/tables/showannouncement.php" class="nav-item"><i class="fa fa-bullhorn"></i> Announcements</a>
    <a href="pages/tables/showhallmaster.php" class="nav-item"><i class="fa fa-hotel"></i> Hall Master</a>
    <a href="pages/tables/showannouncementtype.php" class="nav-item"><i class="fa fa-tags"></i> Ann. Types</a>
    <a href="pages/tables/showusers.php" class="nav-item"><i class="fa fa-users"></i> All Users</a>
  </nav>

  <div class="sidebar-footer">
    <div class="admin-chip">
      <div class="admin-avatar"><i class="fa fa-shield"></i></div>
      <div class="admin-info">
        <div class="admin-name">Administrator</div>
        <div class="admin-role">Super Admin</div>
      </div>
    </div>
    <a href="../logout.php" class="logout-btn"><i class="fa fa-right-from-bracket"></i> Logout</a>
  </div>
</aside>

<!-- MAIN -->
<div class="main">
  <div class="topbar">
    <span class="topbar-title"><i class="fa fa-gauge" style="color:#6366f1;margin-right:8px;"></i>Dashboard</span>
    <div class="topbar-right">
      <?php if($pendingVerify > 0): ?>
      <span class="badge-pill"><i class="fa fa-bell"></i><?php echo $pendingVerify;?> pending verifications</span>
      <?php endif; ?>
      <span style="font-size:.82rem;color:rgba(255,255,255,.3);"><?php echo date('d M Y');?></span>
    </div>
  </div>

  <div class="page-content">

    <!-- STATS -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon indigo"><i class="fa fa-users"></i></div>
        <div><div class="stat-num"><?php echo $totalUsers;?></div><div class="stat-label">Total Members</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon red"><i class="fa fa-user-clock"></i></div>
        <div><div class="stat-num"><?php echo $pendingVerify;?></div><div class="stat-label">Pending Verification</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon emerald"><i class="fa fa-hand-holding-heart"></i></div>
        <div><div class="stat-num"><?php echo $totalDonations;?></div><div class="stat-label">Donations</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon amber"><i class="fa fa-building"></i></div>
        <div><div class="stat-num"><?php echo $totalBookings;?></div><div class="stat-label">Hall Bookings</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon purple"><i class="fa fa-users-gear"></i></div>
        <div><div class="stat-num"><?php echo $pendingMember;?></div><div class="stat-label">Member Requests</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon cyan"><i class="fa fa-user-tie"></i></div>
        <div><div class="stat-num"><?php echo $pendingMajor;?></div><div class="stat-label">Major Requests</div></div>
      </div>
    </div>

    <div class="two-col">

      <!-- NOT VERIFIED USERS -->
      <div class="section-card">
        <div class="section-head">
          <h3><i class="fa fa-user-check"></i> Pending Verifications</h3>
          <span class="count-badge"><?php echo $pendingVerify;?> pending</span>
        </div>
        <table class="data-table">
          <thead><tr><th>#</th><th>Name</th><th>Status</th><th>Action</th></tr></thead>
          <tbody>
          <?php
          $q = mysqli_query($con,"SELECT * FROM tbl_user WHERE role = 'Not Verified' LIMIT 20");
          if($q && mysqli_num_rows($q)>0):
            $i=1; while($row=$q->fetch_assoc()):
          ?>
          <tr>
            <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
            <td style="color:#fff;font-weight:600;"><?php echo htmlspecialchars($row['name']);?></td>
            <td><span class="pill pill-red"><i class="fa fa-clock"></i>Not Verified</span></td>
            <td>
              <button class="btn-accept accept-user" data-uid="<?php echo $row['id'];?>"><i class="fa fa-check"></i> Accept</button>
            </td>
          </tr>
          <?php endwhile; else: ?>
          <tr class="empty-row"><td colspan="4"><i class="fa fa-check-circle" style="color:#10b981;"></i>All users verified!</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- COMMITTEE REQUESTS -->
      <div class="section-card">
        <div class="section-head">
          <h3><i class="fa fa-users-gear"></i> Committee Requests</h3>
          <span class="count-badge"><?php echo ($pendingMember+$pendingMajor);?> pending</span>
        </div>
        <table class="data-table">
          <thead><tr><th>Name</th><th>Type</th><th>Action</th></tr></thead>
          <tbody>
          <?php
          // Major requests
          $qm = mysqli_query($con,"SELECT u.id as uid, u.name FROM tbl_community_major_request r JOIN tbl_user u ON r.uid=u.id WHERE r.status=1");
          while($row=$qm->fetch_assoc()):
          ?>
          <tr>
            <td style="color:#fff;font-weight:600;"><?php echo htmlspecialchars($row['name']);?></td>
            <td><span class="pill pill-amber"><i class="fa fa-star"></i>Major</span></td>
            <td>
              <button class="btn-accept accept-request" data-uid="<?php echo $row['uid'];?>" data-role="cMajor"><i class="fa fa-check"></i> Accept</button>
              <button class="btn-reject reject-request" data-uid="<?php echo $row['uid'];?>" data-role="cMajor"><i class="fa fa-times"></i></button>
            </td>
          </tr>
          <?php endwhile;
          // Member requests
          $qmem = mysqli_query($con,"SELECT u.id as uid, u.name FROM tbl_community_member_request r JOIN tbl_user u ON r.uid=u.id WHERE r.status=1");
          while($row=$qmem->fetch_assoc()):
          ?>
          <tr>
            <td style="color:#fff;font-weight:600;"><?php echo htmlspecialchars($row['name']);?></td>
            <td><span class="pill pill-blue"><i class="fa fa-user"></i>Member</span></td>
            <td>
              <button class="btn-accept accept-request" data-uid="<?php echo $row['uid'];?>" data-role="cMember"><i class="fa fa-check"></i> Accept</button>
              <button class="btn-reject reject-request" data-uid="<?php echo $row['uid'];?>" data-role="cMember"><i class="fa fa-times"></i></button>
            </td>
          </tr>
          <?php endwhile; ?>
          <?php if($pendingMember==0 && $pendingMajor==0): ?>
          <tr class="empty-row"><td colspan="3"><i class="fa fa-inbox"></i>No pending requests</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>

    <!-- RECENT DONATIONS -->
    <div class="section-card">
      <div class="section-head">
        <h3><i class="fa fa-hand-holding-heart"></i> Recent Donations</h3>
        <a href="pages/tables/showdonation.php" style="font-size:.78rem;color:#6366f1;text-decoration:none;">View All →</a>
      </div>
      <table class="data-table">
        <thead><tr><th>#</th><th>Name</th><th>Amount</th><th>Transaction ID</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>
        <?php
        $qd = mysqli_query($con,"SELECT * FROM tbl_donation ORDER BY id DESC LIMIT 5");
        if($qd && mysqli_num_rows($qd)>0):
          $i=1; while($row=$qd->fetch_assoc()):
        ?>
        <tr>
          <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
          <td style="color:#fff;font-weight:600;"><?php echo htmlspecialchars($row['name']);?></td>
          <td style="color:#10b981;font-weight:700;">₹<?php echo number_format($row['price']);?></td>
          <td style="font-family:monospace;color:rgba(255,255,255,.4);font-size:.8rem;"><?php echo htmlspecialchars($row['transaction_id'] ?? 'N/A');?></td>
          <td><?php echo date('d M Y', strtotime($row['date'] ?? 'now'));?></td>
          <td><span class="pill pill-blue">Received</span></td>
        </tr>
        <?php endwhile; else: ?>
        <tr class="empty-row"><td colspan="6"><i class="fa fa-inbox"></i>No donations yet</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<script>
// Accept user (verify)
$(document).on('click','.accept-user',function(){
  const uid=$(this).data('uid');
  const row=$(this).closest('tr');
  $.post('../Ajax_file/updateRole.php',{uid:uid},function(res){
    row.fadeOut(400,function(){$(this).remove();});
  });
});

// Accept committee request
$(document).on('click','.accept-request',function(){
  const uid=$(this).data('uid');
  const role=$(this).data('role');
  const row=$(this).closest('tr');
  $.post('../Ajax_file/updateRequest.php',{uid:uid,role:role},function(res){
    row.fadeOut(400,function(){$(this).remove();});
  });
});

// Reject committee request (just remove from pending list)
$(document).on('click','.reject-request',function(){
  if(!confirm('Reject this request?')) return;
  const row=$(this).closest('tr');
  row.fadeOut(300,function(){$(this).remove();});
});
</script>
</body>
</html>