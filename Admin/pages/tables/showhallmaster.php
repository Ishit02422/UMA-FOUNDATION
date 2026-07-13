<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'Hall Master';
$activePage = 'hallmaster';
include 'admin_head.php';

$q = mysqli_query($con,"SELECT * FROM tbl_hall_master ORDER BY id DESC");
$total = mysqli_num_rows($q);
?>

<div class="page-hdr">
  <h2><i class="fa fa-hotel"></i> Hall Master</h2>
  <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('show')">
    <i class="fa fa-plus"></i> Add Hall
  </button>
</div>

<div class="section-card">
  <div class="search-bar">
    <div class="search-icon" style="flex:1;">
      <i class="fa fa-search"></i>
      <input type="text" class="search-input" id="searchInput" placeholder="Search by name, address...">
    </div>
  </div>
  <div style="overflow-x:auto;">
  <table class="admin-table" id="hallMasterTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Hall Name</th>
        <th>Capacity</th>
        <th>Address</th>
        <th>Rent</th>
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
      <td>
        <?php if(!empty($row['image'])): ?>
          <img src="../../../<?php echo htmlspecialchars($row['image']);?>" alt="Hall" style="width:50px;height:35px;border-radius:4px;object-fit:cover;border:1px solid rgba(255,255,255,.1);">
        <?php else: ?>
          <span style="font-size:.7rem;color:rgba(255,255,255,.2);">No Image</span>
        <?php endif; ?>
      </td>
      <td class="name"><?php echo htmlspecialchars($row['name']);?></td>
      <td><?php echo htmlspecialchars($row['capacity']);?> guests</td>
      <td><?php echo htmlspecialchars($row['address']);?></td>
      <td style="color:#10b981;font-weight:700;">₹<?php echo number_format($row['rent']);?></td>
      <td>
        <?php if($status == 1): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Active</span>
        <?php else: ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Inactive</span>
        <?php endif; ?>
      </td>
      <td style="display:flex;gap:6px;">
        <a href="../forms/edithallmaster.php?id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm"><i class="fa fa-pen"></i> Edit</a>
        <?php if($status == 1): ?>
        <button class="btn btn-danger btn-sm" onclick="deactive(<?php echo $row['id'];?>,0)"><i class="fa fa-ban"></i> Deactivate</button>
        <?php else: ?>
        <button class="btn btn-success btn-sm" onclick="deactive(<?php echo $row['id'];?>,1)"><i class="fa fa-check"></i> Activate</button>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="8"><div class="empty-state"><i class="fa fa-hotel"></i><p>No halls created yet. Add one!</p></div></td></tr>
    <?php endif; ?>
    </tbody>
  </table>
  </div>
</div>

<!-- ADD MODAL -->
<div class="modal-overlay" id="addModal">
  <div class="modal-box">
    <div class="modal-title">
      <i class="fa fa-hotel"></i> Add New Hall
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('show')"><i class="fa fa-times"></i></button>
    </div>
    <form id="addHallForm" enctype="multipart/form-data">
      <div class="form-group">
        <label class="form-label">Hall Name</label>
        <input type="text" name="name" class="form-control" placeholder="e.g. Community Hall A" required>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-group">
          <label class="form-label">Capacity (Guests)</label>
          <input type="number" name="capacity" class="form-control" placeholder="e.g. 200" required>
        </div>
        <div class="form-group">
          <label class="form-label">Rent Per Day (₹)</label>
          <input type="number" name="rent" class="form-control" placeholder="e.g. 15000" required>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control" placeholder="Location address" required>
      </div>
      <div class="form-group">
        <label class="form-label">Hall Banner Image</label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="document.getElementById('addModal').classList.remove('show')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Add Hall</button>
      </div>
    </form>
  </div>
</div>

<div class="toast" id="toast"><i class="fa fa-circle-check"></i><span id="toastMsg">Done!</span></div>

<script>
function showToast(msg,type='success'){
  const t=$('#toast');t.find('#toastMsg').text(msg);
  t.attr('class','toast show '+type);setTimeout(()=>t.removeClass('show'),3000);
}
$('#addHallForm').on('submit', function(e) {
  e.preventDefault();
  var fd = new FormData(this);
  $.ajax({
    url: '../../../Ajax_file/addhallmaster.php',
    method: 'POST',
    data: fd,
    processData: false,
    contentType: false,
    success: function(response) {
      if (response == 1 || response == true || response.trim() === '1') {
        showToast('Hall added successfully!');
        document.getElementById('addModal').classList.remove('show');
        setTimeout(() => location.reload(), 900);
      } else {
        showToast(response, 'error');
      }
    }
  });
});
function deactive(id, status){
  $.post('../../../Ajax_file/changestatushallmaster.php',{id:id,status:status},function(res){
    showToast('Status updated successfully!');
    setTimeout(()=>location.reload(),900);
  });
}
$('#searchInput').on('input',function(){
  const v=$(this).val().toLowerCase();
  $('#hallMasterTable tbody tr').each(function(){$(this).toggle($(this).text().toLowerCase().includes(v));});
});
document.querySelectorAll('.modal-overlay').forEach(m=>{
  m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('show');});
});
</script>
<?php include 'admin_foot.php'; ?>
