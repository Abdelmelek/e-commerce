<?php  
    //session_start();
    //$titrepage = 'Admin-CP';
        //include 'init.php';
        //include 'header.php';   
/*
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

              //header('Location: lgn.php');
              //exit();
            }
        }
        */

    if(isset($_SESSION['user']) && isset($_SESSION['ID'])){
        
        ?>
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
                    <div class="container">
                        <a class="navbar-brand" href="user-interface.php" style="font-size:25px; color:#2c3e50;">

                            <?php 
                              echo $websitename ;
                            ?>
                                
                        </a>
                        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navcol-1">
                            <ul class="nav navbar-nav">
                              <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Appelez nous"><i class="fa fa-phone"> +213790853722</i></a></li>
                              <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Envoyez-nous un message"><i class="fa fa-envelope"> Nous contacter</i></a></li>
                              
                            </ul>
                            <form class="form-inline mr-auto" target="_self" action="user-interface?do=search" method="post">
                                <div class="form-group">
                                    <label for="search-field">
                                        <i class="fab fa-search"></i>
                                    </label>
                                    <input class="form-control search-field" type="search" name="search" id="search-field" style="color: #2f3640;">
                                </div>
                            </form>
                                
                            <a href="VoirMonPanier.php">
                              <span class="badge">
                                <i class="fab fa-shopping-bag" style="font-size:30px; color:#2c3e50; margin-right: 30px; padding-right: 0px;">
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
                                  <a class="dropdown-item" href="user-interface?do=edit&idclient=<?php echo $_SESSION['ID']; ?>"><i class="fab fa-user-circle"></i> Profile</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="logout.php"><i class="fab fa-sign-out-alt "></i> Déconnexion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

        <?php include 'footer.php'; ?>
      <?php  
      
	}else
    {
        //include 'init.php';
        //include 'header.php';
    ?>  
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="font-size:25px; color: #2c3e50;">

                <?php 
                    echo $websitename ;
                    

                    ?>
                    
            </a>
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
                            <i class="fab fa-search"></i>
                        </label>
                        <input class="form-control search-field" type="search" name="search" id="search-field" style="color: #2f3640 ;">
                    </div>

                </form>
                  
              <a href=" VoirMonPanier.php ">
                  <span class="badge">
                    <i class="fab fa-shopping-bag" style="font-size:30px; color:#2c3e50; margin-right: 30px; padding-right: 0px;">
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
    include 'footer.php';
    }

?>