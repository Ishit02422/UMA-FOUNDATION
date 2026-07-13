<?php
// Quick DB structure checker
include '../connect.php';
echo "<pre style='background:#1a1a2e;color:#e6edf3;padding:20px;font-family:monospace;font-size:13px;'>";
echo "<h2 style='color:#a5b4fc'>tbl_scholarship structure:</h2>";
$r = mysqli_query($con, "DESCRIBE tbl_scholarship");
if($r){ while($row=mysqli_fetch_assoc($r)){ print_r($row); } }
else { echo "Table not found: ".mysqli_error($con); }
echo "\n\n<h2 style='color:#a5b4fc'>tbl_scholarship existing data:</h2>";
$r2 = mysqli_query($con, "SELECT * FROM tbl_scholarship LIMIT 3");
if($r2){ while($row=mysqli_fetch_assoc($r2)){ print_r($row); } }
echo "</pre>";
?>
