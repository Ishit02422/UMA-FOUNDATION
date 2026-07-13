<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Uma Foundation</title>

    <!-- Bootstrap core CSS -->
    <link href="../test1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../test1/assets/css/fontawesome.css">
    <link rel="stylesheet" href="../test1/assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../test1/assets/css/owl.css">
    <link rel="stylesheet" href="../test1/assets/css/lightbox.css">
<!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting


-->
<style>


#ff {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}

#profileForm {
    background-color: #333; /* Dark gray background for the form */
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
}

/* Form input fields and labels */
#profileForm label {
    display: block;
    margin-bottom: 5px;
    color: #ddd; /* Light gray for labels */
}

#profileForm input[type="text"],
#profileForm input[type="email"],
#profileForm input[type="tel"],
#profileForm input[type="date"],
#profileForm textarea,
#profileForm select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #444;
    border-radius: 5px;
    background-color: #222;
    color: #fff;
}

/* Buttons */
#profileForm button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    margin-bottom: 10px;
}

#profileForm button:hover {
    background-color: #0056b3;
}

#profileForm button#editProfile {
    background-color: #28a745;
}

#profileForm button#editProfile:hover {
    background-color: #218838;
}

#profileForm button#update {
    background-color: #ffc107;
}

#profileForm button#update:hover {
    background-color: #e0a800;
}

#profileForm button#home {
    background-color: #17a2b8;
}

#profileForm button#home:hover {
    background-color: #138496;
}

#profileForm button#logout {
    background-color: #dc3545;
}

#profileForm button#logout:hover {
    background-color: #c82333;
}

</style>
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
                          <li class="scroll-to-section"><a href="../index.php" class="active"> Home </a></li>
                          <li><a href="#"> Hall Booking </a></li>
                          <li ><a href="../test1/donationform.php"> Donation </a></li>
                          <li class="has-sub">
                            <a> Announcement </a>
                              <ul class="sub-menu">
                                <li><a href="../test1/announcement.php"> Event </a></li>
                                <li><a href="#"> SchoralShip </a></li>
                              </ul>
                          </li>
                      <li class="has-sub">
                        <a> Apply </a>
                        <ul class="sub-menu">
                          <li><a href="#">Committe Member</a></li>
                          <li><a href="#">Committe Major</a></li>
                        </ul>
                      </li>
              
              <?php
              if (isset($_SESSION["id"])) {
              ?>
                <li ><a href="../logout.php"> Logout </a></li>
              <?php
              } else {
              ?>
                <li ><a href="../Registration.php"> Registration </a></li>
                <li ><a href="../login.php"> Login </a></li>
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

  

  <section class="meetings-page" id="meetings">
            <div>
            <div id="ff">
      <form id="profileForm">
        <?php
          include "../connect.php";
          // Use session to get userId in real implementation
          $query = "SELECT * FROM tbl_user WHERE id = '".$_SESSION["id"]."'";
          $result = mysqli_query($con, $query);

          if (mysqli_num_rows($result) > 0) {
              $user = mysqli_fetch_assoc($result);
              ?>
              <div>
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" readonly>
                  <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
              </div>
              <div>
                  <label for="uname">User Name:</label>
                  <input type="text" name="uname" id="uname" value="<?php echo $user['username']; ?>" readonly>
              </div>
              <div>
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" readonly>
              </div>
              <div>
                  <label for="cno">Contact Number:</label>
                  <input type="tel" name="cno" id="cno" value="<?php echo $user['contactno']; ?>" readonly>
              </div>
              <div>
                  <label for="gender">Gender:</label>
                  <select name="gender" id="gender" disabled>
                      <?php if ($user['gender'] == '1') { ?>
                          <option value="1" selected>Female</option>
                          <option value="0">Male</option>
                          <option value="3">Other</option>
                      <?php } elseif ($user['gender'] == '0') { ?>
                          <option value="0" selected>Male</option>
                          <option value="1">Female</option>
                          <option value="3">Other</option>
                      <?php } else { ?>
                          <option value="3" selected>Other</option>
                          <option value="0">Male</option>
                          <option value="1">Female</option>
                      <?php } ?>
                  </select>
              </div>
              <div>
                  <label for="dob">Date of Birth:</label>
                  <input type="date" name="dob" id="dob" value="<?php echo $user['dob']; ?>" readonly>
              </div>
              <div>
                  <label for="address">Address:</label>
                  <textarea name="address" id="address" rows="4" readonly><?php echo $user['address']; ?></textarea>
              </div>
              <div>
                  <label for="city">City:</label>
                  <select name="city" id="city" disabled>
                      <?php
                          $cityId = $user['cityid'];
                          $cityQuery = "SELECT * FROM tbl_city";
                          $cityResult = mysqli_query($con, $cityQuery);
                          while ($cityRow = mysqli_fetch_assoc($cityResult)) {
                              if ($cityRow['id'] == $cityId) {
                                  echo "<option value='{$cityRow['id']}' selected>{$cityRow['name']}</option>";
                              } else {
                                  echo "<option value='{$cityRow['id']}'>{$cityRow['name']}</option>";
                              }
                          }
                      ?>
                  </select>
              </div>
              <div>
                  <button type="button" id="editProfile">Edit Profile</button>
                  <button type="button" id="home">Home</button>
                  <button type="button" id="logout">Logout</button>
                  <button type="submit" id="update" hidden>Submit</button>
              </div>
              <?php
          } else {
              echo "<p>No user found.</p>";
          }
        ?>
      </form>
    </div>
    <script src="../test1/vendor/jquery/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
          $("#editProfile").click(function(){
              $("#name").removeAttr('readonly');
              $("#uname").removeAttr('readonly');
              $("#cno").removeAttr('readonly');
              $("#gender").removeAttr('disabled');
              $("#email").removeAttr('readonly');
              $("#dob").removeAttr('readonly');
              $("#address").removeAttr('readonly');
              $("#city").removeAttr('disabled');
              $("#update").removeAttr('hidden');
              $("#editProfile").hide();
          });

          $("#home").click(function() {
              window.location.href = '../test1/index.php';
          });

          $("#logout").click(function() {
              window.location.href = '../login.php';
          });

          $('#profileForm').on('submit', function(e) {
              e.preventDefault();
              const formData = new FormData(this);
              $.ajax({
                  url: '../updateprofile.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                      if(response == true) {
                          alert('Profile updated successfully');
                          location.reload();
                      } else {
                          alert(response);
                      }
                  },
                  error: function(xhr, status, error) {
                      alert('Error updating profile: ' + error);
                  }
              });
          });
      });
    </script>
            </div>
    <div class="footer">
      <p>Copyright © 2024 Uma Foundation. All Rights Reserved.
        <!-- <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p> -->
    </div>
  </section>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!--<script src="assets/js/isotope.min.js"></script>-->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <!--<script src="assets/js/custom.js"></script>-->
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>


  </body>

</html>