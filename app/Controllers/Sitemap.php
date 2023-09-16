<?php
/**
 * Sitemap controller
 */

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Paginator;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Sitemap extends Controller
{
	private $model;
	
    /**
     * Call the parent construct
     */
    public function __construct()
    {
		parent::__construct();
		$this->model = new \App\Models\Sitemap();
    }
	

    /**
     * Define Index page title and load template files.
     */
    public function xml()
    {
		$pages 					= new Paginator('50000','page');
		$data['videos']			= $this->model->getVideos($pages->getLimit2(), $pages->getPerPage());
		$pages->setTotal($this->model->getVideosCount());
		
		View::render('Sitemap/Xml', $data);
    }   
}
