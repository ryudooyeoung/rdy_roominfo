<meta charset="utf-8">
<?php

session_start();
$_SESSION["query"];
$_SESSION["search"]='true';

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);



if (isset($_POST['depositop']) && isset($_POST['gas'])) {
 
	$depositop = $_POST['depositop'];
	$deposit = $_POST['deposit'];
	$monthlyrentop = $_POST['monthlyrentop'];
	$monthlyrent = $_POST['monthlyrent'];
	$gas = $_POST['gas'];
	$miel = $_POST['miel'];
	$aircon = $_POST['aircon'];
	$byresult = $_POST['byresult'];
	$prequery = $_SESSION["query"]; 



	$params = array();
	$params['tablename'] = "roominfotest";


	//결과내 재검색 시 쿼리문 을 다시 쓰기위함
	if($byresult=='1'){ 
		$params['tablename'] ="(" . $prequery . ") as t";
	}

	//금액 검색
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


	//조건 검색
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



	$allCountries = $fpBatis->doSelectS('Roominfos.selectCon',$params);



	echo "<script id=\"sql\">";
	printf("c=0;");

	foreach ($allCountries as $row) {
				
		$i = $row["room_id"];

		//맵위에 마크표시 좌표값
		printf("\t\t marker[%d] = new daum.maps.Marker({position: new daum.maps.LatLng(%s, %s)}); \n",$i, $row["x"], $row["y"]);
		printf("\t\t marker[%d].setMap(map); \n",$i);
		printf("\n");
		
		//클릭 윈포윈도우 표시
		printf("\t\t infowindow_c[%d] = new daum.maps.InfoWindow({ content:' <button id=\"btn_info%d\" class=\"btn btn-primary\" data-toggle=modal data-target=#myModal%d  style=\"width:150px\" " ,$i,$i,$i);
		printf("onclick=\"add_tab_content({ room_id : \'%s\', x : \'%s\' , y : \'%s\' , addr : \'%s\' });\">%s</button>'});\n",$i ,$row["x"] , $row["y"],  $row["address"], $row["name"]);

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
		printf("\t\t$(\"#slidecontent\").append(' <div id=\"room_list%d\"> ",$i);
		printf("<a href=\"#\" onmouseover=\"mouseover_infowindow({ idx : \'%s\', x : \'%s\' , y : \'%s\' })\" onclick=\"click_infowindow({ room_id : \'%s\', x : \'%s\' , y : \'%s\' , addr : \'%s\' });\">",$i,$row["x"] , $row["y"], $i ,$row["x"] , $row["y"],  $row["address"]);
		printf("%s</a><br><div class=\"sub_content\">보증금 : %s 월세 : %s</div><br>", $row["name"], $row["deposit"], $row["monthlyrent"]);
		printf("</div> '); \n\n");

		//roominfo modal생성
		printf("$(\"#roominfo_modal\").append('<div id=\"myModal%d\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\" style\"z-index:999\">",$i);
		printf("  <div class=\"modal-dialog\">");
		printf("		<div class=\"modal-content\">");
		printf("		  <div class=\"modal-header\">");
		printf("			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>");
		printf("			<h4 class=\"modal-title\" id=\"myModalLabel%d\">Modal Heading</h4>",$i);
		printf("		  </div>");


		printf("		  <div id=\"roominfo_modal_content\" class=\"modal-body\">");
		printf("			<div id=\"testtab%d\"></div>",$i,$i);
		printf("		  </div>");


		printf("		  <div class=\"modal-footer\">");
		printf("			<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button> &nbsp;");
		printf("			<a id=\"addlist%d\"  href=\"#\" onclick=\"addlist(%s);\" ><span class=\"glyphicon glyphicon-thumbs-up\"> 찜하기</span></a>", $i,$i);
		printf("		  </div>");
		printf("		</div><!-- /.modal-content -->");
		printf("	  </div><!-- /.modal-dialog -->");
		printf("	</div><!-- /.modal -->')");
		printf("\n\n");  

		printf("c++;");
			 

	 }

 
	if($_SESSION['member_id']!=null && $_SESSION['admin']=="true"){
		echo "update_manage('".$_SESSION['member_id']."');";
	}
	elseif($_SESSION['member_id']!=null ){
		echo "update_basket('".$_SESSION['member_id']."');";
	}

	echo "</script>";
}
else{

	$allCountries = $fpBatis->doSelectS('Roominfos.selectAll');



	echo "<script id=\"sql\">";
	printf("c=0;");

	foreach ($allCountries as $row) {
				
		$i = $row["room_id"];

		//맵위에 마크표시 좌표값
		printf("\t\t marker[%d] = new daum.maps.Marker({position: new daum.maps.LatLng(%s, %s)}); \n",$i, $row["x"], $row["y"]);
		printf("\t\t marker[%d].setMap(map); \n",$i);
		printf("\n");
		
		//클릭 윈포윈도우 표시
		printf("\t\t infowindow_c[%d] = new daum.maps.InfoWindow({ content:' <button id=\"btn_info%d\" class=\"btn btn-primary\" data-toggle=modal data-target=#myModal%d  style=\"width:150px\" " ,$i,$i,$i);
		printf("onclick=\"add_tab_content({ room_id : \'%s\', x : \'%s\' , y : \'%s\' , addr : \'%s\' });\">%s</button>'});\n",$i ,$row["x"] , $row["y"],  $row["address"], $row["name"]);
		

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
		printf("\t\t$(\"#slidecontent\").append(' <div id=\"room_list%d\"> ",$i);
		printf("<a href=\"#\" onmouseover=\"mouseover_infowindow({ idx : \'%s\', x : \'%s\' , y : \'%s\' })\" onclick=\"click_infowindow({ room_id : \'%s\', x : \'%s\' , y : \'%s\' , addr : \'%s\' });\">",$i,$row["x"] , $row["y"], $i ,$row["x"] , $row["y"],  $row["address"]);
		printf("%s</a><br><div class=\"sub_content\">보증금 : %s 월세 : %s</div><br>", $row["name"], $row["deposit"], $row["monthlyrent"]);
		printf("</div> '); \n\n");

		//roominfo modal생성
		printf("$(\"#roominfo_modal\").append('<div id=\"myModal%d\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\" style\"z-index:999\">",$i);
		printf("  <div class=\"modal-dialog\">");
		printf("		<div class=\"modal-content\">");
		printf("		  <div class=\"modal-header\">");
		printf("			<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>");
		printf("			<h4 class=\"modal-title\" id=\"myModalLabel%d\">Modal Heading</h4>",$i);
		printf("		  </div>");


		printf("		  <div id=\"roominfo_modal_content\" class=\"modal-body\">");
		printf("			<div id=\"testtab%d\"></div>",$i,$i);
		printf("		  </div>");


		printf("		  <div class=\"modal-footer\">");
		printf("			<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button> &nbsp;");
		printf("			<a id=\"addlist%d\"  href=\"#\" onclick=\"addlist(%s);\" ><span class=\"glyphicon glyphicon-thumbs-up\"> 찜하기</span></a>", $i,$i);
		printf("		  </div>");
		printf("		</div><!-- /.modal-content -->");
		printf("	  </div><!-- /.modal-dialog -->");
		printf("	</div><!-- /.modal -->')");
		printf("\n\n");  

		printf("c++;");
			 
	 }


	echo "</script>";

}

?>