<html>
	<head>
		<title>fpBatis List Example</title>
	</head>
	<body>
		<p>
			<a href="blist_example.php">List Example</a><br/>
			<a href="bcreate_example.php">Create Example</a>
		</p>
<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

$member_id = $_GET['member_id'];
$room_id = $_GET['room_id']; 

$array = array();
$array['member_id'] = $member_id;
$array['room_id'] = $room_id;

if ($_GET['delete'] == 'city') {
	$fpBatis->doDelete('Basket.delete',$array);
}
 
 
$allCountries = $fpBatis->doSelect('Basket.selectAll');

echo '<ul>';
foreach ($allCountries as $city) {
	echo '<li>member_id: ' . $city['member_id'] . '</li>';
	echo '<li>room_id: ' . $city['room_id'] . '</li>';
	echo '<li><a href="blist_example.php?delete=city&member_id=' . $city['member_id'] . '&room_id='.$city['room_id'].' ">Delete ' . $city['member_id'] . '</a></li></br>';
}
echo '</ul>';

?>

	</body>
</html>