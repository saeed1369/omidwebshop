<?php
if(isset($_GET['status']))
{
		session_start();	
		include_once("functions.php");
		
		$api = 'test';
		$token = $_GET['token'];
		$result = json_decode(verify($api,$token));
		if(isset($result->status)){
			if($result->status == 1){
					include("connection.php");
					include("jdf.php");
					$con = new Connection();
					$con = $con->getCon();
					
						mysqli_query($con,"SET NAMES UTF8");
						mysqli_query($con,"SET CHARACTER SET utf8");
					$userid = $_SESSION["id"];
					$userName = $_SESSION["userName"];
					$name = $_SESSION["Name"];
					
					$trakoneshid = $result->transId;
					$cardNumber =$result->cardNumber; 
					$mablagh = $result->amount;
					$date = jdate("Y-n-j");
					$query = "INSERT into ".DB.".pardakht(userId,name,date,shomarehTarakonesh,mablagh,userName,cardNumber)
					VALUES(N'$userid',N'$name',N'$date',N'$trakoneshid','$mablagh',N'$userName',N'$cardNumber')";
					$result1  = mysqli_query($con,$query);
					//if($result)
					$_SESSION['result_pardakht']="شماره تراکنش : " .$result->transId . "  است . جهت پیگیری های بعدی ان را ذخیره کنید  ";
					$_SESSION['RefID']=$trakoneshid;
					$text = "کاربر به نام  :".$_SESSION["Name"] ."مبلغ  ".$mablagh ." تومان به شماره تراکنش " .$trakoneshid." در تاریخ ".$date ." انجام دادند." ;
					
					
					header("Location:../moshavereh.php");
					include_once("mybot.php");
					//sendMessageToTelegram($text);
					//echo "saved";
					exit();

					
					
			} else {
					$_SESSION['result_pardakht']=$result->errorMessage;
				
					header("Location:../moshavereh.php");
					//echo " notsaved";
					exit();
			}
		} else {
			if($_GET['status'] == 0){
					$_SESSION['result_pardakht']= $result->errorMessage;
					header("Location:../moshavereh.php");
					//echo " notsaved";
					exit();
			}
		}
}
$_SESSION['result_pardakht']='خطا در عملیات';
header("Location:../moshavereh.php");
//echo " notsavedeee";



?>