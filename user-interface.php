<?php  
    session_start();
    require("Fonction_Panier.php");
    //print_r($_SESSION);
    //$pdnavbar = '';
    $usrtitrepage = 'Votre Compte';
    if(isset($_SESSION['user']) && isset($_SESSION['ID']))
    {
        include 'init.php';
        include 'header.php';
        //print_r($_SESSION);

        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

        if ($do == 'manage') {
        ?>
        <?php include 'navbar.php'; ?>
        <!--
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background: #36D1DC;  
                                                                                              background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC); 
                                                                                              background: linear-gradient(to right, #5B86E5, #36D1DC);">
                    <div class="container">
                        <a class="navbar-brand" href="user-interface.php" style="font-size:25px; color:#2c3e50;"><?php echo $shopnm ; ?></a>
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

                          
                            <div class=" dropdown" >
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #2c3e50 ;">
                                
                                  <?php echo 'Bienvenue ' . $_SESSION['user']; ?>
                                  
                                </a>
                                <div class="dropdown-menu drpdwn" aria-labelledby="navbarDropdown" style="background-color: #ecf0f1;">
                                  <a class="dropdown-item" href="?do=edit&idclient=<?php echo $_SESSION['ID']; ?>"><i class="fa fa-user-circle"></i> Profile</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt "></i> Déconnexion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
              -->
              <?php include 'footer.php'; ?>
  <!-- ============================== Afichage message ================================================= -->

  <?php if (!empty($_GET['Ajouter'])) {

    $ajout=(int) $_GET['Ajouter'];

    if ($ajout==1)
    {
    ?>
        
        <div class="col-md-4" style="position: absolute; left: 20px; top: 90%; z-index: 20;">
            <div class="alert alert-success" style="background-color: #69f0ae ;font-weight: bold;color: black;">
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
      
      <!-- id="exampleModal" 
      <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <p style="color: black;">
                    Votre Produit est Bien ajouter a votre Panier
                </p>
            </div>
             -->
            <!--
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> 
            </div>
            
          </div>
        </div>-->
      <!--</div>-->

<?php } } ?>
  <!-- ================================================================================================== -->
            
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
                    echo '<a href="categories.php?do=' . $row['nom'] . ' " class="list-group-item listgrp-ctgry-itm">' . $row['nom'] . '</a>';
                }

            ?>
            <!--
            <a href="#" class="list-group-item">Category 1</a>
            <a href="#" class="list-group-item">Category 2</a>
            <a href="#" class="list-group-item">Category 3</a>
            -->
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
      
          <div class="animated infinite flash"><center><h3>Promotions</h3></center></div>
        <?php
          echo'<div class="row indx_link">';
            

                $stm = $con -> prepare("SELECT * FROM produit");
                $stm -> execute();
                $rows = $stm -> fetchAll();
                $vr = 0;

                

                   foreach ( $rows as $prm) 
                   {
                    if ( $prm['promo'] > $vr && !empty($prm['promo'])) 
                    {
                      echo'<div class="col-lg-4 col-md-6 mb-4">';
                        echo'<div class="card h-100">';
                          echo'<a href="#"><img class="card-img-top" src="designe/img/upload/'. $prm["image"] . '" alt="" data-toggle="modal" data-target="#product_view"></a>';
                          echo'<div class="card-body">';
                            echo'<h4 class="card-title">';
                              echo'<a href="#" data-toggle="modal" data-target="#product_view" >' . $prm["nom"] . '</a>';
                            echo'</h4>';  ?>
                            

                            

                            <!--<div class="price-details">-->
                              <p class="price-old" data-toggle="modal" data-target="#product_view" > 
                                Prix : <?php echo $prm["prix"] . ' DZD' ?>
                              </p>
                              <p class="price-new" data-toggle="modal" data-target="#product_view" > 
                                Prix : <?php echo $prm["promo"] . ' DZD' ?>
                              </p>
                            <!--</div>-->

                            <!-- Discount div 
                            <p class="card-text"> 
                              <div class="round text-center hvr-rectangle-out ">
                                      <?php 
                                        $rdctn = $prm['promo'] * 100 / $prm['prix'];
                                         echo '- ' . $rdctn . ' %' 
                                      ?>
                              </div>
                            </p>
                              -->
                            <?php
                            echo'</p>';
                          echo'</div>';
                          echo'<div class="card-footer" style="padding: 0px;">';
                              echo'<center>';?>
                                <a href="AjouterAuPanier.php?IdProduit= <?= $prm["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" data-toggle="tooltip" title="Ajouter a votre panier" >Ajouter a votre panier
                                 <?php  echo'<i class="fa fa-shopping-cart ml-1" ></i>';
                                echo'</a>';
                              echo'</center>';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';
                    //echo'</div> ';
                  }                   
                  
                }
                echo'</div>';
            ?>
            
      <!-- µµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµµ -->

          <div class=""><center><h3>Nouveautés</h3></center></div>
          
        <div class="row indx_link">
      
            <?php

            $numberslastprd = 3;
            $lsderniersprd = calcdrnr("*","produit","idproduit",$numberslastprd);

            
            foreach( $lsderniersprd as $prd ){
              if ( $prd['promo'] == 0) 
              {
               
             
                echo'<div class="col-lg-4 col-md-6 mb-4">';
              echo'<div class="card h-100">';
                echo'<a href=""><img class="card-img-top" src="designe/img/upload/'. $prd["image"] . '" alt=""  data-toggle="popover" data-trigger="hover" title=" ' . $prd["disc"] . '"></a>';
                echo'<div class="card-body">';
                  echo'<h4 class="card-title">';
                    echo'<a href="#" data-toggle="modal" data-target="#product_view" data-toggle="tooltip" title=" ' . $prd["disc"] . '">' . $prd['nom'] . '</a>
                  </h4>';
                  echo'<h5  style="color: #ff4444" data-toggle="modal" data-target="#product_view"> Prix : ' . $prd["prix"] . ' DZD' . '</h5>';
                  echo'<p class="card-text" data-toggle="modal" data-target="#product_view" > </p>';
                echo'</div>';
                echo'<div class="card-footer" style="padding: 0px;">';
                  
                                    echo'<center>';?>
                                      <a href="AjouterAuPanier.php?IdProduit= <?=$prd["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" data-toggle="tooltip" title="Ajouter a votre panier">Ajouter a votre panier
                                       <?php echo'<i class="fa fa-shopping-cart ml-1" ></i>';
                                      echo'</a>';
                                    echo'</center>';
                        

                echo'</div>';
              echo'</div>';
            echo'</div>';
             }
            }

            ?>
            
          </div>
          <!-- /.row -->

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
                            <p class="text-center">Crée un nouveau <a href="2.php">Compte</a> </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ================================================================================================ -->
            <?php
            echo'<div class="modal fade product_view" id="product_view">';
            echo'<div class="modal-dialog" style="border:none;">';
            echo'<div class="modal-content">';

            echo'<div class="modal-header">';
            echo'<h3 class="modal-title">'. $prd["categorie"] . '</h3>';
            echo'<a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-remove" style=""></span></a>';
            echo'</div>';

            echo'<div class="modal-body">';
            echo'<div class="row">';

            echo'<div class=" product_img">';
            echo '<img src="designe/img/upload/'. $prd["image"] . '" ' ;
            echo'</div>';

            echo'<div class="col-md-6 product_content">';
            echo'<h4>' . $prd["marque"] . ' <span>'. $prd["nom"] . '</span></h4>';

            //echo'<p> Abdelmelek</p>'; <span class="fa fa-usd"></span>
            echo'<h3 class="cost"> '. $prd["prix"] . ' DZD</h3>';
            echo'<div class="row">';
            echo '<div style="padding-left:15px;"> '. $prd["disc"] . '</div>';
            
            echo'</div>';
            echo'<div class="space-ten"></div>';
            echo'<div class="btn-ground">';
            echo'<button type="button" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Ajouter au panier</button>';
            //echo'<button type="button" class="btn btn-primary"><span class="fa fa-heart"></span> Add To Wishlist</button>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            ?>
            <!-- ================================================================================================ -->

            <!-- Modal -->
            <div class="modal fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <br><br>
                            <h1>Modal with blur effect</h1>
                            <h2>Put here whatever you want here</h2>
                            <h4>For instance, a login form or an article content</h4>
                            <h4><kbd>esc</kbd> or click anyway to close</h4>
                            <hr>
                            <div class="alert alert-danger"><h4>You can add any html and css ;)</h4></div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- ================================================================================================= -->

            <?php
            //<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalQuickView">Launch modal</button> -->
            //<!-- Modal: modalQuickView -->
            echo'<div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo'<div class="modal-dialog modal-lg" role="document">';
            echo'<div class="modal-content">';
            echo'<div class="modal-body">';
            echo'<div class="row">';
            echo'<div class="col-lg-5">';

            //echo $prd['image'];
            echo '<img src="designe/img/upload/'. $prd["image"] . '" class="img-responsive">' ;

            echo'</div>';
            echo'<div class="col-lg-7">';
            echo'<h2 class="h2-responsive product-name">';
            echo'<strong> '. $prd['nom'] .' </strong>';
            echo'</h2>';
            echo'<h4 class="h4-responsive">';
            echo'<span class="green-text">';
            echo'<strong>$49</strong>';
            echo'</span>';
            echo'<span class="grey-text">';
            echo'<small>';
            echo'<s>$89</s>';
            echo'</small>';
            echo'</span>';
            echo'</h4>';

            //<!--Accordion wrapper-->
            echo'<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">';

            //<!-- Accordion card -->
            echo'<div class="card">';

            //<!-- Card header -->
            echo'<div class="card-header" role="tab" id="headingOne">';
            echo'<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
            echo'<h5 class="mb-0">';
            'Description <i class="fa fa-angle-down rotate-icon"></i>';
            echo'</h5>';
            echo'</a>';
            echo'</div>';

            //<!-- Card body -->
            echo'<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" >';
            echo'<div class="card-body">';
            'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            //<!-- Accordion card -->

            //<!-- Accordion card -->
            echo'<div class="card">';

            //<!-- Card header -->
            echo'<div class="card-header" role="tab" id="headingTwo">';
            echo'<a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">';
            echo'<h5 class="mb-0">
                                        Details <i class="fa fa-angle-down rotate-icon"></i>';
            echo'</h5>';
            echo'</a>';
            echo'</div>';

            //<!-- Card body -->
            echo'<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" >';
            echo'<div class="card-body">';
            'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            //<!-- Accordion card -->

            //<!-- Accordion card -->
            echo'<div class="card">';

            //<!-- Card header -->
            echo'<div class="card-header" role="tab" id="headingThree">';
            echo'<a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">';
            echo'<h5 class="mb-0">';
            'Shipping <i class="fa fa-angle-down rotate-icon"></i>';
            echo'</h5>';
            echo'</a>';
            echo'</div>';

            //<!-- Card body -->
            echo'<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">';
            echo'<div class="card-body">';
            
            echo'</div>';
            echo'</div>';
            echo'</div>';
            //<!-- Accordion card -->
            echo'</div>';
            //<!--/.Accordion wrapper-->


            echo'<div class="text-center">';

            echo'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            echo'<button class="btn btn-primary">Add to cart';
            echo'<i class="fa fa-cart-plus ml-2" aria-hidden="true"></i>';
            echo'</button>';
            echo'</div>';
            echo'</div>';
            //<!-- /.Add to Cart -->
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            //<!-- Modal: modalQuickView -->
            ?>
            <!-- ================================================================================================= -->

        <?php    
        }elseif ($do == 'add') {
            # code...
        }elseif ($do == 'insert') {
            # code...
        }elseif ($do == 'edit') 
        {
            //edit page
            /*echo 'welcome admin your user id is '. $_GET['']
            echo 'Welcome to edit page';*/
            $idclnt = isset($_GET['idclient']) && is_numeric($_GET['idclient']) ? intval($_GET['idclient']) : 0;
            $sth = $con->prepare("select * from client where idclient = ? ");
            $sth->execute(array($idclnt));
            $row = $sth->fetch();
            $ct = $sth->rowCount();
            if ($sth->rowCount() > 0) {
                ?>
                <!-- =================================================================================================================== -->
                <?php  include 'navbar.php'; ?>
                  <!--
                    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background: #36D1DC; 
                                                                                                     background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC); 
                                                                                                     background: linear-gradient(to right, #5B86E5, #36D1DC); ">
                    <div class="container">
                        <a class="navbar-brand" href="user-interface.php" style="font-size:25px; color: #2c3e50;"><?php echo $shopnm ; ?></a>
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

                            <div class=" dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:rgb(242,244,247);">
                                 
                                  <?php echo 'Bienvenue ' . $_SESSION['user']; ?>
                                  
                                </a>
                                <div class="dropdown-menu drpdwn" aria-labelledby="navbarDropdown" style="background-color: #ecf0f1;">
                                  <a class="dropdown-item" href="?do=edit&idclient=<?php echo $_SESSION['ID']; ?>"><i class="fa fa-user-circle"></i> Profile</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt "></i> Déconnexion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
              -->

                    <!-- ###########################################################################################################      -->          
                  <div class="container usrcntnr"> 
                    
                    
                      <!--
                        <a href='user-interface.php?do=delete&idclient=<?php  echo $row['idclient']  ?>' class='delete confirm' title='Suprimer' data-toggle='tooltip' > Suprimer Votre Compte  <i class='fa fa-ban fa-1x' style='color:red;'></i></a>
                      -->
                      <div style="margin-left: 210px; margin-bottom: 20px;">
                      <a href='user-interface.php?do=delete&idclient=<?php  echo $row['idclient']  ?>' class='delete confirm' title='Suprimer votre compte' data-toggle='tooltip' style='color: black; font-weight: bold; text-decoration: none;'>   
                        <i class='fa fa-ban fa-2x' style='color:red;'></i>
                        Suprimer votre compte
                        
                      </a>
                    </div>
                
                    <div class="panel panel-primary usrpnl">

                        <div class="panel panel-heading usrpnl-hdng">
                          
                            <span class="toggle-info pull-right" style="margin-right: 10px;">
                                <i class="fa fa-minus " style="color: #FFF; margin-top: 15px;"></i>
                            </span>
                            <h1 style="margin-bottom: 0px;">Modifier votre profile</h1>
                            
                        </div>
                        <div class=" panel panel-body usrpnl-bdy">

                            <form class="form" action="?do=update" method="post">
                                <input type="hidden" name="idclnt" value="<?php echo $idclnt ?>"/>

                                <div class="form-group">
                                    <label> Nom</label>
                                    <div>
                                        <input type="text" name="clntnom" class="form-control"
                                               value="<?php echo $row['nom']; ?>"/>
                                    </div>
                                </div>

                                <div class="from-group ">
                                    <label>Prenom</label>
                                    <input type="text" name="clntprenom" class="form-control"
                                           value="<?php echo $row['prenom']; ?>"/>
                                </div>
                                <div class="from-group ">
                                    <label>Pseudo</label>
                                    <input type="text" name="clntpseudo" class="form-control"
                                           value="<?php echo $row['pseudo']; ?>"/>
                                </div>
                                <div class="from-group ">
                                    <label>Email</label>
                                    <input type="text" name="clntemail" class="form-control"
                                           value="<?php echo $row['email']; ?>"/>
                                </div>


                                <div class="from-group ">
                                    <label>Mots de pass <i class="showpass fa fa-eye-slash "
                                                           title="afficher Mots de pass"></i></label>
                                    <input type="password" name="nwmdp" class="password form-control" placeholder="Tapez Votre nouveau mots de pass ici" />
                                    <input type="hidden" name="oldmdp" value="<?php echo $row['mdp']; ?>"/>
                                </div>

                                <div class="from-group ">
                                    <label>Téléphone</label>
                                    <input type="text" name="clnttlf" class="form-control"
                                           value="<?php echo $row['tele']; ?>"/>
                                </div>
                                <div class="from-group ">
                                    <label>Adresse</label>
                                    <input type="text" name="clntadrs" class="form-control"
                                           value="<?php echo $row['adresse']; ?>"/>
                                </div>

                                <div class="from-group ">

                                    <input type="submit" class="btn btn-info btn-block form-control"
                                           value="Sauvgarder" style="margin-bottom: 15px; margin-top: 10px;">
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

                    

                    <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                </div>

                <?php
        }
        } elseif ($do == 'update') {
                # code...
        } elseif ($do == 'delete') {
                
                //echo "<h1 class='text-center'> Suprimer Membre</h1>";
            echo "<div class='container'>";

              //session_start();
              session_unset();
              session_destroy();

            $cltid = isset($_GET['idclient']) && is_numeric($_GET['idclient']) ? intval($_GET['idclient']) : 0;

            //echo $cltid;

            $sth = $con->prepare("SELECT * FROM client WHERE idclient = ? LIMIT 1 ");

            $sth -> execute(array($cltid));

            $cnt = $sth -> rowCount();

            if ($sth->rowCount() > 0) {

                $sth = $con->prepare("DELETE FROM client WHERE idclient = :xidclient ");
                $sth -> bindParam(":xidclient", $cltid);
                $sth -> execute();
                $dltmsg = "<div class='container col-md-6 alert alert-success centered' style='margin-top:35px;'> Votre compte a etait Suprimer </div>";
                //header("Refresh:3");

                redirectHome($dltmsg,'back',7);
            }else{
                $dtmsg = "<div class='container col-md-6 alert alert-danger centered' style='margin-top:35px;'> cette ID n'existe pas </div>";
                redirectHome($dtmsg,'',7);
            }

            header("Location: index.php");
              exit();

            echo " </div>";

        } elseif ($do == 'search') {
                
            $search=$_POST['search'];
            if(empty($search))
                { ?>    
                    <?php include 'navbar.php'; ?>

                    <div class="container col-md-6 alert alert-danger centered" style="margin-top: 35px;">
                            <p>
                                Le champ est vide
                            </p>
                    </div>

                    <?php include 'footer.php'; ?>
             <?php    
            }else
            {
                 include 'navbar.php';
           
                $query = $con->prepare("select * from produit where nom = ? OR marque = ? OR categorie = ? OR disc = ? ");
                $query->bindValue(1, "%$search%", PDO::PARAM_STR);
                $query->execute(array($search,$search,$search,$search));
                // Display search result
                    if (!$query->rowCount() == 0)
                    {
                         
                        echo "<div class='container' style='margin-top:35px;'>";
                        echo "<h1>Résultat de votre recherche :</h1><br/>";

                        echo "<div class='jumbotron' style='padding: 2em 2em;'>";
                       
                        while ($results = $query->fetch()) 
                        {
                          ?>
                        

                          <div class="row">
                            <div class="col-md-4">
                              <?php 
                                echo '<img src="designe/img/upload/'. $results["image"] . '" style="width: 70%;">';
                              ?>
                            </div>
                            <div class="col-md-8">
                              <div class="title">
                                <h2>
                                  <?php 
                                    echo $results['marque'] . ' ' . $results['nom']; 

                                    ?>
                                </h2>

                              </div>

                              <div class="title2">
                                <p>
                                  <?php echo $results['disc']; ?>
                                </p>
                                <p>
                                  <?php
                                    if ( $results['promo'] > 0  ) { ?>

                                      <p class="price-old"  > 
                                        Prix : <?php echo $results["prix"] . ' DZD' ?>
                                      </p>
                                      <p class="price-new"  > 
                                        Prix : <?php echo $results["promo"] . ' DZD' ?>
                                      </p>

                                      <?php
                                    }else{ ?>
                                      <p class="price" style="font-weight: bold;" > 
                                        Prix : <?php echo $results["prix"] . ' DZD' ?>
                                      </p>
                                      <?php
                                    }

                                  ?>
                                </p>
                              </div>
                              <div class="pull-right">
                                    
                                    <a href="ajtaupnr.php?IdProduit= <?= $results["idproduit"] ?>">
                                        <input type="submit" name="btn" value="Ajouter au panier" class="btn btn-info" data-toggle='tooltip' title="Ajouter a votre panier">
                                    </a>
                                    
                                </div>
                            </div>
                          </div>

                          <div class="hr">
                            <hr>
                          </div>
                        <?php
                        }
                        echo "</div>";
                        
                        echo "</div>";

                         include 'footer.php'; 
                         
                    } else {
                             //include 'navbar.php';
                        echo  "<div class='container col-md-6 alert alert-danger centered' style='margin-top:35px;'> 
                                    <h1>Oups (O_°)</h1> désoler pas de resltat 
                                </div>";
                                include 'footer.php'; 
                            }
            }
        }

        include 'footer.php';
        
    }
    else
    {

    header('Location: /3/index.php');
    exit();

    }