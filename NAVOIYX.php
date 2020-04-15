<?php
define('API_KEY','997016139:AAHjSC7rlMnB5huRK82QKqm_zFG0I90WWp8');
$admin = "831477295"; // admin idsi
$adminuser = "PHPUSTASI"; // admin user
$rasm = "Сотиладиган буюм расмини юборинг!
reklama qoyiladigan kanallar👇
@XABARCHILAR va  @NAVOIY_SAMARQAND_bozor
ILTIMOS shulaga a'zo bo‘ling sabab siz bergan REKLAMA shu kanallarda qo‘yiladi "; // rasm yuborishi sorash txtsi
function del($nomi){
array_map('unlink', glob("step/$nomi.*"));
}
function put($fayl, $nima){
file_put_contents("$fayl", "$nima");
}
function pstep($cid,$zn){
file_put_contents("step/$cid.step",$zn);
}
function step($cid){
$step = file_get_contents("step/$cid.step");
$step += 1;
file_put_contents("step/$cid.step",$step);
}
function nextTx($cid,$txt){
$step = file_get_contents("step/$cid.txt");
file_put_contents("step/$cid.txt","$step\n\n$txt");
}
function ty($ch){
return bot('sendChatAction', [
'chat_id' => $ch,
'action' => 'typing',
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

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$cidtyp = $message->chat->type;
$miid = $message->message_id;
$name = $message->chat->first_name;
$user = $message->from->username;
$tx = $message->text;
$callback = $update->callback_query;
$mmid = $callback->inline_message_id;
$mes = $callback->message;
$mid = $mes->message_id;
$cmtx = $mes->text;
$mmid = $callback->inline_message_id;
$idd = $callback->message->chat->id;
$cbid = $callback->from->id;
$cbuser = $callback->from->username;
$data = $callback->data;
$ida = $callback->id;
$cqid = $update->callback_query->id;
$cbins = $callback->chat_instance;
$cbchtyp = $callback->message->chat->type;
$step = file_get_contents("step/$cid.step");
$menu = file_get_contents("step/$cid.menu");
$stepe = file_get_contents("step/$cbid.step");
$menue = file_get_contents("step/$cbid.menu");
mkdir("step");

$otex = "❌ Бекор килиш";

$keys = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🏢 Уй"],['text'=>"🏠 Ҳовли"],],
[['text'=>"🚙 Машина"],['text'=>"📱Телефон"],],
[['text'=>"📢 Бошка эълон"],['text'=>"Админ билан богланиш"],],
]
]);

$otmen = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$otex"],],
]
]);

$manzil = json_encode(
['inline_keyboard' => [
[['callback_data' => "XATIRCHI", 'text' => "XATIRCHI"],['callback_data' => "NUROTA", 'text' => "NUROTA"],],
[['callback_data' => "KARMANA", 'text' => "KARMANA"],['callback_data' => "QIZILTEPA", 'text' => "QIZILTEPA"],],
[['callback_data' => "TOMDI", 'text' => "TOMDI"],['callback_data' => "UCHQUDUQ", 'text' => "UCHQUDUQ"],],
[['callback_data' => "KATTAQO’RG’ON", 'text' => "KATTAQO’RG’ON"],['callback_data' => "OQTOSH", 'text' => "OQTOSH"],],
[['callback_data' => "NAVOIY.SH", 'text' => "NAVOIY.SH"],['callback_data' => "KONIMEX", 'text' => "KONIMEX"],],
[['callback_data' => "ISHTIXON", 'text' => "ISHTIXON"],['callback_data' => "NAVBAHOR", 'text' => "NAVBAHOR"],],
[['callback_data' => "🏰MANZILNI🏯Aytmadilar🤐🤫", 'text' => "🙅‍♂MANZILni😎Aytmaslik😉"],],
]
]);

$tasdiq = json_encode(
['inline_keyboard' => [
[['callback_data' => "ok", 'text' => "Xa✅"],['callback_data' => "clear", 'text' => "Йук❌"],],
]
]);

if(isset($tx)){
ty($cid);
}

if($tx == "Админ билан богланиш"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"👇 Админ билан богланиш учун кнопкани босинг",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['url' => "telegram.me/$adminuser", 'text' => "Админ"],],
]
]),
]);
}

if($tx == "/start"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"Нима сотмокчисиз булимни танланг👇🏻",
'reply_markup'=>$keys,
]);
}

// uy uchun
if($tx == "🏢 Уй"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Сарлавҳа киритинг:*
 _(масалан, 2 хонали уй сотилади)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
pstep($cid,"0");
put("step/$cid.menu","uy");
}

if($step == "0" and $menu == "uy"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Элон учун қисқа изоҳ қолдиринг:*
_(масалан, Евро ремонт, ҳамма шароитлар бор, 3-этажда) _",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "📢 ".$tx);
step($cid);
}
}

if($step == "1" and $menu == "uy"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Нархни киритинг:*
_(масалан 35 000 000 ёки 15 000$)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "✅ ".$tx);
step($cid);
}
}

if($step == "2" and $menu == "uy"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
nextTx($cid, "💰 ".$tx);
step($cid);
}
}

$photo_id = $message->photo[1]->file_id;
if(isset($photo_id) and $step == "3" and $menu == "uy"){
put("step/$cid.photo","$photo_id");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891234567 kabi shuklda)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
step($cid);
}

if($step == "3" and $menu == "uy" and isset($tx)){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
}
}

if($step == "4" and $menu == "uy"){
if($tx == $otex){}else{
if(mb_stripos($tx,"+9989")!==false){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Манзилни танланг👇*",
'parse_mode'=>'markdown',
'reply_markup'=>$manzil,
]);
nextTx($cid, "📞 ".$tx);
step($cid);
}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
}
}
}

if(isset($data) and $stepe == "5" and $menue == "uy"){
ACL($ida);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"<b>Энди эълонни тасдиқланг:</b>$baza

📡 $data

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅
",
'parse_mode'=>'html',
'reply_markup'=>$tasdiq,
]);
nextTx($cbid, "📡 ".$data);
step($cbid);
}

if($data == "ok" and $stepe == "6" and $menue == "uy"){
ACL($ida);
$photo = file_get_contents("step/$cbid.photo");
bot('sendPhoto',[
'chat_id'=>$admin,
'photo'=>$photo,
'caption'=>"Id: $cbid
Username: @$cbuser",
]);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅Yangi E'LON KELDI✅:</b>
Id: $cbid
Username: @$cbuser
<a href='tg://user?id=$cbid'>🤕ZAXIRAVIY👨‍💻PROFILga💡KIRISH</a><code>$baza

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅</code>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"✅ Сизнинг эълонингиз Админлариимиз томонидан кўриб чиқилади ва сизга мурожаат қилишади!",
'parse_mode'=>'html',
'reply_markup'=>$keys,
]);
del($cbid);
}
// uy uchun e'lon tugadi

// xovli uchun
if($tx == "🏠 Ҳовли"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*🏠 Сарлавҳа киритинг:*
_(масалан, 2 хонали уй ҳовли, Ер, дача, котеж)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
pstep($cid,"0");
put("step/$cid.menu","xovli");
}

if($step == "0" and $menu == "xovli"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Ер майдонини киритинг:*
_(16 сотих)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "🏠 ".$tx);
step($cid);
}
}

if($step == "1" and $menu == "xovli"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Қисқа маълумот*
_(Ҳолати яхши, Ҳужжат бор ...)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "📐 ".$tx);
step($cid);
}
}

if($step == "2" and $menu == "xovli"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*💰Нархни киритинг:*
_(масалан 35 000 000 ёки 15 000$)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "✅ ".$tx);
step($cid);
}
}

if($step == "3" and $menu == "xovli"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
nextTx($cid, "💰 ".$tx);
step($cid);
}
}

if($step == "4" and $menu == "xovli" and isset($tx)){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
}
}

$photo_id = $message->photo[1]->file_id;
if(isset($photo_id) and $step == "4" and $menu == "xovli"){
put("step/$cid.photo","$photo_id");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
step($cid);
}

if($step == "5" and $menu == "xovli"){
if($tx == $otex){}else{
if(mb_stripos($tx,"+9989")!==false){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Манзилни танланг👇*",
'parse_mode'=>'markdown',
'reply_markup'=>$manzil,
]);
nextTx($cid, "📞 ".$tx);
step($cid);
}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
}
}
}

if(isset($data) and $stepe == "6" and $menue == "xovli"){
ACL($ida);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"<b>Энди эълонни тасдиқланг:</b>$baza

📡 $data

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅
",
'parse_mode'=>'html',
'reply_markup'=>$tasdiq,
]);
nextTx($cbid, "📡 ".$data);
step($cbid);
}

if($data == "ok" and $stepe == "7" and $menue == "xovli"){
ACL($ida);
$photo = file_get_contents("step/$cbid.photo");
bot('sendPhoto',[
'chat_id'=>$admin,
'photo'=>$photo,
'caption'=>"Id: $cbid
Username: @$cbuser",
]);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅Yangi E'LON KELDI✅:</b>
Id: $cbid
Username: @$cbuser
<a href='tg://user?id=$cbid'>🤕ZAXIRAVIY👨‍💻PROFILga💡KIRISH</a><code>$baza

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅</code>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"✅ Сизнинг эълонингиз Админлариимиз томонидан кўриб чиқилади ва сизга мурожаат қилишади!",
'parse_mode'=>'html',
'reply_markup'=>$keys,
]);
del($cbid);
}
// xovli uchun e'lon tugadi


// telefon uchun
if($tx == "📱Телефон"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*📱 Телефон номи:*
_(Samsung Galaxy J1)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
pstep($cid,"0");
put("step/$cid.menu","tel");
}

if($step == "0" and $menu == "tel"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Қисқа маълумот*
_(Ҳолати яхши, Экран синган, Ҳужжат бор ...)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "📱 ".$tx);
step($cid);
}
}

if($step == "1" and $menu == "tel"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*💰Нархни киритинг:*
_(масалан 35 000 000 ёки 15 000$)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "⚙ ".$tx);
step($cid);
}
}

if($step == "2" and $menu == "tel"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
nextTx($cid, "💰 ".$tx);
step($cid);
}
}

if($step == "3" and $menu == "tel" and isset($tx)){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
}
}

$photo_id = $message->photo[1]->file_id;
if(isset($photo_id) and $step == "3" and $menu == "tel"){
put("step/$cid.photo","$photo_id");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
step($cid);
}

if($step == "4" and $menu == "tel"){
if($tx == $otex){}else{
if(mb_stripos($tx,"+9989")!==false){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Манзилни танланг👇*",
'parse_mode'=>'markdown',
'reply_markup'=>$manzil,
]);
nextTx($cid, "📞 ".$tx);
step($cid);
}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
}
}
}

if(isset($data) and $stepe == "5" and $menue == "tel"){
ACL($ida);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"<b>Энди эълонни тасдиқланг:</b>$baza

📡 $data

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅
",
'parse_mode'=>'html',
'reply_markup'=>$tasdiq,
]);
nextTx($cbid, "📡 ".$data);
step($cbid);
}

if($data == "ok" and $stepe == "6" and $menue == "tel"){
ACL($ida);
$photo = file_get_contents("step/$cbid.photo");
bot('sendPhoto',[
'chat_id'=>$admin,
'photo'=>$photo,
'caption'=>"Id: $cbid
Username: @$cbuser",
]);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅Yangi E'LON KELDI✅:</b>
Id: $cbid
Username: @$cbuser
<a href='tg://user?id=$cbid'>🤕ZAXIRAVIY👨‍💻PROFILga💡KIRISH</a><code>$baza

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅</code>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"✅ Сизнинг эълонингиз Админлариимиз томонидан кўриб чиқилади ва сизга мурожаат қилишади!",
'parse_mode'=>'html',
'reply_markup'=>$keys,
]);
del($cbid);
}
// telefon uchun e'lon tugadi


// moshina uchun
if($tx == "🚙 Машина"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*🚙 Машина номини ва йилини киритинг:*
_(намуна: Спарк 2017йил)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
pstep($cid,"0");
put("step/$cid.menu","moshina");
}

if($step == "0" and $menu == "moshina"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👣 Машина босиб ўтган масофани киритинг:*
_(намуна 5 000км)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "🚙 ".$tx);
step($cid);
}
}

if($step == "1" and $menu == "moshina"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*⚙️ Машина ҳақида қисқача изоҳ қолдиринг:*
_(намуна: чап крела краска бўлган, балони янги)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "👣 ".$tx);
step($cid);
}
}

if($step == "2" and $menu == "moshina"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*⛽️ Ёқилғи:*
_( Бензин, Пропан, Метан)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "⚙ ".$tx);
step($cid);
}
}

if($step == "3" and $menu == "moshina"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*💰Нархни киритинг :*
_ (масалан 35 000 000 ёки 15 000$)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "⛽️ ".$tx);
step($cid);
}
}

if($step == "4" and $menu == "moshina"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
nextTx($cid, "💰 ".$tx);
step($cid);
}
}

if($step == "5" and $menu == "moshina" and isset($tx)){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
}
}

$photo_id = $message->photo[1]->file_id;
if(isset($photo_id) and $step == "5" and $menu == "moshina"){
put("step/$cid.photo","$photo_id");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
step($cid);
}

if($step == "6" and $menu == "moshina"){
if($tx == $otex){}else{
if(mb_stripos($tx,"+9989")!==false){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Манзилни танланг👇*",
'parse_mode'=>'markdown',
'reply_markup'=>$manzil,
]);
nextTx($cid, "📞 ".$tx);
step($cid);
}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
}
}
}

if(isset($data) and $stepe == "7" and $menue == "moshina"){
ACL($ida);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"<b>Энди эълонни тасдиқланг:</b>$baza

📡 $data

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅
",
'parse_mode'=>'html',
'reply_markup'=>$tasdiq,
]);
nextTx($cbid, "📡 ".$data);
step($cbid);
}

if($data == "ok" and $stepe == "8" and $menue == "moshina"){
ACL($ida);
$photo = file_get_contents("step/$cbid.photo");
bot('sendPhoto',[
'chat_id'=>$admin,
'photo'=>$photo,
'caption'=>"Id: $cbid
Username: @$cbuser",
]);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅Yangi E'LON KELDI✅:</b>
Id: $cbid
Username: @$cbuser
<a href='tg://user?id=$cbid'>🤕ZAXIRAVIY👨‍💻PROFILga💡KIRISH</a><code>$baza

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅</code>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"✅ Сизнинг эълонингиз Админлариимиз томонидан кўриб чиқилади ва сизга мурожаат қилишади!",
'parse_mode'=>'html',
'reply_markup'=>$keys,
]);
del($cbid);
}
// moshina uchun e'lon tugadi

// boshqa e'lon
if($tx == "📢 Бошка эълон"){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*📢 Сарлавҳа киритинг:*
_(Холоделник Samsung сотилади)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
pstep($cid,"0");
put("step/$cid.menu","boshqa");
}

if($step == "0" and $menu == "boshqa"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*✅ Эълон учун қисқа изоҳ қолдиринг:*
_(масалан, Ҳолати яхши, Корпус синган)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "📢 ".$tx);
step($cid);
}
}

if($step == "1" and $menu == "boshqa"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*💰Нархни киритинг:*
_(масалан 35 000 000 ёки 15 000$)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
nextTx($cid, "✅ ".$tx);
step($cid);
}
}

if($step == "2" and $menu == "boshqa"){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
nextTx($cid, "💰 ".$tx);
step($cid);
}
}

if($step == "3" and $menu == "boshqa" and isset($tx)){
if($tx == $otex){}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>$rasm,
]);
}
}

$photo_id = $message->photo[1]->file_id;
if(isset($photo_id) and $step == "3" and $menu == "boshqa"){
put("step/$cid.photo","$photo_id");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
step($cid);
}

if($step == "4" and $menu == "boshqa"){
if($tx == $otex){}else{
if(mb_stripos($tx,"+9989")!==false){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Манзилни танланг👇*",
'parse_mode'=>'markdown',
'reply_markup'=>$manzil,
]);
nextTx($cid, "📞 ".$tx);
step($cid);
}else{
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*☝️ Телефон номерни киритинг:*
_(+99891 2345678 шаклда)_",
'parse_mode'=>'markdown',
'reply_markup'=>$otmen,
]);
}
}
}

if(isset($data) and $stepe == "5" and $menue == "boshqa"){
ACL($ida);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"<b>Энди эълонни тасдиқланг:</b>$baza

📡 $data

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅
",
'parse_mode'=>'html',
'reply_markup'=>$tasdiq,
]);
nextTx($cbid, "📡 ".$data);
step($cbid);
}

if($data == "ok" and $stepe == "6" and $menue == "boshqa"){
ACL($ida);
$photo = file_get_contents("step/$cbid.photo");
bot('sendPhoto',[
'chat_id'=>$admin,
'photo'=>$photo,
'caption'=>"Id: $cbid
Username: @$cbuser",
]);
$baza = file_get_contents("step/$cbid.txt");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>✅Yangi E'LON KELDI✅:</b>
Id: $cbid
Username: @$cbuser
<a href='tg://user?id=$cbid'>🤕ZAXIRAVIY👨‍💻PROFILga💡KIRISH</a><code>$baza

👉 @NAVOIY_bozor_bot  👈
🛑DIQQAT🛑
Bepul REKLAMA qilishing👇
✅ @NAVOIY_bozor_bot ✅</code>",
'parse_mode'=>'html',
]);
bot('sendMessage',[
'chat_id'=>$cbid,
'text'=>"✅ Сизнинг эълонингиз Админлариимиз томонидан кўриб чиқилади ва сизга мурожаат қилишади!",
'parse_mode'=>'html',
'reply_markup'=>$keys,
]);
del($cbid);
}
// boshqa e'lon tugadi

if($tx == $otex or $data == "clear"){
ACL($ida);
del($cbid);
del($cid);
if(isset($tx)) $url = "$cid";
if(isset($data)) $url = "$cbid";
bot('sendMessage', [
'chat_id'=>$url,
'text'=>"Эълон бекор килинди",
'reply_markup'=>$keys,
]);
}
?>
