<?php namespace Eskapism\JQUpload;
/*
 * jQueryFileUpload Bundle for Laravel
 * https://github.com/boparaiamrit/laravel-jqueryfileupload
 *
 * Plugin from
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

use Config;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function boot()
    {
        $this->package('skovachev/jqupload', 'jqupload', __DIR__.'/../../../');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['uploadhandler'] = $this->app->share(function($app)
        {
            $option = array();

			foreach (Config::get('jqupload::config') as $key => $value) {
				$option[$key] = $value;
			}

            $upload_dir_identifier = '';
            if (isset($option['upload_dir_identifier'])) 
            {
                $value = value($option['upload_dir_identifier']);
                if (! empty($value))
                {
                    $upload_dir_identifier = $value . '/';
                }
            }

			// set uploads directory to a user specific one
			
			$file_upload_dir = $option['file_upload_dir'] . $upload_dir_identifier;
			$thumb_upload_dir = $option['thumb_upload_dir'] . $upload_dir_identifier;

			$file_upload_dir_full = $option['root_path'] . $file_upload_dir;
			if (!is_dir($file_upload_dir_full))
			{
				mkdir($file_upload_dir_full, 0777, true);
			}

			$thumb_upload_dir_full = $option['root_path'] . $thumb_upload_dir;
			if (!is_dir($thumb_upload_dir_full))
			{
				mkdir($thumb_upload_dir_full, 0777, true);
			}

			$option['file_upload_dir'] = $file_upload_dir;
			$option['thumb_upload_dir'] = $thumb_upload_dir;

			return new UploadHandler($option);
        });
    }
}