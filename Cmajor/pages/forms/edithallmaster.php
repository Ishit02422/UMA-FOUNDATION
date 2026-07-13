
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Hall Master</title>
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
                            <h1>Create Hall Master</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Hall Master</li>
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
                                    <h3 class="card-title">Hall master Form</h3>
                                </div>

                                <?php
                                include "../../../connect.php";
                                if (isset($_GET['id'])) {
    
                                    $id = intval($_GET['id']);

    
                                 $query = "SELECT * FROM tbl_hall_master WHERE id = $id";
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


                                <form id="hallForm">
                                <div class="card-body">

                                    <div class="form-group">

                                    <!-- <label for="id">ID</label>
                                    <input type="text" name="id" class="form-control" id="id" placeholder="enter id" value="<?php echo $row["id"];?>"required> -->
                                        <input type="number" name="id" id=""  value=<?php echo $row["id"];?> hidden>
                                        <label for="hall_name">NAME:</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $row["name"];?>"required>
                                    </div>

                                    <div class="form-group">
                                        <label for="capacity">CAPACITY:</label>
                                        <input type="number" id="capacity" name="capacity" value="<?php echo $row["capacity"];?>"required>
                                        
                                    </div>

                                        <div class="form-group">
                                        <label for="image">IMAGE:</label>
                                        <input type="file" id="image" name="image" accept="image/*">
                                        </div>

                                    

                                    <div class="form-group">
                                        <label for="address">ADDRESS:</label>
                                        <textarea name="address" rows="6" cols="20" pattern="[A-Za-z0-9\s,.'-]+" title="required characters"requied><?php echo $row["address"];?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="rent">RENT:</label>
                                        <input type="number" id="rent" name="rent"required value="<?php echo $row["rent"];?>">
                                    </div>
                                    <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                    
                                    </form> 
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        
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
                $("#hallForm").on("submit",function(event) {
                    event.preventDefault();
                    const form=new FormData(this);
                    $.ajax({
                        url:'../../../Ajax_file/edithallmaster.php',
                        data:form,
                        method:'POST',
                        processData:false,
                        contentType:false,
                        success:function(response){
                           if(response==true)
                           {
                                alert(" Hall Updated successfully");
                                window.location='../tables/showhall.php';
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
