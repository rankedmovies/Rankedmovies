<!-- <pre> -->
<?php
	
	$movie = file_get_contents('https://api.themoviedb.org/3/movie/'.$_GET['id'].'?api_key=5b812339ff5a7fd950dc41d20c6754c8&language=es-ES&append_to_response=videos');
	$movie = json_decode($movie,true);

	$reco = file_get_contents('https://api.themoviedb.org/3/movie/'.$_GET['id'].'/recommendations?api_key=5b812339ff5a7fd950dc41d20c6754c8&language=es-ES&page=1');
	$reco = json_decode($reco,true)['results'];
	
	
	
	$trailer = true;
	if(isset($movie['videos']['results']) && !empty($movie['videos']['results'])){
		$video = $movie['videos']['results'][0];
	}else{
		$video = false;
	}
	if($video !== false){
		$key = $video['key'];
		if($video['site'] == 'YouTube'){
			$video = 'https://www.youtube.com/embed/';
		}else{
			$video = 'https://vimeo.com/embed/';
		}
		$video = $video.$key;
		
	}else{
		$trailer = false;
		$video = 'http://vidsrc.me/embed/'.$movie['imdb_id'].'/';
	}
	
	//print_r($movie);
	//exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title><?=$movie['title']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="../css/swiper.min.css">
	<link rel="stylesheet" href="../css/styles.css">

	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/script.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			var trailer = '<?=$video?>';
			$('#trailer').attr('src', trailer);
		});
		</script>
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
						<li><a href="../popular/1">Mas Populares</a></li>

					<li><a href="../cerrar.php">Cerrar sesion</a></li>
				
				</ul>

				<li class="mobsearch">
						<form class="mobform" action="search.php">
							<input type="text" name="query" class="mobsearchfield" placeholder="Search...">
							<input type="submit" value="" class="mobsearchsubmit">
						</form>
					</li>

					<form class="search" action="../search.php">
				<input type="text" name="query" class="searchfield" placeholder="Buscar...">
				<input type="submit" value="" class="searchsubmit">
			</form>

			

			</nav>

			<div class="toggle"><img src="../img/menu.svg"></div>
		</header>

		<main class="content">
			<div class="single">

				<section class="trailer">
					<h3><?=(!$trailer)?'Ver Online':'Trailer'?></h3>
					<div class="trailer_frame">
						<iframe id="trailer" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
					</div>
				</section>

				<section class="movie">
					<img src="https://image.tmdb.org/t/p/w185<?=$movie['poster_path']?>">
					<ul>
						<li><?=$movie['title']?></li>
						<li><?=$movie['overview']?></li>
						<li>
							<?php
								$i=0;
								foreach ($movie['genres'] as $genre){
									if($i++ > 0) echo ', ';
									echo '<a href="../genre/'.$genre['id'].'/1">'.$genre['name'].'</a>';
								}
							?>
						</li>
							
							<li>
								Fecha de salida: <?=$movie['release_date']?>
							</li>

						<?php
						
							foreach ($movie['production_companies'] as $comp) {								
								echo '<li>Dirigida por: '.$comp['name'].'</li>';
							}
						?>
					</ul>
				</section>
				<section class="links">
					<h3>Links</h3>
					<ul class="wlinks">
						<li><a>Watch</a></li>
						<li><a class="btn" href="#link1">Link1</a></li>
						<li><a class="btn" href="#link2">Link2</a></li>
						<script type="text/javascript">
							$(document).ready(function(){;
								$('#link1').attr('src','http://vidsrc.me/embed/<?=$movie['imdb_id']?>/');
								$('#link2').attr('src','http://vidsrc.me/embed/<?=$movie['imdb_id']?>/');
							});
							var func = function(){
								if(window.location.hash =='#link1'|| (window.location.hash == '' && <?=(!empty($movie['video']))?'true':'false'?>)){
									$('#link1').attr('style','display:block');
									$('#link2').attr('style','display:none');
								}else if(window.location.hash =='#link2'|| (window.location.hash == '' && <?=(empty($movie['video']))?'true':'false'?>)){
									$('#link2').attr('style','display:block');
									$('#link1').attr('style','display:none');
								}
							};
							$(document).ready(func);
							$('.btn').click(func)
						</script><br>
						<iframe id="link1"style="display: none" width="100%" height="400" src="" frameborder="0" allowfullscreen></iframe>
						<iframe id="link2"style="display: none" width="100%" height="400" src="" frameborder="0" allowfullscreen></iframe>
						
					</ul>
				</section>

				<section class="related">
					<h3>Related movies</h3>
					<?php
					$i=0;
						foreach($reco as $movie){
							if($i++ >=6)break;
							if(!empty($movie['poster_path'])){
								echo '<div class="relatemovie">
						<a href="'.$movie['id'].'"><img src="https://image.tmdb.org/t/p/w185'.$movie['poster_path'].'"></a>
						<a href="'.$movie['id'].'"><span class="relatedname">'.$movie['title'].'</span></a>
						</div>';
					}else{
						$i--;
					}
				}
					?>

				</section>


			</div>
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