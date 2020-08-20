<?php
	
	$new = file_get_contents('https://api.themoviedb.org/3/movie/top_rated?api_key=da25399c7ab7bcee46c4a0bfda74d227&language=es-ES&page=1');
	$new = json_decode($new,true)["results"];

	$popular = file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key=da25399c7ab7bcee46c4a0bfda74d227&language=es-ES&page=1');
	$popular = json_decode($popular,true)["results"];

	$upcoming = file_get_contents('https://api.themoviedb.org/3/movie/upcoming?api_key=da25399c7ab7bcee46c4a0bfda74d227&language=es-ES&page=1');
	$upcoming = json_decode($upcoming,true)["results"];

	//print_r($new[0]);
	//exit;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ranked Movies</title>
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
					<li><a>Generos</a>
						<ul>
							<?php 
								require 'genre_list.php';
							?>	
						</ul>
					</li>
					<li><a>años</a>
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

					<li><a href="popular/1">Mas Populares</a></li>

					<li><a href="admin.php">Reportes</a></li>

					
				</ul>
			</nav>
			<form class="search" action="search.php">
				<input type="text" name="query" class="searchfield" placeholder="Search...">
				<input type="submit" value="" class="searchsubmit">
			</form>


			<div class="toggle"><img src="img/menu.svg"></div>
		</header>




		<!-- Swiper -->
		<div class="homeslider">
			<div class="swiper-container">

				<div class="swiper-wrapper">
					<?php
					$i=0;
					foreach ($upcoming as $movie ) {
						if($i++ >3)break;
						echo '<div class="swiper-slide">
						<img src="https://image.tmdb.org/t/p/w780'.$movie['backdrop_path'].'">
						<div class="caption">
							<div class="captioninside">
								<h3>'.$movie['title'].'</h3>
								<p>'.$movie['overview'].'</p>
								<a href="Movie/'.$movie['id'].'" class="playbutton">Play</a>
							</div>
						</div>
					</div>';
						
					}


					?>


				</div>



				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
			</div>
		</div>

		<main class="content">
			<section class="panel">
				<h2> Nuevos extrenos</h2>
				<div class="recentslider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							
						<?php
								foreach ($upcoming as $movies ) {
									echo '<div class="swiper-slide"><a href="Movie/'.$movies['id'].'"><img src="https://image.tmdb.org/t/p/w185'.$movies['poster_path'].'"><h3 class="hometitle">'.$movies['title'].'</h3></a></div>';
								}
						?>

							
						</div>
						<div class="nextdirection recent-next"><img src="img/right-arrow.svg"> </div>
						<div class="leftdirection recent-prev"><img src="img/left-arrow.svg"> </div>
					</div>
				</div>
			</section>

			<section class="panel">
				<h2>Las más populares</h2>
				<div class="mostslider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
						
						<?php
								foreach ($popular as $movies ) {
									echo '<div class="swiper-slide"><a href="Movie/'.$movies['id'].'"><img src="https://image.tmdb.org/t/p/w185'.$movies['poster_path'].'"><h3 class="hometitle">'.$movies['title'].'</h3></a></div>';
								}
						?>

							<div class="swiper-slide"><a href="popular/2"><img src="img/others.png"></a></div>
						</div>
						<div class="nextdirection most-next"><img src="img/right-arrow.svg"> </div>
						<div class="leftdirection most-prev"><img src="img/left-arrow.svg"> </div>
						<!-- Add Pagination -->
					</div>
				</div>
			</section>

			<section class="panel">
				<h2>Películas más valoradas</h2>
				<div class="topslider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php
								foreach ($new as $movies ) {
									echo '<div class="swiper-slide"><a href="Movie/'.$movies['id'].'"><img src="https://image.tmdb.org/t/p/w185'.$movies['poster_path'].'"><h3 class="hometitle">'.$movies['title'].'</h3></a></div>';
								}
							?>

							
						</div>
						<div class="nextdirection top-next"><img src="img/right-arrow.svg"> </div>
						<div class="leftdirection top-prev"><img src="img/left-arrow.svg"> </div>
						<!-- Add Pagination -->
					</div>
				</div>
			</section>

			
		</main>

		<footer class="footer">
			<div class="copyright"><p>Todos los Derechos Reservados por RankedMovies</p></div>
			<div class="footermenu">
				<ul>
					<li><a href="index.php">Home</a></li>
					
				</ul>
			</div>
			<div class="tags">
				<ul>
					<li>Mejores Películas</li>
					<li>Películas Gratis</li>
					<li>Películas Sin Anuncios</li>

				</ul>
			</div>

		</footer>

		<!-- Swiper JS -->
		<script src="js/swiper.min.js"></script>

		<!-- Initialize Swiper -->
		<script>
			$(document).ready(function(){


				var swiper = new Swiper('.homeslider > .swiper-container', {
					pagination: '.swiper-pagination',
					paginationClickable: true,
					preventClicks:false,
					preventClicksPropagation:false,
					effect:'fade',
					breakpoints: {
						320: {
							height:200
						},

						480: {
							height:300
						},

						768: {
							height:400
						},
						1024: {
							height:500
						}
					}
				});

				var recentswiper = new Swiper('.recentslider > .swiper-container', {
					nextButton: '.recent-next',
					prevButton: '.recent-prev',
					slidesPerView: 8,
					paginationClickable: true,
					preventClicks:false,
					preventClicksPropagation:false,
					spaceBetween: 10,
					breakpoints: {
						320: {
							slidesPerView: 3,
							spaceBetween: 5
						},

						480: {
							slidesPerView: 3,
							spaceBetween: 5
						},

						768: {
							slidesPerView: 5,
							spaceBetween: 5
						},
						1024: {
							slidesPerView: 6,
							spaceBetween: 10
						}
					}
				});

				var mostswiper = new Swiper('.mostslider > .swiper-container', {
					nextButton: '.most-next',
					prevButton: '.most-prev',
					slidesPerView: 8,
					paginationClickable: true,
					preventClicks:false,
					preventClicksPropagation:false,
					spaceBetween: 10,
					breakpoints: {
						320: {
							slidesPerView: 3,
							spaceBetween: 5
						},

						480: {
							slidesPerView: 3,
							spaceBetween: 5
						},

						768: {
							slidesPerView: 5,
							spaceBetween: 5
						},
						1024: {
							slidesPerView: 6,
							spaceBetween: 10
						}
					}
				});

				var topswiper = new Swiper('.topslider > .swiper-container', {
					nextButton: '.top-next',
					prevButton: '.top-prev',
					slidesPerView: 8,
					paginationClickable: true,
					preventClicks:false,
					preventClicksPropagation:false,
					spaceBetween: 10,
					breakpoints: {
						320: {
							slidesPerView: 3,
							spaceBetween: 5
						},

						480: {
							slidesPerView: 3,
							spaceBetween: 5
						},

						768: {
							slidesPerView: 5,
							spaceBetween: 5
						},
						1024: {
							slidesPerView: 6,
							spaceBetween: 10
						}
					}
				});

			});

			
		</script>


	</div>


	


</body>
</html>