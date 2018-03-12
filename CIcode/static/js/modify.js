
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
        }
         else{
         $('#check_1').hide();
         }
         if(phone != ''&&pattern.test(phone)&&myreg.test($("#tel").val())){
         	
         	function getQueryVariable(variable){
		       var query = window.location.search.substring(1);
		       var vars = query.split("&");
		       	for (var i=0;i<vars.length;i++) {
		            var pair = vars[i].split("=");
		            if(pair[0] == variable){return pair[1];}
		       	}
		       return(false);
			}
         	
         	var nice = getQueryVariable('coco');
         	var name = $('.text1').val();
         	var phone = $('.text2').val();
         	var city = $('.text3').val();
         	var address = $('.text4').val();
         	var Zipcode = $('.text5').val();
         	
         	console.log(nice,name,phone,city,address,Zipcode);
         	
         	$.ajax({
         		url:'/modify/custom',
         		type:'post',
         		data:{nice:nice,name:name,phone:phone,city:city,address:address,Zipcode:Zipcode},
         		dataType:'json',
				cache:false,
				success:function(resulf){
					console.log(resulf);
					if(resulf.status==0){
//						$('.top').text(resulf.msg)
						$('.zhezao').show();
						$('.Prompt').slideDown('show')
					}else{
						
					}
				}
         	});
         }
	}
	
