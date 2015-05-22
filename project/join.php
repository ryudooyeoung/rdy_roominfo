 
<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {

	
	//form으로 넘겨받은 정보들을 배열에 저장
	$array = Array();
	$array['member_id'] = $_POST['member_id']; 
	$array['passwd'] = md5($_POST['passwd']);
	$array['phone'] = $_POST['phone'];


	//아이디 중복여부 체크
	$flag = 0;
	$id = $_POST['member_id'];
	$result = $fpBatis->doSelect('Members.select',$id);
	if($result!=null){
		$flag = 1;
	}


	if($flag == 0){

		//암화화 적용하여 비밀번호 저장
		//$fpBatis->doSaveFormm('Members');
		$fpBatis->doInsert('Members.insert',$array);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" /><script id='join'> alert(' " . $_POST['member_id'] . "님 반갑습니다. 회원가입에 성공했습니다.'); </script>";
	}
	else{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" /><script id='join'> alert('ID 중복 입니다.'); </script>";
	}


}?>