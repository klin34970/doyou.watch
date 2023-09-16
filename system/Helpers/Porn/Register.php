<?php

namespace Helpers\Porn;

Use Helpers\Mailer;
Use Helpers\Porn\TemplateMailer;

class Register
{
	public $language;
	
	public function __construct()
	{

	}
	
	public function sendActivationMail($email, $active_token)
	{
		$template = new TemplateMailer();
		$mail = new Mailer();
		$mail->setFrom('noreply@doyou.watch', 'Doyou.Watch');
		$mail->addAddress($email);
		$mail->subject('Active your account'); 
		$mail->msgHTML($template->templateActiveUser('Hello, the link for activate your account is <a href="http://doyou.watch/active?email='.$email.'&code='.$active_token.'">here</a>'));
		$mail->send();
	}

	public function getLookingforLabel($lookingfor)
	{
		if($lookingfor & 1) $array[] = 'Men';
		if($lookingfor & 2) $array[] = 'Women';
		if($lookingfor & 4) $array[] = 'Couple';
		return $array;
	}
	
	public function dateDisconnected($date)
	{
		$from 	= date_create(date('Y-m-d H:i:s'));
		$to 	= date_create($date);
		$diff	= date_diff($to, $from);

		if($diff->format('%Y') > 0)
		{
			$format = ($diff->format('%Y') == 1) ? __d('system', 'Year') : __d('system', 'Years');
			return $diff->format('%Y') . ' '.$format;
		}
		if($diff->format('%a') > 0)
		{
			$format = ($diff->format('%a') == 1) ? __d('system', 'Day') : __d('system', 'Days');
			return $diff->format('%a') . ' '.$format;
		}
		if($diff->format('%h') > 0)
		{
			$format = ($diff->format('%h') == 1) ? __d('system', 'Hour') : __d('system', 'Hours');
			return $diff->format('%h') . ' '.$format;
		}
		if($diff->format('%i') > 0)
		{
			$format = ($diff->format('%i') == 1) ? __d('system', 'Min') : __d('system', 'Mins');
			return $diff->format('%i') . ' '.$format;
		}
		if($diff->format('%s') > 0)
		{
			$format = ($diff->format('%s') == 1) ? __d('system', 'Sec') : __d('system', 'Secs');
			return $diff->format('%s') . ' '.$format;
		}
	}
}