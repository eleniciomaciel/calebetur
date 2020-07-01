<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta name="theme-color" content="#0000FF">
	<title>Login - CalebeTur</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="stylus/login/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/fonts/font-awesome-4.7.0/css/all.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="stylus/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="stylus/login/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" autocomplete="off" id="logForm">
					<span class="login100-form-title p-b-34">
						<img src="<?= base_url() ?>stylus/assets/img/logo_geral.png" class="img-responsive" alt="Calebe Turismo">
					</span>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Digite um login válido" required>
						<input id="first-name" class="input100" type="email" name="acesso_login" placeholder="Login">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Digite uma senha válida" required>
						<input class="input100" type="password" name="acesso_senha" placeholder="Sua Senha">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">

						<button type="submit" class="login100-form-btn">
							<span id="logText"></span>
						</button>

					</div>

					<div id="responseDiv" class="alert text-center" style="margin-top:20px; display:none; width:100%;">
						<button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
						<span id="message"></span>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Esqueceu
						</span>

						<a href="#" data-transition="pop" class="txt2" data-toggle="modal" data-target="#staticBackdrop">
							o nome de usuário / senha?
						</a>
					</div>
					
				</form>

				<div class="login100-more" style="background-image: url('stylus/login/images/bg-01.jpg');"></div>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Recuperar acesso</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="acesso_login">Email pessoal:</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							<small id="emailHelp" class="form-text text-muted">Seu email pessoal.</small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Seu cpf:</label>
							<input type="text" class="form-control" id="exampleInputPassword1">
						</div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-angle-double-right"></i> Solicitar</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="stylus/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="stylus/login/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="stylus/login/vendor/bootstrap/js/popper.js"></script>
	<script src="stylus/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="stylus/login/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
	<!--===============================================================================================-->
	<script src="stylus/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="stylus/login/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="stylus/login/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="stylus/login/js/main.js"></script>
	<!--===============================================================================================-->
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#logText').html('Login');
			$('#logForm').submit(function(e) {
				e.preventDefault();
				$('#logText').html('<div class="load"> <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>Verificando....<span class="sr-only">Loading...</span> </div>');
				var url = '<?php echo site_url('acesso-restrito'); ?>';
				var user = $('#logForm').serialize();
				var login = function() {
					$.ajax({
						type: 'GET',
						url: url,
						dataType: 'json',
						data: user,
						success: function(response) {
							$('#message').html(response.message);
							$('#logText').html('Login');
							if (response.error) {
								$('#responseDiv').removeClass('alert-success').addClass('alert-danger').show();
							} else {
								$('#responseDiv').removeClass('alert-danger').addClass('alert-success').show();
								$('#logForm')[0].reset();
								setTimeout(function() {
									location.reload();
								}, 3000);
							}
						}
					});
				};
				setTimeout(login, 3000);
			});

			$(document).on('click', '#clearMsg', function() {
				$('#responseDiv').hide();
			});
		});
	</script>
</body>

</html>