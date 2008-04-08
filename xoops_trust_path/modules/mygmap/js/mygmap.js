//
// @package MyGmap
// @version $Id$
// @copyright Copyright 2006-2008 NobuNobuXOOPS Project <http://sourceforge.net/projects/nobunobuxoops/>
// @author NobuNobu <nobunobu@nobunobu.com>
// @license http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE Version 2
//

//Add sanitize method to String Object
String.prototype.htmlspecialchars = function() {
  var tmp = this.toString();
  tmp = tmp.replace(/\//g, "");
  tmp = tmp.replace(/&/g, "&amp;");
  tmp = tmp.replace(/"/g, "&quot;");
  tmp = tmp.replace(/'/g, "&#39;");
  tmp = tmp.replace(/</g, "&lt;");
  tmp = tmp.replace(/>/g, "&gt;");
  return tmp;
}

function myGmapAddEventListener(object, event, func){
  onEventStr = 'on'+event;
  if (object.addEventListener) { //for W3C DOM
    object.addEventListener(event, func, false);
//  } else if (object.attachEvent) { //for IE (comment out becauseof executing order is invalid)
//    object.attachEvent(onEventStr, func);
  } else  { //for Other partial event(load, unload, click, change) only
    var func_defstr='';
    var func_name = func.name;
    if (func_name == undefined) {
      var  funcIdxStart = 'function '.length;
      var  funcIdxEnd = func.toString().indexOf("(");
      func_name = func.toString().substr(funcIdxStart, funcIdxEnd-funcIdxStart);
    }
    if (event=='load' && object.onload != null) {
      func_defstr = object.onload.toString();
    } else if (event=='unload' && object.onunload != null) {
      func_defstr = object.onunload.toString();
    } else if (event=='click') {
      func_defstr = object.onclick.toString();
    } else if (event=='change') {
      func_defstr = object.onchange.toString();
    }
    
    if (func_defstr != '') {
      var  onEventIdx = func_defstr.indexOf("{") + 2;
      func_defstr = func_defstr.substr(onEventIdx, func_defstr.length-onEventIdx-2);
    }
    func_source = func_defstr+func_name+"();";
    if (event=='load') {
      object.onload = new Function(func_source);
    } else if (event=='unload') {
      object.onunload = new Function(func_source);
    } else if (event=='click') {
      object.onclick = new Function(func_source);
    } else if (event=='change') {
      object.onchange = new Function(func_source);
    }
  }
}

//Keep Initial listarea HTML for recovering from Search.
var myGmapSearchListElement;
var myGmapListInitHTML;
var myGmapAddressElement;
var myGmapCurAddress = {};
var myGmapCenterMarker;
var myGmapCenterIcon;
var myGmapLocSearch;
var myGmapListInMapOnly = 0;
var myGmapMapTypes = {};
var myGmapLatestKnownHoveringPoint = null;
var myGmapOverviewMapControl = null;

//Google Map Initializing
function myGmapLoad() {
  var element = document.getElementById('mygmap_map');
  if (element) {
    mygmap_map = new GMap2(element);
    mygmap_map.addControl(new GLargeMapControl());
    mygmap_map.addControl(new GMapTypeControl());
    mygmap_map.addControl(new GScaleControl());
    myGmapOverviewMapControl = new GOverviewMapControl();
    mygmap_map.addControl(myGmapOverviewMapControl);
    mygmap_map.enableContinuousZoom();
//    mygmap_map.enableDoubleClickZoom();
    myGmapCenterIcon = new GIcon();
    myGmapCenterIcon.image = iconpath +'marker_center.png';
    myGmapCenterIcon.shadow = iconpath +'marker_center_shadow.png';
    myGmapCenterIcon.iconSize = new GSize( 23,23 );
    myGmapCenterIcon.shadowSize = new GSize( 29,29 );
    myGmapCenterIcon.iconAnchor = new GPoint(12,12 );
    myGmapCenterMarker = new GMarker(new GPoint(0,0),myGmapCenterIcon);

    myGmapSearchListElement = document.getElementById('mygmap_search_list');
    myGmapAddressElement = document.getElementById('mygmap_addr');

    myGmapMapTypes = new Array(null, G_NORMAL_MAP, G_SATELLITE_MAP, G_HYBRID_MAP);

    GEvent.addListener(mygmap_map, "moveend", function() {myGmapMoved();});
    GEvent.addListener(mygmap_map, "zoomend", function(oldZoomLevel, newZoomLevel){myGmapZoomed(oldZoomLevel, newZoomLevel);});
    GEvent.addListener(mygmap_map, "mousemove",
         function (point) { myGmapLatestKnownHoveringPoint = point;  }
    );
    GEvent.addDomListener(element,"DOMMouseScroll", myGmapWheelZoom);
    GEvent.addDomListener(element, "mousewheel",myGmapWheelZoom); 
    GEvent.addListener(mygmap_map, 'click', myGmapPopupMarkerInfo);
    myGmapSetInitialLocation();
  }
  
  myGmapShowBlocks();
}

function myGmapShowBlocks() {
  for (var i=0; i<myGmapMiniMap_idx; i++) {
    var element = document.getElementById(myGmapMiniMaps[i].divid);
    if (element) {
      var map = new GMap2(element);
      map.addControl(new GSmallZoomControl());
      map.setCenter(new GLatLng(myGmapMiniMaps[i].y,myGmapMiniMaps[i].x), myGmapMiniMaps[i].zoom-1 );
      maptype = myGmapMiniMaps[i].maptype;
      if (maptype > 0) {
        map.setMapType(myGmapMapTypes[maptype]);
      }
      myGmapMiniMaps[i].map = map;
      myGmapAddMarker(map, myGmapMiniMaps[i].y, myGmapMiniMaps[i].x, '', '', 0);
    }
  }
}
var myGmapOverviewMap;
function myGmapCenterAndZoom() {
  var id = 0;
  var maptype =0
  var popwin = 0;
  var lat = arguments[0];
  var lng = arguments[1];
  var zoom = arguments[2];
  if (arguments.length >= 4) maptype = arguments[3];
  if (arguments.length >= 5) id = arguments[4];
  if (arguments.length >= 6) popwin = arguments[5];

  mygmap_map.setCenter(new GLatLng(lat, lng), zoom);
  if (maptype > 0) {
    mygmap_map.setMapType(myGmapMapTypes[maptype]);
    mygmap_map.setCenter(new GLatLng(lat, lng), zoom);
    myGmapOverviewMap = myGmapOverviewMapControl.getOverviewMap();
  }

  if (id > 0) {
    for (var i=0; i<_myGmapMarkers.length; i++) {
      point = _myGmapMarkers[i].point;
      if (_myGmapMarkers[i].id == id) {
        hPoint = mygmap_map.getCurrentMapType().getProjection().fromLatLngToPixel(point ,mygmap_map.getZoom());
        hLatLng = mygmap_map.getCurrentMapType().getProjection().fromPixelToLatLng(new GPoint(hPoint.x + 0.5 , hPoint.y + 0.5 ) , mygmap_map.getZoom());
        _myGmapMarkers[i].setPoint(hLatLng);
        if (popwin) {
          GEvent.trigger(_myGmapMarkers[i],"click");
        }
      } else {
      _myGmapMarkers[i].setPoint(point);
      }
    }
  }
  window.location.hash="#";
  return false;
}

function myGmapMoved() {
  var center = mygmap_map.getCenter();
  var bounds = mygmap_map.getBounds();
  var zoomlevel = mygmap_map.getZoom();
  var maptype = ((mygmap_map.getCurrentMapType() == G_NORMAL_MAP) ? 1
            : ((mygmap_map.getCurrentMapType() == G_SATELLITE_MAP)?  2
            : ((mygmap_map.getCurrentMapType() == G_HYBRID_MAP)?  3 : 1)));
  myGmapSetFormVaules(center.lat(), center.lng(), zoomlevel, maptype);
  mygmap_map.removeOverlay(myGmapCenterMarker);
  myGmapCenterMarker = new GMarker(new GLatLng(center.lat(),center.lng()),myGmapCenterIcon);
  mygmap_map.addOverlay(myGmapCenterMarker);
  if (myGmapAddressElement) myGmapRequestAddr(center,zoomlevel);
  for (var i=0; i<_myGmapMarkers.length; i++) {
    var element = document.getElementById('mygmap_marker_'+_myGmapMarkers[i].id);
    if (element) {
      if (bounds.contains(_myGmapMarkers[i].point)) {
        element.style.cssText ='font-weight:bold;';
      } else {
        element.style.cssText ='font-weight:bold;color:#A0A0A0';
      }
      element = null;
    }
    if (myGmapListInMapOnly) {
      var element = document.getElementById('mygmap_markerlist_'+_myGmapMarkers[i].id);
      if (element) {
        if (bounds.contains(_myGmapMarkers[i].point)) {
          element.style.cssText ='display:list';
        } else {
          element.style.cssText ='display:none';
        }
        element = null;
      }
    }
  }
  center = bounds = zoomlevel = maptype = null;
}

var _myGmapOverLays = new Array();
var _myGmapOverLayIdx=0;

function myGmapZoomed(oldZoomLevel, newZoomLevel) {
  var bounds = mygmap_map.getBounds();
  if (myGmapAddressElement) myGmapRenderCurAddress(mygmap_map.getZoom());
  for (var i=0; i<_myGmapMarkers.length; i++) {
    var element = document.getElementById('mygmap_marker_'+_myGmapMarkers[i].id);
    if (element) {
      if (bounds.contains(_myGmapMarkers[i].point)) {
        element.style.cssText ='font-weight:bold;';
      } else {
        element.style.cssText ='font-weight:bold;color:#A0A0A0';
      }
      element = null;
    }
  }

  for (i=0; i < _myGmapOverLayIdx; i++) {
    if ((oldZoomLevel >= _myGmapOverLays[i].limit) && (newZoomLevel < _myGmapOverLays[i].limit)) {
      mygmap_map.removeOverlay(_myGmapOverLays[i].overlay);
    } else if ((newZoomLevel >= _myGmapOverLays[i].limit) && (oldZoomLevel < _myGmapOverLays[i].limit)) {
      mygmap_map.addOverlay(_myGmapOverLays[i].overlay);
    } 
  }
  bounds = null;
}

function myGmapWheelZoom(event) {
  if(event.cancelable) event.preventDefault();
  nZoom = mygmap_map.getZoom();
  latlng = mygmap_map.getCenter();
  nZoom += (event.detail || -event.wheelDelta) < 0 ? mygmap_map.zoomIn(latlng,true,true) : mygmap_map.zoomOut(latlng,true,true);
  return false;
}

//Change Lat & Lng value in HTML Form Attribute
function myGmapSetAttributeByID(id, name, value) {
  var element = document.getElementById(id);
  if (element) {
    element.setAttribute(name,value);
  }
  element = null;
}

// Creates a marker whose info window displays the given number
var _myGmapMarkers= new Array();
var _myGmapMarkerIdx=0;

function myGmapAddOverlay(map, url, limit) {
  var gx = new GGeoXml(url);
  _myGmapOverLays[_myGmapOverLayIdx] = {};
  _myGmapOverLays[_myGmapOverLayIdx].overlay = gx;
  _myGmapOverLays[_myGmapOverLayIdx].limit = limit;
  _myGmapOverLayIdx++;
  zoom = mygmap_map.getZoom();
  if (zoom >= limit) {
    map.addOverlay(gx);
  }
}
function myGmapAddMarker(map, lat, lng, html, letter, id) {
  var point = new GLatLng(lat,lng);
  if (letter == undefined) {
    var marker = new GMarker(point);
  } else {
    var icon = new GIcon();
    if ((letter == null)||(letter == '')) {
      icon.image = iconpath + 'marker.png';
    } else {
      icon.image = iconpath + 'marker_' + letter+'.png';
    }
    icon.shadow = iconpath + 'marker_shadow.png';
    icon.iconSize = new GSize( 20,34 );
    icon.shadowSize = new GSize( 37,34 );
    icon.iconAnchor = new GPoint( 9,34 );
    icon.infoWindowAnchor = new GPoint( 9,2 );
    var marker = new GMarker(point,icon);
  }
  marker.html = html;
  map.addOverlay(marker);
  if (html != '') {
    // Show this markers index in the info window when it is clicked
//    GEvent.addListener(marker, "click", function() {
//      marker.openInfoWindowHtml('<div style="width:220px">'+html+'</div>');
//    });
  }
  GEvent.addListener(marker, "mouseover", function() {
    var hPoint = mygmap_map.getCurrentMapType().getProjection().fromLatLngToPixel(point ,mygmap_map.getZoom());
    var hLatLng = mygmap_map.getCurrentMapType().getProjection().fromPixelToLatLng(new GPoint(hPoint.x + 0.5 , hPoint.y + 0.5 ) , mygmap_map.getZoom());
    marker.setPoint(hLatLng);
  });
  GEvent.addListener(marker, "mouseout", function() {
    marker.setPoint(point);
  });
  _myGmapMarkers[_myGmapMarkerIdx] = marker;
  _myGmapMarkers[_myGmapMarkerIdx].html = html;
  _myGmapMarkers[_myGmapMarkerIdx].point = point;
  if (id != undefined) {
    _myGmapMarkers[_myGmapMarkerIdx].id = id;
  } else {
    _myGmapMarkers[_myGmapMarkerIdx].id = 0;
  }
  _myGmapMarkerIdx++;
  return marker;
}

function myGmapPopupMarkerInfo(marker, lnglat) {
	for (i=0; i<_myGmapMarkers.length; i++) {
		if (_myGmapMarkers[i] == marker && marker.html != '') {
			marker.openInfoWindowHtml('<div style="width:220px">'+marker.html+'</div>');
		}
	}
}

function myGmapRemoveMakersAll() {
  for(var i=0; i <= _myGmapMarkerIdx; i++) {
    mygmap_map.removeOverlay(_myGmapMarkers[i]);
  }
  _myGmapMarkerIdx = 0;
}

// For Simple Geo Service
//  following methods are based on Simple Geo Coding Ajax Sample
//  http://pc035.tkl.iis.u-tokyo.ac.jp/~sagara/cgi-bin/search/ajax_geocoding.html
//
var myGmapIgnoreResponse = false;
var myGmapLastSearchAddress = '';
var myGmapLastSearchStation = '';
var myGmapIgnoreRequestLoc = false;
var myGmapHTTPRequestLocTimer;
var myGmapRequestLocTimer;

function myGmapRequestLoc(series, data)
{
  myGmapDebug('myGmapRequestLoc('+series+','+data+')');
  if (((series=='ADDRESS')&&(myGmapLastSearchAddress == data))||
     ((series=='STATION')&&(myGmapLastSearchStation == data))) {
    return;
  } else {
    if (series=='ADDRESS') {
      myGmapLastSearchAddress = data;
    } else if (series=='STATION') {
      myGmapLastSearchStation = data;
    }
  }
  if (data=='') {
    myGmapIgnoreResponse = true;
    if (myGmapSearchListElement) {
      myGmapSearchListElement.innerHTML ='';
    }
    myGmapRemoveMakersAll();
    myGmapIgnoreResponse = false;
    myGmapSetInitialLocation();
    return;
  }
  myGmapIgnoreResponse = false;
  if (myGmapIgnoreRequestLoc) {
    myGmapDebug('==>Delayed Call myGmapHTTPRequestLoc('+data+')');
    if(myGmapRequestLocTimer) {
      window.clearInterval(myGmapRequestLocTimer);
    }
    myGmapRequestLocTimer=window.setInterval(function() {
      myGmapDebug('==>Calling Delayed myGmapHTTPRequestLoc('+data+')');
      window.clearInterval(myGmapRequestLocTimer);
      myGmapHTTPRequestLoc(series, data);
    }, 500);
  } else {
    myGmapDebug('==>Direct Call myGmapHTTPRequestLoc('+data+')');
    myGmapHTTPRequestLoc(series, data);
  }
}

function myGmapHTTPRequestLoc(series, data)
{
  myGmapDebug('myGmapHTTPRequestLoc('+series+','+data+')');
  myGmapIgnoreRequestLoc = true;
  var httpReq = GXmlHttp.create();
  httpReq.open('POST', mygmappath+'?action=MyGmapHttpReq', true );
  httpReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=EUC-JP');
  httpReq.setRequestHeader('Referer',mygmappath);
  var data = 'addr=' + encodeURI(data) + '&series='+series+'&geoop=csis';
  httpReq.onreadystatechange = function() { 
    if (httpReq.readyState==4) {
      if (httpReq.status == 200) { 
         myGmapGetLocResponse(httpReq, series);
      }
    }
  }
  myGmapHTTPRequestLocTimer=window.setInterval(function() {
     window.clearInterval(myGmapHTTPRequestLocTimer);
     myGmapIgnoreRequestLoc = false;
  }, 3000);
  httpReq.send(data);
}
var _myGmapSearchMarkers= new Array();
var _myGmapSearchMarkersCount = 0;
function myGmapGetLocResponse(httpReq, series) {
  if (myGmapIgnoreResponse) return;
  myGmapDebug('myGmapGetLocResponse(httpReq)');
  var resxml  = httpReq.responseXML;
  var restext = httpReq.responseText;

  var query = resxml.getElementsByTagName('query')[0].firstChild.data.htmlspecialchars();
  var candidates = resxml.getElementsByTagName('candidate');
  var len = candidates.length;
  var pnts = new Array(len);
  if (len > 0) {
    var minx = 180.0;
    var miny = 90.0;
    var maxx = -180.0;
    var maxy = -90.0;
    var maxilvl = 0;
    for(i=0; i < _myGmapSearchMarkersCount; i++) {
      mygmap_map.removeOverlay(_myGmapSearchMarkers[i]);
    }
    _myGmapSearchMarkers = new Array();
    for (var idx = 0; idx < len; idx++) {
      var candidate = candidates[idx];
      var addr = candidate.getElementsByTagName('address')[0].firstChild.data.htmlspecialchars();
      var ilvl = parseInt(candidate.getElementsByTagName('iLvl')[0].firstChild.data);
      var x = parseFloat(candidate.getElementsByTagName('longitude')[0].firstChild.data);
      var y = parseFloat(candidate.getElementsByTagName('latitude')[0].firstChild.data);
      minx = Math.min(x, minx); maxx = Math.max(x, maxx);
      miny = Math.min(y, miny); maxy = Math.max(y, maxy);
      maxilvl = Math.max(ilvl, maxilvl);
      pnts[idx] = {'x':x, 'y':y, 'lvl':Math.max((7-ilvl), 0), 'text':addr};
      myGmapDebug('==>Result['+idx+']=('+x+','+y+','+ilvl+','+addr+')');

    }
    var cx = (maxx + minx) / 2.0;
    var cy = (maxy + miny) / 2.0;
    var point = new GLatLng(cy, cx);
    ilvl = Math.max((7-maxilvl),0);
    var bounds = mygmap_map.getBounds();
    var view_w = 0.0053 * (1 + ilvl);
    var view_h = 0.0034 * (1 + ilvl);
    while (maxx - minx > view_w || maxy - miny > view_h) {
      ilvl++;
      view_w *= 2.0;
      view_h *= 2.0;
    }    
    mygmap_map.setCenter(point,17-ilvl);

    for (var i=0; i<len-1; i++) {
      for (var j=len-1; j>i ;j--) {
        if ((pnts[i].y < pnts[j].y)||((pnts[i].y == pnts[j].y)&&(pnts[i].x < pnts[j].x))) {
          tmp = pnts[i];
          pnts[i] = pnts[j];
          pnts[j] = tmp;
        }
      }
    }
    var idx_mark = 0;
    var last_x = 180;
    var last_y = 90;
    if (series == 'ADDRESS') {
        q_para = 'q=';
    } else {
        q_para = 's=';
    }
    var html='<h4 onclick="myGmapCenterAndZoom('+cy+','+cx+','+ (17-ilvl) +');return(false)">[ <a href="?'+q_para+query+'" >Search Results</a> ]</h4><ul>';
    for (i = 0; i < len; i++) {
      if ((pnts[i].x != last_x) || (pnts[i].y != last_y)) {
        idx_mark++;
        last_x = pnts[i].x;
        last_y = pnts[i].y;
      }
      if (idx_mark < 10) {
        _myGmapSearchMarkers[idx_mark-1] = myGmapAddMarker(mygmap_map,pnts[i].y,pnts[i].x,pnts[i].text,'S'+idx_mark,'S'+i);
      } else {
        _myGmapSearchMarkers[idx_mark-1] = myGmapAddMarker(mygmap_map,pnts[i].y,pnts[i].x,pnts[i].text,'S0','S'+i);
      }
      html += '<li><span onclick="myGmapCenterAndZoom('+pnts[i].y+','+pnts[i].x+','+(17-pnts[i].lvl)+');return(false)">';
      html += '<span id="mygmap_marker_S'+i+'">'+'S'+idx_mark+'.</span>&nbsp;<a href="?'+q_para+pnts[i].text+'">'+pnts[i].text+'</a>';
      html += '</span></li>';
    }
    _myGmapSearchMarkersCount = idx_mark;
    html += '</ul>';
    if (myGmapSearchListElement) {
      myGmapSearchListElement.innerHTML =html;
      myGmapMoved();
    }
  }
}

function myGmapRequestAddr(point,zoom)
{
  if (!myGmapAddressElement) return;
  if (!point)  return;
  myGmapDebug('myGmapRequestAddr(('+point.x+','+point.y+'),'+zoom+')');
  // create XMLHttpRequest object
  var httpReq = GXmlHttp.create();
  var data = 'lat=' + point.lat() + '&lon='+point.lng()+'&geoop=invgeo';
  httpReq.open('POST', mygmappath+'?action=MyGmapHttpReq', true );
  httpReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=EUC-JP');
  httpReq.setRequestHeader('Referer',mygmappath);
  httpReq.onreadystatechange = function() { 
    if (httpReq.readyState==4) {
      if (httpReq.status == 200) {
        var resxml = httpReq.responseXML;
        myGmapGetAddrResponse(resxml,zoom);
        resxml = null;
        httpReq = null;
      }
    }
  }
  httpReq.send(data);
}

function myGmapGetAddrResponse(resxml, zoom) {
  if (myGmapIgnoreResponse) return;
  var geometry = resxml.getElementsByTagName('geometry');
  if (geometry.length == 0) {
    myGmapCurAddress = {};
  } else {
    myGmapCurAddress.text = geometry[0].getElementsByTagName('address')[0].firstChild.data.htmlspecialchars();
    myGmapCurAddress.pref = geometry[0].getElementsByTagName('pref')[0].firstChild.data.htmlspecialchars();
    myGmapCurAddress.city = geometry[0].getElementsByTagName('city')[0].firstChild.data.htmlspecialchars();
    myGmapCurAddress.town = geometry[0].getElementsByTagName('town')[0].firstChild.data.htmlspecialchars();
    myGmapCurAddress.number = geometry[0].getElementsByTagName('number')[0].firstChild.data.htmlspecialchars();
  }
  myGmapRenderCurAddress(zoom);
}

function myGmapRenderCurAddress(zoom) {
  if (myGmapAddressElement) {
    if (myGmapCurAddress.text) {
      zoom = 17-zoom;
      if (zoom <= 0) {
        myGmapAddressElement.innerHTML ='<b>'+myGmapCurAddress.text+'</b>';
      } else if ((zoom >= 1) && (zoom <= 2)) {
        myGmapAddressElement.innerHTML ='<b>'+myGmapCurAddress.pref+myGmapCurAddress.city+myGmapCurAddress.town+'</b>';
      } else if ((zoom >= 3) && (zoom <= 9)) {
        myGmapAddressElement.innerHTML ='<b>'+myGmapCurAddress.pref+myGmapCurAddress.city+'</b>';
      } else if ((zoom >= 10) && (zoom <= 12)) {
        myGmapAddressElement.innerHTML ='<b>'+myGmapCurAddress.pref+'</b>';
      } else {
        myGmapAddressElement.innerHTML ='&nbsp;';
      }
    } else {
      myGmapAddressElement.innerHTML ='&nbsp;';
    }
  }
}

var myGmapDebugFlg = true;
var myGmapDebugMsg = '';
function myGmapDebug(msg) {
  var element = document.getElementById('mygmap_message');
  if (element && myGmapDebugFlg) {
    myGmapDebugMsg += msg+'<br />';
    element.innerHTML = myGmapDebugMsg;
  }
}
function myGmapDebugClear() {
  var element = document.getElementById('mygmap_message');
  if (element && myGmapDebugFlg) {
    myGmapDebugMsg = '';
    element.innerHTML = myGmapDebugMsg;
  }
}

function myGmapUnload() {
  mygmap_map = null;
  myGmapCenterIcon = null;
  myGmapCenterMarker = null;
  GUnload();
  for(i=0; i < _myGmapMarkerIdx; i++) {
    _myGmapMarkers[i].point = null;
    _myGmapMarkers[i] = null;
  }
  _myGmapMarkers = null;
}

myGmapAddEventListener(window, 'load', myGmapLoad);
myGmapAddEventListener(window, 'unload', myGmapUnload);
