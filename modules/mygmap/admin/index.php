<?php
include '../../../include/cp_header.php';
header('Location:'. XOOPS_URL . '/modules/mygmap/admin/admin.php?fct=preferences&op=showmod&mod=' . $xoopsModule -> getVar( 'mid' ));
xoops_cp_header();
if( file_exists( './mymenu.php' ) ) include( './mymenu.php' ) ;
?>