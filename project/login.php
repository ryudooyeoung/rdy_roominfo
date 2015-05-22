<meta charset="utf-8">


<?


require('fpbatis.php');
$fpBatis = new FPBatis('sqlMap.xml');
$fpBatis->setDebug(true);


if (isset($_POST['member_id'])) {
$passwd = md5($_POST['passwd']);
$member_id = $_POST['member_id'];

 

$result = $fpBatis->doSelect('Members.select',$member_id);

foreach( $result as $r ){}

	if($result!=null && $r['passwd']==$passwd){
	//	echo "<a href=\"#\" id=\"btn_logout\" onclick=\"logout();\"><span class=\"glyphicon glyphicon-log-out\"> 로그아웃</span></a>";

		session_start();
		$_SESSION['member_id']=$member_id;
	 
	
		if($r['authority']=="common"){
			echo "<li class=\"dropdown\" id=\"member_login_info\">
				 <a href=\"#\" id=\"btn_member_info\" data-toggle=\"dropdown\"><span class=\"glyphicon glyphicon-user\">       </span></a>
				  <ul id=\"member_info_menu\" class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"btn_member_info\">
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"logout();\" style=\"padding:7px\">
							<center><span class=\"glyphicon glyphicon-log-out\">  로그아웃</span></center>
						</a>
					</li>
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"modifyinfo({ passwd : '".$r['passwd']."',phone : '".$r['phone']."', member_id : '".$r['member_id']."'});\" style=\"padding:7px\" data-toggle=\"modal\" data-target=\"#modifymodal\">
							<center><span class=\"glyphicon glyphicon-exclamation-sign\">  정보변경</span></center>
						</a>
					</li>
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"load_basketlist('".$r['member_id']."');\" style=\"padding:7px\" data-toggle=\"modal\" data-target=\"#basketmodal\">
							<center><span class=\"glyphicon glyphicon-th-list\">  찜목록</span></center>
						</a>
					</li>
				  </ul>
				</li>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
			<script id=\"member_basket\"> update_basket('".$member_id."'); </script>";
		}
		elseif($r['authority']=="admin"){
			$_SESSION['admin']="true";

			echo "<li class=\"dropdown\" id=\"member_login_info\">
				 <a href=\"#\" id=\"btn_member_info\" data-toggle=\"dropdown\"><span class=\"glyphicon glyphicon-user\">       </span></a>
				  <ul id=\"member_info_menu\" class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"btn_member_info\">
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"logout();\" style=\"padding:7px\">
							<center><span class=\"glyphicon glyphicon-log-out\">  로그아웃</span></center>
						</a>
					</li>
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"modifyinfo({ member_id : '".$r['member_id']."'});\" style=\"padding:7px\" data-toggle=\"modal\" data-target=\"#modifymodal\">
							<center><span class=\"glyphicon glyphicon-exclamation-sign\">  정보변경</span></center>
						</a>
					</li>
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"load_managelist('".$r['member_id']."');\" style=\"padding:7px\" data-toggle=\"modal\" data-target=\"#managemodal\">
							<center><span class=\"glyphicon glyphicon-th-list\">  관리목록</span></center>
						</a>
					</li>
				  </ul>
				</li>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
			<script id=\"member_basket\"> 

			update_manage('".$member_id."'); 

			$('#manage_footer').html('<button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\" data-target=\"#addrequestroommodal\" onclick=\"reset_requestform()\">추가요청</button><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>');
 

			</script>";
		}
		elseif($r['authority']=="superadmin"){
			$_SESSION['admin']="true";

			echo "<li class=\"dropdown\" id=\"member_login_info\">
				 <a href=\"#\" id=\"btn_member_info\" data-toggle=\"dropdown\"><span class=\"glyphicon glyphicon-user\">       </span></a>
				  <ul id=\"member_info_menu\" class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"btn_member_info\">
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"logout();\" style=\"padding:7px\">
							<center><span class=\"glyphicon glyphicon-log-out\">  로그아웃</span></center>
						</a>
					</li>
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"load_managelist('".$r['member_id']."');\" style=\"padding:7px\" data-toggle=\"modal\" data-target=\"#managemodal\">
							<center><span class=\"glyphicon glyphicon-th-list\">  관리목록</span></center>
						</a>
					</li>
					<li role=\"presentation\" >
						<a role=\"menuitem\" tabindex=\"-1\" onclick=\"load_addrequestlist();\" style=\"padding:7px\" data-toggle=\"modal\" data-target=\"#addrequestlistmodal\">
							<center><span class=\"glyphicon glyphicon-th-list\">  추가요청</span></center>
						</a>
					</li>

				  </ul>
				</li>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
			<script id=\"member_basket\"> 
			update_manage('".$member_id."'); 

			
			$('#manage_footer').html('<button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\" data-target=\"#addrequestroommodal\" onclick=\"add_By_superadmin()\">추가</button><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>');


			</script>";
		}
	}

	else{
		echo "<li id=\"member_login_info\"><a href=\"#\" data-toggle=\"modal\" data-target=\"#loginmodal\" ><span class=\"glyphicon glyphicon-log-in\">  로그인</span></a></li>";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" />
		<script id='login_result'> alert('로그인 실패입니다.'); </script>";
	}

 
}

?>