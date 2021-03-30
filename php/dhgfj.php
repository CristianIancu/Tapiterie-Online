<?php


function component($productname, $productprice, $productimg,$productid){
    $element = "
    <li class=\"span3\">
		<div class=\"product-box\">												
			<a href=\"product_detail.html\">
            <img src=\"$productimg\"></a><br/>
			<a href=\"product_detail.html\" class=\"title\">$productname</a><br/>
			<p class=\"price\">$productprice LEI</p>
			<div class=\"cart-action\">
				<input type=\"submit\" value=\"Add to Cart\" class=\"btnAddAction\" /></div>
			</div>
		</div>
	</li>	
    ";
    echo $element;
}
function cart($productimg,$productname, $productprice,$productid){
		$ele="
		<form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
			<tr>
				<td><input type=\"checkbox\" value=\"option1\"></td>
				<td><a href=\"product_detail.html\"><img alt=\"\" src=\"$productimg\" width=100px ></a></td>
				<td>$productname</td>
				<td><input type=\"text\" placeholder=\"1\" class=\"input-mini\"></td>
				<td>$productprice lei</td>
				<td>$productprice lei</td>
			</tr>
		";
		echo $ele;
}
function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}
