jQuery(document).ready(function($){
	var $form_modal = $('.cd-user-modal'),
		$form_chat = $('.chat-talk'),
		$form_out = $('.cd-signout'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_reset = $form_modal.find('#cd-reset-password'),
		$form_forgot_password = $form_modal.find('#cd-reset-password'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
		$back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
		$main_nav = $('.main-nav');

	//open modal
	$main_nav.on('click', function(event){

		if( $(event.target).is($main_nav) ) {
			// on mobile open the submenu
			$(this).children('ul').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$main_nav.children('ul').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');	
			//show the selected form
			( $(event.target).is('.cd-signin') ) ? login_selected() : login_selected();
		}

	});

	//close modal
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });

	//switch from a tab to another
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : login_selected();
	});

	//hide or show password
	$('.hide-password').on('click', function(){
		var $this= $(this),
			$password_field = $this.prev('input');
		
		( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
		( '隐藏' == $this.text() ) ? $this.text('显示') : $this.text('隐藏');
		//focus and move cursor to the end of input field
		$password_field.putCursorAtEnd();
	});

	//show forgot-password form 
	$forgot_password_link.on('click', function(event){
		event.preventDefault();
		//login_selected();
		//forgot_password_selected();
	});

	//back to login from the forgot-password form
	$back_to_login_link.on('click', function(event){
		event.preventDefault();
		login_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}

	function forgot_password_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.removeClass('is-selected');
		$form_forgot_password.addClass('is-selected');
	}

	function ch(){

	}

	$form_login.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		checkTb(this.form.id);
		//$('#'+this.form.id).submit();
	});
	$form_signup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		checkTb(this.form.id);
	});
	$form_reset.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		checkTb(this.form.id);
	});

	function checkTb(formId){
		var t=0;
		$('#'+formId+' input:not(:checkbox,:submit)').each(function(){
			if(this.value=='' || this.value==null){
				$(this).addClass('has-error').nextAll('span').addClass('is-visible');
				return false;
			}else{
				$(this).removeClass('has-error').nextAll('span').removeClass('is-visible');t++;
			}
		});
		
		if(t!=$('#'+formId+' input:not(:checkbox,:submit)').length){
			return false;
		}else{		
		console.log(t);
		user=$('#'+formId+' :input[name="user"]').val();
		pswd=$('#'+formId+' :input[name="pswd"]').val();
		  if(pswd=='123456'){
		  	ajax_check('http://zhiwoo.com.cn/zero/api/v1/rongcloud/talk_token?access_token=Z:0:!:5&username='+user,user);
		  }
		
		}
	}

function pgBar(ob){
	var idiv=document.getElementById('bar');
	var ibox=document.getElementById('bg');
	var timer=null;
	timer=setInterval(function(){
		var iWidth=idiv.offsetWidth/ibox.offsetWidth*100;
		idiv.style.width=idiv.offsetWidth+1+'px';
		idiv.innerHTML='Loading... '+Math.round(iWidth)+"%";
		if(iWidth==100){
			console.log('完成');
			clearInterval(timer);
			setTimeout(function(){
				ob.hide();
				window.location.href='talk.html';
			}, 5);
		//跳转页面	window.location.href="http://www.zhiwoo.com.cn";
		}
	},10);
}
		
		
	function ajax_check(url,d){
		$.get(url,function(su,status){
		  if(su.code==100){
		  	addCookie('username',d,24);
		  	addCookie('cToken',su.data.token,24);
		  	console.log(getCookie('cToken'));
			$('.cd-user-modal-container').hide();
			$('.cd-signin,.cd-signup').removeClass('in').addClass('out');
			alert('您的登录已 '+status);
			$('#bg').show();
			setTimeout(pgBar($('#bg')), 100);
		  }
		});
	}

	function addCookie(names,value,expiresHours){ 
		var cookieString=names+"="+escape(value); 
		//判断是否设置过期时间 
		if(expiresHours>0){ 
		var date=new Date(); 
		date.setTime(date.getTime+expiresHours*3600*1000); 
		cookieString=cookieString+"; expires="+date.toGMTString(); 
		} 
		document.cookie=cookieString; 
	} 
	function getCookie(names){
		if (document.cookie.length>0){
		  start=document.cookie.indexOf(names + "=")
		  if (start!=-1)
		    { 
		    start=start + names.length+1 
		    end=document.cookie.indexOf(";",start)
		    if (end==-1) end=document.cookie.length
		    return unescape(document.cookie.substring(start,end))
		    } 
    	}
	return "";
	}

	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
		  	}
		}).blur(function() {
		 	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  	$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
			 		input.val('');
				}
		  	})
		});
	}



});

function bgM(){
    i=0;
    function act(){
      if(i>=10){i=1;}else{i=i+1;}
        $('.cd-user-showBg').fadeIn('2500',function(){
          $(this).css({
        background: 'url(images/showBg'+i+'.png)',
        filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')",
          "background-size":'100% 100%'
          });
        });
    }
    times=setInterval(act,3000);
    $('.cd-user-showBg').hover(
      function(){
        clearInterval(times);
    },
      function(){
        times=setInterval(act,3000);
    });
}

jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	if (this.setSelectionRange) {
      		
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
      		$(this).val($(this).val());
    	}
	});
};

