<?php


class Net
{
    private $token;
    private $bale_url;

    function __construct(string $token)
    {
        $this->token = $token;
        $this->bale_url = "https://tapi.bale.ai/bot";
    }

    public function execute(string $method, array $data = [])
    {
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($this->bale_url . $this->token . "/" . $method, false, $context);

        return json_decode($result, true);
    }

    public function executeByMultiPart(string $method, array $data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->bale_url . $this->token . "/" . $method);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
