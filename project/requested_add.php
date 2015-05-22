 

<?php
  
require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


$flag = 0;

session_start();

$array = array();
$array['x'] = $_POST['add_x'];
$array['y'] = $_POST['add_y'];
$array['address'] = $_POST['add_address'];
$array['name'] = $_POST['add_name'];
$array['phone'] = $_POST['add_phone'];
$array['tworoom'] = $_POST['add_tworoom'];
$array['duplex'] = $_POST['add_duplex'];
$array['emptyone'] = $_POST['add_emptyone'];
$array['emptyduplex'] = $_POST['add_emptyduplex'];
$array['emptytworoom'] = $_POST['add_emptytworoom'];
$array['spacious'] = $_POST['add_spacious'];
$array['ubill'] = $_POST['add_ubill'];
$array['charter'] = $_POST['add_charter'];
$array['deposit'] = $_POST['add_deposit'];
$array['monthlyrent'] = $_POST['add_monthlyrent'];
$array['gas'] = $_POST['add_gas'];
$array['miel'] = $_POST['add_miel'];
$array['aircon'] = $_POST['add_aircon'];
$array['etc'] = $_POST['add_etc'];
$array['img'] = $_POST['add_img'];



//추가요청 내용 질의
$result = $fpBatis->doSelect('Addrequest.selectI', $_POST['addrequest_id']);
foreach($result as $r){};

 //이미지 이동
copy( "addrequest/".$r['img'].".jpg", "../img/".$_POST['add_img'].".jpg");
unlink("addrequest/".$r['img'].".jpg");

 
//추가요청된 방정보 삽입
$fpBatis->doInsert('Roominfos.insert', $array);


//삽입된 방정보의 room_id 질의
$result2 = $fpBatis->doSelect('Roominfos.selectN', $array['name'] );
foreach($result2 as $r2){};
 

//추가한 member_id에 room_id할당하여 관리할수있게 저장
$array2 = array();
$array2['member_id'] = $r['member_id'];
$array2['room_id'] =$r2['room_id'];
$fpBatis->doInsert('Manage.insert', $array2 );


//방정보 추가요청내역은 삭제
$arr = array();
$arr['addrequest_id'] = $_POST['addrequest_id'];
$fpBatis->doDelete('Addrequest.delete',  $arr );

 

?>