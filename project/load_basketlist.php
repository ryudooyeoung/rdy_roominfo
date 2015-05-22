<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {

session_start();
$member_id = $_SESSION['member_id'];

$result = $fpBatis->doSelect('Basket.select', $member_id);
	
	
	
	if($result == null){
		
	}
	else{

		echo "<table class=\"table table-striped\"> <tr><th>이름</th><th>보증금</th><th>월세</th><th> </th></tr>";

		foreach( $result as $r ){
			$result_rid = $fpBatis->doSelect('Roominfos.select', $r['room_id']);

			foreach( $result_rid as $rid ){
				
				echo "<tr>
				<td> <a href=\"\" data-toggle=modal data-target=#myModal".$rid['room_id']. " ";

				printf("onclick=\"add_tab_content({ room_id : '%s', x : '%s' , y : '%s' , addr : '%s' });\" ",$rid['room_id'] ,$rid["x"] , $rid["y"],  $rid["address"]);

				echo ">".$rid['name']. "</a></td>
				<td>".$rid['deposit']."</td>
				<td>".$rid['monthlyrent']."</td>
				<td><a href=\"#\" onclick=\"sublist(".$rid['room_id'].");load_basketlist('".$member_id."');\" class=\"glyphicon glyphicon-trash\"> 찜해제</a></td>
				</tr>";
			}
		}//end of foreach
		echo "</table>";

	}//end of else


/*
if($member_id==null){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"member_basket\">alert(\"로그인후 이용하시기 바랍니다.\");</script>";
}
else{

	$array = array();
	$array['member_id'] = $member_id;
	$array['room_id'] = $room_id;


	$result = $fpBatis->doSelect('Basket.selectCon', $array);
	
	if($result == null){
		$fpBatis->doInsert('Basket.insert', $array);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"member_basket\"> update_basket(".$member_id."); </script>";
	}
	else{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"member_basket\"> alert(\"이미 찜 하셨어요~\"); </script>";
	}

}

*/
 
}?>