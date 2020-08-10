<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\User\Profile\BaseController;

// Models
use App\Models\User;

// Repositories
use App\Repositories\User\Profile\ProfileIndexRepository;

// Requests
use App\Http\Requests\User\Profile\UpdateRequest;

class IndexController extends BaseController
{
    protected $profileIndexRepository;

    public function __construct()
    {
        parent::__construct();
        $this->profileIndexRepository = app(ProfileIndexRepository::class);
    }

    public function index() {
        $user = auth()->user()->user_setting;
        return view('layouts.user.profile.index', compact('user'));
    }

    public function update(UpdateRequest $request) {
        $this->profileIndexRepository->update($request);
        return redirect()
                ->back()
                ->with('success', 'Сохранено');
    }

    public function shopProfileShow($shop_id)
    {
        $shop = User::find($shop_id);

        if ($shop->roles->first()->name == 'shop')
        {
            $shop_setting = $shop->shop_setting;
            $shop_media = $shop->media;
        }else
        {
            return abort(404);
        }

        return view('layouts.user.profile.shop.show', compact('shop_setting', 'shop_media'));
    }

}
