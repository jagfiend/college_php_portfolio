<link href="<?php echo base_url(); ?>assets/css/sales.css" rel="stylesheet" type="text/css" />
<div id="content" class="clear sales">			
	<div id="intro">
		<h1>お問い合わせ。下記の簡単なフォームに記入</h1>
		<p>当社の製品にご関心をお寄せいただきありがとうございます。お問い合わせは、お近くのIntersurgicalの担当者に直接移動します。我々は、できるだけ早く対応させていただきます。</p>
	</div>
	<div id="left">
		<div id="map">
			<img src="<?php echo base_url(); ?>assets/img/japmap.jpg" alt="Intersurgical in Japan!"> 
		</div>	
	</div><!-- End left -->
		
	<div id="right">
		<div id="datafield">
			<div class="person" style="background-color: rgb(245, 241, 184); ">
				<h2>Intersurgical日本</h2>
				<p>
					<a class="email" href="mailto:info@intersurgical.com">info@intersurgical.com</a>
				</p>
				<p class="phone">+81 (0) 03-6809-2046</p>
				<p class="address">
					〒105-0001<br>
					東京都港区<br>
					4-1-21虎ノ門<br>
					駒橋第二ビル3F<br>
				</p>
			</div>
		</div>
		<div class="contact_form">
			<form id="contact" method="post" action="http://www.intersurgical.co.uk/thankyou">
				<input type="hidden" id="section" name="section" value="0">	
				<p>
					<label for="nev">名前</label>
					<input class="text required" type="text" name="nev" id="nev">
				</p>
			    <p>
			    	<label for="uzenet">Eメール</label>
			    	<input class="text required email" type="text" name="uzenet" id="uzenet" value="">
			    </p>
				<p>
					<label for="jobtitle">職名</label>
			    	<input class="text" type="text" name="jobtitle" id="jobtitle" value="">
			    </p>
				<p>
					<input class="text" type="text" name="name" id="name" value="">
				</p>
				<p>
					<label for="org">会社</label>
			    	<input class="text required" type="text" name="org" id="org" value="">
			    </p>
				<p>
					<label for="enquiry">お問い合わせ</label>
			    	<textarea name="enquiry" class="required"></textarea>
			    </p>
				<input type="submit" name="button" id="send" value="送り届ける" class="light_blue awesome_button">
			</form>
		</div>
	</div>
</div><!-- end #content -->	
</div>
<!-- end #wrapper -->
<div id="popupbox"></div>
</div>
<!-- end #top -->
<div id="wrapper_bottom">