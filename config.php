<?php
class Sayout
{
    private $username;
    private $message;
    private $cookie = "cookie.txt";

    public function __construct($username, $message)
    {
        $this->username = $username;
        $this->message = $message;
    }

    protected function grabToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sayout.me/say/' . $this->username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_COOKIEFILE => $this->cookie,
            CURLOPT_COOKIEJAR => $this->cookie,
        ));

        $response = curl_exec($curl);
        $token =  substr($response, strpos($response, 'name="token" value="') + 20, 32);
        return $token;
    }

    protected function bombUser($token)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sayout.me/say/' . $this->username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'message=' . urlencode($this->message) . '&token=' . $token,
            CURLOPT_COOKIEFILE => $this->cookie,
            CURLOPT_COOKIEJAR => $this->cookie,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (strpos($response, 'Thank You For Your Honesty :).')) {
            $message = array("Success" => true, 'Username' => $this->username, 'Message' => $this->message);
            return json_encode($message) . PHP_EOL;
        }
    }

    public function start($thread = 1)
    {
        for ($i = 1; $i <= $thread; $i++) {
            $token = self::grabToken();
            echo self::bombUser($token);
        }
    }
}
