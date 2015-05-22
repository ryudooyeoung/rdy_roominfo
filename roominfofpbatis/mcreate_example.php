<html>
	<head>
		<title>fpBatis Create Example</title>
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

 
if ($_GET['edit'] == 'city') {
	$city = $fpBatis->doSelect('Members.select',$id);
	$city = $city[0];
} else if ($_GET['save'] == 'city') {

 

	$ids = $fpBatis->doSelect('Members.selectAll');
		foreach ($ids as $temp) {
			if($temp['member_id'] == $_REQUEST['member_id']){
				echo "<script> alert('ID 중복 입니다.'); </script>";
				return;
				}
		}


	$city = $fpBatis->doSaveFormm('Members');
	$id = $city['member_id'];
	echo 'Saved city with doInsert/doUpdate: ';
	print_r($city);
	echo '<hr/>';
}




if ($id == ''){
	$flag = -1;
}
else{
	$flag = 0;
}

 
if (($_GET['edit'] == null && $_GET['save'] == null) || $city != null) {
?>
		<form method="POST" action="mcreate_example.php?save=city">
		<?if($_GET['edit'] != 'city' && $_GET['save'] != 'city') { 
		?>
			memeber_id: <input type="text" name="member_id" id="member_id" <? if ($city != null) { ?> value="<?=$city['member_id']?>" <? } ?>/><br/>
		<?}else {?>
			<input type="hidden" name="member_id" id="member_id" <? if ($city != null) { ?> value="<?=$city['member_id']?>" <? } ?>/><br/>
		<?}?>

			passwd:		<input type="text" name="passwd" id="passwd" <? if ($city != null) { ?> value="<?=$city['passwd']?>" <? } ?>/><br/>
			phone:		<input type="text" name="phone" id="phone" <? if ($city != null) { ?> value="<?=$city['phone']?>" <? } ?>/><br/>
			<input type="hidden" name="flag" id="flag" value="<?=$flag?>" />
			<input type="submit" value="Save"/>
		</form>
<?
}
?>
	</body>
</html>