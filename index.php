    <?php
            session_start();
            require("Fonction_Panier.php");
            /*$pdnavbar = '';*/
            //print_r($_SESSION);
            /*$pdnavbar = '';*/
            $usrnavbar = '';
            if(isset($_SESSION['user'])){
            header('Location: user-interface.php');
            }
        //$usrnavbar = '';
        $usrtitrepage = 'Accueil';
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
    ?>
     
    <?php include 'navbar.php'; ?>
   
  
<!-- =============================================================================================================== -->
    <?php if (!empty($_GET['Ajouter'])) {

    $ajout=(int) $_GET['Ajouter'];

    if ($ajout==1)
    {
    ?>
        
        <div class="col-*-*" id="msg" style="position: absolute; left: 20px; top: 90%; z-index: 20;">
            <div class="alert alert-success" style="background-color: #69f0ae ;font-weight: bold;color: black;"> <!--  msgaltr -->
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>
                <strong>Produit ajouté au panier avec succès</strong>
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

        <div class="col-*-*">

          <a href="index.php" title="Logo">
            <h1 class="center" style="color: #e74c3c; text-align: center;">
              
            <img src="lg.png">
          </h1>
          </a>
          <div class="card col-*-*">
            <div class="card card-header" style="padding-bottom: 7px; padding-top: 7px; padding-left: 10px; font-weight: bold;"> 
              
              <p class="toggle-info-list" type="submit" style="padding-left: 12px; border:none; margin: 0px;">
                <i class="fab fa-list"></i>
                Catégorie
              </p>

            </div>
            <div class="card card-body ">

              <div class="list-group listgrp-ctgry " > 
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

        <div class="img-fluid col-*-*">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="img-fluid carousel-inner" role="listbox">
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
          <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  -->
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
                      echo'<div class="col-*-*">';
                        echo'<div class="card h-100">';
                          echo'<a href="#" style="width:300px; hieght:400px;">
                                <img class="card-img-top" src="designe/img/upload/'. $prm["image"] . '" alt="" data-toggle="modal" data-target="#product_view">
                              </a>';
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

                            <?php
                            echo'<p class="card-text">';
                            echo'</p>';
                          echo'</div>';
                          echo'<div class="card-footer" style="padding: 0px;">';
                              echo'<center>';?>
                                <a href="ajtaupnr.php?IdProduit= <?= $prm["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" >Ajouter a votre panier
                                 <?php  echo'<i class="fab fa-shopping-cart ml-1" ></i>';
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
            <!--
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt="" data-toggle="modal" data-target="#product_view"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#" data-toggle="modal" data-target="#product_view" >Item One</a>
                  </h4>
                  <h5 data-toggle="modal" data-target="#product_view" >$24.99</h5>
                  <p class="card-text">
                  </p>
                </div>
                <div class="card-footer" style="padding: 0px;">
                    <center>
                      <button class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" >Ajouter a votre panier
                        <i class="fab fa-shopping-cart ml-1" ></i>
                      </button>
                    </center>
                </div>
              </div>
            </div>
          </div> 
        --> 
          <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  -->

          <div class="col-*-*"><center><h3>Nouveautés</h3></center></div>
          
        <div class="row indx_link">
            <!-- ========================================================================================== -->
            <?php

            $numberslastprd = 3;
            $lsderniersprd = calcdrnr("*","produit","idproduit",$numberslastprd);

            
            foreach( $lsderniersprd as $prd ){

              if ( $prd['promo'] == 0) 
              {
                echo'<div class="col-*-*">';
              echo'<div class="image-fluid card h-100">';
                echo'<a href="" style="width:300px; hieght:400px;"><img class="card-img-top" src="designe/img/upload/'. $prd["image"] . '" alt="" data-toggle="modal" data-target="#product_view"></a>';
                echo'<div class="card-body">';
                  echo'<h4 class="card-title">';
                    echo'<a href="#" data-toggle="modal" data-target="#modalQuickView">' . $prd['nom'] . '</a>
                  </h4>';
                  echo'<h5 data-toggle="modal" data-target="#product_view"> Prix : ' . $prd["prix"] . ' DZD' . '</h5>';
                  echo'<p class="card-text" data-toggle="modal" data-target="#product_view" ></p>';
                echo'</div>';
                echo'<div class="card-footer" style="padding: 0px;">';
                              
                                   /* echo'<a href="#" id="sccolor" class="hidden-sm" data-toggle="tooltip" data-placement="top" title="Ajouter à votre liste"> <i class="fab fa-shopping-cart"></i> </a>';
                                    echo'<a href="#" class="hidden-sm pull-right" data-toggle="tooltip" data-placement="top" title="Plus de details"><i class="fab fa-list"></i></a>';*/
                                    echo'<center>';?>
                                      <a href="ajtaupnr.php?IdProduit= <?=$prd["idproduit"] ?>" class="btn btn-default btn-md my-0 p waves-effect waves-light btn-block add-cart-btn" type="submit" >Ajouter a votre panier
                                      <?php  echo'<i class="fab fa-shopping-cart ml-1" ></i>';
                                      echo'</a>';
                                    echo'</center>';

                echo'</div>';
              echo'</div>';
            echo'</div>';
          }
            }

            ?>
            <!--
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item Five</a>
                  </h4>
                  <h5>$24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item Six</a>
                  </h4>
                  <h5>$24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>
                -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

<!-- ================================================================================================== -->
<?php include 'footer.php'; ?>
<!--
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
    -->
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
                            <!--<i class="fab fa-users fa-7x"></i> -->
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
          
            echo'<div class="modal fade product_view" id="product_view">';
            echo'<div class="modal-dialog" style="border: none; outline: none; background-color:#111;">';
            echo'<div class="modal-content">';

            echo'<div class="modal-header" >';
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
            /*echo'<div class="col-md-4 col-sm-6 col-xs-12">';
                echo'<select class="form-control" name="select">';
                    echo'<option value="" selected="">Color</option>';
                    echo'<option value="black">Black</option>';
                    echo'<option value="white">White</option>';
                    echo'<option value="gold">Gold</option>';
                    echo'<option value="rose gold">Rose Gold</option>';
                echo'</select>';
            echo'</div>';*/
            //<!-- end col -->
            /*echo'<div class="col-md-4 col-sm-6 col-xs-12">';
                echo'<select class="form-control" name="select">';
                    echo'<option value="">Capacity</option>';
                    echo'<option value="">16GB</option>';
                    echo'<option value="">32GB</option>';
                    echo'<option value="">64GB</option>';
                    echo'<option value="">128GB</option>';
                echo'</select>';
            echo'</div>';*/
            //<!-- end col -->
            /*echo'<div class="col-md-4 col-sm-12">';
                echo'<select class="form-control" name="select">';
                    echo'<option value="" selected="">QTY</option>';
                    echo'<option value="">1</option>';
                    echo'<option value="">2</option>';
                    echo'<option value="">3</option>';
                echo'</select>';
            echo'</div>';*/
            //<!-- end col -->
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
                                       'Description <i class="fab fa-angle-down rotate-icon"></i>';
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
                                        Details <i class="fab fa-angle-down rotate-icon"></i>';
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
                                        'Shipping <i class="fab fa-angle-down rotate-icon"></i>';
                                    echo'</h5>';
                                echo'</a>';
                            echo'</div>';

                            //<!-- Card body -->
                            echo'<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">';
                                echo'<div class="card-body">';
                                    'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';
                        //<!-- Accordion card -->
                    echo'</div>';
                    //<!--/.Accordion wrapper-->

                 
                      echo'<div class="text-center">';

                        echo'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                        echo'<button class="btn btn-primary">Add to cart';
                          echo'<i class="fab fa-cart-plus ml-2" aria-hidden="true"></i>';
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
    
    
    <?php include 'footer.php'; ?>
    
        <!-- </footer>
    </div>
    <script src="designe/js/jquery.min.js"></script>
    <script src="designe/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="designe/js/script.min.js"></script>
</body>

</html> -->