	function getQueryVariable(variable){
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       	for (var i=0;i<vars.length;i++) {
	            var pair = vars[i].split("=");
	            if(pair[0] == variable){return pair[1];}
	       	}
	       return(false);
	}
	var coco=getQueryVariable('nopbl');
	function checkPhone(){
		var phone=$('#tel').val();
		var pattern = /^1[0-9]{10}$/;
		
		var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
		 
		 isPhone=1;
		if(phone == '') {
            $('#check_1').show();
            isPhone = 0;
            return;
        }
         else{
         $('#check_1').hide();

         }
         if(!pattern.test(phone)){
            $('#check_1').text('*请输入正确的手机号码')
            $('#check_1').show();
            isPhone = 0;
            return;
        }
        else{
         $('#check_1').hide();
         }
         
        if(!myreg.test($("#tel").val())){
            $('#tel').text('请输入有效的手机号码')
            $('#check_1').show();
            isPhone = 0;
            return;
        }else{
         $('#check_1').hide();
         }
         if(phone!=''&&pattern.test(phone)&&myreg.test($("#tel").val())){
         	var name = $('.text1').val();
         	var phones = $('.text2').val();
         	var city = $('.text3').val();
         	var address = $('.text4').val();
         	var Zipcode = $('.text5').val();
         	
         	if(name== ''||city== ''||address== ''){
         		alert('有未填项')
         	}else{
               document.querySelector("#valid").submit();
         	}
         }

	}
	
