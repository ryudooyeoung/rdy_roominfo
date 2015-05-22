<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {

session_start();
$member_id = $_SESSION['member_id'];

$result = $fpBatis->doSelect('Manage.select', $member_id);
	
$i=0;

	if($result == null){
		if($member_id == "superadmin"){

			echo "<table class=\"table table-striped\"><tr>";

				$result_rid = $fpBatis->doSelect('Roominfos.selectAll');

				foreach( $result_rid as $rid ){
				

				if($i%2==0){
					echo "<td>";
					echo "<a  href=\"#\" onclick=\"manage_roominfo({room_id: '".$rid['room_id']."', member_id :'superadmin'});\" >".$rid['name']."</a>";
					echo "</td>";
				}
				else{
					echo "<td>";
					echo "<a  href=\"#\" onclick=\"manage_roominfo({room_id: '".$rid['room_id']."', member_id :'superadmin'});\" >".$rid['name']."</a>";
					echo "</td></tr>";
				}

				$i++;

					
					}//end of foreach
			echo "</table>";
		}

	}
	else{
  
//		echo "<div class=\"panel-group\" id=\"accordion\">";
		echo "<table class=\"table table-striped\"><tr><td colspan=2 align=center> 관리 목록 </td></tr><tr>";

		foreach( $result as $r ){
			$result_rid = $fpBatis->doSelect('Roominfos.select', $r['room_id']);

			foreach( $result_rid as $rid ){


			if($i%2==0){
					echo "<td>";
					echo "<a  href=\"#\" onclick=\"manage_roominfo({room_id: '".$rid['room_id']."', member_id :'".$member_id."'});\" >".$rid['name']."</a>";
					echo "</td>";
				}
				else{
					echo "<td>";
					echo "<a  href=\"#\" onclick=\"manage_roominfo({room_id: '".$rid['room_id']."', member_id :'".$member_id."'});\" >".$rid['name']."</a>";
					echo "</td></tr>";
				}

				$i++;

 
			}
		}//end of foreach
		echo "</table>";
		//echo "</div>";
		



		echo "<br>";
		echo "<table class=\"table table-striped\"><tr><td colspan=2 align=center> 추가요청 목록 </td></tr> <tr>";




		//추가요청 목록 출력
		$result_rid = $fpBatis->doSelect('Addrequest.selectM', $member_id);

		foreach( $result_rid as $rid ){


		if($i%2==0){
				echo "<td>";
				echo "<a  href=\"#\" onclick=\"load_requested({addrequest_id: '".$rid['addrequest_id']."'});\" >".$rid['name']."</a>   &nbsp;&nbsp; ";
				echo "<a  href=\"#\" onclick=\"del_requested({addrequest_id: '".$rid['addrequest_id']."', member_id : '".$member_id."'});\" ><span class=\"glyphicon glyphicon-trash\"></span></a>";
				echo "</td>";
			}
			else{
				echo "<td>";
				echo "<a  href=\"#\" onclick=\"load_requested({addrequest_id: '".$rid['addrequest_id']."'});\" >".$rid['name']."</a>   &nbsp;&nbsp; ";
				echo "<a  href=\"#\" onclick=\"del_requested({addrequest_id: '".$rid['addrequest_id']."', member_id : '".$member_id."'});\" ><span class=\"glyphicon glyphicon-trash\"></span></a>";
				echo "</td></tr>";
			}

			$i++;

 
		}//end of foreach
		echo "</table>";


	}//end of else

}?>