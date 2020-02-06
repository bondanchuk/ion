<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Forgot password</title>

	<link href="<?php echo  base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo  base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo  base_url()?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo  base_url()?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="passwordBox animated fadeInDown">
	<div class="row">

		<div class="col-md-12">
			<div class="ibox-content">

				<h2 class="font-bold">Forgot password</h2>

				<p>
					Enter your email address and your password will be reset and emailed to you.
				</p>

				<div class="row">

					<div class="col-lg-12">
						<?= $this->session->flashdata('message'); ?>
							<?php
							$attr = array("class" => "m-t", "role" => "form", "method" => "POST");
							echo form_open('Login/forgotPassword', $attr);
							?>
							<div class="form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email address" required="">
								<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
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

</html>
