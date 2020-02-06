<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Forgot password</title>

	<link href="<?php echo  base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo  base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo  base_url()?>assets/css/plugins/textSpinners/spinners.css" rel="stylesheet">

	<link href="<?php echo  base_url()?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo  base_url()?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="passwordBox animated fadeInDown">
	<div class="row">

		<div class="col-md-12">
			<div class="ibox-content">

				<h2 class="font-bold">Change password</h2>

				<p>
					Enter your new password.
				</p>

				<div class="row" id="pwd-container3">

					<div class="col-lg-12">
						<?= $this->session->flashdata('message'); ?>
						<?php
						$attr = array("class" => "m-t", "role" => "form", "method" => "POST");
						echo form_open('Login/changepassword', $attr);
						?>
						<div class="form-group">
							<input type="password" class="form-control example3" id="password1" name="password1" placeholder="New password" required="">
							<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmation password" required="">
							<?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<div class="pwstrength_viewport_progress2"></div>
						</div>

						<button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>
						<?php
						echo form_close();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
</div>

</body>
<script src="<?php echo  base_url()?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo  base_url()?>assets/js/popper.min.js"></script>
<script src="<?php echo  base_url()?>assets/js/bootstrap.js"></script>
<script src="<?php echo  base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo  base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo  base_url()?>assets/js/inspinia.js"></script>
<script src="<?php echo  base_url()?>assets/js/plugins/pace/pace.min.js"></script>

<!-- Password meter -->
<script src="<?php echo  base_url()?>assets/js/plugins/pwstrength/pwstrength-bootstrap.min.js"></script>
<script src="<?php echo  base_url()?>assets/js/plugins/pwstrength/zxcvbn.js"></script>

<script>

	$(document).ready(function() {
		var options3 = {};
		options3.ui = {
			container: "#pwd-container3",
			showVerdictsInsideProgressBar: true,
			viewports: {
				progress: ".pwstrength_viewport_progress2"
			}
		};

		options3.common = {
			debug: true,
			usernameField: "#username"
		};
		$('.example3').pwstrength(options3);
	})

</script>
</html>
