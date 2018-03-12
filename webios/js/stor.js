
window.myStorage = (new (function(){  
  
    var storage;     
  
    if(window.localStorage){  
        storage = localStorage;     
    }  
    else{  
        storage = cookieStorage;      
    }  
  
    this.setItem = function(key, value){  
        storage.setItem(key, value);  
    };  
  
    this.getItem = function(name){  
        return storage.getItem(name);  
    };  
  
    this.removeItem = function(key){  
        storage.removeItem(key);  
    };  
  
    this.clear = function(){  
        storage.clear();  
    };  
})()); 


function setCookie(name,value)
{
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
    return unescape(arr[2]);
    else
    return null;
}