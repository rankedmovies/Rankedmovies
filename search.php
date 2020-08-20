<?php
	if(!isset($_GET['page'])){
		$_GET['page'] = 1;
	}

	$movies = @file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=da25399c7ab7bcee46c4a0bfda74d227&language=es-ES&query='.$_GET['query'].'&page='.$_GET['page']);

	if(empty($movies)){
		$movies = '';

	}else{
		$movies = json_decode($movies, true)['results'];
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Buscando a <?=urldecode($_GET['query'])?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="css/swiper.min.css">
	<link rel="stylesheet" href="css/styles.css">

	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/script.js"></script>


	<!-- Demo styles -->
	<style>



	</style>
</head>
<body>
	<div class="wrapper">

		<header class="header">
			<figure class="logo"><a href="index.php"><img src="img/logo.png" alt="Logo"></figure></a>
			<nav class="menu">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a>Genres</a>
						<ul>
							<?php
								require 'genre_list.php';
							?>

						</ul>
					</li>
					<li><a>Year</a>
						<ul>
							<li><a href="year/2020/1">2020</a></li>
							<li><a href="year/2019/1">2019</a></li>
							<li><a href="year/2018/1">2018</a></li>
							<li><a href="year/2017/1">2017</a></li>
							<li><a href="year/2016/1">2016</a></li>
							<li><a href="year/2015/1">2015</a></li>
							<li><a href="year/2014/1">2014</a></li>
						</ul>
					</li>
					

					<li class="mobsearch">
						<form class="mobform" action="search.php">
							<input type="text" name="query" class="mobsearchfield" placeholder="Search...">
							<input type="submit" value="" class="mobsearchsubmit">
						</form>
					</li>

					<li><a href="popular/1">Mas populares</a></li>

					<li><a href="cerrar.php">Cerrar sesion</a></li>

				</ul>
			</nav>
			<form class="search" action="search.php">
				<input type="text" name="query" class="searchfield" placeholder="Search...">
				<input type="submit" value="" class="searchsubmit">
			</form>

			<div class="toggle"><img src="img/menu.svg"></div>
		</header>
		
		<main class="content">
			<section class="centered">
				<h3>Resultados para <?=urldecode($_GET['query'])?></h3>
				<div class="movies">
					
					<?php
						if(!empty($movies)){
							foreach($movies as $movie){
								if(!empty($movie['poster_path'])){
									echo '<div class="mov">
									<a href="Movie/'.$movie['id'].'">
										<img src="https://image.tmdb.org/t/p/w185'.$movie['poster_path'].'">
										<h2 class="movietitle">'.$movie['title'].'</h2>
									</a>
								</div>';
								}
	
							}
							}else{
								echo '<h3>No hay resultados disponibles</h3>';
						}
					?>


				</div>
				<nav class="pagination">
					<ul>
						<?php
							if($_GET['page'] > 1){
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