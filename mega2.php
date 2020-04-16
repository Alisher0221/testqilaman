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
$message = $update->message;
$cid = $message->chat->id;
$uid = $message->from->id;
$cty = $message->chat->type;
$mid = $message->message_id;
$name = $message->chat->first_name;
$user = $message->from->username;
$tx = $message->text;
$step = get("poster/$cid.stp");
$sreply = $message->reply_to_message->text;
$ent = $message->entities[0]->type;
mkdir("megadoston");
if ($cty == 'group' || $cty == 'supergroup') {
$guruhlar = ['-1001282892978','-1001282892978','-1001282892978','-1001282892978'];
if (!in_array($cid, $guruhlar)){
bot('leaveChat', [
'chat_id' => $cid
]);
}
}

if ($tx == "/start" or $tx == "/start@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
ty($cid);
bot('sendMessage', [
'chat_id' => $cid,
'text' => "🔹Mega adminlari uchun
/start_mega - 🚩Mega uchun qabulni boshlash
/stop_mega - 🔘Megaga qabulni yopish
/limit - 📊Meganda qatnashuvchi kanallar a'zosi limiti
/info - ⚠Megaga kanal tashlash namunasi
/cancel_mega - ❌Megani bekor qilish
/statmega - ➕Megaga qo'shilgan kanallar
/set_top - 🔼Megani tepasidagi tekstini o'rnatish
/set_bottom - 🔽Megani pastdagi tekstini o'rnatish
/mega_1 - 🔷Knopkalik mega
/mega_2 - 🔶Oddiy mega
/mega_3 - ❗Infoli mega
/del_mega - 🚮Megani kanallardan o'chirish
/ban - 🔨Kanalni megadan chiqarish
/unban - ✔Bandan chiqarish
/bot_dev - 🔱Bot yaratuvchisi
  ◎ @DASTURCHI_YIGIT ◎",

'reply_to_message_id' => $mid,
]);
} else {
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📚 *Bu bot* [📚YOSH MEGA Asotsatsiyasi](https://t.me/ALISHER20020221/7) *jamoasi tomonidan yaratilgan YOSH MEGA official mega guruhida ishlaydi*⁉ *Agar shunday dizayndagi bot kerak bo'lsa* [👑 Sekret Hacker🔫 ](https://t.me/DASTURCHI_YIGIT) *ga murojaat qiling ishoning adashmaysiz!* ",
'parse_mode'=>'markdown',
'reply_to_message_id'=>$mid,
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['url' => 'https://t.me/ALISHER20020221/7', 'text' =>'➕Megaga qoshilish'],],
[['url' => 'https://t.me/DASTURCHI_YIGIT', 'text' => "💻Yaratuvchi"],],
]
]),
]);
}
}

if ($tx == "/limit@MEGAgegantBOT") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$text = $message->reply_to_message->text;
if (isset($text)) {
$ex = explode("\n", $text);
put("mega/$cid.limit", "$ex[0]|$ex[1]");
bot('sendmessage', [
'chat_id' => $cid,
'text' => "📣Kanal qabul qilishga limit qo'yildi.
📥Eng past a'zolar soni: <b>$ex[0]</b>

📤Eng yuqori a'zolar soni: <b>$ex[1]</b>",
'parse_mode' => "html",
'disable_web_page_preview' => true,
]);
} else {
bot('sendPhoto', [
'chat_id' => $cid,
'photo' => new CURLFile("limit.png"),
'caption' => "📶Megada qabul limitini sozlash uchun qo'llanma",
]);
}
}
}

if ($tx == "/set_top@MEGAgegantBOT") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$text = $message->reply_to_message->text;
if (isset($text)) {
put("mega/$cid.head", "$text");
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰🔼Megani yuqori qismi kiritildi

$text",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
} else {
bot('sendPhoto', [
'chat_id' => $cid,
'photo' => new CURLFile("mega.png"),
'caption' => "🔼Mega yuqori qismini sozlash uchun qo'llanma",
]);
}
}
}

if ($tx == "/bot_dev@MEGAgegantBOT" or $tx == "/bot_dev") {
ty($cid);
bot('sendmessage', [
'chat_id' => $cid,
'text' => "⭐️*Ushbu bot* [🌏BIZNING GURUH🌏](https://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ) *jamoasi a'zosi* [👑Sekret Hacker🔫](https://t.me/DASTURCHI_YIGIT) *tomonidan* [📚Yoshlik Mega](https://t.me/ALISHER20020221/7) *jamoasi uchun maxsus yaratilgan!* **Agar shunday dizayndagi bot kerak bo'lsa* [👑 Sekret Hacker🔫 ](https://t.me/DASTURCHI_YIGIT) *ga murojaat qiling ishoning adashmaysiz!*",
'parse_mode' => 'markdown',
'disable_web_page_preview' => true,
'reply_markup' => json_encode(
['inline_keyboard' => [
[['url' => 'https://t.me/DASTURCHI_YIGIT', 'text' => "💻Yaratuvchi"],],
[['url' => 'https://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ', 'text' => "🌏BIZNING GURUH"],],
]
]),
]);
}

if ($tx == "/set_bottom@MEGAgegantBOT") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$text = $message->reply_to_message->text;
if (isset($text)) {
put("mega/$cid.end", "$text");
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰🔽Megani pastki qismi kiritildi

$text",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
} else {
bot('sendPhoto', [
'chat_id' => $cid,
'photo' => new CURLFile("mega.png"),
'caption' => "🔽Mega pastki qismini sozlash uchun qo'llanma",
]);
}
}
}

// start mega
if ($tx == "/start_mega@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$ga = file_get_contents("mega/$cid.start");
if ($ga) {
} else {
ty($cid);
put("mega/$cid.start", "start");
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>⚫Megaga arizalar qabul qilish boshlandi!

👮Mega vaqti administrator istagiga qarab o`zgarishi mumkin ,TXT tashlashdan oldin qoidalar bilan taniship chiqing!  Izoh:
1. Chap tomonda 1ta smayl!
2. Kanal uchun nom 3ta so'zdan oshmagan holatda, bosh harf katta qolgani kichik!
3. Kanal useri!
4. Kanal linki!
5. Kanal uchun info yangi qatordan, 5ta so'zdan oshmagan holatda, bosh harf katta qolgani kichik!!

❗️🔸 Namuna: 🔸❗️</b>

<i>📚Yoshlik Mega 
@XABARCHILAR 
https://t.me/ALISHER20020221/7
YOSH MEGA siz uchun </i>

👆Kanalingizni Namunadagidek To'ldiring❗️

➕Kanalingizga @MEGAgegantBOT ni admin qiling!
📚Admin qilish uchun kanalizga kirib Administrator>Add administrator>Bot useri

<i>⏰Mega vaqti administrator istagiga qarab o`zgarishi mumkin!</i>",
'parse_mode' => "html",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
}
}
// end

//info
if($tx == "/info@MEGAgegantBOT"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"*🔴Megaga kanalni tashash qoidalari:*

1. Chap tomonda 1ta smayl!
2. Kanal uchun nom 3ta so'zdan oshmagan holatda, bosh harf katta qolgani kichik!
3. Kanal useri!
4. Kanal linki!
5. Kanal uchun info yangi qatordan, 5ta so'zdan oshmagan holatda, bosh harf katta qolgani kichik!!

*Namuna:*

```📚Yoshlik Mega
@XABARCHILAR
https://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ
YOSH MEGA jamoasi siz uchun```

⚠Iltimos qilamiz namunadagidek kanal tashlang yoki megadan chiqarilasiz!

➕Kanalingizga @MEGAgegantBOT ni admin qiling!
📚Admin qilish uchun kanalizga kirib Administrator>Add administrator>Bot useri",
'parse_mode'=>'markdown'
]);
}
// end

if($tx == "/cancel_mega@MEGAgegantBOT"){
if($cty == "supergroup" or $cty == "group"){
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if($get =="administrator" or $get == "creator"){
del("mega/$cid.ssilka");
del("mega/$cid.nom");
del("mega/$cid.info");
del("mega/$cid.url");
del("mega/$cid.start");

ty($cid);
$ms = bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*❌Mega adminlar tomonidan bekor qilindi*",
'parse_mode'=>"markdown",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
}

// mega 1
if($tx == "/mega_1@MEGAgegantBOT"){
	if ($cty == "supergroup" or $cty == "group") {
		$gett = bot('getChatMember', [
		'chat_id' => $cid,
		'user_id' => $uid,
		]);

		$get = $gett->result->status;

		if ($get == "administrator" or $get == "creator") {

			$fd3 = file("mega/$cid.ssilka"); natsort($fd3);
			file_put_contents("mega/$cid.ssilka", implode("", $fd3));

			$raw = file_get_contents ("mega/$cid.ssilka");
			$lines = explode("\n",$raw);
			foreach ($lines as $line) {
				$bits = explode("|",$line);
				$userch=$bits[1];
				$azo=$bits[0];
				$texxx="$userch\n";
				$ffile = fopen("mega/$cid.ssilka", "a");
				fwrite($ffile, $texxx);
			}

			$ssilka = file_get_contents("mega/$cid.ssilka");

			$ssilka .= "\nhttps://t.me/ALISHER20020221/7\nhttps://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ";

			$nom = file_get_contents("mega/$cid.nom");

			$nom .= "\n📚Yoshlik Mega jamoasi\n🔰BIZNING GURUH bot yaratuvchilar";

			$he = file_get_contents("mega/$cid.head");

			if ($ssilka and $nom and $he) {
				$son = file_get_contents("mega/$cid.son");

				if ($son) {
					bot('sendmessage', [
					'chat_id' => $cid,
					'text' => "🔰Mega 📤yuborilgan❗",
					]);
				} else {

					ty($cid);
					del("mega/$cid.start");
					$tt = [];
					$ssilka = explode("\n", $ssilka);
					$nom = explode("\n", $nom);

					foreach ($ssilka as $key => $ss) {
						array_push($tt, [["url" => "$ss", "text" => "$nom[$key]"],]);
					}

					$head = file_get_contents("mega/$cid.head");
					$url = file_get_contents("mega/$cid.url");
					$url .= "\n@XABARCHILAR\n@REKLAMAvsTANISHUVLAR";
					$url = explode("\n", $url);

					foreach ($url as $meid) {

						$send = bot('sendMessage', [
						'chat_id' => $meid,
						'text' => "$head",
						'parse_mode' => "markdown",
						'disable_web_page_preview' => true,
						'reply_markup' => json_encode(
						['inline_keyboard' =>
						$tt
						]),
						]);

						$mem = bot('getChatMembersCount', [
						'chat_id' => $meid,
						]
						);

						$son = $mem->result;
						$sended = $send->ok;
						$mes_id = $send->result->message_id;

						///
						if ($sended) {
							$mm = fopen("mega/$cid.son", "a");
							fwrite($mm, "$son\n");
							fclose($mm);
							///
							$mmy = fopen("mega/$cid.sended", "a");
							fwrite($mmy, "$meid\n");
							fclose($mmy);
							///
							$ttex = "$mes_id\n";
							$mmyfile = fopen("mega/$cid.del", "a");
							fwrite($mmyfile, $ttex);
							fclose($mmyfile);
							///
						} else {
							$itex = "$meid\n";
							$tmyfile = fopen("mega/$cid.no", "a");
							fwrite($tmyfile, $itex);
							fclose($tmyfile);
						}
					}

					$qatnash = file_get_contents("mega/$cid.sended");
					$noqat = file_get_contents("mega/$cid.no");
					$noqat = str_replace("@XABARCHILAR \n","",$noqat);
					$noqat = str_replace("@REKLAMAvsTANISHUVLAR \n","",$noqat);

					bot('sendmessage', [
					'chat_id' => $cid,
					'text'=>"<b>📤YUBORILDI</b>
						$qatnash
						
						<b>❌YUBORILMADI</b>
						$noqat",
						'parse_mode'=>"html",
						]);

						$ms = bot('sendmessage',[
						'chat_id'=>$cid,
						'text'=>"<b>📑 Mega tayyor boldi!</b>
						
						💻Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!
						
						🌐Mega 📥tashash uchun kod:
						<code>@MEGAgegantBOT $cid</code>",
						'parse_mode'=>"html",
						'reply_markup'=>json_encode(
						['inline_keyboard' => [
						[["switch_inline_query"=>"$cid", 'text' => "➕Kanalga yuborish"],],
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
		}
	}
}
// end

// mega 2
if ($tx == "/mega_2@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {

			$fd3 = file("mega/$cid.ssilka"); natsort($fd3);
			file_put_contents("mega/$cid.ssilka", implode("", $fd3));

			$raw = file_get_contents ("mega/$cid.ssilka");
			$lines = explode("\n",$raw);
			foreach ($lines as $line) {
				$bits = explode("|",$line);
				$userch=$bits[1];
				$azo=$bits[0];
				$texxx="$userch\n";
				$ffile = fopen("mega/$cid.ssilka", "a");
				fwrite($ffile, $texxx);
			}

$ssilka = file_get_contents("mega/$cid.ssilka");
$ssilka .= "\nhttps://t.me/ALISHER20020221/7\nhttps://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ";
$nom = file_get_contents("mega/$cid.nom");
$he = file_get_contents("mega/$cid.head");
$nom .= "\n📚Yoshlik Mega\n🔰🎩ALISHER🎩 Bot Makerlar";
if ($ssilka and $nom and $he) {
$son = file_get_contents("mega/$cid.son");
if ($son) {
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰Mega 📤yuborilgan❗",
]);
} else {
ty($cid);
del("mega/$cid.start");
$ssilka = explode("\n", $ssilka);
$nom = explode("\n", $nom);
foreach ($nom as $key => $nomlar) {
$itex = "[$nomlar]($ssilka[$key])\n\n";
$tmyfile = fopen("mega/$cid.txt", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
}

$head = file_get_contents("mega/$cid.head");
$cont = file_get_contents("mega/$cid.txt");
$end = file_get_contents("mega/$cid.end");
$url = file_get_contents("mega/$cid.url");
$url .= "\n@XABARCHILAR\n@REKLAMAvsTANISHUVLAR";
$url = explode("\n", $url);
foreach ($url as $meid) {
$send = bot('sendMessage', [
'chat_id' => $meid,
'text' => "$head\n\n$cont\n$end",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
$mem = bot('getChatMembersCount', [
'chat_id' => $meid,
]
);
$son = $mem->result;
$sended = $send->ok;
$mes_id = $send->result->message_id;
///
if ($sended) {
$mm = fopen("mega/$cid.son", "a");
fwrite($mm, "$son\n");
fclose($mm);
///
$mmy = fopen("mega/$cid.sended", "a");
fwrite($mmy, "$meid\n");
fclose($mmy);
///
$ttex = "$mes_id\n";
$mmyfile = fopen("mega/$cid.del", "a");
fwrite($mmyfile, $ttex);
fclose($mmyfile);
///
} else {
$itex = "$meid\n";
$tmyfile = fopen("mega/$cid.no", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
}
}
$qatnash = file_get_contents("mega/$cid.sended");
$noqat = file_get_contents("mega/$cid.no");
$noqat = str_replace("@XABARCHILAR\n", "", $noqat);
$noqat = str_replace("@REKLAMAvsTANISHUVLAR\n", "", $noqat);
bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>✅YUBORILDI</b>
$qatnash

<b>❌YUBORILMADI</b>
$noqat",
'parse_mode' => "html",
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>
	
	💻Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!
	
	🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "o</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid . "o", 'text' => "➕Kanalga yuborish"],],
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
}
}
}
// end

// mega 3
if ($tx == "/mega_3@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {

			$fd3 = file("mega/$cid.ssilka"); natsort($fd3);
			file_put_contents("mega/$cid.ssilka", implode("", $fd3));

			$raw = file_get_contents ("mega/$cid.ssilka");
			$lines = explode("\n",$raw);
			foreach ($lines as $line) {
				$bits = explode("|",$line);
				$userch=$bits[1];
				$azo=$bits[0];
				$texxx="$userch\n";
				$ffile = fopen("mega/$cid.ssilka", "a");
				fwrite($ffile, $texxx);
			}
			
$ssilka = file_get_contents("mega/$cid.ssilka");
$nom = file_get_contents("mega/$cid.nom");
$he = file_get_contents("mega/$cid.head");
$inf = file_get_contents("mega/$cid.infof");
$inf .= "\n\n[📚Yoshlik Mega](https://t.me/ALISHER20020221/7)- *Telegram tarmogidagi eng yetakchi mega guruh*\n\n[🔰🎩ALISHER🎩 Bot Makerlar](https://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ)- *Telegramda eng zor bot yaratuvchi DASTURCHI*";


if ($ssilka and $nom and $he) {
$son = file_get_contents("mega/$cid.son");
if ($son) {
bot('sendmessage', [
'chat_id' => $cid,
'text' => "🔰Mega 📤yuborilgan❗",
]);
} else {
ty($cid);
del("mega/$cid.start");
$ssilka = explode("\n", $ssilka);
$nom = explode("\n", $nom);
$inf = explode("{!}", $inf);
foreach ($nom as $key => $nomlar){
$itex = "[$nomlar]($ssilka[$key]) - ".$inf[$key]."\n\n";
$tmyfile = fopen("mega/$cid.txt", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
bot('sendMessage', [
'chat_id' =>"1282892978",
'text' => "$itex",
'parse_mode' => "markdown",
]);
}
$head = file_get_contents("mega/$cid.head");
$cont = file_get_contents("mega/$cid.txt");
$end = file_get_contents("mega/$cid.end");
$url = file_get_contents("mega/$cid.url");
$url = explode("\n", $url);
foreach ($url as $meid) {
$send = bot('sendMessage', [
'chat_id' => $meid,
'text' => "$head\n\n$cont\n$end",
'parse_mode' => "markdown",
'disable_web_page_preview' => true,
]);
$mem = bot('getChatMembersCount', [
'chat_id' => $meid,
]
);
$son = $mem->result;
$sended = $send->ok;
$mes_id = $send->result->message_id;
///
if ($sended) {
$mm = fopen("mega/$cid.son", "a");
fwrite($mm, "$son\n");
fclose($mm);
///
$mmy = fopen("mega/$cid.sended", "a");
fwrite($mmy, "$meid\n");
fclose($mmy);
///
$ttex = "$mes_id\n";
$mmyfile = fopen("mega/$cid.del", "a");
fwrite($mmyfile, $ttex);
fclose($mmyfile);
///
} else {
$itex = "$meid\n";
$tmyfile = fopen("mega/$cid.no", "a");
fwrite($tmyfile, $itex);
fclose($tmyfile);
}
}
$qatnash = file_get_contents("mega/$cid.sended");
$noqat = file_get_contents("mega/$cid.no");
bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>✅YUBORILDI</b>
$qatnash

<b>❌YUBORILMADI</b>
$noqat",
'parse_mode' => "html",
]);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📑 Mega tayyor boldi!</b>
	
	💻Botni 📣kanaliga 👤admin qilib qoshmaganlar, kanaliga megani tashab, <code>@username +</code> qilishlari shart!
	
	🌐Mega 📥tashash uchun kod:
<code>@MEGAgegantBOT" . $cid . "i</code>",
'parse_mode' => "html",
'reply_markup' => json_encode(
['inline_keyboard' => [
[["switch_inline_query" => $cid . "o", 'text' => "➕Kanalga yuborish"],],
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
}
}
}
// end

if (isset($update->inline_query)) {
$userID = $update->inline_query->from->id;
$theQuery = $update->inline_query->query;
$cid = $update->inline_query->query;
if (mb_stripos($cid, "o") !== false) {
$cid = str_replace("o", "", $cid);
$head = file_get_contents("mega/$cid.head");
$cont = file_get_contents("mega/$cid.txt");
$end = file_get_contents("mega/$cid.end");
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'cache_time' => 1,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(1),
'title' => "$head",
'input_message_content' => [
'disable_web_page_preview' => true,
'parse_mode' => 'markdown',
'message_text' => "$head\n\n$cont\n$end"],
]])
]);
}
 if (mb_stripos($cid, "i") !== false) {
 $cid = str_replace("i", "", $cid);
 $head = file_get_contents("mega/$cid.head");
 $cont = file_get_contents("mega/$cid.txt");
 $end = file_get_contents("mega/$cid.end");
 bot('answerInlineQuery', [
 'inline_query_id' => $update->inline_query->id,
 'cache_time' => 1,
 'results' => json_encode([[
 'type' => 'article',
 'id' => base64_encode(1),
 'title' => "$head",
 'input_message_content' => [
 'disable_web_page_preview' => true,
 'parse_mode' => 'markdown',
 'message_text' => "$head\n\n$cont\n$end"],
 ]])
 ]);
 }
 else {
$tt = [];
$ssilka = file_get_contents("mega/$cid.ssilka");
$nom = file_get_contents("mega/$cid.nom");
$ssilka .= "\nhttps://t.me/ALISHER20020221/7\nhttps://t.me/joinchat/NgZG2xQns92p8nxXtw4WNQ";
$nom .= "\n📚YOSH MegaGEGANTBOT\n🔰ALISHER Bot Makerlar(💪QASOSKOR♻DADTURCHI)";
$he = file_get_contents("mega/$cid.head");
$ssilka = explode("\n", $ssilka);
$nom = explode("\n", $nom);
foreach ($ssilka as $key => $ss) {
array_push($tt, [["url" => "$ss", "text" => "$nom[$key]"],]);
}
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'cache_time' => 1,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(1),
'title' => "$he",
'input_message_content' => [
'disable_web_page_preview' => true,
'parse_mode' => 'markdown',
'message_text' => "$he"],
'reply_markup' => [
'inline_keyboard' => $tt
],
]])
]);
}
}

iif($tx == "/ban@MEGAgegantBOT"){
if($cty == "supergroup" or $cty == "group"){
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if($get == "administrator" or $get == "creator"){
$text = $message->reply_to_message->text;
if(isset($text)){
$ex = explode("\n",$text);
$url = file_get_contents("mega/$cid.url");
$url = explode("\n",$url);
$key=array_search($ex[1],$url);
if($key!==true){
$nom=file("mega/$cid.nom");
array_splice($nom, $key, 1);
$n=fopen("mega/$cid.nom","w");

$ssilka=file("mega/$cid.ssilka");
array_splice($ssilka, $key, 1);
$s=fopen("mega/$cid.ssilka","w");

$url=file("mega/$cid.url");
array_splice($ssilka, $key, 1);
$u=fopen("mega/$cid.url","w");

for($i=0;$i<count($nom);$i++)
{
  fwrite($n,$nom[$i]);
  fwrite($u,$url[$i]);
  fwrite($s,$ssilka[$i]);
  
}
fclose($n);
fclose($u);
fclose($s);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"$ex[1] <b>✊Kanal ban qilindi! </b>",
'parse_mode'=>"html",
]);
}
if($tx == "/unban@MEGAgegantBOT"){
if($cty == "supergroup" or $cty == "group"){
bot('unbanChatMember',[
'chat_id'=>$cid,
'user_id'=>$uid
]);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📇 @$user bandan chiqarildi",
]);
}
}else{
bot('sendPhoto',[
'chat_id'=>$cid,
'photo'=>new CURLFile("megap.png"),
'caption'=>"🔽 Mega pastki qismini sozlash uchun qo'llanma! ",
]);
}
}
}
}

// delete mega
if ($tx == "/del_mega@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$dd = file_get_contents("mega/$cid.del");
ty($cid);

$del = file_get_contents("mega/$cid.sended");
$del = explode("\n", $del);
$dd = explode("\n", $dd);
$son = file_get_contents("mega/$cid.son");
$son = explode("\n", $son);
foreach ($del as $key => $chan) {
$mem = bot('getChatMembersCount', [
'chat_id' => $chan,
]);
$soni = $mem->result;
$nati = $soni - $son[$key];
$mmy = fopen("mega/$cid.nat", "a");
fwrite($mmy, "$chan [$nati]\n");
fclose($mmy);
bot('deleteMessage', [
'chat_id' => $chan,
'message_id' => $dd[$key],
]);
}
$na = file_get_contents("mega/$cid.nat");

$na = substr($na, 0, -5);
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>📊 Mega natijalari:</b>

$na

⭕<i>Megada qatnashgan hammaga rahmat</i>",
'parse_mode' => "html",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]); 
//del("mega/$cid.head");
}
del("mega/$cid.nat");
del("mega/$cid.sended");
del("mega/$cid.no");
del("mega/$cid.del");
del("mega/$cid.txt");
del("mega/$cid.son");
del("mega/$cid.ssilka");
del("mega/$cid.nom");
del("mega/$cid.infof");
del("mega/$cid.url");
}
}
// end

//stop mega
if ($tx == "/stop_mega@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator") {
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>⚠Qabul yopildi⏰</b>

<i>🔵Qabul yopildi birozdan so`ng mega tayyor bo`ladi!</i>",
'parse_mode' => "html",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
}

// end

if ($tx == "/statmega@MEGAgegantBOT") {
if ($cty == "supergroup" or $cty == "group") {
$kanal = file_get_contents("mega/$cid.url");
$gett = bot('getChatMember', [
'chat_id' => $cid,
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator" or $get == "member") {
$ms = bot('sendmessage', [
'chat_id' => $cid,
'text' => "<b>➕Yoshlik Megaga qo'shilgan kanallar</b>

$kanal",
'parse_mode' => "html",
]);
$nat = $ms->result->message_id;
bot('ChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
}
}




if((stripos($tx[1],"@")!==false) and (stripos($tx[2],"https://")!==false)){ 
bot('sendMessage',[ 
'chat_id'=>$cid, 
'text'=>"$tx[1] Kanali 🔱 Megaga qushildi➕", 
'reply_to_message_id'=>$mid, 
]);
}
// qabul
$tx = explode("\n", $tx);
if ((stripos($tx[1], "@") !== false) and (stripos($tx[2], "https://") !== false)) {
$start = file_get_contents("mega/$cid.start");
if ($start) {
$tek = file_get_contents("mega/$cid.ssilka");
if (stripos($tek, $tx[2]) !== false) {
} else {
$adm = bot('getChatAdministrators', [
'chat_id' => $tx[1],
]);
$adok = $adm->ok;
if ($adok) {
$gett = bot('getChatMember', [
'chat_id' => $tx[1],
'user_id' => $uid,
]);
$get = $gett->result->status;
if ($get == "administrator" or $get == "creator" or $get=="member") {
$limit = file_get_contents("mega/$cid.limit");
$limit = file_get_contents("mega/$cid.limit");
if ($limit) {
list($kam, $kop) = explode("|", $limit);
$mem = bot('getChatMembersCount', [
'chat_id' => $tx[1],
]);
$son = $mem->result;
if ($son >= $kam and $kop >= $son) {
$ge = file_get_contents("mega/$cid.ssilka");
if ($ge) {
file_put_contents("mega/$cid.ssilka", "$ge\n$son|$tx[2]");
} else {
$ssi = $tx[2];
file_put_contents("mega/$cid.ssilka", "$son|$ssi");
}
$ga = file_get_contents("mega/$cid.nom");
if ($ga) {
file_put_contents("mega/$cid.nom", "$ga\n$tx[0]");
} else {
file_put_contents("mega/$cid.nom", "$tx[0]");
}
$gt = file_get_contents("mega/$cid.url");
if ($gt) {
file_put_contents("mega/$cid.url", "$gt\n$tx[1]");
} else {
file_put_contents("mega/$cid.url", "$tx[1]");
}
$inf = $tx[3];
$ggt = file_get_contents("mega/$cid.infof");
if ($ggt) {
file_put_contents("mega/$cid.infof", "$ggt{!}$inf");
} else {
file_put_contents("mega/$cid.infof", "$inf");
}
} else {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "⚠☝️Sizni kanalingiz limitga to'g'ri kelmadi. Odam soni eng ko'pi <b>$kop</b>, eng kami <b>$kam</b> bo'lishi kerak! Kanalingiz a'zolarini ko'paytiring",
'parse_mode' => "html",
'reply_to_message_id' => $mid,
]);
}
} else {
$ms = bot('sendMessage', [
'chat_id' => $cid,
'text' => "❗️Adminlar kanallar uchun limit o'rnatib qo'yinglar\n/limit@MEGAgegantBOT buyrug'i orqalik limit o'rnatasiz.",
]);
$nat = $ms->result->message_id;
bot('pinChatMessage', [
'chat_id' => $cid,
'message_id' => $nat,
]);
}
} else {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "⚠☝️Siz kanalda adminlar qatorida yo'qsiz! Demak megada qatnasha olmaysiz!",
'reply_to_message_id' => $mid,
]);
}
} else {
bot('sendMessage', [
'chat_id' => $cid,
'text' => "⚠Qabulda xatolik ☝️@MEGAgegantBOT ni kanalizga admin qiling va qaytadan urunib ko'ring!",
'reply_to_message_id' => $mid,
]);
}
if((stripos($tx[1],"@")!==false) and (stripos($tx[2],"https://")!==false)){ 
bot('sendMessage',[ 
'chat_id'=>$cid, 
'text'=>"📣Kanalingiz 🔰Megaga qo'shildi➕ /statmega@MEGAgegantBOT buyrug'i orqali tekshirib ko'ring⁉", 
'reply_to_message_id'=>$mid, 
]);
}
}
}
}
?>