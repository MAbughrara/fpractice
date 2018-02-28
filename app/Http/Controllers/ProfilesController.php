<?php

namespace App\Http\Controllers;

use App\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show',
            [
                'profileUser' => $user,
                'activities'=>$this->gotActivity($user)
            ]
        );
    }

    /**
     * @param User $user
     * @return static
     */
    public function gotActivity(User $user)
    {
        return  $activities = $user->activities()->latest()->with('subject')->take(50)->get()->groupBy(function ($activities) {
            return $activities->created_at->format('Y-m-d');
        });
    }
}
