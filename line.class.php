<?php
class Line
{
    private $token = "";
    function __construct(string $token="")
    {
        if(!$token)
          $token = Config::LINE_TOKEN_KEY;
        $this->token = $token;
    }
    public function send_notify($message)
    {
        $token = $this->token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function emoicon(string $code = '100003')
    {
        $bin = hex2bin(str_repeat('0', 8 - strlen($code)) . $code);
        return  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
    }

}

