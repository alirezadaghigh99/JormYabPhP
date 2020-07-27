<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';
// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// مدل ورودی
class CreditTransfer_Req
{
    public $FromUserName;
    public  $ToUserName;
    public  $Amount;
}

// تعریف مدل ورودی
$req= new CreditTransfer_Req();
$req-> FromUserName  ="aaaaaaaa";
$req-> ToUserName = "bbbbbbbb";
$req-> Amount = 1000;


$res =  $myApi->Exec("User/CreditTransfer",$req) ;

// وضعیت عملیات
echo $res->R_Success;
echo "\n";

//کد وضعیت عملیات - در صورت تعریف
echo $res->R_Code;
echo "\n";
// توضیحی در مورد عملیات
echo $res->R_Message;
echo "\n";
// خروجی های اختصاصی هر عملیات
if($res->R_Success)
{
}
else
{
// توضیحی در مورد عدم انجام عملیات
//echo $res->R_Message;
}

?>