<?php 
namespace App\Models;

use Core\Model;
use Database\Model as BaseModel;

class Sitemap extends BaseModel 
{    

	protected $table = 'videos';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getVideosCount()
	{
		return $this->newQuery()->count();
	}
	
	public function getVideos($offset, $limit)
	{
		return $this->newQuery()
			->orderBy('id', 'DESC')
			->skip($offset)
			->take($limit)
			->get();
	}
}