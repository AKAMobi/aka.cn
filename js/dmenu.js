//ProVision ERP Demo JScript File
//* Gary Liu 2001
//* For use of dynamic menu in the template file
//* (c) ProVision Software Inc. 2001
//* Version 1.20, last modified: Oct. 5, 2001


var clickable="visible";
function document_onclick()
{

hideAllMenus();
//menuVis=false;

}
document.onclick = document_onclick;
var menuVis=true;
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { 
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { 
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { 
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-3);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
menunum = a[4];
hideAllMenus();
    var menuId = 'menu' + menunum;
    if (menuVis){
		if(changeObjectVisibility(menuId, 'visible')) {
			return true;
		    } else {
		return false;
	    }
	}
}
  
 var baseURL="http://www.aka.cn";

function naVigateto(url)
{
window.location=baseURL+url;
}

function getStyleObject(objectId) {
    if(document.getElementById && document.getElementById(objectId)) {
return document.getElementById(objectId).style;
    } else if (document.all && document.all(objectId)) {
return document.all(objectId).style;
    } else if (document.layers && document.layers[objectId]) {
return document.layers[objectId];
    } else {
return false;
    }
} 
function changeObjectVisibility(objectId, newVisibility) {
    var styleObject = getStyleObject(objectId);
    if(styleObject) {
styleObject.visibility = newVisibility;
return true;
    } else {
return false;
    }
} 

var numMenus = 6;

function hideAllMenus() {

for(counter = 1; counter <= numMenus; counter++) {
changeObjectVisibility('menu' + counter, 'hidden');
}

}

function ShowMenu(menunum){
  
     //hideAllMenus;
     //menuVis=!menuVis;


}

function MM_reloadPage(init) {  
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

