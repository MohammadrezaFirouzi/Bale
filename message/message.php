<?php



class Message
{
    private $data;
    private $api;


    public function __construct($data, $api)
    {
        $this->data = $data;
        $this->api = $api;
    }

    public function message_id()
    {
        return $this->data['message']['message_id'];
    }

    public function from_id()
    {
        return $this->data['message']['from']['id'];
    }

    public function from_first_name()
    {
        return $this->data['message']['from']['first_name'];
    }

    public function from_last_name()
    {
        return $this->data['message']['from']['last_name'];
    }

    public function from_username()
    {
        return $this->data['message']['from']['username'];
    }

    public function chat_id()
    {
        return $this->data['message']['chat']['id'];
    }

    public function chat_type()
    {
        return $this->data['message']['chat']['type'];
    }

    public function chat_title()
    {
        return $this->data['message']['chat']['title'];
    }

    public function text()
    {
        return $this->data['message']['text'];
    }

    public function is_bot()
    {
        return $this->data['message']['from']['is_bot'] === true;
    }

    public function is_user()
    {
        return $this->data['message']['chat']['type'] === 'private';
    }

    public function is_group()
    {
        return $this->data['message']['chat']['type'] === 'group';
    }

    public function is_document()
    {
        return isset($this->data['message']['document']);
    }

    public function is_sticker()
    {
        return isset($this->data['message']['sticker']);
    }

    public function is_text()
    {
        return isset($this->data['message']['text']);
    }

    public function is_contact()
    {
        return isset($this->data['message']['contact']);
    }

    public function is_location()
    {
        return isset($this->data['message']['location']);
    }

    public function is_voice()
    {
        return isset($this->data['message']['voice']);
    }

    public function is_photo()
    {
        return isset($this->data['message']['photo']);
    }

    public function is_video()
    {
        return isset($this->data['message']['video']);
    }

    public function is_audio()
    {
        return isset($this->data['message']['audio']);
    }

    



    public function reply(string $text)
    {
        $this->api->sendMessage($this->chat_id(), $text, $this->message_id());
    }
}
