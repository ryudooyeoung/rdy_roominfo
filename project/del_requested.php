<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

$arr = array();
$arr['addrequest_id'] = $_POST['addrequest_id'];


$result = $fpBatis->doSelect('Addrequest.selectI',  $_POST['addrequest_id'] );
foreach($result as $r){}

unlink("addrequest/".$r['img'].".jpg");

$fpBatis->doDelete('Addrequest.delete',  $arr );




?>