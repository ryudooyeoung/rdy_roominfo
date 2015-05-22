
<?
	/* mysql DBconnection */
	$mysql_host = 'localhost';
	$mysql_user = 'ruydoo0711';
	$mysql_password = 'fbendud89';
	$mysql_db = 'ruydoo0711';


	$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	mysqli_query($mysqli, 'set names utf8');



	/* query submint */
	if(isset($_POST['submit']))
	{
		$deposit = $_POST['deposit'];
		$txtdeposit = $_POST["txtdeposit"];
		$monthly = $_POST["monthly"];
		$txtmonthly = $_POST["txtmonthly"];
		$urgas = $_POST["urgas"];
		$miele = $_POST["miele"];
		$air = $_POST["air"];
		$mas = $_POST["mas"];


		echo "deposit" . $_POST["deposit"] ."<br>";
		echo "txtdeposit" . $_POST["txtdeposit"]."<br>";
		echo "monthly" . $_POST["monthly"]."<br>";
		echo "txtmonthly" . $_POST["txtmonthly"]."<br>";

		echo "urgas" . $_POST["urgas"]."<br>";
		echo "miele" . $_POST["miele"]."<br>";
		echo "air" . $_POST["air"]."<br>";

	}
?>

<!DOCTYPE html>
<html>
<head>

<title>지도 검색</title>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta property="og:image" content="/img/axisj_sns.png" /> 
<meta property="og:site_name" content="Axis of Javascript - axisj.com" /> 
<meta property="og:description" id="meta_description" content="Javascript UI Library based on JQuery" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />


<!--jquery import-->
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<!--daum map api-->
<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=8474d18375c82c862db9c1e4988d7f4ad068bf79" charset="utf-8"></script>




<!-- css block -->
<style type="text/css">
html, body {margin: 0; padding: 0; width: 100%; height: 100%}
</style>

<!--side bar-->
<link rel="stylesheet" type="text/css" href="/css/jquery.pageslide.css" />
 



<!-- 부트스트랩 -->
<link rel="stylesheet" href="/css/bootstrap.min.css"  media="screen">
<link rel="stylesheet" href="/css/roomtable.css" type="text/css"/>
<link rel="stylesheet" href="/css/roompopup.css" type="text/css"/>

<!-- axisj -->
<link rel="stylesheet" type="text/css" href="/_AXJ/ui/default/AXJ.css" />
<link rel="stylesheet" type="text/css" href="/_AXJ/ui/default/AXButton.css" />
<link rel="stylesheet" type="text/css" href="/_AXJ/ui/default/AXProgress.css" />
 
<!-- js block -->
<script type="text/javascript" src="/_AXJ/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/_AXJ/lib/AXJ.js"></script>
<script type="text/javascript" src="/_AXJ/lib/AXProgress.js"></script>
<script type="text/javascript" src="/_AXJ/lib/AXCodeView.js"></script>
<!--axisj progress bar javascript-->
<script type="text/javascript" src="/js/AXProgress_start.js"></script>

 




<!--DAUM맵을 관리하는 부분-->
<script>
	//변수 설정 및 최초 위치 설정
	var map;
	var position = new daum.maps.LatLng(37.88404187986277, 127.73779386404715);


	function init() {
							//지도 초기화
		map = new daum.maps.Map(document.getElementById('map'), {
			center: position,
			level: 4,
			mapTypeId: daum.maps.MapTypeId.ROADMAP
		});
 
 

		//PHP를 이용하여 DB 쿼리
		//결과를 JAVASCRIPT로 출력
		<?php
		$query = "SELECT * FROM roominfo2";
		$result = $mysqli->query($query);

		$i=0;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			//printf("\t\t getPoint('%s'); \n", $row["address"]);
			
			//맵위에 마크표시 좌표값
			printf("\t\t var marker%d = new daum.maps.Marker({position: new daum.maps.LatLng(%s, %s)}); \n",$i, $row["x"], $row["y"]);
			printf("\t\t marker%d.setMap(map); \n",$i);

			
			//맵위에 윈포윈도우 표시
			printf("\t\t var infowindow_c%d = new daum.maps.InfoWindow({ content:' <button class=\"btn btn-primary\" data-toggle=modal data-target=#myModal  style=\"width:150px\">%s</button>'});\n",$i,$row["name"] );

			
			//각각의 마커에 이벤트 추가
			printf("\t\t daum.maps.event.addListener(marker%d, 'click', function() { infowindow_c%d.open(map, marker%d); }); \n",$i,$i,$i);
			printf("\t\t daum.maps.event.addListener(map, 'click', function() { infowindow_c%d.close();}); \n",$i,$i);
			printf("\t\t daum.maps.event.addListener(marker%d, 'mouseover', function() { infowindow%d.open(map, marker%d); }); \n",$i,$i,$i);
			printf("\t\t daum.maps.event.addListener(marker%d, 'mouseout', function() { infowindow%d.close();}); \n",$i,$i);
	

			//윈포윈도우에 내용추가
			printf("\t\t var infowindow%d = new daum.maps.InfoWindow({ content:' <button  class=\"btn btn-primary\" data-toggle=modal data-target=#myModal style=\"width:150px\">%s</button>' });\n",$i,$row["name"] );

			
			printf( "$(\"#slidecontent\").append('방이름: %s </br>'); \n" , $row["name"]);
 
			printf("\n\n");
			$i++;
			}

		$result->free();
		?>



		

	}	
</script>

 

 

</head>



<body onload="init()">

  


<!--side bar -->
<div id="slidecontent" style="height:100%; overflow-x:hidden; overflow-y:scroll">
 
</div>



<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px;">
 
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav navbar-right">

	<li class="active"><a href="#"><span class="glyphicon glyphicon-refresh"> RESET</span></a></li>
	<li ><a href="javascript:$.pageslide({ direction: 'left', href: '#slidecontent' })" >
		<span class="glyphicon glyphicon-list"> LIST</span></a></li>
	<li><a href="#" data-toggle="modal" data-target="#moneysearch"><span class="glyphicon glyphicon-search"> 금액검색</span></a></li>
	<li><a href="#" data-toggle="modal" data-target="#consearch"><span class="glyphicon glyphicon-search"> 조건검색</span></a></li>
	<li id="thanks"><a href="#" data-toggle="modal" data-target="#loginmodal" ><span class="glyphicon glyphicon-log-in"> 로그인</span></a></li>
</ul>

</div><!-- /.navbar-collapse -->
</nav>





<!-- Map -->
<div id = "map"></div>






<!-- 내용정보를 출력하는 MODAL-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
	  </div>

	  <div class="modal-body">
		<h4>Text in a modal</h4>
		<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
		<p><input type="text"></p>

		<h4>Popover in a modal</h4>
		<p>This <a href="#" role="button" class="btn btn-default popover-test" title="A Title" data-content="And here's some amazing content. It's very engaging. right?">button</a> should trigger a popover on click.</p>

		<h4>Tooltips in a modal</h4>
		<p><a href="#" class="tooltip-test" title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="Tooltip">that link</a> should have tooltips on hover.</p>

		<hr>

		<h4>Overflowing text to show scroll behavior</h4>
		 
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary">Save changes</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->







 
<!-- login form MODAL-->

<div id="loginmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
	  </div>

 
		<form class="contact">
		<fieldset>
			<center>
			<div class="modal-body">

				<h4>ID</h4>
				<input class="input-xlarge" value=" krizna" type="text" name="id">
				<h4>PASSWD</h4>
				<input class="input-xlarge" value=" user@krizna.com" type="password" name="passwd">

			</div>
			</center>
		</fieldset>
		</form>


	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 
		<button class="btn btn-success" id="submit">submit</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- 금액검색 MODAL-->

<div id="moneysearch" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
	  </div>

 
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table class="table table-striped">
				<tr>
				<td>
				<div class="row">
					<div class="col-xs-6">
						<center><h5>보증금</h5></center>
						<select name="deposit" id="deposit" class="form-control">
							<option value=0 SELECTED>이하</option>
							<option value=1 >이상</option>
							<option value=2 ><font size=2>조건없음</option>
						</select>

						<input type="text" name="txtdeposit" id="txtdeposit" class="form-control" placeholder="Text input" value="0">

					</div><!-- /.col-lg-6 -->
				 
					<div class="col-xs-6">
						<center><h5>월세</h5></center>
						<select name="monthly" id="monthly" class="form-control">
							<option value=0 SELECTED>이하</option>
							<option value=1 >이상</option>
							<option value=2 ><font size=2>조건없음</option>
						</select>

						<input type="text" name="txtmonthly" id="txtmonthly" class="form-control" placeholder="Text input" value="0">

					</div> 

				</td>
				</tr>
				<tr>
				<td>

					<div class="col-xs-12">
						<center>
						<button type="submit" name="submit" class="btn btn-default">OK</button>
						</center>
					</div>
				</td>
				</tr>
				</table>
				<input type=hidden name=urgas value=3>
				<input type=hidden name=miele value=3>
				<input type=hidden name=air value=3>
				<input type=hidden name=mas value=3>
			</form>
 

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- 조건검색 MODAL-->

<div id="consearch" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
	  </div>

 
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

					<table class="table table-striped">
					<tr>
					<td align='center'>
						<div class="col-xs-12">
							<label class="col-xs-12 control-label">전기가스</label>
							<label> <input type= radio name=urgas value=0><font size=2>없음 &nbsp; </label>
							<label> <input type= radio name=urgas value=1 checked><font size=2>있음 &nbsp; </label>
							<label> <input type= radio name=urgas value=2  ><font size=2>조건없음 &nbsp; </label>

						</div><!-- /.col-lg-6 -->
					</tr>
					</td> 

					<tr>
					<td align='center'>
						<div class="col-xs-12">
							<label class="col-xs-12 control-label">심야전기</label>
							<label> <input type= radio name=miele value=0><font size=2>없음 &nbsp;</label>
							<label> <input type= radio name=miele value=1 checked><font size=2>있음 &nbsp;</label>
							<label> <input type= radio name=miele value=2  ><font size=2>조건없음 &nbsp;</label>
						</div> 
					</td>
					</tr>

					<tr>
					<td align='center'>

						<div class="col-xs-12">
							<label class="col-xs-12 control-label">에어컨</label>
							<label> <input type= radio name=air  value=0><font size=2>없음 &nbsp; </label>
							<label> <input type= radio name=air  value=1 checked><font size=2>있음 &nbsp; </label>
							<label> <input type= radio name=air  value=2  ><font size=2>조건없음 &nbsp; </label>


						</div><!-- /.col-lg-6 -->
					</td>
					</tr>

					<tr>
					<td>
						<div class="col-xs-12">
							<center>
							<button type="submit" name="submit" class="btn btn-default">OK</button>
							</center>
						</div>
					</td>
					</tr>
					</table>
					<input type=hidden name=txtdeposit value=3>
					<input type=hidden name=txtmonthly value=3>
					<input type=hidden name=deposit value=3>
					<input type=hidden name=monthly value=3>
				</form>
 
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->







<!-- login & logout -->

<script>
 $(function() {
//twitter bootstrap script
	$("button#submit").click(function(){
		$.ajax({
			type: "POST",
		url: "process.php",
		data: $('form.contact').serialize(),
			success: function(msg){
				  $("#thanks").html(msg)
				$("#loginmodal").modal('hide');	
			},
		error: function(){
			alert("failure");
			}
			});
	});
});

 

function logout(){
	 $("#thanks").html("<a href=\"#\" data-toggle=\"modal\" data-target=\"#loginmodal\" ><span class=\"glyphicon glyphicon-log-in\"> 로그인</span></a>");
}
</script>
 

 
<!-- infomation modal-->
<script type="text/javascript">
	$(function(){ 
		$('.tooltip-test').tooltip();  
	});
 
</script>



 
<script src="/js/jquery.pageslide.js"></script>

<script>
	/* Default pageslide, moves to the right */
	$(".first").pageslide();
	
	/* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
	$(".second").pageslide({ direction: "left", modal: true });
</script>


<!--bootstrap-->
<script src="/js/bootstrap.min.js"></script>

<!-- Respond.js 으로 IE8 에서 반응형 기능을 활성화하세요 (https://github.com/scottjehl/Respond) -->
<script src="/js/respond.js"></script>



    </body>
</html>
