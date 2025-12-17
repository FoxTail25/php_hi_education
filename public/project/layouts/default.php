<!DOCTYPE html>
<html>
	<head>
		<html lang="ru">
		<meta charset="utf-8">
		<link rel="stylesheet" href="/project/webroot/style.css"/>
		<title><?= $title ?></title>
	<body>
		<header>
			хедер сайта
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