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

//Keep Initial listarea HTML for recovering from Search.
var myGmapSearchListElement;
var myGmapListInitHTML;
var myGmapAddressElement;
var myGmapCurAddress = {};
var myGmapCenterMarker;
var myGmapCenterIcon;

//Google Map Initializing
function myGmapLoad() {
  var element = document.getElementById('mygmap_map');
  if (element) {
    mygmap_map = new GMap2(element);
    mygmap_map.addControl(new GLargeMapControl());
    mygmap_map.addControl(new GMapTypeControl());
    myGmapCenterIcon = new GIcon();
    myGmapCenterIcon.image = iconpath +'/marker_center.png';
    myGmapCenterIcon.shadow = iconpath +'/marker_center_shadow.png';
    myGmapCenterIcon.iconSize = new GSize( 23,23 );
    myGmapCenterIcon.shadowSize = new GSize( 29,29 );
    myGmapCenterIcon.iconAnchor = new GPoint(12,12 );
    myGmapCenterMarker = new GMarker(new GPoint(0,0),myGmapCenterIcon);

    myGmapSearchListElement = document.getElementById('mygmap_search_list');
    myGmapAddressElement = document.getElementById('mygmap_addr');

    GEvent.addListener(mygmap_map, "moveend", function() {myGmapMoved();});
    GEvent.addListener(mygmap_map, "zoom", function(oldZoomLevel, newZoomLevel){myGmapZoomed();});
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
      map.setCenter(new GLatLng(myGmapMiniMaps[i].y,myGmapMiniMaps[i].x), Math.floor( 17 - myGmapMiniMaps[i].zoom+1 ) );
      myGmapMiniMaps[i].map = map;
    }
  }
}

function myGmapCenterAndZoom() {
  if (arguments.length == 4) {
    x = arguments[0];
    y = arguments[1];
    zoom = arguments[2];
    id =  arguments[3];
    popwin = 0;
  } else if (arguments.length == 5) {
    x = arguments[0];
    y = arguments[1];
    zoom = arguments[2];
    id =  arguments[3];
    popwin = arguments[4];
  }
  mygmap_map.setCenter(new GLatLng(y, x), Math.floor(17-zoom) );
  for (var i=0; i<_myGmapMarkers.length; i++) {
    point = _myGmapMarkers[i].point;
    if (_myGmapMarkers[i].id == id) {
      var hPoint = mygmap_map.getCurrentMapType().getProjection().fromLatLngToPixel(point ,mygmap_map.getZoom());
      var hLatLng = mygmap_map.getCurrentMapType().getProjection().fromPixelToLatLng(new GPoint(hPoint.x + 0.5 , hPoint.y + 0.5 ) , mygmap_map.getZoom());
      _myGmapMarkers[i].setPoint(hLatLng);
      if (popwin) {
        GEvent.trigger(_myGmapMarkers[i],"click");
      }
    } else {
	  _myGmapMarkers[i].setPoint(point);
    }
  }
  window.location.hash="#";
}

function myGmapMoved() {
  var center = mygmap_map.getCenter();
  var bounds = mygmap_map.getBounds();
  var zoomlevel = Math.floor( 17 -mygmap_map.getZoom());
  myGmapSetFormVaules(center.x, center.y, zoomlevel);
  mygmap_map.removeOverlay(myGmapCenterMarker);
  myGmapCenterMarker = new GMarker(new GLatLng(center.y,center.x),myGmapCenterIcon);
  mygmap_map.addOverlay(myGmapCenterMarker);
  if (myGmapAddressElement) myGmapRequestAddr(center,zoomlevel);
  for (var i=0; i<_myGmapMarkers.length; i++) {
    element = document.getElementById('mygmap_marker_'+_myGmapMarkers[i].id);
    if (element) {
      if (bounds.contains(_myGmapMarkers[i].point)) {
        element.style.cssText ='font-weight:bold;';
      } else {
        element.style.cssText ='font-weight:bold;color:#A0A0A0';
      }
    }
  }
}
function myGmapZoomed() {
  var bounds = mygmap_map.getBounds();
  if (myGmapAddressElement) myGmapRenderCurAddress(Math.floor( 17 -mygmap_map.getZoom()));
  for (var i=0; i<_myGmapMarkers.length; i++) {
    element = document.getElementById('mygmap_marker_'+_myGmapMarkers[i].id);
    if (element) {
      if (bounds.contains(_myGmapMarkers[i].point)) {
        element.style.cssText ='font-weight:bold;';
      } else {
        element.style.cssText ='font-weight:bold;color:#A0A0A0';
      }
    }
  }
}

//Change Lat & Lng value in HTML Form Attribute
function myGmapSetAttributeByID(id, name, value) {
  var element = document.getElementById(id);
  if (element) {
    element.setAttribute(name,value);
  }
}

// Creates a marker whose info window displays the given number
var _myGmapMarkers= new Array();
var _myGmapMarkerIdx=0;

function myGmapAddMarker(map, lat, lng, html, letter, id) {
  var point = new GLatLng(lng,lat);
  if (letter == undefined) {
    var marker = new GMarker(point);
  } else {
    var icon = new GIcon();
    if ((letter == null)||(letter == '')) {
      icon.image = iconpath + '/marker.png';
    } else {
      icon.image = iconpath + '/marker_' + letter+'.png';
    }
    icon.shadow = iconpath + '/marker_shadow.png';
    icon.iconSize = new GSize( 20,34 );
    icon.shadowSize = new GSize( 37,34 );
    icon.iconAnchor = new GPoint( 9,34 );
    icon.infoWindowAnchor = new GPoint( 9,2 );
    var marker = new GMarker(point,icon);
  }
  map.addOverlay(marker);
  // Show this markers index in the info window when it is clicked
  GEvent.addListener(marker, "click", function() {
    marker.openInfoWindowHtml('<div style="width:220px">'+html+'</div>');
  });
  GEvent.addListener(marker, "mouseover", function() {
    var hPoint = mygmap_map.getCurrentMapType().getProjection().fromLatLngToPixel(point ,mygmap_map.getZoom());
    var hLatLng = mygmap_map.getCurrentMapType().getProjection().fromPixelToLatLng(new GPoint(hPoint.x + 0.5 , hPoint.y + 0.5 ) , mygmap_map.getZoom());
    marker.setPoint(hLatLng);
  });
  GEvent.addListener(marker, "mouseout", function() {
    marker.setPoint(point);
  });
  _myGmapMarkers[_myGmapMarkerIdx] = marker;
  _myGmapMarkers[_myGmapMarkerIdx].point = point;
  if (id != undefined) {
    _myGmapMarkers[_myGmapMarkerIdx].id = id;
  } else {
    _myGmapMarkers[_myGmapMarkerIdx].id = 0;
  }
  _myGmapMarkerIdx++;
  return marker;
}

function myGmapRemoveMakersAll(map) {
  for(i=0; i <= _myGmapMarkerIdx; i++) {
    mygmap_map.removeOverlay(_myGmapMarkers[i]);
  }
  _myGmapMarkerIdx = 0;
}

// For Simple Geo Service
//  following methods are based on Simple Geo Coding Ajax Sample
//  http://pc035.tkl.iis.u-tokyo.ac.jp/~sagara/cgi-bin/search/ajax_geocoding.html
//
var myGmapIgnoreResponse = false;

function myGmapCreateHttpRequest(){
  //for Win ie
  if(window.ActiveXObject) {
    try {
      // for MSXML2 or later
      return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        // for old MSXML
        return new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e2) {
        return null;
      }
    }
  } else if(window.XMLHttpRequest) {
    // for other browsers
    return new XMLHttpRequest();
  } else {
    return null;
  }
}

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
    myGmapRemoveMakersAll(mygmap_map);
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
  // create XMLHttpRequest object
  var httpReq = myGmapCreateHttpRequest();
  data = 'addr=' + encodeURI(data) + '&series='+series+'&geoop=csis';
  httpReq.open('POST', mygmappath+'httpreq.php', true );
  httpReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=EUC-JP');
  httpReq.setRequestHeader('Referer',mygmappath);
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

function myGmapGetLocResponse(httpReq, series) {
  if (myGmapIgnoreResponse) return;
  myGmapDebug('myGmapGetLocResponse(httpReq)');
  var resxml  = httpReq.responseXML;
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
    for(i=0; i <= _myGmapSearchMarkers.length; i++) {
      mygmap_map.removeOverlay(_myGmapSearchMarkers[i]);
    }
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
    html='<h4 onclick="mygmap_map.setCenter(new GLatLng('+cy+','+cx+'),'+ (17-ilvl) +');return(false)">[ <a href="?'+q_para+query+'" >Search Results</a> ]</h4><ul>';
    for (i = 0; i < len; i++) {
      if ((pnts[i].x != last_x) || (pnts[i].y != last_y)) {
      	idx_mark++;
      	last_x = pnts[i].x;
      	last_y = pnts[i].y;
      }
      if (idx_mark < 10) {
        _myGmapSearchMarkers[idx_mark] = myGmapAddMarker(mygmap_map,pnts[i].x,pnts[i].y,pnts[i].text,'S'+idx_mark,'S'+i);
      } else {
        _myGmapSearchMarkers[idx_mark] = myGmapAddMarker(mygmap_map,pnts[i].x,pnts[i].y,pnts[i].text,'S0','S'+i);
      }
      html += '<li><span onclick="mygmap_map.setCenter(new GLatLng('+pnts[i].y+','+pnts[i].x+'),'+(17-pnts[i].lvl)+');return(false)">';
      html += '<span id="mygmap_marker_S'+i+'">'+'S'+idx_mark+'.</span>&nbsp;<a href="?'+q_para+pnts[i].text+'">'+pnts[i].text+'</a>';
      html += '</span></li>';
    }
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
  var httpReq = myGmapCreateHttpRequest();
  data = 'lat=' + point.y + '&lon='+point.x+'&geoop=invgeo';
  httpReq.open('POST', mygmappath+'httpreq.php', true );
  httpReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=EUC-JP');
  httpReq.setRequestHeader('Referer',mygmappath);
  httpReq.onreadystatechange = function() { 
    if (httpReq.readyState==4) {
      if (httpReq.status == 200) { 
         myGmapGetAddrResponse(httpReq,zoom);
      }
    }
  }
  httpReq.send(data);
}

function myGmapGetAddrResponse(httpReq, zoom) {
  if (myGmapIgnoreResponse) return;
  var resxml  = httpReq.responseXML;
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
      if (zoom == 0) {
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
  element = document.getElementById('mygmap_message');
  if (element && myGmapDebugFlg) {
    myGmapDebugMsg += msg+'<br />';
    element.innerHTML = myGmapDebugMsg;
  }
}
function myGmapDebugClear() {
  element = document.getElementById('mygmap_message');
  if (element && myGmapDebugFlg) {
    myGmapDebugMsg = '';
    element.innerHTML = myGmapDebugMsg;
  }
}

