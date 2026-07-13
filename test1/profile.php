<?php
session_start();
// Prevent browser from showing stale/blank page via bfcache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Uma Foundation</title>

    <!-- Bootstrap core CSS -->
    <link href="test1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../test1/assets/css/fontawesome.css">
    <link rel="stylesheet" href="../test1/assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../test1/assets/css/owl.css">
    <link rel="stylesheet" href="../test1/assets/css/lightbox.css">
    <!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
<link rel="stylesheet" href="assets/css/uma-custom.css">
</head>

<body>

    <!-- Sub Header -->
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-8">
                    <div class="left-content">
                        <!-- <p>This is an educational <em>HTML CSS</em> template by TemplateMo website.</p> -->
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="right-icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/_prachi13/"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/prachi-patel-a1768724b/"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            Uma Foundation
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="index.php" class="active"> Home </a></li>
                            <li><a href="#"> Hall Booking </a></li>
                            <li class="scroll-to-section"><a href="#"> Donation </a></li>
                            <li class="has-sub">
                                <a href="javascript:void(0)"> Announcement </a>
                                <ul class="sub-menu">
                                    <li><a href="#"> Event </a></li>
                                    <li><a href="#"> SchoralShip </a></li>

                                </ul>
                            </li>

                            <?php
                            if (isset($_SESSION["id"])) {
                            ?>
                                <li class="scroll-to-section"><a href="../logout.php"> Logout </a></li>
                            <?php
                            } else {
                            ?>
                                <li class="scroll-to-section"><a href="Registration.php"> Registration </a></li>
                                <li class="scroll-to-section"><a href="login.php"> Login </a></li>
                            <?php
                            }

                            ?>


                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <!-- <section class="section main-banner" id="top" data-section="section1">
    <video autoplay muted loop id="bg-video">
      <source src="assets/images/course-video.mp4" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="caption"> -->
    <!-- <h6>Hello Students</h6> -->
    <!-- <h2> Welcome to Uma Foundation </h2>
              <p> The Uma Foundation - Community Management System aims to develop an innovative and efficient online platform for managing various activities and services within the community. </p>
              <div class="main-button-red">
                <div class="scroll-to-section"><a href="../Registration.php"> Registration!</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
    <!-- ***** Main Banner Area End ***** -->

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-service-item owl-carousel">

                        <div class="item">
                            <div class="icon">
                                <img src="assets/images/service-icon-01.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4> Hall Booking </h4>
                                <p> Apply For Hall Bokking. </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="assets/images/service-icon-02.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4> Donation </h4>
                                <p> Apply For Donation. </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="assets/images/service-icon-03.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4> Announcement </h4>
                                <p> Display Annoucement. </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="assets/images/service-icon-02.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4> SchoralShip </h4>
                                <p> Information SchoralShip. </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="icon">
                                <img src="assets/images/service-icon-03.png" alt="">
                            </div>
                            <div class="down-content">
                                <h4> Event </h4>
                                <p> Event Details. </p>
                            </div>
                        </div>

                    </div>
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
                                    <h3 class="card-title">Profile form</h3>
                                </div>

                                <?php
                                include "../connect.php";
                                if (isset($_SESSION['id'])) {

                                    $id = intval($_SESSION['id']);


                                    $query = "SELECT * FROM tbl_user WHERE id = " . $_SESSION['id'] . "";
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

                                <form id="hallbookingform" action="#" method="post">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2>Profile FORM</h2>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $row['name']; ?>" required>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="<?php echo $row['username']; ?>" required>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="gender">Gender</label>

                                                <input type="radio" id="male" name="gender" class="form-control" id="gender" value="Male" <?php if ($row['gender'] == 0) echo "checked"; ?>> Male
                                                <input type="radio" id="female" name="gender" class="form-control" value="Female" id="gender" <?php if ($row['gender'] == 1) echo "checked"; ?>> Female

                                            </fieldset>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="dob">DOB</label>
                                                <input type="date" name="dob" class="form-control" id="dob" value="<?php echo $row['dob']; ?>" required>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="contactno">Contact No</label>
                                                <input type="tel" name="contactno" class="form-control" id="contactno" placeholder="Enter Contact No" value="<?php echo $row['contactno']; ?>" required>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-12">
                                            <fieldset>
                                                <label for="address">Address</label>
                                                <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="<?php echo $row['address']; ?>" required>
                                                <div id="suggestions" class="autocomplete-suggestions"></div>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $row['email']; ?>" required>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-6">
                                            <fieldset>
                                                <label for="role">Role</label>
                                                <input type="text" name="role" class="form-control" id="role" placeholder="Enter Role" value="<?php echo $row['role']; ?>" required>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-12">
                                            <fieldset>
                                                <label for="cityname">City Name</label>
                                                <select name="city" id="city" class="form-control">
                                                    <?php
                                                    include "connect.php";
                                                    $query = "select * from tbl_city";
                                                    $result = mysqli_query($con, $query);
                                                    if ($result->num_rows > 0) {
                                                        while ($row1 = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value=<?php echo $row1["id"]; ?> <?php if($row["cityid"]==$row1["id"]) echo "selected" ?>><?php echo $row1["name"];?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-lg-12">
                                            <br>
                                            <fieldset>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </fieldset>
                                        </div>
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
    <script>
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        const fetchSuggestions = debounce(function(input) {
            if (input.length < 3) {
                document.getElementById('suggestions').innerHTML = '';
                return;
            }
            const location = '23.204547904342565, 70.87135416153141'; //23.204547904342565, 70.87135416153141
            const apiKey = 'PEDy9RDQZovqNa0v5z43MovpPUOQNBeXE2RiVdAg';
            const url = `https://api.olamaps.io/places/v1/autocomplete?location=${location}&input=${input}&api_key=${apiKey}`;

            fetch(url, {
                    headers: {
                        'X-Request-Id': 'your-request-id'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('API Response:', data);
                    const suggestionsDiv = document.getElementById('suggestions');
                    suggestionsDiv.innerHTML = '';
                    if (data.predictions && data.predictions.length > 0) {
                        data.predictions.forEach(prediction => {
                            const suggestionDiv = document.createElement('div');
                            suggestionDiv.className = 'autocomplete-suggestion';
                            suggestionDiv.textContent = prediction.description; // Use 'description' property
                            suggestionDiv.addEventListener('click', () => {
                                const {
                                    lat,
                                    lng
                                } = prediction.geometry.location;
                                callcity(lat, lng);
                                document.getElementById('address').value = prediction.description; // Use 'description' property
                                suggestionsDiv.innerHTML = '';
                            });
                            suggestionsDiv.appendChild(suggestionDiv);
                        });
                    } else {
                        console.error('No predictions found in the response');
                    }
                })
                .catch(error => console.error('Error fetching autocomplete suggestions:', error));
        }, 300);

        document.getElementById('address').addEventListener('input', function() {
            fetchSuggestions(this.value);
        });

        function callcity(lat, log) {
            var count = 0;
            // const location = '19.265980587014074,72.96698942923868';
            const apiKey = 'PEDy9RDQZovqNa0v5z43MovpPUOQNBeXE2RiVdAg';
            const url = `https://api.olamaps.io/places/v1/reverse-geocode?latlng=${lat}%2C${log}&api_key=${apiKey}`;

            fetch(url, {
                    headers: {
                        'X-Request-Id': 'your-request-id'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // if (getstate(data) == false) {
                    //     alert("The address should belong to Gujrat only");
                    //     return;
                    // }
                    getcity(data);
                    console.log(count++);
                });
        }

        function getstate(apiResponse) {
            var count = 0;
            var results = apiResponse.results;
            var sublocalities = new Set();

            for (let i = 0; i < results.length; i++) {
                const addressComponents = results[i].address_components;
                for (let j = 0; j < addressComponents.length; j++) {
                    if (addressComponents[j].types.includes("administrative_area_level_1")) {
                        const locality = addressComponents[j].long_name;
                        if (locality === "GUJARAT") {

                            return true;
                        } else {
                            document.getElementById('address').value = '';
                            return false;
                        }
                    }
                }
            }
            alert(`No match found for sub-locality please choose manually`);
            return;
        }

        function getcity(apiResponse) {
            var count = 0;
            var results = apiResponse.results;
            var sublocalities = new Set(); // Use a set to track unique sublocalities

            for (let i = 0; i < results.length; i++) {
                const addressComponents = results[i].address_components;
                for (let j = 0; j < addressComponents.length; j++) {
                    if (addressComponents[j].types.includes("locality")) {
                        const sublocality = addressComponents[j].long_name;
                        if (!sublocalities.has(sublocality)) {
                            sublocalities.add(sublocality);
                            console.log(sublocality);
                            if (matchAreaWithSublocality(sublocality) === "ok") {
                                console.log("done");
                                return;
                            } else {

                            }
                        }
                    }
                }
            }
            alert(`No match found for sub-locality please choose manually`);
            return null;
        }

        function matchAreaWithSublocality(sublocalityName) {
            const areaSelect = document.getElementById('city');
            const options = areaSelect.options;

            for (let i = 0; i < options.length; i++) {
                if (options[i].text.toLowerCase() === sublocalityName.toLowerCase()) {
                    areaSelect.value = options[i].value;
                    console.log(`Matched area: ${options[i].text} with sub-locality: ${sublocalityName}`);

                    return "ok";
                }
            }

            return null;
        }
    </script>
</body>

</html>