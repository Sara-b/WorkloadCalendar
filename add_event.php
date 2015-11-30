<?php
session_start(); 
include('models/Events.php');
if (!isset($_SESSION['id'])){
  header('location:login.php');
}
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

    <title>Ynov - Charge de travail</title>

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
            <a href="index.php" class="logo">YNOV  <span class="lite">Dashboard charge de travail</span></a>
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
                                <a href="login.php"><i class="icon_key_alt"></i> Déconnexion</a>
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
                          <li><a class="" href="add_event.php">Ajouter un évènement</a></li>
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
					<h3 class="page-header"><i class="fa fa fa-bars"></i> Outils de gestion</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-bars"></i>Gestion</li>
						<li><i class="fa fa-square-o"></i>Outils de gestion</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <form class="form-horizontal" method="post" action="controllers/add_event.php">
              <fieldset>

              <!-- Form AJOUT EVENT -->
              <legend>Ajouter un évènement</legend>

              <?php if(!empty($_GET['message']) && $_GET['message'] == "success") { ?>

              <div class="alert alert-info">
                <strong>Succès!</strong> L'évènement a correctement été ajouté.
              </div>
              
              <?php } ?>
              <?php if(!empty($_GET['message']) && $_GET['message'] == "fail") { ?>

              <div class="alert alert-danger">
                <strong>Une erreur est survenue.</strong> L'évènement n'a pas été ajouté correctement.
              </div>
              
              <?php } ?>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="category_event">Catégorie</label>
                <div class="col-md-4">
                  <select id="category_event" name="category_event" class="form-control">
                    <option value="1">Option one</option>
                    <option value="2">Option two</option>
                  </select>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="title_event">Titre</label>  
                <div class="col-md-4">
                <input id="title_event" name="title_event" type="text" placeholder="Titre de l'évènement" class="form-control input-md" required="">
                  
                </div>
              </div>

              <!-- Textarea -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="description_event">Explications</label>
                <div class="col-md-4">                     
                  <textarea class="form-control" id="description_event" name="description_event"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="startDate">Date de début</label>
                  <div class='col-sm-2'>
                      <input type='date' class="form-control input-md" required="" name="startDate"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="endDate">Date de fin</label>
                  <div class='col-sm-2'>
                      <input type='date' class="form-control input-md" required="" name="endDate"/>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="hours_event">Heures nécessaires à la réalisation</label>  
                <div class="col-md-4">
                <input id="hours_event" name="hours_event" type="text" placeholder="Nombre d'heures (entières)" class="form-control input-md" required="">
                  
                </div>
              </div>

              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="group_event">Promotion</label>
                <div class="col-md-4">
                  <select id="group_event" name="group_event" class="form-control">
                    <option value="1">Option one</option>
                    <option value="2">Option two</option>
                  </select>
                </div>
              </div>

              <!-- Button -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                  <button type="submit" id="submit" name="submit" class="btn btn-primary">Valider</button>
                </div>
              </div>

              </fieldset>
              </form>

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
