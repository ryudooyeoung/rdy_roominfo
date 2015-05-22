<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['room_id'])) {

	session_start();
	$member_id = $_SESSION['member_id'];
	$room_id = $_POST['room_id'];

	$array = array();
	$array['member_id'] = $member_id;
	$array['room_id'] = $room_id;

	$fpBatis->doDelete('Basket.delete', $array);
		
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <script id=\"sub_basket\">";
echo "$(\"#addlist".$room_id."\").replaceWith('<a id=\"addlist".$room_id."\"  href=\"#\" onclick=\"addlist(".$room_id.");\" ><span class=\"glyphicon glyphicon-thumbs-up\"> 찜하기</span></a>');

load_basketlist('".$$member_id."');
";
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