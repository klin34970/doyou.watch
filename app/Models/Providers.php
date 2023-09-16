<?php 
namespace App\Models;

use Core\Model;
use Database\Model as BaseModel;

class Providers extends BaseModel 
{    
	protected $table = 'videos';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getprovidersVideosCount($domain)
	{
		return $this->newQuery()->where('domain', '=', $domain)->count();
	}
	
	public function getProvidersVideos($offest, $limit, $domain, $order)
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

		return $this->newQuery()
			->where('domain', '=', $domain)
			->orderBy($order, 'DESC')
			->skip($offset)
			->take($limit)
			->get();
	}
}