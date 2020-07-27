<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';
// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// ارسال کد فعال سازی
// جهت ارسال کد از همین متد استفاده کنید.
// ارسال پیامک فعال سازی از این متد به نسبت ارسال پیامک عادی سرعت بالاتری دارد.

// مدل ورودی
class SendOtp_Req
{
    public   $Mobile;
    public   $SmsCode ;
    public   $TemplateId ;
    public   $AddName;
}

// تعریف مدل ورودی
$req= new SendOtp_Req();
$req-> Mobile  ="0912111xxxx";
$req-> SmsCode = "1234";     // otp code
$req->TemplateId =0; //0-6   activeating code , verify code , login code
$req->AddName =false;      // append company name end of sms

$res =  $myApi->Exec("Message/SendOtp",$req) ;

// print json echo json_encode($res);

// وضعیت عملیات
echo $res->R_Success;
// کد خروجی در صورتی که عملیات موفق نباشد
echo $res->R_Code;
// توضیحی در مورد عملیات
echo $res->R_Message;

?>