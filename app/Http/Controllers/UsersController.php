<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Validation\Rule;
use App\Models\User;
use Inertia\Inertia;
use Auth;
use Request;

class UsersController extends Controller
{
    public function index()
    {
        // return UserResource::collection(User::all());

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection(
                User::query()
                    ->when(Request::input('search'), function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->paginate(10)
                    ->withQueryString()
            ),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);

        // return Inertia::render('Users/Index', [
        //     'users' => User::query()
        //         ->when(Request::input('search'), function ($query, $search) {
        //             $query->where('name', 'like', "%{$search}%");
        //         })
        //         ->paginate(10)
        //         ->withQueryString()
        //         ->through(fn ($user) => [
        //             'id' => $user->id,
        //             'name' => $user->name,
        //             'can' => [
        //                 'edit' => Auth::user()->can('edit', $user)
        //             ]
        //         ]),

        //     'filters' => Request::only(['search']),
        //     'can' => [
        //         'createUser' => Auth::user()->can('create', User::class)
        //     ]
        // ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => UserResource::make($user)
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'password' => 'required',
        ]);

        User::create($attributes);

        return redirect('/users');
    }

    public function update(User $user)
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required',
        ]);

        $user->update($attributes);

        return redirect('/users');
    }
}
