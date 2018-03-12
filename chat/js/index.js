$(document).ready(function(){
	checkCookie('username');
});

 
var talk = angular.module("zero", ["RongWebIMWidget"]);

talk.config(function($logProvider){
  // $logProvider.debugEnabled(false);
});
window.talk_config={
  appUrl: '',
  appKey: 'tdrvipksr8xb5', 
  appSecret: 'yegnLuWDvXb'
};

$('.cd-signout').on({
	click: function(){
	  if(confirm('确定退出？')){
		delCookie('username');
		delCookie('cToken');
		console.log(getCookie('username'));
		setTimeout(function(){
			window.location.href='index.html';
		},8);
	  }
	},
	mouseover: function(){
	},
	mouseout: function(){
	}
});

/*控制器部署*/

talk.controller("main", ["$scope","WebIMWidget", "$http", function($scope,WebIMWidget,
  $http){

    var k=window.talk_config.appKey;
    var token= getCookie('cToken');
    WebIMWidget.init({
      appkey: k,
      token: token,
      onSuccess:function(){
    //初始化完成
        console.log('success');
        $.post('http://zhiwoo.com.cn/zero/api/v1/rongcloud/talk_userinfo',{'access_token':'Z:0:!:5','tutorGet':1},function(its){
          its.data.forEach(function(item){
           var chat_box = '<li class="chat-items" key-name="'+item[1]+'" key-id="'+item[0]+'"><img src="'+item[2]+'" alt="" class="chat-img"/><span class="chat-username">'+item[1]+'</span></li>';
           //console.log(chat_box);
            $('#chat-list').append(chat_box);
          });
        });
      }, 
      onError:function(){
    //初始化错误
        console.log("error:"+error);
      },
      style:{
        height: 600,
        width: 850,
        positionFixed:true,
        bottom:0
      },
      //显示会话信息
      
      displayConversationList:true,
      conversationListPosition:WebIMWidget.EnumConversationListPosition.right,
      //最小化按钮显示
      displayConversationList:true,
      displayMinButton:true,
      //桌面通知
      desktopNotification:true,
      voiceUrl:'./images/sms-received.mp3'
    });

    $scope.show = function() {
      WebIMWidget.show();
      WebIMWidget.setConversation(1, 2, "对话中:");
    }

    $scope.hidden = function() {
      WebIMWidget.hidden();
    }

	WebIMWidget.onClose = function() {
	  //console.log('close');
	}

	WebIMWidget.onShow = function() {
	  //console.log('show');
	}
	
	WebIMWidget.onReceivedMessage = function(message) {
	  console.log('news '+message);
    $('.audio-tag').play();
	}

  function infoGet(parss){
    $.post('http://zhiwoo.com.cn/zero/api/v1/rongcloud/talk_userinfo',{'access_token':'Z:0:!:5','userGet':1,'nickName':parss},function(its){
      its.data.forEach(function(item){
      var chat_box = '<li class="chat-items" key-name="'+item[1]+'" key-id="'+item[0]+'"><img src="'+item[2]+'" alt="" class="chat-img"/><span class="chat-username">'+item[1]+'</span></li>';
      console.log(chat_box);
      $('#chat-list').html(chat_box);
      });
    });
  }
  function tutorInfo(){
    $('#chat-list').html('<span>正在查找中…</span>');
    $.post('http://zhiwoo.com.cn/zero/api/v1/rongcloud/talk_userinfo',{'access_token':'Z:0:!:5','tutorGet':1},function(its){
      $('#chat-list').html('');
        its.data.forEach(function(item){
          var chat_box = '<li class="chat-items" key-name="'+item[1]+'" key-id="'+item[0]+'"><img src="'+item[2]+'" alt="" class="chat-img"/><span class="chat-username">'+item[1]+'</span></li>';

          $('#chat-list').append(chat_box);
        });
    });
  }
  
  $('.showToggle').click(function(){
    if($(this).text()=='显示面板'){
      $(this).text('隐藏');
      WebIMWidget.show();
    }else{
      $(this).text('显示面板');
      WebIMWidget.hidden();
    }
  });
  $('.showReturn').click(function(){
    tutorInfo();
  });
  $('.talkSearch').on({
    click: function(){
      var did=$(this).prev('input').val();
      infoGet(did);
    }
  });

  $scope.server = WebIMWidget;
  $scope.targetType=1;
  //当前会话设置
  $scope.setconversation=function(){
    WebIMWidget.setConversation(Number($scope.targetType), $scope.targetId, "开始对话中");
  }

	//会话对象
  //console.log(WebIMWidget);
  $('#change-user').toggle(
    function(){
       pars= 'tutorGet';
    },
    function(){
       pars= 'userGet';
    }
  );

    WebIMWidget.setUserInfoProvider(function(targetId,obj){
    $http({
      method:'POST',
      url:'http://zhiwoo.com.cn/zero/api/v1/rongcloud/talk_userinfo',
      params:{
      	'access_token': 'Z:0:!:5'
      }
    }).success(function(data){
        var users;
        data.data.forEach(function(iv){
          if (iv[0]==targetId) {users=iv;}
        });
        if(users){
          obj.onSuccess({userId:users[0],name:users[1],portraitUri:users[2]});
        }
         
      });
    });

 $('#chat-list').on('click','.chat-items',function(){
    var Id=$(this).attr('key-id');
    var Names=$(this).attr('key-name');
    WebIMWidget.setConversation(WebIMWidget.EnumConversationType.PRIVATE,Id,"对话中："+Names);
  });

}]);
    

