<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';
// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// مدل ورودی
class SmsNumber_Req
{
    public $NumberType;
}

// تعریف مدل ورودی
$req= new SmsNumber_Req();
$req-> NumberType  =1; //1 => decicated , 2=> public , 0=> all


$res =  $myApi->Exec("User/SmsNumber",$req) ;

// وضعیت عملیات
echo $res->R_Success;
echo "\n"  ;
//کد وضعیت عملیات - در صورت تعریف
echo $res->R_Code;
echo "\n"  ;

// توضیحی در مورد عملیات
echo $res->R_Message;
echo "\n"  ;

// خروجی های اختصاصی هر عملیات
if($res->R_Success)
{
echo print_r( $res->SmsNumbers);
echo "\n"  ;
}
else
{
// توضیحی در مورد عدم انجام عملیات
///echo $res->R_Message;
}

?>