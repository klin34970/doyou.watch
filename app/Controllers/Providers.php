<?php
/**
 * Providers controller
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
class Providers extends Controller
{
	private $model;
	
    /**
     * Call the parent construct
     */
    public function __construct()
    {
		parent::__construct();
		$this->language->load('Providers');
		$this->model = new \App\Models\Providers();
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
		Url::redirect('');
    }   

	public function provider($domain)
    {
		$cache 					= FastCache::getInstance();
		
		$menu 					= new Menu(array('providers', $domain));
		$pages 					= new Paginator('40','page');
		$user					= Auth::user();
		
		$data['language']		= $this->language;
		$data['menu']			= $menu;
		
		/** CACHE TABLE **/
		$keyword_webpage 		= md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].$pages->getLimit());
		$data['videos'] 		= $cache->get($keyword_webpage);
		
		if(is_null($data['videos'])) 
		{
			$data['videos'] = $this->model->getProvidersVideos($pages->getLimit(), $pages->getPerPage(), ucfirst($domain), $_GET['order']);
			$cache->set($keyword_webpage, $data['videos'], CACHETIME);
		}
		
		$keyword_webpage_total 		= md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].$pages->getLimit().'total');
		$total = $cache->get($keyword_webpage_total);
		if(is_null($total))
		{
			$total = $this->model->getProvidersVideosCount($domain);
			$cache->set($keyword_webpage_total, $total, CACHETIME);
		}
		$pages->setTotal($total);  
		/** CACHE TABLE **/
		
		$data['pageLinks'] 		= $pages->pageLinks('?', '&order=' . $_GET['order']);
		$data['pagename']		= $domain;
		
		$data['title']			= $data['language']->get('Title Page');
		$data['user']			= $user;

		Hooks::addHook('css', 'App\Controllers\Providers@css');
		Hooks::addHook('js', 'App\Controllers\Providers@js');
		
        View::renderTemplate('header', $data);
        View::renderTemplate('navbar', $data);
		View::renderTemplate('sidebar-left', $data);
		View::render('Providers/Provider', $data);
		View::renderTemplate('sidebar-right', $data);
        View::renderTemplate('footer', $data);
    }
}
