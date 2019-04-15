<?php 

    $usrtitrepage = 'Résultat de recherche';
    include 'init.php';
    include 'header.php';
   


        
        
    // Search from MySQL database table
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
                
                $stm = $con -> prepare("SELECT * FROM produit");
                $stm -> execute();
                $rows = $stm -> fetchAll();


                $query = $con->prepare("select * from produit where nom = ? OR marque = ? OR categorie = ? OR disc = ?");
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
                            <div class="img-responsive col-md-4 " style="margin: 0 auto;">
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
                                        <input type="submit" name="btn" value="Ajouter au panier" class="btn btn-info">
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
?>