<?php
	session_start();
	
	$con= mysqli_connect('localhost','root','','register');
	mysqli_select_db($con, 'register');
	
	$name = isset($_POST['username']) ? $_POST['username'] : '';
	$pass = isset($_POST['password']) ? $_POST['password'] : ''; 
	
	$s = "select * from users where name = '$name'";
	
	
	$result= mysqli_query($con, $s);
	$num = mysqli_num_rows($result);
	
	if($num == 1){
		#
		
	}else{
		$reg = "insert into users(name,password) values ('$name','$pass')";
		mysqli_query($con, $reg);
		
		}
	
	
	?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tapiterie Online</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row">
				<div class="account pull-right">
					<ul class="user-menu">				
						<li><a href="cart.php">Cosul Tau</a></li>				
						<li><a href="register.php">Autentificare</a></li>				
					</ul>
				</div>
				<div>
					<h1 colour="Orange">  Tapiterie Online </h1>
				</div>
			</div>
    </div>
    <div id="wrapper" class="container">
		<section class="navbar main-menu">
			<div class="navbar-inner main-menu">
				<nav id="menu" class="pull-right">
					<ul>
						<li><a href="./productsCanapele.php">Canapele</a></li>	
						<li><a href="./productsFotolii.php">Fotolii</a></li>			
						<li><a href="./productsScaune.php">Scaune</a></li>			
					</ul>
				</nav>
				<nav id="menu" class="pull-left">
					<ul>
						<li><a href="./products.php">Toate produsele</a></li>				
					</ul>
				</nav>
			</div>
		</section>			
			<section class="header_text sub">
				<h4><span>Autentificare si Inregistrare</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
						<h4 class="title"><span class="text"><strong>Forum de</strong> Autentificare</span></h4>
						<form action="login.php" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Nume de utilizator</label>
									<div class="controls">
										<input type="text" placeholder="Introdu numele de utilizator" name="username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Parola</label>
									<div class="controls">
										<input type="password" placeholder="Introdu parola" name="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="Autentica-te">
								</div>
							</fieldset>
						</form>				
					</div>
					<div class="span7">					
						<h4 class="title"><span class="text"><strong>Forum de</strong> inregistrare</span></h4>
						<form action="register.php" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Nume de utilizator:</label>
									<div class="controls">
										<input type="text" placeholder="Introdu numele de utilizator" name="nume de utilizator" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Parola:</label>
									<div class="controls">
										<input type="password" placeholder="Introdu parola" name="parola" class="input-xlarge">
									</div>
								</div>		
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Creaza-ti contul"></div>
							</fieldset>
						</form>					
					</div>				
				</div>
			</section>		
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigare</h4>
						<ul class="nav">
							<li><a href="./index.php">Acasa</a></li>  
							<li><a href="./contact.php">Contacteaza-ne</a></li>
							<li><a href="./cart.php">Cosul Tau</a></li>
							<li><a href="./register.php">Inregistreaza-te</a></li>							
						</ul>					
					</div>					
				</div>	
			</section>
			<section id="copyright">
				<span>Copyright 2021 Tapiterie Online.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>		
    </body>
</html>