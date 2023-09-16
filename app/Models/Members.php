<?php 
namespace App\Models;

use Core\Model;
use Database\Model as BaseModel;

class Members extends BaseModel 
{ 
	protected $table = 'users';
	
	protected $primaryKey = 'id';
	
    function __construct()
    {
        parent::__construct();
    }
	
	public function getMembersCount($user)
	{
		return $this->newQuery()->where('id', '<>', $user->id)->where('verified', '=', 1)->count();
	}
	
	public function getMembers($offset, $limit, $user)
	{
		return $this->newQuery()
			->where('id', '<>', $user->id)
			->orderBy('activity', 'DESC')
			->skip($offset)
			->take($limit)
			->get();
	}
}