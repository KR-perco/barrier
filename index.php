<?php

include 'secret.php';

console_log("git integreted"); 

if ($_POST['form'] == 'feedback') {
	if($request = curl_init()) {
		curl_setopt($request, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_POST, true);
		curl_setopt($request, CURLOPT_POSTFIELDS, 'secret='.$secretkey.'&response=' . $_POST['g-recaptcha-response']);
		$response = curl_exec($request);
		curl_close($request);
		$responseDecoded = json_decode($response);
		if (!$responseDecoded->success) {
			echo 1;
			exit;
		}
		$headers = 'Content-type: text/html; charset=utf-8 \r\nFrom: ' . htmlspecialchars($_POST['email']);
		$message = 'Дата заполнения: ' . date('d-m-Y H:i:s') . '<br>IP пользователя: '. $_SERVER['REMOTE_ADDR'] . '<br>________________________________<br><br>Имя пользователя:<br>' . $_POST['name'] . '<br><br>E-mail:<br>' . htmlspecialchars($_POST['email']) . '<br><br>Номер телефона:<br>' . htmlspecialchars($_POST['number']) . '<br><br>Сообщение:<br>' . htmlspecialchars($_POST['message']) . '<br><br>' . '________________________________<br>Письмо сгенерировано автоматически.';
		mail('gerasimov@perco.ru', 'Заполнена форма обратной связи на сайте barrier.perco.ru', $message, $headers);
		mail('romanova@perco.ru', 'Заполнена форма обратной связи на сайте barrier.perco.ru', $message, $headers);
		// mail('klimov@perco.ru', 'Заполнена форма обратной связи на сайте barrier.perco.ru', $message, $headers);
		$params = array(
			'pw' => $secretpw,
			'name' => htmlspecialchars($_POST['name']),
			'email' => htmlspecialchars($_POST['email']),
			'number' => htmlspecialchars($_POST['number']),
			'message' => htmlspecialchars($_POST['message'])
		);
		$url = 'https://perco.ru/php/barrier-form.php?' . http_build_query($params);
		$context = stream_context_create(array(
			'http' => array(
				'method'  => 'GET',
			)
		));
		file_get_contents($url, false, $context);
		echo 0;
	} else {
		echo 1;
	}
	exit;
}
/*if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Доступ запрещён.';
	exit;
} else {
	if ($_SERVER['PHP_AUTH_PW'] != '1') {
		header('WWW-Authenticate: Basic realm="My Realm"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Неверный пароль.';
		exit;
	}
}*/

$modifiedTimeUnix = 1612950788;
$modifiedTime = gmdate("D, d M Y H:i:s \G\M\T", $modifiedTimeUnix);
$ifModifiedSince = false;
if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
    $ifModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5)); 
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
    $ifModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
if ($ifModifiedSince && $ifModifiedSince >= $modifiedTimeUnix) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
    exit;
}
header('Last-Modified: '. $modifiedTime);

//header('Content-Security-Policy: default-src \'self\' ');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Strict-Transport-Security: max-age=86400; includeSubDomains');
header('X-Content-Type-Options: nosniff');

include 'db/prices.php';
?>
<!doctype html>
<html lang="ru" dir="ltr">
	<head>
		<title>Автоматический шлагбаум PERCo GS04</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=0.1, maximum-scale=3">
		<meta name="robots" content="all">
		<meta name="description" content="Управление шлагбаумом от СКУД, по звонку или через мобильное приложение. Встроенная система обогрева механизма управления шлагбаума. Двигатель с планетарным редуктором. Защита механизма шлагбаума при наезде. Круглая, прямоугольная и складная стрелы. Гарантия на шлагбаум- 5 лет.">
		<meta name="keywords" content="шлагбаум купить, установка шлагбаума, шлагбаум автоматический, шлагбаум цена, шлагбаум без пульта, шлагбаум по звонку, автоматические шлагбаумы">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta property="og:title" content="Автоматический шлагбаум PERCo GS04">
		<meta property="og:site_name" content="Автоматический шлагбаум PERCo GS04">
		<meta property="og:description" content="Управление шлагбаумом от СКУД, по звонку или через мобильное приложение. Встроенная система обогрева механизма управления шлагбаума. Двигатель с планетарным редуктором. Защита механизма шлагбаума при наезде. Круглая, прямоугольная и складная стрелы. Гарантия на шлагбаум- 5 лет.">
		<meta property="og:url" content="https://barrier.perco.ru">
		<meta property="og:type" content="website">
		<meta property="og:image" content="https://barrier.perco.ru/img/preview.jpg">
		<meta property="og:image:width" content="1920">
		<meta property="og:image:height" content="1080">
		<link href="css/main.css" rel="stylesheet">
		<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link href="https://barrier.perco.ru" rel="canonical">
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Organization",
				"url": "https://barrier.perco.ru",
				"logo": "https://barrier.perco.ru/img/logo.svg"
			}
		</script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-3BEWE9JY01"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-3BEWE9JY01');
			gtag('config', 'UA-662209-26');
		</script>
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
			(function (d, w, c) {
				(w[c] = w[c] || []).push(function() {
					try {
						w.yaCounter68864038 = new Ya.Metrika({
							id:68864038,
							clickmap:true,
							trackLinks:true,
							accurateTrackBounce:true,
							webvisor:true
						});
					} catch(e) { }
				});

				var n = d.getElementsByTagName("script")[0],
					s = d.createElement("script"),
					f = function () { n.parentNode.insertBefore(s, n); };
				s.type = "text/javascript";
				s.async = true;
				s.src = "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/watch.js";

				if (w.opera == "[object Opera]") {
					d.addEventListener("DOMContentLoaded", f, false);
				} else { f(); }
			})(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/68864038" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
		<script>
			const square3Price =  '<?= $square3Price; ?>';
			const square43Price =  '<?= $square43Price; ?>';
			const round3Price =  '<?= $round3Price; ?>';
			const round43Price =  '<?= $round43Price; ?>';
			
			const square3PriceRubles =  '<?= $square3PriceRubles; ?>';
			const square43PriceRubles =  '<?= $square43PriceRubles; ?>';
			const round3PriceRubles =  '<?= $round3PriceRubles; ?>';
			const round43PriceRubles =  '<?= $round43PriceRubles; ?>';
		</script>
		<script src="js/main.js" async defer></script>
	</head>
	<body>
		<div class="preloader">
			<picture>
				<source srcset="img/preloader-3840.webp" media="(min-width: 992px)">
				<img class="preloader__img" src="img/preloader-720.webp" alt="Загрузка" loading="eager">
			</picture>
			<div class="preloader__margin"></div>
		</div>
		<header class="header">
			<button class="logo" aria-label="О компании" data-target=".about-block" data-offset="-16"  data-offset340="-40" data-offset992="-72">
				<img class="logo__img" src="img/logo.svg" alt="Логотип" loading="eager" draggable="false">
			</button>
			<h1 class="title">Шлагбаум PERCo-GS04</h1>
			<div class="header__main-btns">
				<button class="main-btn main-btn_home" aria-label="Домой" data-target=".video-block" data-offset="0">
					<img class="main-btn__img" src="img/home.svg" alt="Домой" loading="eager" draggable="false">
				</button>
				<button class="main-btn main-btn_boom_barrier" aria-label="Шлагбаум" data-target=".model-block" data-offset="0">
					<img class="main-btn__img" src="img/boom-barrier.svg" alt="Шлагбаум" loading="eager" draggable="false">
				</button>
				<button class="main-btn main-btn_menu" aria-label="Меню" data-target=".menu-block" data-offset="0" data-offset340="-32" data-offset992="-100" data-offset1200="-64"  data-offset1460="0">
					<img class="main-btn__img main-btn__img_menu" src="img/menu.svg" alt="Меню" loading="eager" draggable="false">
				</button>
			</div>
			<div class="header__dop-btns">
				<button class="dop-btn dop-btn_video" aria-label="Видео про шлагбаум">
					<img class="dop-btn__img" src="img/video.svg" alt="Видео Шлагбаум" loading="eager" draggable="false">
				</button>
				<button class="dop-btn dop-btn_mail" aria-label="Обратная связь" data-target=".feedback-block" data-offset="0" data-offset340="-32" data-offset992="-64" data-offset1200="-48">
					<img class="dop-btn__img" src="img/mail.svg" alt="Обратная связь" loading="eager" draggable="false">
				</button>
			</div>
			<div class="header__border"></div>
			<div class="header__background"></div>
		</header>
		<main class="main">
			<section class="video-block">
				<div class="text-block">
					<h1 class="text-block__title container">Шлагбаум PERCo-GS04</h1>
					<div class="text-block__text container">Решение для эксплуатации<br>в российских условиях</div>
					<div class="text-block__imgs">
						<img class="text-block__img" src="img/warranty.svg" alt="5 лет гарантии" loading="eager" draggable="false">
						<img class="text-block__img" src="img/made-in-russia.svg" alt="Сделано в России" loading="eager" draggable="false">
						<img class="text-block__img" src="img/built-in-heating-system.svg" alt="Встроенная система обогрева" loading="eager" draggable="false">
					</div>
				</div>
				<div class="big-text-block">
					<div class="big-text-block__imgs">
						<img class="big-text-block__img" src="img/warranty.svg" alt="5 лет гарантии" loading="eager" draggable="false">
						<img class="big-text-block__img" src="img/made-in-russia.svg" alt="Сделано в России" loading="eager" draggable="false">
						<img class="big-text-block__img" src="img/built-in-heating-system.svg" alt="Встроенная система обогрева" loading="eager" draggable="false">
					</div>
					<div class="big-text-block__text">Решение для эксплуатации<br>в российских условиях</div>
				</div>
				<video class="video-block__video video-block__video_720" autoplay muted loop playsinline poster="img/preloader-720.webp">
					<source src="video/background-720.webm" type="video/webm">
					<source src="video/background-720.mp4" type="video/mp4">
					<source src="video/background-1080.mp4" type="video/mp4">
					<source src="video/background-768.mp4" type="video/mp4">
				</video>
				<video class="video-block__video video-block__video_1920" autoplay muted loop playsinline poster="img/preloader-3840.webp">
					<source src="video/background-3840.mp4" type="video/mp4">
					<source src="video/background-3840.webm" type="video/webm">
					<source src="video/background-1112.mp4" type="video/mp4">
				</video>
				<?/*<img class="iphone-background" src="img/preloader-1080.jpg">*/?>
			</section>
			<section class="model-block" id="3d" style="position: relative;">
				<div class="scene">
					<div class="arrows-animation scene__animation scene__animation_active">
						<img class="arrows-animation__img" src="img/housing.webp" alt="Тумба шлагбаума" loading="lazy" draggable="false">
						<img class="arrows-animation__img arrows-animation__img_arrow arrows-animation__img_arrow-square-3" src="img/arrow-square-3m.webp" alt="Стрела шлагбаума прямоугольного сечения 3 метра" loading="lazy" draggable="false">
						<img class="arrows-animation__img arrows-animation__img_arrow arrows-animation__img_arrow-square-43" src="img/arrow-square-4,3m.webp" alt="Стрела шлагбаума прямоугольного сечения 4,3 метра" loading="lazy" draggable="false">
						<img class="arrows-animation__img arrows-animation__img_arrow arrows-animation__img_arrow-round-43" src="img/arrow-round-4,3m.webp" alt="Стрела шлагбаума круглого сечения 4,3 метра" loading="lazy" draggable="false">
						<img class="arrows-animation__img arrows-animation__img_arrow arrows-animation__img_arrow-round-3" src="img/arrow-round-3m.webp" alt="Стрела шлагбаума круглого сечения 3 метра" loading="lazy" draggable="false">
						<div class="arrows-animation__text">
							<div class="arrows-animation__text-block arrows-animation__text-block_square-3">
								<div class="arrows-animation__title">Шлагбаум со стрелой прямоугольного сечения 3 метра</div>
								<div class="arrows-animation__price">Цена со склада в Москве и Санкт&#8209;Петербурге <span class="arrows-animation__price-value"><?= $square3Price; ?> €</span><br><span class="arrows-animation__price-value"><?= $square3PriceRubles; ?> ₽</span> (по ЦБ РФ на <?= date('d.m.y'); ?>)</div>
							</div>
							<div class="arrows-animation__text-block arrows-animation__text-block_square-43">
								<div class="arrows-animation__title">Шлагбаум со стрелой прямоугольного сечения 4,3 метра</div>
								<div class="arrows-animation__price">Цена со склада в Москве и Санкт&#8209;Петербурге <span class="arrows-animation__price-value"><?= $square43Price; ?> €</span><br><span class="arrows-animation__price-value"><?= $square43PriceRubles; ?> ₽</span> (по ЦБ РФ на <?= date('d.m.y'); ?>)</div>
							</div>
							<div class="arrows-animation__text-block arrows-animation__text-block_round-43">
								<div class="arrows-animation__title">Шлагбаум со стрелой круглого сечения 4,3 метра</div>
								<div class="arrows-animation__price">Цена со склада в Москве и Санкт&#8209;Петербурге <span class="arrows-animation__price-value"><?= $round43Price; ?> €</span><br><span class="arrows-animation__price-value"><?= $round43PriceRubles; ?> ₽</span> (по ЦБ РФ на <?= date('d.m.y'); ?>)</div>
							</div>
							<div class="arrows-animation__text-block arrows-animation__text-block_round-3">
								<div class="arrows-animation__title">Шлагбаум со стрелой круглого сечения 3 метра</div>
								<div class="arrows-animation__price">Цена со склада в Москве и Санкт&#8209;Петербурге <span class="arrows-animation__price-value"><?= $round3Price; ?> €</span><br><span class="arrows-animation__price-value"><?= $round3PriceRubles; ?> ₽</span> (по ЦБ РФ на <?= date('d.m.y'); ?>)</div>
							</div>
						</div>
						<div class="arrows-animation__big-text">
							<div class="arrows-animation__big-text-block">
								<h2 class="arrows-animation__title">Шлагбаум со стрелой <span class="arrows-animation__title-word arrows-animation__title-square">прямоугольного</span> <span class="arrows-animation__title-word arrows-animation__title-section">сечения</span> <span class="arrows-animation__title-word arrows-animation__title-3">3</span> <span class="arrows-animation__title-word arrows-animation__title-meters">метра</span><span class="arrows-animation__title-word arrows-animation__title-hidden-word arrows-animation__title-round">круглого</span><span class="arrows-animation__title-word arrows-animation__title-hidden-word arrows-animation__title-43">4,3</span></h2>
								<div class="arrows-animation__price">Цена со склада в Москве и Санкт&#8209;Петербурге <span class="arrows-animation__price-value"><span class="arrows-animation__price-value-number arrows-animation__price-value-number-current arrows-animation__price-value-number-euro"><?= $square3Price; ?> €</span></span><br><span class="arrows-animation__price-value"><span class="arrows-animation__price-value-number arrows-animation__price-value-number-current arrows-animation__price-value-number-ruble"><?= $square3PriceRubles; ?> ₽</span></span><span class="arrows-animation__price-date">(по ЦБ РФ на <?= date('d.m.y'); ?>)</span><span class="arrows-animation__price-value-number arrows-animation__price-value-number-new arrows-animation__price-value-number-euro"><?= $square43Price; ?> €</span><span class="arrows-animation__price-value-number arrows-animation__price-value-number-new arrows-animation__price-value-number-ruble"><?= $square43PriceRubles; ?> ₽</span></div>
							</div>
						</div>
					</div>
					<div class="scene__videos">
						<video class="scene__animation model-video model-video_folding-arrow" width="320" height="240" muted preload="none" playsinline></video>
						<video class="scene__animation model-video model-video_car-passage" width="320" height="240" muted preload="none" playsinline></video>
						<video class="scene__animation model-video model-video_control-board" width="320" height="240" muted preload="none" playsinline></video>
						<video class="scene__animation model-video model-video_unlocking" width="320" height="240" muted preload="none" playsinline></video>
					</div>
					<canvas class="scene__model" data-loaded="false"></canvas>
					<div class="scene__model-preloader">
						<div class="scene__model-preloader-window">
							<img class="scene__model-preloader-img" src="img/video-preloader.png" alt="Загрузка" loading="lazy" draggable="false">
							<div class="scene__model-preloader-text"></div>
						</div>
					</div>
				</div>
				<div class="scene-control">
					<div class="scene-control__left">
						<div class="scene-control__cell">
							<div class="scene-slide-btn scene-slide-btn_arrows scene-slide-btn_active" aria-label="Виды стрел">
								<img class="scene-slide-btn__img" src="img/arrows-slide-btn.png" alt="Виды стрел" loading="lazy" draggable="false">
								<div class="scene-slide-btn__overlay">
									<img class="scene-slide-btn__img-overlay" src="img/play-btn.svg" alt="Кнопка плей" loading="lazy" draggable="false">
								</div>
							</div>
							<div class="scene-slide-btn-text">виды<br>стрел</div>
						</div>
						<div class="scene-control__cell">
							<div class="scene-slide-btn scene-slide-btn_video" aria-label="Складная стрела">
								<img class="scene-slide-btn__img" src="img/folding-arrow-slide-btn.png" alt="Складная стрела" loading="lazy" draggable="false">
								<div class="scene-slide-btn__overlay">
									<img class="scene-slide-btn__img-overlay" src="img/play-btn.svg" alt="Кнопка плей" loading="lazy" draggable="false">
								</div>
							</div>
							<div class="scene-slide-btn-text">складная<br>стрела</div>
						</div>
						<div class="scene-control__cell">
							<div class="scene-slide-btn scene-slide-btn_video" aria-label="Проезд автомобиля">
								<img class="scene-slide-btn__img" src="img/car-passage-slide-btn.png" alt="Проезд автомобиля" loading="lazy" draggable="false">
								<div class="scene-slide-btn__overlay">
									<img class="scene-slide-btn__img-overlay" src="img/play-btn.svg" alt="Кнопка плей" loading="lazy" draggable="false">
								</div>
							</div>
							<div class="scene-slide-btn-text">проезд<br>автомобиля</div>
						</div>
						<div class="scene-control__cell">
							<div class="scene-slide-btn scene-slide-btn_video" aria-label="Плата управления">
								<img class="scene-slide-btn__img" src="img/control-board-btn.png" alt="Плата управления" loading="lazy" draggable="false">
								<div class="scene-slide-btn__overlay">
									<img class="scene-slide-btn__img-overlay" src="img/play-btn.svg" alt="Кнопка плей" loading="lazy" draggable="false">
								</div>
							</div>
							<div class="scene-slide-btn-text">плата<br>управления</div>
						</div>
						<div class="scene-control__cell">
							<div class="scene-slide-btn scene-slide-btn_video" aria-label="Механическая разблокировка">
								<img class="scene-slide-btn__img" src="img/mechanical-release-slide-btn.png" alt="Механическая разблокировка" loading="lazy" draggable="false">
								<div class="scene-slide-btn__overlay">
									<img class="scene-slide-btn__img-overlay" src="img/play-btn.svg" alt="Кнопка плей" loading="lazy" draggable="false">
								</div>
							</div>
							<div class="scene-slide-btn-text">механическая<br>разблокировка</div>
						</div>
					</div>
					<div class="scene-control__right">
						<button class="scene-big-btn" data-state="slides" aria-label="3D модель">
							<img class="scene-big-btn__img scene-big-btn__img_3d" src="img/3d.svg" alt="3D" loading="lazy" draggable="false">
							<img class="scene-big-btn__img scene-big-btn__img_close" src="img/close.svg" alt="Закрыть" loading="lazy" draggable="false">
							<div class="scene-big-btn__preloader">
								<img class="scene-big-btn__preloader-img" src="img/video-preloader.png" alt="Загрузка" loading="lazy" draggable="false">
								<div class="scene-big-btn__preloader-text"></div>
							</div>
						</button>
					</div>
				</div>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org/",
						"@type": "Product",
						"name": "Шлагбаум со стрелой прямоугольного сечения 3 метра",
						"brand": {
							"@type": "Brand",
							"name": "PERCo"
						},
						"manufacturer": {
							"@type": "Organization",
							"name": "PERCo",
							"logo": {
								"@type": "ImageObject",
								"url": "https://barrier.perco.ru/img/logo.svg"
							}
						},
						"offers": {
							"@type": "Offer",
							"url": "https://barrier.perco.ru/",
							"priceCurrency": "EUR",
							"price": "905",
							"availability": "https://schema.org/InStock"
						}
					}
				</script>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org/",
						"@type": "Product",
						"name": "Шлагбаум со стрелой прямоугольного сечения 4,3 метра",
						"brand": {
							"@type": "Brand",
							"name": "PERCo"
						},
						"manufacturer": {
							"@type": "Organization",
							"name": "PERCo",
							"logo": {
								"@type": "ImageObject",
								"url": "https://barrier.perco.ru/img/logo.svg"
							}
						},
						"offers": {
							"@type": "Offer",
							"url": "https://barrier.perco.ru/",
							"priceCurrency": "EUR",
							"price": "920",
							"availability": "https://schema.org/InStock"
						}
					}
				</script>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org/",
						"@type": "Product",
						"name": "Шлагбаум со стрелой круглого сечения 4,3 метра",
						"brand": {
							"@type": "Brand",
							"name": "PERCo"
						},
						"manufacturer": {
							"@type": "Organization",
							"name": "PERCo",
							"logo": {
								"@type": "ImageObject",
								"url": "https://barrier.perco.ru/img/logo.svg"
							}
						},
						"offers": {
							"@type": "Offer",
							"url": "https://barrier.perco.ru/",
							"priceCurrency": "EUR",
							"price": "886",
							"availability": "https://schema.org/InStock"
						}
					}
				</script>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org/",
						"@type": "Product",
						"name": "Шлагбаум со стрелой круглого сечения 3 метра",
						"brand": {
							"@type": "Brand",
							"name": "PERCo"
						},
						"manufacturer": {
							"@type": "Organization",
							"name": "PERCo",
							"logo": {
								"@type": "ImageObject",
								"url": "https://barrier.perco.ru/img/logo.svg"
							}
						},
						"offers": {
							"@type": "Offer",
							"url": "https://barrier.perco.ru/",
							"priceCurrency": "EUR",
							"price": "874",
							"availability": "https://schema.org/InStock"
						}
					}
				</script>
			</section>
			<section class="menu-block">
				<div class="menu-block__btns">
					<button class="menu-btn" aria-label="Комплект" data-target=".set-block" data-offset="0" data-offset340="-32" data-offset992="-64" data-offset1200="-48">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_set" src="img/set-btn.svg" alt="Комплект" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Комплект
						</div>
					</button>
					<button class="menu-btn" aria-label="Дополнительное оборудование" data-target=".optional-block" data-offset="0" data-offset340="-32" data-offset992="-64" data-offset1200="-48">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_optional-equipment" src="img/optional-equipment-btn.svg" alt="Дополнительное оборудование" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Дополнительное<br>оборудование
						</div>
					</button>
					<button class="menu-btn" aria-label="Управление" data-target=".control-block" data-offset="0" data-offset340="-32" data-offset992="-64" data-offset1200="-48">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_control" src="img/control-btn.svg" alt="Управление" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Управление
						</div>
					</button>
					<button class="menu-btn" aria-label="Особенности" data-target=".features-block" data-offset="0" data-offset340="-32" data-offset992="-64" data-offset1200="-48">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_features" src="img/features-btn.svg" alt="Особенности" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Особенности
						</div>
					</button>
					<button class="menu-btn" aria-label="Характеристики" data-target=".characteristics-block" data-offset="-45" data-offset340="-70"  data-offset576="-32" data-offset992="-64" data-offset1200="-48">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_characteristics" src="img/characteristics-btn.svg" alt="Характеристики" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Характеристики
						</div>
					</button>
					<button class="menu-btn" aria-label="Скачать" data-target=".download-block" data-offset="0" data-offset340="-32" data-offset992="-64" data-offset1200="-48">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_download" src="img/download-btn.svg" alt="Скачать" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Скачать
						</div>
					</button>
					<button class="menu-btn menu-btn_last" aria-label="Решения" data-target=".solutions-block" data-offset="-24" data-offset340="-48" data-offset992="-80">
						<div class="menu-btn__icon">
							<img class="menu-btn__img menu-btn__img_solutions" src="img/solutions-btn.svg" alt="Решения" loading="lazy" draggable="false">
						</div>
						<div class="menu-btn__text">
							Решения
						</div>
					</button>
				</div>
				<img class="menu-block__background" src="img/background-menu-3840.webp" alt="Шлагбаум PERCo-GS04" loading="lazy" draggable="false">
			</section>
			<section class="use-block">
				<h2 class="use-block__title container">Применение</h2>
				<div class="use-block__icons container">
					<div class="use-icon">
						<div class="use-icon__icon">
							<img class="use-icon__img use-icon__img_industials" src="img/industrial-enterprises.svg" alt="Промышленные предприятия" loading="lazy" draggable="false">
						</div>
						<div class="use-icon__text">
							Промышленные <br>предприятия
						</div>
					</div>
					<div class="use-icon">
						<div class="use-icon__icon">
							<img class="use-icon__img use-icon__img_shopping" src="img/shopping-centers.svg" alt="Торговые центры" loading="lazy" draggable="false">
						</div>
						<div class="use-icon__text">
							Торговые <br class="use-icon__br use-icon__br_shopping">центры
						</div>
					</div>
					<div class="use-icon">
						<div class="use-icon__icon">
							<img class="use-icon__img use-icon__img_residential" src="img/residential-complex.svg" alt="Жилые комплексы" loading="lazy" draggable="false">
						</div>
						<div class="use-icon__text">
							Жилые <br class="use-icon__br use-icon__br_residential">комплексы
						</div>
					</div>
					<div class="use-icon">
						<div class="use-icon__icon">
							<img class="use-icon__img use-icon__img_business-centers" src="img/business-centers.svg" alt="Бизнес-центры" loading="lazy" draggable="false">
						</div>
						<div class="use-icon__text">
							Бизнес-центры
						</div>
					</div>
					<div class="use-icon">
						<div class="use-icon__icon">
							<img class="use-icon__img use-icon__img_cottages" src="img/cottage-villages.svg" alt="Коттеджные поселки" loading="lazy" draggable="false">
						</div>
						<div class="use-icon__text">
							Коттеджные<br>поселки
						</div>
					</div>
					<div class="use-icon">
						<div class="use-icon__icon">
							<img class="use-icon__img use-icon__img_parking" src="img/parking.svg" alt="Автостоянки" loading="lazy" draggable="false">
						</div>
						<div class="use-icon__text">
							Автостоянки
						</div>
					</div>
				</div>
			</section>
			<section class="set-block">
				<h2 class="set-block__title container">Комплект</h2>
				<div class="set-block__photos container">
					<div class="set-block__photos-inner">
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/housing-set.png" alt="Тумба шлагбаума" title="Тумба шлагбаума" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Тумба шлагбаума
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/control-board-set.png" alt="Встроенный блок управления" title="Встроенный блок управления" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Встроенный блок управления
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/heating-mechanism-set.png" alt="Встроенная система обогрева" title="Встроенная система обогрева" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Встроенная система обогрева
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/photocell-set.png" alt="Встроенный фотоэлемент" title="Встроенный фотоэлемент" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Встроенный фотоэлемент
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/light-set.png" alt="Встроенная сигнальная индикация" title="Встроенная сигнальная индикация" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Встроенная сигнальная индикация
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/arrow-square-set.png" alt="Стрела шлагбаума прямоугольного или круглого сечения" title="Стрела шлагбаума" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Стрела прямоугольного или круглого сечения с системой крепления к тумбе
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/reflective-stickers-set.png" alt="Набор светоотражающих наклеек для стрелы шлагбаума" title="Набор светоотражающих наклеек" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Набор светоотражающих наклеек для стрелы
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/buffer-pad-set.png" alt="Буферные накладки для стрелы шлагбаума прямоугольного сечения" title="Буферные накладки" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Буферные накладки для стрелы прямоугольного сечения
							</div>
						</div>
						<div class="set-block-photo">
							<div class="set-block-photo__photo">
								<img class="set-block-photo__img" src="img/channel-bars-set.png" alt="Монтажные швеллеры" title="Монтажные швеллеры" loading="lazy">
							</div>
							<div class="set-block-photo__text">
								Монтажные швеллеры для установки шлагбаума на отверстия от предыдущего шлагбаума
							</div>
						</div>
					</div>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/housing-set.png",
							"name": "Тумба шлагбаума",
							"description": "Тумба шлагбаума",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/control-board-set.png",
							"name": "Встроенный блок управления",
							"description": "Встроенный блок управления",
							"datePublished": "2020-11-19"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/heating-mechanism-set.png",
							"name": "Встроенная система обогрева",
							"description": "Встроенная система обогрева",
							"datePublished": "2020-11-19"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/photocell-set.png",
							"name": "Встроенный фотоэлемент",
							"description": "Встроенный фотоэлемент",
							"datePublished": "2020-11-19"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/light-set.png",
							"name": "Встроенная сигнальная индикация",
							"description": "Встроенная сигнальная индикация",
							"datePublished": "2020-11-19"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/arrow-square-set.png",
							"name": "Стрела прямоугольного или круглого сечения",
							"description": "Стрела прямоугольного или круглого сечения с системой крепления к тумбе",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/reflective-stickers-set.png",
							"name": "Набор светоотражающих наклеек",
							"description": "Набор светоотражающих наклеек для стрелы",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/buffer-pad-set.png",
							"name": "Буферные накладки",
							"description": "Буферные накладки для стрелы прямоугольного сечения",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/channel-bars-set.png",
							"name": "Монтажные швеллеры",
							"description": "Монтажные швеллеры для установки шлагбаума на отверстия от предыдущего шлагбаума",
							"datePublished": "2020-11-02"
						}
					</script>
				</div>
			</section>
			<section class="optional-block">
				<h2 class="optional-block__title container">Дополнительное оборудование</h2>
				<div class="optional-block__photos container">
					<div class="optional-block__photos-inner"> 
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/code-modul.png" alt="Модуль GSM/BLE для управления шлагбаумом " title="Кодовая панель" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Модуль GSM/BLE для управления шлагбаумом
							</div>
							<!-- <div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								36 € (по курсу ЦБ РФ на 04.09.20)
							</div> -->
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Модуль GSM/BLE для управления шлагбаумом </h3>
								<p class="optional-block-photo__description-paragraph">Модуль предназначается для управления шлагбаумом с смартфона – посредством сотовой связи GSM и технологии Bluetooth. </p>
								<p class="optional-block-photo__description-paragraph">Модуль представляет собой плату беспроводной передачи данных, подключаемую к блоку управления шлагбаума PERCo-GS04 через интерфейс UART-BLE </p>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/gbs1.png" alt="Опорная стойка стрелы шлагбаума GBS1" title="Опорная стойка" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Опорная стойка стрелы шлагбаума GBS1
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Опорная стойка стрелы шлагбаума GBS1</h3>
								<p class="optional-block-photo__description-paragraph">Опорная стойка с ловителем для стрелы. Рекомендуется применять для стрелы длиной  более 3 метров, также на ней возможна установка передатчика фотоэлемента безопасности.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Высота стойки регулируется от 785 до 895 мм</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 125х188х960 мм</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/gds1.png" alt="Стойка для фотоэлемента безопасности GDS1" title="Стойка для фотоэлемента" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Стойка для фотоэлемента безопасности GDS1
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Стойка для фотоэлемента безопасности GDS1</h3>
								<p class="optional-block-photo__description-paragraph">На стойке может монтироваться как передатчик фотоэлемента безопасности, встроенного в шлагбаум, так и приемники и передатчики дополнительных фотоэлементов безопасности или датчики контроля проезда.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Высота стойки – 605 мм</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 120х80х605 мм</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/gcr1.png" alt="Устройство радиоуправления GCR1" title="Устройство радиоуправления" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Устройство радиоуправления GCR1
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Устройство радиоуправления GCR1</h3>
								<p class="optional-block-photo__description-paragraph">Двухканальное устройство радиоуправления шлагбаумом.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Напряжение питания –12-30 VDC</li>
									<li class="optional-block-photo__description-list-li">Частота – 315 МГц</li>
									<li class="optional-block-photo__description-list-li">Объем памяти – до 500 брелоков-передатчиков</li>
									<li class="optional-block-photo__description-list-li">5 режимов управления</li>
									<li class="optional-block-photo__description-list-li">Номинальный ток контактов реле – не более 10А</li>
									<li class="optional-block-photo__description-list-li">Диапазон рабочих температур – -40 - +80⁰С</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 100х61х29.5 мм</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/trinket-set.png" alt="Брелок GCR2" title="Брелок для шлагбаума" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Брелок GCR2
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Брелок GCR2</h3>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Дальность действия – до 50 метров</li>
									<li class="optional-block-photo__description-list-li">Элементы питания – 2 х CR2016</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 44х30х12 мм</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/gm1.png" alt="Монтажная пластина GM1" title="Монтажная пластина" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Монтажная пластина GM1
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Монтажная пластина GM1</h3>
								<p class="optional-block-photo__description-paragraph">Монтажная пластина применяется при установке шлагбаума на непрочные основания (грунты). Устанавливается в заранее подготовленный проем в земле, укрепляется арматурой и заливается бетоном.</p>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/perco-h6-4.png" alt="Пульт дистанционного управления PERCo-H6/4" title="Пульт дистанционного управления" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Пульт дистанционного управления PERCo-H6/4
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Пульт дистанционного управления PERCo-H6/4</h3>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 120х80х28 мм</li>
									<li class="optional-block-photo__description-list-li">Длина кабеля – 6,6 м</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/is-1-24.png" alt="Светофор ИС-1/24" title="Светофор для шлагбаума" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Светофор ИС-1/24
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Светофор ИС-1/24</h3>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Двухсекционный</li>
									<li class="optional-block-photo__description-list-li">Напряжение питания –24V AC/DC</li>
									<li class="optional-block-photo__description-list-li">Потребляемая мощность – не более 15 Вт</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 170х350х28 мм</li>
									<li class="optional-block-photo__description-list-li">Диаметр излучателя – 145 мм</li>
									<li class="optional-block-photo__description-list-li">Класс защиты – IP65</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/gd1.png" alt="Фотоэлемент GD1" title="Фотоэлемент" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Дополнительный фотоэлемент GD1
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Дополнительный фотоэлемент GD1</h3>
								<p class="optional-block-photo__description-paragraph">Шлагбаум имеет в своем составе фотоэлемент для защиты от удара стрелой (встроенный приемник – выносной передатчик). Также можно приобрести дополнительный фотоэлемент (приемник-передатчик) GD1 для использования в качестве детектора ТС.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Напряжение питания:приемник – 12-24V AC/DC (от платы шлагбаума), передатчик – 12-24V AC/DC или 2 батареи AA по 1.5V</li>
									<li class="optional-block-photo__description-list-li">Угол излучения – ≤±5°</li>
									<li class="optional-block-photo__description-list-li">Дальность действия – 12 м</li>
									<li class="optional-block-photo__description-list-li">Диапазон рабочих температур –-20℃~＋60℃</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры корпуса – 128х50х32 мм</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/m1h.png" alt="Датчик индукционной петли M1H" title="Датчик индукционной петли" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Датчик индукционной петли M1H
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Датчик индукционной петли M1H</h3>
								<p class="optional-block-photo__description-paragraph">Одноканальный датчик индукционной петли. К датчику подключается индукционная петля, заранее уложенная и смонтированная в соответствии с проектом пункта контроля автотранспорта (парковки). Используется в качестве детектора ТС.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Напряжение питания – 12-24V AC/DC</li>
									<li class="optional-block-photo__description-list-li">Рекомендованная индуктивность петли 100-300 мГн</li>
									<li class="optional-block-photo__description-list-li">Диапазон частот – 2 рабочих частоты 20-130 КГц </li>
									<li class="optional-block-photo__description-list-li">Диапазон рабочих температур – -20℃~＋70℃</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 81х25х100 мм</li>
									<li class="optional-block-photo__description-list-li">Площадь укладываемой петли – от 2 до 10 кв. м</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/led-strip-light.png" alt="Светодиодная лента для дополнительной подсветки стрелы шлагбаума PERCo-GBO3.0" title="Светодиодная лента" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Светодиодная лента для дополнительной подсветки стрелы шлагбаума PERCo-GBO3.0
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Светодиодная лента для дополнительной подсветки стрелы шлагбаума PERCo-GBO3.0</h3>
								<p class="optional-block-photo__description-paragraph">Используется для подсветки стрелы прямоугольного сечения длиной до 3 метров.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Напряжение питания – 12VDC от платы управления шлагбаумом</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/led-strip-light.png" alt="Светодиодная лента для дополнительной подсветки стрелы шлагбаума PERCo-GBO4.3" title="Светодиодная лента" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Светодиодная лента для дополнительной подсветки стрелы шлагбаума PERCo-GBO4.3
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								178 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Светодиодная лента для дополнительной подсветки стрелы шлагбаума PERCo-GBO3.0</h3>
								<p class="optional-block-photo__description-paragraph">Используется для подсветки стрелы прямоугольного сечения длиной до 4,3 метров.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Напряжение питания – 12VDC от платы управления шлагбаумом</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/fencing.png" alt="Ограждение для стойки шлагбаума GM3" title="Ограждение для стойки шлагбаума" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Ограждение для стойки шлагбаума GM3
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								43 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Ограждение для стойки шлагбаума GM3</h3>
								<p class="optional-block-photo__description-paragraph">Для защиты шлагбаума от случайного наезда. Изготовлено из стальной трубы Ø57 мм. Габаритные размеры (ШхГхВ) – 497х504х470 мм.</p>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/reader-stand.png" alt="Стойка для считывателя GM4" title="Стойка для считывателя" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Стойка для считывателя GM4
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								46 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Стойка для считывателя GM4</h3>
								<p class="optional-block-photo__description-paragraph">Для установки RFID-считывателя или кодонаборной панели.</p>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Высота стойки – 1300 мм</li>
									<li class="optional-block-photo__description-list-li">Размер установочной площадки – 174х174х5 мм</li>
								</ul>
							</div>
						</div>
						<div class="optional-block-photo">
							<div class="optional-block-photo__photo">
								<img class="optional-block-photo__img" src="img/code-panel.png" alt="Кодовая панель Tantos TS-KBD-EM2 Metal" title="Кодовая панель" loading="lazy">
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_title">
								Кодовая панель Tantos TS-KBD-EM2 Metal
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								Цена <span class="optional-block-photo__price-value">15 866 ₽</span> со склада в Москве и Санкт&#8209;Петербурге
							</div>
							<div class="optional-block-photo__text optional-block-photo__text_price">
								36 € (по курсу ЦБ РФ на 04.09.20)
							</div>
							<div class="optional-block-photo__description" data-state="closed">
								<button class="optional-block-photo__description-close" aria-label="Закрыть">
									<img class="optional-block-photo__description-close-img" src="img/close-grey.svg" alt="Закрыть" loading="lazy">
								</button>
								<h3 class="optional-block-photo__description-title">Кодовая панель Tantos TS-KBD-EM2 Metal</h3>
								<ul class="optional-block-photo__description-list">
									<li class="optional-block-photo__description-list-li">Напряжение питания – 12VDC</li>
									<li class="optional-block-photo__description-list-li">Ток потребления – не более 80 мА</li>
									<li class="optional-block-photo__description-list-li">Встроенный считыватель карт доступа (EMM)</li>
									<li class="optional-block-photo__description-list-li">Память – до 1000 карт/кодов</li>
									<li class="optional-block-photo__description-list-li">Металлический корпус</li>
									<li class="optional-block-photo__description-list-li">Класс защиты – IP66</li>
									<li class="optional-block-photo__description-list-li">Два индикатора статуса, звуковая индикация</li>
									<li class="optional-block-photo__description-list-li">Импульсный и триггерный режимы работы реле замка</li>
									<li class="optional-block-photo__description-list-li">Диапазон рабочих температур – -40℃~＋60℃</li>
									<li class="optional-block-photo__description-list-li">Габаритные размеры – 130х56х23 мм</li>
								</ul>
							</div>
						</div>
					</div>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gbs1.png",
							"name": "Опорная стойка стрелы шлагбаума GBS1",
							"description": "Опорная стойка с ловителем для стрелы. Рекомендуется применять для стрелы длиной более 3 метров, также на ней возможна установка передатчика фотоэлемента безопасности.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gds1.png",
							"name": "Стойка для фотоэлемента безопасности GDS1",
							"description": "На стойке может монтироваться как передатчик фотоэлемента безопасности, встроенного в шлагбаум, так и приемники и передатчики дополнительных фотоэлементов безопасности или датчики контроля проезда.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gcr1.png",
							"name": "Устройство радиоуправления GCR1",
							"description": "Двухканальное устройство радиоуправления шлагбаумом.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/trinket-set.png",
							"name": "Брелок GCR2",
							"description": "Дальность действия – до 50 метров. Элементы питания – 2 х CR2016. Габаритные размеры – 44х30х12 мм.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gm1.png",
							"name": "Монтажная пластина GM1",
							"description": "Монтажная пластина применяется при установке шлагбаума на непрочные основания (грунты). Устанавливается в заранее подготовленный проем в земле, укрепляется арматурой и заливается бетоном.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/perco-h6-4.png",
							"name": "Пульт дистанционного управления PERCo-H6/4",
							"description": "Габаритные размеры – 120х80х28 мм. Длина кабеля – 6,6 м.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/is-1-24.png",
							"name": "Светофор ИС-1/24",
							"description": "Двухсекционный. Напряжение питания –24V AC/DC. Потребляемая мощность – не более 15 Вт. Габаритные размеры – 170х350х28 мм. Диаметр излучателя – 145 мм. Класс защиты – IP65.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gd1.png",
							"name": "Дополнительный Фотоэлемент GD1",
							"description": "Шлагбаум имеет в своем составе фотоэлемент для защиты от удара стрелой (встроенный приемник – выносной передатчик). Также можно приобрести дополнительный фотоэлемент (приемник-передатчик) GD1 для использования в качестве детектора ТС.",
							"datePublished": "2020-11-02",
							"dateModified": "2021-02-04"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/m1h.png",
							"name": "Датчик индукционной петли M1H",
							"description": "Одноканальный датчик индукционной петли. К датчику подключается индукционная петля, заранее уложенная и смонтированная в соответствии с проектом пункта контроля автотранспорта (парковки). Используется в качестве детектора ТС.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/led-strip-light.png",
							"name": "Светодиодная лента для дополнительной подсветки стрелы шлагбаума",
							"description": "Используется для подсветки стрелы прямоугольного сечения.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/fencing.png",
							"name": "Ограждение для стойки шлагбаума GM3",
							"description": "Для защиты шлагбаума от случайного наезда. Изготовлено из стальной трубы Ø57 мм. Габаритные размеры (ШхГхВ) – 497х504х470 мм.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/reader-stand.png",
							"name": "Стойка для считывателя GM4",
							"description": "Для установки RFID-считывателя или кодонаборной панели.",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/code-panel.png",
							"name": "Кодовая панель Tantos TS-KBD-EM2 Metal",
							"description": "Напряжение питания – 12VDC. Ток потребления – не более 80 мА. Встроенный считыватель карт доступа (EMM). Память – до 1000 карт/кодов. Металлический корпус. Класс защиты – IP66. Два индикатора статуса, звуковая индикация. Импульсный и триггерный режимы работы реле замка. Диапазон рабочих температур – -40℃~＋60℃. Габаритные размеры – 130х56х23 мм",
							"datePublished": "2020-11-02",
							"dateModified": "2020-12-03"
						}
					</script>
				</div>
			</section>
			<section class="control-block">
				<h2 class="control-block__title container">Способы управления</h2>
				<div class="control-block__icons container">
					<div class="control-icon">
						<div class="control-icon__title">
							Система контроля доступа
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_acs" src="img/acs.svg" alt="Контроллер" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Звонок со смартфона
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_phone" src="img/phone.svg" alt="Телефон" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Мобильное приложение
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_phone" src="img/app.svg" alt="Приложение" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Пульт РУ
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_remote-controller-ru" src="img/remote-controller-ru.svg" alt="Пульт РУ" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Пульт ДУ
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_remote-controller-du" src="img/remote-controller-du.svg" alt="Пульт ДУ" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Управление от кнопки
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_btn" src="img/btn.svg" alt="Кнопка" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Магнитная петля
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_remote-controller-magnetic" src="img/magnetic-loop.svg" alt="Магнит" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Режим ведущий/ведомый
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_master-slave" src="img/master-slave.svg" alt="Режим шлагбаума ведущий/ведомый" loading="lazy" draggable="false">
						</div>
					</div>
					<div class="control-icon">
						<div class="control-icon__title">
							Закрытие шлагбаума
						</div>
						<div class="control-icon__icon">
							<img class="control-icon__img control-icon__img_boom-barrier-closing" src="img/boom-barrier-closing.svg" alt="Закрытие шлагбаума" loading="lazy" draggable="false">
						</div>
					</div>
				</div>
			</section>
			<section class="features-block" id="features">
				<h2 class="features-block__title container">Особенности</h2>
				<div class="features-block__icons container">
					<div class="feature-icon">
						<div class="feature-icon__icon">
							<img class="feature-icon__img feature-icon__img_heating" src="img/heating-system.svg" alt="Система обогрева" loading="lazy" draggable="false">
						</div>
						<div class="feature-icon__text">
							Встроенная система обогрева механизма управления обеспечивает работу шлагбаума при температуре от -40 до +55°C.
						</div>
					</div>
					<div class="feature-icon">
						<div class="feature-icon__icon">
							<img class="feature-icon__img feature-icon__img_protection" src="img/mechanism-protection.svg" alt="Система обогрева" loading="lazy" draggable="false">
						</div>
						<div class="feature-icon__text">
							Конструктив шлагбаума предусматривает защиту механизма при наезде автомобиля: в этом случае деформируется только стрела.
						</div>
					</div>
					<div class="feature-icon">
						<div class="feature-icon__icon">
							<img class="feature-icon__img feature-icon__img_reductor" src="img/planetary-reductor.svg" alt="Планетарный редуктор" loading="lazy" draggable="false">
						</div>
						<div class="feature-icon__text">
							Продолжительный срок службы шлагбаума достигается за счет двигателя с надежным редуктором.
						</div>
					</div>
					<div class="feature-icon">
						<div class="feature-icon__icon">
							<img class="feature-icon__img feature-icon__img_boom-protection" src="img/boom-protection-systems.svg" alt="Система защиты от удара стрелой" loading="lazy" draggable="false">
						</div>
						<div class="feature-icon__text">
							Безопасность обеспечивается при помощи сигнальной индикации, фотоэлемента и системы защиты от удара стрелой.
						</div>
					</div>
					<div class="feature-icon">
						<div class="feature-icon__icon">
							<img class="feature-icon__img feature-icon__img_power" src="img/power-outage.svg" alt="Отключение питания" loading="lazy" draggable="false">
						</div>
						<div class="feature-icon__text">
							При отключении электропитания стрела остается в том же положении, что и до отключения.
						</div>
					</div>
					<div class="feature-icon">
						<div class="feature-icon__icon">
							<img class="feature-icon__img feature-icon__img_buffer" src="img/buffer-pad.svg" alt="Буферная накладка из ПВХ" loading="lazy" draggable="false">
						</div>
						<div class="feature-icon__text">
							Буферная накладка из ПВХ на стреле прямоугольного сечения защищает корпус автомобиля при касании.
						</div>
					</div>
				</div>
			</section>
			<section class="characteristics-block" id="characteristics">
				<div class="characteristics-block__top">
					<h2 class="characteristics-block__title container">Характеристики</h2>
					<div class="characteristics-block__icons">
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_voltage" src="img/operating-voltage.svg" alt="Напряжение питания 24 вольта" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								напряжение питания
							</div>
						</div>
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_temperature" src="img/temperature-range.svg" alt="Диапазон температур -40 - +55" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								диапазон температур
							</div>
						</div>
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_ip" src="img/ip-code.svg" alt="Степень защиты IP54" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								степень защиты
							</div>
						</div>
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_time" src="img/opening-time.svg" alt="Скорость открытия шлагбаума 3-6 с" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								скорость открытия
							</div>
						</div>
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_duty" src="img/duty-cycle.svg" alt="Интенсивность использования шлагбаума 70%" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								интенсивность использования
							</div>
						</div>
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_vehicles" src="img/vehicles-per-day.svg" alt="3000 транспортных средств в сутки" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								транспортных средств в сутки
							</div>
						</div>
						<div class="characteristics-icon">
							<div class="characteristics-icon__icon">
								<img class="characteristics-icon__img characteristics-icon__img_cycles" src="img/cycles.svg" alt="1 миллион циклов" loading="lazy" draggable="false">
							</div>
							<div class="characteristics-icon__title">
								циклов
							</div>
						</div>
					</div>
				</div>
				<div class="characteristics-block__bottom">
					<div class="characteristics-picture">
						<div class="characteristics-picture__picture">
							<img class="characteristics-picture__img characteristics-picture__img_schema" src="img/gs04-schema.svg" alt="Габаритный чертёж шлагбаума perco GS04" title="Габаритный чертёж шлагбаума" data-ratio="0.8275" loading="lazy">
						</div>
						<div class="characteristics-picture__title characteristics-picture__title_schema">
							Габаритный чертеж
						</div>
					</div>
					<div class="characteristics-picture">
						<div class="characteristics-picture__picture">
							<img class="characteristics-picture__img characteristics-picture__img_description" src="img/gs04-description.png" alt="Шлагбаум PERCo-GS04" title="Шлагбаум PERCo-GS04" data-ratio="1" loading="lazy">
						</div>
						<div class="characteristics-picture__title characteristics-picture__title_description">
							Стрела может быть укорочена до 2,5 метров.
						</div>
					</div>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gs04-schema.svg",
							"name": "Габаритный чертёж",
							"description": "Габаритный чертёж",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gs04-description.png",
							"name": "Шлагбаум с укороченной стрелой",
							"description": "Стрела может быть укорочена до 2,5 метров",
							"datePublished": "2020-11-02"
						}
					</script>
				</div>
			</section>
			<section class="download-block" id="download">
				<h2 class="download-block__title container">Скачать</h2>
				<div class="download-block__files">
					<a class="file" href="download/GS04_ApplicGuide.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Шлагбаум PERCo-GS04. <br class="file__br">Руководство по эксплуатации</h3>
						<div class="file__description">(4.11 MB) &mdash; 09.11.2020</div>
					</a>
					<a class="file" href="download/GS04_TechSpec.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Шлагбаум PERCo-GS04. <br class="file__br">Краткое техническое описание</h3>
						<div class="file__description">(1.17 MB) &mdash; 04.08.2021</div> 
					</a>
					<a class="file" href="download/AutoCAD.WMD-06-connection_dwg.zip" target="_blank">
						<img class="file__icon" src="img/dwg.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Схема подключения GS04 <br class="file__br">(AutoCAD)</h3>
						<div class="file__description">(38 kB) &mdash; 07.09.2018</div>
					</a>
					<a class="file" href="download/GS04_Declaration.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Декларация о соответствии на шлагбаум GS04</h3>
						<div class="file__description">(1.12 MB) &mdash; 04.12.2020</div>
					</a>
					<a class="file" href="download/shlagbaum-buklet-a4.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Шлагбаум Буклет А4</h3>
						<div class="file__description">(5.15 MB) &mdash; 12.11.2020</div>
					</a>
					<a class="file" href="download/GD1_ApplicGuide.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Фотоэлемент PERCo-GD1. <br class="file__br">Инструкция</h3>
						<div class="file__description">(460 kB) &mdash; 29.01.2021</div>
					</a>
					<a class="file" href="download/GCR1_ApplicGuide.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Двухканальное устройство <br class="file__br">радиоуправления PERCo-GCR1. <br class="file__br">Инструкция</h3>
						<div class="file__description">(317 kB) &mdash; 09.06.2020</div>
					</a> 
					<a class="file" href="download/GCM1_ApplicGuide.pdf" target="_blank">
						<img class="file__icon" src="img/pdf.svg" alt="pdf" loading="lazy" draggable="false">
						<h3 class="file__title">Паспорт и руководство пользователя <br class="file__br">GSM / BLE модуль управления шлагбаумом PERCo-GCM1 </h3>
						<div class="file__description">(2.87 MB) &mdash; 03.08.2021</div>
					</a>
					
		
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/GS04_ApplicGuide.pdf",
							"name": "GS04_ApplicGuide.pdf",
							"description": "Шлагбаум PERCo-GS04. Руководство по эксплуатации",
							"encodingFormat": "application/pdf"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/GS04_TechSpec.pdf",
							"name": "GS04_TechSpec.pdf",
							"description": "Шлагбаум PERCo-GS04. Краткое техническое описание",
							"encodingFormat": "application/pdf"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/AutoCAD.WMD-06-connection_dwg.zip",
							"name": "AutoCAD.WMD-06-connection_dwg.zip",
							"description": "Схема подключения GS04 (AutoCAD)",
							"encodingFormat": "application/zip"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/GS04_Declaration.pdf",
							"name": "GS04_Declaration.pdf",
							"description": "Декларация о соответствии на шлагбаум GS04",
							"encodingFormat": "application/pdf"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/shlagbaum-buklet-a4.pdf",
							"name": "GS04_ApplicGuide.pdf",
							"description": "Шлагбаум Буклет А4",
							"encodingFormat": "application/pdf"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/GD1_ApplicGuide.pdf",
							"name": "GD1_ApplicGuide.pdf",
							"description": "Фотоэлемент PERCo-GD1. Инструкция",
							"encodingFormat": "application/pdf"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "DataDownload",
							"contentUrl": "https://barrier.perco.ru/download/GCR1_ApplicGuide.pdf",
							"name": "GCR1_ApplicGuide.pdf",
							"description": "Двухканальное устройство радиоуправления PERCo-GCR1. Инструкция",
							"encodingFormat": "application/pdf"
						}
					</script>
				</div>
			</section>
			<section class="solutions-block">
				<h2 class="solutions-block__title container">Решения</h2>
				<img class="solutions-block__head" src="img/solution-head.jpg" alt="Шлагбаум PERCo-GS04" title="Шлагбаум PERCo-GS04" data-ratio="3.1088" loading="lazy" draggable="false">
				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "ImageObject",
						"contentUrl": "https://barrier.perco.ru/img/solution-head.jpg",
						"name": "Автотранспортная проходная",
						"description": "Автотранспортная проходная оборудуется шлагбаумом, видеокамерами, контроллером шлагбаума и считывателями дальнего действия.",
						"datePublished": "2020-11-02"
					}
				</script>
				<p class="solutions-block__paragraph container">Автотранспортная проходная оборудуется шлагбаумом, видеокамерами, контроллером шлагбаума и считывателями дальнего действия. Управление работой шлагбаума и учет проезда транспортных средств осуществляются с помощью специального программного обеспечения.</p>
				<h3 class="solutions-block__subtitle solutions-block__subtitle_control container">Контроль доступа автомобилей</h3>
				<div class="solution-text-block solution-text-block_reader container">
					<div class="solution-text-block__text">
						<p class="solution-text-block__paragraph">Водитель предъявляет идентификатор считывателю, не покидая автомобиля. В качестве идентификатора могут использоваться карты доступа и RFID-метки. Также может использоваться система распознавания номеров автомобиля.</p>
						<p class="solution-text-block__paragraph">Считыватель работает на расстоянии до нескольких метров. Для проезда грузовиков можно установить дополнительный считыватель на высоком кронштейне вровень с кабинами. Дополнительный считыватель будет дублировать работу основного считывателя.</p>
					</div>
					<img class="solution-text-block__img" src="img/saat-i801m.jpg" alt="Считыватель дальнего действия SAAT-I801M" title="Считыватель дальнего действия SAAT-I801M" data-ratio="1.5674" loading="lazy">
				</div>
				<div class="solution-text-block solution-text-block_reverse solution-text-block_face container">
					<div class="solution-text-block__text">
						<p class="solution-text-block__paragraph">Для защиты от проезда по чужому пропуску применяется видеоидентификация. Сотрудник службы безопасности сравнивает внешность водителя с фотографией владельца пропуска из базы данных и при несовпадении запрещает доступ.</p>
						<p class="solution-text-block__paragraph">Для предотвращения хищений создается шлюз из двух шлагбаумов. Перед первым проверяется правомочность проезда, перед вторым проводится досмотр автомобиля.</p>
						<p class="solution-text-block__paragraph">Проезд автомобиля может быть комиссионирован пропуском водителя. В этом случае система фиксирует событие «Проезд» для автомобиля и событие «Проход» для водителя. В отчетах информация о проезде автомобиля будет дополнена данными водителя.</p>
					</div>
					<img class="solution-text-block__img" src="img/perco-face-identification.jpg" alt="Консоль управления PERCo-S-20, идентификация по лицу" title="Консоль управления PERCo-S-20, идентификация по лицу" data-ratio="1.5674" loading="lazy">
				</div>
				<h3 class="solutions-block__subtitle solutions-block__subtitle_accounting container">Учет перемещений автотранспорта</h3>
				<div class="solution-text-block solution-text-block_reports container">
					<div class="solution-text-block__text">
						<p class="solution-text-block__paragraph">Система формирует отчеты о проезде транспортных средств, позволяющие вести корректный учет количества въездов и времени пребывания на территории автомобилей сотрудников и посетителей.</p>
						<p class="solution-text-block__paragraph">В отчетах указывается:</p>
						<ul class="solution-text-block__ul">
							<li class="solution-text-block__li"><span class="solution-text-block__li-text">время въезда и выезда</span></li>
							<li class="solution-text-block__li"><span class="solution-text-block__li-text">время нахождения автомобилей сотрудников и посетителей на территории</span></li>
							<li class="solution-text-block__li"><span class="solution-text-block__li-text">время нахождения служебных транспортных средств на территории и вне территории в заданный период времени</span></li>
							<li class="solution-text-block__li"><span class="solution-text-block__li-text">информация о ТС, находящихся на территории в текущий момент времени</span></li>
						</ul>
					</div>
					<img class="solution-text-block__img" src="img/perco-reports.jpg" alt="Консоль управления PERCo-S-20, отчёты" title="Консоль управления PERCo-S-20, отчёты" data-ratio="1.5674" loading="lazy">
				</div>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "Article",
						"name": "Автотранспортная проходная",
						"headline": "Автотранспортная проходная",
						"url": "https://barrier.perco.ru",
						"mainEntityOfPage": {
							"@type": "WebPage",
							"@id": "https://barrier.perco.ru/"
						},
						"image": [
							"https://barrier.perco.ru/img/saat-i801m.jpg",
							"https://barrier.perco.ru/img/perco-face-identification.jpg",
							"https://barrier.perco.ru/img/perco-reports.jpg"
						],
						"datePublished": "2020-11-02T10:00:00",
						"dateModified": "2020-11-02T10:00:00",
						"author": {
							"@type": "Organization",
							"name": "PERCo",
							"logo": {
								"@type": "ImageObject",
								"url": "https://barrier.perco.ru/img/logo.svg"
							}
						},
						"publisher": {
							"@type": "Organization",
							"name": "PERCo",
							"logo": {
								"@type": "ImageObject",
								"url": "https://barrier.perco.ru/img/logo.svg"
							}
						},
						"articleBody": "Автотранспортная проходная оборудуется шлагбаумом, видеокамерами, контроллером шлагбаума и считывателями дальнего действия. Управление работой шлагбаума и учет проезда транспортных средств осуществляются с помощью специального программного обеспечения. Водитель предъявляет идентификатор считывателю, не покидая автомобиля. В качестве идентификатора могут использоваться карты доступа и RFID-метки. Также может использоваться система распознавания номеров автомобиля. Считыватель работает на расстоянии до нескольких метров. Для проезда грузовиков можно установить дополнительный считыватель на высоком кронштейне вровень с кабинами. Дополнительный считыватель будет дублировать работу основного считывателя. Для защиты от проезда по чужому пропуску применяется видеоидентификация. Сотрудник службы безопасности сравнивает внешность водителя с фотографией владельца пропуска из базы данных и при несовпадении запрещает доступ. Для предотвращения хищений создается шлюз из двух шлагбаумов. Перед первым проверяется правомочность проезда, перед вторым проводится досмотр автомобиля. Проезд автомобиля может быть комиссионирован пропуском водителя. В этом случае система фиксирует событие «Проезд» для автомобиля и событие «Проход» для водителя. В отчетах информация о проезде автомобиля будет дополнена данными водителя. Система формирует отчеты о проезде транспортных средств, позволяющие вести корректный учет количества въездов и времени пребывания на территории автомобилей сотрудников и посетителей. В отчетах указывается: время въезда и выезда, время нахождения автомобилей сотрудников и посетителей на территории, время нахождения служебных транспортных средств на территории и вне территории в заданный период времени, информация о ТС, находящихся на территории в текущий момент времени.",
						"wordCount": 212,
						"speakable":
						{
							"@type": "SpeakableSpecification",
							"xpath": [
								"/html/body/main/section[11]/p",
								"/html/body/main/section[11]/h3[1]",
								"/html/body/main/section[11]/div[1]/div/p[1]",
								"/html/body/main/section[11]/div[1]/div/p[2]",
								"/html/body/main/section[11]/div[2]/div/p[1]",
								"/html/body/main/section[11]/div[2]/div/p[2]",
								"/html/body/main/section[11]/div[2]/div/p[2]",
								"/html/body/main/section[11]/h3[2]",
								"/html/body/main/section[11]/div[3]/div/p[1]",
								"/html/body/main/section[11]/div[3]/div/p[2]",
								"/html/body/main/section[11]/div[3]/div/ul"
							]
						}
					}
				</script>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "ImageObject",
						"contentUrl": "https://barrier.perco.ru/img/saat-i801m.jpg",
						"name": "Считыватель дальнего действия SAAT-I801M",
						"description": "Считыватель дальнего действия SAAT-I801M",
						"datePublished": "2020-11-02"
					}
				</script>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "ImageObject",
						"contentUrl": "https://barrier.perco.ru/img/perco-face-identification.jpg",
						"name": "Консоль управления PERCo-S-20, идентификация по лицу",
						"description": "Консоль управления PERCo-S-20, идентификация по лицу",
						"datePublished": "2020-11-02"
					}
				</script>
				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "ImageObject",
						"contentUrl": "https://barrier.perco.ru/img/perco-reports.jpg",
						"name": "Консоль управления PERCo-S-20, отчёты",
						"description": "Консоль управления PERCo-S-20, отчёты",
						"datePublished": "2020-11-02"
					}
				</script>
			</section>
			<section class="about-block" id="about">
				<h2 class="about-block__title container">О компании</h2>
				<div class="about-head">
					<img class="about-head__img" src="img/about-head.jpg" alt="Главный офис и завод компании PERCo" title="Главный офис и завод PERCo" data-ratio="3.8297" loading="lazy" draggable="false">
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/about-head.jpg",
							"name": "Главный офис и завод компании PERCo",
							"description": "Главный офис и завод компании PERCo",
							"datePublished": "2020-11-02"
						}
					</script>
					<h3 class="about-head__big-title about-head__big-title_office">Главный офис PERCo</h3>
					<h3 class="about-head__big-title about-head__big-title_factory">Завод PERCo</h3>
					<div class="about-head__titles container">
						<h3 class="about-head__title">Главный офис PERCo</h3>
						<h3 class="about-head__title">Завод PERCo</h3>
					</div>
				</div>
				<h3 class="about-block__subtitle container">PERCo - ведущий российский производитель систем и оборудования безопасности</h3>
				<div class="about-block__icons container">
					<div class="about-icon">
						<div class="about-icon__icon">
							<img class="about-icon__img about-icon__img_experience" src="img/about-experience.svg" alt="30-летний опыт работы" loading="lazy" draggable="false">
						</div>
						<div class="about-icon__text">
							30-летний опыт работы
						</div>
					</div>
					<div class="about-icon">
						<div class="about-icon__icon">
							<img class="about-icon__img about-icon__img_countries" src="img/about-countries-number.svg" alt="Продажи в 90 странах мира" loading="lazy" draggable="false">
						</div>
						<div class="about-icon__text">
							Продажи в 90 странах мира
						</div>
					</div>
					<div class="about-icon">
						<div class="about-icon__icon">
							<img class="about-icon__img about-icon__img_warranty" src="img/about-warranty.svg" alt="5-летний гарантийный срок на оборудование" loading="lazy" draggable="false">
						</div>
						<div class="about-icon__text">
							5-летний гарантийный срок на оборудование
						</div>
					</div>
					<div class="about-icon">
						<div class="about-icon__icon">
							<img class="about-icon__img about-icon__img_dealers" src="img/about-dealer-network.svg" alt="Диллерская сеть" loading="lazy" draggable="false">
						</div>
						<div class="about-icon__text">
							Разветвленная диллерская сеть, сервисные центры во всех регионах
						</div>
					</div>
					<div class="about-icon">
						<div class="about-icon__icon">
							<img class="about-icon__img about-icon__img_warehouses" src="img/about-warehouses.svg" alt="Склад" loading="lazy" draggable="false">
						</div>
						<div class="about-icon__text">
							Склады готовой продукции в Москве, Санкт&#8209;Петербурге, Пскове и ЕС
						</div>
					</div>
					<div class="about-icon">
						<div class="about-icon__icon">
							<img class="about-icon__img about-icon__img_eaducational-center" src="img/about-educational-center.svg" alt="Обучение" loading="lazy" draggable="false">
						</div>
						<div class="about-icon__text">
							Техническая поддержка и бесплатное обучение в Учебном центре
						</div>
					</div>
				</div>
				<h3 class="about-block__subtitle container">PERCo разрабатывает и выпускает: шлагбаумы, турникеты, замки, контроллеры и считыватели, системы контроля доступа.</h3>
				<div class="about-block__example-icons container">
					<div class="about-example-icon">
						<img class="about-example-icon__icon" src="img/about-acs.svg" alt="Системы контроля доступа" loading="lazy" draggable="false">
						<div class="about-example-icon__text">
							Системы контроля доступа
						</div>
					</div>
					<div class="about-example-icon">
						<img class="about-example-icon__icon" src="img/about-turnstiles.svg" alt="Турникеты и электронные проходные" loading="lazy" draggable="false">
						<div class="about-example-icon__text">
							Турникеты и электронные проходные
						</div>
					</div>
					<div class="about-example-icon">
						<img class="about-example-icon__icon" src="img/about-boom-barrier.svg" alt="Шлагбаум" loading="lazy" draggable="false">
						<div class="about-example-icon__text">
							Шлагбаумы
						</div>
					</div>
				</div>
				<div class="about-block__photos container">
					<div class="about-photo">
						<img class="about-photo__img" src="img/cl15.jpg" alt="Биометрический считываетль CL15" title="Биометрический считываетль CL15" loading="lazy">
						<div class="about-photo__text">
							Системы контроля доступа
						</div>
					</div>
					<div class="about-photo">
						<img class="about-photo__img" src="img/st01.jpg" alt="Турникет ST-01" title="Турникет ST01" loading="lazy">
						<div class="about-photo__text">
							Турникеты и электронные проходные
						</div>
					</div>
					<div class="about-photo">
						<img class="about-photo__img" src="img/gs04.jpg" alt="Шлагбаум GS04"  title="Шлагбаум GS04" loading="lazy">
						<div class="about-photo__text">
							Шлагбаумы
						</div>
					</div>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/cl15.jpg",
							"name": "Биометрический считываетль CL15",
							"description": "Биометрический считываетль CL15",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/st01.jpg",
							"name": "Турникет ST-01",
							"description": "Турникет ST-01",
							"datePublished": "2020-11-02"
						}
					</script>
					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "ImageObject",
							"contentUrl": "https://barrier.perco.ru/img/gs04.jpg",
							"name": "Шлагбаум GS04",
							"description": "Шлагбаум GS04",
							"datePublished": "2020-11-02"
						}
					</script>
				</div>
				<div class="about-link-block container"><a class="about-link-block__link" href="https://www.perco.ru/o-kompanii/" target="_blank" rel="noopener">Подробнее на сайте</a></div>
			</section>
			<section class="feedback-block" id="feedback">
				<h2 class="feedback-block__title container">Обратная связь</h2>
				<div class="feedback-block__contacts">
					<div class="feedback-contact">
						<img class="feedback-contact__img feedback-contact__img_phone" src="img/feedback-phone.svg" alt="Телефон" loading="lazy" draggable="false">
						<div class="feedback-contact__text">
							<a class="feedback-contact__link feedback-contact__link_first-numer" href="tel:+78003335253">+7 (800) 333-52-53</a>
							<a class="feedback-contact__link feedback-contact__link_second-numer" href="tel:+78122470457">+7 (812) 247-04-57</a>
						</div>
					</div>
					<div class="feedback-contact">
						<img class="feedback-contact__img feedback-contact__img_mail" src="img/feedback-mail.svg" alt="Почтовый конверт" loading="lazy" draggable="false">
						<div class="feedback-contact__text">
							<a class="feedback-contact__link feedback-contact__link_mail" href="mailto:mail@perco.ru">mail@perco.ru</a>
						</div>
					</div>
				</div>
				<div class="feedback-block__social">
					<a class="feedback-social" href="https://www.perco.ru/" target="_blank" rel="noopener">
						<img class="feedback-social__img" src="img/globe.svg" alt="Глобус" loading="lazy" draggable="false">
					</a>
					<a class="feedback-social" href="https://www.youtube.com/c/PercoRussian" target="_blank" rel="noopener">
						<img class="feedback-social__img feedback-social__img_youtube" src="img/youtube.svg" alt="Youtube" loading="lazy" draggable="false">
					</a>
					<a class="feedback-social" href="https://www.instagram.com/perco_com/" target="_blank" rel="noopener">
						<img class="feedback-social__img" src="img/instagram.svg" alt="instagram" loading="lazy" draggable="false">
					</a>
					<a class="feedback-social" href="https://t.me/perco_com" target="_blank" rel="noopener">
						<img class="feedback-social__img" src="img/telegram.svg" alt="telegram" loading="lazy" draggable="false">
					</a>
					<a class="feedback-social" href="https://zen.yandex.ru/id/5dd3ece3f5a25e6c5ca78bf8" target="_blank" rel="noopener">
						<img class="feedback-social__img" src="img/dzen.svg" alt="dzen" loading="lazy" draggable="false">
					</a>
				</div>
				<form class="feedback-form">
					<label class="feedback-form-label">
						<div class="feedback-form-label__icon">
							<object class="feedback-form-label__img feedback-form-label__img_person" data="img/feedback-person-small.svg" type="image/svg+xml">Ваше имя</object>
						</div>
						<div class="feedback-form-label__placeholder">Ваше имя</div>
						<input class="feedback-form-label__input" name="name" type="text">
					</label>
					<label class="feedback-form-label">
						<div class="feedback-form-label__icon">
							<object class="feedback-form-label__img feedback-form-label__img_mail" data="img/feedback-mail-small.svg" type="image/svg+xml">Ваше имя</object>
						</div>
						<div class="feedback-form-label__placeholder">E-mail *</div>
						<input class="feedback-form-label__input" name="email" type="email" required>
					</label>
					<label class="feedback-form-label">
						<div class="feedback-form-label__icon">
							<object class="feedback-form-label__img feedback-form-label__img_phone" data="img/feedback-phone-small.svg" type="image/svg+xml">Ваше имя</object>
						</div>
						<div class="feedback-form-label__placeholder">Телефон</div>
						<input class="feedback-form-label__input feedback-form-label__input_number" name="number" type="tel">
					</label>
					<label class="feedback-form-label feedback-form-label_message">
						<div class="feedback-form-label__placeholder">Сообщение</div>
						<textarea class="feedback-form-label__input" name="message"></textarea>
					</label>
					<label class="feedback-form-label-checkbox"><input class="feedback-form-label-checkbox__input" type="checkbox" required> Я прочитал(а) <a href="" class="feedback-form-policy-link">политику конфиденциальности</a> и соглас(на)ен на обработку данных</label>
					<div class="g-recaptcha" data-sitekey="6LeBYtYZAAAAAA2TyNHPwEnK9wdliX0l9d_RS93V"></div>
					<button class="feedback-form-btn" aria-label="Отправить">
						Отправить
					</button>
					<input value="feedback" name="form" hidden>
				</form>
			</section>
			<div class="popup" data-state="closed" data-animation="static">
				<div id="video" class="popup__window popup__window_boom-barrier"></div>
				<div class="popup__window popup__window_policy">
					<h2 class="policy__title">Общество с ограниченной ответственностью «ПЭРКО»</h2>
					<h3 class="policy__subtitle">СОКРАЩЕННАЯ ВЕРСИЯ</h3>
					<p class="policy__paragraph">ПЭРКо серьезно относится к конфиденциальности и защите Ваших Персональных данных.</p>
					<p class="policy__paragraph">Термин «Персональные данные» означает информацию, которая прямо или косвенно может идентифицировать Вас или других лиц («<b>Персональные данные</b>»). Данный термин обычно включает такие сведения как фамилия, имя, среднее имя, применяемые дополнительные обращения (степени, титулы и т.д.), отчество, дату рождения, гражданство, паспортные данные, адрес, адрес электронной почты, телефонный номер, а также Ваш статус участника программы сертификации партнеров ПЭРКо. К персональным данным также может относиться другая информация, в том числе, информация об IP-адресе, потребительских предпочтениях, половой принадлежности, возрасте, состоянии Вашего здоровья, образе жизни или информация о Ваших увлечениях и интересах.</p>
					<p class="policy__paragraph">Мы обрабатываем те или иные категории Персональных данных в зависимости от того, каким образом Вы пользуетесь нашими услугами. Мы используем Ваши Персональные данные для предоставления Вам сервисов (функционала) нашего веб-сайта в соответствии с Вашими предпочтениями, обработки Ваших запросов, а также для связи с Вами по вопросам продуктов и услуг, которые могут представлять для Вас интерес и которые мы подобрали специально для Вас, розыгрышей призов, проведения игр или соревнований, а также решения соответствующих вопросов организационного (административного) характера. Все Персональные данные обрабатываются в соответствии с применимым законодательством в сфере защиты данных.</p>
					<p class="policy__paragraph">Мы передаем Ваши Персональные данные исключительно привлекаемым нами обработчикам (т.е. третьим лиц, действующим по нашему поручению), которые содействуют нам при оказании услуг, а также уполномоченных государственных органов. На основании Вашего согласия мы можем использовать куки для маркетинговых целей, а также улучшения функциональности наших сервисов и также в целях статистического анализа.</p>
					<p class="policy__paragraph">Мы также предлагаем Вам как нашему клиенту различные опции контроля за использованием Ваших Персональных данных.</p>
					<p class="policy__paragraph">Если вы желаете получить более подробную информацию об обработке Ваших Персональных данных и куки, которые мы используем, пожалуйста, обратитесь к расширенной версии Политики конфиденциальности.</p>
					<h3 class="policy__subtitle"><a href="https://www.perco.ru/politika-konfidentsialnosti/" target="_blank" rel="noopener">РАСШИРЕННАЯ ВЕРСИЯ</a></h3>
				</div>
				<div class="popup__window popup__window_feedback">
					<img class="popup__window_feedback__img" src="img/check-mark.svg" alt="check mark" loading="lazy" draggable="false">
					Сообщение успешно отправлено
				</div>
			</div>
		</main>
	</body>
</html>