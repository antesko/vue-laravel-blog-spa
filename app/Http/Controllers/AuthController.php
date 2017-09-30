<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    public function token (Request $request)
    {
        $http = new Client();

        try {
            $response = $http->post(Config::get('app.url') . '/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => Config::get('services.api.client_id'),
                    'client_secret' => Config::get('services.api.client_secret'),
                    'username'      => $request->input('username'),
                    'password'      => $request->input('password'),
                    'scope'         => '',
                ],
            ]);
        } catch (RequestException $e) {
            $exception = (string) $e->getResponse()->getBody();
            $exception = json_decode($exception);
            return response()->json($exception, $e->getCode());
        }

        return response($response->getBody()->getContents(), $response->getStatusCode());
    }

    public function register (Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|between:2,50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return $user;
    }
}
