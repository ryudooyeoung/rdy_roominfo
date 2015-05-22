<?php

require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);

 

$result = $fpBatis->doSelect('Addrequest.selectAll');
	 
echo "<table class=\"table table-striped\"> ";
$i=0;
foreach($result as $r ){
 
		if($i%2==0){
			echo "<tr><td>";
			echo "<a  href=\"#\" onclick=\"load_requested({addrequest_id: '".$r['addrequest_id']."' });\" >".$r['member_id']." - ".$r['name']."</a>";
			echo "</td>";
		}
		else{
			echo "<td>";
			echo "<a  href=\"#\" onclick=\"load_requested({addrequest_id: '".$r['addrequest_id']."' });\" >".$r['member_id']." - ".$r['name']."</a>";
			echo "</td></tr>";
		}

		$i++;
 
}//end of foreach
echo " </table>";

 ?>