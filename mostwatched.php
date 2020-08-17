<!-- <pre>     -->
<?php

	$movies = file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key=5b812339ff5a7fd950dc41d20c6754c8&language=es-ES&page='.$_GET['page']);
	$movies = json_decode($movies,true)["results"];
	//print_r($movies);
	//exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mas populares</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="../css/swiper.min.css">
	<link rel="stylesheet" href="../css/styles.css">

	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/script.js"></script>


	<!-- Demo styles -->
	<style>



	</style>
</head>
<body>
	<div class="wrapper">

		<header class="header">
			<figure class="logo"><a href="../index.php"><img src="../img/logo.png" alt="Logo"></figure></a>
			<nav class="menu">
				<ul>
					<li><a href="../index.php">Home</a></li>
					<li><a>Generos</a>
						<ul>
						<?php 
								require 'genre_list2.php';
							?>
						</ul>
					</li>
					<li><a>Años</a>
						<ul>
							<li><a href="../year/2020/1">2020</a></li>
							<li><a href="../year/2019/1">2019</a></li>
							<li><a href="../year/2018/1">2018</a></li>
							<li><a href="../year/2017/1">2017</a></li>
							<li><a href="../year/2016/1">2016</a></li>
							<li><a href="../year/2015/1">2015</a></li>
							<li><a href="../year/2014/1">2014</a></li>
						</ul>
					</li>
					
					<li><a href="../popular/1">Mas Populares</a></li>

					<li><a href="../cerrar.php">Cerrar sesion</a></li>

					<li class="mobsearch">
						<form class="mobform" action='search.php'>
							<input type="text" name="query" class="mobsearchfield" placeholder="Search...">
							<input type="submit" value="" class="mobsearchsubmit">
						</form>
					</li>
				</ul>
			</nav>
			<form class="search" action="../search.php">
				<input type="text" name="query" class="searchfield" placeholder="Search...">
				<input type="submit" value="" class="searchsubmit">
			</form>

			<div class="toggle"><img src="../img/menu.svg"></div>
		</header>
		
		<main class="content">
			<section class="centered">
				<h3>Mas populares</h3>
				<div class="movies">
					
					<?php
						foreach($movies as $movie){
							if(!empty($movie['poster_path'])){
								echo '<div class="mov">
							<a href="../Movie/'.$movie['id'].'">
								<img src="https://image.tmdb.org/t/p/w185'.$movie['poster_path'].'">
								<h2 class="movietitle">'.$movie['title'].'</h2>
							</a>
						</div>';
							}
						}
					?>


				</div>
				<nav class="pagination">
					<ul>
						<?php
							if($_GET['page']>1){
								?>
								<li><a href="./<?=$_GET['page']-1?>">Prev</a></li>
								<?php
							}
						?>
						<li><a href="#" class="menuactive"><?=$_GET['page']?></a></li>
						<li><a href="./<?=$_GET['page']+1?>"><?=$_GET['page']+1?></a></li>
						<li><a href="./<?=$_GET['page']+2?>"><?=$_GET['page']+2?></a></li>
						<li><a href="#">...</a></li>
						<?php
							if($_GET['page']+19 < 1000){
							?>
							<li><a href="./<?=$_GET['page']+19?>"><?=$_GET['page']+19?></a></li>
							<?php
							}
						?>

						<?php
							if($_GET['page']+20 < 1000){
							?>
							<li><a href="./<?=$_GET['page']+20?>"><?=$_GET['page']+20?></a></li>
							<?php
							}
						?>

						<?php
							if($_GET['page'] < 1000){
								echo '<li><a href="./'.($_GET['page']+1).'">Next</a></li>';
							}
						?>
						
					</ul>
				</nav>
			</section>

		</main>

		<footer class="footer">
			<div class="copyright"><p>Copyright</p></div>
			<div class="footermenu">
				<ul>
					<li><a href="../index.php">Home</a></li>

				</ul>
			</div>
			<div class="tags">
				<ul>
					<li>Las Mejores Peliculas</li>
					<li>Peliculas Gratis</li>
					<li>Sin anuncios</li>

				</ul>
			</div>

		</footer>

		
	</div>
</body>
</html>