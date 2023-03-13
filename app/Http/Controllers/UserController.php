<?php

namespace App\Http\Controllers;

use App\Http\Requests\SelectWarRequest;
use App\Models\User;
use App\Models\UserWar;
use App\Models\War;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function me(): JsonResponse
    {
        $user = User::query()
            ->join('user_wars', 'users.id', '=', 'user_wars.user_id')
            ->join('wars', 'user_wars.war_id', '=', 'wars.id')
            ->select(['users.*', 'user_wars.fraction', 'wars.id'])
            ->where('users.id', auth()->id())
            ->get();
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function selectFraction(SelectWarRequest $request): JsonResponse
    {
        $war = War::active()->first();
        UserWar::query()
            ->updateOrInsert([
                'user_wars.user_id' => auth()->id(),
                'user_wars.war_id' => $war->id,
            ], ['user_wars.fraction' => $request->fraction]);

        $user = User::query()
            ->join('user_wars', 'users.id', '=', 'user_wars.user_id')
            ->join('wars', 'user_wars.war_id', '=', 'wars.id')
            ->select(['users.*', 'user_wars.fraction', 'wars.id'])
            ->where('users.id', auth()->id())
            ->get();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
}
