<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';
// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// مدل ورودی
class Credit_Req
{

}

// تعریف مدل ورودی
$req= new Credit_Req();


$res =  $myApi->Exec("User/Credit",$req) ;

// وضعیت عملیات
echo $res->R_Success;
echo "\n"  ;
//کد وضعیت عملیات - در صورت تعریف
echo $res->R_Code;
echo "\n";

// توضیحی در مورد عملیات
echo $res->R_Message;
echo "\n"  ;

// خروجی های اختصاصی هر عملیات
if($res->R_Success)
{

echo $res->Amount;
echo "\n"  ;
//print_r($res);
}
else
{
// توضیحی در مورد عدم انجام عملیات
//echo $res->R_Message;
//echo "\n"  ;
}

?>