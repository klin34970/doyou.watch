<?php 
namespace App\Models;

use Core\Model;
use Database\Model as BaseModel;

class Search extends BaseModel 
{    
	protected $table = 'videos';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getSearchVideosCount($keywords)
	{
		$query = $this->newQuery();
		
		/*
		$keys = explode(' ', $keywords);
		foreach($keys as $key)
		{
			$term = trim($key);
			if(!empty($term))
			{
				$query->where('categories', 'LIKE', '%'.$term.'%');
				$query->where('tags', 'LIKE', '%'.$term.'%');
				$query->where('title', 'LIKE', '%'.$term.'%');
			}
		}
		*/
		
		$query->where('categories', 'LIKE', '%'.$keywords.'%');
		$query->Orwhere('tags', 'LIKE', '%'.$keywords.'%');
		$query->Orwhere('title', 'LIKE', '%'.$keywords.'%');
	
		return $query->count();
	}
	
	public function getSearchVideos($offset, $limit, $keywords)
	{
		if($keywords != "")
		{
			$query = $this->newQuery();
			
			/*
			$keys = explode(' ', $keywords);
			foreach($keys as $key)
			{
				$term = trim($key);
				if(!empty($term))
				{
					print_r($term);
					$query->where('categories', 'LIKE', '%'.$term.'%');
					$query->Orwhere('tags', 'LIKE', '%'.$term.'%');
					$query->Orwhere('title', 'LIKE', '%'.$term.'%');
				}
			}
			*/
			
			$query->where('categories', 'LIKE', '%'.$keywords.'%');
			$query->Orwhere('tags', 'LIKE', '%'.$keywords.'%');
			$query->Orwhere('title', 'LIKE', '%'.$keywords.'%');
					
			return $query->orderBy('views', 'DESC')
			->orderBy('id', 'DESC')
			->skip($offset)
			->take($limit)
			->get();
		}
	}
}