<?php
session_start();
include('models/Events.php');
if (!isset($_SESSION['id'])){
  header('location:login.php');
}

$event[] = get_event($_GET);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Novy - Charge de travail</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="index.php" class="logo">NOVY  <span class="lite">Dashboard charge de travail</span></a>
            <!--logo end-->

            <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" placeholder="Search" type="text">
                        </form>
                    </li>                    
                </ul>
                <!--  search form end -->                
            </div>

            <div class="top-nav notification-row">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar.png">
                            </span>
                            <span class="username"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="#"><i class="icon_profile"></i> Mon profil</a>
                            </li>
                            <li>
                                <a href="models/deconnexion.php"><i class="icon_key_alt"></i> Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->

            <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span>Emploi du temps</span>
                      </a>
                  </li>
          <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Evenements</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="list_events.php">Liste des évènements</a></li>                          
                          <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>                          
                            <li><a class="" href="add_event.php">Ajouter un évènement</a></li>
                          <?php } ?>
                      </ul>
                  </li> 
                  <li>
                      <a href="profil.php" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Profil</span>
                      </a>
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-user-md"></i> Evenement</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.php">Accueil</a></li>
            <li><i class="fa fa-user-md"></i>Evenement</li>
          </ol>
        </div>
      </div>
              <!-- page start-->
              <div class="row">
              <div class="panel-body">
                              <div class="tab-content">
                                  <!-- profile -->
                                  <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                      <div class="panel-body bio-graph-info">
                                          <div class="row">
                                              <div class="bio-row">
                                                  <p><span>Titre </span>: <?php echo $event[0][0]['title']; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Professeur </span>: <?php echo $event[0][0]['first_name']." ".$event[0][0]['last_name']; ?></p>
                                              </div>                    
                                              <div class="bio-row">
                                                  <p><span>Date de début </span>: <?php echo $event[0][0]['start_date']; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Date de fin </span>: <?php echo $event[0][0]['end_date']; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Charge </span>: <?php echo $event[0][0]['hoursOfWork']; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Desciption </span>: <?php echo $event[0][0]['description']; ?></p>
                                              </div>
                                          </div>
                                      </div>
                                    </section>
                                      <section>
                                          <div class="row">                                              
                                          </div>
                                      </section>
                                  </div>
                              </div>
                          </div>
                        </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script><!--custome script for all page-->
    <script src="js/scripts.js"></script>


  </body>
</html>
