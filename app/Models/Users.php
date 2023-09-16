<?php
/**
 * Users - A Users Model.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

namespace App\Models;

use Auth\Model as BaseModel;

use \stdClass;


class Users extends BaseModel
{
    protected $table = 'users';

    protected $primaryKey = 'id';


    public function __construct()
    {
        parent::__construct();
    }

    public function updateUser($user, array $data)
    {
        if($user instanceof stdClass) 
		{
            $userId = $user->{$this->primaryKey};
        } 
		else 
		{
            $userId = intval($user);
        }

        $this->where($this->primaryKey, $userId)->update($data);
    }
	
	public function registerUser(array $data)
	{
		return $this->insert($data);
	}
	
	public function mailAlreadyExist($email)
	{
		return $this->newQuery()
			->where('email', '=', $email)
			->exists();
	}
	
	public function userAlreadyExist($username)
	{
		return $this->newQuery()
			->where('username', '=', $username)
			->orWhere('email', '=', $username)
			->exists();
	}
	
	public function isActive($username)
	{
		return $this->newQuery()
			->where('username', '=', $username)
			->orWhere('email', '=', $username)
			->pluck('active');
	}
	
	public function activeUserByEmail($data, $where)
	{
		$query = $this->newQuery();

		foreach ($where as $key => $value) 
		{
			$query->where($key, '=', $value);
		} 

		return $query->update($data);
	}
}
