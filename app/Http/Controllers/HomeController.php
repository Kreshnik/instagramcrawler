<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Modules\Instagram\Service\Contract\InstagramServiceInterface;

class HomeController extends Controller{


    /**
     * @var InstagramServiceInterface
     */
    private $instagramService;

    public function __construct(InstagramServiceInterface $instagramService)
	{
       $this->instagramService = $instagramService;
    }


	public function index()
	{
		return view('search');
	}

	public function search(SearchRequest $request)
	{
        $tag = $string = preg_replace('/\s+/', '', $request->input('tag'));
        $media = $this->instagramService->getRecentMediaByTag($tag);
        return view('search')->with('mediaList', $media->get('data'));
    }

    public function user($id)
    {
        $user = $this->instagramService->getUserInfoById($id);
        $user = $user->get('data');

        $userMediaList = $this->instagramService->limit(100)->getUserMediaByUserId($id);
        $userMediaList = $userMediaList->get('data');
        return view('user.profile',[
            'user' => $user,
            'userMediaList' => $userMediaList
        ]);
    }

}