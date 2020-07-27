<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';

// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// مدل ورودی
class SendSms_Req
{
   public $SmsBody ;
   public $Mobiles ;
   public $SmsNumber ;
}

// تعریف مدل ورودی
$req= new SendSms_Req();
$req-> SmsBody  ="salam";
$req-> Mobiles = array('09362956710');

//اختیاری
//$req-> SmsNumber = "10001391";

$res =  $myApi->Exec("Message/SendSms",$req) ;

// وضعیت عملیات
echo $res->R_Success;
// کد خروجی در صورتی که عملیات موفق نباشد
echo $res->R_Code;

// توضیحی در مورد عملیات
echo $res->R_Message;

// خروجی های اختصاصی هر عملیاتمتد
if($res->R_Success)
{
// پیام ارسال شد
//echo $res->R_Message;

// در صورت نیاز به خروجی هر ارسال گروهی
foreach($res->DataList as $item)
{
            // وضعیت ارسال
          echo  $item->SendStatus;
          // شماره موبایل
          echo  $item->Mobile;
          // شناسه ارسال
          echo  $item->ReqID;
}
}else
{
// علت عدم ارسال پیام
//echo $res->R_Message;
}
// print json echo json_encode($res);

?>