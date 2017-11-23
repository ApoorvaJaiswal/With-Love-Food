<!doctype html>
<?php session_start();?>
<html>
<head>
<title>
With Love-Food
</title>
	<link type="text/css" rel="stylesheet" href="index.css"/>
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
	<div id="titleQuote">
	<p>
	<i>"There is no sincerer love than the love of Food"</i>
	</p>
	</div>
	<div id="topSearch">
	Top Searches
	</div>
		<?php
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = '';
			$db='food';
			$conn = mysql_connect($dbhost, $dbuser, $dbpass);
			mysql_select_db($db);
			if(! $conn ) {
			die('Could not connect: ' . mysql_error());
			}
			
			$sqlCheck = "SELECT * FROM recipes";
			$retvalCheck= mysql_query( $sqlCheck, $conn);
			$i=0;
			while($row=mysql_fetch_array($retvalCheck,MYSQL_ASSOC))
			{
				$title=$row['Title'];
				$imagePath=$row['Image'];
				
				
		?>
			<a href="showContent.php" ><div class="foods" onclick=clicked("<?php echo $i;?>");>
			<div class="foodsTitle"><?php echo $title;?></div>
			<img class="foodsImage" width="300px" height="370px" src="<?php echo $imagePath;?>" style="margin-left:25px; margin-top:16px;">
			</div>
			</a>
		<?php
		$i++;
			}
		?>
</body>
</html>
