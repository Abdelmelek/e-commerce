
<?php 

    session_start();
    $usrtitrepage = 'Payment';
    include 'init.php';
    include 'header.php';
    include 'navbar.php';

?>

<!--
<div class="container" style="margin-top: 35px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info" style=" border-radius: 5px; border: 1px solid;">
                <div class="panel panel-heading" style="padding-left: 15px; border: 1px solid; background-color: #7f8c8d; border-radius: 5px; color: #fff; font-weight: bold;text-align: center">
                    <h3> Les informations personelles et les metodes de payments </h3>
                    
                </div>

                <div class="panel panel-body" style="padding-left: 15px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <div class="input-group">
                                    <input type="text" class="col-md-6 form-control" placeholder="" />
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Prenom</label>
                                <div class="input-group">
                                    <input type="text" class="col-md-6 form-control" placeholder="" />
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <div class="input-group">
                                    <input type="text" class="col-md-6 form-control" placeholder="" />
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Adresse</label>
                                <div class="input-group">
                                   
                                    <textarea name="adrs" placeholder="Saisir votre adresse ici ..." rows="2" class="col-md-6 form-control" required="true"></textarea>
                                    
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <!--
                                <div>
                                    <i class="fa fa-cc-mastercard fa-3x"></i>
                                    <i class="fa fa-cc-paypal"></i>
                                    <i class="fa fa-cc-visa"></i>
                                </div>
                                -->
                                <!--
                                <div class="panel panel-info">
                                    <div class="panel panel-heading">
                                        <div class="display-td" >                            
                                            <img class="img-responsive " src="accepted_c22e0.png">
                                        </div>
                                        
                                    </div>
                                    <div class="panel panel-body">
                                        
                                        <div class="form-group">
                                            <label for="cardNumber">Numéro de la carte</label>
                                            <div class="form-group">
                                                <input type="tel" class="col-md-5 form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required autofocus 
                                                 />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3 col-md-3">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">Expire fin </span></label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="cardExpiry"
                                        placeholder="MM / YY"
                                        autocomplete="cc-exp"
                                        required 
                                    />
                                </div>
                            </div>
                            <div class="col-xs-3 col-md-3">
                                <div class="form-group">
                                    <label for="cardCVC">Code C V</label>
                                    <input 
                                        type="tel" 
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>

                                
                                
                                

                            </div>
                        </div>
                    </div>


                </div>

                <div class="panel-footer" style="padding-left: 15px; border: 1px solid; background-color: #7f8c8d; border-radius: 5px; color: #fff; font-weight: bold;text-align: center">
                    <div class="row ">
                        <div class="col-md-6" style="text-align: center;">
                            <!--
                                <button class="btn btn-warning btn-block" style="background: 0;">Avancer</button>
                            -->
                            <!--
                            <a href="" style="text-decoration:none; color: white; text-align: center;"> <h3>Avancer</h3> </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
-->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->




<div class="container">
    <hr>
    <div class="row">
        <aside class="col-sm-6">
            <p>Payment form1</p>
            <article class="card">
                <div class="card-body p-5">
                    <p>
                        <img src="accepted_c22e0.png">
                        <!--
    <img src="http://bootstrap-ecommerce.com/main/images/icons/pay-mastercard.png"> 
   <img src="http://bootstrap-ecommerce.com/main/images/icons/pay-american-ex.png">
-->
                    </p>
                    <form role="form">
                        <div class="form-group">
                            <label for="username">Votre nom sur la carte</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="" required="">
                            </div>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group.// -->
                        <div class="form-group">
                            <label for="cardNumber">Numéro de la carte</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                </div>
                                <input type="text" class="form-control" name="cardNumber" placeholder="">
                            </div>
                            <!-- input-group.// -->
                        </div>
                        <!-- form-group.// -->
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><span class="hidden-xs">Expiration</span> </label>
                                    <div class="form-inline">
                                        <select class="form-control" style="width:45%">
                                            <option>MM</option>
                                            <option>01 - Janiary</option>
                                            <option>02 - February</option>
                                            <option>03 - February</option>
                                        </select>
                                        <span style="width:10%; text-align: center"> / </span>
                                        <select class="form-control" style="width:45%">
                                            <option>YY</option>
                                            <option>2018</option>
                                            <option>2019</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                    <input class="form-control" required="" type="text">
                                </div>
                                <!-- form-group.// -->
                            </div>
                        </div>
                        <!-- row.// -->
                        <button class="subscribe btn btn-primary btn-block" type="button"> Confirm </button>
                    </form>
                </div>
                <!-- card-body.// -->
            </article>
            <!-- card.// -->
        </aside>
        <!-- col.// -->
<!-- =============================================================================================================================== -->
        <aside class="col-sm-6">
            <p>Paymetn form2</p>
            <article class="card">
                <div class="card-body p-5">
                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
        <i class="fa fa-credit-card"></i> Carte credit</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
        <i class="fab fa-paypal"></i>  Paypal</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
        <i class="fa fa-university"></i>  Transfert bancaire</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-tab-card">
                            <!--
                            <p class="alert alert-success">Some text success or error</p>
                            -->
                            <form role="form">
                                <div class="form-group">
                                    <label for="username">Votre Nom et Prénom ( Sur la catre )</label>
                                    <input type="text" class="form-control" name="username" placeholder="" required="">
                                </div>
                                <!-- form-group.// -->
                                <div class="form-group">
                                    <label for="cardNumber">Numéro de la carte</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cardNumber" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-muted">
                    <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>   
                    <i class="fab fa-cc-mastercard"></i> 
                </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- form-group.// -->
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Expiration</span> </label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="MM" name="">
                                                <input type="number" class="form-control" placeholder="YY" name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                            <input type="number" class="form-control" required="">
                                        </div>
                                        <!-- form-group.// -->
                                    </div>
                                </div>
                                <!-- row.// -->
                                <button class="subscribe btn btn-primary btn-block" type="button"> Confirm </button>
                            </form>
                        </div>
                        <!-- tab-pane.// -->
                        <div class="tab-pane fade" id="nav-tab-paypal">
                            <p>Paypal is easiest way to pay online</p>
                            <p>
                                <button type="button" class="btn btn-primary"> <i class="fab fa-paypal"></i> Log in my Paypal </button>
                            </p>
                            <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="tab-pane fade" id="nav-tab-bank">
                            <p>Bank accaunt details</p>
                            <dl class="param">
                                <dt>BANK: </dt>
                                <dd> THE WORLD BANK</dd>
                            </dl>
                            <dl class="param">
                                <dt>Accaunt number: </dt>
                                <dd> 12345678912345</dd>
                            </dl>
                            <dl class="param">
                                <dt>IBAN: </dt>
                                <dd> 123456789</dd>
                            </dl>
                            <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <!-- tab-pane.// -->
                    </div>
                    <!-- tab-content .// -->
                </div>
                <!-- card-body.// -->
            </article>
            <div>
                


            </div>
            <!-- card.// -->
        </aside>
        <!-- col.// -->
    </div>
    <!-- row.// -->
</div>
<!--container end.//-->




<?php 
    include 'footer.php';
?>
