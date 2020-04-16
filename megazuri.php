<?php
define('API_KEY', '1293427908:AAGacQKfU-IDiBjQr-mPh6pcnNsXxNT4v4A');
$admin = "831477295"; // admin idsi
function del($nomi)
{
array_map('unlink', glob("$nomi"));
}

function put($fayl, $nima)
{
file_put_contents("$fayl", "$nima");
}

function get($fayl)
{
$get = file_get_contents("$fayl");
return $get;
}

function ty($ch)
{
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
)
{
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
'show_alert' => $showAlert,
]);
}

function bot($method, $datas = [])
{
$url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
$res = curl_exec($ch);
if (curl_error($ch)) {
var_dump(curl_error($ch));
} else {
return json_decode($res);
}
return null;
}

$update = json_decode(get('php://input'));
$botim ="MEGAgegantBOT";
$bot_id = 1293427908;
$message = $update->message;
$cid = $message->chat->id;
$uid = $message->from->id;
$cty = $message->chat->type;
$mid = $message->message_id;
$name = $message->chat->first_name;
$user = $message->from->username;
$tx = $message->text;
$sreply = $message->reply_to_message->text;
$repid = $message->reply_to_message->from->id;
$ent = $message->entities[0]->type;
mkdir("mega");
mkdir("mega/$cid");
$gruppa = file_get_contents("gruppa.db");
$lichka = file_get_contents("lichka.db");
$msend = file_get_contents("mega/$cid/mega_send");
$tipi = file_get_contents("mega/$cid/mega_turi");
$step = file_get_contents("mega/$cid/step");
$getAdmin = bot('getChatMember',[
    'chat_id'=>$cid,
    'user_id'=>$uid
]);
$status = $getAdmin->result->status;
$tekshir = (($status==="creator")or($status==="administrator"));
//end

if ($cty == 'group' || $cty == 'supergroup') {
$guruhlar = ['-1001282892978'];
if (!in_array($cid, $guruhlar)){
bot('leaveChat', [
'chat_id' => $cid
]);
}
}
if($cty =="supergroup"){
mkdir("mega");
mkdir("mega/$cid");
if(strpos($gruppa,"$cid") !==false){
}else{
file_put_contents("gruppa.db","$gruppa\n$cid");
}
}
if($cty =="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("lichka.db","$lichka\n$cid");
}
} 
///
if ($tx == "/start" or $tx == "/start@$botim") {
if ($cty == "supergroup" or $cty == "group") {
ty($cid);
bot('sendMessage', [
'chat_id' => $cid,
'text' => "Salom Men MegaBotman Nima xizmat
Meni Yashirin Buyriqlarim
/limit - Meganda qatnashuvchi kanallar nomi info va a'zosi limitlarin ornatish
/tepa - Megani tepasidagi tekstini o'rnatish
/past - Megani pastdagi tekstini o'rnatish
/html_tepa - Userli Megani tepasidagi tekstini o'rnatish
/html_past - Userli Megani pastdagi tekstini o'rnatish
/ban - Kanalni megani barsha gruhidan bloklaydi
/unban - Kanalni blokdan chiqaradi
/static - Megada qatnashayotgan kanallar
/bulimlar - Bulimli mega ushun Kotegoriya qoshish
/del - Kanalni megadan chiqaradi",
'reply_to_message_id' => $mid,
]);
} else {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "SALOM Bu bot @DASTURCHI_YIGIT tarafidan Yasalgan",
'reply_to_message_id' => $mid,
]);
}
}
////

//mega knopka
if ((strripos($tx, "/mega_knopkali")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_knopka");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
🔘Knopkali Mega
/add
@username
🇺🇿 Kanal Nomi

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end
//mega oddiy
if ((strripos($tx, "/mega_oddiy")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_oddiy");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Oddiy) 
/add
@username
🇺🇿 Kanal Nomi

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end
//mega info
if ((strripos($tx, "/mega_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_info");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli) 
/add
@username
🇺🇿Kanal Nomi
Kanal Izohi

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_5_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infous");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/mega_send", "/mega_us");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️HTML (Userli Info) 
/add
@username
🇺🇿Kanal Nomi
Kanal Izohi

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_6_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infousb");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/mega_send", "/mega_us");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️HTML *(Userli Info Bold)* 
/add
@username
🇺🇿*Kanal Nomi
Kanal Izohi*

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_7_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infousi");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/mega_send", "/mega_us");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️HTML _(Userli Info Italic)_ 
/add
@username
🇺🇿_Kanal Nomi
Kanal Izohi_

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_8_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infousc");
    file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/mega_send", "/mega_us");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️HTML` (Userli Info FS)` 
/add
@username
🇺🇿Kanal Nomi
Kanal Izohi

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_2_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infom");
   file_put_contents("mega/$cid/step", "/start_mega");
   file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli _Italic_) 
/add
@username
🇺🇿_Kanal Nomi
Kanal Izohi_

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end
//mega info
if ((strripos($tx, "/mega_3_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infob");
   file_put_contents("mega/$cid/step", "/start_mega");
   file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli *Bold*) 
/add
@username
🇺🇿*Kanal Nomi
Kanal Izohi*

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_4_infoli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_infou");
   file_put_contents("mega/$cid/step", "/start_mega");
   file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli `FS`) 
/add
@username
🇺🇿`Kanal Nomi
Kanal Izohi`

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end


//mega info
if ((strripos($tx, "/mega_bulimli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_bulimli");
     file_put_contents("mega/$cid/step", "/start_mega");
     file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli)
🔰Kotegoriyali uchun:
/add
@kanaluseri
🇺🇿Kanal nomi
Kanal izohi
bo'lim raqami
(Bo'lim raqamlari mega adminlar tomonidan belgilanadi)

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_2_bulimli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_bulimlib");
     file_put_contents("mega/$cid/step", "/start_mega");
     file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli *Bold*)
🔰Kotegoriyali uchun:
/add
@kanaluseri
🇺🇿*Kanal nomi
Kanal izohi*
bo'lim raqami
(Bo'lim raqamlari mega adminlar tomonidan belgilanadi)

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_3_bulimli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_bulimlii");
     file_put_contents("mega/$cid/step", "/start_mega");
     file_put_contents("mega/$cid/mega_send", "/mega_mark");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli _Bold_)
🔰Kotegoriyali uchun:
/add
@kanaluseri
🇺🇿_Kanal nomi
Kanal izohi_
bo'lim raqami
(Bo'lim raqamlari mega adminlar tomonidan belgilanadi)

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end

//mega info
if ((strripos($tx, "/mega_4_bulimli")!==false)and($cty!=="private")and($tekshir===true)) {
    file_put_contents("mega/$cid/mega_turi", "/mega_bulimlif");
    file_put_contents("mega/$cid/mega_send", "/mega_mark");
     file_put_contents("mega/$cid/step", "/start_mega");
    file_put_contents("mega/$cid/bulimlar", "");
    file_put_contents("mega/$cid/jonatiladigan", "");
    file_put_contents("mega/$cid/axborot", "");
    file_put_contents("mega/$cid/send", "");
    file_put_contents("mega/$cid/option", "");
    file_put_contents("mega/$cid/turi", "");
    file_put_contents("mega/$cid/mega", "");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*🌍Megaga arizalar qabul qilish boshlandi!*

*🔴Ariza Uchun Namuna:*
〽️Mark (Infoli `Bold`)
🔰Kotegoriyali uchun:
/add
@kanaluseri
🇺🇿`Kanal nomi
Kanal izohi`
bo'lim raqami
(Bo'lim raqamlari mega adminlar tomonidan belgilanadi)

*⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end
//ban
if (($step==="/start_mega")and(strripos($tx, "/ban")!==false)and($tekshir===true)and($cty!=="private")) {
$tx = explode("\n", $tx);
file_put_contents("mega/mega.ban", "$tx[1]|$tx[2]|$tx[3]|$tx[4]\n",FILE_APPEND);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"$tx[1] <b>Kanali</b>
$tx[2] <b>kuni bloklandi va</b>
$tx[3]  <b>Kunga Megadan chiqarildi</b>
<b>Sabab ⚠:</b> $tx[4]",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//end



//limit o'rnatish
if ((strripos($tx, "/limit")!==false)and($tekshir===true)and($cty!=="private")) {
$tx = explode(">", $tx);
$kanal_nomi = $tx[1];
file_put_contents("mega/$cid/kanal_nomi", $kanal_nomi);
$info = $tx[2];
file_put_contents("mega/$cid/info", $info);
$min = $tx[3];
file_put_contents("mega/$cid/min", $min);
$max = $tx[4];
file_put_contents("mega/$cid/max", $max);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"⚠️*Limit belgilandi:*
*📣Kanal nomining maksimal uzunligi* $kanal_nomi
*📣Infoning maksimal uzunligi*  $info

*Kanal a'zolari* 📥$min  *dan* 📤$max  *gacha bo'lishi kerak!*",
'parse_mode'=>'markdown',
])->result->message_id;
bot('pinChatMessage', [
'chat_id'=>$cid,
'message_id'=>$testcha 
]);
}
//bulimlar
if (($step==="/start_mega")and($tipi==="/mega_bulimli")and($tekshir===true)and(strripos($tx, "/bulimlar")!==false
)and($cty!=="private")) {
file_put_contents("mega/$cid/bulimlar", "");
 $ak = str_replace("/bulimlar\n", "", $tx);
$tx =explode("\n", $ak);
for ($i=0; $i < count($tx)-0; $i++) { 
$f = $i+1;
file_put_contents("mega/$cid/bulimlar", "$f - $tx[$i]\n",FILE_APPEND);
}
$text = file_get_contents("mega/$cid/bulimlar");
bot('sendmessage',[
'chat_id'=>$cid,
 'text'=>"🔰 Kotegoriya qo'shildi!\n$text",
'parse_mode'=>'markdown',
'disable_web_page_preview' => true
]);
}

//end
//bulimlar
if (($step==="/start_mega")and($tipi==="/mega_bulimlib")and($tekshir===true)and(strripos($tx, "/bulimlar")!==false
)and($cty!=="private")) {
file_put_contents("mega/$cid/bulimlar", "");
 $ak = str_replace("/bulimlar\n", "", $tx);
$tx =explode("\n", $ak);
for ($i=0; $i < count($tx)-0; $i++) { 
$f = $i+1;
file_put_contents("mega/$cid/bulimlar", "$f - $tx[$i]\n",FILE_APPEND);
}
$text = file_get_contents("mega/$cid/bulimlar");
bot('sendmessage',[
'chat_id'=>$cid,
 'text'=>"*🔰 Kotegoriya qo'shildi!*\n$text",
'parse_mode'=>'markdown',
'disable_web_page_preview' => true
]);
}

//end

//bulimlar
if (($step==="/start_mega")and($tipi==="/mega_bulimlii")and($tekshir===true)and(strripos($tx, "/bulimlar")!==false
)and($cty!=="private")) {
file_put_contents("mega/$cid/bulimlar", "");
 $ak = str_replace("/bulimlar\n", "", $tx);
$tx =explode("\n", $ak);
for ($i=0; $i < count($tx)-0; $i++) { 
$f = $i+1;
file_put_contents("mega/$cid/bulimlar", "$f - $tx[$i]\n",FILE_APPEND);
}
$text = file_get_contents("mega/$cid/bulimlar");
bot('sendmessage',[
'chat_id'=>$cid,
 'text'=>"_🔰 Kotegoriya qo'shildi!_\n$text",
'parse_mode'=>'markdown',
'disable_web_page_preview' => true
]);
}

//end
//bulimlar
if (($step==="/start_mega")and($tipi==="/mega_bulimlif")and($tekshir===true)and(strripos($tx, "/bulimlar")!==false
)and($cty!=="private")) {
file_put_contents("mega/$cid/bulimlar", "");
 $ak = str_replace("/bulimlar\n", "", $tx);
$tx =explode("\n", $ak);
for ($i=0; $i < count($tx)-0; $i++) { 
$f = $i+1;
file_put_contents("mega/$cid/bulimlar", "$f - $tx[$i]\n",FILE_APPEND);
}
$text = file_get_contents("mega/$cid/bulimlar");
bot('sendmessage',[
'chat_id'=>$cid,
 'text'=>"`🔰 Kotegoriya qo'shildi!`\n$text",
'parse_mode'=>'markdown',
'disable_web_page_preview' => true
]);
}

//end

// top ni o'rnatish
if ((strripos($tx, "/tepa")!==false)and($tekshir===true)and($cty!=="private")and(!empty($sreply))) {
  file_put_contents("mega/$cid/top_mega", $sreply);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*🔰Megani yuqori qismi teksti saqlandi.*\n📑Tekst ko'rinishi:\n\n$sreply\n\n*⚠️ Agarda xatolik sodir bo'lgan bo'lsa ya'ni tekstda xatolik bo'lsa qayta jo'natishingiz mumkin!*",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
}
// past qismni saqlash
if ((strripos($tx, "/past")!==false)and($tekshir===true)and($cty!=="private")and(!empty($sreply))) {
file_put_contents("mega/$cid/bottom_mega", $sreply);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*🔰Megani past qismi teksti saqlandi.*\n📑Tekst ko'rinishi:\n\n$sreply\n\n*⚠️ Agarda xatolik sodir bo'lgan bo'lsa ya'ni tekstda xatolik bo'lsa qayta jo'natishingiz mumkin!*",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
}
//end

// top ni o'rnatish
if ((strripos($tx, "/html_tepa")!==false)and($tekshir===true)and($cty!=="private")and(!empty($sreply))) {
  file_put_contents("mega/$cid/top_html", $sreply);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰Megani yuqori qismi teksti saqlandi.\n📑Tekst ko'rinishi</b>:\n\n$sreply\n\n⚠️<b> Agarda xatolik sodir bo'lgan bo'lsa ya'ni tekstda xatolik bo'lsa qayta jo'natishingiz mumkin!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
}
// past qismni saqlash
if ((strripos($tx, "/html_past")!==false)and($tekshir===true)and($cty!=="private")and(!empty($sreply))) {
file_put_contents("mega/$cid/bottom_html", $sreply);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>🔰Megani past qismi teksti saqlandi.\n📑Tekst ko'rinishi</b>:\n\n$sreply\n\n⚠️<b> Agarda xatolik sodir bo'lgan bo'lsa ya'ni tekstda xatolik bo'lsa qayta jo'natishingiz mumkin!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
}
//end
////static
if ((strripos($tx, "/static")!==false)and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>✅Megada qatnashayotgan 📡Kanallar soni:</b> <code>[$kanallar]</code>\n$qat_kan\n",
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
}
///end
//megani hisoblash
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_knopka")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_knopka") {
file_put_contents("mega/$cid/turi", "/mega_1");
del("mega/$cid/option");
$mega = file_get_contents("mega/$cid/mega");
$tx = explode("\n", $mega);
file_put_contents("mega/$cid/option", "[", FILE_APPEND);
for ($i=0; $i <= count(file("mega/$cid/mega"))-1 ; $i++) { 
$ol = explode("{!}", $tx[$i]);
$json = json_encode([['text'=>$ol[1],'url'=>$ol[3]]],JSON_PRETTY_PRINT);
file_put_contents("mega/$cid/option", $json, FILE_APPEND);
file_put_contents("mega/$cid/option", ",", FILE_APPEND);
}
  
$fh = fopen("mega/$cid/option", 'r+');
$stat = fstat($fh);
ftruncate($fh, $stat['size']-1);
fclose($fh); 
file_put_contents("mega/$cid/option", "]", FILE_APPEND);
$massiv = file_get_contents("mega/$cid/option");
$massiv = json_decode($massiv,true);
$top_mega = file_get_contents("mega/$cid/top_mega");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$top_mega,
'parse_mode'=>'markdown',
'reply_markup'=>json_encode([
'inline_keyboard'=>$massiv
]) 
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid  ,'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_info")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_info") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - ".$pot[2]." \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//sr
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infom")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infom") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - _".$pot[2]."_ \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//sr
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infob")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infob") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - *".$pot[2]."* \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//sr
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infous")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infous") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_html");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "".$pot[4]." - ".$pot[2]." \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_html");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "u</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."u", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//sr
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infousb")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infousb") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_html");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "".$pot[4]." - <b>".$pot[2]."</b> \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_html");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "u</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."u", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//sr
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infousi")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infousi") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_html");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "".$pot[4]." - <i>".$pot[2]."</i> \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_html");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "u</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."u", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end
//sr
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infousc")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infousc") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_html");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "".$pot[4]." - <code>".$pot[2]."</code> \n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_html");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "u</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."u", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//stop
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_oddiy")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_oddiy") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].")\n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end
//stop bolim
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_bulimli")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_bulimli") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$bulimlar = file_get_contents("mega/$cid/bulimlar");
$tx = explode("\n", $bulimlar);
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($i=0; $i <= count(file("mega/$cid/bulimlar"))-1; $i++) { 
file_put_contents("mega/$cid/option", "*$tx[$i]*\n",FILE_APPEND);

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
$sot = $tx[$i];
$pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
if ($sot[0]===$pot[5]) {
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - ".$pot[2]." \n\n",FILE_APPEND); 
}
}
file_put_contents("mega/$cid/option", "\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega\n\n", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//stop bolim
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_bulimlib")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_bulimlib") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$bulimlar = file_get_contents("mega/$cid/bulimlar");
$tx = explode("\n", $bulimlar);
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($i=0; $i <= count(file("mega/$cid/bulimlar"))-1; $i++) { 
file_put_contents("mega/$cid/option", "*$tx[$i]*\n",FILE_APPEND);

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
$sot = $tx[$i];
$pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
if ($sot[0]===$pot[5]) {
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - *".$pot[2]."* \n\n",FILE_APPEND); 
}
}
file_put_contents("mega/$cid/option", "\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega\n\n", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//stop bolim
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_bulimlii")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_bulimlii") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$bulimlar = file_get_contents("mega/$cid/bulimlar");
$tx = explode("\n", $bulimlar);
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($i=0; $i <= count(file("mega/$cid/bulimlar"))-1; $i++) { 
file_put_contents("mega/$cid/option", "*$tx[$i]*\n",FILE_APPEND);

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
$sot = $tx[$i];
$pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
if ($sot[0]===$pot[5]) {
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - _".$pot[2]."_ \n\n",FILE_APPEND); 
}
}
file_put_contents("mega/$cid/option", "\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega\n\n", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//stop bolim
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_bulimlif")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_bulimlif") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$bulimlar = file_get_contents("mega/$cid/bulimlar");
$tx = explode("\n", $bulimlar);
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($i=0; $i <= count(file("mega/$cid/bulimlar"))-1; $i++) { 
file_put_contents("mega/$cid/option", "*$tx[$i]*\n",FILE_APPEND);

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
$sot = $tx[$i];
$pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
if ($sot[0]===$pot[5]) {
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - `".$pot[2]."` \n\n",FILE_APPEND); 
}
}
file_put_contents("mega/$cid/option", "\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega\n\n", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end


//ef
if ((strripos($tx, "/stop_mega")!==false)and($tipi==="/mega_infou")and($tekshir===true)and($cty!=="private")) {
del("mega/$cid/jonatiladigan");
del("mega/$cid/step");
$tipi = file_get_contents("mega/$cid/mega_turi");
$mega = file_get_contents("mega/$cid/mega");
$ajrat = explode("\n", $mega);
for ($i=0; $i < count($ajrat)-1; $i++) { 
$kes = explode("{!}", $ajrat[$i]);
file_put_contents("mega/$cid/jonatiladigan", "$kes[4] [<code>$kes[0]</code>]\n", FILE_APPEND);
}
$kanallar = count(file("mega/$cid/jonatiladigan"));
$qat_kan = file_get_contents("mega/$cid/jonatiladigan");
 $testcha = bot('sendmessage',[
 'chat_id'=>$cid,
'text'=>"<b>Megada ishtirok etgan kanallar:</b> <code>$kanallar</code>\n$qat_kan\n<b>⚠️Mega uchun qabul tugadi.</b>\n<i>Mega listi birozdan so'ng tayyor bo'ladi.\nMega listi ustidan post va reklamalar joylash ta'qiqlanadi!</i>",
'parse_mode'=>'html',
])->result->message_id;
bot('pinChatMessage',[
 'chat_id'=>$cid,
'message_id'=>$testcha
    ]);
if ($tipi==="/mega_infou") {
file_put_contents("mega/$cid/turi", "/mega_3");
$mega = file_get_contents("mega/$cid/mega");
$kes = explode("\n", $mega);
$top_mega = file_get_contents("mega/$cid/top_mega");
file_put_contents("mega/$cid/option", "$top_mega\n\n");

for ($j=0; $j <= count(file("mega/$cid/mega"))-1; $j++) { 
 $pot = explode("{!}", $kes[$j]);
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
file_put_contents("mega/$cid/option", "[".$pot[1]."](".$pot[3].") - `".$pot[2]."`\n\n",FILE_APPEND);
}
$bottom_mega = file_get_contents("mega/$cid/bottom_mega");
file_put_contents("mega/$cid/option", "$bottom_mega", FILE_APPEND);
$option = file_get_contents("mega/$cid/option");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>

 🤖Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!

🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid ."i", 'text' => "Kanalga yuborish"],],
]
]),
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
//end

//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
if ((strripos($tx, "/send_mega")!==false)and($tipi==="/mega_knopka")and ($tekshir===true)and($cty!=="private")) {
file_put_contents("mega/$cid/chat", $cid);
$tip = file_get_contents("mega/$cid/turi");
$mega = file_get_contents("mega/$cid/mega");
$option = file_get_contents("mega/$cid/option");
$os = explode("\n", $mega);
if ($tip==="/mega_1") {
$son = file_get_contents("mega/$cid/son");
if ($son) {
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰Mega 📤yuborilgan❗",
]);
} else {
ty($cid);
for ($i=0; $i <= count(file("mega/$cid/mega"))-1; $i++) { 
$tx = explode("{!}", $os[$i]);
$massiv = file_get_contents("mega/$cid/option");
$massiv = json_decode($massiv,true);
$top_mega = file_get_contents("mega/$cid/top_mega");
$meg = explode("{!}", $tx[4]);
foreach ($meg as $meid) {
$olish = bot('sendmessage',[
'chat_id'=>"$meid",
'text'=>$top_mega,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>$massiv
]),
]);
$odam = bot('getChatMembersCount',[
'chat_id'=>$meid
]);
$son = $odam->result;
$sended = $olish->ok;
$olingan = $olish->result->message_id;
if ($sended) {
$mm = fopen("mega/$cid/son", "a");
fwrite($mm, "$son\n");
fclose($mm);
///
$mmy = fopen("mega/$cid/send", "a");
fwrite($mmy, "$meid\n");
fclose($mmy);
///
$ttex = "$olingan\n";
$mmyfile = fopen("mega/$cid/del", "a");
fwrite($mmyfile, $ttex);
fclose($mmyfile);
///
}else
$itex = "$meid\n";
$tmyfile = fopen("mega/$cid/no", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
}
}
$qatnash = file_get_contents("mega/$cid/send");
$noqat = file_get_contents("mega/$cid/no");
$noqat = str_replace("\n", "", $noqat);
 bot('sendmessage',[
'chat_id' => $cid,
'text'=>"<i>📨 Yuborilmoqda!</i>",
'parse_mode' => "html",
]);
sleep(1);
bot('editmessagetext',[
'chat_id'=>$cid,
'message_id'=>$mid +1,
'text' => "<b>📤YUBORILDI</b>
$qatnash
<b>❌YUBORILMADI</b>
$noqat",
'parse_mode' => "html",
]);
}
}
}
//end



//se
if ((strripos($tx, "/send_mega")!==false)and($msend==="/mega_mark")and ($tekshir===true)and($cty!=="private")) {
file_put_contents("mega/$cid/chat", $cid);
$tip = file_get_contents("mega/$cid/turi");
$mega = file_get_contents("mega/$cid/mega");
$option = file_get_contents("mega/$cid/option");
$os = explode("\n", $mega);
if ($tip==="/mega_3") {
$son = file_get_contents("mega/$cid/son");
if ($son) {
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰Mega 📤yuborilgan❗",
]);
} else {
ty($cid);
for ($i=0; $i <= count(file("mega/$cid/mega"))-1; $i++) { 
$tx = explode("{!}", $os[$i]);
$meg = explode("{!}", $tx[4]);
foreach ($meg as $meid) {
$olish = bot('sendmessage',[
'chat_id'=>"$meid",
'text'=>$option,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true
]);
$odam = bot('getChatMembersCount',[
'chat_id'=>$meid
]);
$son = $odam->result;
$sended = $olish->ok;
$olingan = $olish->result->message_id;
if ($sended) {
$mm = fopen("mega/$cid/son", "a");
fwrite($mm, "$son\n");
fclose($mm);
///
$mmy = fopen("mega/$cid/send", "a");
fwrite($mmy, "$meid\n");
fclose($mmy);
///
$ttex = "$olingan\n";
$mmyfile = fopen("mega/$cid/del", "a");
fwrite($mmyfile, $ttex);
fclose($mmyfile);
///
} else 
$itex = "$meid\n";
$tmyfile = fopen("mega/$cid/no", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
}
}
$qatnash = file_get_contents("mega/$cid/send");
$noqat = file_get_contents("mega/$cid/no");
$noqat = str_replace("\n", "", $noqat);
 bot('sendmessage',[
'chat_id' => $cid,
'text'=>"<i>📨 Yuborilmoqda!</i>",
'parse_mode' => "html",
]);
sleep(1);
bot('editmessagetext',[
'chat_id'=>$cid,
'message_id'=>$mid +1,
'text' => "<b>📤YUBORILDI</b>
$qatnash
<b>❌YUBORILMADI</b>
$noqat",
'parse_mode' => "html",
]);
}
}
}
//end


//ss
if ((strripos($tx, "/send_mega")!==false)and($msend==="/mega_us")and ($tekshir===true)and($cty!=="private")) {
file_put_contents("mega/$cid/chat", $cid);
$tip = file_get_contents("mega/$cid/turi");
$mega = file_get_contents("mega/$cid/mega");
$option = file_get_contents("mega/$cid/option");
$os = explode("\n", $mega);
if ($tip==="/mega_3") {
$son = file_get_contents("mega/$cid/son");
if ($son) {
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰Mega 📤yuborilgan❗",
]);
} else {
ty($cid);
for ($i=0; $i <= count(file("mega/$cid/mega"))-1; $i++) { 
$tx = explode("{!}", $os[$i]);
$meg = explode("{!}", $tx[4]);
foreach ($meg as $meid) {
$olish = bot('sendmessage',[
'chat_id'=>"$meid",
'text'=>$option,
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
$odam = bot('getChatMembersCount',[
'chat_id'=>$meid
]);
$son = $odam->result;
$sended = $olish->ok;
$olingan = $olish->result->message_id;
if ($sended) {
$mm = fopen("mega/$cid/son", "a");
fwrite($mm, "$son\n");
fclose($mm);
///
$mmy = fopen("mega/$cid/send", "a");
fwrite($mmy, "$meid\n");
fclose($mmy);
///
$ttex = "$olingan\n";
$mmyfile = fopen("mega/$cid/del", "a");
fwrite($mmyfile, $ttex);
fclose($mmyfile);
///
} else
$itex = "$meid\n";
$tmyfile = fopen("mega/$cid/no", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
}
}
$qatnash = file_get_contents("mega/$cid/send");
$noqat = file_get_contents("mega/$cid/no");
$noqat = str_replace("\n", "", $noqat);
 bot('sendmessage',[
'chat_id' => $cid,
'text'=>"<i>📨 Yuborilmoqda!</i>",
'parse_mode' => "html",
]);
sleep(1);
bot('editmessagetext',[
'chat_id'=>$cid,
'message_id'=>$mid +1,
'text' => "<b>📤YUBORILDI</b>
$qatnash
<b>❌YUBORILMADI</b>
$noqat",
'parse_mode' => "html",
]);
}
}
}
//end


//olib tashlash
 if (($step==="/start_mega")and(strripos($tx, "/unban")!==false)and($tekshir===true)and($cty!=="private")) {
    $tx = explode("\n", $tx);
    $path = "mega/mega.ban";
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $remove = $tx[1];
    foreach($lines as $key => $line)
        if(stristr($line, $remove)) unset($lines[$key]);
    // unlink("data/$chat_id/mega.dat");
    file_put_contents("mega/mega.ban", "");
    for ($i=0; $i <= count($lines); $i++) { 
        file_put_contents("mega/mega.ban", "$lines[$i]\n",FILE_APPEND);
    }
    $mega = file_get_contents("mega/mega.ban");
    $ket = explode("\n", $mega);
    file_put_contents("mega/mega.ban", "");
    for ($i=0; $i <= count($mega)+1; $i++) { 
        if ($ket[$i]==="") {
        
        }else{
            file_put_contents("mega/mega.ban", "$ket[$i]\n",FILE_APPEND);
        }
    }
bot('sendmessage', [
'chat_id' => $cid,
'text' => "$tx[1] <b>kanali blokdan dan chiqarildi</b>",
'parse_mode' => "html",
]);
}
//end

//olib tashlash
   if (($tx==="/del")and($step==="/start_mega")and(!empty($sreply))and($cty!=="private")and($tekshir===true)) { 
    $tx = explode("\n", $sreply);
    $path = "mega/$cid/mega";
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $remove = $tx[1];
    foreach($lines as $key => $line)
        if(stristr($line, $remove)) unset($lines[$key]);
    // unlink("data/$chat_id/mega.dat");
    file_put_contents("mega/$cid/mega", "");
    for ($i=0; $i <= count($lines); $i++) { 
        file_put_contents("mega/$cid/mega", "$lines[$i]\n",FILE_APPEND);
    }
    $mega = file_get_contents("mega/$cid/mega");
    $ket = explode("\n", $mega);
    file_put_contents("mega/$cid/mega", "");
    for ($i=0; $i <= count($mega)+1; $i++) { 
        if ($ket[$i]==="") {
        
        }else{
            file_put_contents("mega/$cid/mega", "$ket[$i]\n",FILE_APPEND);
        }
    }
bot('sendmessage', [
'chat_id' => $cid,
'text' => "$tx[1] kanali <b>megadan chiqarildi</b>",
'parse_mode' => "html",
]);
}
//end

// delete mega
if ($tx == "/off_mega@$botim"or$tx == "/off_mega") {
if ($cty == "supergroup" or $cty == "group") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$dd = file_get_contents("mega/$cid/del");
ty($cid);

$del = file_get_contents("mega/$cid/send");
$del = explode("\n", $del);
$dd = explode("\n", $dd);
$son = file_get_contents("mega/$cid/son");
$son = explode("\n", $son);
foreach ($del as $key => $chan) {
$mem = bot('getChatMembersCount', [
'chat_id' => $chan,
]);
$soni = $mem->result;
$nati = $soni - $son[$key];
$mmy = fopen("mega/$cid/nat", "a");
fwrite($mmy, "$chan [$nati]\n");
fclose($mmy);
bot('deleteMessage', [
'chat_id' => $chan,
'message_id' => $dd[$key],
]);
}
$na = file_get_contents("mega/$cid/nat");

$na = substr($na, 0, -5);
$ms =  bot('sendmessage',[
'chat_id' => $cid,
'text'=>"<i>🗑 O'chirilmoqda!</i>",
'parse_mode' => "html",
]);
sleep(1);
bot('editmessagetext',[
'chat_id'=>$cid,
'message_id'=>$mid +1,
'text' => "<b>📊 Mega natijalari:</b>
$na",
'parse_mode' => "html",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
if ($get == "administrator" or $get == "creator") {
del("mega/$cid/nat");
del("mega/$cid/send");
del("mega/$cid/no");
del("mega/$cid/del");
del("mega/$cid/txt");
del("mega/$cid/son");
del("mega/$cid/step");
del("mega/$cid/bulimlar");
del("mega/$cid/jonatiladigan");
del("mega/$cid/axborot");
del("mega/$cid/send");
del("mega/$cid/option");
del("mega/$cid/turi");
del("mega/$cid/mega");
del("mega/$cid/chat");
del("mega/$cid/mega_turi");
del("mega/$cid/mega_send");
}
}
}
// end


//cancel
if ((strripos($tx, "/cancel_mega")!==false)and($cty!=="private")and($tekshir===true)) {
del("mega/$cid/step");
del("mega/$cid/bulimlar");
del("mega/$cid/jonatiladigan");
del("mega/$cid/axborot");
del("mega/$cid/send");
del("mega/$cid/option");
del("mega/$cid/turi");
del("mega/$cid/mega");
del("mega/$cid/chat");
del("mega/$cid/mega_turi");
    $testcha = bot('sendmessage',[
        'chat_id'=>$cid,
'text' => "<b>🚫Mega bekor qilindi️❗️</b>
",
'parse_mode' => "html",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
//end

$sreply = $message->reply_to_message->text;
$rpl = json_encode([
           'resize_keyboard'=>false,
            'force_reply' => true,
            'selective' => true
        ]);
if($tx=="/send" and $cid==$admin){
    bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"*📨 Yuboriladigan xabar matnini kiriting. Xabar turi markdown*",'parse_mode'=>"markdown",'reply_markup'=>$rpl
]);
}
    if($sreply=="📨 Yuboriladigan xabar matnini kiriting. Xabar turi markdown"){
        $lich = file_get_contents("lichka.db");
        $lichka = explode("\n",$lich);
foreach($lichka as $id){
    bot("sendmessage",[
        'chat_id'=>$id,
        'text'=>"$tx"]);
}
}
//sendgroup

     if($tx == "/sendgroup" and $cid == $admin){
    bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"*📨 Yuboriladigan xabar matnini kiriting. Xabar turi markdown*",'parse_mode'=>"markdown",'reply_markup'=>$rpl
]);
}
    if($sreply=="📨 Yuboriladigan xabar matnini kiriting. Xabar turi markdown"){
        $gr = file_get_contents("gruppa.db");
        $gruppa= explode("\n",$gr);
foreach($gruppa as $cid){
    bot("sendmessage",[
        'chat_id'=>$cid,
      'text'=>$tx,
      'parse_mode'=>'markdown',
      'disable_web_page_preview' => true,
      ]);
      }
         if($gr){
          bot('sendmessage',[
          'chat_id'=>$admin,
          'text'=>"*Guruhlarga yuborildi!*",
          'parse_mode'=>'markdown',
          ]);      
        }
      }


//

//inline
if (isset($update->inline_query)) {
$userID = $update->inline_query->from->id;
$theQuery = $update->inline_query->query;
$cid = $update->inline_query->query;
if (mb_stripos($cid, "i") !== false) {
$cid = str_replace("i", "", $cid);
$cont = file_get_contents("mega/$cid/option");
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'cache_time' => 1,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(1),
'title' => "Megani Yuborish",
'input_message_content' => [
'disable_web_page_preview' => true,
'parse_mode' => 'markdown',
'message_text' => "$cont"],
]])
]);
}
if (mb_stripos($cid, "u") !== false) {
$cid = str_replace("u", "", $cid);
$cont = file_get_contents("mega/$cid/option");
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'cache_time' => 1,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(1),
'title' => "Megani Yuborish",
'input_message_content' => [
'disable_web_page_preview' => true,
'parse_mode' => 'html',
'message_text' => "$cont"],
]])
]);
}
else{
for ($i=0; $i <= count(file("mega/$cid/mega"))-1; $i++) { 
$tx = explode("{!}", $os[$i]);
$massiv = file_get_contents("mega/$cid/option");
$massiv = json_decode($massiv,true);
$top_mega = file_get_contents("mega/$cid/top_mega");
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'cache_time' => 1,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(1),
'title' => "Megani Yuborish",
'input_message_content' => [
'disable_web_page_preview' => true,
'parse_mode' => 'markdown',
'message_text' => $top_mega],
'reply_markup' => [
'inline_keyboard' => $massiv
],
]])
]);
}
}
}
//end
// qabul
if (($step==="/start_mega")and(strripos($tx, "/add")!==false)and($cty!=="private")) {
$tx = explode("\n", $tx);
$tk = $gett->result->status;
$tk1 = $gett->result;
$tk2 = (($tk1->can_post_messages===true)and($tk1->can_edit_messages===true)and($tk1->can_delete_messages===true));
if (($tk2===true)) {
}else{
$adm = bot('getChatAdministrators', [
'chat_id' => $tx[1],
]);
$adok = $adm->ok;
if ($adok) {
$gett = bot('getChatMember', [
'chat_id' => $tx[1],
'user_id' => $uid,
]);
$tk = $gett->result->status;
if ($adok) {
$kanal_nomi = file_get_contents("mega/$cid/kanal_nomi");
$info = file_get_contents("mega/$cid/info");
$min = file_get_contents("mega/$cid/min");
$max = file_get_contents("mega/$cid/max");
$mem = bot('getChatMembersCount', [
'chat_id' => $tx[1],
]);
// if ($tekshir1===true) {
$son = $mem->result;
if ($son >= $min and $max >= $son) {
if (($kanal_nomi<strlen($tx[2]))and($info<strlen($tx[3]))) {
 bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"‼️ Hurmatli $tx[1] <b>admini!\nYuborayotgan na'munangizda belgilangan
me'yordan ortiq belgi </b>(<i> probel, harf</i> ) <b>lar mavjud😔!\n\n🙏Iltimos xatolarni
to'g'irlab qayta na'muna ga qarab yuboring!</b>",
 'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
}else{
$getInvite = bot('exportChatInviteLink',[
'chat_id'=>trim($tx[1])
]);
$addInvite = $getInvite->result;
$ban = "$user|$kuni|$kun|$sab\n";
$bann = file_get_contents("mega/mega.ban");
if (strripos($bann, $tx[1])!==false) {
 bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"‼️ Hurmatli $tx[1] <b>admini!. Sizni Kanalingiz Bloklangan</b>",
 'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
}else{
$getInvite = bot('exportChatInviteLink',[
'chat_id'=>trim($tx[1])
]);
$addInvite = $getInvite->result;
//odam soni|Kanal nomi|Kanal izohi|invite link|@user|bo'lim raqami
$fel = trim($tx[1]);
$ser = str_replace("@", "", $fel);
$qosh = "$son{!}$tx[2]{!}$tx[3]{!}https://t.me/$ser{!}$tx[1]{!}$tx[4]\n";
$mega = file_get_contents("mega/$cid/mega");
if (strripos($mega, $tx[1])!==false) {
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>" $tx[1]  ⚠️ <b>megada mavjud!\nFaqat bir marotaba qo'shish tavsiya etiladi. Agarda o'zgartirmoqchi bo'lsangiz adminlarga murojaat qiling!</b>",
'reply_to_message_id'=>$mid,
'parse_mode'=>'html',
'disable_web_page_preview'=>true
 ]);
}else{
bot('sendmessage',[
  'chat_id'=>$cid,
'text'=>"Qo'shildi! $tx[1] kanal a'zolari soni [$son]",
'reply_to_message_id'=>$mid,
]);
file_put_contents("mega/$cid/mega", $qosh, FILE_APPEND);
}
}
}
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☝️ *Hurmatli admin!*_ Kanalingiz foydalanuvchilari soni_: $son *Bizda esa odam soni eng ko'pi📤* $max *eng kami📥* $min *bo'lishi kerak*
*Iltimos qoidaga amal qiling!*
❗️*Agar azolar soni togri bosa demak adminlar* /limit *ornatishni unutgan*. *Iltimos adminlar limitni ornatishni unutmang*.
*Limit ornatish uchun namuna*:/limit_>kanal nomining uzunligi maximum ni yozing>kanal infosining uzunligi maximum ni yozing>kanal azolar soni minimum ni yozing>kanal azolar soni maximum ni yozing_.
*Misol*:/limit>5>10>15>20",
'parse_mode'=>'markdown',
'reply_to_message_id'=>$mid,
'disable_web_page_preview'=>true
]);
}
}
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"<b>☝Hurmatli</b>  $tx[1]  <b>kanali admini❗️\nMeni kanalingizga admin qilib, barcha imkoniyatlarga ruxsat bermaguningizgacha megaga qo'shila olmaysiz!\nIltimos, xatoni to'g'irlab, qayta na'munadagidek qilib yuboring!</b>\n\n@MEGAgegantBOT <i>>Copy> Kanal> administrators> add administrator> search> paste></i> ✅> <b>va barcha imkoniyatlarni ✅ qilishingiz lozim!</b>",
'parse_mode'=>'html',
'disable_web_page_preview'=>true
]);
}
}
}
?>
