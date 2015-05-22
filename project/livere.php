

<?php 
    $idx = $_REQUEST["idx"];
?>


<script type="text/javascript" src="//101.livere.co.kr/js/livere8_lib.js" charset="utf-8"></script>

 
	<div id="livereContainer" >
		<script type="text/javascript">
			var consumer_seq 	= "200";
			var livere_seq 		= "19427";
			var smartlogin_seq 	= "228";
			var title = "한림대학교원룸정보";
		var title = <?php echo "\"".$_SERVER["HTTP_HOST"]."\";\n"  ?>
		var refer =  <?php echo "\"" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]."\";\n"  ?>
			livereReply = new Livere( livere_seq , refer , title );
			livereLib.start();
		</script>
	</div>
 