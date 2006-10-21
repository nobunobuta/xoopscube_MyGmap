function myGmapPluginFgmap_Load () {
  GEvent.addListener(mygmap_map, "moveend", myGmapRouteMoved);
  myGmapFgmapMoved();
}

function myGmapFgmapMoved() {
  var center = mygmap_map.getCenter();
  var zoom = mygmap_map.getZoom();
  var maptype = ((mygmap_map.getCurrentMapType() == G_NORMAL_MAP) ? 1
            : ((mygmap_map.getCurrentMapType() == G_SATELLITE_MAP)?  2 : 3));
  var lng = center.lng();
  var lat = center.lat();
	if (maptype==1) {
		myGmapSetAttributeByID('mygmap_info_form_wiki', 'value',
			'#gmapp(' + lng + ',' + lat + ','+ (17-zoom) + ',1)');
		myGmapSetAttributeByID('mygmap_info_form_blog', 'value',
			'<iframe src="/fgmap/?n=' + lat + '&amp;e=' + lng + '&amp;z='+ (17-zoom) + '&amp;f=1&amp;s=&amp;t=" width="400" height="350" frameborder="0" scrolling="no"></iframe>');	} else {
		myGmapSetAttributeByID('mygmap_info_form_wiki', 'value',
			'#gmapp(' + lng + ',' + lat + ','+ (17-zoom) + ',1,1)');
		myGmapSetAttributeByID('mygmap_info_form_blog', 'value',
			'<iframe src="/fgmap/?n=' + lat + '&amp;e=' + lng + '&amp;z='+ (17-zoom) + '&amp;f=1&amp;s=1&amp;t=" width="400" height="350" frameborder="0" scrolling="no"></iframe>');	}
}

myGmapAddEventListener(window, 'load', myGmapPluginFgmap_Load);

