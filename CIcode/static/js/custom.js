
		function getQueryVariable(variable){
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       	for (var i=0;i<vars.length;i++) {
	            var pair = vars[i].split("=");
	            if(pair[0] == variable){return pair[1];}
	       	}
	       return(false);
		}
		var bill=getQueryVariable("m")//idname
		var i=getQueryVariable("id")//id
		var tick=getQueryVariable("S")
		var Shopp=getQueryVariable("uu");
		var userbana='ShoppingCarts?users='+Shopp;
		var k=1;
		function plus(){
			k++;
			
			if(k<=1||k>10){
				k=1;
			}
			$('.input2').val(k);
			
		}
		
		function reduce(){
			k--;
			if(k<=1){
				k=1;
			}
		}
		var relut=[];
		function GoshoppBuy(){
			
			var sock=$('.a').text();
			var inption=$('.input2').val();

		
			$.ajax({
				url:'/shopping/ing',
				type:'post',
				data:{count:inption,sock:sock,id:i,account:bill,tick:tick,main:Shopp},
				dataType:'json',
				cache:false,
				success:function(resulf){
					console.log(resulf);
					switch(resulf.status){
						case '0' :
							console.log("购买成功")
							break;
						case '1' :
							console.log("积分不足");
							break;
						case '2' :
							console.log("未有收货地址");
							$('.right a').attr('href',userbana)
							$('.zhezao').show();
							$('.warning').slideDown();
							break;
						default:
							console.log("未知的错误，请重新刷新")
							break;
					}
				}
			})	
			return
		}

function marckhide(){
	$('.zhezao').hide();
	$('.warning').hide();
	$('.address').remove();
}
function cancel(){
	$('.zhezao').hide();
	$('.warning').hide();
}
	
