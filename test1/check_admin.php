<?php
include '../connect.php';
echo "<pre style='background:#1a1a2e;color:#e6edf3;padding:20px;font-family:monospace;'>";
echo "<h2 style='color:#a5b4fc'>All Admin/Users in DB:</h2>";
$r = mysqli_query($con, "SELECT id, name, username, password, email, role FROM tbl_user WHERE role IN ('Admin','admin','1','2') OR role LIKE '%admin%' OR role LIKE '%Admin%' LIMIT 10");
if($r && mysqli_num_rows($r)>0){
    while($row=mysqli_fetch_assoc($r)){ print_r($row); echo "\n"; }
} else {
    echo "No admin users found\n";
    echo "\n--- ALL USERS ---\n";
    $r2 = mysqli_query($con, "SELECT id, name, username, password, role FROM tbl_user LIMIT 10");
    if($r2){ while($row=mysqli_fetch_assoc($r2)){ print_r($row); echo "\n"; } }
}
echo "\n<h2 style='color:#a5b4fc'>tbl_user roles:</h2>";
$r3 = mysqli_query($con,"SELECT DISTINCT role FROM tbl_user");
if($r3){ while($row=mysqli_fetch_assoc($r3)){ echo $row['role']."\n"; } }

// Check admin table
echo "\n<h2 style='color:#a5b4fc'>Admin table (tbl_admin):</h2>";
$r4 = mysqli_query($con,"SELECT * FROM tbl_admin LIMIT 5");
if($r4){ while($row=mysqli_fetch_assoc($r4)){ print_r($row); } }
else { echo "tbl_admin not found: ".mysqli_error($con); }
echo "</pre>";
?>
