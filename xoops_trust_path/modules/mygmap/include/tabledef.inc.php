<?php
    $tableDef['mygmap']['category'] = array(
        'fields' => array(
            'mygmap_category_id' =>         array('int(8)',       'NOT NULL', null,  'auto_increment'),
            'mygmap_category_name' =>       array('varchar(255)', 'NOT NULL', "",  ''),
            'mygmap_category_desc' =>       array('text',         'NULL',     "",  ''),
            'mygmap_category_lat' =>        array('double(14,9)', 'NOT NULL', "0.000000000", ''),
            'mygmap_category_lng' =>        array('double(14,9)', 'NOT NULL', "0.000000000", ''),
            'mygmap_category_zoom' =>       array('int(2)',       'NOT NULL', "0", ''),
            'mygmap_category_maptype' =>    array('int(5)',       'NOT NULL', "0", ''),
            'mygmap_category_overlay' =>    array('varchar(255)', 'NULL', "",  ''),
        ),
        'primary' => 'mygmap_category_id',
        'usesys'=> true,
    );

    $tableDef['mygmap']['area'] = array(
        'fields' => array(
            'mygmap_area_id' =>         array('int(8)',       'NOT NULL', null,  'auto_increment'),
            'mygmap_area_name' =>       array('varchar(255)', 'NOT NULL', "",  ''),
            'mygmap_area_desc' =>       array('text',         'NULL',     "",  ''),
            'mygmap_area_lat' =>        array('double(14,9)', 'NOT NULL', "0.000000000", ''),
            'mygmap_area_lng' =>        array('double(14,9)', 'NOT NULL', "0.000000000", ''),
            'mygmap_area_zoom' =>       array('int(2)',       'NOT NULL', "0", ''),
            'mygmap_area_order' =>      array('int(5)',       'NOT NULL', "0", ''),
            'mygmap_area_maptype' =>    array('int(5)',       'NOT NULL', "0", ''),
        ),
        'primary' => 'mygmap_area_id',
        'usesys'=> true,
    );

    $tableDef['mygmap']['marker'] = array(
        'fields' => array(
            'mygmap_marker_id' =>          array('int(8)',          'NOT NULL', null, 'auto_increment'),
            'mygmap_marker_category_id' => array('int(8)',          'NOT NULL', "0",  ''),
            'mygmap_marker_title' =>       array('varchar(255)',    'NOT NULL', "",   ''),
            'mygmap_marker_desc' =>        array('text',            'NOT NULL', "",   ''),
            'mygmap_marker_icontext' =>    array('varchar(2)',      'NULL',     "",   ''),
            'mygmap_marker_lat' =>         array('double(14,9)',    'NOT NULL', "0.000000000", ''),
            'mygmap_marker_lng' =>         array('double(14,9)',    'NOT NULL', "0.000000000", ''),
            'mygmap_marker_zoom' =>        array('int(2)',          'NOT NULL', "0",  ''),
            'mygmap_marker_maptype' =>     array('int(5)',          'NOT NULL', "0",  ''),
        ),
        'primary' => 'mygmap_marker_id',
        'keys' => array(
            'mygmap_marker_category_id_key' => 'mygmap_marker_category_id',
        ),
        'usesys'=> true,
    );
?>
