 
<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {
 
$id = $_POST['member_id'];
$result = $fpBatis->doSelect('Members.select',$id);

 foreach ($result as $r) {
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" />
		<script id='modifyinfo'>
				$('#modify_passwd').val('".$r['passwd']."');
				$('#modify_phone').val('".$r['phone']."');
				$('#modify_member_id').val('".$id."');
		</script>";
}
 

 


}?>