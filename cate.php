<?php  

    session_start();
    require("Fonction_Panier.php");
    $usrtitrepage = 'Catégories';
    $a = 0;


    /*if(isset($_SESSION['user']) && isset($_SESSION['ID']))
    {*/
    if($a == 0 ){
        include 'init.php';
        include 'header.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $usremail = $_POST['email'];
                $usrpas   = $_POST['password'];
                $hachedPass = sha1($usrpas);

                //echo $usremail . $usrpas;
            $imgsth = $con -> prepare("SELECT * FROM produit");
            //$rowimg = $imgsth->fetchAll();
            //$img    = $rowimg['img'];
            $sth = $con->prepare("SELECT idclient,pseudo, mdp, email FROM client WHERE mdp = ? AND email = ? ");
            $sth -> execute(array($hachedPass, $usremail));

            $row = $sth ->fetch();

            $ct = $sth->rowCount();
            //echo $ct;
            if($ct > 0){
                $_SESSION['user']   = $row['pseudo'];
                $_SESSION['ID']     = $row['idclient'];
                header('Location: user-interface.php');
                exit();

            }else{

              header('Location: lgn.php');
              exit();
            }
        }

        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

        if ($do == 'manage') 
        {
            header('Location: /3/user-interface.php');
            exit();
        }
        elseif ($do == 'Ordinateur') 
        {
        ?>   

        <?php include 'navbar.php'; ?>
        <!--
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background: #36D1DC;  
background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC);  
background: linear-gradient(to right, #5B86E5, #36D1DC); 
">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="font-size:25px; color: #2c3e50;"><?php echo $shopnm ; ?></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Appelez nous"><i class="fa fa-phone"> +213790853722</i></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Envoyez-nous un message"><i class="fa fa-envelope"> Nous contacter</i></a></li>
                   
                </ul>
                <form class="form-inline mr-auto" target="_self" action="srch.php" method="post">
                    <div class="form-group">
                        <label for="search-field">
                            <i class="fa fa-search"></i>
                        </label>
                        <input class="form-control search-field" type="search" name="search" id="search-field" style="color: #2f3640;">
                    </div>

                </form>
                  
              <a href="VoirMonPanier.php">
                              <span class="badge">
                                <i class="fa fa-shopping-bag" style="font-size:30px; color:#2c3e50; margin-right: 30px; padding-right: 0px;">
                                  <lavel id="cart-badge" class="badge badge-warning">
                                    <?php 
                                      if(!empty($_SESSION['panier']))
                                        {
                                          echo  $_SESSION['panier']['nombre']; 
                                        }
                                      else
                                        {
                                          echo 0;
                                        }
                                    ?>
                                  </lavel>
                                </i>
                              </span>
                            </a>


                <a href="#myModal" class="trigger-btn" data-toggle="modal" style="color:rgb(242,244,247);padding:0px;padding-right:20px;">Connexion</a>
                <a class="btn btn-light action-button" role="button" href="sign-up.php" style="background-color: #2c3e50 /*#33b5e5*/;">S'inscrire</a>
            </div>
        </div>
    </nav>
  -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

 <!-- ================================================================================================================================================ -->
    <?php if (!empty($_GET['Ajouter'])) {

    $ajout=(int) $_GET['Ajouter'];

    if ($ajout==1)
    {
    ?>
        
        <div class="col-md-4" style="position: absolute; left: 20px; top: 90%; z-index: 20;">
            <div class="alert alert-success" style="background-color: #69f0ae ;font-weight: bold;color: black;"> <!--  msgaltr -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>
                <strong>Produit ajouté au panier avec succès</strong>
                <!--
                <hr class="message-inner-separator" style="background-color: #8FDF67;color: black;">
                <p style="color: black;">
                    Votre Produit est Bien ajouter a votre Panier
                </p>
              -->
            </div>
        </div>
    <?php
}
}
?>
<!-- ============================== Afichage message ================================================= -->
                 <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <a href="index.php" title="Logo">
            <h1 class="my-4 center" style="color: #e74c3c; text-align: center;">
              <img src="lg.png">
            </h1>
          </a>
          <div class="panel panel-primary">
            <div class="panel panel-heading" style="padding-bottom: 7px; padding-top: 7px; padding-left: 10px; font-weight: bold; color: #FFF; background-color: #2c3e50;"> 
              
              <a class="toggle-info-list" type="submit" style="padding-left: 12px;  background: none; color: #FFF;">
                <i class="fa fa-list"></i>
                Catégorie
              </a>

            </div>
            <div class="panel panel-body">

              <div class="list-group listgrp-ctgry" > 
            <?php 
                $ctgry = $con -> prepare("SELECT * FROM catégorie");
                $ctgry -> execute();
                $ctg   = $ctgry -> fetchAll();

                foreach ($ctg as $row) 
                {
                    echo '<a href="cate.php?do=' . $row['nom'] . '" class="list-group-item listgrp-ctgry-itm">' . $row['nom'] . '</a>';
                }

            ?>

          </div>
              
            </div>
          </div>

        </div>

        
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="designe/img/s1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="designe/img/s2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="designe/img/s3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true" style="color:#3498db;"></span>
              <span class="sr-only" >Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->
        <?php
          echo'<div class="row indx_link">';
            

                $stm = $con -> prepare("SELECT * FROM produit where categorie = 'Ordinateur' ");
                $stm -> execute();
                $rows = $stm -> fetchAll();
                $vr = 0;

                

                   foreach ( $rows as $prm) 
                   {

                      echo'<div class="col-lg-4 col-md-6 mb-4">';
                        echo'<div class="card h-100">';
                          echo'<a href="#"><img class="card-img-top" src="designe/img/upload/'. $prm["image"] . '" alt="" data-toggle="modal" data-target="#product_view"></a>';
                          echo'<div class="card-body">';
                            echo'<h4 class="card-title">';
                              echo'<a href="#" data-toggle="modal" data-target="#product_view" >' . $prm["nom"] . '</a>';
                            echo'</h4>';  
                            echo'<h5  style="color: #ff4444" data-toggle="modal" data-target="#product_view"> Prix : ' . $prm["prix"] . ' DZD' . '</h5>';
                            ?>
                            <?php
                            echo'</p>';
                          echo'</div>';
                          echo'<div class="card-footer" style="padding: 0px;">';
                              echo'<center>';?>
                                <a href="AjouterAuPanier.php?IdProduit= <?= $prm["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" >Ajouter a votre panier
                                 <?php  echo'<i class="fa fa-shopping-cart ml-1" ></i>';
                                echo'</a>';
                              echo'</center>';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';

                  }                   
                  
                
                echo'</div>';
            ?>
        
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

            <!-- ================================================================================ -->
        <div class="footer-basic" ">
            <footer>
                <div class="social">
                    <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="icon ion-social-instagram"></i></a>
                    <a href="https://www.snapchat.com"  target="_blank" title="Snapchat"><i class="icon ion-social-snapchat"></i></a>
                    <a href="https://www.twitter.com"   target="_blank" title="twitter"><i class="icon ion-social-twitter"></i></a>
                    <a href="https://www.facebook.com"  target="_blank" title="facebook"><i class="icon ion-social-facebook"></i></a>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="user-interface.php">Accueil</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">À propos</a></li>
                    <li class="list-inline-item"><a href="#">Conditions</a></li>
                    <li class="list-inline-item"><a href="#">Politique de confidentialité</a></li>
                </ul>
                <p class="copyright">
                    Tous droits réservés.</br>
                    Boutouil Abdelmelek.</br>
                    Belahouel Badra Batoul.</br>
                    E-commerce web site © 2018
                </p>
            </footer>
        </div>
            <!-- ================================================================================================ -->
<!--
    <div class="text-center">
     Button HTML (to Trigger Modal)
        <a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Login Modal</a> 
    </div> -->

        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-login" style="color: #636363;width: 350px;">
                <div class="modal-content" style="padding: 20px;border-radius: 5px;border: none; margin-top: 50px;">
                    <div class="modal-header" style="border-bottom: none;position: relative;justify-content: center;">
                        <div class="avatar" style="position: absolute;margin: 20px auto;left: 0;right: 0;top: -70px;width: 95px;height: 95px;border-radius: 50%;z-index: 9;background: #60c7c1;padding: 15px;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);">
                            <img style="width: 100%;" src="designe/img/avatar.png" alt="Avatar">
                            <!--<i class="fa fa-users fa-7x"></i> -->
                        </div>              
                        <!--<h4 class="modal-title">Member Login</h4>-->   
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" style="border-color: #70c5c0;">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="email" required="required">     
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mot de pass" required="required"> 
                            </div>        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Connexion</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="background: #ecf0f1;border-color: #dee4e7;text-align: center;justify-content: center;margin: 0 -20px -20px;border-radius: 5px;font-size: 13px;">
                        <!--<a href="#">Forgot Password?</a>
                    </br>-->
                        <p class="text-center">Crée un nouveau <a href="sign-up.php">Compte</a> </p>
                    </div>
                </div>
            </div>
        </div>     


    <!-- ================================================================================================ -->

        <?php
        }
        elseif ($do == 'Accessoire')
        {
        ?>
        <?php include 'navbar.php'; ?>
        <!--
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background: #36D1DC; 
background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC); 
background: linear-gradient(to right, #5B86E5, #36D1DC);
">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="font-size:25px; color: #2c3e50;"><?php echo $shopnm ; ?></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Appelez nous"><i class="fa fa-phone"> +213790853722</i></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Envoyez-nous un message"><i class="fa fa-envelope"> Nous contacter</i></a></li>
                   
                </ul>
                <form class="form-inline mr-auto" target="_self" action="srch.php" method="post">
                    <div class="form-group">
                        <label for="search-field">
                            <i class="fa fa-search"></i>
                        </label>
                        <input class="form-control search-field" type="search" name="search" id="search-field" style="color: #2f3640 ;">
                    </div>

                </form>
                   
              <a href="VoirMonPanier.php">
                              <span class="badge">
                                <i class="fa fa-shopping-bag" style="font-size:30px; color:#2c3e50; margin-right: 30px; padding-right: 0px;">
                                  <lavel id="cart-badge" class="badge badge-warning">
                                    <?php 
                                      if(!empty($_SESSION['panier']))
                                        {
                                          echo  $_SESSION['panier']['nombre']; 
                                        }
                                      else
                                        {
                                          echo 0;
                                        }
                                    ?>
                                  </lavel>
                                </i>
                              </span>
                            </a>


                <a href="#myModal" class="trigger-btn" data-toggle="modal" style="color:rgb(242,244,247);padding:0px;padding-right:20px;">Connexion</a>
                <a class="btn btn-light action-button" role="button" href="sign-up.php" style="background-color: #2c3e50;">S'inscrire</a>
            </div>
        </div>
    </nav> 
  -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- ================================================================================================================================================ -->
    <?php if (!empty($_GET['Ajouter'])) {

    $ajout=(int) $_GET['Ajouter'];

    if ($ajout==1)
    {
    ?>
        
        <div class="col-md-4" style="position: absolute; left: 20px; top: 90%; z-index: 20;">
            <div class="alert alert-success" style="background-color: #69f0ae ;font-weight: bold;color: black;"> <!--  msgaltr -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>
                <strong>Produit ajouté au panier avec succès</strong>
                <!--
                <hr class="message-inner-separator" style="background-color: #8FDF67;color: black;">
                <p style="color: black;">
                    Votre Produit est Bien ajouter a votre Panier
                </p>
              -->
            </div>
        </div>
    <?php
}
}
?>
<!-- ============================== Afichage message ================================================= -->
                 <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <a href="index.php" title="Logo">
            <h1 class="my-4 center" style="color: #e74c3c; text-align: center;">
              <img src="lg.png">
            </h1>
          </a>
          <div class="panel panel-primary">
            <div class="panel panel-heading" style="padding-bottom: 7px; padding-top: 7px; padding-left: 10px; font-weight: bold; color: #FFF; background-color: #2c3e50;"> 
              
              <a class="toggle-info-list" type="submit" style="padding-left: 12px;  background: none; color: #FFF;">
                <i class="fa fa-list"></i>
                Catégorie
              </a>

            </div>
            <div class="panel panel-body">

              <div class="list-group listgrp-ctgry" > 
            <?php 
                $ctgry = $con -> prepare("SELECT * FROM catégorie");
                $ctgry -> execute();
                $ctg   = $ctgry -> fetchAll();

                foreach ($ctg as $row) 
                {
                    echo '<a href="cate.php?do=' . $row['nom'] . '" class="list-group-item listgrp-ctgry-itm">' . $row['nom'] . '</a>';
                }

            ?>

          </div>
              
            </div>
          </div>

        </div>

        
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="designe/img/s1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="designe/img/s2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="designe/img/s3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true" style="color:#3498db;"></span>
              <span class="sr-only" >Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->

        <?php
          echo'<div class="row indx_link">';
            

                $stm = $con -> prepare("SELECT * FROM produit where categorie = 'Accessoire' ");
                $stm -> execute();
                $rows = $stm -> fetchAll();
                $vr = 0;

                

                   foreach ( $rows as $prm) 
                   {
                    /*if ( $prm['promo'] > $vr && !empty($prm['promo'])) 
                    {*/
                      echo'<div class="col-lg-4 col-md-6 mb-4">';
                        echo'<div class="card h-100">';
                          echo'<a href="#"><img class="card-img-top" src="designe/img/upload/'. $prm["image"] . '" alt="" data-toggle="modal" data-target="#product_view"></a>';
                          echo'<div class="card-body">';
                            echo'<h4 class="card-title">';
                              echo'<a href="#" data-toggle="modal" data-target="#product_view" >' . $prm["nom"] . '</a>';
                            echo'</h4>';  
                            echo'<h5  style="color: #ff4444" data-toggle="modal" data-target="#product_view"> Prix : ' . $prm["prix"] . ' DZD' . '</h5>';
                            ?>

                            <?php
                            echo'</p>';
                          echo'</div>';
                          echo'<div class="card-footer" style="padding: 0px;">';
                              echo'<center>';?>
                                <a href="AjouterAuPanier.php?IdProduit= <?= $prm["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" >Ajouter a votre panier
                                 <?php  echo'<i class="fa fa-shopping-cart ml-1" ></i>';
                                echo'</a>';
                              echo'</center>';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';

                  }                   
                  
                
                echo'</div>';
            ?>
        
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

            <!-- ================================================================================ -->
        <div class="footer-basic" ">
            <footer>
                <div class="social">
                    <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="icon ion-social-instagram"></i></a>
                    <a href="https://www.snapchat.com"  target="_blank" title="Snapchat"><i class="icon ion-social-snapchat"></i></a>
                    <a href="https://www.twitter.com"   target="_blank" title="twitter"><i class="icon ion-social-twitter"></i></a>
                    <a href="https://www.facebook.com"  target="_blank" title="facebook"><i class="icon ion-social-facebook"></i></a>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="user-interface.php">Accueil</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">À propos</a></li>
                    <li class="list-inline-item"><a href="#">Conditions</a></li>
                    <li class="list-inline-item"><a href="#">Politique de confidentialité</a></li>
                </ul>
                <p class="copyright">
                    Tous droits réservés.</br>
                    Boutouil Abdelmelek.</br>
                    Belahouel Badra Batoul.</br>
                    E-commerce web site © 2018
                </p>
            </footer>
        </div>
            <!-- ================================================================================================ -->
<!--
    <div class="text-center">
     Button HTML (to Trigger Modal)
        <a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Login Modal</a> 
    </div> -->

        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-login" style="color: #636363;width: 350px;">
                <div class="modal-content" style="padding: 20px;border-radius: 5px;border: none; margin-top: 50px;">
                    <div class="modal-header" style="border-bottom: none;position: relative;justify-content: center;">
                        <div class="avatar" style="position: absolute;margin: 20px auto;left: 0;right: 0;top: -70px;width: 95px;height: 95px;border-radius: 50%;z-index: 9;background: #60c7c1;padding: 15px;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);">
                            <img style="width: 100%;" src="designe/img/avatar.png" alt="Avatar">
                            <!--<i class="fa fa-users fa-7x"></i> -->
                        </div>              
                        <!--<h4 class="modal-title">Member Login</h4>-->   
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" style="border-color: #70c5c0;">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="email" required="required">     
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mot de pass" required="required"> 
                            </div>        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Connexion</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="background: #ecf0f1;border-color: #dee4e7;text-align: center;justify-content: center;margin: 0 -20px -20px;border-radius: 5px;font-size: 13px;">
                        <!--<a href="#">Forgot Password?</a>
                    </br>-->
                        <p class="text-center">Crée un nouveau <a href="sign-up.php">Compte</a> </p>
                    </div>
                </div>
            </div>
        </div>     


    <!-- ================================================================================================ -->

        <?php	
        }
        elseif ($do == 'Téléphone')
        {
        ?>

        <?php include 'navbar.php'; ?>
          <!--
           <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background: #36D1DC; 
background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC);  
background: linear-gradient(to right, #5B86E5, #36D1DC);
">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="font-size:25px; color: #2c3e50;"><?php echo $shopnm ; ?></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Appelez nous"><i class="fa fa-phone"> +213790853722</i></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Envoyez-nous un message"><i class="fa fa-envelope"> Nous contacter</i></a></li>
                  
                </ul>
                <form class="form-inline mr-auto" target="_self" action="srch.php" method="post">
                    <div class="form-group">
                        <label for="search-field">
                            <i class="fa fa-search"></i>
                        </label>
                        <input class="form-control search-field" type="search" name="search" id="search-field" style="color: #2f3640;">
                    </div>

                </form>
                   
              <a href="VoirMonPanier.php">
                              <span class="badge">
                                <i class="fa fa-shopping-bag" style="font-size:30px; color:#2c3e50; margin-right: 30px; padding-right: 0px;">
                                  <lavel id="cart-badge" class="badge badge-warning">
                                    <?php 
                                      if(!empty($_SESSION['panier']))
                                        {
                                          echo  $_SESSION['panier']['nombre']; 
                                        }
                                      else
                                        {
                                          echo 0;
                                        }
                                    ?>
                                  </lavel>
                                </i>
                              </span>
                            </a>


                <a href="#myModal" class="trigger-btn" data-toggle="modal" style="color:rgb(242,244,247);padding:0px;padding-right:20px;">Connexion</a>
                <a class="btn btn-light action-button" role="button" href="sign-up.php" style="background-color: #2c3e50 ;">S'inscrire</a>
            </div>
        </div>
    </nav>
  -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- ================================================================================================================================================ -->
    <?php if (!empty($_GET['Ajouter'])) {

    $ajout=(int) $_GET['Ajouter'];

    if ($ajout==1)
    {
    ?>
        
        <div class="col-md-4" style="position: absolute; left: 20px; top: 90%; z-index: 20;">
            <div class="alert alert-success" style="background-color: #69f0ae ;font-weight: bold;color: black;"> <!--  msgaltr -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>
                <strong>Produit ajouté au panier avec succès</strong>
                <!--
                <hr class="message-inner-separator" style="background-color: #8FDF67;color: black;">
                <p style="color: black;">
                    Votre Produit est Bien ajouter a votre Panier
                </p>
              -->
            </div>
        </div>
    <?php
}
}
?>
<!-- ============================== Afichage message ================================================= -->
                 <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <a href="index.php" title="Logo">
            <h1 class="my-4 center" style="color: #e74c3c; text-align: center;">
              <img src="lg.png">
            </h1>
          </a>
          <div class="panel panel-primary">
            <div class="panel panel-heading" style="padding-bottom: 7px; padding-top: 7px; padding-left: 10px; font-weight: bold; color: #FFF; background-color: #2c3e50;"> 
              
              <a class="toggle-info-list" type="submit" style="padding-left: 12px;  background: none; color: #FFF;">
                <i class="fa fa-list"></i>
                Catégorie
              </a>

            </div>
            <div class="panel panel-body">

              <div class="list-group listgrp-ctgry" > 
            <?php 
                $ctgry = $con -> prepare("SELECT * FROM catégorie");
                $ctgry -> execute();
                $ctg   = $ctgry -> fetchAll();

                foreach ($ctg as $row) 
                {
                    echo '<a href="cate.php?do=' . $row['nom'] . '" class="list-group-item listgrp-ctgry-itm">' . $row['nom'] . '</a>';
                }

            ?>

          </div>
              
            </div>
          </div>

        </div>

        
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="designe/img/s1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="designe/img/s2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="designe/img/s3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true" style="color:#3498db;"></span>
              <span class="sr-only" >Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->

        <?php
          echo'<div class="row indx_link">';
            

                $stm = $con -> prepare("SELECT * FROM produit where categorie = 'Téléphone' ");
                $stm -> execute();
                $rows = $stm -> fetchAll();
                $vr = 0;

                

                   foreach ( $rows as $prm) 
                   {
                    /*if ( $prm['promo'] > $vr && !empty($prm['promo'])) 
                    {*/
                      echo'<div class="col-lg-4 col-md-6 mb-4">';
                        echo'<div class="card h-100">';
                          echo'<a href="#"><img class="card-img-top" src="designe/img/upload/'. $prm["image"] . '" alt="" data-toggle="modal" data-target="#product_view"></a>';
                          echo'<div class="card-body">';
                            echo'<h4 class="card-title">';
                              echo'<a href="#" data-toggle="modal" data-target="#product_view" >' . $prm["nom"] . '</a>';
                            echo'</h4>';  
                            echo'<h5  style="color: #ff4444" data-toggle="modal" data-target="#product_view"> Prix : ' . $prm["prix"] . ' DZD' . '</h5>';
                            ?>

                            <?php
                            echo'</p>';
                          echo'</div>';
                          echo'<div class="card-footer" style="padding: 0px;">';
                              echo'<center>';?>
                                <a href="AjouterAuPanier.php?IdProduit= <?= $prm["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" >Ajouter a votre panier
                                 <?php  echo'<i class="fa fa-shopping-cart ml-1" ></i>';
                                echo'</a>';
                              echo'</center>';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';

                  }                   
                  
                
                echo'</div>';
            ?>
        
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

            <!-- ================================================================================ -->
        <div class="footer-basic" ">
            <footer>
                <div class="social">
                    <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="icon ion-social-instagram"></i></a>
                    <a href="https://www.snapchat.com"  target="_blank" title="Snapchat"><i class="icon ion-social-snapchat"></i></a>
                    <a href="https://www.twitter.com"   target="_blank" title="twitter"><i class="icon ion-social-twitter"></i></a>
                    <a href="https://www.facebook.com"  target="_blank" title="facebook"><i class="icon ion-social-facebook"></i></a>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="user-interface.php">Accueil</a></li>
                    <li class="list-inline-item"><a href="#">Services</a></li>
                    <li class="list-inline-item"><a href="#">À propos</a></li>
                    <li class="list-inline-item"><a href="#">Conditions</a></li>
                    <li class="list-inline-item"><a href="#">Politique de confidentialité</a></li>
                </ul>
                <p class="copyright">
                    Tous droits réservés.</br>
                    Boutouil Abdelmelek.</br>
                    Belahouel Badra Batoul.</br>
                    E-commerce web site © 2018
                </p>
            </footer>
        </div>
            <!-- ================================================================================================ -->
<!--
    <div class="text-center">
     Button HTML (to Trigger Modal)
        <a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Login Modal</a> 
    </div> -->

        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-login" style="color: #636363;width: 350px;">
                <div class="modal-content" style="padding: 20px;border-radius: 5px;border: none; margin-top: 50px;">
                    <div class="modal-header" style="border-bottom: none;position: relative;justify-content: center;">
                        <div class="avatar" style="position: absolute;margin: 20px auto;left: 0;right: 0;top: -70px;width: 95px;height: 95px;border-radius: 50%;z-index: 9;background: #60c7c1;padding: 15px;box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);">
                            <img style="width: 100%;" src="designe/img/avatar.png" alt="Avatar">
                            <!--<i class="fa fa-users fa-7x"></i> -->
                        </div>              
                        <!--<h4 class="modal-title">Member Login</h4>-->   
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" style="border-color: #70c5c0;">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="email" required="required">     
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mot de pass" required="required"> 
                            </div>        
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Connexion</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="background: #ecf0f1;border-color: #dee4e7;text-align: center;justify-content: center;margin: 0 -20px -20px;border-radius: 5px;font-size: 13px;">
                        <!--<a href="#">Forgot Password?</a>
                    </br>-->
                        <p class="text-center">Crée un nouveau <a href="sign-up.php">Compte</a> </p>
                    </div>
                </div>
            </div>
        </div>     


    <!-- ================================================================================================ -->
        

        <?php
        }
        include 'footer.php';
        
	}else
    {
        /*echo "vous n'êtes pas administrateur";*/
        header('Location: /3/index.php');
        exit();
    }





?>