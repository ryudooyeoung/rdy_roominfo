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
					toast.push("progress end");
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