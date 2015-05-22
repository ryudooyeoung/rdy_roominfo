 

<?php
  
require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

 

session_start();
$result = $fpBatis->doSelect('Addrequest.selectI', $_POST['addrequest_id']);
 

foreach( $result as $r ){}


echo "<script id=\"load_requested\">";

 



if($_SESSION['member_id']=="superadmin"){



echo "if ( $(\"#add_x\").length < 1 ) { 
$('#addrequestroommodal_form table').prepend('<tr><td><label for=\"inputPassword\" class=\"col-lg-4 control-label\">x</label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control input-sm\" name=\"add_x\" id=\"add_x\"></div></td></tr>');
$('#addrequestroommodal_form table').prepend('<tr><td><label for=\"inputPassword\" class=\"col-lg-4 control-label\">y</label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control input-sm\" name=\"add_y\" id=\"add_y\"></div></td></tr>');
$('#addrequestroommodal_form table').append('<tr><td><label for=\"inputPassword\" class=\"col-lg-4 control-label\">그림파일명</label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control input-sm\" name=\"add_img\" id=\"add_img\"></div></td></tr>');
}
";

}


echo"
$('#add_address').val('".$r['address']."');
$('#add_name').val('".$r['name']."');
$('#add_phone').val('".$r['phone']."');
";


if($r['tworoom']=="1"){
	echo "$('#add_tworoom2').attr('checked', true);";
}
else{
	echo "$('#add_tworoom1').attr('checked', true);";
}

if($r['duplex']=="1"){
	echo "$('#add_duplex2').attr('checked', true);";
}
else{
	echo "$('#add_duplex1').attr('checked', true);";
}


echo "
$('#add_emptyone').val('".$r['emptyone']."');
$('#add_emptyduplex').val('".$r['emptyduplex']."');
$('#add_emptytworoom').val('".$r['emptytworoom']."');
$('#add_spacious').val('".$r['spacious']."');
$('#add_ubill').val('".$r['ubill']."');
$('#add_charter').val('".$r['charter']."');
$('#add_deposit').val('".$r['deposit']."');
$('#add_monthlyrent').val('".$r['monthlyrent']."'); ";



if($r['gas']=="1"){
	echo "$('#add_gas2').attr('checked', true);";
}
else{
	echo "$('#add_gas1').attr('checked', true);";
}

if($r['miel']=="1"){
	echo "$('#add_miel2').attr('checked', true);";
}
else{
	echo "$('#add_miel1').attr('checked', true);";
}

if($r['aircon']=="1"){
	echo "$('#add_aircon2').attr('checked', true);";
}
else{
	echo "$('#add_aircon1').attr('checked', true);";
}



echo "
$('#add_etc').val('".$r['etc']."');

$('#flag').attr('value','update');
$('#addrequest_id').attr('value','".$_POST['addrequest_id']."');

$('#imgsrc').attr('src','addrequest/".$r['img'].".jpg?".time()."');
 
$('#addrequestroommodal').modal('show');";

 
if($_SESSION['member_id']=="superadmin"){
	echo "$('#addrequestroommodal_submit').replaceWith('<button class=\"btn btn-success\" onclick=\"requested_add();\">submit</button>');";
}
echo "	</script>";





?>