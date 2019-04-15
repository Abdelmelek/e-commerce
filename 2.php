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
        $nvnm     = $_POST['nom'];
        $nvprnm     = $_POST['prenom'];
        $nvpsd      = $_POST['Pseudo'];
        $nveml      = $_POST['eml'];
        $nvmdp      = $_POST['mdp'];
        $nvtel      = $_POST['tel'];
        $nvadrs     = $_POST['adrs'];

        $hachedPass = sha1($usrpas);

        $sth = $con->prepare("
                        INSERT INTO client (nom, prenom,  pseudo,  email,  mdp, tele, adresse, date, status) 
                            VALUES         (:xnom, :xprenom, :xpseudo, :xemail, :xmdp, :xtele, :xadress, now(), 0) ");
                    $sth->execute(array(
                                        'xnom'      => $nvnm,
                                        'xprenom'   => $nvprnm, 
                                        'xpseudo'   => $nvpsd,
                                        'xemail'    => $nveml, 
                                        'xmdp'      => $hashedpass,
                                        'xtele'     => $addtlf,
                                        'xadress'   => $addadrs
                                    ));
    }
?>
    
 <!-- usrs_signup
    <div class="ctnr-sgnup">-->
        <body style="background: #4e54c8; background: -webkit-linear-gradient(to bottom, #8f94fb, #4e54c8); background: linear-gradient(to bottom, #8f94fb, #4e54c8); ">
        <div class=" bckgrndimg" > <!-- bckgrndimg -->
                    <div class="panel panel-default usrs_signuppnl" > <!-- usrs_signuppnl -->
                     <div class="panel panel-heading usrs_signuppnlhdng" > <!-- usrs_signuppnlhdng -->
                         <h1 class="text-center"> <i class="fa fa-user-circle fa-4x"></i> </h1>
                     </div>
                     <div class="panel panel-body usrs_signuppnlbdy"> <!-- usrs_signuppnlbdy -->
                         <form class="usr-rgstr" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" name="vform">  <!-- usr-rgstr -->
                    <!-- usr-sgnup  form-inline -->  
                      
                            
                        
                            <div>
                                <!--<label class="col-md-4 control-label texthidden">Nom</label> -->
                                <input type="text" name="nom" placeholder="nom" class="  form-control" required="true" />
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                 <!-- <label class="col-md-4 control-label">Prenom</label> -->
                                <input type="text" name="prenom" placeholder="prenom" class=" form-control" required="true" />   
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <!--<label class="col-md-4 control-label">Pseudo</label> -->
                                <input type="text" name="Pseudo" placeholder="Pseudo" class="form-control" required="true"/>
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <!--<label class="control-label">Email</label>-->
                                <input type="email" name="eml" placeholder="Email" class=" form-control" required="true"/>
                            </div>

                            <div class="dividersp"></div>

                            <div id="password_div">
                                <!--<label class="control-label">mdp</label>-->
                                <input type="password" name="mdp" id="password" placeholder="Mots de pass" class=" form-control" required="true"/>
                            </div>

                            <div class="dividersp"></div>

                            <div id="pass_confirm_div">
                                <!--<label class="control-label">retapez votre mot de pass</label>-->
                                <input type="password" name="mdp2" placeholder="retapez mots de pass" class=" form-control" required="true"/>
                                <div id="password_error"></div>
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <input type="tel" name="tel" maxlength="14" placeholder="N° de téléphone" class=" form-control" required="true"/>
                            </div>

                            <div class="dividersp"></div>

                            <div>
                                <!--<label class="control-label">adresse</label>-->
                                <textarea name="adrs" placeholder="tapez votre adresse ici..." rows="2" class=" form-control" required="true"></textarea>
                            </div>

                            <div class="dividersp"></div>
                            
                            <div>
                                <input class=" btn btn-success btn-block" type="submit" value="Continu" style="color: #000; font-weight: bolder;" />
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <!--  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
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