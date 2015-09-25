
// iframe 自动调整高度
function iFrameAutoHeight(id) {
    var cwin =  document.getElementById(id);
    if (cwin && !window.opera){
      if (cwin.contentDocument && cwin.contentDocument.body.offsetHeight)
        cwin.height = cwin.contentDocument.body.offsetHeight + 20; //FF NS 
      else if (cwin.Document && cwin.Document.body.scrollHeight)
        cwin.height = cwin.Document.body.scrollHeight + 10;//IE 
    }else if (cwin.contentWindow.document && cwin.contentWindow.document.body.scrollHeight){
        cwin.height = cwin.contentWindow.document.body.scrollHeight;//Opera 
    }
}