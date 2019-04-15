<?php
session_start();
include 'init.php';
//$connexion= new PDO('mysql:host=127.0.0.1;dbname=pharmaciee','root','');
if(isset($_POST['query']) AND empty($_POST['query'])){
	$_SESSION['query']=array();
	$_SESSION['Type']=array();
}

if(isset($_POST['query']) AND !empty($_POST['query']))  {
	$query = preg_replace("#[^a-zA-Z ?0-9]#i"," ",$_POST['query']);
	$_SESSION['Type']=array();
	$_SESSION['query']=$query;
}
 if (isset($_GET['query']) AND !empty($_GET['query'])){
	$query = preg_replace("#[^a-zA-Z ?0-9]#i"," ",$_GET['query']);
	$_SESSION['query']=array();
	$_SESSION['Type']=$query;
 }
if(!empty($_SESSION['query'])){
$ArticleTotal = $connexion->query('SELECT * from produit WHERE nom LIKE "'.$_SESSION['query'].'%"ORDER BY nom');}
if(empty($_SESSION['query'])){
$ArticleTotal = $connexion->query('SELECT * from produit ORDER BY nom');
}
if(!empty($_SESSION['Type'])){
$ArticleTotal = $connexion->query('SELECT * from produit WHERE categorie LIKE "'.$_SESSION['Type'].'"ORDER BY Nom');}
$ArticleParPage = 12;
$NombreTotalArticle = $ArticleTotal ->rowCount();
$pageTotal=ceil($NombreTotalArticle/$ArticleParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page']>0)){
    $_GET['page']=intval($_GET['page']);
    $pageCourante = $_GET['page'];
    
}else { $pageCourante = 1; }

$depart = ($pageCourante-1)*$ArticleParPage;

require ("EnTete.html");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="Css/Acceuil.css" />
<title>BeinLife</title>

<style>  .page{position: absolute;top: 300px;height:1230px;width: 70%;left:225px;background-color:rgba(192, 192, 192, 0.3)}
        fieldset{position: absolute;height:98%;width:97%; border: solid 1px;}
        .retour{position: absolute;width: 5%;top:1140px; left: 50px; right: 50px;height: 35px;border-radius: 9px; border-color:#73B7EF;font-size: large}
        .suivant{position: absolute; width: 5%;top:1140px; right: 50px;height: 35px;border-radius: 9px;border-color:#73B7EF; font-size: large}
	    .tab1{position: absolute; width: 90%; left: 50px;height: 20%;border-radius: 9px;border-color:#73B7EF;text-align: center;}
        .b1{position: absolute; width: 10%; height: 25px;border-radius: 9px;top:200px;border-color:#73B7EF;text-align:center;}
		.b2{position: absolute; width: 10%; height: 25px;border-radius: 9px;top: 200px;border-color:#73B7EF;text-align:center;}
		.b3{position: absolute; width: 10%; height: 25px;border-radius: 9px;top: 200px;border-color:#73B7EF;text-align:center;}
		.b4{position: absolute; width: 10%; height: 25px;border-radius: 9px;top: 200px;border-color:#73B7EF;text-align:center;}
		.tab2{position: absolute; width: 90%; left: 50px;height: 20%;border-radius: 9px; top:  450px;border-color:#73B7EF;text-align: center;}		  
		.tab3{position: absolute; width: 90%; left: 50px;height: 20%;border-radius: 9px; top:  800px;border-color:#73B7EF;text-align: center;}
        .Pagination{position: absolute;bottom: 30px;right: 10%;width: 80%;text-align: center;font-size: 20px;font-weight:bold;color: blue;}
		.Titre{position: absolute;top: 5px;width: 25%;text-align: center;}
		.Image{position: absolute;top: 30px;width: 25%;text-align: center;}
        .resultat{position: absolute;top: 20px;color: #9ACD32;left: 40px;}
		.gif{position: absolute;top: 400px;width: 200px;left: 10px;height: 800px;}
</style>
<script>
	(function($){
		$(document).ready(function(){
			var offset = $("#gif").offset().top;
			$(document).scroll(function(){
				var scrollTop = $(document).scrollTop();
				if(scrollTop > offset){
					$("#gif").addClass('fixed');
					$("#gif").removeClass("gif");
				}else{
					$("#gif").addClass('gif');
					$("#gif").removeClass("fixed");
				}
			});
		});
	})(jQuery);
	</script>
</head>
<body onLoad="get()"><?php
if(!empty($_SESSION['query'])){
$Article = $connexion->query('SELECT * From medicament WHERE Nom LIKE "'.$_SESSION['query'].'%" ORDER BY Nom DESC LIMIT '.$depart.','.$ArticleParPage.'');
}
if(!empty($_SESSION['Type'])){
$Article = $connexion->query('SELECT * From medicament WHERE Type LIKE "'.$_SESSION['Type'].'" ORDER BY Nom DESC LIMIT '.$depart.','.$ArticleParPage.'');
}

if(empty($_SESSION['query']) AND empty($_SESSION['Type'])){
$Article = $connexion->query('SELECT * from medicament ORDER BY Nom DESC LIMIT '.$depart.','.$ArticleParPage.'');
}
 if(empty($_SESSION['logged']))require("Compte.php"); ?>
	
	<?php if($_SESSION['Pseudoname']=='Administrateur' AND ($_SESSION['logged'] )){require("Admin.php");}?>
	<?php if($_SESSION['Pseudoname']!='Administrateur' AND ($_SESSION['logged'] )){require("Utilisateur.php");}
$i=1;?>
<img class="gif" id="gif" src="Css/01_23_13_nivea_new_4-322x494.gif"/>
<div class="page"><?php
if($NombreTotalArticle==0){ ?>
<h1 class="resultat">Il ya Aucune resultat trouvé</h1>
<?php }
while($Art = $Article->fetch()){
    

 
                if($i==1){ ?>
				<table class="tab1" border="1" >
                <tr>
                    <div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b1" type="submit"  value="voir details"/> </form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div> <?php  }?>
		<?php   if($i==2){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b2" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php }?>
		<?php   if($i==3){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b3" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php  }?>
	    <?php   if($i==4){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b4" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div> </td></div>
                    
                </tr></table><?php  }?>
        <?php    if($i==5){ ?>
				<table class="tab2" border="1">
                <tr>
                    <div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b1" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php  }?>
		<?php   if($i==6){ ?><div><td width=25% ><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b2" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php  }?>
		<?php   if($i==7){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b3" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php  }?>
		<?php   if($i==8){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b4" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div>
                    
                </tr></table><?php  }?>
        <?php    if($i==9){ ?>
				<table class="tab3" border="1" >
                <tr>
                    <div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b1" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php  }?>
		<?php   if($i==10){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b2" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php }?>
		<?php   if($i==11){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b3" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div><?php  }?>
		<?php   if($i==12){ ?><div><td width=25%><form action="VoirDetail.php" method="post"><input type="hidden" name="IdMedicament" value="<?=$Art["Id"]; ?>"/><input class="b4" type="submit"  value="voir details"/></form><div class="Titre"><?php echo  $Art["Nom"];?></div><div class="Image"><img width="180" height="160" src="Medicament/<?=$Art['URL']; ?>"/></div></td></div>
                    
                </tr></table><?php  }$i++;
	
}?>
  <div class="Pagination">  
<?php for($i=1;$i<=$pageTotal;$i++){
    if($i == $pageCourante){
        echo $i;
    }else{
  echo '<a href="Recherche.php?page='.$i.'">     '.$i.'    </a>';  }
}
?></div></div>
</body>
</html>