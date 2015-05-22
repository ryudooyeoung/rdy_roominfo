 
<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


	session_start();



	if( $_POST['flag']=="update"){
		$array = array();
		$array['member_id']=$_SESSION['member_id'];
		$array['room_id']=$_POST['room_id'];
		$array['soundproof']= $_POST['soundproof'];
		$array['access']= $_POST['access'];
		$array['facility']= $_POST['facility'];
		$array['security']= $_POST['security'];
		$array['clean']= $_POST['clean'];
 
		
		$result = $fpBatis->doUpdate('Evaluation.update', $array );
		
		echo "평가내역이 수정되었습니다.";
	}
	else{

		 if($_SESSION['member_id']){

			 $array = array();
			 $array['member_id']=$_SESSION['member_id'];
			 $array['room_id']=$_POST['room_id'];
			 $array['soundproof']= $_POST['soundproof'];
			 $array['access']= $_POST['access'];
			 $array['facility']= $_POST['facility'];
			 $array['security']= $_POST['security'];
			 $array['clean']= $_POST['clean'];

			
			$arr = array();
			$arr['member_id']=$_SESSION['member_id'];
			$arr['room_id']=$_POST['room_id'];
			 
			$result = $fpBatis->doSelect('Evaluation.select_mr', $arr );
			
			if($result != NULL){
				echo "이미 평가를 하셨습니다.";
			}
			else{

				$result = $fpBatis->doInsert('Evaluation.insert', $array);

			 echo "평가가 성공적으로 이루어졌습니다.";
			}

		 }
		 else{
			echo "로그인 후 에 이용할 수 있습니다.";
		 }

	}
?>