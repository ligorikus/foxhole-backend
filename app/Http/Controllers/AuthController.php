<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Laravel\Passport\Http\Controllers\ConvertsPsrResponses;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Nyholm\Psr7\Response as Psr7Response;
use Nyholm\Psr7\ServerRequest;

class AuthController extends Controller
{
    use ConvertsPsrResponses, HandlesOAuthErrors;

    public function steamAuth()
    {
        return Socialite::driver('steam')->redirect();
    }

    /**
     * @throws OAuthServerException
     * @throws \Laravel\Passport\Exceptions\OAuthServerException
     */
    public function steamCallback()
    {
        $steamUser = Socialite::driver('steam')->user();

        /** @var User $user */
        $user = User::updateOrCreate([
            'steam_id' => $steamUser->id,
        ], [
            'name' => $steamUser->nickname,
            'email' => $steamUser->email
        ]);

        $token = $user->createToken(
            $user->name,
            ['*'],
            Carbon::now()->addHour()
        )->accessToken;
        $query = http_build_query(
            ['token' => $token->token, 'user_id' => $user->getIdentifier()]
        );
        return Redirect::to(config('services.frontend.uri').'?'.$query);
    }
}
