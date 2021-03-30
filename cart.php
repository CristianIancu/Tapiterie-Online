<?php
	session_start();
	require_once("php/dbcontroller.php");
	
if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 

function buttonRandom(){
	$db_handle = new DBController();
	$productRandom = $db_handle->runQuery
		("SELECT * FROM produsetapiterie ORDER BY RAND () LIMIT 1");
	foreach($productRandom as $key=>$value){
		?>
		<li class="span3">
			<div class="product-box">		
				<form method="post" action="index.php?action=add&code=<?php echo $productRandom[$key]["code"]; ?>">
					<a><img src="<?php echo $productRandom[$key]["image"]; ?>"></a>
					<a class="title"><?php echo $productRandom[$key]["name"]; ?></a>
					<p class="price"><?php echo $productRandom[$key]["price"]; ?></p>
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
 function button1(){
	 //echo "nush de mine";
	 $db_handle = new DBController();
		foreach ($_SESSION["cart_item"] as $item){
			//$item_price = $item["quantity"]*$item["price"];
			$cod = $item["code"];
			$res = $db_handle->runQuery("SELECT cumparari FROM produsetapiterie where code=\"$cod\"");
			//echo '<p>' . print_r($res) . '</p>';
			foreach($res as $k => $v){
				
				$res[$k]["cumparari"] = $res[$k]["cumparari"]+$item["quantity"];
				//echo $res[$k]["cumparari"];
				$valoare=$res[$k]["cumparari"];
				$db_handle->runCom("UPDATE produsetapiterie SET cumparari=\"$valoare\" WHERE code=\"$cod\"");
			}
					
			
			
		}
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
			<script src="themes/js/respond.min.js"></script>
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
				<h4><span>Cosul de cumparaturi</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">
					<div class="span9">					
						<h4 class="title"><span class="text"><strong>Cosul</strong> tau</span></h4>
						<table class="table">
							<thead>
								<tr>
									<th>Denumire produs</th>
									<th>Cantitate</th>
									<th>Pret unitar</th>
									<th>Pret</th>
									<th>Sterge</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_SESSION["cart_item"])){
											$total_quantity = 0;
											$total_price = 0;
									?>

								<?php		
										foreach ($_SESSION["cart_item"] as $item){
												$item_price = $item["quantity"]*$item["price"];
										?>
<tr>
	
<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" / width=50px><?php echo $item["name"]; ?></td>
<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
										}
										?>
									<?php
								} else {
								?>
								<div class="no-records">Cosul tau este gol</div>
								<?php 
								}
								?>	
							</tbody>
						</table>
						<form method="post"> 
							<input type="submit" name="button1"
								class="button" value="Comanda acum" /> 
						</form>
					</div>
					<div class="span3 col">
						<div class="block">
							<h4 class="title">
								<form method="post"> 
									<input type="submit" name="buttonRandom"
										class="button" value="Aleatoriu" />
								</form>
							</h4>
							<?php
									if(array_key_exists('buttonRandom', $_POST)) { 
										buttonRandom(); 
									} 
							?>
							
						</div>						
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