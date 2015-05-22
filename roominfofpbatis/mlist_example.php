<html>
	<head>
		<title>fpBatis List Example</title>
	</head>
	<body>
		<p>
			<a href="mlist_example.php">List Example</a><br/>
			<a href="mcreate_example.php">Create Example</a>
		</p>
<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

$id = $_GET['member_id'];

if ($_GET['delete'] == 'city') {
	$fpBatis->doDelete('Members.delete',array('member_id'=>$id));
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
 
$allCountries = $fpBatis->doSelect('Members.selectAll');

echo '<ul>';
foreach ($allCountries as $city) {
	echo '<li>member_id: ' . $city['member_id'] . '</li>';
	echo '<li>passwd: ' . $city['passwd'] . '</li>';
	echo '<li>phone: ' . $city['phone'] . '</li>';
	echo '<li>authority: ' . $city['authority'] . '</li>';

	echo '<li><a href="mcreate_example.php?edit=city&member_id=' . $city['member_id'] . '">Edit ' . $city['member_id'] . '</a></li>';
	echo '<li><a href="mlist_example.php?delete=city&member_id=' . $city['member_id'] . '">Delete ' . $city['member_id'] . '</a></li></br>';
}
echo '</ul>';

?>

	</body>
</html>