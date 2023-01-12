
<?php

    $current_page = basename($_SERVER['PHP_SELF']); 
	$get_category = $_GET['category'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
		<meta name="theme-color" content="#4285f4" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo"<title>Category - ".$get_category."</title>"?>
        <link rel="shortcut icon" href="#">
        <link href="css/reset.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" media="screen and (max-width: 1000px)" href="css/smallDevicesStyle.css"/>
        <link href="css/categoryPageStyle.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600&display=swap" rel="stylesheet" type="text/css">
    </head>

    <body>
		
		<header>
			<p style="padding-top:20px;">Rewind Rentals</p>
			<nav>
				<a href="http://cms/index">Home</a>
				<a href="http://cms/about">About</a>
				<div class="dropdown">
					<p class="drop-text product-nav">Products</p>
					<div class="dropdown-content">
						<a href="http://cms/theme/MyTheme/categoryPage?category=movies">Movies</a>
						<a href="http://cms/theme/MyTheme/categoryPage?category=tvshows">TvShows</a>
					</div>
				</div>
				<a href="http://cms/data-collection">Add Product</a>
				<a href="http://cms/contact">Contact</a>
				<a href="http://cms/privacy">Privacy Policy</a>
				<a href="http://cms/terms" style="width: 220px;">Terms and Conditions</a>
			</nav>
		</header>
        <?php 
			$file_string = $get_category.".xml";
            $xml = file_get_contents($file_string);
            if (trim($xml) == '') {
                die('No content');
            }
            $xml = simplexml_load_string($xml);
            echo"<h1>Category :".$get_category."</h1> ";
			
			$list = array();
			foreach($xml->children() as $item) {
				$list[] = $item;
			};
			
			usort ($list, function($a, $b) {
				return strcmp($a->name, $b->name);		
			});
			
            for($i = 0; $i < count($list); $i++){
				echo"<div class='container'>";
				echo "<p>".$xml->products."</p>";
                echo"<h3>".$list[$i]->name ."</h3>";
                echo"<div class='flex'><div><img alt='product image' src='".$list[$i]->productImg."'></div>";
                echo"<div><h4>Release Year</h4>";
                echo"<p>".$list[$i]->releaseYear."</p>";
				if($list[$i]->episode){
                    echo"<h4>Episode</h4>";
                    echo"<p>".$list[$i]->episode."</p>";
                }
                echo"<h4>".$list[$i]->duration."( ".$list[$i]->duration->attributes().") </h4>";
                echo"<h4>Country of Production</h4>";
                echo"<p>".$list[$i]->productionCountry."</p>";
                echo"<h4 class='capitalize'><strong>".$list[$i]->description->getName()."</strong></h4>";
                echo"<p>".$list[$i]->description."</p>";
                echo"<h4>Mode of Delivery</h4>";
                echo"<p>".$list[$i]->name->attributes()."</p>";
                echo"<h4>Rental Cost</h4>";
                echo"<p>".$list[$i]->rentalCost."</p>";
                echo"<h4>Rental Period</h4>";
                echo"<p>".$list[$i]->rentalPeriod."</p>";
                
                if($list[$i]->productCondition){
                    echo"<h4>Product Condition</h4>";
                    echo"<p>".$list[$i]->productCondition."</p>";
                }
            
                if($list[$i]->review){
                    echo"<h4>Search Tag</h4>";
                }
                
                for($x = 0; $x < count($list[$i]->searchTag); $x++){
                    echo"<ul><li><p>- ".$list[$i]->searchTag[$x];
                    echo"</p></li>";
                }
                
                if($list[$i]->review){
                    echo"<h4>Review</h4><div>";
                }
                
                for($c = 0; $c < count($list[$i]->review); $c++){
                    echo"<ul><li><p> ".$list[$i]->review[$c]."</p>";
                    echo"<h5>".$list[$i]->review[$c]->title."</h5>";
                    echo"<p>".$list[$i]->review[$c]->reviewDescription."</p>";
                    echo"</li></div>";
                }
                if($list[$i]->parentalRating){
                    echo"<h4>Parental Rating</h4>";
                    echo"<p>".$list[$i]->parentalRating."</p>";
                }
                echo"<h4>Extra Product</h4>";
                
                for($z = 0; $z < count($list[$z]->extraProduct); $z++){
                    echo"<h5>".$list[$i]->extraProduct[$z]->extraProductName."</h5>";
                    echo"<p>".$list[$i]->extraProduct[$z]->additionalCost->attributes().$list[$i]->extraProduct[$z]->additionalCost."</p>";
                    
                }
                echo"<div class='center'>";
                echo"<a class='btn' href='".$list[$i]->productURL."'>Product Link</a>";
                echo"</div></div></div></div>";
                }
            ?>
        </div>
		<p id="last-visit-text"></p>
    </body>
</html>