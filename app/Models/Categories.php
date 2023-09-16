<?php 
namespace App\Models;

use Core\Model;
use Database\Model as BaseModel;

class Categories extends BaseModel 
{    
	protected $table = 'videos';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getCategoriesVideosCount($name)
	{
		return $this->newQuery()->where('categories', 'LIKE', '%'.$name.'%')->count();
	}
	
	public function getCategoriesVideos($offset, $limit, $name, $order)
	{
		$name = urldecode($name);
		$name = str_replace('-', '/', $name);
		
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
		
		return $this->newQuery()
			->where('categories', 'LIKE', '%'.$name.'%')
			->orderBy($order, 'DESC')
			->skip($offset)
			->take($limit)
			->get();
	}
}