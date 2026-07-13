
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create hall booking</title>
    <!-- Add the required CSS and JS dependencies -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar and Sidebar -->
        <?php include "aside.php"; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create hall booking</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create hall booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Form Column -->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Hall booking Form</h3>
                                </div>

                                <?php
                                include "../../../connect.php";
                                if (isset($_GET['id'])) {
    
                                    $id = intval($_GET['id']);

    
                                 $query = "SELECT * FROM tbl_hall_booking WHERE id = $id";
                                 $run = mysqli_query($con, $query);
                                 if ($run) {
                                 $row = mysqli_fetch_assoc($run); 
                             if (!$row) {
                              die("Record not found.");
                                }
        
                             } else {
        
                             die("Query failed: " . mysqli_error($con));
                                 }
                            } else {
    
                                 die("ID not provided.");
                                    }
                                 ?>


                            <!-- form start -->

                                <form id= "hallbookingform">
                                <div class="card-body">

                                    <div class="form-group">

                                     <!-- <label for="id">ID</label>
                                     <input type="text" name="id " class="form-control" id="id" placeholder="enter id" value="<?php echo $row["id"];?>"required> -->

                                        <!--label for="uid">U_ID</label>
                                        <input type="text" name="uid" class="form-control" id="uid" placeholder="Enter uid" value="<?php echo $row["uid"];?>"required>-->

                                        <input type="number" name="id" id=""  value=<?php echo $row["id"];?> hidden>
                                    </div>

                                    <div class="form-group">
                                    <label for="hall_id">HALL_ID:</label>
                                        <select name="hall_id" class="form-control" id="type" class>
                                            <?php
                                                include "../../../connect.php";
                                                $query="select * from tbl_hall_master where status=1";
                                                $result=mysqli_query($con,$query);
                                                if($result->num_rows>0)
                                                {
                                                    while($row1=$result->fetch_assoc())
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row1["id"];?>" <?php echo ($row1['id']==$row["hall_id"])? 'selected' :''; ?>><?php echo $row1["name"];?> </option>
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <option value>-no type found-<s</option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                            </div>

                                    <!--div class="form-group">
                                    <label for="status">STATUS:</label>
                                        <select id="status" name="status" class="form-control"value="<?php echo $row["status"];?>" required >
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                        </div>-->

                                        <div class="form-group">
                                        <label for="start_date_time">START DATE & TIME:</label>
                                        <input type="datetime-local" id="start_date_time" class="form-control" name="start_date_time" value="<?php echo $row["start_date_time"];?>"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date_time">END DATE & TIME:</label>
                                        <input type="datetime-local" id="end_date_time" name="end_date_time" class="form-control" value="<?php echo $row["end_date_time"];?>"required>
                                    </div>

                                    <div class="form-group">
                                        <label for="request_date">REQUEST_DATE</label>
                                        <input type="date" id="request_date" name="request_date" class="form-control"value="<?php echo $row["request_date"];?>" required >
                                    </div>

                                    <div class="form-group">
                                        <label for="transaction_id">TRANSACTION_ID:</label>
                                        <input type="text" id="transaction_id" name="transaction_id" class="form-control"value="<?php echo $row["transaction_id"];?>"required>
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_date">PAYMENT_DATE</label>
                                        <input type="date" id="payment_date" name="payment_date" class="form-control" value="<?php echo $row["payment_date"];?>"required>
                                    </div>
                                    
                                    
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    
  

    <!-- Include JS Files -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
</body>
<script> 
   $(document).ready(function() {
                $("#hallbookingform").on("submit",function(event) {
                    event.preventDefault();
                    const form=new FormData(this);
                    $.ajax({
                        url:'../../../Ajax_file/edithallbooking.php',
                        data:form,
                        method:'POST',
                        processData:false,
                        contentType:false,
                        success:function(response){
                           if(response==true)
                           {
                                alert("hall booking Updated successfully");
                                window.location='../tables/showhallbooking.php';
                           }
                           else
                           {
                            alert(response);
                           }
                        }
                    })
                })
            })
   
</script>
</html>
