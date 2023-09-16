<?php
/**
 * Users - A Controller for managing the Users Authentication.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

namespace App\Controllers;

use Core\Controller;
use Core\Redirect;
use Core\View;
use Helpers\Session;
use Helpers\Csrf;
use Helpers\Request;
use Helpers\Password;
use Helpers\Url;
use Helpers\Hooks;
use Helpers\Porn\Menu;
use Helpers\Porn\Register;
use Auth;
use Validator;


class Users extends Controller
{
    protected $layout = 'custom';

    protected $model;


    public function __construct()
    {
        parent::__construct();

        // Prepare the Users Model instance.
		$this->language->load('Users');
        $this->model = new \App\Models\Users();
    }
	
	public function signCss()
	{
		echo '<link href="'.Url::templatePath().'admin/css/pages/sign.css" rel="stylesheet">';
	}
	
	public function signJs()
	{
		echo '<script src="'.Url::templatePath().'global/plugins/bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.min.js"></script>';
		echo '<script src="'.Url::templatePath().'global/plugins/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>';
		echo '<script src="'.Url::templatePath().'admin/js/pages/blankon.sign.js"></script>';
		echo '
				<script>
					$(function() 
					{
						if($(".input-mask").length)
						{
							$(":input").inputmask();
						}	
					});
				</script>
			';
	}
	
    protected function before()
    {
        View::share('currentUri', Url::detectUri());

        return parent::before();
    }
	
	public function active()
	{
		$email = Request::get('email');
		$active_token = Request::get('code');
		if($this->model->activeUserByEmail(array('active' => '1'), array('email' => $email, 'active_token' => $active_token, 'active' => '0')))
		{
			return Redirect::to('signin')->with('message', $this->language->get('Your account has been activated'));
		}
		else
		{
			return Redirect::to('')->with('message', array('type' => 'danger', 'text' => $this->language->get('Action not permitted')));
		}
	}

	public function activity()
	{
		$userid = Request::post('userid');
		$this->model->updateUser($userid, array('activity' => date('Y-m-d H:i:s')));
	}
	
	//TODO : check the min and max strlen.
	public function signup()
	{
		$error = array();
		
		if(Request::isPost()) 
		{
			$gender 				= Request::post('gender');
			$lookingformen 			= Request::post('lookingformen');
			$lookingforwomen 		= Request::post('lookingforwomen');
			$lookingforcouple 		= Request::post('lookingforcouple');
			$username 				= Request::post('username');
			$realname 				= Request::post('realname');
			$age 					= Request::post('age');
			$password 				= Request::post('password');
			$password2 				= Request::post('password2');
			$email 					= Request::post('email');
			$tos 					= Request::post('tos');
			$newsletter 			= Request::post('newsletter');
			
			$signin = array(
							'gender' => $gender,
							'lookingformen' => $lookingformen,
							'lookingforwomen' => $lookingforwomen,
							'lookingforcouple' => $lookingforcouple,
							'username' => $username,
							'realname' => $realname,
							'age' => $age,
							'email' => $email,
							'tos' => $tos,
							'newsletter' => $newsletter			
			);
			
			Session::set('signin', $signin);
			
			if($lookingformen + $lookingforwomen + $lookingforcouple == 0)
			{
				$error[] = $this->language->get('You have to choose what your are looking for');
			}
			if($username == '')
			{
				$error[] = $this->language->get('You have to choose an username');
			}
			if($realname == '')
			{
				$error[] = $this->language->get('You have to choose an realname');
			}
			if($password != $password2)
			{
				$error[] = $this->language->get('Passwords are not equals');
			}
			if($age == '')
			{
				$error[] = $this->language->get('You have to choose an age');
			}
			if($email == '')
			{
				$error[] = $this->language->get('You have to choose an email');
			}
			if($tos == '')
			{
				$error[] = $this->language->get('You have to accept the Term of Service');
			}
			
			if($this->model->mailAlreadyExist($email))
			{
				$error[] = $this->language->get('This email is already used');
				$signin['email'] = null;
				//Session::destroy('signin');
				Session::set('signin', $signin);
			}
			if($this->model->userAlreadyExist($username))
			{
				$error[] = $this->language->get('This username is already used');
				$signin['username'] = null;
				//Session::destroy('signin');
				Session::set('signin', $signin);
			}
			
			$newage = date_format(date_create_from_format('d/m/Y', $age), 'Y-m-d');
			$year = date_format(date_create_from_format('d/m/Y', $age), 'Y');
			
			if((date('Y') - $year) < 18)
			{
				$error[] = $this->language->get('You must have 18 year old or more');
				$signin['age'] = null;
				Session::set('signin', $signin);
			}
			
			if(!isset($error[0]))
			{
				$active_token = md5(ENCRYPT_KEY . $username . $email . $newage);
				
				$postdata = array(
					'username'		=> $username,
					'realname'		=> $realname,                                 
					'password'		=> Password::make($password),
					'email'			=> $email,
					'gender'		=> $gender,
					'lookingfor'	=> $lookingformen+$lookingforwomen+$lookingforcouple,
					'age'			=> $newage,
					'newsletter'	=> (isset($newsletter)) ? 1 : 0,
					'date'			=> date('Y-m-d H:i:s'),
					'active_token'	=> $active_token
				);
				if($this->model->registerUser($postdata))
				{
					$register = new Register();
					$register->sendActivationMail($email, $active_token);
					Session::destroy('signin');
					return Redirect::to('')->with('message', $this->language->get('You registration is completed, you will received an email to active it'));
				}
				else
				{
					$error[] = $this->language->get('Something went wrong');
				}
			}
			
			
		}
		
		$menu 					= new Menu(array('home', $name));
		$data['menu']			= $menu;
		
		$data['session']		= Session::get('signin');
		
		$data['language']		= $this->language;
		$data['csrfToken']		= Csrf::makeToken();
		$data['error']			= $error;
		
		$data['title']			= $data['language']->get('Title signin');
		
		Hooks::addHook('css', 'App\Controllers\Users@signCss');
		Hooks::addHook('js', 'App\Controllers\Users@signJs');
		
		View::renderTemplate('header', $data);
		View::renderTemplate('navbar', $data);
		View::renderTemplate('sidebar-left', $data);
		View::render('Users/SignUp', $data);
		View::renderTemplate('sidebar-right', $data);
		View::renderTemplate('footer', $data);	
	}
	
    public function signin()
    {
		//Test template mail
		//$register = new Register();
		//$register->sendActivationMail('dj-east@hotmail.fr', 'active_token');
		
        $error = array();

        if(Request::isPost()) 
		{
			if($this->model->userAlreadyExist(Request::post('username')))
			{
				if($this->model->isActive(Request::post('username')))
				{
					// Prepare the Authentication credentials.
					$credentials = array(
						'username' => Request::post('username'),
						'password' => Request::post('password')
					);

					// Prepare the 'remember' parameter.
					$remember = (Request::post('remember') == 'on');

					// Make an attempt to login the Guest with the given credentials.
					if(Auth::attempt($credentials, $remember)) 
					{
						// The User is authenticated now; retrieve his data as an stdClass instance.
						$user = Auth::user();
						
						// Prepare the flash message.
						$message = sprintf('<b>%s</b>, '.$this->language->get('you have successfully logged in'), $user->realname);
						// Redirect to the User's Dashboard.
						return Redirect::to('')->with('message', $message);
					
					} 
					else 
					{
						
						// Prepare the Authentication credentials.
						$credentials = array(
							'email' => Request::post('username'),
							'password' => Request::post('password')
						);

						// Prepare the 'remember' parameter.
						$remember = (Request::post('remember') == 'on');

						// Make an attempt to login the Guest with the given credentials.
						if(Auth::attempt($credentials, $remember)) 
						{
							// The User is authenticated now; retrieve his data as an stdClass instance.
							$user = Auth::user();
							
							// Prepare the flash message.
							$message = sprintf('<b>%s</b>, '.$this->language->get('you have successfully logged in'), $user->realname);
							// Redirect to the User's Dashboard.
							return Redirect::to('')->with('message', $message);
						}
						else
						{
							// An error has happened on authentication; add a message into $error array.
							$error[] = 'Wrong username or password.';
						}
					}
				}
				else
				{
					$error[] = $this->language->get('Your account is not activated');
				}
			}
			else
			{
				$error[] = $this->language->get('Wrong username');
			}
        }

		$menu 					= new Menu(array('home', $name));
		$user 					= Auth::user();
		$data['menu']			= $menu;
		
		$data['language']		= $this->language;
		$data['csrfToken']		= Csrf::makeToken();
		$data['error']			= $error;
		
		$data['user']			= $user;
		
		$data['title']			= $data['language']->get('Title signin');
		
		Hooks::addHook('css', 'App\Controllers\Users@signCss');
		Hooks::addHook('js', 'App\Controllers\Users@signJs');
		
		View::renderTemplate('header', $data);
		View::renderTemplate('navbar', $data);
		View::renderTemplate('sidebar-left', $data);
		View::render('Users/SignIn', $data);
		View::renderTemplate('sidebar-right', $data);
		View::renderTemplate('footer', $data);
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('')->with('message', 'You have successfully logged out.');
    }

    public function profile()
    {
        $user = Auth::user();

        $error = array();

        if(Request::isPost()) 
		{
            $password = Request::post('password');

            $newPassword = Request::post('newPassword');
            $verPassword = Request::post('verPassword');

            if (! Password::verify($password, $user->password)) 
			{
                $error[] = $this->language->get('Wrong current Password inserted');
            } 
			else if ($newPassword != $verPassword) 
			{
                $error[] = $this->language->get('The new Password and its verification are not equals');
            } 
			else if(! preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $newPassword)) 
			{
                $error[] = $this->language->get('The new Password is not strong enough');
            } 
			else 
			{
                $this->model->updateUser($user, array('password' => Password::make($newPassword)));

                // Use a Redirect to avoid the reposting the data.
                return Redirect::to('profile')->with('message', $this->language->get('You have successfully updated your Password'));
            }
        }

		$menu 					= new Menu(array('home', $name));
		$data['menu']			= $menu;
		
		$data['language']		= $this->language;
		$data['csrfToken']		= Csrf::makeToken();
		$data['error']			= $error;
		
		$data['user']			= $user;
		$data['title']			= $data['language']->get('Title Change password');
		
		Hooks::addHook('css', 'App\Controllers\Users@signCss');
		Hooks::addHook('js', 'App\Controllers\Users@signJs');
		
		View::renderTemplate('header', $data);
		View::renderTemplate('navbar', $data);
		View::renderTemplate('sidebar-left', $data);
		View::render('Users/Profile', $data);
		View::renderTemplate('sidebar-right', $data);
		View::renderTemplate('footer', $data);
    }
}
