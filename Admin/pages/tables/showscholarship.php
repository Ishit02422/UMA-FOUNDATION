<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'Scholarships';
$activePage = 'scholarships';
include 'admin_head.php';

$q = mysqli_query($con,"SELECT s.*, u.name as user_name FROM tbl_scholarship s LEFT JOIN tbl_user u ON s.uid=u.id ORDER BY s.id DESC");
$total = mysqli_num_rows($q);
?>

<div class="page-hdr">
  <h2><i class="fa fa-graduation-cap"></i> Scholarship Applications</h2>
  <span class="count-pill"><?php echo $total;?> total</span>
</div>

<div class="section-card">
  <div class="search-bar">
    <div class="search-icon" style="flex:1;">
      <i class="fa fa-search"></i>
      <input type="text" class="search-input" id="searchInput" placeholder="Search by name, school, status...">
    </div>
  </div>
  <div style="overflow-x:auto;">
  <table class="admin-table" id="schTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Applicant</th>
        <th>School / University</th>
        <th>Year / %</th>
        <th>Father Income</th>
        <th>Mother Income</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if($total > 0):
      $i = 1;
      while($row = $q->fetch_assoc()):
        $status = $row['status'];
    ?>
    <tr>
      <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
      <td class="name"><?php echo htmlspecialchars($row['user_name'] ?? 'Unknown');?></td>
      <td><?php echo htmlspecialchars($row['school_unviersity_name'] ?? '—');?></td>
      <td><?php echo htmlspecialchars($row['current_year_std'] ?? '—');?></td>
      <td><?php echo $row['father_income'] ? '₹'.number_format($row['father_income']) : '—';?></td>
      <td><?php echo $row['mother_income'] ? '₹'.number_format($row['mother_income']) : '—';?></td>
      <td>
        <?php if($status == 1): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Approved</span>
        <?php elseif($status == 2): ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Rejected</span>
        <?php else: ?>
          <span class="pill pill-amber"><i class="fa fa-clock"></i> Pending</span>
        <?php endif; ?>
      </td>
      <td style="display:flex;gap:6px;flex-wrap:wrap;">
        <?php if($status != 1): ?>
        <button class="btn btn-success btn-sm" onclick="changestatus(<?php echo $row['id'];?>,1)"><i class="fa fa-check"></i> Approve</button>
        <?php endif; ?>
        <?php if($status != 2): ?>
        <button class="btn btn-danger btn-sm" onclick="changestatus(<?php echo $row['id'];?>,2)"><i class="fa fa-times"></i> Reject</button>
        <?php endif; ?>
        <?php if(!empty($row['adhar_card_image'])): ?>
        <a href="../../../<?php echo htmlspecialchars($row['adhar_card_image']);?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-file"></i> Doc</a>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="8"><div class="empty-state"><i class="fa fa-inbox"></i><p>No scholarship applications yet.</p></div></td></tr>
    <?php endif; ?>
    </tbody>
  </table>
  </div>
</div>

<div class="toast" id="toast"><i class="fa fa-circle-check"></i><span id="toastMsg">Done!</span></div>

<script>
function showToast(msg,type='success'){
  const t=$('#toast');t.find('#toastMsg').text(msg);
  t.attr('class','toast show '+type);setTimeout(()=>t.removeClass('show'),3000);
}
function changestatus(id,status){
  $.post('../../../Ajax_file/changestatusscholarship.php',{id:id,status:status},function(res){
    showToast('Status updated!');setTimeout(()=>location.reload(),900);
  });
}
$('#searchInput').on('input',function(){
  const v=$(this).val().toLowerCase();
  $('#schTable tbody tr').each(function(){$(this).toggle($(this).text().toLowerCase().includes(v));});
});
</script>
<?php include 'admin_foot.php'; ?>