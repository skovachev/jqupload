<?php

return array(
	'main_upload_dir' => DS. 'uploads'.DS,
	//folder in public dir where original files are stored
	'file_upload_dir'   => DS.  'uploads'.DS.'files'.DS,
	'thumb_upload_dir' => DS . 'uploads'.DS.'thumbnails'.DS,
	//Set  Route here which you will set in routes
	'delete_route'      => 'upload',
	//for controller route
	//'delete_route'      => '{controller_name}/{action}',
 );