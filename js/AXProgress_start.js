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
					// ���� ó���� ���ݴϴ�.	��κ� �񵿱� AJAX ��� ó�� ������ �����մϴ�.
					myProgress.update(); // ���α׷����� ���� ī��Ʈ�� �����մϴ�.
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