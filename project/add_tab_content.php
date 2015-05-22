<meta charset="utf-8">
 
<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['room_id'])) {

$room_id = $_POST['room_id'];

$result = $fpBatis->doSelect('Roominfos.select', $room_id);

	foreach( $result as $r ){

		echo  "<ul id=\"myTab".$r['room_id']."\" class=\"nav nav-tabs\">
				<li class=\"active\"><a href=\"#info".$r['room_id']."\" data-toggle=\"tab\">방정보</a></li>
				<li><a href=\"#eval".$r['room_id']."\" data-toggle=\"tab\" >평가</a></li>
				<li><a href=\"#qna".$r['room_id']."\" data-toggle=\"tab\" >QnA</a></li>
				<li><a href=\"#board".$r['room_id']."\" data-toggle=\"tab\" >게시판</a></li></ul>";

		//방정보 출력
		echo "<div id=\"myTabContent\" class=\"tab-content\">
				<div class=\"tab-pane fade in active\" id=\"info".$r['room_id']."\">
	 
					<style>
							th, td {text-align:center; }
						</style>
						<table class=\"table table-striped table-bordered\" >
							
							<tr>
								<td colspan=\"6\" >".$r['room_id'].".".$r['name']."</td>
							</tr>";
						
						if($r['tworoom']=="1" && $r['duplex']=="1"){
							echo"<tr>
								<td colspan=\"2\">원룸 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
								<td colspan=\"2\">투룸 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
								<td colspan=\"2\">복층 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
							</tr>
							<tr>
								<td colspan=\"2\">원룸 : ".$r['emptyone']." 남음</td>
								<td colspan=\"2\">투룸 : ".$r['emptytworoom']." 남음</td>
								<td colspan=\"2\">복층 : ".$r['emptyduplex']." 남음</td>
							</tr>
							";
						}
						elseif($r['tworoom']=="1" && $r['duplex']=="0"){
							echo"<tr>
								<td colspan=\"3\">원룸 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
								<td colspan=\"3\">투룸 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
							</tr>
							<tr>
								<td colspan=\"3\">원룸 : ".$r['emptyone']." 남음</td>
								<td colspan=\"3\">투룸 : ".$r['emptytworoom']." 남음</td>
							</tr>
							";			
						}
						elseif($r['tworoom']=="0" && $r['duplex']=="1"){
							echo"<tr>
								<td colspan=\"3\">원룸 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
								<td colspan=\"3\">복층 <span class=\"glyphicon glyphicon-ok-circle\"></span></td>
							</tr>
							<tr>
								<td colspan=\"3\">원룸 : ".$r['emptyone']." 남음</td>
								<td colspan=\"3\">복층 : ".$r['emptyduplex']." 남음</td>
							</tr>
							";
						}else{
							echo"<tr>
								<td colspan=\"6\">원룸 : ".$r['emptyone']." 남음</td>
							</tr>
							";
						}
						
						echo"<tr>
								<td colspan=\"2\">주소</td><td width=\"66%\" colspan=\"4\">".$r['address']."</td>
							</tr>

							<tr>
								<td colspan=\"2\">연락처</td><td colspan=\"4\">".$r['phone']."  <a href=\"tel:".$r['phone']."\"><span class=\"glyphicon glyphicon-earphone\"></span></a> </td>
							</tr>

							<tr>
								<td colspan=\"2\">평수 / ".$r['spacious']."</td>
								<td colspan=\"2\">보증금 / ".$r['deposit']."</td>
								<td colspan=\"2\">월세 / ".$r['monthlyrent']."</td>
							</tr>
							
							<tr>
								<td colspan=\"2\">도시가스 / "; if($r['gas']=="1"){echo "O</td>";}else{echo "X</td>";}
							echo"<td colspan=\"2\">심야전기 / "; if($r['miel']=="1"){echo "O</td>";}else{echo "X</td>";}
							echo"<td colspan=\"2\">에어컨 / "; if($r['aircon']=="1"){echo "O</td>";}else{echo "X</td>";}
						echo"</tr>
							<tr>
								<td colspan=\"2\">기타사항</td><td colspan=\"4\">".$r['etc']."</td>
							</tr>
							<tr>
								<td colspan=\"6\"><center><img src=\"/img/".$r['img'].".jpg?".time()."\" onerror=\"this.src='/img/s.jpg'\" class=\"img-responsive\" alt=\"Responsive image\"></center></td>
							</tr>
						</table>
	 
						<div id=\"roominfo_roadview".$r['room_id']."\"></div>
					</div>";

 
				//평가 정보
				echo "<div class=\"tab-pane fade\" id=\"eval".$r['room_id']."\" >
						<div id=\"avgevaled".$room_id."\"></div>";
				
					//평가내역 
					echo "<div id=\"evaled".$room_id."\"></div>";



				//평가 
				echo "

					<table class=\"table table-striped\">
					<tr>
						<td colspan=\"3\"><h3><span class=\"label label-default\">평가하기</span></h3></td>
					</tr>
					<tr>
						<td>방음</td> <td>접근성</td> <td>시설</td>
					</tr>
					<tr>
						<td><div class=\"rateit\" id=\"soundproof_eval".$room_id."\" data-rateit-step=\"1\"></div></td>
						<td><div class=\"rateit\" id=\"access_eval".$room_id."\" data-rateit-step=\"1\"></div></td>
						<td><div class=\"rateit\" id=\"facility_eval".$room_id."\" data-rateit-step=\"1\"></div></td>
					</tr>
					</table>
					<table class=\"table table-striped\">
					<tr>
						<td>방범</td> <td>청결</td>
					</tr>
					<tr>
						<td><div class=\"rateit\" id=\"security_eval".$room_id."\" data-rateit-step=\"1\"></div></td>
						<td><div class=\"rateit\" id=\"clean_eval".$room_id."\" data-rateit-step=\"1\"></div></td>
					</tr>
					</table>
				 ";

				session_start();

				$arr = array();
				$arr['member_id']=$_SESSION['member_id'];
				$arr['room_id']=$room_id;
		 
				$result2 = $fpBatis->doSelect('Evaluation.select_mr', $arr );

				if( $result2 != NULL ){
					
					foreach( $result2 as $r2 ){
						echo"<link href=\"/css/rateit.css\" rel=\"stylesheet\" type=\"text/css\">
						<link href=\"/content/bigstars.css\" rel=\"stylesheet\" type=\"text/css\">
						<link href=\"/content/antenna.css\" rel=\"stylesheet\" type=\"text/css\">
						<link href=\"/content/svg.css\" rel=\"stylesheet\" type=\"text/css\">
						<script src=\"/js/jquery.rateit.js\" type=\"text/javascript\"></script>";

						echo "
						<script>
						$('#soundproof_eval".$room_id."').rateit('value', ".$r2['soundproof']."); 
						$('#access_eval".$room_id."').rateit('value', ".$r2['access']."); 
						$('#facility_eval".$room_id."').rateit('value', ".$r2['facility']."); 
						$('#security_eval".$room_id."').rateit('value', ".$r2['security']."); 		
						$('#clean_eval".$room_id."').rateit('value', ".$r2['clean']."); 
						</script>";

					}

					echo"
					 <center>
					 <button type=\"button\" onclick=\"evaluation_modify( { room_id : '".$room_id."', member_id : '".$_SESSION['member_id']."' } );\" class=\"btn btn-primary\">수정하기</button>
					 </center>
					";

				}
				else{
					echo"
					 <center>
					 <button type=\"button\" onclick=\"evaluation( { room_id : '".$room_id."' } );\" class=\"btn btn-primary\">평가하기</button>
					 </center>
					";
				}
				
 
 


			echo "</div>

				<div class=\"tab-pane fade\" id=\"qna".$r['room_id']."\" ></div>
				<div class=\"tab-pane fade\" id=\"board".$r['room_id']."\" ></div>
			</div>

			<script id=\"add_tab_content\">
				$('#myModalLabel".$r['room_id']."').html('<b>".$r['name']."</b>');
			</script>";

	}//end of foreach
 
}?>