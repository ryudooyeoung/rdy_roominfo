 
<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {

	
	//form���� �Ѱܹ��� �������� �迭�� ����
	$array = Array();
	$array['member_id'] = $_POST['member_id']; 
	$array['passwd'] = md5($_POST['passwd']);
	$array['phone'] = $_POST['phone'];


	//���̵� �ߺ����� üũ
	$flag = 0;
	$id = $_POST['member_id'];
	$result = $fpBatis->doSelect('Members.select',$id);
	if($result!=null){
		$flag = 1;
	}


	if($flag == 0){

		//��ȭȭ �����Ͽ� ��й�ȣ ����
		//$fpBatis->doSaveFormm('Members');
		$fpBatis->doInsert('Members.insert',$array);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" /><script id='join'> alert(' " . $_POST['member_id'] . "�� �ݰ����ϴ�. ȸ�����Կ� �����߽��ϴ�.'); </script>";
	}
	else{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" /><script id='join'> alert('ID �ߺ� �Դϴ�.'); </script>";
	}


}?>