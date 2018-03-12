

$(window).on("orientationchange",function(){
	if(window.orientation == 0) // Portrait
	{
	inCss('../css/index.css');
	}
	else // Landscape
	{
	inCss('../css/dndex.css');
	}
});


// css 
function inCss(filename) {
    var head = document.getElementsByTagName('head')[0];
    var link = document.createElement('link');
    link.href = filename;
    link.rel = 'stylesheet';
    link.type = 'text/css';
    head.appendChild(link);
}


// js 
function inJs(filename) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';
    head.appendChild(script);
}