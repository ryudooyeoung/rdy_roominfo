<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

$room_id = $_POST['room_id'];
 
		$result_rid = $fpBatis->doSelect('Roominfos.select', $room_id);

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		foreach( $result_rid as $rid ){

		echo "	
		<table class=\"table table-striped\">
		<tr><td>
		<a href=\"\" data-toggle=modal data-target=#myModal".$rid['room_id']. " ";
		printf("onclick=\"add_tab_content({ room_id : '%s', x : '%s' , y : '%s' , addr : '%s' });\" ><center><label for=\"inputPassword\" class=\"col-lg-12 control-label\">%s</label></center></a>",$rid['room_id'] ,$rid["x"] , $rid["y"],  $rid["address"],$rid['name']);
		echo "</td></tr>";	
			
		echo "<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">주소</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"address\" id=\"address\" value=\"".$rid['address']."\" /></div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">원룸이룸</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"name\" id=\"name\" value=\"".$rid['name']."\" /></div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">연락처</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"phone\" id=\"phone\" value=\"".$rid['phone']."\" /></div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">투룸 여부</label>
		<div class=\"col-lg-8\">
			 <div class=\"radio-inline\">
			  <label  >
				<input type=\"radio\" name=\"tworoom\" id=\"tworoom1\" value=\"0\" "; if($rid['tworoom']=="0"){echo "checked";} echo"> X </label>
			</div>
			<div class=\"radio-inline\">
			  <label >
				<input type=\"radio\" name=\"tworoom\" id=\"tworoom2\" value=\"1\" "; if($rid['tworoom']=="1"){echo "checked";} echo"> O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">복층 여부</label>
		<div class=\"col-lg-8\">
			 <div class=\"radio-inline\">
			  <label  >
				<input type=\"radio\" name=\"duplex\" id=\"duplex1\" value=\"0\" "; if($rid['duplex']=="0"){echo "checked";} echo"> X </label>
			</div>
			<div class=\"radio-inline\">
			  <label >
				<input type=\"radio\" name=\"duplex\" id=\"duplex2\" value=\"1\" "; if($rid['duplex']=="1"){echo "checked";} echo"> O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">빈 원룸 개수</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"emptyone\" id=\"emptyone\" value=\"".$rid['emptyone']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">빈 복층룸 개수</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"emptyduplex\" id=\"emptyduplex\" value=\"".$rid['emptyduplex']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">빈 투룸 개수</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"emptytworoom\"id=\"emptytworoom\" value=\"".$rid['emptytworoom']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">평균 평수</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"spacious\"id=\"spacious\" value=\"".$rid['spacious']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">내야할 관리비</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"ubill\" id=\"ubill\" value=\"".$rid['ubill']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">평균 공과금</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"charter\" id=\"charter\" value=\"".$rid['charter']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">보증금</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"deposit\" id=\"deposit\" value=\"".$rid['deposit']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">월세</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"monthlyrent\" id=\"monthlyrent\" value=\"".$rid['monthlyrent']."\" /></div>
		</td></tr>

		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">도시가스 여부</label>
		<div class=\"col-lg-8\">
			 <div class=\"radio-inline\">
			  <label  >
				<input type=\"radio\" name=\"gas\" id=\"gas1\" value=\"0\" "; if($rid['gas']=="0"){echo "checked";} echo"> X </label>
			</div>
			<div class=\"radio-inline\">
			  <label >
				<input type=\"radio\" name=\"gas\" id=\"gas2\" value=\"1\" "; if($rid['gas']=="1"){echo "checked";} echo"> O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">심야전기 여부</label>
		<div class=\"col-lg-8\">
			 <div class=\"radio-inline\">
			  <label  >
				<input type=\"radio\" name=\"miel\" id=\"miel1\" value=\"0\" "; if($rid['miel']=="0"){echo "checked";} echo"> X </label>
			</div>
			<div class=\"radio-inline\">
			  <label >
				<input type=\"radio\" name=\"miel\" id=\"miel2\" value=\"1\" "; if($rid['miel']=="1"){echo "checked";} echo"> O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">에어컨 여부</label>
		<div class=\"col-lg-8\">
			 <div class=\"radio-inline\">
			  <label  >
				<input type=\"radio\" name=\"aircon\" id=\"aircon1\" value=\"0\" "; if($rid['aircon']=="0"){echo "checked";} echo"> X </label>
			</div>
			<div class=\"radio-inline\">
			  <label >
				<input type=\"radio\" name=\"aircon\" id=\"aircon2\" value=\"1\" "; if($rid['aircon']=="1"){echo "checked";} echo"> O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">기타 사항</label>
		<div class=\"col-lg-8\"><input type=\"text\"  class=\"form-control input-sm\" name=\"etc\" id=\"etc\" value=\"".$rid['etc']."\" /></div>
		</td></tr>
		<tr><td>
		<label for=\"inputPassword\" class=\"col-lg-4 control-label\">그림파일</label>
		<div class=\"col-lg-8\"> 
		

	<center>
		<div class=\"fileinput fileinput-new\" data-provides=\"fileinput\">
		  <div class=\"fileinput-new thumbnail\" style=\"width: 200px; height: 150px;\">
			<img src=\"/img/".$rid['img'].".jpg?".time()."\">
		  </div>
		  <div class=\"fileinput-preview fileinput-exists thumbnail\" style=\"max-width: 400px; max-height: 300px;\"></div>
		  <div>
			<span class=\"btn btn-default btn-file\">
				<span class=\"fileinput-new\"> Select image </span>
				<span class=\"fileinput-exists\"> Change </span>
				<input type=\"file\"  name=\"image\">
			</span>
			<a href=\"#\" class=\"btn btn-default fileinput-exists\" data-dismiss=\"fileinput\">Remove</a>
		  </div>
		</div>
	</center>
	</div>
 		</td></tr>
	<input type=\"hidden\"  name=\"img\" id=\"img\" value=\"".$rid['img']."\" />
	<input type=\"hidden\" name=\"flag\" value=0>
	<input type=\"hidden\" name=\"room_id\" value=\"".$room_id."\">
 
	</table>
		";

		}
 

//<input type=\"text\"  class=\"form-control input-sm\" name=\"tworoom\" id=\"tworoom\" value=\"".$rid['tworoom']."\" />

 ?>