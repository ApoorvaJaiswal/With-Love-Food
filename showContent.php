<!doctype html>
<?php session_start();?>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="showContent.css"/>
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
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
</body>
</html>