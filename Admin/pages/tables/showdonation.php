<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'Donations';
$activePage = 'donations';
include 'admin_head.php';

$donations = mysqli_query($con,"SELECT * FROM tbl_donation ORDER BY id DESC");
$total = mysqli_num_rows($donations);
?>

<div class="page-hdr">
  <h2><i class="fa fa-hand-holding-heart"></i> Donation Records</h2>
  <span class="count-pill"><?php echo $total;?> total</span>
</div>

<div class="section-card">
  <div class="search-bar">
    <div class="search-icon" style="flex:1;">
      <i class="fa fa-search"></i>
      <input type="text" class="search-input" id="searchInput" placeholder="Search by name, amount, transaction ID...">
    </div>
  </div>
  <table class="admin-table" id="donTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Member Name</th>
        <th>Amount</th>
        <th>Transaction ID</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if($total > 0):
      $i = 1;
      while($row = $donations->fetch_assoc()):
        $status = $row['status'];
        $amount = $row['price'] ?? '0';
        $txn = $row['transaction_id'] ?? 'N/A';
        $date = $row['date'] ?? '';
    ?>
    <tr>
      <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
      <td class="name"><?php echo htmlspecialchars($row['user_name'] ?? $row['name'] ?? 'Unknown');?></td>
      <td class="amount">₹<?php echo number_format($amount);?></td>
      <td class="mono"><?php echo htmlspecialchars($txn);?></td>
      <td><?php echo $date ? date('d M Y', strtotime($date)) : '—';?></td>
      <td>
        <?php if($status == 1): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Active</span>
        <?php else: ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Inactive</span>
        <?php endif; ?>
      </td>
      <td>
        <?php if($status == 0): ?>
          <button class="btn btn-success btn-sm" onclick="changestatus(<?php echo $row['id'];?>,1)"><i class="fa fa-check"></i> Activate</button>
        <?php else: ?>
          <button class="btn btn-danger btn-sm" onclick="changestatus(<?php echo $row['id'];?>,0)"><i class="fa fa-ban"></i> Deactivate</button>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="7"><div class="empty-state"><i class="fa fa-inbox"></i><p>No donation records found.</p></div></td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Toast -->
<div class="toast" id="toast"><i class="fa fa-circle-check"></i><span id="toastMsg">Done!</span></div>

<script>
function showToast(msg, type='success'){
  const t=$('#toast'); t.find('#toastMsg').text(msg);
  t.attr('class','toast show '+type); setTimeout(()=>t.removeClass('show'),3000);
}
function changestatus(id, status){
  $.post('../../../Ajax_file/changestatusdonation.php',{id:id,status:status},function(res){
    if(res==true||res=='true'||res=='1'){
      showToast('Status updated successfully!'); setTimeout(()=>location.reload(),1000);
    } else { showToast('Error: '+res,'error'); }
  });
}
// Search
$('#searchInput').on('input',function(){
  const v=$(this).val().toLowerCase();
  $('#donTable tbody tr').each(function(){
    $(this).toggle($(this).text().toLowerCase().includes(v));
  });
});
</script>
<?php include 'admin_foot.php'; ?>
