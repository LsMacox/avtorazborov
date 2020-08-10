<?php

namespace App\Http\Controllers\Shop\Profile;

use App\Http\Controllers\Shop\Profile\BaseController;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Shop\Profile\UpdateRequest;

// Repositories
use App\Repositories\Shop\Profile\ProfileIndexRepository;

class IndexController extends BaseController
{
    protected $profileIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->profileIndexRepository = app(ProfileIndexRepository::class);
    }

    public function index()
    {
        $shop_setting = auth()->user()->shop_setting;
        $shop_media = auth()->user()->media;

        return view('layouts.shop.profile.index', compact('shop_setting', 'shop_media'));
    }

    public function update(UpdateRequest $request)
    {

        $this->profileIndexRepository->update($request);

        return redirect()
            ->back()
            ->with('success', 'Сохранено');

    }

}
