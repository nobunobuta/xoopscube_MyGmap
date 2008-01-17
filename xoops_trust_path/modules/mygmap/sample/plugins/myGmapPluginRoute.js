// ● ------------------ 2006-8-16 inserted --------------------------
var _myGmapRoutes = new Array();
// --- var for current route ---
var _myGmapRouteNo = 0;
var _myGmapRoutePoints = new Array();
var _myGmapRoutePoly = new Array();
var _myGmapRoutePointIconMarker = new Array();
var _myGmapRoutePointListener = null;
var _myGmapRouteColor = "#000000";
var _myGmapRouteMoveFromPoint = null;
var _myGmapRouteText = null;
// --- Icon --------------------
var _myGmapRoutePointIcon;
var _myGmapRoutePointIconStart;
var _myGmapRoutePointIconMiddle;
var _myGmapRoutePointIconGoal;
// --- var for map overall -----
var _myGmapRoutePageTitle = "";
var _myGmapRouteMapListener = null;
var _myGmapRouteSelectMode = "OFF";
var _myGmapRouteMoveMode = "OFF";
var _myGmapRoutePointClicked = "NO";
// ● ----------------------------------------------------------------

function myGmapPluginRoute_Load () {
  _myGmapRoutePointIconStart = new GIcon();
  _myGmapRoutePointIconStart.image		 = iconpath +'route_point_s.png';
  _myGmapRoutePointIconStart.shadow		 = iconpath +'route_point_s_shadow.png';
  _myGmapRoutePointIconStart.iconSize	 = new GSize(16,16);
  _myGmapRoutePointIconStart.shadowSize	 = new GSize(16,16);
  _myGmapRoutePointIconStart.iconAnchor	 = new GPoint(8,8);
  _myGmapRoutePointIconStart.infoWindowAnchor = new GPoint(8,12);
  _myGmapRoutePointIconStart.transparent = iconpath +'route_point_s_shadow.png';
  _myGmapRoutePointIconMiddle = new GIcon();
  _myGmapRoutePointIconMiddle.image		  = iconpath +'route_point_m.png';
  _myGmapRoutePointIconMiddle.shadow	  = iconpath +'route_point_m_shadow.png';
  _myGmapRoutePointIconMiddle.iconSize	  = new GSize(14,14);
  _myGmapRoutePointIconMiddle.shadowSize  = new GSize(14,14);
  _myGmapRoutePointIconMiddle.iconAnchor  = new GPoint(7,7);
  _myGmapRoutePointIconMiddle.infoWindowAnchor = new GPoint(7,12);
  _myGmapRoutePointIconMiddle.transparent = iconpath +'route_point_m_shadow.png';
  _myGmapRoutePointIconGoal = new GIcon();
  _myGmapRoutePointIconGoal.image		= iconpath +'route_point_g.png';
  _myGmapRoutePointIconGoal.shadow		= iconpath +'route_point_g_shadow.png';
  _myGmapRoutePointIconGoal.iconSize	= new GSize(14,14);
  _myGmapRoutePointIconGoal.shadowSize	= new GSize(14,14);
  _myGmapRoutePointIconGoal.iconAnchor	= new GPoint(7,7);
  _myGmapRoutePointIconGoal.infoWindowAnchor = new GPoint(7,12);
  _myGmapRoutePointIconGoal.transparent = iconpath +'route_point_g_shadow.png';

  GEvent.addListener(mygmap_map, "moveend", myGmapRouteMoved);
  myGmapRouteInitialLocation();
  myGmapRouteMoved();
}

function myGmapPluginRoute_Unload () {
}

function myGmapRouteMoved() {
  var center = mygmap_map.getCenter();
  var zoomlevel = mygmap_map.getZoom();
  var routeall = "_";
  for(wp=0;wp<_myGmapRoutes.length;wp++){
	routeall += _myGmapRoutes[wp].routetext;
  }
  if(routeall=="_") routeall = "";
  else routeall += "_";
  var pagetitle = _myGmapRoutePageTitle;
  myGmapRouteValues(center.lat(), center.lng(), zoomlevel, routeall, pagetitle);

}


function myGmapRouteNew() {
	_myGmapRouteSelectMode = "OFF";
	myGmapRouteSaveRoute(_myGmapRoutePoints);
	myGmapRouteHideMarkers();
	myGmapRouteIntializeNewRoute();
	if(_myGmapRouteMapListener==null){
		_myGmapRouteMapListener = GEvent.addListener(mygmap_map, "click", myGmapRouteEventHandler);
	}
}

// --------------------------------------------------------------------

function myGmapRouteSelect() {
	myGmapRouteHideMarkers();

	// 現在ルート選択モードでなければ、Routesを圧縮し最初を選択
	// 選択モードならば次を選択
	if(_myGmapRouteSelectMode=="ON"){
		if(_myGmapRouteNo==_myGmapRoutes.length-1) _myGmapRouteNo = 0;
		else _myGmapRouteNo++;
	} else {
		_myGmapRouteNo = 0;
		_myGmapRouteSelectMode = "ON";
		// 全ルートの非表示
		for(wp=0;wp<_myGmapRoutes.length;wp++){
			mygmap_map.removeOverlay(_myGmapRoutePoly[wp]);
		}
		// Routes圧縮
		var workRoutes = new Array();
		for(wp=0;wp<_myGmapRoutes.length;wp++){
			if(_myGmapRoutes[wp].length>1) workRoutes.push(_myGmapRoutes[wp]);
		}
		_myGmapRoutes = workRoutes;
		_myGmapRoutePoly = new Array();
		// 全ルートの再表示
		for(wp=0;wp<_myGmapRoutes.length;wp++){
			_myGmapRoutePoly[wp] = new GPolyline(_myGmapRoutes[wp],_myGmapRoutes[wp].color,6, 0.6 );
			mygmap_map.addOverlay(_myGmapRoutePoly[wp]);
		}
	}

	// ポイントマーカー再表示＆距離再計算など
	_myGmapRoutePoints = _myGmapRoutes[_myGmapRouteNo];
	_myGmapRouteColor  = _myGmapRoutes[_myGmapRouteNo].color;
	_myGmapRouteText   = _myGmapRoutes[_myGmapRouteNo].routetext;
	_myGmapRoutePointIconMarker = new Array();
	myGmapRouteWrite("show");

}

// --------------------------------------------------------------------

function myGmapRouteClear() {
	_myGmapRouteSelectMode = "OFF";

	myGmapRouteHideMarkers();
	// ルートの非表示と点列などの初期化
	mygmap_map.removeOverlay(_myGmapRoutePoly[_myGmapRouteNo]);
	_myGmapRoutePoly[_myGmapRouteNo] = null;
	_myGmapRoutePoints = new Array();
	_myGmapRouteColor  = "#000000";
	_myGmapRouteText   = null;
	_myGmapRoutes[_myGmapRouteNo] = _myGmapRoutePoints;
	document.getElementById("distance").innerHTML = "0km";
}

function myGmapRouteHideMarkers() {
	for(wp=0; wp<_myGmapRoutePoints.length; wp++ ) {
		if(_myGmapRoutePointIconMarker[wp]!=null) mygmap_map.removeOverlay(_myGmapRoutePointIconMarker[wp]);
		_myGmapRoutePointIconMarker[wp] = null;
	}
	_myGmapRoutePointIconMarker = new Array();
}

function myGmapRouteSaveRoute(points) {
	if(_myGmapRoutePoints.length > 1){
		_myGmapRoutes[_myGmapRouteNo] = points;
	}
}

function myGmapRouteIntializeNewRoute() {
	_myGmapRouteNo = _myGmapRoutes.length;
	_myGmapRoutePoints = new Array();
	_myGmapRouteColor  = "#000000";
	_myGmapRouteText   = null;
	document.getElementById("pointinfo").innerHTML = "";
	document.getElementById("distance").innerHTML =	 "0km";
}

// --------------------------------------------------------------------

function myGmapRoutePause() {
	
	if(_myGmapRouteMapListener!=null){
		GEvent.removeListener(_myGmapRouteMapListener);
		_myGmapRouteMapListener = null;
	}
}

// --------------------------------------------------------------------

function myGmapRoutePointMove(p_pno) {
	GEvent.removeListener(_myGmapRouteMapListener);
	_myGmapRouteMapListener = null;
	_myGmapRoutePointIconMarker[p_pno].openInfoWindowHtml('<div style="width:220px">移動先の位置をクリックしてください<br /><input type="button" onclick="javascript:myGmapRoutePointMoveCancel()" value="移動キャンセル" /></div>');
	_myGmapRouteMoveFromPoint = p_pno;
	_myGmapRouteMapListener = GEvent.addListener(mygmap_map, "click", myGmapRouteEventHandlerForMove);
}

// --------------------------------------------------------------------

function myGmapRoutePointMoveCancel() {
	_myGmapRoutePointClicked = "NO";
	GEvent.removeListener(_myGmapRouteMapListener);
	_myGmapRouteMapListener = null;
	_myGmapRouteMapListener = GEvent.addListener(mygmap_map, "click", myGmapRouteEventHandler);
	mygmap_map.closeInfoWindow();
}

// --------------------------------------------------------------------

function myGmapRoutePointAdd(p_pno) {
	_myGmapRoutePointClicked = "NO";
	mygmap_map.closeInfoWindow();
	myGmapRouteWrite('add',0,p_pno);
}

// --------------------------------------------------------------------

function myGmapRoutePointRemove(p_pno) {
	_myGmapRoutePointClicked = "NO";
	mygmap_map.closeInfoWindow();
	myGmapRouteWrite('remove',0,p_pno);
}

// --------------------------------------------------------------------

function myGmapRouteColorSet(p_color) {
	_myGmapRouteColor = "#"+p_color;
	myGmapRouteWrite('show');
}

// --------------------------------------------------------------------

function myGmapRouteArraySet(routeall) {
	if(routeall=="") return;
	var wp,wp2,wp2s;
	var route_cood = new Array();
	routeall = routeall.replace(/^__/,'');
	routeall = routeall.replace(/__$/,'');
	routeall = routeall.replace(/__/g,',');
	var routes = routeall.split(',');
	_myGmapRoutes = new Array();
	for(wp=0;wp<routes.length;wp++){
		route_cood = routes[wp].split("_");
		if(route_cood[0].match(/c[0-9a-f]{6}/)){
			_myGmapRouteColor = "#" + route_cood[0].substr(1,6);
			wp2s = 1;
		} else {
			_myGmapRouteColor = "#000000";
			wp2s = 0;
		}
		_myGmapRoutePoints = new Array();
		for(wp2=wp2s;wp2<route_cood.length;wp2=wp2+2){
			workPoint = new GPoint(0,0);
			workPoint.x = Number(route_cood[wp2]);
			workPoint.y = Number(route_cood[wp2+1]);
			_myGmapRoutePoints.push(workPoint);
		}
		_myGmapRoutes[wp] = _myGmapRoutePoints;
		_myGmapRoutes[wp].color = _myGmapRouteColor;
		_myGmapRouteText = "_" + routes[wp] + "_";
		_myGmapRoutes[wp].routetext = _myGmapRouteText;
	}
	_myGmapRouteSelectMode = "OFF";
	myGmapRouteSelect();
}

// --------------------------------------------------------------------

function myGmapRoutePageTitleSet(pagetitle) {
	if(pagetitle=="") return;
	_myGmapRoutePageTitle = pagetitle.replace(/<[^<>]*>/g,'');
}

function myGmapRoutePageTitleUpdate() {
	_myGmapRoutePageTitle = document.getElementById('mygmap_pagetitle').value.replace(/<[^<>]*>/g,'');
	myGmapRouteMoved();
}

// --------------------------------------------------------------------

function myGmapRouteWrite(p_type,p_point,p_pno) {
	// ポイントマーカーがクリックされた場合には、地図クリックの
	// イベントも検出される。その際のポイント追加の処理を避ける。
	myGmapRouteHideMarkers();
	// ポイントの追加、削除などの処理
	if(p_type=='push') {
		_myGmapRoutePoints.push(p_point);
		document.getElementById("pointinfo").innerHTML = "経度：" + p_point.x + "、緯度：" + p_point.y;
	} else if(p_type=='pop') {
		_myGmapRoutePoints.pop();
	} else if(p_type=='remove') {
		var workPoints = new Array();
		for(wp=0; wp<_myGmapRoutePoints.length; wp++ ) {
//			mygmap_map.removeOverlay(_myGmapRoutePointIconMarker[wp]);
			if(wp!=p_pno) workPoints.push(_myGmapRoutePoints[wp]);
		}
		_myGmapRoutePoints = workPoints;
	} else if(p_type=='add') {
		var workPoints = new Array();
		for(wp=0; wp<_myGmapRoutePoints.length; wp++ ) {
			if(wp==p_pno) {
				wx = (_myGmapRoutePoints[wp-1].x+_myGmapRoutePoints[wp].x)/2;
				wy = (_myGmapRoutePoints[wp-1].y+_myGmapRoutePoints[wp].y)/2;
				workPoint = new GPoint(wx,wy);
				workPoints.push(workPoint);
			}
			workPoints.push(_myGmapRoutePoints[wp]);
		}
//		for(wp=0; wp<_myGmapRoutePoints.length; wp++ ) {
//			mygmap_map.removeOverlay(_myGmapRoutePointIconMarker[wp]);
//		}
		_myGmapRoutePoints = workPoints;
	} else if(p_type=='move') {
		var workPoints = new Array();
		for(wp=0; wp<_myGmapRoutePoints.length; wp++ ) {
//			mygmap_map.removeOverlay(_myGmapRoutePointIconMarker[wp]);
			if(wp==p_pno) {
				workPoints.push(p_point);
			} else {
				workPoints.push(_myGmapRoutePoints[wp]);
			}
		}
		_myGmapRoutePoints = workPoints;
	}

	// ルートポイントの表示
	for(wp=0; wp<_myGmapRoutePoints.length; wp++ ) {
		if(wp==0) _myGmapRoutePointIcon=_myGmapRoutePointIconStart;
		else if(wp==_myGmapRoutePoints.length-1) _myGmapRoutePointIcon=_myGmapRoutePointIconGoal;
		else _myGmapRoutePointIcon=_myGmapRoutePointIconMiddle;
		_myGmapRoutePointIconMarker.push(new GMarker(_myGmapRoutePoints[wp], _myGmapRoutePointIcon));
		mygmap_map.addOverlay(_myGmapRoutePointIconMarker[wp]);
	}
	// ルートの再表示と距離計算など
	if( _myGmapRoutePoints.length > 1 ) {
			// ルートの再表示
		mygmap_map.removeOverlay(_myGmapRoutePoly[_myGmapRouteNo]);
		_myGmapRoutePoly[_myGmapRouteNo] = new GPolyline(_myGmapRoutePoints,_myGmapRouteColor,6, 0.6 );
		mygmap_map.addOverlay(_myGmapRoutePoly[_myGmapRouteNo]);
		// ルート距離の計算と、url用テキストの生成
		var dist = 0;
		_myGmapRouteText = "_c"+_myGmapRouteColor.substr(1,6)+"_";
		for(wp=0; wp < _myGmapRoutePoints.length-1; wp++ ) {
			dist += myGmapRouteGdistance(_myGmapRoutePoints[wp], _myGmapRoutePoints[wp+1]);
			_myGmapRouteText += _myGmapRoutePoints[wp].x + "_" + _myGmapRoutePoints[wp].y + "_";
		}
		_myGmapRouteText += _myGmapRoutePoints[wp].x + "_" + _myGmapRoutePoints[wp].y + "_";
		if(p_point) document.getElementById("pointinfo").innerHTML = "経度：" + p_point.x + "、緯度：" + p_point.y;
		else document.getElementById("pointinfo").innerHTML = "";
		document.getElementById("distance").innerHTML = (dist/1000) + "km";
	}
	_myGmapRoutes[_myGmapRouteNo] = _myGmapRoutePoints;
	_myGmapRoutes[_myGmapRouteNo].color = _myGmapRouteColor;
	_myGmapRoutes[_myGmapRouteNo].routetext = _myGmapRouteText;
	// urlの再表示
	myGmapRouteMoved();
}

function myGmapRouteEventHandler(marker, latlng) {
	_myGmapRouteSelectMode = "OFF";
	for (i=0; i<_myGmapRoutePointIconMarker.length; i++) {
		if (_myGmapRoutePointIconMarker[i] == marker) {
			_myGmapRoutePointClicked = "YES";
			if(i==0){
				html = '<input type="button" onclick="javascript:myGmapRoutePointMove('+i+')" value="移動" />';
			} else {
				html = '<input type="button" onclick="javascript:myGmapRoutePointMove('+i+')" value="移動" />';
				html+= '<input type="button" onclick="javascript:myGmapRoutePointAdd('+i+')" value="追加" />';
			}
			if(_myGmapRoutePoints.length>2){
				html+= '<input type="button" onclick="javascript:myGmapRoutePointRemove('+i+')" value="削除" />';
			}
			marker.openInfoWindowHtml('<div style="width:220px">'+html+'</div>');
			break;
		}
	}
	if (_myGmapRoutePointClicked =="NO") {
		myGmapRouteWrite('push', latlng);
	}
}
function myGmapRouteEventHandlerForMove(marker, latlng) {
	_myGmapRoutePointClicked =="NO"
	myGmapRouteWrite('move',latlng,_myGmapRouteMoveFromPoint);
	GEvent.removeListener(_myGmapRouteMapListener);
	_myGmapRouteMapListener = null;
	_myGmapRouteMapListener = GEvent.addListener(mygmap_map, "click", myGmapRouteEventHandler);
}
// --------------------------------------------------------------------

function myGmapRouteGdistance( from , to ) {
	var from_x = from.x * Math.PI / 180;
	var from_y = from.y * Math.PI / 180;
	var to_x   = to.x * Math.PI / 180;
	var to_y   = to.y * Math.PI / 180;
	var deg = Math.sin(from_y) * Math.sin(to_y) + Math.cos(from_y) * Math.cos(to_y) * Math.cos(to_x-from_x);
	var dist = 6378140 * (Math.atan( -deg / Math.sqrt(-deg * deg + 1)) + Math.PI / 2);
	return Math.round(dist);
}

myGmapAddEventListener(window, 'load', myGmapPluginRoute_Load);
