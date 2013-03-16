<!--
function WinPopUP(targetUrl, windowName, width, height, resizable, scrollbars, toolbar, locationn, menubar, status){

  var windowFeatures = "width=" + width + ",height=" + height + ",top=30,left=30,resizable=" + resizable + ",scrollbars=" + scrollbars + ",toolbar=" + toolbar + ",location=" + locationn + ",menubar=" + menubar + ",status="+status;
  windowPopUp = window.open(targetUrl, windowName, windowFeatures);
  windowPopUp.resizeTo(width+15,height+45);
  windowPopUp.focus();
}
//-->