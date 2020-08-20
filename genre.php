<?php

	$movies = file_get_contents('https://api.themoviedb.org/3/discover/movie?api_key=da25399c7ab7bcee46c4a0bfda74d227&language=es-ES&sort_by=primary_release_date.desc&with_genres='.$_GET['genre'].'&page='.$_GET['page']);
	$movies = json_decode($movies, true)['results'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Peliculas por g&eacute;nero</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="../../css/swiper.min.css">
	<link rel="stylesheet" href="../../css/styles.css">

	<script src="../../js/jquery-3.1.1.min.js"></script>
	<script src="../../js/script.js"></script>



</head>
<body>
	<div class="wrapper">

		<header class="header">
			<figure class="logo"><a href="../../index.php"><img src="../../img/logo.png" alt="Logo"></figure></a>
			<nav class="menu">
				<ul>
					<li><a href="../../index.php">Home</a></li>
					<li><a>Generos</a>
						<ul>
						<?php
							require 'genre_list3.php';
							
						?>
				
						</ul>
					</li>
					<li><a>Años</a>
						<ul>
							<li><a href="../../year/2020/1">2020</a></li>
							<li><a href="../../year/2019/1">2019</a></li>
							<li><a href="../../year/2018/1">2018</a></li>
							<li><a href="../../year/2017/1">2017</a></li>
							<li><a href="../../year/2016/1">2016</a></li>
							<li><a href="../../year/2015/1">2015</a></li>
							<li><a href="../../year/2014/1">2014</a></li>
						</ul>
					</li>
					<li><a href="admin.php">Reportes</a></li>

					
					<li class="mobsearch">
						<form class="mobform" action="search.php">
							<input type="text" name="query" class="mobsearchfield" placeholder="Buscar...">
							<input type="submit" value="" class="mobsearchsubmit">
						</form>
					</li>
					
				</ul>
				
			</nav>
			<form class="search" action="../../search.php">
				<input type="text" name="query" class="searchfield" placeholder="Buscar...">
				<input type="submit" value="" class="searchsubmit">
			</form>

			<div class="toggle"><img src="../../img/menu.svg"></div>
		</header>
		
		<main class="content">
			<section class="centered">
				<h3>Peliculas de <?php
					$genre = json_decode('{"28":"Acci\u00f3n","12":"Aventura","16":"Animaci\u00f3n","35":"Comedia","80":"Crimen","99":"Documental","18":"Drama","10751":"Familia","14":"Fantas\u00eda","36":"Historia","27":"Terror","10402":"M\u00fasica","9648":"Misterio","10749":"Romance","878":"Ciencia ficci\u00f3n","10770":"Pel\u00edcula de TV","53":"Suspense","10752":"B\u00e9lica","37":"Western"}
					', true);
					echo $genre[$_GET['genre']];
				?></h3>
				<div class="movies">
					
					<?php
						foreach($movies as $movie){
							if(!empty($movie['poster_path'])){
								echo '<div class="mov">
							<a href="../../Movie/'.$movie['id'].'">
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
					<li><a href="../../index.php">Home</a></li>

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