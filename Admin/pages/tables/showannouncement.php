<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header('Location:../../../login.php'); exit;
}
include "../../../connect.php";
$pageTitle = 'Announcements';
$activePage = 'announcements';
include 'admin_head.php';

$q = mysqli_query($con,"SELECT * FROM tbl_announcement ORDER BY id DESC");
$total = mysqli_num_rows($q);

// Handle add/edit via POST
$editRow = null;
if(isset($_GET['edit'])){
    $eid = (int)$_GET['edit'];
    $er = mysqli_query($con,"SELECT * FROM tbl_announcement WHERE id='$eid' LIMIT 1");
    $editRow = $er ? $er->fetch_assoc() : null;
}
?>

<div class="page-hdr">
  <h2><i class="fa fa-bullhorn"></i> Announcements</h2>
  <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('show')">
    <i class="fa fa-plus"></i> Add New
  </button>
</div>

<div class="section-card">
  <div class="search-bar">
    <div class="search-icon" style="flex:1;">
      <i class="fa fa-search"></i>
      <input type="text" class="search-input" id="searchInput" placeholder="Search announcements...">
    </div>
  </div>
  <table class="admin-table" id="annTable">
    <thead>
      <tr><th>#</th><th>Title</th><th>Description</th><th>Date</th><th>Last Date</th><th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
    <?php
    if($total > 0):
      $i = 1;
      while($row = $q->fetch_assoc()):
    ?>
    <tr>
      <td style="color:rgba(255,255,255,.3);"><?php echo $i++;?></td>
      <td class="name"><?php echo htmlspecialchars($row['title']);?></td>
      <td style="max-width:240px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo htmlspecialchars($row['description']);?></td>
      <td><?php echo $row['declaration_date'] ? date('d M Y', strtotime($row['declaration_date'])) : '—';?></td>
      <td><?php echo !empty($row['last_date']) ? date('d M Y', strtotime($row['last_date'])) : '—';?></td>
      <td>
        <?php if($row['status'] == 1): ?>
          <span class="pill pill-green"><i class="fa fa-check"></i> Active</span>
        <?php else: ?>
          <span class="pill pill-red"><i class="fa fa-times"></i> Inactive</span>
        <?php endif; ?>
      </td>
      <td style="display:flex;gap:6px;">
        <button class="btn btn-warning btn-sm" onclick="editAnn(<?php echo $row['id'];?>,'<?php echo addslashes($row['title']);?>','<?php echo addslashes($row['description']);?>','<?php echo $row['declaration_date']??'';?>','<?php echo $row['last_date']??'';?>')"><i class="fa fa-pen"></i> Edit</button>
        <?php if($row['status']==1): ?>
        <button class="btn btn-danger btn-sm" onclick="changestatus(<?php echo $row['id'];?>,0)"><i class="fa fa-ban"></i> Hide</button>
        <?php else: ?>
        <button class="btn btn-success btn-sm" onclick="changestatus(<?php echo $row['id'];?>,1)"><i class="fa fa-check"></i> Show</button>
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="7"><div class="empty-state"><i class="fa fa-bullhorn"></i><p>No announcements yet. Add one!</p></div></td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div class="modal-overlay" id="addModal">
  <div class="modal-box">
    <div class="modal-title">
      <i class="fa fa-bullhorn"></i> Add Announcement
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('show')"><i class="fa fa-times"></i></button>
    </div>
    <form method="POST" action="../../../Ajax_file/addannouncement.php" enctype="multipart/form-data">
      <div class="form-group">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Announcement title" required>
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" placeholder="Full description..." required></textarea>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-group">
          <label class="form-label">Declaration Date</label>
          <input type="date" name="declaration_date" class="form-control" required>
        </div>
        <div class="form-group">
          <label class="form-label">Event Type</label>
          <select name="type_id" class="form-control" required>
            <?php $tr=mysqli_query($con,"SELECT * FROM tbl_announcement_type WHERE status=1"); while($t=$tr->fetch_assoc()): ?>
            <option value="<?php echo $t['id'];?>"><?php echo htmlspecialchars($t['type_name']);?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-group">
          <label class="form-label">From Date</label>
          <input type="date" name="from_date" class="form-control" required>
        </div>
        <div class="form-group">
          <label class="form-label">To Date</label>
          <input type="date" name="to_date" class="form-control" required>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Image (optional)</label>
        <input type="file" name="image" class="form-control" accept="image/*">
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
      <i class="fa fa-pen"></i> Edit Announcement
      <button class="modal-close" onclick="document.getElementById('editModal').classList.remove('show')"><i class="fa fa-times"></i></button>
    </div>
    <form method="POST" action="../../../Ajax_file/editannouncement.php" enctype="multipart/form-data">
      <input type="hidden" name="id" id="editId">
      <div class="form-group">
        <label class="form-label">Title</label>
        <input type="text" name="title" id="editTitle" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" id="editDesc" class="form-control"></textarea>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-group">
          <label class="form-label">Declaration Date</label>
          <input type="date" name="declaration_date" id="editDate" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label">Last Date</label>
          <input type="date" name="last_date" id="editLast" class="form-control">
        </div>
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
  $.post('../../../Ajax_file/changestatusannouncement.php',{id:id,status:status},function(){
    showToast('Announcement status updated!');setTimeout(()=>location.reload(),900);
  });
}
function editAnn(id,title,desc,date,last){
  $('#editId').val(id);$('#editTitle').val(title);
  $('#editDesc').val(desc);$('#editDate').val(date);$('#editLast').val(last);
  document.getElementById('editModal').classList.add('show');
}
$('#searchInput').on('input',function(){
  const v=$(this).val().toLowerCase();
  $('#annTable tbody tr').each(function(){$(this).toggle($(this).text().toLowerCase().includes(v));});
});
// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(m=>{
  m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('show');});
});
</script>
<?php include 'admin_foot.php'; ?>
