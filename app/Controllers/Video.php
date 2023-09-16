<?php
/**
 * Video controller
 */

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Hooks;
use Helpers\Url;
use Helpers\Porn\Menu;
use Auth;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Video extends Controller
{
	private $model;
	
    /**
     * Call the parent construct
     */
    public function __construct()
    {
		parent::__construct();
		$this->language->load('Video');
        $this->model = new \App\Models\Video();
    }

	public function js()
	{
		echo '<script src="'.Url::templatePath().'global/plugins/bower_components/allofthelights/jquery.allofthelights.js"></script>';
		echo '							
			<script>
				jQuery(document).ready(function() {
					jQuery(".video-player").allofthelights(
					{
						"z_index": "9999",
						"opacity": "1"
					});
				});
			</script>
			';
	}	

    /**
     * Define Index page title and load template files.
     */
    public function index($domain, $title, $video_id)
    {	
		$menu 					= new Menu(array('home'));
		$user					= Auth::user();
		
		$data['language']		= $this->language;
		$data['menu']			= $menu;
		
		$data['video'] 			= $this->model->getVideo($domain, $video_id);
		
		$data['title']			= $data['video']->title;
		
		$data['user']			= $user;
		
		Hooks::addHook('js', 'App\Controllers\Video@js');
		
		View::renderTemplate('header', $data);
		View::renderTemplate('navbar', $data);
		View::renderTemplate('sidebar-left', $data);
		View::render('Video/Video', $data);
		View::renderTemplate('sidebar-right', $data);
		View::renderTemplate('footer', $data);
		
		$postdata = array(
			'views' => $data['video']->views + 1
		);
		$where = array(
			'domain' => $domain,
			'video_id' => $video_id
		);
		
		$this->model->addView($postdata, $where);
    }   
}
