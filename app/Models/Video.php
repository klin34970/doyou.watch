<?php 
namespace App\Models;

use Core\Model;
use Database\Model as BaseModel;

class Video extends BaseModel 
{    
	protected $table = 'videos';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getVideo($domain, $video_id)
	{
		return $this->newQuery()
			->where('domain', '=', $domain)
			->where('video_id', '=', $video_id)
			->first();
	}
	
	public function addView($data, $where)
	{
		$query = $this->newQuery();

		foreach ($where as $key => $value) 
		{
			$query->where($key, '=', $value);
		} 

		return $query->update($data);
	}
}