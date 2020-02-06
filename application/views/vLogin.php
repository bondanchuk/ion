<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Login</title>

	<link href="<?php echo  base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo  base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo  base_url()?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo  base_url()?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
	<div style="padding-top: 30%">
		<div>

			<img src="<?php echo  base_url()?>assets/img/logo3.png">

		</div>
		<?= $this->session->flashdata('message'); ?>
			<?php
			$attr = array("class" => "m-t", "role" => "form");
			echo form_open('Login', $attr);
			?>
			<div class="form-group">
				<input type="email" class="form-control" id="email" name="email" placeholder="Username" required="">
				<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
				<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
			</div>
			<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

			<a href="<?php echo base_url()?>index.php/Login/forgotPassword"><small>Forgot password?</small></a>
			<p class="text-muted text-center"><small>Do not have an account?</small></p>
			<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
		<?php
		echo form_close();
		?>
	</div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo  base_url()?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo  base_url()?>assets/js/popper.min.js"></script>
<script src="<?php echo  base_url()?>assets/js/bootstrap.js"></script>

</body>

</html>
