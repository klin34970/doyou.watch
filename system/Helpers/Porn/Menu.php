<?php
/**
 * Menu Class
 */

namespace Helpers\Porn;


use Helpers\Porn\Register;
use Helpers\Url;

class Menu
{
	public $name;
	
	public $language;
	
	public function __construct($name = array())
	{
		$this->name = $name;
	}
	
	public function getProfile($user)
	{
		if(isset($user->username))
		{
			//print_r($user);
			return
					'
					<!-- Start left navigation - profile shortcut -->
					<div class="sidebar-content">
						<div class="media">
							<a class="pull-left has-notif avatar" href="/profile">
								<img src="'.Url::templatePath() . $user->avatar.'" alt="admin">
								<i class="online"></i>
							</a>
							<div class="media-body">
								<h4 class="media-heading">'.__d('system', 'Hello').', <span><br>'.$user->realname.'</span></h4>
								<br>
								<div>
									<small>'.__d('system', 'profile_'.$user->gender).'</small>
									<br>
									<small>'.__d('system', 'I\'m Looking for: '). __d('system', implode(', ', Register::getLookingforLabel($user->lookingfor))).'</small>
								</div>
							</div>
						</div>
					</div><!-- /.sidebar-content -->
					<!--/ End left navigation -  profile shortcut -->
					';
		}
		else
		{
			return
					'
					<!-- Start left navigation - profile shortcut -->
					<div class="sidebar-content">
						<div class="text-center">
							<div class="media">
								<div class="media-body">
									<a href="/signin" class="btn btn-danger"><i class="fa fa-sign-in"></i> '.__d('system', 'Sign In').'</a>
									<a href="/signup" class="btn btn-danger"><i class="fa fa-venus-mars"></i> '.__d('system', 'Sign Up').'</a>
								</div>
							</div>
						</div>
					</div><!-- /.sidebar-content -->
					<!--/ End left navigation -  profile shortcut -->
					';	
		}
	}
	
	public function buttonLogout($user)
	{
		if(isset($user->username))
		{
			return
					'
					<a id="logout" data-url="/logout" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Logout" data-original-title="" title="">
						<i class="fa fa-power-off">
						</i>
					</a>
					';
		}

	}
	
	public function getMenuHome($user)
	{
		$active 		= ($this->name[0] == 'home') ? 'active' : '';
		$selected 		= ($this->name[0] == 'home') ? '<span class="selected"></span>' : '';
		return 
				'
                    <li class="submenu '.$active.'">
                        <a href="/">
                            <span class="icon"><i class="fa fa-home"></i></span>
                            <span class="text">'.__d('system', 'Home').'</span>
							'.$selected.'
                        </a>
                    </li>
				';
	}

	public function getMenuCategories($user)
	{
		$active 		= ($this->name[0] == 'categories') ? 'active' : '';
		$selected 		= ($this->name[0] == 'categories') ? '<span class="selected"></span>' : '';
		
		$menu = 
				'
                    <li class="submenu '.$active.'">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-list-alt"></i></span>
                            <span class="text">'.__d('system', 'Categories').'</span>
                            <span class="arrow"></span>
							'.$selected.'
                        </a>
                        <ul>
				';
			
		if($this->name[0] == 'categories' && $this->name[1] == "")
		{
			$menu .= '<li class="active"><a href="/categories">'.__d('system', 'All').'</a></li>';
		}
		else
		{
			$menu .= '<li><a href="/categories">'.__d('system', 'All').'</a></li>';
		}
		
		$cat = array_unique($this->getCategoriesVideos());
		asort($cat);
		foreach($cat as $key => $value)
		{
			if($this->name[0] == 'categories' && $this->name[1] == strtolower($value))
			{
				$menu .= '<li class="active"><a href="/categories/'.strtolower(str_replace('/', '-', $value)).'">'.__d('system', $value).'</a></li>';
			}
			else
			{
				$menu .= '<li><a href="/categories/'.strtolower(str_replace('/', '-', $value)).'">'.__d('system', $value).'</a></li>';
			}
		}
		
		$menu .=
				'
                        </ul>
                    </li>
				';
				
		return $menu;
	}
	
	public function getMenuProviders($user)
	{
		$active 		= ($this->name[0] == 'providers') ? 'active' : '';
		$selected 		= ($this->name[0] == 'providers') ? '<span class="selected"></span>' : '';
		
		$menu = 
				'
                    <li class="submenu '.$active.'">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-database"></i></span>
                            <span class="text">'.__d('system', 'Providers').'</span>
                            <span class="arrow"></span>
							'.$selected.'
                        </a>
                        <ul>
				';
			
		foreach(array_unique($this->getProvidersVideos()) as $key => $value)
		{
			if($this->name[0] == 'providers' && $this->name[1] == strtolower($value))
			{
				$menu .= '<li class="active"><a href="/providers/'.strtolower(str_replace('/', '-', $value)).'">'.__d('system', $value).'</a></li>';
			}
			else
			{
				$menu .= '<li><a href="/providers/'.strtolower(str_replace('/', '-', $value)).'">'.__d('system', $value).'</a></li>';
			}
		}
		
		$menu .=
				'
                        </ul>
                    </li>
				';
				
		return $menu;
	}
	
	public function getMenuMembers($user)
	{
		if(isset($user->username))
		{
			$active 		= ($this->name[0] == 'members') ? 'active' : '';
			$selected 		= ($this->name[0] == 'members') ? '<span class="selected"></span>' : '';
			return 
					'
						<li class="submenu '.$active.'">
							<a href="/members">
								<span class="icon"><i class="fa fa-users"></i></span>
								<span class="text">'.__d('system', 'Members').'</span>
								'.$selected.'
							</a>
						</li>
					';
		}
	}
	
	public function getProvidersVideos()
	{
		//echo '<pre>' . print_r($this->getCategoriesMenu(), true) . '</pre>';
		return array(
						'Pornhub.com',
						'Redtube.com',
						'Tube8.com',
						'Xtube.com',
						'Youporn.com',
						'Spankwire.com',
						'Xhamster.com',
						'Xvideos.com',
						'Porndig.com',
						'Vporn.com',
		);
	}
	
	public function getCategoriesVideos()
	{
		return array(
						'Others',
						'3D',
						'Amateur',
						'Anal',
						'Anime',
						'Asian',
						'Babe',
						'Bareback',
						'BBW',
						'Bdsm',
						'Bear',
						'Bi/straight Guys',
						'Big Ass',
						'Big Boobs',
						'Big Butt',
						'Big Dick',
						'Big Tits',
						'Bisexual',
						'Black',
						'Blonde',
						'Blowjob',
						'Bondage',
						'Brunette',
						'Bukkake',
						'Bush',
						'Butts',
						'Camel Toe',
						'Celebrity',
						'Coed',
						'College',
						'Compilation',
						'Couples',
						'Creampie',
						'Cumshot',
						'Cunnilingus',
						'Daddies',
						'Dildo/toys',
						'Double Penetration',
						'Ebony',
						'Euro',
						'European',
						'Facial',
						'Fantasy',
						'Fingering',
						'Fisting',
						'For Women',
						'Funny',
						'Fursuits',
						'Gangbang',
						'Gay',
						'German',
						'Gonzo',
						'Group',
						'Hairy',
						'Handjob',
						'Hardcore',
						'HD',
						'Hentai',
						'Homemade',
						'Hunks',
						'Indian',
						'Interracial',
						'Interview',
						'Japanese',
						'Jerk-Off',
						'Kissing',
						'Latina/latino',
						'Lesbian',
						'Lingerie',
						'Massage',
						'Masturbation',
						'Mature',
						'MILF',
						'Miscellaneous',
						'Muscle',
						'My Cock',
						'News',
						'Orgy',
						'Outdoor',
						'Panties/underwear',
						'Pantyhose',
						'Party',
						'Pornstar',
						'POV',
						'Public',
						'Reality',
						'Red Head',
						'Romantic',
						'Rimming',
						'Rough Sex',
						'Sex',
						'Shaved',
						'Shemale',
						'Small Tits',
						'Softcore',
						'Solo',
						'Spanking',
						'Squirt',
						'Straight',
						'Striptease',
						'Swallow',
						'Swingers',
						'Teen',
						'Threesome',
						'Toys',
						'Transexual',
						'Twink',
						'Uniforms',
						'Vintage',
						'Voyeur',
						'Webcam',
						'Wild & Crazy',
						'Yaoi',
						'Young/Old',
						
						'Albanian',
						'Algerian',
						'Arab',
						'Argentinian',
						'Armenian',
						'Ass Licking',
						'Audition',
						'Australian',
						'Austrian',
						'Azeri',
						'Bangladeshi',
						'Ballbusting',
						'Belgian',
						'Bolivian',
						'Bosnian',
						'Brazilian',
						'British',
						'Bulgarian',
						'Cambodian',
						'Canadian',
						'Chilean',
						'Chinese',
						'Colombian',
						'Croatian',
						'Czech',
						'Danish',
						'Dutch',
						'Ecuador',
						'Egyptian',
						'Estonia',
						'French',
						'German',
						'Greek',
						'Guadeloupe',
						'Guatemala',
						'Hungarian',
						'Indonesian',
						'Iranian',
						'Irish',
						'Israeli',
						'Italian',
						'Jamaican',
						'Korean',
						'Latvian',
						'Lithuanian',
						'Macedonian',
						'Malaysian',
						'Medical',
						'Mexican',
						'Military',
						'Moldavian',
						'Moroccan',
						'Nigerian',
						'Norwegian',
						'Pakistani',
						'Peruvian',
						'Philippines',
						'Polish',
						'Portuguese',
						'Puerto Rican',
						'Romanian',
						'Russian',
						'Serbian',
						'Singaporean',
						'Slovakian',
						'Slovenian',
						'Spanish',
						'Sri Lankan',
						'Swedish',
						'Swiss',
						'Sybian',
						'Thai',
						'Tunisian',
						'Turkish',
						'Ukrainian',
						'Venezuelan',
						'Vietnamese',
						'Slovenian',
						'Spanish',
						'Sri Lankan',
		);
	}
}
