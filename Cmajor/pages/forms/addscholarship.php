<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Form</title>
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
                            <h1>Scholarship Application</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Scholarship Form</li>
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
                                    <h3 class="card-title">Scholarship Application Form</h3>
                                </div>

                                <!-- Form Start -->
                                <form id="scholarshipForm" method="post" action="submit_scholarship.php" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" class="form-control" id="id" placeholder="Enter ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uid">User ID</label>
                                            <input type="text" name="uid" class="form-control" id="uid" placeholder="Enter User ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="aid">Application ID</label>
                                            <input type="text" name="aid" class="form-control" id="aid" placeholder="Enter Application ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="adhar_card_image">Aadhar Card Image</label>
                                            <input type="file" name="adhar_card_image" class="form-control" id="adhar_card_image" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control" id="status" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="school_unviersity_name">School/University Name</label>
                                            <input type="text" name="school_unviersity_name" class="form-control" id="school_unviersity_name" placeholder="Enter School/University Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="previous_year_marksheet">Previous Year Marksheet</label>
                                            <input type="file" name="previous_year_marksheet" class="form-control" id="previous_year_marksheet" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="current_year_std">Current Year (Standard)</label>
                                            <input type="file" name="current_year_std" class="form-control" id="current_year_std" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pan_card_no_father">Father's PAN Card Number</label>
                                            <input type="text" name="pan_card_no_father" class="form-control" id="pan_card_no_father" placeholder="Enter Father's PAN Card Number" maxlength="11" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pan_card_no_mother">Mother's PAN Card Number</label>
                                            <input type="text" name="pan_card_no_mother" class="form-control" id="pan_card_no_mother" placeholder="Enter Mother's PAN Card Number" maxlength="11" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="occupation_father">Father's Occupation</label>
                                            <input type="text" name="occupation_father" class="form-control" id="occupation_father" placeholder="Enter Father's Occupation" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="occupation_mother">Mother's Occupation</label>
                                            <input type="text" name="occupation_mother" class="form-control" id="occupation_mother" placeholder="Enter Mother's Occupation" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="father_income">Father's Income</label>
                                            <input type="number" step="0.01" name="father_income" class="form-control" id="father_income" placeholder="Enter Father's Income" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mother_income">Mother's Income</label>
                                            <input type="number" step="0.01" name="mother_income" class="form-control" id="mother_income" placeholder="Enter Mother's Income" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_name">Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Enter Bank Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_ifsc_code">Bank IFSC Code</label>
                                            <input type="text" name="bank_ifsc_code" class="form-control" id="bank_ifsc_code" placeholder="Enter Bank IFSC Code" maxlength="20" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Account Number</label>
                                            <input type="text" name="account_no" class="form-control" id="account_no" placeholder="Enter Account Number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="income_certificate">Income Certificate</label>
                                            <input type="file" name="income_certificate" class="form-control" id="income_certificate" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fees_receipt">Fees Receipt</label>
                                            <input type="file" name="fees_receipt" class="form-control" id="fees_receipt" required>
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

</html>
