<?php

namespace MaRuoppolo\WhmApi;

class WhmApi
{
    private $whmUrl;
    private $username;
    private $token;

    public function __construct($whmUrl, $username, $token)
    {
        $this->whmUrl = $whmUrl;
        $this->username = $username;
        $this->token = $token;
    }

    private function sendRequest($endpoint, $params = [])
    {
        $url = "{$this->whmUrl}/json-api/{$endpoint}";
        $headers = [
            "Authorization: whm {$this->username}:{$this->token}"
        ];

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('cURL Error: ' . curl_error($ch));
        }
        curl_close($ch);

        return json_decode($response, true);
    }

    public function createAccount($domain, $username, $password, $plan)
    {
        $params = [
            'domain' => $domain,
            'username' => $username,
            'password' => $password,
            'plan' => $plan,
        ];

        return $this->sendRequest('createacct', $params);
    }

    public function suspendAccount($username, $reason = '')
    {
        $params = [
            'user' => $username,
            'reason' => $reason,
        ];

        return $this->sendRequest('suspendacct', $params);
    }

    public function terminateAccount($username)
    {
        $params = [
            'user' => $username,
        ];

        return $this->sendRequest('removeacct', $params);
    }

    public function unsuspendAccount($username)
    {
        $params = [
            'user' => $username,
        ];

        return $this->sendRequest('unsuspendacct', $params);
    }
}
