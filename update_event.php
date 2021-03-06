<?php
session_start();
include('models/Events.php');
if (!isset($_SESSION['id'])){
  header('location:login.php');
}

$event[] = get_event($_GET);
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
          <h3 class="page-header"><i class="fa fa-user-md"></i> Evenement</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.php">Accueil</a></li>
            <li><i class="fa fa-user-md"></i>Evenement</li>
          </ol>
        </div>
      </div>
              <!-- page start-->
              <!-- edit-profile -->
    <div id="edit-profile" class="tab-pane">
      <section class="panel">                                          
            <div class="panel-body bio-graph-info">
                <h1> Profile Info</h1>
                <form class="form-horizontal" method="post" action="<?php echo 'controllers/update_event.php?id='.$_GET['id']; ?>">
              <fieldset>

              <!-- Form AJOUT EVENT -->
              <legend>Modifier un évènement</legend>

              <?php if(!empty($_GET['message']) && $_GET['message'] == "success") { ?>
              <div class="alert alert-info">
                <strong>Succès!</strong> L'évènement a correctement été mis à jour.
              </div>
              <?php } ?>
              <?php if(!empty($_GET['message']) && $_GET['message'] == "fail") { ?>
              <div class="alert alert-danger">
                <strong>Une erreur est survenue.</strong> L'évènement n'a pas été mis à jour correctement.
              </div>
              <?php } ?>
              <?php if(!empty($_GET['message']) && $_GET['message'] == "too_many_hours") { ?>
              <div class="alert alert-danger">
                <strong>Echec !</strong> Trop d'heures de travail sont déjà prévues sur cette période. Réduisez le nombre d'heures ou choisissez une autre période.
              </div>
              <?php } ?>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="title_event">Titre</label>  
                <div class="col-md-4">
                <input id="title_event" value="<?php echo $event[0][0]['title']; ?>" name="title_event" type="text" placeholder="Titre de l'évènement" class="form-control input-md" required="">
                  
                </div>
              </div>

              <!-- Textarea -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="description_event">Explications</label>
                <div class="col-md-4">                     
                  <textarea class="form-control" id="description_event" name="description_event"><?php echo $event[0][0]['description']; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="startDate">Date de début</label>
                  <div class='col-sm-2'>
                      <input type='date' class="form-control input-md" value="<?php echo $event[0][0]['start_date']; ?>" required="" name="startDate"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="endDate">Date de fin</label>
                  <div class='col-sm-2'>
                      <input type='date' class="form-control input-md" value="<?php echo $event[0][0]['end_date']; ?>" required="" name="endDate"/>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="hours_event">Heures nécessaires à la réalisation</label>  
                <div class="col-md-4">
                <input id="hours_event" name="hours_event" value="<?php echo $event[0][0]['hoursOfWork']; ?>" type="text" placeholder="Nombre d'heures (entières)" class="form-control input-md" required="">
                  
                </div>
              </div>

              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="group_event">Promotion</label>
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
              </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a  href="list_events.php?promotion_id=1"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
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
