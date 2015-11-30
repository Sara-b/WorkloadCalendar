<?php
session_start(); 
include('models/Events.php');
if (!isset($_SESSION['id'])){
  header('location:login.php');
}

//$promotion_id = search($search_promo);
$events = get_eventsByPromotion();
$promotions = get_promotion();
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
    <!-- full calendar css-->
    <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet"> 
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
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
                                <a href="profil.php"><i class="icon_profile"></i> Mon profil</a>
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
                          <li><a class="" href="list_events.php?promotion_id=1">Liste des évènements</a></li>
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
					<h3 class="page-header"><i class="fa fa fa-bars"></i> Liste des évènements</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Accueil</a></li>
						<li><i class="fa fa-bars"></i>Evenements</li>
						<li><i class="fa fa-square-o"></i>Liste des évènements</li>
					</ol>
				</div>
			</div>
              
              <!-- page start-->
              <?php
                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                    <div class="col-md-7">
                        <label class="col-md-2 control-label" for="group_event">Promotion</label>
                      
                      <form method="get" action"<?php get_eventsByPromotion() ?>">
                        <div class="col-md-4">
                            <select id="group_event" name="promotion_id" class="form-control">
                              <?php  foreach ($promotions as $promotion) { 
                                if ($_GET['promotion_id'] == $promotion['id']) { ?>
                                  <option selected="selected" value="<?php echo $promotion['id']; ?>"><?php echo $promotion['title']; ?></option>
                                <?php } else{ ?>
                                  <option value="<?php echo $promotion['id']; ?>"><?php echo $promotion['title']; ?></option>

                                <?php }
                                 } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                          <button class="btn btn-primary btn-block" type="submit">Rechercher</button>
                        </div>
                      </form>
                    </div>
                  
                <div class="row">
                  <div class="col-lg-12">
                  </div>
                </div><?php
                } ?>    
                <div class="row">
                  <div class="col-md-12">
                  </div>
                </div>

              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Professeur</th>
                                 <th>Titre</th>
                                 <th></i> Description</th>
                                 <th><i class="icon_calendar"></i> Debut</th>
                                 <th><i class="icon_calendar"></i> Fin</th>
                                 <th></i> Charge</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
                               <?php 
                                foreach ($events as $event) { ?>
                                <tr>
                                 <td><?php echo $event['first_name'].' '.$event['last_name'];?></td>
                                 <td><?php echo $event['title'];?></td>
                                 <td><?php echo $event['title'];?></td>
                                 <td><?php echo $event['start_date'];?></td>
                                 <td><?php echo $event['end_date'];?></td>
                                 <td><?php echo $event['hoursOfWork'];?></td>
                                 <td>
                                  <?php //var_dump($event[0]) ?>
                                  <div class="btn-group">
                                      <a class="btn btn-success" href="event.php?id=<?php echo $event['0'] ?>"><i class="icon_plus_alt2"></i></a>
                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['id'] == $event['id_professeur']) { ?>
                                      <a class="btn btn-primary" href="update_event.php?id=<?php echo $event['0'] ?>"><i class="icon_check_alt2"></i></a>
                                      <a class="btn btn-danger" href="<?php delete_event($event['id']) ?>"><i class="icon_close_alt2"></i></a>
                                      <?php } ?>
                                  </div>
                                  </td>
                              </tr>
                             <?php }?>
                              
                           </tbody>
                        </table>
                      </section>
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
