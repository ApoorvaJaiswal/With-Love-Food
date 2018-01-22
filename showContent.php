<!doctype html>
<?php session_start();?>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="showContent.css"/>
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
		<script>
	
	function clicked(t){
	//alert(t);		
		jQuery.ajax({
			type: "POST",
			url: 'showContent1.php',
			data: { funcCall:'1', num:t},
			success: function(data)
			{
				
			}
		});
	}
	</script>
</head>
<body>
	<div id="logo">
		<a href="index.php">With Love-Food</a>
	</div>
	<div id="topPart">
		<a href="index.php"><div id="home">Home</div></a>
		<a href="about.php"><div id="about">About Us</div></a>
		<a href="contact.php"><div id="contact">Contact</div></a>
	</div>
	<?php 
	
		$i=$_SESSION['num'];
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$db='food';
		$pyScript = 'C:\\wamp\\www\\WithLove-Food\\nlp.py';
        $pyth = 'C:\\Users\\jaisa\\Anaconda3\\python.exe';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		mysql_select_db($db);
			if(! $conn ) {
			die('Could not connect: ' . mysql_error());
			}
			
		$sqlCheck = "SELECT * FROM recipes";
		$retvalCheck= mysql_query( $sqlCheck, $conn);
		$k=0;
	
			while($row=mysql_fetch_array($retvalCheck,MYSQL_ASSOC))
			{
				if($i==$k)
				{
				$title=$row['Title'];
				$imagePath=$row['Image'];
				$content=$row['Content'];
				exec("$pyth $pyScript $i",$output,$ret);//output array has all the indexes now	
				foreach ($output as $o)
				echo $o."  ";
	?>
	<div id="recipeBack">
		<p id="title">
			<?php echo $title; ?>
		</p>
		<img id="image" src="<?php echo $imagePath;?>" width="400px" height="500px" style="margin-left:200px;">
		<p id="content">
		<?php echo $content;?>
		</p>
	</div>
	<?php
				break;
				}
				else if($k<$i)
				{
					$k++;
				}
				else
					break;
					
			}

			
	?>
	<div id="topRecommendations" >
	<div id="recommendationTitle">Recommended Recipes for You</div>
	<?php
	$titles = array();
	$images = array();
	for($z=0;$z<sizeof($output);$z++)
	{
		$r = 0;
		mysql_data_seek($retvalCheck,0);
		while($row=mysql_fetch_array($retvalCheck,MYSQL_ASSOC))
			{
				if($r == $output[$z] && $output[$z]!=$i)
				{
				$titles[$z]=$row['Title'];
				$images[$z]=$row['Image'];
				
		?>
	<a href="showContent.php">
	<div class="recommendedRecipe" onclick=clicked("<?php echo $output[$z];?>");>
	<p class="recipeTitle"><?php echo $titles[$z];?></p>
	<img src="<?php echo $images[$z];?>" width="290px" height="280px" class="recipeImage" style="margin-left:5px; margin-top:7px;"/>
	</div>
	<?php
				break;
				}
				else
					$r++;
			}
	}
	?>
	</a>
	</div>
</body>
</html>