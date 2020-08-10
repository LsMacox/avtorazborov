<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Admin\Profile\BaseController;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Admin\Profile\UpdateRequest;

// Repositories
use App\Repositories\Admin\Profile\ProfileIndexRepository;


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
        $user = auth()->user()->admin_setting;

        return view('layouts.admin.profile.index', compact('user'));
    }

    public function update(UpdateRequest $request)
    {

        $this->profileIndexRepository->update($request);

        return redirect()
            ->back()
            ->with('success', 'Сохранено');

    }

}
