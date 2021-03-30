<?php
session_start();
require_once("php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM produsetapiterie WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"],'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"],'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
	}
}
//echo '<p>' . print_r($_SESSION) . '</p>';
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="bootstrap/css/style.css" rel="stylesheet"/>
		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
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
	</div>
<div id="wrapper" class="container">
<section class="main-content">
	<div class="row">	
		<?php
		$product_array = $db_handle->runQuery("SELECT * FROM produsetapiterie where tip=\"canapea\"");
		if (!empty($product_array)) { 
			foreach($product_array as $key=>$value){
		?>
		<li class="span3">
			<div class="product-box">		
				<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
					<a><img src="<?php echo $product_array[$key]["image"]; ?>"></a>
					<a class="title"><?php echo $product_array[$key]["name"]; ?></a>
					<p class="price"><?php echo $product_array[$key]["price"]; ?></p>
					<div class="cart-action">
						<input type="text" class="product-quantity" name="quantity" value="1" size="2" />
						<input type="submit" value="Adauga in cos" class="btn btn-warning my-3"/>
					</div>
				</form>
			</div>
		</li>
		<?php
			}
		}
		?>			
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
    <script src="themes/js/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "fade",
                    slideshowSpeed: 4000,
                    animationSpeed: 600,
                    controlNav: false,
                    directionNav: true,
                    controlsContainer: ".flex-container" // the container that holds the flexslider
                });
            });
        });
    </script>
</body>
</html>