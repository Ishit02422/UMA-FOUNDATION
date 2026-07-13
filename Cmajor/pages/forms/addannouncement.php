<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Form</title>
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
                            <h1>Create Announcement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Announcement</li>
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
                                    <h3 class="card-title">Announcement Form</h3>
                                </div>

                                <!-- Form Start -->
                                <form id="announcementForm">
                                    <div class="card-body">
                                        <!-- <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" class="form-control" id="id" placeholder="Enter ID" required>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" required>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control" id="status" required>
                                                <option value="1" href="../forms/editannouncement.php?id=<?php echo $row["id"];?>" >Active</option>
                                                <option value="0" onclick="deactive(<?php echo $row['id']?>,0)">Inactive</option>
                                            </select>
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <label for="type_id">Type ID</label>
                                            <select name="type" class="form-control" id="type" class>
                                            <?php  
                                                include "../../../connect.php";
                                                $query="select * from tbl_announcement_type where status=1";
                                                $result=mysqli_query($con,$query);
                                                if($result->num_rows>0)
                                                {
                                                    while($row=$result->fetch_assoc())
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row["id"];?>"><?php echo $row["type_name"];?></option>
                                                        
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <option value>-No type found-</option>
                                                    <?php 
                                                }
                                            ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter Description" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="declaration_date">Declaration Date</label>
                                            <input type="date" name="declaration_date" class="form-control" id="declaration_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="from_date">From Date</label>
                                            <input type="date" name="from_date" class="form-control" id="from_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="to_date">To Date</label>
                                            <input type="date" name="to_date" class="form-control" id="to_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="form">Form</label>
                                            <input type="text" name="form" class="form-control" id="form" placeholder="Enter Form Details" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="form">Image</label>
                                            <input type="file" name="Image" class="form-control" id="image" placeholder="Give image for this announcement" required>
                                        </div>
                                    </div>
                                    <!-- Form Submit Button -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Include JS Files -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
</body>
<script>
           $(document).ready(function() {
                $("#announcementForm").on("submit",function(event) {
                    event.preventDefault();
                    console.log("running");
                    const form=new FormData(this);
                    $.ajax({
                        url:'../../../Ajax_file/addannouncement.php',
                        method:'POST',
                        data:form,
                        processData:false,
                        contentType:false,
                        success:function(response){
                           if(response==true)
                           {
                                alert("new announcement type added successfully");
                                window.location='../tables/showannouncement.php';
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
<!-- <script>
            function deactive(id,status)
            {
                $.ajax({
                    url:'../../../Ajax_file/changestatusannouncement.php',
                    data:{
                        id:id,
                        status:status
                    },
                    method:"POST",
                    success:function(response)
                    {
                        if(response==true)
                        {
                            alert("status is changed successfully")
                        }
                    }
                })
            }
</script> -->
</html>
