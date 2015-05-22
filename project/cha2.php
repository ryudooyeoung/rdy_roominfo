
<?
	/* mysql DBconnection 
	$mysql_host = 'localhost';
	$mysql_user = 'ruydoo0711';
	$mysql_password = 'fbendud89';
	$mysql_db = 'ruydoo0711';


	$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	mysqli_query($mysqli, 'set names utf8');
*/


	/* query submint */

	if(isset($_POST['submit']))
	{
		$deposit = $_POST['deposit'];
		$depositop = $_POST["depositop"];
		$monthlyrent = $_POST["monthlyrent"];
		$monthlyrentop = $_POST["monthlyrentop"];
		$urgas = $_POST["gas"];
		$miele = $_POST["miel"];
		$air = $_POST["aircon"];
 

		$prequery = $_POST["query"];
		$byresult = $_POST["byresult"];
	}

		echo "deposit" . $_POST["deposit"] ."<br>";
		echo "depositop" . $_POST["depositop"]."<br>";
		echo "monthlyrent" . $_POST["monthlyrent"]."<br>";
		echo "monthlyrentop" . $_POST["monthlyrentop"]."<br>";

		echo "gas" . $_POST["gas"]."<br>";
		echo "miel" . $_POST["miel"]."<br>";
		echo "aircon" . $_POST["aircon"]."<br>";
		echo "prequery" . $_POST["query"]."<br>";
		echo "byresult" . $_POST["byresult"]."<br>";
		
		
/*
  class Emp {
       public $x = "";
       public $y  = "";
       public $address = "";
	   public $name ="";
   }

	$e =array();
	$x =0;
   for($x=0 ; $x<10 ; $x++){

	   $e[$x] = new Emp();
	   $e[$x]->x = $x;
	   $e[$x]->y  = $x;
		$e[$x]->address  = "sports".$x;
		$e[$x]->name  = "sports".$x;
   }

$json = json_encode($e);
echo $json;
echo "<br><br>";

$decode = json_decode($json, true);


foreach($decode as $key => $value){
	echo $value['name']."<br>";
}



$json_data['r'][0] = array("d"=>"8080","n"=>"1");
$json_data['r'][2] = array("d"=>"8082","n"=>"3");

$json2 = json_encode($json_data);
echo $json2;
echo "<br><br>";

$decode = json_decode($json2, true);
$array = $decode['r'];

foreach($array as $key => $value){
	echo $value['d']."<br>";
	echo $value['n']."<br><br>";
}
 */


 
 
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
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
html, body {margin: 0; padding: 0;  height: 100%}
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
<!--axisj progress bar javascript
<script type="text/javascript" src="/js/AXProgress_start.js"></script>-->

 
<script type="text/javascript" src="//101.livere.co.kr/js/livere8_lib.js" charset="utf-8"></script>



<!--DAUM맵을 관리하는 부분-->
<script type="text/javascript">

/*
var myProgress = new AXProgress();

var fnObj = {
		progress: {
			start: function(){
			mask.open();
			myProgress.start(function(){
				//trace(this);
				if(this.isEnd){
					myProgress.close();
					mask.close();
					toast.push('검색 결과 : '+c);
				}else{
					// 무언가 처리를 해줍니다.	대부분 비동기 AJAX 통신 처리 구문을 수행합니다.
					myProgress.update(); // 프로그레스의 다음 카운트를 시작합니다.
				}	
			}, 
			{
				totalCount:15,
				width:200, 
				top:200, 
				title:"Set Options Type Progress"
			});
		} 
	}
};

$(document.body).ready(function(){
	fnObj.progress.start();
});

*/


	//변수 설정 및 최초 위치 설정
	var map;
	var position = new daum.maps.LatLng(37.88404187986277, 127.73779386404715);
	var infowindow_c = new Array();
	var infowindow = new Array();
	var marker = new Array();

	var c=0;

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
 


session_start();
$_SESSION["query"];


 require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


	$params = array();
	$params['tablename'] = "roominfotest";


	if(isset($_POST['submit']))
	{

	

 		$deposit = $_POST['deposit'];
		$depositop = $_POST["depositop"];
		$monthlyrent = $_POST["monthlyrent"];
		$monthlyrentop = $_POST["monthlyrentop"];
		$urgas = $_POST["gas"];
		$miele = $_POST["miel"];
		$air = $_POST["aircon"];
 

		$prequery = $_POST["query"];
		$byresult = $_POST["byresult"];

		if($byresult==1){ 
			$params['tablename'] ="(" . $prequery . ") as t";
		}

		if($depositop!=3){
			switch($depositop){
				case 0: $depositop = "<="; break;
				case 1: $depositop = ">="; break;
				case 2: $depositop = ""; break;
			}

			switch($monthlyrentop){
				case 0: $monthlyrentop = "<="; break;
				case 1: $monthlyrentop = ">="; break;
				case 2: $monthlyrentop = ""; break;
			}


 
		$params['deposit'] = $deposit;
		$params['depositop'] = $depositop;
		$params['monthlyrent'] = $monthlyrent;
		$params['monthlyrentop'] = $monthlyrentop;
		}//end of if

		if($gas!=3){
			switch($gas){
				case 0: $gas = "0"; break;
				case 1: $gas = "1"; break;
				case 2: $gas = ""; break;
			}

			switch($miel){
				case 0: $miel = "0"; break;
				case 1: $miel = "1"; break;
				case 2: $miel = ""; break;
			}

			switch($aircon){
				case 0: $aircon = "0"; break;
				case 1: $aircon = "1"; break;
				case 2: $aircon = ""; break;
			}




 
		$params['gas'] = $gas;
		$params['miel'] = $miel;
		$params['aircon'] = $aircon;

		}//end of if

 

		$allCountries = $fpBatis->doSelect('Roominfos.selectCon',$params);

	}
	else{

		$allCountries = $fpBatis->doSelect('Roominfos.selectAll');

	}

 

    class Emp {
       public $x = "";
       public $y  = "";
       public $address = "";
	   public $name ="";
   }

	$e =array();
	$x=0;
foreach ($allCountries as $row) {

	   $e[$x++] = new Emp();
	   $e[$x++]->x = $row["x"];
	   $e[$x++]->y  = $row["y"];
		$e[$x++]->address  =$row["address"];
		$e[$x++]->name  = $row["name"];
   }

$json = json_encode($e);

$decode = json_decode($json, true);
 
 /*
foreach($decode as $key => $value){
	echo $value['name'];
	printf("\n");
}
*/


/*
$params = array();
$params['deposit'] = 100;
$params['depositop'] = "<=";
$params['monthlyrent'] = 30;
$params['monthlyrentop'] = "<=";*/

//$allCountries = $fpBatis->doSelect('Roominfos.selectCon',$params);

 


	/*
		if(isset($_POST['submit'])){
			$query = "SELECT * FROM roominfo2 where deposit <=100";
		}
		else{

			$query = "SELECT * FROM roominfo2";
		}



		$result = $mysqli->query($query);

		while($row = $result->fetch_array(MYSQLI_ASSOC)){ */


foreach ($allCountries as $row) {
			//printf("\t\t getPoint('%s'); \n", $row["address"]);
 
			$i = $row["room_id"];

			//맵위에 마크표시 좌표값
			printf("\t\t marker[%d] = new daum.maps.Marker({position: new daum.maps.LatLng(%s, %s)}); \n",$i, $row["x"], $row["y"]);
			printf("\t\t marker[%d].setMap(map); \n",$i);
			printf("\n");
			
			//클릭 윈포윈도우 표시
			printf("\t\t infowindow_c[%d] = new daum.maps.InfoWindow({ content:' <button id=\"btn_info%d\" class=\"btn btn-primary\" data-toggle=modal data-target=#myModal%d  style=\"width:150px\" " ,$i,$i,$i);
			printf("onclick=\"add_tab_content({ idx : \'%s\', x : \'%s\' , y : \'%s\' , addr : \'%s\' });\">%s</button>'});\n",$i ,$row["x"] , $row["y"],  $row["address"], $row["name"]);

			printf("\n");
		
			//마우스오버 인포윈도우 내용추가
			printf("\t\t infowindow[%d] = new daum.maps.InfoWindow({ content:' <button  class=\"btn btn-primary\" data-toggle=modal data-target=#myModal%d style=\"width:150px\">%s</button>' });\n",$i,$i,$row["name"] );
			printf("\n");

			//각각의 마커에 이벤트 추가
			printf("\t\t daum.maps.event.addListener(marker[%d], 'click', function() { infowindow_c[%d].open(map, marker[%d]); }); \n",$i,$i,$i);
			printf("\t\t daum.maps.event.addListener(map, 'click', function() { infowindow_c[%d].close();}); \n",$i);
			printf("\t\t daum.maps.event.addListener(marker[%d], 'mouseover', function() { infowindow[%d].open(map, marker[%d]); }); \n",$i,$i,$i);
			printf("\t\t daum.maps.event.addListener(marker[%d], 'mouseout', function() { infowindow[%d].close();}); \n",$i,$i);
			printf("\n");

			//sidebar 내용추가
			printf("\t\t$(\"#slidecontent\").append('");
			printf("<a href=\"#\" onmouseover=\"mouseover_infowindow({ idx : \'%s\', x : \'%s\' , y : \'%s\' })\" onclick=\"click_infowindow({ idx : \'%s\', x : \'%s\' , y : \'%s\' , addr : \'%s\' });\">",$i,$row["x"] , $row["y"], $i ,$row["x"] , $row["y"],  $row["address"]);
			printf("%s</a><br><div class=\"sub_content\">보증금 : %s 월세 : %s</div><br>", $row["name"], $row["deposit"], $row["monthlyrent"]);
			printf("'); \n\n");

			//roominfo modal생성
			printf("$(\"#roominfo_modal\").append('<div id=\"myModal%d\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\" style\"z-index:999\">",$i);
			printf("  <div class=\"modal-dialog\">");
			printf("		<div class=\"modal-content\">");
			printf("		  <div class=\"modal-header\">");
			printf("			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>");
			printf("			<h4 class=\"modal-title\" id=\"myModalLabel\">Modal Heading</h4>");
			printf("		  </div>");


			printf("		  <div id=\"roominfo_modal_content\" class=\"modal-body\">");
			printf("			<div id=\"testtab%d\"></div>",$i,$i);
			printf("				%d , %s </br>", $i, $row["name"]);		
		//	printf("				<div id=\"roominfo_roadview%d\"   ></div>",$i);
			printf("		  </div>");


			printf("		  <div class=\"modal-footer\">");
			printf("		<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button> ");
			printf("			<button type=\"button\" class=\"btn btn-primary\">Save changes</button> &nbsp;");
			printf("		<a href=\"#\" ><span class=\"glyphicon glyphicon-wrench\">수정</span></a>");
			printf("		  </div>");
			printf("		</div><!-- /.modal-content -->");
			printf("	  </div><!-- /.modal-dialog -->");
			printf("	</div><!-- /.modal -->')");

			printf("\n\n");  

		
			printf("c++;");
			}
//$result->free();
		?>
 
	}	





	function click_infowindow(arg){
		//$.pageslide.close();
		$('#myModal'+arg.idx).modal('show');
		add_tab_content(arg);
	}


	var preflag;
	function mouseover_infowindow(arg){

		map.panTo(new daum.maps.LatLng(arg.x, arg.y));

		infowindow_c[arg.idx].open(map,marker[arg.idx]);

		if(preflag!=null){
			 
			if(preflag!=arg.idx){
				infowindow_c[preflag].close(map,marker[preflag]);
			}
		}

		preflag=arg.idx;

	}


	function opensidebar(){

		$.pageslide({ direction: 'left', modal: true, href: '#slidecontent' });
		$('#pageslide').prepend('<center style=\"padding-bottom:5px\"><button  class=\"btn btn-primary\" onclick=\"javascript:$.pageslide.close();\"> CLOSE </button></br>검색결과 : '+c+'</center>');
	}
  
	 //ajax login
	 $(function() {
	//twitter bootstrap script
		$("button#login_submit").click(function(){
			$.ajax({
			type: "POST",
			url: "process.php",
			data: $('form.contact').serialize(),
				success: function(msg){
					$("#thanks").html(msg);
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

 
	function add_tab_content( arg ){

		$("#testtab"+arg.idx).html("<ul id=\"myTab"+arg.idx+"\" class=\"nav nav-tabs\">"+
        "<li class=\"active\"><a href=\"#info"+arg.idx+"\" data-toggle=\"tab\">방정보</a></li>"+
        "<li><a href=\"#eval"+arg.idx+"\" data-toggle=\"tab\" >평가&게시판</a></li></ul>"+
		"<div id=\"myTabContent\" class=\"tab-content\">"+
			"<div class=\"tab-pane fade in active\" id=\"info"+arg.idx+"\">"+
			"<div>"+arg.addr+"</div>"+
			"<div id=\"roominfo_roadview"+arg.idx+"\"   ></div> </div>"+
       " <div class=\"tab-pane fade\" id=\"eval"+arg.idx+"\">게시판 </div>");

		//addroadview
		$("#roominfo_roadview"+arg.idx).html("<iframe src=\"roadview.html?x="+arg.x+"&y="+arg.y+"\" scrolling=\"no\" frameborder=\"0\"  id=\"road_view"+arg.idx+"\" width=\"100%\" ></iframe>");

		$("#eval"+arg.idx).html("<iframe src=\"livere.php?idx="+arg.idx+"\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"500px\" ></iframe>");

	}
 
 
 

</script>






</head>



<body onload="init()">

  




<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px;">

 <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav navbar-right">

	<li class="active"><a href="./cha2.php"><span class="glyphicon glyphicon-refresh"> RESET</span></a></li>
	<li ><a href="javascript:void(0)" onclick="opensidebar();" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		<span class="glyphicon glyphicon-list"> LIST</span></a></li>
	<li><a href="#" data-toggle="modal" data-target="#moneysearch"><span class="glyphicon glyphicon-search"> 금액검색</span></a></li>
	<li><a href="#" data-toggle="modal" data-target="#consearch"><span class="glyphicon glyphicon-search"> 조건검색</span></a></li>
	<li id="thanks"><a href="#" data-toggle="modal" data-target="#loginmodal" ><span class="glyphicon glyphicon-log-in"> 로그인</span></a></li>
</ul>

</div><!-- /.navbar-collapse -->
</nav>

 


<!-- Map -->
<div id = "map"></div>
 
<!--side bar -->
<div id="slidecontent" style="height:100%; overflow-x:hidden; overflow-y:scroll; padding-top:10px; padding-bottom:30px"></div>

<!-- 내용정보를 출력하는 MODAL-->
<div id="roominfo_modal"></div>


 
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
 
		<button class="btn btn-success" id="login_submit">submit</button>
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
 

 			<form id="moneyform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<table class="table table-striped">
				<tr>
				<td>
				<div class="row">
					<div class="col-xs-6">
						<center><h5>보증금</h5></center>
						<select  id="depositop" name="depositop" class="form-control">
							<option value="0" SELECTED>이하</option>
							<option value="1" >이상</option>
							<option value="2" ><font size=2>조건없음</option>
						</select>

						<input type="text" id="deposit" name="deposit" class="form-control" placeholder="Text input" >  

					</div><!-- /.col-lg-6 -->
				 
					<div class="col-xs-6">
						<center><h5>월세</h5></center>
						<select   id="monthlyrentop" name="monthlyrentop" class="form-control">
							<option value="0" SELECTED>이하</option>
							<option value="1" >이상</option>
							<option value="2" ><font size=2>조건없음</option>
						</select>

						<input type="text" id="monthlyrent" name="monthlyrent" class="form-control" placeholder="Text input">

					</div> 

				</td>
				</tr>

				<tr>
				<td>
					<div class="col-xs-12">
						<center>
						<label>
						  <input type="checkbox" name="byresult" value="1"> 결과 내 재검색
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" name="submit" class="btn btn-default">OK</button>
						</center>
					</div>
				</td>
				</tr>
				</table>
					<input type="hidden" name="gas" value="3">
					<input type="hidden" name="miel" value="3">
					<input type="hidden" name="aircon" value="3">
					<input type="hidden" name="query" value="<? echo $_SESSION['query']; ?>" >
				</form>

 
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
// <![CDATA[
jQuery( function($) { // HTML 문서를 모두 읽으면 포함한 코드를 실행

	
	// 정규식을 변수에 할당
	// 정규식을 직접 작성할 줄 알면 참 좋겠지만
	// 변수 우측에 할당된 정규식은 검색하면 쉽게 찾을 수 있다 
	// 이 변수들의 활약상을 기대한다
	// 변수 이름을 're_'로 정한것은 'Reguar Expression'의 머릿글자
	var re_id = /^[0-9]/; // 아이디 검사식
	
	// 선택할 요소를 변수에 할당
	// 변수에 할당하지 않으면 매번 HTML 요소를 선택해야 하기 때문에 귀찮고 성능에도 좋지 않다
	// 쉼표를 이용해서 여러 변수를 한 번에 선언할 수 있다
	// 보기 좋으라고 쉼표 단위로 줄을 바꿨다 
	var 
		form = $('#moneyform'), 
		uid = $('#deposit');

		
	// 선택한 form에 서밋 이벤트가 발생하면 실행한다
	// if (사용자 입력 값이 정규식 검사에 의해 참이 아니면) {포함한 코드를 실행}
	// if 조건절 안의 '정규식.test(검사할값)' 형식은 true 또는 false를 반환한다
	// if 조건절 안의 검사 결과가 '!= true' 참이 아니면 {...} 실행
	// 사용자 입력 값이 참이 아니면 alert을 띄운다
	// 사용자 입력 값이 참이 아니면 오류가 발생한 input으로 포커스를 보낸다
	// 사용자 입력 값이 참이 아니면 form 서밋을 중단한다

	
 

	form.submit( function() {
	if( $('#depositop').val() !=2){
		if (re_id.test(uid.val()) != true) { // 아이디 검사
			alert('[ID 입력 오류] 유효한 ID를 입력해 주세요.');
			uid.focus();
			return false;
		} else if (uid.val() <= 0) { // 입력 값이 3보다 작을 때
			alert('0보다 적음');
			uid.focus();
			return false;
		}
	}
	});
	
	


	// #uid, #upw 인풋에 입력된 값의 길이가 적당한지 알려주려고 한다
	// #uid, #upw 다음 순서에 경고 텍스트 출력을 위한 빈 strong 요소를 추가한다
	// 무턱대고 자바스크립트를 이용해서 HTML 삽입하는 것은 좋지 않은 버릇
	// 그러나 이 경우는 strong 요소가 없어도 누구나 form 핵심 기능을 이용할 수 있으니까 문제 없다
	$('#deposit').after('<strong></strong>');
	
	// #uid 인풋에서 onkeyup 이벤트가 발생하면
	uid.keyup( function() {
		var s = $(this).next('strong'); // strong 요소를 변수에 할당
		if (uid.val().length == 0) { // 입력 값이 없을 때
			s.text(''); // strong 요소에 포함된 문자 지움
		} else if (uid.val() <= 0) { // 입력 값이 3보다 작을 때
			s.text('0보다 적음.'); // strong 요소에 문자 출력
		}  else { // 입력 값이 3 이상 16 이하일 때
			s.text('적당해요.'); // strong 요소에 문자 출력
		}
	});
 	 

});


// ]]>
</script>




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
							<label> <input type="radio" name="gas" value="0"><font size="2">없음 &nbsp; </label>
							<label> <input type="radio" name="gas" value="1" checked><font size="2">있음 &nbsp; </label>
							<label> <input type="radio" name="gas" value="2"  ><font size="2">조건없음 &nbsp; </label>

						</div><!-- /.col-lg-6 -->
					</tr>
					</td> 

					<tr>
					<td align='center'>
						<div class="col-xs-12">
							<label class="col-xs-12 control-label">심야전기</label>
							<label> <input type= "radio" name="miel" value="0"><font size="2">없음 &nbsp;</label>
							<label> <input type= "radio" name="miel" value="1" checked><font size="2">있음 &nbsp;</label>
							<label> <input type= "radio" name="miel" value="2"  ><font size="2">조건없음 &nbsp;</label>
						</div> 
					</td>
					</tr>

					<tr>
					<td align='center'>

						<div class="col-xs-12">
							<label class="col-xs-12 control-label">에어컨</label>
							<label> <input type= "radio" name="aircon"  value="0"><font size="2">없음 &nbsp; </label>
							<label> <input type= "radio" name="aircon"  value="1" checked><font size="2">있음 &nbsp; </label>
							<label> <input type= "radio" name="aircon"  value="2"  ><font size="2">조건없음 &nbsp; </label>


						</div><!-- /.col-lg-6 -->
					</td>
					</tr>

					<tr>
					<td>
						<div class="col-xs-12">
							<center>
							<label>
							  <input type="checkbox" name="byresult" value="1"> 결과 내 재검색
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							<button type="submit" name="submit" class="btn btn-default">OK</button>
							</center>
						</div>
					</td>
					</tr>
					</table>
					<input type="hidden" name="deposit" value="3">
					<input type="hidden" name="monthlyrent" value="3">
					<input type="hidden" name="depositop" value="3">
					<input type="hidden" name="monthlyrentop" value="3">
					<input type="hidden" name="query" value="<? echo "$query"; ?>" >
				</form>
 
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->















 
<!-- infomation modal-->
<script type="text/javascript">
	$(function(){ 
		$('.tooltip-test').tooltip();  
	});
 
</script> 


 
 
<script src="/js/jquery.pageslide.js"></script>

 
 
<!--bootstrap-->
<script src="/js/bootstrap.min.js"></script>




    </body>
</html>
