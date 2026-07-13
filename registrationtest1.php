<?php
session_start();
if(!empty($_SESSION['username']) & !empty($_SESSION['password'])){
   header('Location:login.php');
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="TemplateMo">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Uma Foundation</title>

  <!-- Bootstrap core CSS -->
  <link href="test1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style> 
  .autocomplete-suggestion {
            padding: 10px;
            cursor: pointer;
            background-color: white;
        }

        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
        }
</style>
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="test1/assets/css/fontawesome.css">
  <link rel="stylesheet" href="test1/assets/css/templatemo-edu-meeting.css">
  <link rel="stylesheet" href="test1/assets/css/owl.css">
  <link rel="stylesheet" href="test1/assets/css/lightbox.css">
  <!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
<link rel="stylesheet" href="test1/assets/css/uma-custom.css">
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
            <a href="index.php" class="logo">
              Uma Foundation
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="index.php" class="active"> Home </a></li>
              <li><a href="test1/hallbooking.php"> Hall Booking </a></li>
              <li class="scroll-to-section"><a href="#apply"> Donation </a></li>
              <li class="has-sub">
                <a href="javascript:void(0)"> Announcement </a>
                <ul class="sub-menu">
                  <li><a href="test1/announcement.php"> Event </a></li>
                  <li><a href="scholarship.php"> SchoralShip </a></li>

                </ul>
              </li>

              <?php
              if (isset($_SESSION["id"])) {
              ?>
                <li class="scroll-to-section"><a href="../logout.php"> Logout </a></li>
              <?php
              } else {
              ?>
                <li class="scroll-to-section"><a href="../Registration.php"> Registration </a></li>
                <li class="scroll-to-section"><a href="../login.php"> Login </a></li>
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

  <!-- <section class="upcoming-meetings" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2> Upcoming Event </h2>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="categories">
            <h4> Announcement </h4>
            <ul>
              <li><a href="#"> Event </a></li> -->
  <!-- <li><a href="#"> Navratri </a></li>
              <li><a href="#"> Diwali </a></li>
              <li><a href="#"> Navratr </a></li>
              <li><a href="#"> Diwali </a></li> -->
  <!-- </ul>
            <div class="main-button-red">
              <a href="test1/announcement.php"> All Upcoming Events </a>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span>$22.00</span>
                  </div>
                  <a href="scholarship.php"><img src="<?php echo ($row['image']); ?>" alt="New Lecturer Meeting">
                  </a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Nov <span>10</span></h6>
                  </div>
                  <a href="scholarship.php">
                    <h4>New Lecturers Meeting</h4>
                  </a>
                  <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span>$36.00</span>
                  </div>
                  <a href="scholarship.php"><img src="assets/images/meeting-02.jpg" alt="Online Teaching"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Nov <span>24</span></h6>
                  </div>
                  <a href="scholarship.php">
                    <h4>Online Teaching Techniques</h4>
                  </a>
                  <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span>$14.00</span>
                  </div>
                  <a href="scholarship.php"><img src="assets/images/meeting-03.jpg" alt="Higher Education"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Nov <span>26</span></h6>
                  </div>
                  <a href="scholarship.php">
                    <h4>Higher Education Conference</h4>
                  </a>
                  <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="meeting-item">
                <div class="thumb">
                  <div class="price">
                    <span>$48.00</span>
                  </div>
                  <a href="scholarship.php"><img src="assets/images/meeting-04.jpg" alt="Student Training"></a>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6>Nov <span>30</span></h6>
                  </div>
                  <a href="scholarship.php">
                    <h4>Student Training Meetup</h4>
                  </a>
                  <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- <section class="apply-now" id="apply">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h3> Apply for Event</h3>
                <p>You are allowed to use this edu meeting CSS template for your school or university or business. You can feel free to modify or edit this layout.</p>
                <div class="main-button-red">
                  <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h3>APPLY FOR BACHELOR DEGREE</h3>
                <p>You are not allowed to redistribute the template ZIP file on any other template website. Please contact us for more information.</p>
                <div class="main-button-yellow">
                  <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="accordions is-first-expanded">
            <article class="accordion">
              <div class="accordion-head">
                <span>About Edu Meeting HTML Template</span>
                <span class="icon">
                  <i class="icon fa fa-chevron-right"></i>
                </span>
              </div>
              <div class="accordion-body">
                <div class="content">
                  <p>If you want to get the latest collection of HTML CSS templates for your websites, you may visit <a rel="nofollow" href="https://www.toocss.com/" target="_blank">Too CSS website</a>. If you need a working contact form script, please visit <a href="https://templatemo.com/contact" target="_parent">our contact page</a> for more info.</p>
                </div>
              </div>
            </article>
            <article class="accordion">
              <div class="accordion-head">
                <span>HTML CSS Bootstrap Layout</span>
                <span class="icon">
                  <i class="icon fa fa-chevron-right"></i>
                </span>
              </div>
              <div class="accordion-body">
                <div class="content">
                  <p>Etiam posuere metus orci, vel consectetur elit imperdiet eu. Cras ipsum magna, maximus at semper sit amet, eleifend eget neque. Nunc facilisis quam purus, sed vulputate augue interdum vitae. Aliquam a elit massa.<br><br>
                    Nulla malesuada elit lacus, ac ultricies massa varius sed. Etiam eu metus eget nibh consequat aliquet. Proin fringilla, quam at euismod porttitor, odio odio tempus ligula, ut feugiat ex erat nec mauris. Donec viverra velit eget lectus sollicitudin tincidunt.</p>
                </div>
              </div>
            </article>
            <article class="accordion">
              <div class="accordion-head">
                <span>Please tell your friends</span>
                <span class="icon">
                  <i class="icon fa fa-chevron-right"></i>
                </span>
              </div>
              <div class="accordion-body">
                <div class="content">
                  <p>Ut vehicula mauris est, sed sodales justo rhoncus eu. Morbi porttitor quam velit, at ullamcorper justo suscipit sit amet. Quisque at suscipit mi, non efficitur velit.<br><br>
                    Cras et tortor semper, placerat eros sit amet, porta est. Mauris porttitor sapien et quam volutpat luctus. Nullam sodales ipsum ac neque ultricies varius.</p>
                </div>
              </div>
            </article>
            <article class="accordion last-accordion">
              <div class="accordion-head">
                <span>Share this to your colleagues</span>
                <span class="icon">
                  <i class="icon fa fa-chevron-right"></i>
                </span>
              </div>
              <div class="accordion-body">
                <div class="content">
                  <p>Maecenas suscipit enim libero, vel lobortis justo condimentum id. Interdum et malesuada fames ac ante ipsum primis in faucibus.<br><br>
                    Sed eleifend metus sit amet magna tristique, posuere laoreet arcu semper. Nulla pellentesque ut tortor sit amet maximus. In eu libero ullamcorper, semper nisi quis, convallis nisi.</p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- <section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Our Popular Courses</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel">
            <div class="item">
              <img src="assets/images/course-01.jpg" alt="Course One">
              <div class="down-content">
                <h4>Morbi tincidunt elit vitae justo rhoncus</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$160</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-02.jpg" alt="Course Two">
              <div class="down-content">
                <h4>Curabitur molestie dignissim purus vel</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$180</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-03.jpg" alt="">
              <div class="down-content">
                <h4>Nulla at ipsum a mauris egestas tempor</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$140</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-04.jpg" alt="">
              <div class="down-content">
                <h4>Aenean molestie quis libero gravida</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$120</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-01.jpg" alt="">
              <div class="down-content">
                <h4>Lorem ipsum dolor sit amet adipiscing elit</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$250</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-02.jpg" alt="">
              <div class="down-content">
                <h4>TemplateMo is the best website for Free CSS</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$270</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-03.jpg" alt="">
              <div class="down-content">
                <h4>Web Design Templates at your finger tips</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$340</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-04.jpg" alt="">
              <div class="down-content">
                <h4>Please visit our website again</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$360</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-01.jpg" alt="">
              <div class="down-content">
                <h4>Responsive HTML Templates for you</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$400</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-02.jpg" alt="">
              <div class="down-content">
                <h4>Download Free CSS Layouts for your business</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$430</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-03.jpg" alt="">
              <div class="down-content">
                <h4>Morbi in libero blandit lectus cursus</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$480</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="assets/images/course-04.jpg" alt="">
              <div class="down-content">
                <h4>Curabitur molestie dignissim purus</h4>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul>
                    </div>
                    <div class="col-4">
                      <span>$560</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- <section class="our-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <h2>A Few Facts About Our University</h2>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-12">
                  <div class="count-area-content percentage">
                    <div class="count-digit">94</div>
                    <div class="count-title">Succesed Students</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="count-area-content">
                    <div class="count-digit">126</div>
                    <div class="count-title">Current Teachers</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-12">
                  <div class="count-area-content new-students">
                    <div class="count-digit">2345</div>
                    <div class="count-title">New Students</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="count-area-content">
                    <div class="count-digit">32</div>
                    <div class="count-title">Awards</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 align-self-center">
          <div class="video">
            <a href="https://www.youtube.com/watch?v=HndV87XpkWg" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section> -->
                    
  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" class="GG" action="#" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>REGISTRATION FORM</h2>

                    <div class="col-lg-6">
                      <fieldset>
                        <input name="name" type="text" id="name" pattern="[A-Za-z ]*" minlength="2" placeholder="Name" title="Please Enter only Alphabet character!" required>
                        <div id="name-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input name="uname" type="text" id="uname" minlength="2" placeholder="User Name" required>
                        <div id="uname-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset>
                            <legend>Gender:</legend>
                            <select name="gender" id="gender" class="form-control">
                                <option value="M" selected>Male</option>
                                <option value="F">Female</option>
                                <option value="O">Other</option>
                            </select>
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                      <fieldset>
                        <input type="date" id="dob" name="dob" required title="Please Select Date of Birth!">
                        <div id="dob-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="tel" id="cno" name="cno" maxlength="10" minlength="10" pattern="[0-9]{10}" placeholder="Contact Number" required title="Please Enter only 10 digit Number!">
                        <div id="phone-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <textarea id="address" name="address" rows="4" cols="20" minlength="5" placeholder="Address" required title="Please Enter your Proper Address!"></textarea>
                        <div id="suggestions" class="autocomplete-suggestions"></div>
                        <div id="address-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <select name="city" id="city">
                          <?php
                          include "connect.php";
                          $query = "select * from tbl_city";
                          $result = mysqli_query($con, $query);
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                          ?>
                              <option value=<?php echo $row["id"]; ?>><?php echo $row["name"]; ?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
                        </fieldset>
                        <div id="city-error" class="error"></div>
                      
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="email" name="email" id="email" size="21" placeholder="xyz12@gmail.com" pattern="[a-z0-9._%+\-]+@[a-z0-z0-9.\-]+\.[a-z]{2,}$" required title="Please Enter proper character, special character, and digit!">
                        <div id="email-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <div id="password-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <label>Caste Certificate</label><br>
                        <input type="file" id="file" name="file" required title="Upload Caste Certificate!">
                        <div id="file-error" class="error"></div>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <button type="submit" name="submit" id="form-submit" class="button">SUBMIT</button>
                        <button type="submit" name="reset" id="form-submit" class="button">RESET</button>
                      </fieldset>
                    </div>

                  </div>
              </form>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-3">
          <div class="right-info">
            <ul>
              <li>
                <h6>Phone Number</h6>
                <span>010-020-0340</span>
              </li>
              <li>
                <h6>Email Address</h6>
                <span>info@meeting.edu</span>
              </li>
              <li>
                <h6>Street Address</h6>
                <span>Rio de Janeiro - RJ, 22795-008, Brazil</span>
              </li>
              <li>
                <h6>Website URL</h6>
                <span>www.meeting.edu</span>
              </li>
            </ul>
          </div>
        </div> -->
      </div>
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

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/lightbox.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/video.js"></script>
  <script src="assets/js/slick-slider.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    //according to loftblog tut
    $('.nav li:first').addClass('active');

    // var showSection = function showSection(section, isAnimate) {
    //   var
    //     direction = section.replace(/#/, ''),
    //     reqSection = $('.section').filter('[data-section="' + direction + '"]'),
    //     reqSectionPos = reqSection.offset().top - 0;

    //   if (isAnimate) {
    //     $('body, html').animate({
    //         scrollTop: reqSectionPos
    //       },
    //       800);
    //   } else {
    //     $('body, html').scrollTop(reqSectionPos);
    //   }

    // };

    // var checkSection = function checkSection() {
    //   $('.section').each(function() {
    //     var
    //       $this = $(this),
    //       topEdge = $this.offset().top - 80,
    //       bottomEdge = topEdge + $this.height(),
    //       wScroll = $(window).scrollTop();
    //     if (topEdge < wScroll && bottomEdge > wScroll) {
    //       var
    //         currentId = $this.data('section'),
    //         reqLink = $('a').filter('[href*=\\#' + currentId + ']');
    //       reqLink.closest('li').addClass('active').
    //       siblings().removeClass('active');
    //     }
    //   });
    // };

    // $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
    //   e.preventDefault();
    //   showSection($(this).attr('href'), true);
    // });

    // $(window).scroll(function() {
    //   checkSection();
    // });
  </script>
</body>
<script>
    $(document).ready(function(){
      
    $('.GG').on('submit', function(e){
        e.preventDefault();
        let valid = true;

        const nameRegex = /^[a-zA-Z]+(\s[a-zA-Z]+){1,2}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^\d{10}$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const unameRegex = /^([a-zA-Z]){2,}$/;
        const address = $('#address').val().trim();
    
        const name = $('#name').val();
        const email = $('#email').val();
        const phone = $('#cno').val();
        const dob = $('#dob').val();
        const password = $('#password').val();
        const uname = $('#uname').val();
        const file = $('#file').val();
        const birthDate = new Date(dob);
                const today = new Date();
                var age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                if (age < 1) {
                    $('#dob-error').show();
                    valid = false;
                } else {
                    $('#dob-error').hide();
                }

        if (!nameRegex.test(name)) {
            $('#name-error').show();
            valid = false;
        } else {
            $('#name-error').hide();
        }
        if (!passwordRegex.test(password)) {
            $('#password-error').show();
            valid = false;
        } else {
            $('#password-error').hide();
        }
        if (!unameRegex.test(uname)) {
            $('#uname-error').show();
            valid = false;
        } else {
            $('#uname-error').hide();
        }
        if (!emailRegex.test(email)) {
            $('#email-error').show();
            valid = false;
        } else {
            $('#email-error').hide();
        }

        if (!phoneRegex.test(phone)) {
            $('#phone-error').show();
            valid = false;
        } else {
            $('#phone-error').hide();
        }
        if (!address) {
            $('#address-error').show();
            valid = false;
        } else {
            $('#address-error').hide();
        }
        if(!file)
        {
            $('#file-error').show();
        }
        else
        {
            $('#file-error').hide();
        }
        const formData = new FormData(this);
        if (valid) {
            $.ajax({
                url: 'Register_Member.php',
                method: 'POST',
                data: formData,
                contentType: false, 
                processData: false,
                success: function(response) {
                    if(response==true)
                    {
                        alert("User Registeration successfull");
                        window.location='registrationotp.php';
                    }
                    else
                    {
                    if(response=="user exists")
                        {
                            alert("User already exists");
                        }
                    else
                    {
                        
                        if(response=="Please Upload only PDF file for Certificate!")
                        {
                            $('#file-error').show();
                        }
                        else
                        {
                            alert("error:"+response);
                        }
                    }
                }
            }
            });
        }
    });
});
</script>
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
            const location = '21.176633196051704,72.83300753723111';//23.204547904342565, 70.87135416153141
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
                                callcity(lat,lng);
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
                        if (locality == "GUJARAT") {

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
            console.log(apiResponse)
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


</html>