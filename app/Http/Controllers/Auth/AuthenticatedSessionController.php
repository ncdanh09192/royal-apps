<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use GuzzleHttp\Client;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    const SYM_SKELETON_API_URL = 'https://symfony-skeleton.q-tests.com/api/v2/token';
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        // get symphony skeleton api and update user's sym_token
        $this->saveSymSklApiToken($request);
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function saveSymSklApiToken($request){
        try {
            $client = new Client();
            $res = $client->post(self::SYM_SKELETON_API_URL, [
                'json' => [
                    'email' => config('core.SYM_SKL_API_USER'),
                    'password' => config('core.SYM_SKL_API_PASSWORD')
                ]
            ]);
            if($res->getStatusCode() == '200'){
                $user = User::where([
                    'email' => $request->email
                ])->first();
                $resData = json_decode($res->getBody());
                if(!empty($resData->token_key) && !empty($user)){
                    $user->sym_token = $resData->token_key;
                    $user->save();
                }
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
