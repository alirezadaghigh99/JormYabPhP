<?php
// افزودن کتابخانه وب سرویس
include '../lib/ConnectToApi.php';
// فراخوانی فایل اطلاعات وب سرویس
include '../ApiSetting.php';

$myApi = new ConnectToApi($apiMainurl,$apiKey);

// مدل ورودی
class RegUser_Req
{
    public $FirstName;
    public $LastName;
    public $Company;
    public $NationalCode;
    public $Email;
    public $Mobile;
    public $Phone;
    public $Description;
}

// تعریف مدل ورودی
$req= new RegUser_Req();
$req-> FirstName  ="سحر";
$req-> LastName  ="افشار";
$req-> Company  ="ماکروسافت";
$req-> NationalCode  ="30030";
$req-> Email  ="hopopenaha@proto2mail.com";
$req-> Mobile  ="090500000";
$req-> Phone  ="021767676";
$req-> Description  ="auto Register";

$res =  $myApi->Exec("User/RegUser",$req) ;


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
echo $res->UserID;
echo "\n";
}
else
{
// توضیحی در مورد عدم انجام عملیات
//echo $res->R_Message;
}

?>