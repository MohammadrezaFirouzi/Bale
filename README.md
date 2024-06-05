<p align="center">
<a href='https://web.rubika.ir' target="_blank">
<img src='https://mymember.shop/storage/files/6670831e-3ae0-4a9b-9767-5b3e536d2682.webp'></img></a></p>
<br />
</p>

<div align='center'>
    <br>
    •
    <a href='https://rubika.ir/pyrubi_documents'>Documents</a>
    
</div>
# کتابخانه پیامرسان بله PHP 😅
<br/>



## شروع استفاده از کتابخونه 🎊 :
```php
<?php 
require_once('./bale/bale.php');

$bot = new BaleBot("BOT TOKEN");

$bot->sendMessage("CHAT_ID","سلام من ربات php هستم");

```

<br>

## دریافت آپدیت ها :
```php
<?php 
require_once('./bale/bale.php');

$bot = new BaleBot("BOT TOKEN");

$bot->onUpdate(function (Message $message) {
  $message->reply("سلام من ربات php هستم");
});
```


## استفاده از متد های کلاس Message:
```php
<?php 
require_once('./bale/bale.php');

$bot = new BaleBot("BOT TOKEN");
$bot->onUpdate(function (Message $message) use ($bot) {

  if ($message->is_group()) {
    // دریافت پیام های گروه
  } elseif ($message->is_user()) {
    // دریافت پیام های کاربر
  }
});
?>

```
##  لیست متد های کلاس مسیج :
- message_id : شناسه منحصر به فرد پیام
- from_id : شناسه منحصر به فرد ارسال کننده
- from_first_name : نام ارسال کننده
- from_last_name : نام خانوادگی ارسال کننده
- from_username : نام کاربری ارسال کننده
- chat_id : شناسه محل ارسال
- chat_type : نوع محل ارسال پیام | کانال | کاربر
- text : پیام متنی
- is_bot : ارسال کننده ربات هست یا خیر
- is_user : ارسال کننده کاربر هست یا خیر 
- is_group : پیام دریافت شده از گروه هست یا خیر
- is_document : پیام دریافت شده داکیومنت هست یا خیر
- is_sticker : پیام دریافت شده استیکر هست یا خیر
- is_text : پیام دریافت شده متن هست یا خیر
- is_contact : پیام دریافت شده مخاطب هست یا خیر
- is_location : پیام دریافت شده لوکیشن هست یا خیر
- is_voice : پیام دریافت شده پیام صوتی هست یا خیر
- is_photo : پیام دریافتی عکس هست یا خیر
- is_video : پیام دریافتی ویدیو هست یا خیر
- is_audio : پیام دریافت شده موسیقی هست یا خیر
- reply : پاسخ به پیام دریافت شده

## لیست متد های کلاس بله :

- onUpdate
- sendMessage
- forwardMessage
- copyMessage
- sendPhoto
- sendAudio
- sendDocument
- sendVideo
- sendVoice
- sendLocation
- sendContact
- banChatMember
- unbanChatMember
- promoteChatMember
- getFile
- leaveChat
- getChat
- getChatMemberCount
- editMessageText
- deleteMessage




