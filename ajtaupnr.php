<?php 
session_start();
//$connexion= new PDO('mysql:host=127.0.0.1;dbname=dogan','root','');
include 'connect.php';
require("Fonction_Panier.php");
if(!empty($_GET['IdProduit'])){
$IdProduit=(int) $_GET['IdProduit'];

$qteProduit = 1;
    $req=$con->prepare('SELECT * FROM produit WHERE idproduit = ?');
    $req->execute(array($IdProduit));
        $prm=$req->fetch();
       
            
    $panier=creationPanier();
    if($prm['promo'] > 0){
        $jouter=ajouterArticle($IdProduit,$qteProduit,$prm['promo']);
      }else{

        $jouter=ajouterArticle($IdProduit,$qteProduit,$prm['prix']);
      }
        header ('Location: index.php?Ajouter=1');

  }
 if(!empty($_POST['NVQuant'])){

					$b=modifierQTeArticle( $_POST['LibPro'],$_POST['NVQuant']);
					header ('Location: VoirMonPanier.php');
					}

					if( !empty($_GET['supprimeProduit'])){
					$IdProduit=(int) $_GET['supprimeProduit'];
					$sup=supprimerArticle($IdProduit);
				header ('Location: VoirMonPanier.php');}
	
     if(!empty($_GET['Vider'])){
        $sup=supprimePanier();
        header ('Location: VoirMonPanier.php');
     }
    if(!empty($_GET['Valider'])){
    	
	
	$date=date("Y/m/d");
	$total=MontantGlobal();
	$nombre = $_SESSION['panier']['nombre'];
	$insert=$con->prepare("INSERT INTO commande ( datecommande , idclient , 	nbrarticle , total ,valide ) VALUES (?,?,?,?,?)");
    $insert->execute(array($date,$_SESSION['ID'],$nombre,$total,0));
    $tableau=$_SESSION['panier'];
    $tab = $con->query('SELECT * from commande ');
     foreach ($tab as $prd) {
     	$IdCommande=$prd['idcommande'];
     }

     			for($i=0;$i<$_SESSION['panier']['nombre'];$i++){
     				$Quantite =$_SESSION['panier']['qteProduit'][$i];
     				$ID=$_SESSION['panier']['libelleProduit'][$i];
     				
				$insert2=$con->prepare("INSERT INTO produitcommande (idcommande, idproduit , quantite ,prix) VALUES (?,?,?,?)");
				$insert2->execute(array($IdCommande,$ID,$Quantite,$_SESSION['panier']['prixProduit'][$i]));
       			 }
             $sup=supprimePanier();
         header ('Location: index.php');
}/*
if(!empty($_GET['Type'])){
        
    
    $date=date("Y/m/d");
    $total=MontantGlobal();
                                                  $req2=$con->prepare("SELECT * from client WHERE idclient=? ");
                                                  $req2->execute(array($_SESSION['Id']));
                                                  $table2=$req2->fetch();
                                                  $req=$con->prepare("SELECT * from banque WHERE Nom=? AND Prenom =?");
                                                  $req->execute(array($table2['Nom'],$table2['Prenom']));
                                                  $table=$req->fetch();
                                                  $Fond=$table['Fond']-$total;
                                                  $req5=$con->prepare('UPDATE banque SET Fond = ? WHERE Id = ?');
                                                  $req5->execute(array($Fond,$table['Id']));

    $nombre = $_SESSION['panier']['nombre'];
    $insert=$con->prepare("INSERT INTO commande ( dateCommande , idclient ,   nbrarticle , total ,  valide )VALUES (?,?,?,?,?,?,?,?)");
    $insert->execute(array($date,$_SESSION['Id'],$nombre,$total,1,$_GET['Type'],'Paye',0));
    $tableau=$_SESSION['panier'];
    $tab = $con->query('SELECT * from commande ');
     foreach ($tab as $prd) {
        $IdCommande=$prd['Id'];}

                for($i=0;$i<$_SESSION['panier']['nombre'];$i++){
                    $Quantite =$_SESSION['panier']['qteProduit'][$i];
                    $ID=$_SESSION['panier']['libelleProduit'][$i];
                    
                $insert2=$con->prepare("INSERT INTO produitcommande (IdCommande, IdProduit , Quantite ) VALUES (?,?,?)");
                $insert2->execute(array($IdCommande,$ID,$Quantite));
                                                  $req2=$con->prepare("SELECT * from produitfinit WHERE Id=? ");
                                                  $req2->execute(array($ID));
                                                  $table2=$req2->fetch();
                                                  $NewQ=$table2['Quantite']-$Quantite;
                                                  $req5=$con->prepare('UPDATE produitfinit SET Quantite = ? WHERE Id = ?');
                                                  $req5->execute(array($NewQ,$ID));

                 }
                 
                 $sup=supprimePanier();
         header ('Location: Recherche.php');break;
}*/
  ?>