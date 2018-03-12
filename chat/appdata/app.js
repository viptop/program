
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
	return ""
	}

	function checkCookie(s){
		udata=getCookie(s);
		if (udata!=null && udata!="")
		{alert('欢迎回来 '+udata+'!');
		 document.getElementById('chating').style.display='block';
		}else{
			alert('非法进入聊天！');
			window.location.href='index.html';
		}
	}
	
	function delCookie(n){
	    var exp = new Date();
	    exp.setTime(exp.getTime() - 100);
	    var cval=getCookie(n);
	    if(cval!=null){
        document.cookie= n + "="+cval+";expires="+exp.toGMTString();
    	}
	}