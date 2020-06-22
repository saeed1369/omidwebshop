<?php

namespace App\Http\View\Composer;
use App\Repositories\UserRepository;
use Illuminate\View\View;
class ProfileComposer
{
		protected $user;
		private $sal = 1398;


	public function compose(View $view)
	{
		$view->with('sal',$this->sal);
	}
}
?>