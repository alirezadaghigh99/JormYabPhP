<?php

define('DB_USER','root');
define('DB_PASS','Alireza_1378');
define('DB_HOST','localhost');
define('DB_NAME' , 'sms_verify');
$link = mysqli_connect(DB_HOST , DB_USER, DB_PASS, DB_NAME);

if ($link) {
    // die("Connection failed: " . $conn->connect_error);
    }
mysqli_set_charset($link , "utf8");
// echo $link;
$command = $_REQUEST['command'];
if ($command == "register_user"){
    //register user

    $name = $_REQUEST['name'];
    $mobile = $_REQUEST['mobile'];
    $query = "select * from user where mobile = '$mobile'";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));
    $num = mysqli_num_rows($result);
    if ($num == 0){
        $query = "insert into user (name,mobile,register_date,status) values ('$name','$mobile',now(),0)";
        $result = mysqli_query($link,$query) or die(mysqli_error($link));
        $user_id = mysqli_insert_id($link);
    }
    else{
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];
    }
    //delete previous sms
    $query = "delete from sms where user_id =  $user_id";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));

    //insert sms to data base
    $code = rand(1000,9999);
    $query = "insert into sms (user_id,code) values ('$user_id','$code')";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));

    send_sms($mobile , $code);
    echo json_encode(array('result' => "ok"));

}
function send_sms($mobile , $code)
{
   
    //send sms to gate way
    include './rest/lib/ConnectToApi.php';
    // فراخوانی فایل اطلاعات وب سرویس
    include './rest/ApiSetting.php';
    
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
    $req-> Mobiles = array($mobile);
    $req-> SmsBody  ="your verification code of JormYab app is $code";

    
    $res =  $myApi->Exec("Message/SendSms",$req) ;
   
    // وضعیت عملیات
     //echo $res->R_Success ;
    // کد خروجی در صورتی که عملیات موفق نباشد
    //  echo $res->R_Code;
    
    // توضیحی در مورد عملیات
     //echo $res->R_Message;
    
    // خروجی های اختصاصی هر عملیاتمتد
    if($res->R_Success)
    {
    // پیام ارسال شد
    //echo $res->R_Message;
    
    // در صورت نیاز به خروجی هر ارسال گروهی
    
    }else
    {
    // علت عدم ارسال پیام
      echo $res->R_Message;
      echo $res->R_Code;
    }
}

if ($command == "verify_code"){
    $mobile = $_REQUEST['mobile'];
    $code = $_REQUEST['code'];
    $query = "select * from user where mobile = '$mobile'";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));
    $num = mysqli_num_rows($result);
    if ($num == 0){
        echo json_encode(array('result'=> "error"));

    }
    else{
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];
        $query = "select * from sms where user_id = $user_id and code = '$code'";
        $result = mysqli_query($link,$query) or die(mysqli_error($link));
        $num = mysqli_num_rows($result);
        if ($num == 0){
            echo json_encode(array('result'=> "error"));

        }else{
            $sms = mysqli_fetch_assoc($result);
            date_default_timezone_set("Asia/Tehran");
            $sms_timestamp = strtotime($sms['create_date']);
            $timezone = new DateTimeZone("Asia/Tehran");
            $date = new DateTime();
            $date -> setTimezone($timezone);
            $current_time_stamp = $date -> getTimestamp();
            $differ =  $current_time_stamp - $sms_timestamp;
            if ($differ < (10 * 60)){   
                echo json_encode(array('result'=> "ok","user_id"=>$user_id));
            }else{
                echo json_encode(array('result'=> "error"));

            }
        }
    }
}
if ($command == "get_profile"){
    $user_id = $_REQUEST["user_id"];
    $query = "select * from user where id = '$user_id'";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result);
    echo json_encode(array("user_name"=>$user["name"],"mobile"=>$user["mobile"],"date"=>$user["register_date"]));

}
?>
