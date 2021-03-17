<?php

	session_start();
	
	if (isset($_POST['name']))
	{
		include 'registration.php';
	}
	else if(isset($_POST['login']))
	{
		include 'login.php';
	}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
		
		
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script src="scripts/overrideURLdeepfake.js"></script>
		<script src="scripts/wpis.js"></script>



		<script type="text/javascript">

			<?php if(isset($_POST['submit_button_register'])) { ?> 

						$(function() {                     
							$('#registerModal').modal('show');     
						});

			<?php } ?>       


			<?php if(isset($_POST['submit_button_login']) &&($_GLOBALS['logged'] == false)) { ?> 

						$(function() {                     
							$('#loginModal').modal('show');     
						});

			<?php } ?> 			

        </script>
    </head>

    <body class="" background="images/background.png">
        <div id="carouselExampleIndicators" class="carousel slide border-bottom border-warning"  data-ride="carousel">
            <!-- To jest baner  -->
           
            <div class="carousel-inner" ">
                <div class="carousel-item active">
                    <img class="d-block w-100 obrazek-banner" src="images/chryzentemy1.jpg" alt="Pierwszy slajd" />
                    <div class="carousel-caption d-none d-md-block cytaty">
                        <h5>„Śmierć nie istnieje, dopóki nie nadejdzie”.</h5>
                        <p>– Stefan Kisielewski</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 obrazek-banner" src="images/chryzentemy2.jpg" alt="Drugi slajd" />
                    <div class="carousel-caption d-none d-md-block cytaty">
                        <h5>„Śmierć nadaje sens życiu, dlatego trzeba mieć ją zawsze przy sobie – w myśli”.</h5>
                        <p>– Stefan Kisielewski</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 obrazek-banner" src="images/chryzentemy3.jpg" alt="Trzeci slajd" />
                    <div class="carousel-caption d-none d-md-block cytaty">
                        <h5>„Gdyby śmierci nie było, nikt z nas by już nie żył. Przemijamy jak wszystko, by w ten sposób przetrwać”.'</h5>
                        <p>– Jan Twardowski</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 obrazek-banner" src="images/chryzentemy4.jpg" alt="Czwarty slajd" />
                    <div class="carousel-caption d-none d-md-block cytaty">
                        <h5>„Bo żyć możesz tylko tym, za co zgodzisz się umrzeć”.</h5>
                        <p>- Antoine de Saint-Exupéry</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 obrazek-banner" src="images/chryzentemy5.jpg" alt="Piąty slajd" />
                    <div class="carousel-caption d-none d-md-block cytaty">
                        <h5>„Śmierć nie jest przeciwieństwem życia, a jego częścią”.</h5>
                        <p>- Haruki Murakami</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
			 <ol class="carousel-indicators indykatoryBanera">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
        </div>
		
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-sm-4"></div>
                <div class="logodiv col-md-1 col-sm-2"><img src="images/logo.png" style="width: 100%; height: auto; transform: rotate(180deg);" /></div>
                <div class="col-sm-4"></div>
            </div>
        </div>
<?php 
									if($_GLOBALS['logged'] == true)
									{
										echo "<div style='color:white; width: 160px; margin: 0 auto;'>Zalogowano na konto</div>";
									}
								?>
        <div class="container-fluid">
            <!-- Tutaj jest faktyczna treść strony -->
            <div class="row no-gutters">
                <div class="col-sm-2"></div>
                <!-- To jest cała lewa przestrzeń -->
                <div class="col-sm-8">
                    <header class="menuGlowne">
                        <!-- To jest menu główne -->
                        <nav class="navbar navbar-expand-lg navbar-dark">
                            <a class="navbar-brand menuOpcja" href="?a=news">Strona główna</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
									<ul class="navbar-nav mr-auto">
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="?a=contact">Kontakt</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="?a=entry">Dodaj wpis</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="?a=book">Księga dusz</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="?a=walk">Spacer wirtualny</a>
										</li>
									</ul>
									<?php
										if($_GLOBALS['logged'] == false){?>
										
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link menuOpcja" data-toggle="modal" data-target="#loginModal" data-backdrop="static">Zaloguj się</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link menuOpcja" data-toggle="modal" data-target="#registerModal" data-backdrop="static">Zarejestruj się</a>
                                    </li>
                                </ul>
										<?php } else{?>
								<ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link menuOpcja" href="logout.php">Wyloguj się</a>
                                    </li>
                                </ul>
										<?php }
										?>
                            </div>
                        </nav>
                    </header>
                    <div class="text-light bg-dark border-warning rounded border-left border-right srodek">
                        <!-- To jest środkowa część strony -->
                        <div class="container">
								<?php 
									include 'content.php';
								?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
                <!-- To jest prawa część strony -->
            </div>
        </div>

        <footer class="container stopka border-top border-warning">
            <div class="row">
                <div class="col-sm-12 text-light">
                    All rights reserved. &copy; 2021
                </div>
            </div>
        </footer>

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-bottom-0 text-light">
                        <button type="button" class="close text-warning" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center text-light">
                            <h4>Zaloguj się</h4>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form method="post">
								<?php
									if (isset($_SESSION['e_login']))
									{
										echo '<div class="error form-group col" style="color: red;">'.$_SESSION['e_login'].'</div>';
										unset($_SESSION['e_login']);
									}
								?>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="#" placeholder="Twój e-mail..." name="login" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="#" placeholder="Twoje hasło...." name="password" />
                                </div>

                                <button type="submit" name="submit_button_login" class="btn btn-warning btn-block btn-round">Zaloguj się</button>
                            </form>

                            <div class="d-flex justify-content-center social-buttons mb-3">
                                <button type="button" class="btn btn-primary btn-round mt-3" data-toggle="tooltip" data-placement="top" title="Facebook">Albo użyj facebooka <i class="bi bi-facebook"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="signup-section text-center text-light pb-3">Nie masz konta? <a href="#a" class="text-warning" data-dismiss="modal" data-toggle="modal" data-target="#registerModal"> Zarejestruj się!</a></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-bottom-0 text-light">
                        <button type="button" class="close text-warning" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center text-light">
                            <h4>Zarejestruj się</h4>
							<h5>Bo razem tworzymy jedność!</h5>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form method="post">
								<div class="row">
									

								</div>
								<div class="row">
									
									<div class="form-group col">
									<?php
										if (isset($_SESSION['e_name']))
										{
											echo '<div class="error text-danger">'.$_SESSION['e_name'].'</div>';
											unset($_SESSION['e_name']);
										}
									?>
										<input type="#" class="form-control" id="#" placeholder="Twoje imię..." name="name" value="<?php
												if (isset($_SESSION['fr_name']))
												{
													echo $_SESSION['fr_name'];
													unset($_SESSION['fr_name']);
												}
											?>"/>
									</div>
									
									
									
									<div class="form-group col">
																		<?php
										if (isset($_SESSION['e_surname']))
										{
											echo '<div class="error  text-danger">'.$_SESSION['e_surname'].'</div>';
											unset($_SESSION['e_surname']);
										}
									?>
										<input type="#" class="form-control" id="#" placeholder="Twoje nazwisko..." name="surname" value="<?php
												if (isset($_SESSION['fr_surname']))
												{
													echo $_SESSION['fr_surname'];
													unset($_SESSION['fr_surname']);
												}
											?>"/>
									</div>
								</div>
								
								<?php
									if (isset($_SESSION['e_email']))
									{
										echo '<div class="error text-danger">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
								?>
								
                                <div class="form-group">
										<input type="email" class="form-control" id="#" placeholder="Twój e-mail..." name="email" value="<?php
											if (isset($_SESSION['fr_email']))
											{
												echo $_SESSION['fr_email'];
												unset($_SESSION['fr_email']);
											}
										?>"/>
                                </div>

								<?php
									if (isset($_SESSION['e_haslo']))
									{
										echo '<div class="error text-danger">'.$_SESSION['e_haslo'].'</div>';
										unset($_SESSION['e_haslo']);
									}
								?>	
								
                                <div class="form-group">
                                    <input type="password" class="form-control" id="#" placeholder="Twoje hasło..." name="password1"/>
                                </div>
								
								
								<div class="form-group">
                                    <input type="password" class="form-control" id="#" placeholder="Potwierdź hasło..." name="password2" />
                                </div>
								
								<?php
									if (isset($_SESSION['e_bot']))
									{
										echo '<div class="error" style="color: red;">'.$_SESSION['e_bot'].'</div>';
										unset($_SESSION['e_bot']);
									}
								?>	
								<div class="form-group text-xs-center">
                                    <div class="g-recaptcha" data-sitekey="6Lc9bIAaAAAAAIdL5MV5d00PFVNqiTeZMq_TzDzy"></div>
                                </div>								
								
								<?php
									if (isset($_SESSION['e_regulamin']))
									{
										echo '<div class="error text-danger">'.$_SESSION['e_regulamin'].'</div>';
										unset($_SESSION['e_regulamin']);
									}
								?>	
								<div class="form-check text-light">
									<label>
									<input type="checkbox" name="regulamin" <?php
									if (isset($_SESSION['fr_regulamin']))
									{
										echo "checked";
										unset($_SESSION['fr_regulamin']);
									}
										?>/> Zapoznałem się z <a href="#" class="text-warning">regulaminem korzystania z serwisu. </a>
									</label>
								</div>
								

                                <button type="submit"  name="submit_button_register" class="btn btn-warning btn-block btn-round">Zarejestruj się</button>
								
                            </form>

                            <div class="d-flex justify-content-center social-buttons mb-3"></div>
                        </div>
                    </div>
                  <div class="signup-section text-center text-light pb-3">  Masz już konto?  <a href="#a" class="text-warning" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"> Zaloguj się!</a></div>
                </div>
            </div>
        </div>

      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
