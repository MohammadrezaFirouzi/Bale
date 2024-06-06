<?php


require_once('./network/network.php');
require_once('./message/message.php');


class BaleBot
{
    private $token;
    private $http;
    private $offset;

    function __construct(string $token)
    {
        $this->token = $token;
        $this->http = new Net($this->token);
        $this->offset = -1;
    }


    public function onUpdate(callable $callable)
    {

        while (!file_exists("KILL")) {
            $updats = $this->http->execute("getUpdates", ['offset' => $this->offset]);
            if (!empty($updats['result'])) {
                $this->offset = $updats['result'][0]['update_id'] + 1;
                $callable(new Message($updats['result'][0], $this));
            }
        }
    }


    public function sendMessage($chatid, $text, $reply_to_message_id = null)
    {
        return $this->http->execute("sendMessage", ["chat_id" => $chatid, "text" => $text, "reply_to_message_id" => $reply_to_message_id]);
    }

    public function forwardMessage($chatid, $from_chat_id, $message_id)
    {
        return $this->http->execute("forwardMessage", ["chat_id" => $chatid, "from_chat_id" => $from_chat_id, "message_id" => $message_id]);
    }


    public function copyMessage($chatid, $from_chat_id, $message_id)
    {
        return $this->http->execute("copyMessage", ["chat_id" => $chatid, "from_chat_id" => $from_chat_id, "message_id" => $message_id]);
    }

    public function sendPhoto($chatid, $photo, $caption = null, $reply_to_message_id = null)
    {
        if (file_exists($photo)) {
            return $this->http->executeByMultiPart("sendPhoto", ["chat_id" => $chatid, "photo" => new CURLFile($photo), "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        } else {
            return $this->http->execute("sendPhoto", ["chat_id" => $chatid, "photo" => $photo, "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        }
    }


    public function sendAudio($chatid, $audio, $caption = null, $reply_to_message_id = null)
    {
        if (file_exists($audio)) {
            return $this->http->executeByMultiPart("sendAudio", ["chat_id" => $chatid, "audio" => new CURLFile($audio), "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        } else {
            return $this->http->execute("sendAudio", ["chat_id" => $chatid, "audio" => $audio, "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        }
    }

    public function sendDocument($chatid, $document, $caption = null, $reply_to_message_id = null)
    {
        if (file_exists($document)) {
            return $this->http->executeByMultiPart("sendDocument", ["chat_id" => $chatid, "document" => new CURLFile($document), "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        } else {
            return $this->http->execute("sendDocument", ["chat_id" => $chatid, "document" => $document, "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        }
    }

    public function sendVideo($chatid, $video, $caption = null, $reply_to_message_id = null)
    {
        if (file_exists($video)) {
            return $this->http->execute("sendVideo", ["chat_id" => $chatid, "video" => new CURLFile($video), "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        } else {
            return $this->http->execute("sendVideo", ["chat_id" => $chatid, "video" => $video, "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        }
    }

    public function sendVoice($chatid, $voice, $caption = null, $reply_to_message_id = null)
    {
        if (file_exists($voice)) {
            return $this->http->executeByMultiPart("sendVoice", ["chat_id" => $chatid, "voice" => new CURLFile($voice), "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        } else {
            return $this->http->execute("sendVoice", ["chat_id" => $chatid, "voice" => $voice, "caption" => $caption, "reply_to_message_id" => $reply_to_message_id]);
        }
    }

    public function sendLocation($chatid, $latitude, $longitude, $horizontal_accuracy, $reply_to_message_id = null)
    {
        /*
        latitude : عرض جغرافیایی موقعیت مکانی
        longitude : طول جغرافیایی موقعیت مکانی
        horizontal_accuracy : شعاع عدم قطعیت برای یک نقطه مکانی، با واحد متر اندازه‌گیری می‌شود و عددی بین ۰ تا ۱۵۰۰ است.
       */
        return $this->http->execute("sendLocation", ["chat_id" => $chatid, "latitude" => $latitude, "longitude" => $longitude, "horizontal_accuracy" => $horizontal_accuracy, "reply_to_message_id" => $reply_to_message_id]);
    }

    public function sendContact($chatid, $phone_number, $first_name, $last_name, $reply_to_message_id = null)
    {
        return $this->http->execute("sendContact", ["chat_id" => $chatid, "phone_number" => $phone_number, "first_name" => $first_name, "last_name" => $last_name, "reply_to_message_id" => $reply_to_message_id]);
    }

    public function banChatMember($chatid, $user_id, $caption = null, $reply_to_message_id = null)
    {
        return $this->http->execute("banChatMember", ["chat_id" => $chatid, "user_id" => $user_id]);
    }

    public function unbanChatMember($chatid, $user_id, $only_if_banned)
    {
        return $this->http->execute("unbanChatMember", ["chat_id" => $chatid, "user_id" => $user_id, "only_if_banned" => $only_if_banned]);
    }

    public function promoteChatMember($chatid, $user_id)
    {
        return $this->http->execute("promoteChatMember", ["chat_id" => $chatid, "user_id" => $user_id]);
    }

    public function getFile(string $file_id)
    {
        return $this->http->execute("getFile", ["file_id" => $file_id]);
    }

    public function leaveChat($chat_id)
    {
        return $this->http->execute("leaveChat", ["chat_id" => $chat_id]);
    }

    public function getChat($chat_id)
    {
        return $this->http->execute("getChat", ["chat_id" => $chat_id]);
    }

    public function getChatMemberCount($chat_id)
    {
        return $this->http->execute("getChatMemberCount", ["chat_id" => $chat_id]);
    }

    public function editMessageText($chat_id, $message_id, $text)
    {
        return $this->http->execute("editMessageText", ["chat_id" => $chat_id, "message_id" => $message_id, "text" => $text]);
    }

    public function deleteMessage($chat_id, $message_id)
    {
        return $this->http->execute("deleteMessage", ["chat_id" => $chat_id, "message_id" => $message_id]);
    }
}
