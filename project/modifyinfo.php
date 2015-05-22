<meta charset="utf-8">


<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {


$fpBatis->doSaveFormm('Members');



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