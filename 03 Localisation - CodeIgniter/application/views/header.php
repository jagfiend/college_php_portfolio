<!DOCTYPE html>
<html>
	<head>
		<!-- meta tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta lang="jp">

		<!-- site title -->
		<title>Intersurgical 日本</title>

		<!-- javascript -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/effects.core.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/effects.slide.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/popupbox.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url(); ?>assets/js/search-autocomplete.js" type="text/javascript" charset="utf-8"></script>

		<!-- style scripts -->
		<link href="<?php echo base_url(); ?>assets/css/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>assets/css/reset.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/global.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/colours.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css" />

	</head>
	<body class="">
	<div id="top">
		<div id="international_box">
			<ul>
				<li class="uk"><a href="http://www.intersurgical.com"><img src="<?php echo base_url(); ?>assets/img/international.jpg" alt="International" /></a></li>
				<li class="de"><a href="http://www.intersurgical.de"><img src="<?php echo base_url(); ?>assets/img/de.jpg" alt="DE flag" /></a></li>
				<li class="fr"><a href="http://www.intersurgical.fr"><img src="<?php echo base_url(); ?>assets/img/fr.jpg" alt="FR flag" /></a></li>
				<li class="ru"><a href="http://www.intersurgical.ru"><img src="<?php echo base_url(); ?>assets/img/ru.jpg" alt="RU flag" /></a></li>
				<li class="nl"><a href="http://www.intersurgical.nl"><img src="<?php echo base_url(); ?>assets/img/nl.jpg" alt="NL flag" /></a></li>
				<li class="cz"><a href="http://www.intersurgical.cz"><img src="<?php echo base_url(); ?>assets/img/cz.jpg" alt="CZ flag" /></a></li>
				<li class="usa"><a href="http://us.intersurgical.com"><img src="<?php echo base_url(); ?>assets/img/usa.jpg" alt="US flag" /></a></li>
				<li class="sp"><a href="http://www.intersurgical-es.com"><img src="<?php echo base_url(); ?>assets/img/sp.jpg" alt="ES flag" /></a></li>
				<!-- my localisation link... -->
				<li class="jp"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/jp.jpg" alt="JP flag" /></a></li>
				<li class="close" id="int_close"><a href="#"><img src="<?php echo base_url(); ?>assets/img/close.jpg" alt="Close button" /></a></li>
			</ul>
		</div>
		<div style="height: 1px"></div>
		<div id="wrapper">
				<div id="header">
					<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/header_logo.jpg" class="logo" /></a>
					<p>呼吸ケアの品質、革新性と選択肢</p>
			        <div id="social_bar" >
			          <a href="https://twitter.com/intersurgical" target="_blank"><img src="<?php echo base_url(); ?>assets/img/twitter_logo.png" /></a>
			          <a href="http://www.facebook.com/Intersurgical" target="_blank"><img src="<?php echo base_url(); ?>assets/img/facebook_logo.png" /></a>
			          <a href="http://www.youtube.com/intersurgical" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube_logo.png" /></a>
			        </div>
					<span id="choose_country">選択の国</span>
				</div>

				<div id="navigation">
					<ul class="buttons">
						<li class="first"><a href="<?php echo base_url(); ?>">自宅</a></li>
						<li class="submenu"><a href="<?php echo base_url(); ?>index.php/news">便り</a>
							<div class="sub">
								<a href="<?php echo base_url(); ?>index.php/events">催し物</a>
							</div>
						</li>
						<li class="submenu"><a href="<?php echo base_url(); ?>index.php/productList">製品</a>
							<div class="sub">
								<a href="<?php echo base_url(); ?>index.php/productSample">気道確保</a>
								<a href="<?php echo base_url(); ?>index.php/productSample">麻酔</a>
								<a href="<?php echo base_url(); ?>index.php/productSample">救命救急</a>
								<a href="<?php echo base_url(); ?>index.php/productSample">酸素療法</a>
								<a href="<?php echo base_url(); ?>index.php/productSample">エアロゾル療法</a>
							</div>
						</li>
						<!-- dead links for education and support pages -->
						<li class="submenu"><a href="#">教育</a></li>
						<li class="submenu"><a href="#">サポート</a></li>
						<li class="submenu"><a href="<?php echo base_url(); ?>index.php/about">約</a></li>
						<li class="submenu"><a href="<?php echo base_url(); ?>index.php/contact">連絡</a></li>
					</ul>
					<div id="search"> 
						<label for="query">製品検索</label>
						<input type="text" id="query" value="入力を開始" /> <div id="deleteDIV"></div> 
						<div id="searchDIV"></div>	
					</div>
				</div><!-- end #navigation -->