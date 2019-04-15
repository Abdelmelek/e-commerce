<?php
    session_start();
   /*$pdnavbar = '';*/
   //print_r($_SESSION);
   /*$pdnavbar = '';*/
   $usrnavbar = '';
   $usrtitrepage = "Page d'inscription";
   if(isset($_SESSION['User'])){
       header('Location: user-interface.php');
   }

    include 'init.php';
    include 'header.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //$nvnm       = $_POST['nom'];
        $nvnm       = $_POST['nom'];
        $nvprnm     = $_POST['prenom'];
        $nvpsd      = $_POST['Pseudo'];
        $nveml      = $_POST['eml'];
        $nvmdp      = $_POST['password1'];
        $nvtel      = $_POST['tel'];
        $nvadrs     = $_POST['adrs'];

        $hachedPass = sha1($nvmdp);

        //verification form
                $erreur = array();
                if (strlen($nvnm) < 4){
                     $erreur[] = 'Le nom ne peut pas etre inférieur à <strong> 4 caractrère </strong>';
                }
                if (strlen($nvnm) > 20){
                    $erreur[] = 'Le nom ne peut pas etre supérieure à <strong> 20 caractrère </strong>';
                }
                if (empty($nvnm)){
                    $erreur[] = 'Le nom ne peut pas etre  <strong> vide </strong>';
                }

                if (strlen($nvprnm) < 4){
                     $erreur[] = 'Le prenom ne peut pas etre inférieur à <strong> 4 caractrère </strong>';
                }
                if (strlen($nvprnm) > 20){
                    $erreur[] = 'Le prenom ne peut pas etre supérieure à <strong> 20 caractrère </strong>';
                }
                if (empty($nvprnm)){
                    $erreur[] = 'Le prenom ne peut pas etre  <strong> vide </strong>';
                }
                
                if (strlen($nvpsd) < 4){
                     $erreur[] = 'Le pseudo ne peut pas etre inférieur à <strong> 4 caractrère </strong>';
                }
                if (strlen($nvpsd) > 20){
                    $erreur[] = 'Le pseudo ne peut pas etre supérieure à <strong> 20 caractrère </strong>';
                }
                if (empty($nvpsd)){
                    $erreur[] = 'Le pseudo ne peut pas etre  <strong> vide </strong>';
                }
                if (empty($nveml)){
                    $erreur[] = 'Le pseudo ne peut pas etre  <strong> vide </strong>';
                }
                if (empty($nvmdp)){
                    $erreur[] = 'Le Mot de pass ne peut pas etre  <strong> vide </strong>';
                }
                if (empty($nvtel)){
                    $erreur[] = 'Le num de téléphone ne peut pas etre  <strong> vide </strong>';
                }
                if (empty($nvadrs)){
                    $erreur[] = "L'adresse ne peut pas etre  <strong> vide </strong>";
                }
                foreach ($erreur as $error){
                    echo '<div class="alert alert-danger">'. $error .'</div>';
                }
                if (empty($erreur))
                {
                    $check = checkifext("pseudo","client",$nvpsd);
                    $checkml = checkifext("email","client",$nveml);

                    if ($check == 1 ) {
                        $msg = "<div class='container col-md-6 alert alert-warning centered' style='margin-top:35px;'>  ce pseudo déja éxiste</div>";
                        redirectHome($msg,'back',3);
                    }

                    /*if ($checkml == 1 ) {
                        $msg = "<div class='container col-md-6 alert alert-warning centered' style='margin-top:35px;'>  cette adresse E-mail déja éxiste</div>";
                        redirectHome($msg,'back',3);
                    }*/

                    $sth = $con->prepare("
                        INSERT INTO client (nom, prenom,  pseudo,  email,  mdp, adresse, tele, date, status) 
                            VALUES         (:xnom, :xprenom, :xpseudo, :xemail, :xmdp, :xadress, :xtele, now(), 0) ");
                    $sth->execute(array(
                                        'xnom'      => $nvnm, //$_POST['nom'],
                                        'xprenom'   => $nvprnm, //$_POST['prenom'],  
                                        'xpseudo'   => $nvpsd, //$_POST['pseudo'],
                                        'xemail'    => $nveml, //$_POST['email'],
                                        'xmdp'      => $hachedPass,
                                        'xadress'   => $nvadrs, //$_POST['adrs'],
                                        'xtele'     => $nvtel //$_POST['tlf']
                                    ));




                    $msg = "<div class='container col-md-6 alert alert-success centered' style='margin-top:35px;'>" .$sth->rowCount(). ' membre Ajouter</div>';
                    redirectHome($msg,'',3);


                  
                }
        /*
        $sth = $con->prepare("
                        INSERT INTO client (nom, prenom,  pseudo,  email,  mdp, tele, adresse, date, status) 
                            VALUES         (:xnom, :xprenom, :xpseudo, :xemail, :xmdp, :xtele, :xadresse, now(), 0) ");
                    $sth->execute(array(
                                        'xnom'      => $nvnm,
                                        'xprenom'   => $nvprnm, 
                                        'xpseudo'   => $nvpsd,
                                        'xemail'    => $nveml, 
                                        'xmdp'      => $hachedPass,
                                        'xtele'     => $nvtel,
                                        'xadresse'  => $nvadrs
                                    ));
                    $msg = "<div class='container col-lg-4 alert alert-success centered'>" .$sth->rowCount(). ' membre Ajouter</div>';
                    redirectHome($msg,'',7);*/
    }
?>
    
 <!-- usrs_signup
    <div class="ctnr-sgnup">-->
        <body style="background: #ADA996; background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);">

            <div class=" bckgrndimg" > <!-- bckgrndimg -->
                    <div class="panel panel-default usrs_signuppnl" > <!-- usrs_signuppnl -->
                     <div class="panel panel-heading usrs_signuppnlhdng" > <!-- usrs_signuppnlhdng -->
                         <h1 class="text-center"> 
                            Inscription <br>
                            <i class="fa fa-user-circle fa-3x" style="margin-top: 15px;"></i> 
                        </h1>
                        <div class="dividersp"><hr></div>
                        
                     </div>
                     <div class="panel panel-body usrs_signuppnlbdy"> <!-- usrs_signuppnlbdy -->
                         <form class="usr-rgstr" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" name="vform" id="passwordForm">  <!-- usr-rgstr -->
                    <!-- usr-sgnup  form-inline -->  
                      
                            
                        
                            <div>
                                <!--<label class="col-md-4 control-label texthidden">Nom</label> -->
                                <input type="text" name="nom" placeholder="Nom" class="  form-control" required="true" />
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                 <!-- <label class="col-md-4 control-label">Prenom</label> -->
                                <input type="text" name="prenom" placeholder="Prénom" class=" form-control" required="true" />   
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <!--<label class="col-md-4 control-label">Pseudo</label> -->
                                <input type="text" name="Pseudo" placeholder="Pseudo" class="form-control" required="true"/>
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <!--<label class="control-label">Email</label>-->
                                <input type="email" name="eml" placeholder="E-mail" class=" form-control" required="true"/>
                                
                            </div>

                            <div class="dividersp"></div>

                            <div id="password_div">
                                <!--<label class="control-label">mdp</label>-->
                                <input type="password" name="password1" id="password1" placeholder="Mot de passe" autocomplete="off" class=" form-control" required="true"/>
                                <!--
                                <div class="row">
                                    <div class="col-sm-6">
                                    <span id="8char" class="fa fa-remove" style="color:#FF0004;"></span> 8 Characters Long<br>
                                    <span id="ucase" class="fa fa-remove" style="color:#FF0004;"></span> One Uppercase Letter
                                    </div>
                                    <div class="col-sm-6">
                                    <span id="lcase" class="fa fa-remove" style="color:#FF0004;"></span> One Lowercase Letter<br>
                                    <span id="num" class="fa fa-remove" style="color:#FF0004;"></span> One Number
                                    </div>
                                </div>
                            -->

                            <div class="dividersp"></div>

                            <div id="pass_confirm_div">
                                <!--<label class="control-label">retapez votre mot de pass</label>-->
                                <input type="password" name="password2" id="password2" placeholder="Entrer le mot de passe à nouveau" autocomplete="off" class=" form-control" required="true"/>
                                <!--
                                <div id="password_error"></div>
                                    <span id="confirmMessage" class="confirmMessage"></span>-->
                                    <!--
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span id="pwmatch" class="fa fa-remove" style="color:#FF0004;"></span> Passwords Match
                                    </div>
                                </div>
                            -->
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <input type="tel" name="tel" maxlength="14" placeholder="N° de téléphone" class=" form-control" required="true"/>
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <!--<label class="control-label">adresse</label>-->
                                <textarea name="adrs" placeholder="Saisir votre adresse ici ..." rows="2" class=" form-control" required="true"></textarea>
                            </div>

                            <div class="dividersp"></div>
                            
                            <div>
                                <input class=" btn btn-success btn-block" type="submit" value="Continuer" style="color: #000; font-weight: bolder;" />
                            </div>
                        </form>
                    </div>
                </div>
                </div>
<!--  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-body signupimg">
                            
                        </div>
                    </div>

        </div>
</body>


<?php
    include 'footer.php'
?>