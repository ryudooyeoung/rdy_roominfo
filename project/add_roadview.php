<meta charset="utf-8">


<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['room_id'])) {

$room_id = $_POST['room_id'];

$result = $fpBatis->doSelect('Roominfos.select', $room_id);

foreach( $result as $r ){

	echo  "<iframe src=\"roadview.html?x=".$r['x']."&y=".$r['y']."\" scrolling=\"no\" frameborder=\"0\"  id=\"road_view".$r['room_id']."\" width=\"100%\" height=\"350px\" ></iframe>";

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