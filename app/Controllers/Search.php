<?php
/**
 * Search controller
 */

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Core\Redirect;
use Helpers\Hooks;
use Helpers\Url;
use Helpers\Request;
use Helpers\Porn\Menu;
use Helpers\Paginator;
use Auth;


/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Search extends Controller
{
	private $model;
	
    /**
     * Call the parent construct
     */
    public function __construct()
    {
		parent::__construct();
		$this->language->load('Search');
		$this->model = new \App\Models\Search();
    }
	
	public function css()
	{
		echo '<link href="'.Url::templatePath().'admin/css/pages/gallery.css" rel="stylesheet">';
	}
	
	public function js()
	{
		echo '<script src="'.Url::templatePath().'global/plugins/bower_components/mixitup/build/jquery.mixitup.min.js"></script>';
		echo '<script src="'.Url::templatePath().'admin/js/pages/blankon.gallery.js"></script>';
	}

	public function search()
    {
		if(Request::get('keywords'))
		{
			$menu 					= new Menu(array('home', $name));
			$pages 					= new Paginator('40','page');
			$user					= Auth::user();
			
			$data['language']		= $this->language;
			$data['menu']			= $menu;
			$data['videos']			= $this->model->getSearchVideos($pages->getLimit2(), $pages->getPerPage(), Request::get('keywords'));
			$pages->setTotal($this->model->getSearchVideosCount(Request::get('keywords')));  
			$data['pageLinks'] 		= $pages->pageLinks('?', '&keywords='.str_replace(' ', '+', Request::get('keywords').''));
			$data['pagename']		= $name;
			
			$data['title']			= $data['language']->get('Title Page');
			$data['user']			= $user;

			Hooks::addHook('css', 'App\Controllers\Search@css');
			Hooks::addHook('js', 'App\Controllers\Search@js');
			
			View::renderTemplate('header', $data);
			View::renderTemplate('navbar', $data);
			View::renderTemplate('sidebar-left', $data);
			View::render('Search/Search', $data);
			View::renderTemplate('sidebar-right', $data);
			View::renderTemplate('footer', $data);
		}
		else
		{
			return Redirect::to('');
		}
    }
}
