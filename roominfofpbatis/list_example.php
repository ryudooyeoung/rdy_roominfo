<html>
	<head>
		<title>fpBatis List Example</title>
	</head>
	<body>
		<p>
			<a href="list_example.php">List Example</a><br/>
			<a href="create_example.php">Create Example</a>
		</p>
<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

$id = $_GET['room_id'];

if ($_GET['delete'] == 'city') {
	$fpBatis->doDelete('Roominfos.delete',array('room_id'=>$id));
}


/*
$params = array();
$params['sort'] = 'city';
$params['sortDir'] = 'DESC';
$params['idList'] = array(1,2,3);*/
 


//$allCountries = $fpBatis->doSelect('Cities.selectAll');

/*
$params = array();
$params['deposit'] = 100;
$params['depositop'] = "<=";
$params['monthlyrent'] = 30;
$params['monthlyrentop'] = "<=";
$params['gas'] = 1;
$params['miel'] = 1;
$params['aircon'] = 1;
*/
$params = array();/*
$params['deposit'] = 100;
$params['depositop'] = "<=";
$params['monthlyrent'] = 0;
$params['monthlyrentop'] = "<=";*/
//$params['tablename'] = "(SELECT * FROM roominfotest WHERE `monthlyrent` <= '30' ) as t";
$params['tablename'] = "roominfotest";
//$allCountries = $fpBatis->doSelect('Roominfos.selectCon',$params);
$allCountries = $fpBatis->doSelect('Roominfos.selectAll');


echo '<ul>';
foreach ($allCountries as $city) {
	echo '<li>Id: ' . $city['room_id'] . '</li>';
	echo '<li>x: ' . $city['x'] . '</li>';
	echo '<li>y: ' . $city['y'] . '</li>';
	echo '<li>address: ' . $city['address'] . '</li>';
	echo '<li>name: ' . $city['name'] . '</li>';
	echo '<li>phone: ' . $city['phone'] . '</li>';
	echo '<li>tworoom: ' . $city['tworoom'] . '</li>';
	echo '<li>duplex: ' . $city['duplex'] . '</li>';
	echo '<li>emptyone: ' . $city['emptyone'] . '</li>';
	echo '<li>emptydupelx: ' . $city['emptyduplex'] . '</li>';
	echo '<li>emptytworoom: ' . $city['emptytworoom'] . '</li>';
	echo '<li>spacious: ' . $city['spacious'] . '</li>';
	echo '<li>ubill: ' . $city['ubill'] . '</li>';
	echo '<li>charter: ' . $city['charter'] . '</li>';
	echo '<li>deposit: ' . $city['deposit'] . '</li>';
	echo '<li>monthlyrent: ' . $city['monthlyrent'] . '</li>';
	echo '<li>gas: ' . $city['gas'] . '</li>';
	echo '<li>miel: ' . $city['miel'] . '</li>';
	echo '<li>aircon: ' . $city['aircon'] . '</li>';
	echo '<li>etc: ' . $city['etc'] . '</li>';
	echo '<li>img: ' . $city['img'] . '</li>';
	echo '<li><a href="create_example.php?edit=city&room_id=' . $city['room_id'] . '">Edit ' . $city['name'] . '</a></li>';
	echo '<li><a href="list_example.php?delete=city&room_id=' . $city['room_id'] . '">Delete ' . $city['name'] . '</a></li></br>';
}
echo '</ul>';

?>

	</body>
</html>