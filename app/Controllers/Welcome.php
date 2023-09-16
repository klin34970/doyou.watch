<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Hooks;
use Helpers\Url;
use Helpers\Porn\Menu;
use Helpers\Paginator;
use Auth;
use Helpers\FastCache;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Welcome extends Controller
{
	private $model;
	
    /**
     * Call the parent construct
     */
    public function __construct()
    {
		parent::__construct();
		$this->language->load('Welcome');
        $this->model = new \App\Models\Welcome();
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

    /**
     * Define Index page title and load template files.
     */
    public function index()
    {
		$cache 					= FastCache::getInstance();
			
		$menu 					= new Menu(array('home'));
		$pages 					= new Paginator('40','page');
		$user					= Auth::user();
		
		$data['language']		= $this->language;
		$data['menu']			= $menu;
		
		/** CACHE **/
		$keyword_webpage 		= md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].$pages->getLimit());
		$data['videos'] 		= $cache->get($keyword_webpage);
		
		if(is_null($data['videos'])) 
		{
			$data['videos'] = $this->model->getAllVideos($pages->getLimit2(), $pages->getPerPage(), $_GET['order']);
			$cache->set($keyword_webpage, $data['videos'], CACHETIME);
		}
		
		$keyword_webpage_total 		= md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].$pages->getLimit().'total');
		$total = $cache->get($keyword_webpage_total);
		if(is_null($total))
		{
			$total = $this->model->getAllVideosCount();
			$cache->set($keyword_webpage_total, $total, CACHETIME);
		}
		$pages->setTotal($total);
		/** CACHE **/

		if(isset($_GET['order']))
		{
			$data['pageLinks'] 		= $pages->pageLinks('?', '&order=' . $_GET['order']);
		}
		else
		{
			$data['pageLinks'] 		= $pages->pageLinks();
		}
		
		$data['title']			= $data['language']->get('Title Page');
		
		$data['user']			= $user;

		Hooks::addHook('css', 'App\Controllers\Welcome@css');
		Hooks::addHook('js', 'App\Controllers\Welcome@js');
		
		View::renderTemplate('header', $data);
		View::renderTemplate('navbar', $data);
		View::renderTemplate('sidebar-left', $data);
		View::render('Welcome/Welcome', $data);
		View::renderTemplate('sidebar-right', $data);
		View::renderTemplate('footer', $data);
    }
}
