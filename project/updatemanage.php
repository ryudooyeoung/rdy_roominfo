<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {

session_start();
$member_id = $_SESSION['member_id'];


$result = $fpBatis->doSelect('Manage.select', $member_id);
	

	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <script id=\"update_manage\">";

	if($result == null){
		if($member_id == "superadmin"){
			$result = $fpBatis->doSelect('Roominfos.selectAll');
				foreach( $result as $r ){

				echo "$(\"#addlist".$r['room_id']."\").replaceWith('<a id=\"addlist".$r['room_id']."\"  href=\"#\" onclick=\"manage_roominfo({room_id: \'".$r['room_id']."\', member_id :\'".$member_id."\'});\" ><span class=\"glyphicon glyphicon-wrench\"> 수정하기 </span></a> ');
				";
			}//end of foreach
			
		}
	}
	else{
		foreach( $result as $r ){

			echo "$(\"#addlist".$r['room_id']."\").replaceWith('<a id=\"addlist".$r['room_id']."\"  href=\"#\" onclick=\"manage_roominfo({room_id: \'".$r['room_id']."\', member_id :\'".$member_id."\'});\" ><span class=\"glyphicon glyphicon-wrench\"> 수정하기 </span></a> ');
			";
		}//end of foreach
	}//end of else

	echo "</script>";

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