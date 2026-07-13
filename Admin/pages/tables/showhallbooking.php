<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'Hall Bookings';
$activePage = 'hallbookings';
include 'admin_head.php';

$q = mysqli_query($con,"SELECT b.*, u.name as user_name, h.name as hall_name FROM tbl_hall_booking b LEFT JOIN tbl_user u ON b.uid=u.id LEFT JOIN tbl_hall_master h ON b.hall_id=h.id ORDER BY b.id DESC");
$total = mysqli_num_rows($q);
?>

<div class="page-hdr">
  <h2><i class="fa fa-calendar-check"></i> Hall Bookings</h2>
  <span class="count-pill"><?php echo $total;?> bookings</span>
</div>

<div class="section-card">
  <div class="search-bar">
    <div class="search-icon" style="flex:1;">
      <i class="fa fa-search"></i>
      <input type="text" class="search-input" id="searchInput" placeholder="Search by name, hall, date...">
    </div>
  </div>
  <div style="overflow-x:auto;">
  <table class="admin-table" id="hallTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Member</th>
        <th>Hall</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Transaction ID</th>
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
      <td><?php echo htmlspecialchars($row['hall_name'] ?? 'Hall #'.$row['hall_id']);?></td>
      <td><?php echo $row['start_date_time'] ? date('d M Y', strtotime($row['start_date_time'])) : '—';?></td>
      <td><?php echo $row['end_date_time'] ? date('d M Y', strtotime($row['end_date_time'])) : '—';?></td>
      <td class="mono"><?php echo htmlspecialchars($row['transaction_id'] ?? '—');?></td>
      <td>
        <?php if($status == 1): ?>
          <span class="pill pill-amber"><i class="fa fa-clock"></i> Pending</span>
        <?php elseif($status == 2): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Approved</span>
        <?php elseif($status == 3): ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Rejected</span>
        <?php else: ?>
          <span class="pill pill-blue">Status <?php echo $status;?></span>
        <?php endif; ?>
      </td>
      <td style="display:flex;gap:6px;">
        <?php if($status == 1): ?>
        <button class="btn btn-success btn-sm" onclick="changestatus(<?php echo $row['id'];?>,2)"><i class="fa fa-check"></i> Approve</button>
        <button class="btn btn-danger btn-sm" onclick="changestatus(<?php echo $row['id'];?>,3)"><i class="fa fa-times"></i> Reject</button>
        <?php else: ?>
        <span style="font-size:.75rem;color:rgba(255,255,255,.25);">Processed</span>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="8"><div class="empty-state"><i class="fa fa-building"></i><p>No hall bookings found.</p></div></td></tr>
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
  $.post('../../../Ajax_file/changestatushallbooking.php',{id:id,status:status},function(res){
    showToast(status==2?'Booking approved!':'Booking rejected!');
    setTimeout(()=>location.reload(),900);
  });
}
$('#searchInput').on('input',function(){
  const v=$(this).val().toLowerCase();
  $('#hallTable tbody tr').each(function(){$(this).toggle($(this).text().toLowerCase().includes(v));});
});
</script>
<?php include 'admin_foot.php'; ?>
