<?php 
namespace App\Models;

use Core\Model;
use Helpers\Porn\RestrictionsVideos;
use Database\Model as BaseModel;

class Welcome extends BaseModel 
{    
	protected $table = 'videos';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getAllVideosCount()
	{
		$query = $this->newQuery();
		
		foreach(RestrictionsVideos::gayVideos() as $video) 
		{
			$query->where('categories', 'NOT LIKE', '%'.$video.'%');
			$query->where('tags', 'NOT LIKE', '%'.$video.'%');
			$query->where('title', 'NOT LIKE', '%'.$video.'%');
		}
		
		return $query->count();
	}
	
	public function getAllVideos($offset, $limit, $order)
	{
		switch($order)
		{
			case 'mw':
				$order = 'views';
				break;
			case 'nw':
				$order = 'id';
				break;
			case 'lg':
				$order = 'duration';
				break;
			default:
				$order = 'id';
				break;
		}

		$query = $this->newQuery();
		
		foreach(RestrictionsVideos::gayVideos() as $video) 
		{
			$query->where('categories', 'NOT LIKE', '%'.$video.'%');
			$query->where('tags', 'NOT LIKE', '%'.$video.'%');
			$query->where('title', 'NOT LIKE', '%'.$video.'%');
		}

		return $query->orderBy($order, 'DESC')
		->skip($offset)
		->take($limit)
		->get();
	}
}