<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';
// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// مدل ورودی
class SmsCalc_Req
{
     public $SmsBody;
     public  $SmsNumber;
}

// تعریف مدل ورودی
$req= new SmsCalc_Req();
$req-> SmsBody  ="salam";
$req-> SmsNumber = "10001391";

$res =  $myApi->Exec("Message/SmsCalc",$req) ;

// print json echo json_encode($res);

// وضعیت عملیات
echo $res->R_Success;
// کد خروجی در صورتی که عملیات موفق نباشد
echo $res->R_Code;

// توضیحی در مورد عملیات
echo $res->R_Message;

// خروجی های اختصاصی هر عملیات
if($res->R_Success)
{
echo $res->SmsPart;
echo $res->IsUnicode==false ? "false" : "true";
}
else
{
// توضیحی در مورد عدم انجام عملیات
//echo $res->R_Message;
}

?>