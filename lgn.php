    <?php

            $usrtitrepage = 'Connexion';
    	    session_start();

            //print_r($_SESSION);

            if(isset($_SESSION['user'])){
                header('Location: user-interface.php');
            }
        include 'init.php';
        include 'header.php';
        /*$pdnavbar = '';*/
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
	            $usremail = $_POST['email'];
	            $usrpas   = $_POST['pass'];
	            $hachedPass = sha1($usrpas);
	            
	            //echo $usremail . ' ' . $hachedPass;
	            //echo '<br>';
            
            //$sth = $con->prepare("SELECT mdp, email FROM client WHERE mdp = ? AND email = ? ");
            $sth = $con->prepare("SELECT idclient,pseudo, mdp, email FROM client WHERE mdp = ? AND email = ? ");

            $sth -> execute(array($hachedPass, $usremail));
            $row = $sth ->fetch();
            $ct = $sth->rowCount();
            /*echo $ct;*/
            if($ct > 0){
            	//$_SESSION['user'] = $usr;
                $_SESSION['user']   = $row['pseudo'];
                $_SESSION['ID'] = $row['idclient'];
                //print_r($_SESSION);
                header('Location: user-interface.php');
                exit();

            }
        }
?>

	<div class="col" style="">
        <form class="col" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <center>
                <div class="user-logo"> 
                    <i class="fab fa-users fa-7x"></i>
                </div> 
                <input class="form-control" type="text"     name="email" placeholder="Tapez votre adress email" autocomplete="yes" />
                <input class="form-control" type="password" name="pass" placeholder="Tapez votre mot de passe" autocomplete="new-password" />
                <input class="btn btn-primary btn-block" type="submit" value="Connexion" />

                <p >Crée un nouveau <a href="sign-up.php">Compte</a> </p>
                <i class="fab fa-car"></i>
            </center>
        </form>
    </div>
    
    <?php 
    	include 'footer.php';
    	?>
