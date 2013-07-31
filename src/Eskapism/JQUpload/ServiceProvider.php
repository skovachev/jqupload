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
use Sentry;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

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
			foreach (Config::get('fileupload') as $key => $value) {
				$option[$key] = $value;
			}

			// set uploads directory to a user specific one
			if (Sentry::check())
			{
				$id = Sentry::user()->id;
				$file_upload_dir = $option['file_upload_dir'] . $id . DS;
				$thumb_upload_dir = $option['thumb_upload_dir'] . $id . DS;

				$file_upload_dir_full = path('public') . $file_upload_dir;
				if (!is_dir($file_upload_dir_full))
				{
					mkdir($file_upload_dir_full, 0777, true);
				}

				$thumb_upload_dir_full = path('public') . $thumb_upload_dir;
				if (!is_dir($thumb_upload_dir_full))
				{
					mkdir($thumb_upload_dir_full, 0777, true);
				}

				$option['file_upload_dir'] = $file_upload_dir;
				$option['thumb_upload_dir'] = $thumb_upload_dir;
			}

			return new UploadHandler($option);
        });
    }
}