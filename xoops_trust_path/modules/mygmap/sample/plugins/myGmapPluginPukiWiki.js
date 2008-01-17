function myGmapPluginPukiWiki_Load () {;
  GEvent.addListener(mygmap_map, "moveend", myGmapPukiWikiMoved);
  myGmapPukiWikiMoved();
}

function myGmapPukiWikiMoved() {
  var center = mygmap_map.getCenter();
  var zoom = mygmap_map.getZoom();
  var maptype = ((mygmap_map.getCurrentMapType() == G_NORMAL_MAP) ? 1
            : ((mygmap_map.getCurrentMapType() == G_SATELLITE_MAP)?  2 : 3));
  var lng = center.lng();
  var lat = center.lat();
  if (maptype==1) {
    myGmapSetAttributeByID('mygmap_info_form_wiki2', 'value',
                    '#googlemaps2(lat=' + lat + ' , lng=' + lng + ', zoom='+ zoom + ', width=400px, height=350px, type=normal, overviewctrl=none, usetool=2)');
  } else {
    if (maptype==2) {
      myGmapSetAttributeByID('mygmap_info_form_wiki2', 'value',
                  '#googlemaps2(lat=' + lat + ' , lng=' + lng + ', zoom='+ zoom + ', width=400px, height=350px, type=satelite, overviewctrl=none, usetool=2)');
    } else {
      myGmapSetAttributeByID('mygmap_info_form_wiki2', 'value',
                  '#googlemaps2(lat=' + lat + ' , lng=' + lng + ', zoom='+ zoom + ', width=400px, height=350px, type=hybrid, overviewctrl=none, usetool=2)');
    }
  }
}

myGmapAddEventListener(window, 'load', myGmapPluginPukiWiki_Load);

