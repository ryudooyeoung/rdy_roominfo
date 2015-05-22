<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['room_id'])) {

session_start();
$member_id = $_SESSION['member_id'];
$room_id = $_POST['room_id'];


if($member_id==null){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"add_basket\">alert(\"로그인후 이용하시기 바랍니다.\");</script>";
}
elseif($_SESSION['admin']=="true"){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"add_basket\">alert(\"관리자는 이용불가합니다.\");</script>";
}
else{

	$array = array();
	$array['member_id'] = $member_id;
	$array['room_id'] = $room_id;


	$result = $fpBatis->doSelect('Basket.selectCon', $array);
	
	if($result == null){
		$fpBatis->doInsert('Basket.insert', $array);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"add_basket\"> update_basket('".$member_id."'); </script>";
	}
	else{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script id=\"add_basket\"> alert(\"이미 찜 하셨어요~\"); </script>";
	}

}
/*echo "<span class=\"glyphicon glyphicon-log-out\"> 로그아웃</span>";	

if (isset($_POST['name'])) {
$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$message = strip_tags($_POST['message']);

echo "Name		=".$name."</br>";	
echo "Email		=".$email."</br>";	
echo "Message		=".$message."</br>";	
echo "<span class=\"label label-info\" >your message has been submitted .. Thanks you</span>";
*/
}?>