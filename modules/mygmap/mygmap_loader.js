if (mygmap_gapi_src == undefined) {
  var mygmap_map;
  var mygmap_gapi_src = "http://maps.google.co.jp/maps?file=api&amp;v=2&amp;datum=wgs84&amp;key=" + mygmap_API;
  var mygmap_local_js_src = mygmappath + "mygmap.js";
  document.write('<'+'script src="'+mygmap_gapi_src+'"'+' type="text/javascript" charset="utf-8"><'+'/script>');
  document.write('<'+'script src="'+mygmap_local_js_src+'"'+' type="text/javascript"><'+'/script>');
  var iconpath = mygmappath + 'images';  var onload_tmpstr="";
  if (window.onload != null) {
    onload_tmpstr = window.onload.toString();
    var  onload_i = onload_tmpstr.indexOf("{") + 2;
    onload_tmpstr = onload_tmpstr.substr(onload_i,onload_tmpstr.length-onload_i-2);
  }
  window.onload = new Function("myGmapLoad();"+onload_tmpstr);
  var myGmapMiniMaps = new Array();
  var myGmapMiniMap_idx = 0;
}
