

<?php



require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


$room_id = $_POST['room_id'];


$result = $fpBatis->doSelect('Evaluation.select_r',$room_id);

echo"
<link href=\"/css/rateit.css\" rel=\"stylesheet\" type=\"text/css\">
<link href=\"/content/bigstars.css\" rel=\"stylesheet\" type=\"text/css\">
<link href=\"/content/antenna.css\" rel=\"stylesheet\" type=\"text/css\">
<link href=\"/content/svg.css\" rel=\"stylesheet\" type=\"text/css\">
<script src=\"/js/jquery.rateit.js\" type=\"text/javascript\"></script>";



	echo " 
		<style>
			td {text-align:center}
		</style>

		<div>";
	
	$count = 0;
	$soundproof=0;
	$access=0;
	$facility=0;
	$security=0;
	$clean=0;

	foreach( $result as $r ){
		$count++;
		$soundproof += $r['soundproof'];
		$access += $r['access'];
		$facility += $r['facility'];
		$security += $r['security'];
		$clean += $r['clean'];
	}
	
	//평가 평균 출력
		echo"
		<table class=\"table table-striped\">
			<tr>
				<td colspan=\"2\"><h3><span class=\"label label-default\">평가종합</span></h3></td>
			</tr>
			<tr>
				<td >방음</td><td> <div id=\"soundproof".$room_id."\" class=\"rateit bigstars\" data-rateit-starwidth=\"32\" data-rateit-starheight=\"32\" data-rateit-resetable=\"false\" data-rateit-readonly=\"true\"></div> </td>
			</tr>
			<tr>
				<td>접근성</td><td> <div id=\"access".$room_id."\" class=\"rateit bigstars\" data-rateit-starwidth=\"32\" data-rateit-starheight=\"32\" data-rateit-resetable=\"false\" data-rateit-readonly=\"true\"></div> </td>
			</tr>
			<tr>
				<td>시설</td><td> <div id=\"facility".$room_id."\" class=\"rateit bigstars\" data-rateit-starwidth=\"32\" data-rateit-starheight=\"32\" data-rateit-resetable=\"false\" data-rateit-readonly=\"true\"></div> </td>
			</tr>
			<tr>
				<td>방범</td><td> <div id=\"security".$room_id."\" class=\"rateit bigstars\" data-rateit-starwidth=\"32\" data-rateit-starheight=\"32\" data-rateit-resetable=\"false\" data-rateit-readonly=\"true\"></div> </td>
			</tr>
			<tr>
				<td>청결</td><td> <div id=\"clean".$room_id."\" class=\"rateit bigstars\" data-rateit-starwidth=\"32\" data-rateit-starheight=\"32\" data-rateit-resetable=\"false\" data-rateit-readonly=\"true\"></div> </td>
			</tr>
 
		</table>		
		";

		if($count>0){
			echo "
			<script>
			$('#soundproof".$room_id."').rateit('value', ".$soundproof/$count."); 
			$('#access".$room_id."').rateit('value', ".$access/$count."); 
			$('#facility".$room_id."').rateit('value', ".$facility/$count."); 
			$('#security".$room_id."').rateit('value', ".$security/$count."); 		
			$('#clean".$room_id."').rateit('value', ".$clean/$count."); 
			</script>";
		}


?>