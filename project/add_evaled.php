

<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


$room_id = $_POST['room_id'];




$result = $fpBatis->doSelect('Evaluation.select_r',$room_id);

$flag=0;
	foreach( $result as $r ){
		$flag++;
	}


if($flag>0){
	
	echo"<link href=\"/css/rateit.css\" rel=\"stylesheet\" type=\"text/css\">
					<link href=\"/content/bigstars.css\" rel=\"stylesheet\" type=\"text/css\">
					<link href=\"/content/antenna.css\" rel=\"stylesheet\" type=\"text/css\">
					<link href=\"/content/svg.css\" rel=\"stylesheet\" type=\"text/css\">
					<script src=\"/js/jquery.rateit.js\" type=\"text/javascript\"></script>";

	echo "<table class=\"table table-striped\">
				<tr>
					<td colspan=\"5\"><h3><span class=\"label label-default\">평가 내역</span></h3></td>
				</tr>
				<tr>
					 <th>방음</th><th>접근성</th><th>시설</th><th>방범</th><th>청결</th>
				</tr>";
		$count=0;
		foreach( $result as $r ){

			echo "
			<tr>
				<td><div class=\"rateit\" id=\"soundproof_evaled".$room_id."_".$count."\" data-rateit-ispreset=\"true\" data-rateit-readonly=\"true\"></div></td> 
				<td><div class=\"rateit\" id=\"access_evaled".$room_id."_".$count."\" data-rateit-ispreset=\"true\" data-rateit-readonly=\"true\"></div> </td> 
				<td><div class=\"rateit\" id=\"facility_evaled".$room_id."_".$count."\" data-rateit-ispreset=\"true\" data-rateit-readonly=\"true\"></div> </td> 
				<td><div class=\"rateit\" id=\"security_evaled".$room_id."_".$count."\" data-rateit-ispreset=\"true\" data-rateit-readonly=\"true\"></div> </td> 
				<td><div class=\"rateit\" id=\"clean_evaled".$room_id."_".$count."\" data-rateit-ispreset=\"true\" data-rateit-readonly=\"true\"></div> </td> 
			</tr>";

			echo "
				<script>
				$('#soundproof_evaled".$room_id."_".$count."').rateit('value', ".$r['soundproof']."); 
				$('#access_evaled".$room_id."_".$count."').rateit('value', ".$r['access']."); 
				$('#facility_evaled".$room_id."_".$count."').rateit('value', ".$r['facility']."); 
				$('#security_evaled".$room_id."_".$count."').rateit('value', ".$r['security']."); 		
				$('#clean_evaled".$room_id."_".$count."').rateit('value', ".$r['clean']."); 
				</script>";

			$count++;
		}
	echo "</table>";
	 
	
	
	if($count > 5 ){
		$height=250;
	}
	else{
		$height = 115+$count*33;
	}
 
	echo "<script id=\"load_evaled\">
			$('#evaled".$room_id."').css(\"overflow-y\", \"scroll\");
			$('#evaled".$room_id."').css(\"height\", \"".$height."px\");
		</script>";

}


?>