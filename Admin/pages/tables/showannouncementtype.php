<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'Announcement Types';
$activePage = 'anntypes';
include 'admin_head.php';

$q = mysqli_query($con,"SELECT * FROM tbl_announcement_type ORDER BY id DESC");
$total = mysqli_num_rows($q);
?>

<div class="page-hdr">
  <h2><i class="fa fa-tags"></i> Announcement Types</h2>
  <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('show')">
    <i class="fa fa-plus"></i> Add Type
  </button>
</div>

<div class="section-card">
  <table class="admin-table" id="typeTable">
    <thead>
      <tr><th>#</th><th>Type Name</th><th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
    <?php
    if($total > 0):
      $i = 1;
      while($row = $q->fetch_assoc()):
    ?>
    <tr>
      <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
      <td class="name"><?php echo htmlspecialchars($row['type_name'] ?? 'N/A');?></td>
      <td>
        <?php if($row['status'] == 1): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Active</span>
        <?php else: ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Inactive</span>
        <?php endif; ?>
      </td>
      <td style="display:flex;gap:6px;">
        <button class="btn btn-warning btn-sm" onclick="editType(<?php echo $row['id'];?>,'<?php echo addslashes($row['type'] ?? $row['name'] ?? '');?>')"><i class="fa fa-pen"></i> Edit</button>
        <?php if($row['status']==1): ?>
        <button class="btn btn-danger btn-sm" onclick="changestatus(<?php echo $row['id'];?>,0)"><i class="fa fa-ban"></i> Deactivate</button>
        <?php else: ?>
        <button class="btn btn-success btn-sm" onclick="changestatus(<?php echo $row['id'];?>,1)"><i class="fa fa-check"></i> Activate</button>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="4"><div class="empty-state"><i class="fa fa-tags"></i><p>No announcement types yet. Add one!</p></div></td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div class="modal-overlay" id="addModal">
  <div class="modal-box">
    <div class="modal-title">
      <i class="fa fa-tags"></i> Add Announcement Type
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('show')"><i class="fa fa-times"></i></button>
    </div>
    <form method="POST" action="../../../Ajax_file/addannouncementtype.php">
      <input type="hidden" name="status" value="1">
      <div class="form-group">
        <label class="form-label">Type Name</label>
        <input type="text" name="type_name" class="form-control" placeholder="e.g. Event, Notice, Scholarship" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="document.getElementById('addModal').classList.remove('show')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
      </div>
    </form>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal-overlay" id="editModal">
  <div class="modal-box">
    <div class="modal-title">
      <i class="fa fa-pen"></i> Edit Type
      <button class="modal-close" onclick="document.getElementById('editModal').classList.remove('show')"><i class="fa fa-times"></i></button>
    </div>
    <form method="POST" action="../../../Ajax_file/editannouncementtype.php">
      <input type="hidden" name="id" id="editId">
      <div class="form-group">
        <label class="form-label">Type Name</label>
        <input type="text" name="type_name" id="editTypeName" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="document.getElementById('editModal').classList.remove('show')">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
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
function changestatus(id,status){
  $.post('../../../Ajax_file/changestatusannouncementType.php',{id:id,status:status},function(){
    showToast('Status updated!');setTimeout(()=>location.reload(),900);
  });
}
function editType(id,name){
  $('#editId').val(id);$('#editTypeName').val(name);
  document.getElementById('editModal').classList.add('show');
}
document.querySelectorAll('.modal-overlay').forEach(m=>{
  m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('show');});
});
</script>
<?php include 'admin_foot.php'; ?>
