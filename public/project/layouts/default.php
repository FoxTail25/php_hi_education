<!DOCTYPE html>
<html>
	<head>
		<html lang="ru">
		<meta charset="utf-8">
		<link rel="stylesheet" href="/project/webroot/style_default.css"/>
		<title><?= $title ?></title>
	<body>
		<header>
			<h2>
				Конспект по изучению PHP
			</h2>
		</header>
		<div class="container">
			<aside class="sidebar left">
				левый сайдбар
			</aside>
			<main>
				<?= $content ?>
			</main>
			<aside class="sidebar right">
				правый сайдбар
			</aside>
		</div>
		<footer>
			футер сайта
		</footer>
	</body>
</html>