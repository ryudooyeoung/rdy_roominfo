 

<?php
  
require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


$flag = 0;

session_start();

$array = array();
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
$array['img'] = $_SESSION['member_id']."_".$_POST['add_name'];
$array['member_id'] = $_SESSION['member_id'];



$arr = array();
$arr['member_id']=$_SESSION['member_id'];
$arr['addrequest_id']=$_POST['addrequest_id'];

$result = $fpBatis->doSelect('Addrequest.selectIM', $arr);
$beforeimg ;

foreach( $result as $r ){}
$beforeimg = $r['img'];
 


if($_POST['flag'] == "insert"){
		$fpBatis->doInsert('Addrequest.insert', $array);
		$str = "요청이 등록되었습니다.";
}
else{

	$array['addrequest_id'] = $_POST['addrequest_id'];

	if( $beforeimg!=$array['img']){
		unlink("addrequest/".$beforeimg.".jpg");
	}  

	$fpBatis->doUpdate('Addrequest.update', $array);
	$str = "요청이 수정되었습니다.";
 }

 

 $flag = 1;

	// 2.업로드된 파일의 존재여부 및 전송상태 확인
	if (isset($_FILES['image']) && !$_FILES['image']['error']) {

		// 3-1.허용할 이미지 종류를 배열로 저장
		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		// 3-2.imageKind 배열내에 $_FILES['image']['type']에 해당되는 타입(문자열) 있는지 체크
		if (in_array($_FILES['image']['type'], $imageKind)) {
		
		//{$_FILES['image']['name']}
 
			// 4.허용하는 이미지파일이라면 지정된 위치로 이동
			if (move_uploaded_file ($_FILES['image']['tmp_name'], "addrequest/{$array['img']}.jpg")) {

				// 5.업로드된 이미지 파일을 출력
				//echo '<p><img src="./upload/'.$_FILES['image']['name'].'" /></p>';
				//echo '파일명: '.$_FILES['image']['name'];

				$flag = 1;
			} //if , move_uploaded_file
			
		} else { // 3-3.허용된 이미지 타입이 아닌경우
			echo 'JPEG 또는 PNG 이미지만 업로드 가능합니다';
		}//if , inarray

	} //if , isset
	

	// 6.에러가 존재하는지 체크
	if ($_FILES['image']['error'] > 0) {
		echo '파일 업로드 실패 이유: ';
	
		// 실패 내용을 출력
		switch ($_FILES['image']['error']) {
			case 1:
				echo 'php.ini 파일의 upload_max_filesize 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 2:
				echo 'Form에서 설정된 MAX_FILE_SIZE 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 3:
				echo '파일 일부만 업로드 됨';
				break;
			case 4:
				echo '업로드된 파일이 없음';
				break;
			case 6:
				echo '사용가능한 임시폴더가 없음';
				break;
			case 7:
				echo '디스크에 저장할수 없음';
				break;
			case 8:
				echo '파일 업로드가 중지됨';
				break;
			default:
				echo '시스템 오류가 발생';
				break;
		} // switch
		

		
	} // if
		// 7.임시파일이 존재하는 경우 삭제
	if (file_exists ($_FILES['image']['tmp_name']) && is_file($_FILES['image']['tmp_name']) ) {
		unlink ($_FILES['image']['tmp_name']);
	}

	if($flag == 1){
		echo "
			<script id=\"add_request\">	
			load_managelist('".$_SESSION['member_id']."'); 
			alert('".$str."');
			
			$(\"#addrequestroommodal\").modal('hide');

			</script>
			";
	}
?>