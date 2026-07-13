<?php
// admin_head.php — Shared SmartNoter admin layout
// Usage: include at top of each admin page
// $pageTitle — set before including this file
// $activePage — 'donations','scholarships','announcements','halls','users','dashboard'
if(!isset($pageTitle)) $pageTitle = 'Admin';
if(!isset($activePage)) $activePage = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo $pageTitle;?> - Uma Foundation Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#e6edf3;min-height:100vh;display:flex;}

/* SIDEBAR */
.sidebar{width:240px;min-height:100vh;background:#0a0d14;border-right:1px solid rgba(255,255,255,.07);display:flex;flex-direction:column;position:fixed;left:0;top:0;bottom:0;z-index:100;overflow-y:auto;}
.sidebar-logo{padding:22px 20px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;gap:10px;flex-shrink:0;}
.logo-icon{width:36px;height:36px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0;}
.logo-text{font-size:1rem;font-weight:800;color:#fff;}
.logo-sub{font-size:.7rem;color:rgba(255,255,255,.3);font-weight:500;}

.sidebar-nav{padding:16px 12px;flex:1;}
.nav-label{font-size:.65rem;font-weight:700;color:rgba(255,255,255,.25);letter-spacing:1px;text-transform:uppercase;padding:8px 8px 4px;margin-top:4px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:rgba(255,255,255,.5);text-decoration:none;font-size:.86rem;font-weight:500;transition:all .2s;margin-bottom:2px;}
.nav-item:hover{background:rgba(255,255,255,.05);color:#fff;}
.nav-item.active{background:rgba(99,102,241,.12);color:#a5b4fc;border:1px solid rgba(99,102,241,.18);}
.nav-item i{width:18px;text-align:center;font-size:.85rem;flex-shrink:0;}

.sidebar-footer{padding:16px 12px;border-top:1px solid rgba(255,255,255,.06);flex-shrink:0;}
.admin-chip{display:flex;align-items:center;gap:10px;padding:10px 12px;background:rgba(255,255,255,.04);border-radius:10px;margin-bottom:8px;}
.admin-avatar{width:32px;height:32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:.8rem;flex-shrink:0;}
.admin-info{flex:1;min-width:0;}
.admin-name{font-size:.82rem;font-weight:700;color:#fff;}
.admin-role{font-size:.7rem;color:rgba(255,255,255,.3);}
.logout-btn{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:rgba(239,68,68,.7);font-size:.84rem;font-weight:500;text-decoration:none;transition:all .2s;width:100%;}
.logout-btn:hover{background:rgba(239,68,68,.08);color:#ef4444;}

/* MAIN */
.main{margin-left:240px;flex:1;min-height:100vh;display:flex;flex-direction:column;}
.topbar{background:rgba(13,17,23,.95);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07);padding:0 32px;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar-left{display:flex;align-items:center;gap:12px;}
.topbar-back{display:flex;align-items:center;gap:7px;color:rgba(255,255,255,.4);text-decoration:none;font-size:.82rem;transition:color .2s;}
.topbar-back:hover{color:#a5b4fc;}
.topbar-title{font-size:1.05rem;font-weight:700;color:#fff;}
.topbar-right{display:flex;align-items:center;gap:10px;}
.topbar-date{font-size:.78rem;color:rgba(255,255,255,.3);}

.page-content{padding:28px 32px;flex:1;}

/* PAGE HEADER */
.page-hdr{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}
.page-hdr h2{font-size:1.3rem;font-weight:800;color:#fff;display:flex;align-items:center;gap:10px;}
.page-hdr h2 i{color:#6366f1;}
.page-hdr-right{display:flex;gap:10px;}

/* SECTION CARD */
.section-card{background:#161b27;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;}
.section-head{padding:16px 24px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;justify-content:space-between;}
.section-head h3{font-size:.92rem;font-weight:700;color:#fff;display:flex;align-items:center;gap:8px;}
.section-head h3 i{color:#6366f1;}
.count-pill{background:rgba(99,102,241,.1);color:#a5b4fc;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:700;}

/* TABLE */
.admin-table{width:100%;border-collapse:collapse;}
.admin-table th{padding:11px 16px;font-size:.7rem;font-weight:700;color:rgba(255,255,255,.28);text-transform:uppercase;letter-spacing:.5px;text-align:left;border-bottom:1px solid rgba(255,255,255,.05);white-space:nowrap;}
.admin-table td{padding:13px 16px;font-size:.84rem;color:rgba(255,255,255,.65);border-bottom:1px solid rgba(255,255,255,.04);vertical-align:middle;}
.admin-table tr:last-child td{border-bottom:none;}
.admin-table tr:hover td{background:rgba(255,255,255,.02);}
.admin-table td.name{color:#fff;font-weight:600;}
.admin-table td.mono{font-family:monospace;font-size:.78rem;color:rgba(255,255,255,.35);}
.admin-table td.amount{color:#10b981;font-weight:700;}

/* PILLS */
.pill{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:.7rem;font-weight:700;white-space:nowrap;}
.pill-green{background:rgba(16,185,129,.1);color:#6ee7b7;border:1px solid rgba(16,185,129,.2);}
.pill-red{background:rgba(239,68,68,.1);color:#fca5a5;border:1px solid rgba(239,68,68,.2);}
.pill-amber{background:rgba(251,191,36,.1);color:#fcd34d;border:1px solid rgba(251,191,36,.2);}
.pill-blue{background:rgba(99,102,241,.1);color:#a5b4fc;border:1px solid rgba(99,102,241,.2);}
.pill-purple{background:rgba(139,92,246,.1);color:#c4b5fd;border:1px solid rgba(139,92,246,.2);}
.pill-cyan{background:rgba(6,182,212,.1);color:#67e8f9;border:1px solid rgba(6,182,212,.2);}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;font-family:'Inter',sans-serif;font-size:.78rem;font-weight:700;cursor:pointer;border:none;transition:all .2s;text-decoration:none;}
.btn:hover{transform:translateY(-1px);}
.btn-primary{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;}
.btn-primary:hover{box-shadow:0 4px 15px rgba(99,102,241,.4);}
.btn-success{background:linear-gradient(135deg,#10b981,#059669);color:#fff;}
.btn-success:hover{box-shadow:0 4px 15px rgba(16,185,129,.3);}
.btn-danger{background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);}
.btn-danger:hover{background:rgba(239,68,68,.18);}
.btn-warning{background:rgba(251,191,36,.1);color:#fcd34d;border:1px solid rgba(251,191,36,.2);}
.btn-warning:hover{background:rgba(251,191,36,.18);}
.btn-sm{padding:5px 10px;font-size:.72rem;}
.btn-icon{padding:6px;width:30px;height:30px;justify-content:center;}

/* SEARCH BAR */
.search-bar{display:flex;align-items:center;gap:10px;padding:16px 24px;border-bottom:1px solid rgba(255,255,255,.05);}
.search-input{flex:1;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);border-radius:8px;padding:9px 14px 9px 36px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.84rem;outline:none;transition:all .3s;}
.search-input:focus{border-color:#6366f1;background:rgba(99,102,241,.06);}
.search-input::placeholder{color:rgba(255,255,255,.25);}
.search-icon{position:relative;flex:1;display:flex;align-items:center;}
.search-icon i{position:absolute;left:10px;color:rgba(255,255,255,.25);font-size:.82rem;pointer-events:none;}

/* EMPTY STATE */
.empty-state{text-align:center;padding:48px 24px;color:rgba(255,255,255,.25);}
.empty-state i{font-size:2.5rem;color:rgba(99,102,241,.2);display:block;margin-bottom:12px;}
.empty-state p{font-size:.85rem;}

/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:1000;align-items:center;justify-content:center;}
.modal-overlay.show{display:flex;}
.modal-box{background:#161b27;border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:32px;width:90%;max-width:520px;animation:modalIn .25s ease;}
@keyframes modalIn{from{opacity:0;transform:scale(.95);}to{opacity:1;transform:scale(1);}}
.modal-title{font-size:1.1rem;font-weight:800;color:#fff;margin-bottom:20px;display:flex;align-items:center;gap:10px;}
.modal-title i{color:#6366f1;}
.modal-close{float:right;background:none;border:none;color:rgba(255,255,255,.4);cursor:pointer;font-size:1.1rem;padding:0;margin-top:-4px;}
.modal-close:hover{color:#fff;}
.form-group{margin-bottom:16px;}
.form-label{display:block;font-size:.75rem;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:7px;text-transform:uppercase;letter-spacing:.5px;}
.form-control{width:100%;padding:10px 14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;color:#e6edf3;font-family:'Inter',sans-serif;font-size:.88rem;outline:none;transition:all .3s;}
.form-control:focus{border-color:#6366f1;background:rgba(99,102,241,.06);}
.form-control::placeholder{color:rgba(255,255,255,.2);}
select.form-control option{background:#1e2435;color:#e6edf3;}
textarea.form-control{resize:vertical;min-height:90px;}
.modal-footer{display:flex;gap:10px;justify-content:flex-end;margin-top:24px;}

/* TOAST */
.toast{position:fixed;bottom:24px;right:24px;background:#161b27;border:1px solid rgba(99,102,241,.3);border-radius:12px;padding:14px 20px;color:#fff;font-size:.86rem;z-index:9999;display:none;align-items:center;gap:10px;box-shadow:0 8px 32px rgba(0,0,0,.4);}
.toast.show{display:flex;}
.toast.success{border-color:rgba(16,185,129,.3);}
.toast.error{border-color:rgba(239,68,68,.3);}

@media(max-width:768px){.sidebar{width:200px;}.main{margin-left:200px;}.page-content{padding:20px;}}
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="fa fa-graduation-cap"></i></div>
    <div><div class="logo-text">Uma Foundation</div><div class="logo-sub">Admin Panel</div></div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-label">Overview</div>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : '../../'; ?>index.php" class="nav-item <?php echo $activePage=='dashboard'?'active':'';?>">
      <i class="fa fa-gauge"></i> Dashboard
    </a>
    
    <div class="nav-label" style="margin-top:10px;">Manage</div>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : ''; ?>showdonation.php" class="nav-item <?php echo $activePage=='donations'?'active':'';?>">
      <i class="fa fa-hand-holding-heart"></i> Donations
    </a>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : ''; ?>showscholarship.php" class="nav-item <?php echo $activePage=='scholarships'?'active':'';?>">
      <i class="fa fa-graduation-cap"></i> Scholarships
    </a>
    <a href="showhallmaster.php" class="nav-item <?php echo $activePage=='hallmaster'?'active':'';?>">
      <i class="fa fa-hotel"></i> Hall Master
    </a>
    <a href="showhallbooking.php" class="nav-item <?php echo $activePage=='hallbookings'?'active':'';?>">
      <i class="fa fa-calendar-check"></i> Hall Bookings
    </a>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : ''; ?>showannouncement.php" class="nav-item <?php echo $activePage=='announcements'?'active':'';?>">
      <i class="fa fa-bullhorn"></i> Announcements
    </a>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : ''; ?>showannouncementtype.php" class="nav-item <?php echo $activePage=='anntypes'?'active':'';?>">
      <i class="fa fa-tags"></i> Ann. Types
    </a>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : ''; ?>showusers.php" class="nav-item <?php echo $activePage=='users'?'active':'';?>">
      <i class="fa fa-users"></i> All Users
    </a>
  </nav>
  <div class="sidebar-footer">
    <div class="admin-chip">
      <div class="admin-avatar"><i class="fa fa-shield"></i></div>
      <div class="admin-info"><div class="admin-name">Administrator</div><div class="admin-role">Super Admin</div></div>
    </div>
    <a href="<?php echo isset($rootPrefix) ? $rootPrefix : '../../../'; ?>logout.php" class="logout-btn"><i class="fa fa-right-from-bracket"></i> Logout</a>
  </div>
</aside>

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <a href="<?php echo isset($rootPrefix) ? $rootPrefix : '../../'; ?>index.php" class="topbar-back"><i class="fa fa-arrow-left"></i> Dashboard</a>
      <span style="color:rgba(255,255,255,.15);">/</span>
      <span class="topbar-title"><?php echo $pageTitle;?></span>
    </div>
    <div class="topbar-right">
      <span class="topbar-date"><?php echo date('d M Y');?></span>
    </div>
  </div>

  <div class="page-content">
<!-- Page content starts here -->
