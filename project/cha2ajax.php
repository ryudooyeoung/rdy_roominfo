<?


	session_start();
	unset($_SESSION['member_id']);
	unset($_SESSION['admin']);
 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>

<title>지도 검색</title>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta property="og:image" content="/img/axisj_sns.png" /> 
<meta property="og:site_name" content="Axis of Javascript - axisj.com" /> 
<meta property="og:description" id="meta_description" content="Javascript UI Library based on JQuery" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />




<!--jquery import-->
 <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

<!--daum map api-->
<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=8474d18375c82c862db9c1e4988d7f4ad068bf79" charset="utf-8"></script>








<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">


    <script src="http://malsup.github.com/jquery.form.js"></script>


<!-- css block -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<style type="text/css">
html, body {margin: 0; padding: 0;  height: 100%; overflow:hidden;}
</style>

<!--side bar-->
<link rel="stylesheet" type="text/css" href="/css/jquery.pageslide.css" />
 
<!--별점 주기 -->
<link href="/css/rateit.css" rel="stylesheet" type="text/css">
<link href="/content/bigstars.css" rel="stylesheet" type="text/css">
<link href="/content/antenna.css" rel="stylesheet" type="text/css">
<link href="/content/svg.css" rel="stylesheet" type="text/css">


<!-- 부트스트랩 -->
<link rel="stylesheet" href="/css/bootstrap.min.css"  media="screen">
<link rel="stylesheet" href="/css/roomtable.css" type="text/css"/>
<link rel="stylesheet" href="/css/roompopup.css" type="text/css"/>

<!-- axisj 
<link rel="stylesheet" type="text/css" href="/_AXJ/ui/default/AXJ.css" />
<link rel="stylesheet" type="text/css" href="/_AXJ/ui/default/AXButton.css" />
<link rel="stylesheet" type="text/css" href="/_AXJ/ui/default/AXProgress.css" />-->
 
<!-- js block --><!--
<script type="text/javascript" src="/_AXJ/jquery/jquery.min.js"></script>

<script type="text/javascript" src="/_AXJ/lib/AXJ.js"></script>
<script type="text/javascript" src="/_AXJ/lib/AXProgress.js"></script>
<script type="text/javascript" src="/_AXJ/lib/AXCodeView.js"></script> -->
<!--axisj progress bar javascript
<script type="text/javascript" src="/js/AXProgress_start.js"></script>-->

 
<script type="text/javascript" src="//101.livere.co.kr/js/livere8_lib.js" charset="utf-8"></script>



<!--DAUM맵을 관리하는 부분-->
<script type="text/javascript">

/*
var myProgress = new AXProgress();

var fnObj = {
		progress: {
			start: function(){
			mask.open();
			myProgress.start(function(){
				//trace(this);
				if(this.isEnd){
					myProgress.close();
					mask.close();
					toast.push('검색 결과 : '+c);
				}else{
					// 무언가 처리를 해줍니다.	대부분 비동기 AJAX 통신 처리 구문을 수행합니다.
					myProgress.update(); // 프로그레스의 다음 카운트를 시작합니다.
				}	
			}, 
			{
				totalCount:15,
				width:200, 
				top:200, 
				title:"Set Options Type Progress"
			});
		} 
	}
};

$(document.body).ready(function(){
	fnObj.progress.start();
});

*/


	//변수 설정 및 최초 위치 설정
	var map;
	var position = new daum.maps.LatLng(37.88404187986277, 127.73779386404715);
	var infowindow_c = new Array();
	var infowindow = new Array();
	var marker = new Array();

	var c=0;

	function init() {
		//PHP를 이용하여 DB 쿼리
		//결과를 JAVASCRIPT로 출력
	
		$.ajax({
			type: "POST",
			url: "search.php",
			//form 의 내용을 serialize화 화여 ajax 처리
				success: function(msg){
 
					map = new daum.maps.Map(document.getElementById('map'), {
						center: position,
						level: 4,
						mapTypeId: daum.maps.MapTypeId.ROADMAP
					});


					//질의 결과를 삽입하여 javascript로 처리
					$("body").append(msg);

				},
			error: function(request,status,error){
				alert("failure");
				 alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
 
	}	


	//방정보 모달에 추가될 내용을 추가하는 함수
	//방정보, 평가, 게시판 내용 로드
	function add_tab_content( arg ){
 
		if ( $("#add_tab_content").length > 0 ) { $('#add_tab_content').remove();     $('meta').remove();}

		//탭 로드(방 기본정보와 평가기능 로드);
		$.ajax({
			type: "POST",
			url: "add_tab_content.php",
			data: { room_id : arg.room_id },
			success: function(msg){
				$("#testtab"+arg.room_id).html(msg);
					
					//로드뷰 로드
					 $.ajax({
						type: "POST",
						url: "add_roadview.php",
						data: { room_id : arg.room_id },
						success: function(msg){
							$("#roominfo_roadview"+arg.room_id).html(msg);
						},
						error: function(){
							alert("failure");
						}
					}); 
 
				//livere 댓글 로드
				$("#qna"+arg.room_id).html("<iframe src=\"livere.php?idx="+arg.room_id+"\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"500px\" ></iframe>");

				add_evaled( { room_id : arg.room_id } );
				add_avgevaled( { room_id : arg.room_id } );



				//게시판 추가
				$("#board"+arg.room_id).html("<iframe src=\"http://ruydoo0711.dothome.co.kr/gnu/bbs/board.php?bo_table=board\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"700px\" ></iframe>");
 



			},
			error: function(){
				alert("failure");
			}
		}); 
	}

	//평가 내역 로드
	function add_evaled(arg){
		if ( $("#load_evaled").length > 0 ) { $('#load_evaled').remove();     $('meta').remove();}

		$.ajax({
		type: "POST",
		url: "add_evaled.php",
		data: { room_id : arg.room_id },
			success: function(msg){
				$("#evaled"+arg.room_id).html(msg);
				
			},
		error: function(){
			alert("failure");
			}
		});
	}

	//평균 평가 로드
	function add_avgevaled(arg){
		if ( $("#load_avgevaled").length > 0 ) { $('#load_avgevaled').remove();     $('meta').remove();}

		$.ajax({
		type: "POST",
		url: "add_avgevaled.php",
		data: { room_id : arg.room_id },
			success: function(msg){
				$("#avgevaled"+arg.room_id).html(msg);
				
			},
		error: function(){
			alert("failure");
			}
		});
	}


	//평가 하기
	function evaluation(arg){
 
		$.ajax({
		type: "POST",
		url: "evaluation.php",
		data: { soundproof : $('#soundproof_eval'+arg.room_id).rateit('value'),
					access : $('#access_eval'+arg.room_id).rateit('value'),
					facility : $('#facility_eval'+arg.room_id).rateit('value'),
					security : $('#security_eval'+arg.room_id).rateit('value'),
					clean : $('#clean_eval'+arg.room_id).rateit('value'),
					room_id : arg.room_id
			},
			success: function(msg){
				alert(msg);

				add_evaled( { room_id : arg.room_id } );
				add_avgevaled( { room_id : arg.room_id } );
			},
		error: function(){
			alert("failure");
			}
		});
	}

	//평가 수정 하기
	function evaluation_modify(arg){
 
		$.ajax({
		type: "POST",
		url: "evaluation.php",
		data: { soundproof : $('#soundproof_eval'+arg.room_id).rateit('value'),
				access : $('#access_eval'+arg.room_id).rateit('value'),
				facility : $('#facility_eval'+arg.room_id).rateit('value'),
				security : $('#security_eval'+arg.room_id).rateit('value'),
				clean : $('#clean_eval'+arg.room_id).rateit('value'),
				room_id : arg.room_id,
				member_id : arg.member_id,
				flag : "update" 
			},

			success: function(msg){
				alert(msg);
 
				add_evaled( { room_id : arg.room_id } );
				add_avgevaled( { room_id : arg.room_id } );
			},
		error: function(){
			alert("failure");
			}
		});
	}



	//장바구니추가
	function addlist(idx){
		//$.pageslide.close();
		$.ajax({
			type: "POST",
			url: "addlist.php",
			data: { room_id : idx },
				success: function(msg){
				if ( $("#update_basket").length > 0 ) { $('#update_basket').remove();     $('meta').remove();}
				if ( $("#sub_basket").length > 0 ) { $('#sub_basket').remove();     $('meta').remove();}
				if ( $("#add_basket").length > 0 ) { $('#add_basket').remove();     $('meta').remove();}
					$("body").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});

	}	
	
	//장바구니 제거
	function sublist(room_id){
		//$.pageslide.close();
	
		$.ajax({
			type: "POST",
			url: "sublist.php",
			data: { room_id : room_id },
				success: function(msg){

				if ( $("#update_basket").length > 0 ) { $('#update_basket').remove();     $('meta').remove();}
				if ( $("#sub_basket").length > 0 ) { $('#sub_basket').remove();     $('meta').remove();}
				if ( $("#add_basket").length > 0 ) { $('#add_basket').remove();     $('meta').remove();}
					$("body").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});

	}	
	

	//전체 찜하기버튼 세팅
	function update_basket(member_id){
		$.ajax({
			type: "POST",
			url: "updatebasket.php",
			data: { member_id : member_id },
				success: function(msg){
				if ( $("#update_basket").length > 0 ) { $('#update_basket').remove();     $('meta').remove();}
				if ( $("#sub_basket").length > 0 ) { $('#sub_basket').remove();     $('meta').remove();}
				if ( $("#add_basket").length > 0 ) { $('#add_basket').remove();     $('meta').remove();}
					$("body").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});
	}

	//장바구니 목록 로디
	function load_basketlist(member_id){
		$.ajax({
			type: "POST",
			url: "load_basketlist.php",
			data: { member_id : member_id },
				success: function(msg){
					$("#basket_list").html("");
					$("#basket_list").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});
	}

	//전체 관리버튼 세팅
	function update_manage(member_id){
		$.ajax({
			type: "POST",
			url: "updatemanage.php",
			data: { member_id : member_id },
				success: function(msg){
					$("body").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});
	}


	//관리 목록 로더
	function load_managelist(member_id){
		$.ajax({
			type: "POST",
			url: "load_managelist.php",
			data: { member_id : member_id },
				success: function(msg){
					$("#manage_list").html("");
					$("#manage_list").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});
	}



	//인포윈도우 열기
	function click_infowindow(arg){
		//$.pageslide.close();
		$('#myModal'+arg.room_id).modal('show');
		add_tab_content(arg);
	}

	//인포윈도우 마우스오버
	var preflag;
	function mouseover_infowindow(arg){
		map.panTo(new daum.maps.LatLng(arg.x, arg.y));
		infowindow_c[arg.idx].open(map,marker[arg.idx]);
		if(preflag!=null){
			 
			if(preflag!=arg.idx){
				infowindow_c[preflag].close(map,marker[preflag]);
			}
		}
		preflag=arg.idx;
	}


	//방 리스트 출력
	function opensidebar(){
		$.pageslide({ direction: 'left', modal: true, href: '#slidecontent' });
		$('#pageslide').prepend('<center style=\"padding-bottom:5px\"><button  class=\"btn btn-primary\" onclick=\"javascript:$.pageslide.close();\"> CLOSE </button></br>검색결과 : '+c+'</center>');
	}
  

	 //로그인
	 $(function() {
		$("button#login_submit").click(function(){
			
			var string = $('#member_id').val();
			
			if( string.indexOf("@") != -1 ){
			}
			else{
				alert('이메일 사용');
			}

			
			
	$.ajax({
			type: "POST",
			url: "login.php",
			data: $('#loginmodal_form').serialize(),
				success: function(msg){
					if ( $("#login_result").length > 0 ) { $('#join').remove();     $('meta').remove();}
					//$("#thanks").html(msg);
					$("#loginmodal").modal('hide');	
					$("#member_login_info").replaceWith(msg);
				},
			error: function(){
				alert("failure");
				}
			});


		});
	});





	//로그아웃
	function logout(){ 
		location.reload();   // 새로고침
	}


$(function() {
		$("button#join_submit").click(function(){
			$.ajax({
			type: "POST",
			url: "join.php",
			data: $('#joinmodal_form').serialize(),
				success: function(msg){
					$("#joinmodal").modal('hide');	
					if ( $("#join").length > 0 ) { $('#join').remove();     $('meta').remove();}
					$("body").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});
		});
	});


	//방정보 가져오기
	function manage_roominfo(args){
		load_managelist(args.member_id);

		$.ajax({
			type: "POST",
			url: "modifyroominfosetting.php",
			data: { room_id : args.room_id },
				success: function(msg){
					$("#modifyroom_form").html(msg);
					$('#modifyroommodal').modal('show');
					$('#myModal'+args.room_id).modal('hide');


				},
			error: function(){
				alert("failure");
				}
				});
 
	}


	
	//방정보변경 
	$(function() {
		$("button#modifyroom_submit").click(function(){
 
            $("#modifyroom_form").ajaxSubmit({
            type: 'post',
            url: 'modifyroom.php',
            data: "stringData",
				success:function(msg){
					alert(msg);
				}
			});

		});
	});


	//회원정보 가져오기
	function modifyinfo(arg){
			$.ajax({
			type: "POST",
			url: "modifyinfosetting.php",
			data: {member_id : arg.member_id },
				success: function(msg){
 
					if ( $("#modifyinfo").length > 0 ) { $('#modifyinfo').remove();     $('meta').remove();}
					$("body").append(msg);
				},
			error: function(){
				alert("failure");
				}
			});
	}



	//개인정보변경 
	$(function() {
		$("button#modify_submit").click(function(){
			$.ajax({
			type: "POST",
			url: "modifyinfo.php",
			data: $('#modify_form').serialize(),
				success: function(msg){
					$("#modifymodal").modal('hide');	
//					$("body").append(msg);
 
				},
			error: function(){
				alert("failure");
				}
				});
		});
	});


	//추가요청 폼 리넷
	function reset_requestform(){
 
		$('#add_address').val("");
		$('#add_name').val("");
		$('#add_phone').val("");

		$('#add_tworoom2').removeAttr('checked');
		$('#add_tworoom1').removeAttr('checked');
		$('#add_duplex2').removeAttr('checked');
		$('#add_duplex1').removeAttr('checked');

		$('#add_emptyone').val("");
		$('#add_emptyduplex').val("");
		$('#add_emptytworoom').val("");
		$('#add_spacious').val("");
		$('#add_ubill').val("");
		$('#add_charter').val("");
		$('#add_deposit').val("");
		$('#add_monthlyrent').val("");

		$('#add_gas2').removeAttr('checked');
		$('#add_gas1').removeAttr('checked');
		$('#add_miel2').removeAttr('checked');
		$('#add_miel1').removeAttr('checked');
		$('#add_aircon2').removeAttr('checked');
		$('#add_aircon1').removeAttr('checked');
		$('#add_etc').val("");

		$('#flag').attr('value','insert');
		$('#imgsrc').attr('src','');

		$('.fileinput-preview img').attr('src','');
		$('.fileinput-preview img').attr('style','width: 200px; height: 150px;');
	}



	//추가요청 
	$(function() {
		$("#addrequestroommodal_submit").click(function(){
 
		 if ( $("#add_request").length > 0 ) { $('#add_request').remove();    } 

			$("#addrequestroommodal_form").ajaxSubmit({
            type: 'post',
            url: 'add_request.php',
            data: "stringData",
				success:function(msg){
					$("body").append(msg);
				}
			});
  
		});
	});


	//추가요청 불러오기
	function load_requested(arg){
		//alert(arg.addrequest_id);
 
      if ( $("#load_requested").length > 0 ) { $('#load_requested').remove();    } 
		$.ajax({
		type: "POST",
		url: "load_requested.php",
		data: { addrequest_id : arg.addrequest_id },
			success: function(msg){
				$("body").append(msg);
			},
		error: function(){
			alert("failure");
			}
		});

		//$('#addrequestroommodal').modal('show');
	}

//요청 삭제
function del_requested(arg){
 
	 $.ajax({
		type: "POST",
		url: "del_requested.php",
		data: { addrequest_id : arg.addrequest_id },
			success: function(msg){
 
			},
		error: function(){
			alert("failure");
			}
		});

		load_managelist(arg.member_id);
}

//추가요청 리스트 출력(운영자)
function load_addrequestlist(){
	 $.ajax({
		type: "POST",
		url: "load_addrequestlist.php",
		  success: function(msg){
				$('#addreques_list').html(msg);
			},
		error: function(){
			alert("failure");
			}
	});

}


//추가요청사항 삽입(운영자)
function requested_add(){
	 	$("#addrequestroommodal_form").ajaxSubmit({
            type: 'post',
            url: 'requested_add.php',
            data: "stringData",
				success:function(msg){
 
					load_addrequestlist();
					init();
				}
			});

}

function add_By_superadmin(){
	if ( $('#add_x').length < 1 ) { 
		$('#addrequestroommodal_form table').prepend('<tr><td><label for=\"inputPassword\" class=\"col-lg-4 control-label\">x</label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control input-sm\" name=\"add_x\" id=\"add_x\"></div></td></tr>');
		$('#addrequestroommodal_form table').prepend('<tr><td><label for=\"inputPassword\" class=\"col-lg-4 control-label\">y</label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control input-sm\" name=\"add_y\" id=\"add_y\"></div></td></tr>');
		$('#addrequestroommodal_form table').append('<tr><td><label for=\"inputPassword\" class=\"col-lg-4 control-label\">그림파일명</label><div class=\"col-lg-8\"><input type=\"text\" class=\"form-control input-sm\" name=\"add_img\" id=\"add_img\"></div></td></tr>');
		
	$('#addrequestroommodal_submit').replaceWith('<button class=\"btn btn-success\" onclick=\"requested_add();\">submit</button>');
 }
}



</script>
</head>


<!------------------------------------------------------------------------------------------------------------------------------------->
<body onload="init()">
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px;">

 <div class="navbar-header" role="navigation">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav navbar-right pull-right">

	<li class="active"><a href="./cha2.php" style="height: 50px;"><span class="glyphicon glyphicon-refresh"> RESET</span></a></li>
	<li ><a href="javascript:void(0)" onclick="opensidebar();" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		<span class="glyphicon glyphicon-list"> LIST</span></a></li>
	<li><a href="#" data-toggle="modal" data-target="#moneysearch"><span class="glyphicon glyphicon-search"> 금액검색</span></a></li>
	<li><a href="#" data-toggle="modal" data-target="#consearch"><span class="glyphicon glyphicon-search"> 조건검색</span></a></li>
	<li id="member_login_info"><a href="#" data-toggle="modal" data-target="#loginmodal" ><span class="glyphicon glyphicon-log-in"> 로그인</span></a></li>
</ul>

</div><!-- /.navbar-collapse -->
</nav>

 


<!-- Map -->
<div id = "map"></div>
 
<!--side bar -->
<div id="slidecontent" style="height:100%; overflow-x:hidden; overflow-y:scroll; padding-top:10px; padding-bottom:30px"></div>




 
<!-- 로그인 모달 -->

<div id="loginmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Login</h4>
	  </div>

 
		<form class="contact" id="loginmodal_form">
		<fieldset>
			<center>
			<div class="modal-body">

				<h4>ID (이메일로 사용바랍니다.)</h4>
				<input class="input-xlarge" value="@" type="text" name="member_id" id="member_id">
				<h4>PASSWD</h4>
				<input class="input-xlarge" value="" type="password" name="passwd"  id="passwd">

			</div>
			</center>
		</fieldset>
		</form>


	  <div class="modal-footer">
		<button type="button" class="btn btn btn-primary" data-toggle="modal" data-target="#joinmodal">회원가입</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-success" id="login_submit">submit</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- 회원가입 모달 -->
<div id="joinmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Join</h4>
	  </div>

 
		<form class="contact" id="joinmodal_form">
		<fieldset>
			<center>
			

			<div class="modal-body">

				<h4>ID (이메일로 사용바랍니다.)</h4>
				<input class="input-xlarge" value="@" type="text" name="member_id">
				<h4>PASSWD</h4>
				<input class="input-xlarge" value="" type="password" name="passwd">
				<h4>phone</h4>
				<input class="input-xlarge" value="" type="text" name="phone">

				<input type="hidden" name="flag" value=-1>

			</div>
			</center>
		</fieldset>
		</form>


	  <div class="modal-footer">
		<button class="btn btn-success" id="join_submit">submit</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- 개인정보변경 모달 -->
<div id="modifymodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Modify</h4>
	  </div>

 
		<form class="contact" id="modify_form">
		<fieldset>
			<center>
			<div class="modal-body">

				<h4>PASSWD</h4>
				<input class="input-xlarge" value="" type="password" name="passwd" id="modify_passwd">
				<h4>phone</h4>
				<input class="input-xlarge" value="" type="text" name="phone" id="modify_phone">
				<input type="hidden" name="member_id" id="modify_member_id">
				<input type="hidden" name="flag" value=0>

			</div>
			</center>
		</fieldset>
		</form>


	  <div class="modal-footer">
		<button class="btn btn-success" id="modify_submit">submit</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- 찜목록 모달 -->
<div id="basketmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Basket List</h4>
	  </div>

		<fieldset>
			<center>
				<div class="modal-body" id="basket_list">
				</div>
			</center>
		</fieldset>

	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 관리목록 모달 -->
<div id="managemodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Manage List</h4>
	  </div>

		<fieldset>
			<center>
				<div class="modal-body" id="manage_list">
				</div>
			</center>
		</fieldset>

	  <div class="modal-footer" id="manage_footer">
		
		
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- 추가요청 목록 모달 -->
<div id="addrequestlistmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Addrequest List</h4>
	  </div>

		<fieldset>
			<center>
				<div class="modal-body" id="addreques_list">
				</div>
			</center>
		</fieldset>

	  <div class="modal-footer" id="manage_footer">
		
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- 방추요청  모달 -->
<div id="addrequestroommodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Add Request</h4>
	  </div>

		<fieldset>
		<form class="contact" id="addrequestroommodal_form" enctype="multipart/form-data">

		<table class="table table-striped">
 
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">주소</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_address" id="add_address" /></div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">원룸이룸</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_name" id="add_name" /></div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">연락처</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_phone" id="add_phone" /></div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">투룸 여부</label>
		<div class="col-lg-8">
			 <div class="radio-inline">
			  <label  >
				<input type="radio" name="add_tworoom" id="add_tworoom1" value="0" > X </label>
			</div>
			<div class="radio-inline">
			  <label >
				<input type="radio" name="add_tworoom" id="add_tworoom2" value="1" > O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">복층 여부</label>
		<div class="col-lg-8">
			 <div class="radio-inline">
			  <label  >
				<input type="radio" name="add_duplex" id="add_duplex1" value="0" > X </label>
			</div>
			<div class="radio-inline">
			  <label >
				<input type="radio" name="add_duplex" id="add_duplex2" value="1" > O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">빈 원룸 개수</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_emptyone" id="add_emptyone" /></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">빈 복층룸 개수</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_emptyduplex" id="add_emptyduplex" /></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">빈 투룸 개수</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_emptytworoom"id="add_emptytworoom" /></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">평균 평수</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_spacious"id="add_spacious"  /></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">내야할 관리비</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_ubill" id="add_ubill" /></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">평균 공과금</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_charter" id="add_charter"/></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">보증금</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_deposit" id="add_deposit"/></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">월세</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_monthlyrent" id="add_monthlyrent" /></div>
		</td></tr>

		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">도시가스 여부</label>
		<div class="col-lg-8">
			 <div class="radio-inline">
			  <label  >
				<input type="radio" name="add_gas" id="add_gas1" value="0" > X </label>
			</div>
			<div class="radio-inline">
			  <label >
				<input type="radio" name="add_gas" id="add_gas2" value="1" > O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">심야전기 여부</label>
		<div class="col-lg-8">
			 <div class="radio-inline">
			  <label  >
				<input type="radio" name="add_miel" id="add_miel1" value="0" > X </label>
			</div>
			<div class="radio-inline">
			  <label >
				<input type="radio" name="add_miel" id="add_miel2" value="1" > O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">에어컨 여부</label>
		<div class="col-lg-8">
			 <div class="radio-inline">
			  <label  >
				<input type="radio" name="add_aircon" id="add_aircon1" value="0" > X </label>
			</div>
			<div class="radio-inline">
			  <label >
				<input type="radio" name="add_aircon" id="add_aircon2" value="1" > O </label>
			</div>
		</div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">기타 사항</label>
		<div class="col-lg-8"><input type="text"  class="form-control input-sm" name="add_etc" id="add_etc" /></div>
		</td></tr>
		<tr><td>
		<label for="inputPassword" class="col-lg-4 control-label">그림파일</label>
		<div class="col-lg-8"> 

	

	<center>
		<div class="fileinput fileinput-new" data-provides="fileinput">
		  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			<img id="imgsrc"  src="">
		  </div>
		  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 300px;"></div>
		  <div>
			<span class="btn btn-default btn-file">
				<span class="fileinput-new"> Select image </span>
				<span class="fileinput-exists"> Change </span>
				<input type="file"  name="image">
			</span>
			<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		  </div>
		</div>
	</center>
	</div>

	</table>

	<input type="hidden" name="flag" id="flag" value="insert">
	<input type="hidden" name="addrequest_id" id="addrequest_id" value="">

		</form>
		</fieldset>

	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-success" id="addrequestroommodal_submit">submit</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- 방정보변경 모달 -->
<div id="modifyroommodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Modify</h4>
	  </div>

		<fieldset>
		<form class="contact" id="modifyroom_form" enctype="multipart/form-data">
		</form>
		</fieldset>

	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-success" id="modifyroom_submit">submit</button>
	  </div>

	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


 
<!-- 내용정보를 출력하는 MODAL-->
<div id="roominfo_modal"></div>

<!-- 금액검색 MODAL-->

<div id="moneysearch" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Search</h4>
	  </div>
 

 
		<form id="moneyform">
				<table class="table table-striped">
				<tr>
				<td>
				<div class="row">
					<div class="col-xs-6">
						<center><h5>보증금</h5></center>
						<select  id="depositop" id="depositop" name="depositop" class="form-control">
							<option value="0" SELECTED>이하</option>
							<option value="1" >이상</option>
							<option value="2" ><font size=2>조건없음</option>
						</select>

						<input type="text" id="deposit" name="deposit" class="form-control" placeholder="Text input" >  

					</div><!-- /.col-lg-6 -->
				 
					<div class="col-xs-6">
						<center><h5>월세</h5></center>
						<select   id="monthlyrentop" name="monthlyrentop" class="form-control">
							<option value="0" SELECTED>이하</option>
							<option value="1" >이상</option>
							<option value="2" ><font size=2>조건없음</option>
						</select>

						<input type="text" id="monthlyrent" name="monthlyrent" class="form-control" placeholder="Text input">

					</div> 

					<input type="hidden" id="gas" name="gas" value="3">
					<input type="hidden" id="miel" name="miel" value="3">
					<input type="hidden" id="aircon" name="aircon" value="3">
				</td>
				</tr>
				<tr><td>
					<div class="col-xs-12">
						<center>
						<label>
						  <input type="checkbox" name="byresult" value="1"> 결과 내 재검색
						</label>
						</center>
						</div>

				</td></tr>
				</table>
				</form>

					<div class="col-xs-12" style="margin-bottom:5px; margin-top:-10px;">
						<center>
						<button id="submit_money" class="btn btn-default">OK</button>

						</center>
					</div>

 
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- 조건검색 MODAL-->

<div id="consearch" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">

	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Search</h4>
	  </div>

 
			<form id="conform">

					<table class="table table-striped">
					<tr>
					<td align='center'>
						<div class="col-xs-12">
							<label class="col-xs-12 control-label">전기가스</label>
							<label> <input type="radio" name="gas" value="0"><font size="2">없음 &nbsp; </label>
							<label> <input type="radio" name="gas" value="1" checked><font size="2">있음 &nbsp; </label>
							<label> <input type="radio" name="gas" value="2"  ><font size="2">조건없음 &nbsp; </label>

						</div><!-- /.col-lg-6 -->
					</tr>
					</td> 

					<tr>
					<td align='center'>
						<div class="col-xs-12">
							<label class="col-xs-12 control-label">심야전기</label>
							<label> <input type= "radio" name="miel" value="0"><font size="2">없음 &nbsp;</label>
							<label> <input type= "radio" name="miel" value="1" checked><font size="2">있음 &nbsp;</label>
							<label> <input type= "radio" name="miel" value="2"  ><font size="2">조건없음 &nbsp;</label>
						</div> 
					</td>
					</tr>

					<tr>
					<td align='center'>

						<div class="col-xs-12">
							<label class="col-xs-12 control-label">에어컨</label>
							<label> <input type= "radio" name="aircon"  value="0"><font size="2">없음 &nbsp; </label>
							<label> <input type= "radio" name="aircon"  value="1" checked><font size="2">있음 &nbsp; </label>
							<label> <input type= "radio" name="aircon"  value="2"  ><font size="2">조건없음 &nbsp; </label>
					<input type="hidden" name="deposit" value="3">
					<input type="hidden" name="monthlyrent" value="3">
					<input type="hidden" name="depositop" value="3">
					<input type="hidden" name="monthlyrentop" value="3">
						</div><!-- /.col-lg-6 -->
					</td>
					</tr>
					<tr><td>
					<div class="col-xs-12">
						<center>
						<label>
						  <input type="checkbox" name="byresult" value="1"> 결과 내 재검색
						</label>
						</center>
						</div>

				</td></tr>
				</table>
				</form>

					<div class="col-xs-12" style="margin-bottom:5px; margin-top:-10px;">
						<center>
						<button id="submit_con" class="btn btn-default">OK</button>

						</center>
					</div>
				
 
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->







<script type="text/javascript">
 

		
 


$('#submit_con').click(function() { 
 
 		 if ( $("#sql").length > 0 ) { $('#sql').remove();     $('meta').remove();}

		$.ajax({
			type: "POST",
			url: "search.php",
			//form 의 내용을 serialize화 화여 ajax 처리
			data: $('#conform').serialize(),
				success: function(msg){
					//기존의 div초기화
					$("div[id^='myModal']").remove(); 	$("div[id^='testtab']").remove();	$("div[id^='room_list']").remove();

					// 기존의 map을 초기화
					$('#map').remove();
					$('#slidecontent').before('<div id = "map"></div>');
					map = new daum.maps.Map(document.getElementById('map'), {
						center: position,
						level: 4,
						mapTypeId: daum.maps.MapTypeId.ROADMAP
					});


					//질의 결과를 삽입하여 javascript로 처리
					$("body").append(msg);

					//모달을 숨김
					$("#consearch").modal('hide');	

						opensidebar();
				},
			error: function(request,status,error){
				alert("failure");
				 alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
	});


 	var re_id = /^[0-9]/; // 아이디 검사식
	
	var uid = $('#deposit');
	var uid2 = $('#monthlyrent');
	
	$('#submit_money').click(function() {
 		if( $('#depositop').val() !=2){
			if (re_id.test(uid.val()) != true) { // 아이디 검사
				alert('[ID 입력 오류] 유효한 ID를 입력해 주세요.');
				uid.focus();
				return false;
			} else if (uid.val() <= 0) { // 입력 값이 3보다 작을 때
				alert('0보다 적음');
				uid.focus();
				return false;
			}
		}
		else{
			$('#deposit').val('0')
		}

		if( $('#monthlyrentop').val() !=2){
			if (re_id.test(uid2.val()) != true) { // 아이디 검사
				alert('[ID 입력 오류] 유효한 ID를 입력해 주세요.');
				uid2.focus();
				return false;
			} else if (uid2.val() <= 0) { // 입력 값이 3보다 작을 때
				alert('0보다 적음');
				uid2.focus();
				return false;
			}
		}
		else{
			$('#monthlyrent').val('0')
		}
 
		 if ( $("#sql").length > 0 ) { $('#sql').remove();     $('meta').remove();}

		$.ajax({
			type: "POST",
			url: "search.php",
			//form 의 내용을 serialize화 화여 ajax 처리
			data: $('#moneyform').serialize(),
				success: function(msg){

	 			
					//기존의 div초기화
					$("div[id^='myModal']").remove(); $("div[id^='testtab']").remove();  $("div[id^='room_list']").remove();

					// 기존의 map을 초기화
					$('#map').remove();
					$('#slidecontent').before('<div id = "map"></div>');
					map = new daum.maps.Map(document.getElementById('map'), {
						center: position,
						level: 4,
						mapTypeId: daum.maps.MapTypeId.ROADMAP
					});


					//질의 결과를 삽입하여 javascript로 처리
					$("body").append(msg);

					//모달을 숨김
					$("#moneysearch").modal('hide');	
					opensidebar();
				
				},
			error: function(request,status,error){
				alert("failure");
				 alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
	});//end of submit_money click
	
	

 
	$('#deposit').after('<strong></strong>');
	$('#monthlyrent').after('<strong></strong>');
	
	// #uid 인풋에서 onkeyup 이벤트가 발생하면
	uid.keyup( function() {
		var s = $(this).next('strong'); // strong 요소를 변수에 할당
		if (uid.val().length == 0) { // 입력 값이 없을 때
			s.text(''); // strong 요소에 포함된 문자 지움
		} else if (uid.val() <= 0) { // 입력 값이 3보다 작을 때
			s.text('0보다 적음.'); // strong 요소에 문자 출력
		}  else { // 입력 값이 3 이상 16 이하일 때
			s.text('적당해요.'); // strong 요소에 문자 출력
		}
	});
 	 
	 uid2.keyup( function() {
		var s = $(this).next('strong'); // strong 요소를 변수에 할당
		if (uid2.val().length == 0) { // 입력 값이 없을 때
			s.text(''); // strong 요소에 포함된 문자 지움
		} else if (uid2.val() <= 0) { // 입력 값이 3보다 작을 때
			s.text('0보다 적음.'); // strong 요소에 문자 출력
		}  else { // 입력 값이 3 이상 16 이하일 때
			s.text('적당해요.'); // strong 요소에 문자 출력
		}
	});
 	 

// ]]>
</script>





 
<!-- infomation modal-->
<script type="text/javascript">
	$(function(){ 
		$('.tooltip-test').tooltip();  
	});
 
</script> 

 
<script src="/js/jquery.pageslide.js"></script>


<!-- 별점주기-->
<script src="/js/jquery.rateit.js" type="text/javascript"></script>


<!--bootstrap-->
<script src="/js/bootstrap.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>


    </body>
</html>
