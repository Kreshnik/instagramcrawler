<?php

namespace App\Generics;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;


abstract class GenericService
{
	protected $now;
	protected $events;
	protected $carbon;
	protected $repository;

	/**
	 *
	 */
	public function __construct()
	{
		$this->events = App::make('Illuminate\Events\Dispatcher');
		$this->carbon = new Carbon();
		$this->now = $this->carbon->now();
	}

}
