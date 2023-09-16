<?php
/**
 * Members controller
 */

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Core\Redirect;
use Helpers\Hooks;
use Helpers\Url;
use Helpers\Porn\Menu;
use Helpers\Porn\Register;
use Helpers\Paginator;
use Auth;
use Helpers\FastCache;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Members extends Controller
{
	private $model;
	
    /**
     * Call the parent construct
     */
    public function __construct()
    {
		parent::__construct();
		$this->language->load('Members');
		$this->model = new \App\Models\Members();
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

	public function index()
    {
		$user					= Auth::user();
		if($user->verified)
		{
			$cache 					= FastCache::getInstance();
			$register				= new Register();
			
			$menu 					= new Menu(array('members'));
			$pages 					= new Paginator('40','page');
			
			
			$data['language']		= $this->language;
			$data['menu']			= $menu;
			$data['register']		= $register;
			
			$keyword_webpage 		= md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].$pages->getLimit());
			$data['members'] 		= $cache->get($keyword_webpage);
			
			if(is_null($data['members'])) 
			{
				$data['members'] = $this->model->getMembers($pages->getLimit2(), $pages->getPerPage(), $user);
				$cache->set($keyword_webpage, $data['members'], CACHETIME);
			}
			
			$keyword_webpage_total 		= md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].$pages->getLimit().'total');
			$total = $cache->get($keyword_webpage_total);
			if(is_null($total))
			{
				$total = $this->model->getMembersCount($user);
				$cache->set($keyword_webpage_total, $total, CACHETIME);
			}
			$pages->setTotal($total);
			

			$data['pageLinks'] 		= $pages->pageLinks();

			$data['title']			= $data['language']->get('Title Page');
			$data['user']			= $user;
			
			Hooks::addHook('css', 'App\Controllers\Members@css');
			Hooks::addHook('js', 'App\Controllers\Members@js');
			
			View::renderTemplate('header', $data);
			View::renderTemplate('navbar', $data);
			View::renderTemplate('sidebar-left', $data);
			View::render('Members/Members', $data);
			View::renderTemplate('sidebar-right', $data);
			View::renderTemplate('footer', $data);
		}
		else
		{
			return Redirect::to('')->with('message', array('type' => 'danger', 'text' => $this->language->get('You need an verified account')));
		}
    }
}
