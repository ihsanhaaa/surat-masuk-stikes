<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SuperAdminLoggedIn;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('Admin')) {
            $ipAddress = $request->ip();
            $location = $this->getLocationFromIp($ipAddress);
            $locationUrl = $this->generateMapUrl($location);

            Mail::to('ih.haryansyah@gmail.com')->send(new SuperAdminLoggedIn($user, $ipAddress, $locationUrl));
        }
    }

    private function getLocationFromIp($ipAddress)
    {
        $client = new Client();
        $response = $client->request('GET', "http://ipinfo.io/{$ipAddress}/json");
        return json_decode($response->getBody(), true);
    }

    private function generateMapUrl($location)
    {
        $latitude = $location['loc'] ?? '0,0';
        $coords = explode(',', $latitude);
        $lat = $coords[0] ?? '0';
        $lng = $coords[1] ?? '0';

        // Buat tautan ke Google Maps
        return "https://www.google.com/maps?q={$lat},{$lng}";
    }
}
