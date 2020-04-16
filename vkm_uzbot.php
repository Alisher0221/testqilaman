<?php
/*
Ushbu Music Bot @UzWebDev tomonidan dasturlandi va @ob_havo_bbot konstruktor boti kanali orqali tarqatildi!
*/
ob_start();
$API_KEY = '821237880:AAFTo3dsM0BMmZIEpFAcoWQMUiklRs1tYwY'; //BOT TOKENI
define('API_KEY',$API_KEY);
function UzWebDevBot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init('API_KEY'.'sendaudio');
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
 function sendmessage($chat_id, $text, $model){
  UzWebDevBot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>$text,
  'parse_mode'=>$mode
  ]);
  }
  function sendaudio($chat_id, $audio, $model){
  UzWebDevBot('sendaudio',[
  'chat_id'=>$chat_id,
  'audio'=>$audio,
  'action'=>"$action",
  'parse_mode'=>$mode
  ]);
  }
  function sendaction($chat_id, $action){
  UzWebDevBot('sendchataction',[
  'chat_id'=>$chat_id,
  'action'=>$action
  ]);
  }
function sendphoto($chat_id, $photo, $action){
  UzWebDevBot('sendphoto',[
  'chat_id'=>$chat_id,
  'photo'=>$photo,
  'action'=>$action
  ]);
  }
// bu funksiya JSON uchun agar tushunsangiz ishlatishingiz mumkin!
 /* function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }*/
	
  //====================@ob_havo_bbot======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
mkdir("data/$from_id");
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
$uzwebdev = file_get_contents("data/$from_id/uzwebdev.txt");
$ADMIN = "831477295"; //ADMIN ID RAQAMI

//====================@ob_havo_bbot======================//
if($text == "/start"){
if (!file_exists("data/$from_id/uzwebdev.txt")) {
        mkdir("data/$from_id");
        file_put_contents("data/$from_id/uzwebdev.txt","none");
        $myfile2 = fopen("userlar.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
    }
    sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"*vkm_uzbot - Qo'shiq izlovchi botga xush kelibsiz*",
'parse_mode'=>'MarkDown',
 'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"📎Menyu"],['text'=>"🔍Qo'shiq izlash"]],
 ],
 ])
 ]);
 }
elseif($text == "📎Menyu"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"👍 <b>Marhamat kerakli bo'limni tanlang:</b>",
        'parse_mode'=>'HTML',
  'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"🔍Qo'shiq izlash"]],
  [['text'=>"🔖Qo'llanma"]],
  [['text'=>"📞Aloqa"],['text'=>"🇺🇿Tilni tanlash"]]
  ]
  ])
  ]);
  }
elseif($text == "🇺🇿O'zbek tili"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🇺🇿 O'zbek tili tanlandi",
        'parse_mode'=>'MarkDown',
  'reply_markup'=>json_encode([
  'keyboard'=>[
[['text'=>"🔍Qo'shiq izlash"]],
  [['text'=>"🔖Qo'llanma"]],
  [['text'=>"📞Aloqa"],['text'=>"🇺🇿Tilni tanlash"]]
  ]
  ])
  ]);
  }
elseif($text == "🔙Назад🔙"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"*@vkm_uzbot - Добро пожаловать в музыкальный поисковый бот!* 
  Пожалуйста, выберите нужный раздел:",
        'parse_mode'=>'MarkDown',
  'reply_markup'=>json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"📁Главный меню"],['text'=>"🔍Поиск песня"]],
  ]
  ])
  ]);
  }
  elseif($text == "🔍Поиск песня"){
    UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"✏️<b>Для поиска песен, Введите</b> <i>muz+Имя песни</i>

  <b>Например:</b> <code>muz+Максим</code>",
  'parse_mode'=>"HTML",
                 'reply_markup'=>json_encode([
'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"🔙Назад🔙"]]
 ],
 ])
 ]);
 }
elseif($text == "🇺🇿Tilni tanlash"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🇺🇿*Tilni tanlang:*🇷🇺",
        'parse_mode'=>'MarkDown',
  'reply_markup'=>json_encode([
   'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"🇷🇺Русккий язык"],['text'=>"🇺🇿O'zbek tili"]],
  ]
  ])
  ]);
  }
elseif($text == "🇷🇺Сменить язык"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🇷🇺 Выберите язык:",
        'parse_mode'=>'MarkDown',
  'reply_markup'=>json_encode([
   'resize_keyboard'=>true,
  'keyboard'=>[
  [['text'=>"🇷🇺Русккий язык"],['text'=>"🇺🇿O'zbek tili"]],
  ]
  ])
  ]);
  }
elseif($text == "🇷🇺Русккий язык"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"👍*Язык выбран!* Выберите желаемую категорию:",
        'parse_mode'=>'MarkDown',
  'reply_markup'=>json_encode([
   'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"🔍Поиск песня"]],
  [['text'=>"🔖Руководство"]],
  [['text'=>"📞Связаться с Нами"],['text'=>"🇷🇺Сменить язык"]]
  ]
  ])
  ]);
  }
elseif($text == "📁Главный меню"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"💫Пожалуйста, выберите желаемую категорию:",
        'parse_mode'=>'MarkDown',
  'reply_markup'=>json_encode([
   'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"🔍Поиск песня"]],
  [['text'=>"🔖Руководство"]],
  [['text'=>"📞Связаться с Нами"],['text'=>"🇷🇺Сменить язык"]]
  ]
  ])
  ]);
  }
elseif($text == "🔙Ortga qaytish"){
        sendAction($chat_id, 'typing');
  UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🏠 *Siz bosh menyudasiz.*
  Kerakli bo'limni tanlang:",
        'parse_mode'=>'MarkDown',
 'reply_markup'=>json_encode([
  'resize_keyboard'=>true,
 'keyboard'=>[
 [['text'=>"📎Menyu"],['text'=>"🔍Qo'shiq izlash"]],
 ],'resize_keyboard'=>true
 ])
 ]);
 }
//====================@ob_havo_bbot======================//
elseif($text == "📞Aloqa"){
                        sendAction($chat_id, 'typing');
      file_put_contents("data/$from_id/uzwebdev.txt","aziz");
        UzWebDevBot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"📝 <b>Bizga xabar yoki taklif/mulohazalaringiz bo'lsa yozing:</b> 
        Albatta javob beramiz!",
        'parse_mode'=>"html",
                 'reply_markup'=>json_encode([
				  'resize_keyboard'=>true,
  'keyboard'=>[
  [
  ['text'=>"🔙Ortga qaytish"]
  ],
  ]
  ])
  ]);
  }elseif($uzwebdev == "aziz"){            
                    file_put_contents("data/$from_id/uzwebdev.txt","none");
                          Forward($ADMIN,$chat_id,$message_id);
      UzWebDevBot('sendmessage',[       
      'chat_id'=>$chat_id,
      'text'=>"✅ Adminga yetkazildi. Raxmat!",
      'parse_mode'=>'MarkDown',
  ]);
  }
elseif($text == "📞Связаться с Нами"){
                        sendAction($chat_id, 'typing');
      file_put_contents("data/$from_id/uzwebdev.txt","aziz");
        UzWebDevBot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"✏️Пожалуйста, введите ваше сообщение:",
                 'reply_markup'=>json_encode([
				  'resize_keyboard'=>true,
  'keyboard'=>[
  [
  ['text'=>"🔙Назад🔙"]
  ],
  ]
  ])
  ]);
  }elseif($uzwebdev == "aziz"){            
                    file_put_contents("data/$from_id/uzwebdev.txt","none");
                          Forward($ADMIN,$chat_id,$message_id);
      UzWebDevBot('sendmessage',[       
      'chat_id'=>$chat_id,
      'text'=>"✅Ваше сообщение успешно отправлено! Спасибо!",
      'parse_mode'=>'MarkDown',
  ]);
  }
elseif($text == "🔖Qo'llanma"){
      file_put_contents("data/$from_id/uzwebdev.txt","music");
                              sendAction($chat_id, 'typing');
        UzWebDevBot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Botimizdan qo'shiq izlash uchun xoxlagan qo'shiqchingiz nomini yozing agar topilmasa, qo'shiq nomini yozib ko'ring!</b>
    Qo'shiq izlash quydagicha bo'ladi:
    <code>muz+qo'shiqchi nomi</code> 
    <b>Misol uchun:</b> muz+Lola yoki muz+Xayr qizaloq",
    'parse_mode'=>"html",
  ]);
  }
elseif($text == "🔖Руководство"){
      file_put_contents("data/$from_id/uzwebdev.txt","music");
                              sendAction($chat_id, 'typing');
        UzWebDevBot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅<b>Используйте следующие для поиска песен:</b>
<code>muz+название песен</code>",
'parse_mode'=>"html",
  ]);
  }
//====================@ob_havo_bbot======================//
/*Ushbu Panel funksiyasi faqat adminlar uchun ishlaydi! Bosharish uchun botga Panel deb yozing!*/
elseif($text == "Panel" && $chat_id == $ADMIN){
sendaction($chat_id, typing);
        UzWebDevBot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"Admin panelga xush kelibsiz! Tanlang:",
                'parse_mode'=>'html',
      'reply_markup'=>json_encode([
            'keyboard'=>[
              [
              ['text'=>"Statistika"],['text'=>"Xabar yuborish"],['text'=>"🔙Ortga qaytish"]
              ]
              ],'resize_keyboard'=>true
        ])
            ]);
        }
elseif($text == "Statistika" && $chat_id == $ADMIN){
  sendaction($chat_id,'typing');
    $user = file_get_contents("userlar.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
  sendmessage($chat_id , "Bot a'zolari soni: $member_count" , "html");
}
elseif($text == "Xabar yuborish" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/uzwebdev.txt","send");
  sendaction($chat_id,'typing');
  UzWebDevBot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"A'zolarga yuboriladigan xabaringizni kiriting:",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
      'keyboard'=>[
    [['text'=>'Panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($uzwebdev == "send" && $chat_id == $ADMIN){
    file_put_contents("data/$from_id/uzwebdev.txt","no");
  SendAction($chat_id,'typing');
  UzWebDevBot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"👍🏻 Xabar barcha a'zolarga yuborildi!",
  ]);
  $all_member = fopen( "userlar.txt", "r");
    while( !feof( $all_member)) {
      $user = fgets( $all_member);
      SendMessage($user,$text,"html");
    }
}
//====================@ob_havo_bbot======================//
 elseif($text == "🔍Qo'shiq izlash"){
   file_put_contents("data/$from_id/uzwebdev.txt","music");
                           sendAction($chat_id, 'typing');
    UzWebDevBot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🎗 Qo'shiq izlash uchun xoxlagan qo'shiqchi yoki qo'shiq nomini <code>muz+qo'shiq nomi</code> tarzida yozing!
  <b>Masalan:</b> <code>muz+Munisa</code> yoki
  <code>muz+Sevgilim</code>
siz istagandek bot yasab beramiz
lechkam -> t.me/phpustasi ",
  'parse_mode'=>"HTML",
                 'reply_markup'=>json_encode([
				 'resize_keyboard'=>true,
 
 'keyboard'=>[
 [['text'=>"🔙Ortga qaytish"]]
 ],
 'resize_keyboard'=>true
])
 ]);
 }
//====================@ob_havo_bbot======================//
if(mb_stripos($text,"muz") !== false){
$ex=explode("+",$text);
$v = file_get_contents("https://xits.pro/search/$ex[1]");
$vk = 'Master'.$v.'
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/musiqa/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/musiqa/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/muz/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/muz/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/muz/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/musiqa/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3">
                <i class="fa fa-play-circle-o"></i>                <a"/musiqa/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a>             </div>
<div class="mp3"> <i class="fa fa-play-circle-o"></i> <a"/musiqa/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a> </div>
<div class="mp3"> <i class="fa fa-play-circle-o"></i> <a"/musiqa/6312_Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos.html">Ummon guruhi - So&#039;ngi Bor So&#039;ngi Iltimos</a> </div>';
file_put_contents("mp3.txt",$vk);
$zb = file_get_contents("mp3.txt");
$ex1 = explode("fa fa-play-circle-o",$zb);
$ex12 = explode("</div>",$ex1[1]);
$ex22 = explode("</div>",$ex1[2]);
$ex32 = explode("</div>",$ex1[3]);
$ex42 = explode("</div>",$ex1[4]);
$ex52 = explode("</div>",$ex1[5]);
$ex62 = explode("</div>",$ex1[6]);
$ex72 = explode("</div>",$ex1[7]);
$ex82 = explode("</div>",$ex1[8]);
$ex92 = explode("</div>",$ex1[9]);
$ex102 = explode("</div>",$ex1[10]);
if(mb_stripos($ex12[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex12[0]);
$t = str_replace('&#039;','`',$t);
$m1 = trim($t);
$m1 = "✅<b>Marhamat, qo'shiqni tanlang:</b>

1️⃣ $m1";
}else{
$m1 = "";
}
if(mb_stripos($ex22[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex22[0]);
$t = str_replace('&#039;','`',$t);
$m2 = trim($t);
$m2 = "2️⃣ $m2";
}else{
$m2 = "";
}

if(mb_stripos($ex32[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex32[0]);
$t = str_replace('&#039;','`',$t);
$m3 = trim($t);
$m3 = "3️⃣ $m3";
}else{
$m3 = "";
}

if(mb_stripos($ex42[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex42[0]);
$t = str_replace('&#039;','`',$t);
$m4 = trim($t);
$m4 = "4️⃣ $m4";
}else{
$m4 = "";
}
if(mb_stripos($ex52[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex52[0]);
$t = str_replace('&#039;','`',$t);
$m5 = trim($t);
$m5 = "5️⃣ $m5";
}else{
$m5 = "";
}
if(mb_stripos($ex62[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex62[0]);
$t = str_replace('&#039;','`',$t);
$m6 = trim($t);
$m6 = "6️⃣ $m6";
}else{
$m6 = "";
}
if(mb_stripos($ex72[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex72[0]);
$t = str_replace('&#039;','`',$t);
$m7 = trim($t);
$m7 = "7️⃣ $m7";
}else{
$m7 = "";
}
if(mb_stripos($ex82[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex82[0]);
$t = str_replace('&#039;','`',$t);
$m8 = trim($t);
$m8 = "8️⃣ $m8";
}else{
$m8 = "";
}
if(mb_stripos($ex92[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex92[0]);
$t = str_replace('&#039;','`',$t);
$m9 = trim($t);
$m9 = "9️⃣ $m9";
}else{
$m9 = "";
}
if(mb_stripos($ex102[0],"<a href") !== false){
$t = str_replace('"></i>',' ',$ex102[0]);
$t = str_replace('&#039;','`',$t);
$m10 = trim($t);
$m10 = "🔟 $m10";
}else{
$m10 = "";
}
file_put_contents("mp3.txt","
$m1
$m2
$m3
$m4
$m5
$m6
$m7
$m8
$m9
$m10");
UzWebDevBot(sendmessage,[
'chat_id'=>$chat_id,
'text'=>"$m1\n$m2\n$m3\n$m4\n$m5\n$m6\n$m7\n$m8\n$m9\n$m10 \n\n<b>Qo'shiqni yuklab olish uchun qo'shiq raqamini yozib yuboring</b>:",
'message_id'=>$message_id,
'parse_mode' =>'html'
]);
}
//====================@ob_havo_bbot======================//
if($text == "1" or $text == "2" or $text == "3" or $text == "4" or $text == "5" or $text == "6" or $text == "7" or $text == "8" or $text == "9" or $text == "10"){
$get = file_get_contents("mp3.txt");
if($text == "1"){
$ex = explode("\n",$get);
$a = explode(">",$ex[3]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("1 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[3]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "2"){
$ex = explode("\n",$get);
$a = explode(">",$ex[4]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("2 .","",$m);
$m = trim($m);
$b = explode('/muz/',$ex[4]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "3"){
$ex = explode("\n",$get);
$a = explode(">",$ex[5]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("3 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[5]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "4"){
$ex = explode("\n",$get);
$a = explode(">",$ex[6]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("4 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[6]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "5"){
$ex = explode("\n",$get);
$a = explode(">",$ex[7]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("5 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[7]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "6"){
$ex = explode("\n",$get);
$a = explode(">",$ex[8]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("6 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[8]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "7"){
$ex = explode("\n",$get);
$a = explode(">",$ex[9]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("7 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[9]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "8"){
$ex = explode("\n",$get);
$a = explode(">",$ex[10]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("8 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[10]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "9"){
$ex = explode("\n",$get);
$a = explode(">",$ex[11]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("9 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[11]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}
if($text == "10"){
$ex = explode("\n",$get);
$a = explode(">",$ex[12]);
$m = str_replace("</a","",$a[1]);
$m = str_replace("10 .","",$m);
$m = trim($m);
$b = explode('/musiqa/',$ex[12]);
$d = explode('_',$b[1]);
$r = trim($d[0]);
$url = "https://xits.pro/download/$r";
file_put_contents("mp3.mp3",file_get_contents($url));
}else{
UzWebDevBot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔎 <i>$m</i>
 
 ⏳ <b>Qo'shiq yuklanmoqda...</b>",
 'parse_mode'=>"HTML"
 ]);
 sleep(2);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'text'=>'⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️0%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id +1,
 'text'=>'⬛️⬜️⬜️⬜️⬜️⬜️⬜️⬜️10%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬜️⬜️⬜️⬜️⬜️⬜️20%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬜️⬜️⬜️⬜️⬜️30%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️🔳⬜️⬜️⬜️⬜️40%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬛️⬜️⬜️⬜️⬜️50%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬛️⬛️⬜️⬜️⬜️60%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬛️⬛️▪️⬜️⬜️70%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬛️⬛️⬛️⬜️⬜️80%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️90%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>'⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️100%'
 ]);
 sleep(1);
UzWebDevBot('editMessageText',[
 'chat_id'=>$chat_id,
 'message_id'=>$message_id + 1,
 'text'=>"💯<b>Qo'shiq muvaffaqiyatli yuklandi!</b>
 Xozir yuboramiz...",
 'parse_mode'=>"HTML"
 ]);
UzWebDevBot('sendaudio',[
        'chat_id'=>$chat_id,
        'audio'=>new curlfile("mp3.mp3"),
        'title'=>$m,
        'caption'=>"Created by @phpustasi for @ob_havo_bbot"
        ]);
   }}
/* Barcha turdagi Telegram botlarni sifatli va arzon narxlarda, siz xoxlagandek yaratib beramiz! 
- Murojaat uchun: @phpustasi 
- Spamlar uchun: @botbor_robot 
*/