<?php
// 2.���ε�� ������ ���翩�� �� ���ۻ��� Ȯ��
	if (isset($_FILES['upload']) && !$_FILES['upload']['error']) {

		// 3-1.����� �̹��� ������ �迭�� ����
		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		// 3-2.imageKind �迭���� $_FILES['upload']['type']�� �ش�Ǵ� Ÿ��(���ڿ�) �ִ��� üũ
		if (in_array($_FILES['upload']['type'], $imageKind)) {
		
			// 4.����ϴ� �̹��������̶�� ������ ��ġ�� �̵�
			if (move_uploaded_file ($_FILES['upload']['tmp_name'], "./uploads/{$_FILES['upload']['name']}")) {

				// 5.���ε�� �̹��� ������ ���
				echo '<p><img src="./uploads/'.$_FILES['upload']['name'].'" /></p>';
				echo '<p>���ϸ�: '.$_FILES['upload']['name'].'</p>';

			} //if , move_uploaded_file
			
		} else { // 3-3.���� �̹��� Ÿ���� �ƴѰ��
			echo '<p>JPEG �Ǵ� PNG �̹����� ���ε� �����մϴ�.</p>';
		}//if , inarray

	} //if , isset
	

	// 6.������ �����ϴ��� üũ
	if ($_FILES['upload']['error'] > 0) {
		echo '<p>���� ���ε� ���� ����: <strong>';
	
		// ���� ������ ���
		switch ($_FILES['upload']['error']) {
			case 1:
				echo 'php.ini ������ upload_max_filesize �������� �ʰ���(���ε� �ִ�뷮 �ʰ�)';
				break;
			case 2:
				echo 'Form���� ������ MAX_FILE_SIZE �������� �ʰ���(���ε� �ִ�뷮 �ʰ�)';
				break;
			case 3:
				echo '���� �Ϻθ� ���ε� ��';
				break;
			case 4:
				echo '���ε�� ������ ����';
				break;
			case 6:
				echo '��밡���� �ӽ������� ����';
				break;
			case 7:
				echo '��ũ�� �����Ҽ� ����';
				break;
			case 8:
				echo '���� ���ε尡 ������';
				break;
			default:
				echo '�ý��� ������ �߻�';
				break;
		} // switch
		
		echo '</strong></p>';
		
	} // if
	
	// 7.�ӽ������� �����ϴ� ��� ����
	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
		unlink ($_FILES['upload']['tmp_name']);
	}
?>