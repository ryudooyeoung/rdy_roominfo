<html>
	<head>
		<title>fpBatis Create Example</title>
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

if ($_GET['edit'] == 'city') {
	$city = $fpBatis->doSelect('Roominfos.select',$id);
	$city = $city[0];
} else if ($_GET['save'] == 'city') {
	$city = $fpBatis->doSaveForm('Roominfos');
	$id = $city['room_id'];
	echo 'Saved city with doInsert/doUpdate: ';
	print_r($city);
	echo '<hr/>';
}




if ($id == '')
	$id = -1;

 
if (($_GET['edit'] == null && $_GET['save'] == null) || $city != null) {
?>
		<form method="POST" action="create_example.php?save=city">
		<input type="hidden" name="room_id" id="room_id" value="<?=$id?>" />
			x: <input type="text" name="x" id="x" <? if ($city != null) { ?> value="<?=$city['x']?>" <? } ?>/><br/>
			y: <input type="text" name="y" id="y" <? if ($city != null) { ?> value="<?=$city['y']?>" <? } ?>/><br/>
			address: <input type="text" name="address" id="address" <? if ($city != null) { ?> value="<?=$city['address']?>" <? } ?>/><br/>
			name: <input type="text" name="name" id="name" <? if ($city != null) { ?> value="<?=$city['name']?>" <? } ?>/><br/>
			phone: <input type="text" name="phone" id="phone" <? if ($city != null) { ?> value="<?=$city['phone']?>" <? } ?>/><br/>
			tworoom: <input type="text" name="tworoom" id="tworoom" <? if ($city != null) { ?> value="<?=$city['tworoom']?>" <? } ?>/><br/>
			duplex: <input type="text" name="duplex" id="duplex" <? if ($city != null) { ?> value="<?=$city['duplex']?>" <? } ?>/><br/>
			emptyone: <input type="text" name="emptyone" id="emptyone" <? if ($city != null) { ?> value="<?=$city['emptyone']?>" <? } ?>/><br/>
			emptyduplex: <input type="text" name="emptyduplex" id="emptyduplex" <? if ($city != null) { ?> value="<?=$city['emptyduplex']?>" <? } ?>/><br/>
			emptytworoom: <input type="text" name="emptytworoom" id="emptytworoom" <? if ($city != null) { ?> value="<?=$city['emptytworoom']?>" <? } ?>/><br/>
			spacious: <input type="text" name="spacious" id="spacious" <? if ($city != null) { ?> value="<?=$city['spacious']?>" <? } ?>/><br/>
			ubill: <input type="text" name="ubill" id="ubill" <? if ($city != null) { ?> value="<?=$city['ubill']?>" <? } ?>/><br/>
			charter: <input type="text" name="charter" id="charter" <? if ($city != null) { ?> value="<?=$city['charter']?>" <? } ?>/><br/>
			deposit: <input type="text" name="deposit" id="deposit" <? if ($city != null) { ?> value="<?=$city['deposit']?>" <? } ?>/><br/>
			monthlyrent: <input type="text" name="monthlyrent" id="monthlyrent" <? if ($city != null) { ?> value="<?=$city['monthlyrent']?>" <? } ?>/><br/>
			gas: <input type="text" name="gas" id="gas" <? if ($city != null) { ?> value="<?=$city['gas']?>" <? } ?>/><br/>
			miel: <input type="text" name="miel" id="miel" <? if ($city != null) { ?> value="<?=$city['miel']?>" <? } ?>/><br/>
			aircon: <input type="text" name="aircon" id="aircon" <? if ($city != null) { ?> value="<?=$city['aircon']?>" <? } ?>/><br/>
			etc: <input type="text" name="etc" id="etc" <? if ($city != null) { ?> value="<?=$city['etc']?>" <? } ?>/><br/>
			img: <input type="text" name="img" id="img" <? if ($city != null) { ?> value="<?=$city['img']?>" <? } ?>/><br/>
			<input type="submit" value="Save"/>
		</form>
<?
}
?>
	</body>
</html>