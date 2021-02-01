<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php 
error_reporting(0);
 ?>
<style type="text/css">
	*{
		font-family: 'Source Sans Pro', sans-serif;
	}
	h1{
		margin-bottom: 30px;
		margin-top: 30px;
	}
	.container {
	    margin: auto;
	    max-width: 800px;
	    width: 100%;
	    padding: 10px;
	}
	input{
		width: 100%;
		margin-bottom: 20px;
		height: 50px;
		padding: 10px;
		font-size: 1.2em;
	}
	input[type="submit"] {
	    font-size: 2em;
	    cursor: pointer;
	    width: 300px;
	    display: block;
	    height: auto;
    line-height: 1;
	}
	label{
		margin-bottom: 5px;
		display: block;
	}
	ul {
	    background: #f7f5f5;
	    padding: 40px;
	    font-size: 1.3em;
	}
	p.title {
	    color: #0095ce;
	    font-weight: 700;
	}
	.src{

	}
</style>
<div class="main">
	<div class="container">
			<h1>IMAGE DOWNLOADER</h1>

<?php if (isset($_POST['url']) && !empty($_POST['url'])): ?>
	<?php 
		require_once('dow.php');
		ImgDownloader::onLoad($_POST['url']);
	?>
<?php else: ?>
			
			<div class="formular">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				  <label for="url">write Whole domain address</label><br>
				  <input type="text" id="url" name="url" value=""><br>
				  <input type="submit" value="Submit">
				</form> 
			</div>
<?php endif ?>
	</div>
</div>

</body>
</html>