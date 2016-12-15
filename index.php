<?php
session_start();
?>

<?php
require 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Test de conocimientos ingreso marketeros</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
		
<link rel="icon" type="image/png" sizes="32x32" href="http://www.marketerosweb.co/wp-content/uploads/freshframework/ff_fresh_favicon/favicon_32x32--2016_04_25__06_42_58.png">
<link rel="icon" type="image/png" sizes="16x16" href="http://www.marketerosweb.co/wp-content/uploads/freshframework/ff_fresh_favicon/favicon_16x16--2016_04_25__06_42_58.png"> 
<meta name="msapplication-TileColor" content="#FFFFFF" >
<link rel="shortcut icon" href="http://www.marketerosweb.co/wp-content/uploads/freshframework/ff_fresh_favicon/icon2016_04_25__06_42_58.ico" />

	</head>
	<body>
		<header>
			<p class="text-center">
				<?php if(!empty($_SESSION['name'])){echo 'Bienvenido: '.$_SESSION['name'].'<br />'.$_SESSION['emailCandidato'].' te deseamos suerte en esta prueba, recuerda que solo tienes una oportunidad y sólo tienes 30 minutos para resolver el cuestionario';}
				else{
					echo '<span>Bienvenido</span><br /> Esta es una prueba de conocimientos para saber tus conocimientos de php';
					}
				?>
                
			</p>
		</header>
		<div class="container">
			<div class="row">
				<div class="col-xs-14 col-sm-7 col-lg-7" style="width: 25%;">
					
				</div>
				<div class="col-xs-10 col-sm-5 col-lg-5">
				<div class='image-logo'>
						<img src="http://www.marketerosweb.co/wp-content/uploads/2015/01/marketerosweb.png" class="img-responsive"/>
					</div>
					<div class="intro">
						<p class="text-center">
							Por favor ingresa tu nombre
						</p>
						<?php if(empty($_SESSION['name'])){?>
						<form class="form-signin" method="post" id='signin' name="signin" action="questions.php">
							<div class="form-group">
								<input type="text" id='name' name='name' class="form-control" placeholder="Ingresa tu nombre"/>
								<input type="email" id='emailcandidato' name='emailcandidato' class="form-control" placeholder="Ingresa tu email"/>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
							    <select class="form-control" name="category" id="category">
							      <option value="">Escoge el cargo al que aspiras</option>
                                  <option value="1">Programador Senior</option>
                                  <option value="2">Programador Junior</option>
                                  
                                </select>
                                <span class="help-block"></span>
							</div>

							<br>
							<button class="btn btn-success btn-block" type="submit">
								 Empezar prueba
							</button>
						</form>

						<?php }else{?>
						    <form class="form-signin" method="post" id='signin' name="signin" action="questions.php">
	                            <div class="form-group">
	                                <select class="form-control" name="category" id="category">
	                                  <option value="">Escoge el cargo al que aspiras</option>
	                                  <option value="1">Programador Senior</option>
	                                  <option value="2">Programador Junior</option>
	                                </select>
	                                <span class="help-block"></span>
	                            </div>

	                            <br>
	                            <button class="btn btn-success btn-block" type="submit">
	                                Empezar prueba
	                            </button>
                    	    </form>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		<footer>
			
		</footer>
		
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		
		<script src="js/jquery.validate.min.js"></script>

		<script>
			$(document).ready(function() {
				$("#signin").validate({
					submitHandler : function() {
					    console.log(form.valid());
						if (form.valid()) {
						    alert("sf");
							return true;
						} else {
							return false;
						}

					},
					rules : {
						name : {
							required : true,
							minlength : 3,
							remote : {
								url : "check_name.php",
								type : "post",
								data : {
									username : function() {
										return $("#name").val();
									}
								}
							}
						},
						emailcandidato:{
						    required : true
						},
					
					category:{
						    required : true
						}
					},
					messages : {
						name : {
							required : "Por favor ingresa tu nombre",
							remote : "Este nombre ya esta registrado por favor ingresa otro"
						},
						emailcandidato:{
                            required : "Por favor ingresa tu email"
                        },
						category:{
                            required : "Por favor escoge una categoría para empezar"
                        }
					},
					errorPlacement : function(error, element) {
						$(element).closest('.form-group').find('.help-block').html(error.html());
					},
					highlight : function(element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					success : function(element, lab) {
						var messages = new Array("", "", "", "", "", "");
						var num = Math.floor(Math.random() * 6);
						$(lab).closest('.form-group').find('.help-block').text(messages[num]);
						$(lab).addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
					}
				});
			});
		</script>

	</body>
</html>