

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

function rmCss() {
    var head = document.getElementsByTagName('head')[0];
    var link = document.getElementsByTagName('link')[0];
    head.removeChild(link);
}

function rmJs() {
    var head = document.getElementsByTagName('head')[0];
    var script = document.head.script;
    head.removeChild(script);
}
