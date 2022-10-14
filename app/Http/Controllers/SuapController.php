<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SuapController extends Controller
{
    private string $clientID;
    private string $secretKey;
    private string $urlToAuthUser;
    private string $urlToRedirect;
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->clientID = env('SUAP_CLIENTID', 'null');
        $this->secretKey = env('SUAP_SECRET_KEY', 'null');
        $this->urlToAuthUser = "https://suap.ifrn.edu.br/o/authorize/?client_id=" . $this->clientID . "&response_type=code";
        $this->urlToRedirect = "http://127.0.0.1/suap/login";
    }

    public function redirectUserToLoginPageSuap()
    {
        return redirect($this->urlToAuthUser);
    }

    public function receiveSuapCode(Request $request)
    {
        $code = $request->get('code');

        return $this->getDataFromSuap($request, $code);
    }

    public function getAuthorizationToken(Request $request, string $code)
    {
        $data = [
            'client_id' => $this->clientID,
            'client_secret' => $this->secretKey,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_url' => $this->urlToRedirect,
            'scope' => 'identify',
        ];

        $headers = ['Content-type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json'];

        $requestToSuap = $this->client->request(
            'POST',
            'https://suap.ifrn.edu.br/o/token/',
            [
                'headers' => $headers, 'form_params' => $data
            ]
        );

        return $requestToSuap->getBody()->getContents();
    }

    public function getDataFromSuap(Request $request, $code)
    {
        if (is_null($code))
            return redirect()
                ->route('login')
                ->with('error', "Ocorreu um erro ao autenticar com o suap.");

        $response = json_decode($this->getAuthorizationToken($request, $code), true);
        if (array_key_exists('error', $response)) {
            return redirect()
                ->route('login')
                ->with('error', "Ocorreu um erro ao autenticar com o suap.");
        }

        $authorizationToken = $response['access_token'];

        $getDataFromUser = $this->client->request(
            'GET',
            'https://suap.ifrn.edu.br/api/eu/',
            [
                'headers' => [
                    'authorization' => 'Bearer ' . $authorizationToken
                ]
            ]
        );

        return json_decode($getDataFromUser->getBody(), true);
    }
}
