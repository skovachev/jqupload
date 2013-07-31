<?php

return array(
	'main_upload_dir' => '/uploads/',
	//folder in public dir where original files are stored
	'file_upload_dir'   => '/uploads/files/',
	'thumb_upload_dir' => '/uploads/thumbnails/',
	//Set  Route here which you will set in routes
	'delete_route'      => 'upload',
	//for controller route
	//'delete_route'      => '{controller_name}/{action}',

    'upload_dir_identifier' => function(){
        return null;
    },

    'root_path' => public_path()
 );