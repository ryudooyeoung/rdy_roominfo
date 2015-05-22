 

<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


$flag = 0;

$fpBatis->doSaveFormm('Roominfos');

 $flag = 1;

	// 2.업로드된 파일의 존재여부 및 전송상태 확인
	if (isset($_FILES['image']) && !$_FILES['image']['error']) {

		// 3-1.허용할 이미지 종류를 배열로 저장
		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		// 3-2.imageKind 배열내에 $_FILES['image']['type']에 해당되는 타입(문자열) 있는지 체크
		if (in_array($_FILES['image']['type'], $imageKind)) {
		
		//{$_FILES['image']['name']}
 
			// 4.허용하는 이미지파일이라면 지정된 위치로 이동
			if (move_uploaded_file ($_FILES['image']['tmp_name'], "../img/{$_POST['img']}.jpg")) {

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
		echo "수정이 완료되었습니다";
	}
?>