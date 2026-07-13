<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'All Users';
$activePage = 'users';
include 'admin_head.php';

$query = "SELECT u.id, u.name, u.username, u.gender, u.dob, u.contactno, u.address, u.email, u.caste_certificate, u.status, u.role, c.name AS city_name
          FROM tbl_user u
          LEFT JOIN tbl_city c ON u.cityid = c.id
          ORDER BY u.id DESC";
$result = mysqli_query($con, $query);
$total = mysqli_num_rows($result);
?>

<div class="page-hdr">
  <h2><i class="fa fa-users"></i> All Users</h2>
  <span class="count-pill"><?php echo $total;?> registered</span>
</div>

<div class="section-card">
  <div class="search-bar">
    <div class="search-icon" style="flex:1;">
      <i class="fa fa-search"></i>
      <input type="text" class="search-input" id="searchInput" placeholder="Search users by name, username, email, phone...">
    </div>
  </div>
  <div style="overflow-x:auto;">
  <table class="admin-table" id="usersTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Username</th>
        <th>Contact Info</th>
        <th>Gender/DOB</th>
        <th>Address & City</th>
        <th>Caste Cert.</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    if($total > 0):
      $i = 1;
      while($row = $result->fetch_assoc()):
        $status = $row['status'];
        $gender = ($row['gender'] == 1) ? 'Female' : 'Male';
    ?>
    <tr>
      <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
      <td class="name">
        <?php echo htmlspecialchars($row['name']);?>
      </td>
      <td class="mono" style="font-size:.8rem;"><?php echo htmlspecialchars($row['username']);?></td>
      <td>
        <div style="font-weight:500;"><?php echo htmlspecialchars($row['email']);?></div>
        <div style="font-size:.75rem;color:rgba(255,255,255,.4);margin-top:2px;"><i class="fa fa-phone"></i> <?php echo htmlspecialchars($row['contactno']);?></div>
      </td>
      <td style="font-size:.8rem;">
        <div><?php echo $gender;?></div>
        <div style="color:rgba(255,255,255,.4);margin-top:2px;"><?php echo $row['dob'] ? date('d M Y', strtotime($row['dob'])) : '—';?></div>
      </td>
      <td>
        <div style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="<?php echo htmlspecialchars($row['address']);?>">
          <?php echo htmlspecialchars($row['address']);?>
        </div>
        <div style="font-size:.75rem;color:#8f9cae;margin-top:2px;"><i class="fa fa-location-dot"></i> <?php echo htmlspecialchars($row['city_name'] ?? '—');?></div>
      </td>
      <td>
        <?php if(!empty($row['caste_certificate'])): ?>
          <a href="../../../<?php echo htmlspecialchars($row['caste_certificate']);?>" target="_blank" class="btn btn-sm" style="background:rgba(99,102,241,.1);color:#a5b4fc;border:1px solid rgba(99,102,241,.2);font-size:.73rem;padding:4px 8px;border-radius:6px;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
            <i class="fa fa-file-pdf"></i> View Doc
          </a>
        <?php else: ?>
          <span style="color:rgba(255,255,255,.2);font-size:.75rem;">None</span>
        <?php endif; ?>
      </td>
      <td>
        <span class="pill pill-blue"><?php echo htmlspecialchars($row['role']);?></span>
      </td>
      <td>
        <?php if($status == 1): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Active</span>
        <?php else: ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Inactive</span>
        <?php endif; ?>
      </td>
      <td>
        <?php if($status == 1): ?>
        <button class="btn btn-danger btn-sm" onclick="changestatus(<?php echo $row['id'];?>,0)"><i class="fa fa-ban"></i> Deactivate</button>
        <?php else: ?>
        <button class="btn btn-success btn-sm" onclick="changestatus(<?php echo $row['id'];?>,1)"><i class="fa fa-check"></i> Activate</button>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="10"><div class="empty-state"><i class="fa fa-users"></i><p>No registered users found.</p></div></td></tr>
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
  $.post('../../../Ajax_file/changestatususer.php',{id:id,status:status},function(res){
    showToast(status==1?'User activated successfully!':'User deactivated successfully!');
    setTimeout(()=>location.reload(),900);
  });
}
$('#searchInput').on('input',function(){
  const v=$(this).val().toLowerCase();
  $('#usersTable tbody tr').each(function(){$(this).toggle($(this).text().toLowerCase().includes(v));});
});
</script>
<?php include 'admin_foot.php'; ?>
