CREATE TABLE mygmap_category (
  mygmap_category_id int(8) NOT NULL auto_increment,
  mygmap_category_name varchar(255) NOT NULL default '',
  mygmap_category_desc text NOT NULL,
  mygmap_category_lat double(20,15) NOT NULL default 0.000000000000000,
  mygmap_category_lng double(20,15) NOT NULL default 0.000000000000000,
  mygmap_category_zoom int(2) unsigned NOT NULL default 0,
  PRIMARY KEY  (mygmap_category_id)
) TYPE=MyISAM;

CREATE TABLE mygmap_area (
  mygmap_area_id int(8) NOT NULL auto_increment,
  mygmap_area_name varchar(255) NOT NULL default '',
  mygmap_area_desc text NOT NULL,
  mygmap_area_lat double(20,15) NOT NULL default 0.000000000000000,
  mygmap_area_lng double(20,15) NOT NULL default 0.000000000000000,
  mygmap_area_zoom int(2) unsigned NOT NULL default 0,
  mygmap_area_order int(5) unsigned NOT NULL default 0,
  PRIMARY KEY  (mygmap_area_id)
) TYPE=MyISAM;

CREATE TABLE mygmap_marker (
  mygmap_marker_id int(11) NOT NULL auto_increment,
  mygmap_marker_category_id int(8) NOT NULL default 0,
  mygmap_marker_title varchar(255) default '',
  mygmap_marker_desc text,
  mygmap_marker_icontext varchar(2) default '', 
  mygmap_marker_lat double(20,15) NOT NULL default 0.000000000000000,
  mygmap_marker_lng double(20,15) NOT NULL default 0.000000000000000,
  mygmap_marker_zoom int(2) unsigned NOT NULL default 0,
  mygmap_marker_uid int(5) unsigned NOT NULL default 0,
  PRIMARY KEY  (mygmap_marker_id),
  KEY mygmap_marker_category_id_key (mygmap_marker_category_id)
) TYPE=MyISAM;
