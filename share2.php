<?php
ob_start();
define("1061791511:AAGU1YZa8_QUREfG4aL1YXb2vAGW0tC9XLo"); // Token o'rni
$admin = "831477295"; // Admin ID

function bot($method,$datas=[]){
$url = http_build_query($datas);
return json_decode(file_get_contents("https://api.telegram.org/bot".XABARCHILAR."/".$method."?".$url));
}

// @DASTURCHI_YIGIT tomonidan @XABARCHILAR kanali orqali tarqatildi.
$XABARCHILAR = json_decode(file_get_contents("php://input"));
$message = $XABARCHILAR->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$tx = $message->text;
$uid = $message->from->id;
$name = str_replace(["[","]","(",")","*","_","`"],["","","","","","",""],$message->from->first_name);

$ch = $XABARCHILAR->channel_post;
$chmid = $ch->message_id;
$chid = $ch->chat->id;
$chuser = $ch->chat->username;
$chcaption = $ch->caption;
$chvideo = $ch->video;
$chaudio = $ch->audio;
$chtext = $ch->text;
$chphoto = $ch->photo;
$chdoc = $ch->document;
$chsticker = $ch->sticker;
$chanimation = $ch->animation;

if($tx == "/start"){
bot('sendMessage',[
'chat_id'=>$cid,
'parse_mode'=>"markdown",
'text'=>"✅* Ushbu bot kanallardagi postga avtomatik kanal reklamasini joylash uchun ishlab chiqildi!
📃 Bu botni kanalingizga admin qiling va kanalingizdagi postlarga avtomatik kanalingiz nomi qo'yiladi!😊*

📡 *Kanalimiz:* [TAMOSHAQILISH](https://t.me/joinchat/AAAAAFa0bRAzUFf5dP1ZqA)
🎓 *Dasturchi:* [DASTURCHI_YIGIT](https://t.me/DASTURCHI_YIGIT)",
'disable_web_page_preview'=>true,
]);
}

if ($chdoc or $chphoto or $chaudio or $chvideo or $chsticker or $chanimation){
bot('editMessageCaption',[
 'chat_id'=>$chid,
'message_id'=>$chmid,
'caption'=>"$chcaption\n\nKANALgakirish
BIZGAQO�SHILING\n📡 @$chuser\n🆔 $chmid
EngyangiXABARlar faqarbizda
Biz bilan birga va engBirinchilardanbo�ling",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"♻ Do'stlargaulashish", "url"=>"https://t.me/share/url?url=https://telegram.me/$chuser/$chmid"]],
]
])
]);
}

if ($chtext){
bot('editmessagetext',[
 'chat_id'=>$chid,
'message_id'=>$chmid,
'text'