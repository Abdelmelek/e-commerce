<?php 
session_start();
$usrtitrepage = 'Votre Panier';
include 'init.php';
include 'header.php';


require("Fonction_Panier.php");
    if(isset($_SESSION['user']) && isset($_SESSION['ID']))
    {
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
                              <form class="form-inline mr-auto" target="_self" action="user-interface?do=search" method="post">
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
                                    <a class="dropdown-item" href="user-interface?do=edit&idclient=<?php echo $_SESSION['ID']; ?>"><i class="fa fa-user-circle"></i> Profile</a>
                                  
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt "></i> Déconnexion</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </nav>
                -->
<!-- =================================================================================================================================== -->

<?php 

  if(compterArticles()!=0)
  { 
    $tableau=$_SESSION['panier'];
    ?>
  
    <div class="container" style="margin-top: 35px;">

      <div class="text-center">
        <h2>Mon Panier </h2>
      </div>
        <br>
    <div class="pull-right vider_panier" >
      <a href="AjouterAuPanier.php?Vider=1" title="Vider tous le panier">
        <h4>
          Vider le panier <i class="fa fa-minus-circle " style="color:red;"></i>
        </h4>
      </a>
    </div>

     <div class="table-responsive" style="margin-top: 15px;">
        <table class="table table-hover table-striped "  > <!-- style="width: 100%;" -->
            <thead>
                <tr style="background-color: #459EF7; color:#2c3e50;width: 100%;font-weight: bold;">
                
                <td onclick="sortTable(1)" style="width: 10%;">Image</td>
                <td onclick="sortTable(2)" style="width: 35%;">Article</td>
                <td onclick="sortTable(4)" style="width: 10%;">Quantité</td>
                <td onclick="sortTable(7)" style="width: 15%;">Prix Unitaire</td>
                <td onclick="sortTable(8)" style="width: 10%;">Total</td>
                <td onclick="sortTable(8)" style="width: 5%;">Supprimer</td>
                
            </tr>
            </thead>
                        
                        
 
                        <?php 
                  for($i=0;$i<$tableau['nombre'];$i++)
                  {
                      $req=$con->prepare('SELECT * FROM produit WHERE idproduit = ?');
                      $req->execute(array($tableau['libelleProduit'][$i]));
                      $tab=$req->fetch();
                      $total=$tableau['qteProduit'][$i]*$tableau['prixProduit'][$i]; ?>
                             <tr style="color: black;">
                              <td>
                                <img src="designe/img/upload/<?=$tab['image'];?>" style="width: 100%;">
                              </td>
                              <td>
                                <?php echo $tab['marque'] . ' ' . $tab['nom'] ; ?>
                                  
                                </td>
                              <td>
                                <?php //echo $tableau['qteProduit'][$i];
                                ?>
                                <form action="AjouterAuPanier.php" method="post">
                                  <input type="number" name="NVQuant" style="width: 80%;" value="<?= $tableau['qteProduit'][$i]; ?>" />
                                  <input type="hidden" name="LibPro" value= "<?=$tableau['libelleProduit'][$i] ?>"/>
                                  <input type="submit" style="width: 80%;background-color: #459EF7;border: 1px solid #459EF7;" name="Modifier" value="Modiffier">
                                </form>
                              </td>
                              <td>
                                <?php echo $tableau['prixProduit'][$i]." DA" ; ?>
                                  
                                </td>
                              <td>
                                <?php echo $total.' DA'; ?>
                                  
                                </td>
                              <td>
                                <a href="AjouterAuPanier.php?supprimeProduit= <?=$tableau['libelleProduit'][$i] ?>" style="text-align: center;">
                                    <i class='fa fa-trash-alt fa-1x' style='color:red;'></i>
                                </a>
                              </td>
                             </tr> 
        
                   <?php }
                    ?>

                    </table>
                    <a href="AjouterAuPanier.php?Valider=1" class="pull-right"  style="margin-right: 40px;">
                      
                      <i class="fa fa-chevron-circle-right fa-3x"></i>
                      <?php 
                       // header('Location: user-interface.php');
                        //exit();

                      ?>
                    </a>
                      </br>
                      </br>
                      </br>
                      <div class="pull-right">
                        <h4 style="text-decoration: none;">
                          <?php echo "Total Panier : ".MontantGlobal()." DA";?>
                        </h4>
                      </div>

                    <?php
  }else
      {
      ?>

      <br><br>

      <div class="container panier_alrt">
        <div class="col-lg-12 centered alert alert-success alert-dismissible fade show" >
          <!--<button type="button" class="close" id="close1" data-dismiss="alert">&times;</button>-->
          <a href="user-interface.php" >
            Votre panier est maintenant vide 
            <strong>Ajouter des articles à votre panier</strong>

          </a>

      </div>
      </div>
      <!-- ======================================================================================================= -->


      <!-- ======================================================================================================== -->

      <?php
      }
      ?>
    </div>
    </div>                      
  <?php 
    include 'footer.php';
 }else
 {

   header('Location: lgn.php');
   exit();
 }   
  ?>
