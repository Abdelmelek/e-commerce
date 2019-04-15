<?php  
    //session_start();
    //$titrepage = 'Admin-CP';
        //include 'init.php';
        //include 'header.php';   



    if(isset($_SESSION['user']) && isset($_SESSION['ID'])){
        
        ?>
            <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
                    <div class="container">
                        <a class="navbar-brand" href="user-interface.php" style="font-size:25px; color:#2c3e50;/*rgb(158, 163, 170)*/"><?php echo $websitename ; ?></a>
                        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navcol-1">
                            <ul class="nav navbar-nav">
                              <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Appelez nous"><i class="fa fa-phone"> +213790853722</i></a></li>
                              <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Envoyez-nous un message"><i class="fa fa-envelope"> Nous contacter</i></a></li>
                              <!--<li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);">Accessoire</a></li>-->
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
                                <i class="fa fa-shopping-bag" style="font-size:30px; color:#2c3e50; /*rgb(102, 215, 215)*/margin-right: 30px; padding-right: 0px;">
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

                            <!--
                            <a href="#myModal" class="trigger-btn" data-toggle="modal" style="color:rgb(242,244,247);padding:0px;padding-right:20px;">Connexion</a>
                            <a class="btn btn-light action-button" role="button" href="2.php">S'inscrire</a>-->
                            <div class=" dropdown" >
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #2c3e50 /*rgb(242,244,247)*/;">
                                
                                  <?php echo 'Bienvenue ' . $_SESSION['user']; ?>
                                  
                                </a>
                                <div class="dropdown-menu drpdwn" aria-labelledby="navbarDropdown" style="background-color: #ecf0f1;">
                                  <a class="dropdown-item" href="user-interface?do=edit&idclient=<?php echo $_SESSION['ID']; ?>"><i class="fa fa-user-circle"></i> Profile</a>
                                  <!--<a class="dropdown-item" href="#">Paramètre</a>-->
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt "></i> Déconnexion</a>
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
            <a class="navbar-brand" href="index.php" style="font-size:25px; color: #2c3e50/*rgb(158, 163, 170)*/;"><?php echo $shopnm ; ?></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Appelez nous"><i class="fa fa-phone"> +213790853722</i></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);" title="Envoyez-nous un message"><i class="fa fa-envelope"> Nous contacter</i></a></li>
                    <!--<li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(242,244,247);">Accessoire</a></li>-->
                </ul>
                <form class="form-inline mr-auto" target="_self" action="srch.php" method="post">
                    <div class="form-group">
                        <label for="search-field">
                            <i class="fa fa-search"></i>
                        </label>
                        <input class="form-control search-field" type="search" name="search" id="search-field" style="color: #2f3640 /*rgb(194, 200, 209)*/;">
                    </div>

                </form>
                   <!-- 
                <a href="">
                  <span class="badge">
                    <i class="fa fa-shopping-bag" style="font-size:30px; color:#2c3e50; /*rgb(102, 215, 215)*/margin-right: 30px; padding-right: 0px;">
                      <lavel id="cart-badge" class="badge badge-warning">
                        4
                      </lavel>
                    </i>
                  </span>
                </a>
                            -->
              <a href=" VoirMonPanier.php ">
                  <span class="badge">
                    <i class="fa fa-shopping-bag" style="font-size:30px; color:#2c3e50; /*rgb(102, 215, 215)*/margin-right: 30px; padding-right: 0px;">
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


                <a href="lgn.php" style="color:rgb(242,244,247);padding:0px;padding-right:20px;">Connexion</a>
                <a class="btn btn-light action-button" role="button" href="sign-up.php" style="background-color: #2c3e50 /*#33b5e5*/;">S'inscrire</a>
            </div>
        </div>
    </nav>

    
    
    <?php 
    include 'footer.php';
    }

?>