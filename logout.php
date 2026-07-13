<?php
session_start();
session_unset(); 
session_destroy(); 
echo "<script>window.location='test1/index.php'</script>";
?>
