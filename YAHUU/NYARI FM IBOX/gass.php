<?php
error_reporting(0);
set_time_limit(0);
date_default_timezone_set($timeset);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'function.php';
echo "       
".color('green',"OUR BUSINESS IS",$sender_setting['color'])." ".color('green',"LIFE ITSELF",$sender_setting['color'])."
".color('red',"PUBLIC SENDER",$sender_setting['color'])."
".color('purple',"FREE FOR ALL",$sender_setting['color'])." 
".color('blue',"UMBRELLA CORP ID",$sender_setting['color'])."
";
echo "\r\n";
$list = file_get_contents('list/'.$mailist['file']) or die("Mailist not found!");
$list = preg_split('/\n|\r\n?/', $list);
if ($mailist['removeduplicate'] == true) {
	$list = array_unique($list);
}
$list = str_replace(" ", '', $list);
$list = preg_grep("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i",
        $list);
$list_total = count($list);
$smtpread = file_get_contents('smtp/'.$smtp) or die("SMTP File not found!");
$smtpread = preg_split('/\n|\r\n?/', $smtpread);

$smtpread=array_values(array_filter($smtpread));

echo color('yellow','You have '.$list_total.' List',$sender_setting['color'])."\r\n";
echo "\r\n";
// $quetionforstart = scrn('Continue ? (y/n) : ', $sender_setting['color']);
// if ($quetionforstart != 'y') {
// 	exit(color('red','Sender is Stop Working',$sender_setting['color'])."\r\n");
// }
echo "\r\n";

$no = 1;
$i=0;
$no_send = 1;
$no_list = 1; 
$email_split = array_chunk($list, $sender_setting['max']);
foreach ($email_split as $key => $e_list) {
	$takeawaysmtp = $smtpread[$i%count($smtpread)];
	$taleawayinbox = $sender_inbox[$i%count($sender_inbox)];
	$takesmtp = explode(',', $takeawaysmtp);
	$tSend = sendMail($e_list,$takeawaysmtp,$sender_setting,$taleawayinbox,$sender_header);
	if ($tSend['status'] == 'ok') {
		$tStatus = color('green','[SENT]',$sender_setting['color']);
	}else{
		$tStatus = color('red','[FAILED] Reason : ',$sender_setting['color']).$tSend['info'];
	}
	echo "\r\n";
	echo "[".color('yellow','+',$sender_setting['color'])."] [".$no_send."/".count($email_split)."]";
	foreach ($e_list as $key2 => $added) {
		echo " ".color('white',$added,$sender_setting['color'])." ".color('cyan','by '. $takesmtp[0],$sender_setting['color'])."";
		echo " ".$tStatus;
	}
	$i++;
	$no_send++;
	sleep($sender_setting['delay']);
}

function sendMail($mailist,$smtp, $sender_setting, $sender_inbox, $sender_header){
		$mail = new PHPMailer(true);                              
		try {
			$getsmtp = explode(',', $smtp);
			$domainn = explode('@', $getsmtp[0]);
		    $mail->SMTPDebug = 0;                                 
		    $mail->isSMTP();                                      
		    $mail->Host = $sender_setting['Host'];
			$mail->Hostname 	= $sender_setting['Hostname'];
		    $mail->SMTPAuth = false;   
		    $mail->SMTPKeepAlive = true;                         
		    $mail->Username = $getsmtp[0];             
		    $mail->Password = $getsmtp[1];                        
		    $mail->SMTPSecure = 'tls';                           
		    $mail->Port = $sender_setting['Port'];
		    $mail->Priority = $sender_setting['priority'];
		    $mail->Encoding = $sender_setting['encoding'];
		    $mail->CharSet = $sender_setting['charset'];
			##daerah fromail
				$sender_inbox['fmail'] = str_ireplace("##randomcuk##", getrandom('jancok') , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = str_ireplace("##randomdong##", getrandom('jembot') , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = str_ireplace("##randomkuy##", getrandom('asw') , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = str_ireplace("##randomdomain##", getrandom('domain') , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = str_ireplace("##trustedfmail##", getrandom('inifm') , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = str_ireplace("##domain##", $domainn[1] , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = str_ireplace("##relay##", $getsmtp[0] , $sender_inbox['fmail']);
				$sender_inbox['fmail'] = random($sender_inbox['fmail']);
				
			##daerah fromname
				$sender_inbox['fname'] = str_ireplace("##randomfname##", getrandom('inifn') , $sender_inbox['fname']);
				$sender_inbox['fname'] = str_ireplace("##randblank1##", getrandom('blank1') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank2##", getrandom('blank2') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank3##", getrandom('blank3') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank4##", getrandom('blank4') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank5##", getrandom('blank5') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank6##", getrandom('blank6') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank7##", getrandom('blank7') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank8##", getrandom('blank8') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank9##", getrandom('blank9') , $sender_inbox['fname']);
        		$sender_inbox['fname'] = str_ireplace("##randblank10##", getrandom('blank10') , $sender_inbox['fname']);
				$sender_inbox['fname'] = random($sender_inbox['fname']);
			
			$domainsmtp = explode('@', $getsmtp[0])[1];
        	$mylength = rand(15,30);
        	$mail->Sender = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),1,$mylength)."@".$domainsmtp;
			$emails = file('fm.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			$randomEmail = $emails[array_rand($emails)];	
		    $mail->setFrom($randomEmail, $sender_inbox['fname']);

			foreach ($mailist as $key) {
				$mail->addAddress($key);
			}
		    
		    if ($sender_setting['header'] == true){
                    foreach ($sender_header as $mheader) {
                        $senderheader = explode("|", $mheader);
                        $senderheader[0] = random($senderheader[0]);
                        $senderheader[1] = random($senderheader[1]);
                        $mail->addCustomHeader($senderheader[0], $senderheader[1]);
                    }
            }
		    if ($sender_inbox['attachfile'] != NULL) {
		    	$mail->addAttachment('attachment/'.$sender_inbox['attachfile'], random($sender_inbox['attachname']));
		    }	

		    	##daerah letter
		    	$link = explode('|', $sender_setting['link']);
		    	$lter = explode('|', $sender_inbox['letter']);
		    	$acak2 = $lter[array_rand($lter)];
		    	$letter = file_get_contents('letter/'.$acak2) or die("Letter not found!");
		    	if ($sender_setting['randomparam'] == true) {
		    		$letter = str_ireplace("##link##", $link[array_rand($link)].'?'.generatestring('mix', 5, 'normal'), $letter);
		    	}else{
		    		$letter = str_ireplace("##link##", $link[array_rand($link)], $letter);
		    	}
		    	
		    	$letter = str_ireplace("##randua##", getrandom('useragent') , $letter);
                $letter = str_ireplace("##randip##", getrandom('ip') , $letter);
                $letter = str_ireplace("##randcountry##", getrandom('country') , $letter);
                $letter = str_ireplace("##randos##", getrandom('os') , $letter);
                $letter = str_ireplace("##device##", getrandom('device') , $letter);
                $letter = str_ireplace("##date##", date('D, F d, Y  g:i A') , $letter);
                $letter = str_ireplace("##date2##", date('D, F d, Y') , $letter);
                $letter = str_ireplace("##date3##", date('F d, Y  g:i A') , $letter);
                $letter = str_ireplace("##date4##", date('F d, Y') , $letter);
				$letter = str_ireplace("##email##", $key , $letter);
        		$letter = str_ireplace("##randblanklet1##", getrandom('blanklet1') , $letter);
        		$letter = str_ireplace("##randblanklet2##", getrandom('blanklet2') , $letter);
        		$letter = str_ireplace("##randblanklet3##", getrandom('blanklet3') , $letter);
       		 	$letter = str_ireplace("##randblanklet4##", getrandom('blanklet4') , $letter);
       			$letter = str_ireplace("##randblanklet5##", getrandom('blanklet5') , $letter);
        		$letter = str_ireplace("##randblanklet6##", getrandom('blanklet6') , $letter);
        		$letter = str_ireplace("##randblanklet7##", getrandom('blanklet7') , $letter);
        		$letter = str_ireplace("##randblanklet8##", getrandom('blanklet8') , $letter);
        		$letter = str_ireplace("##randblanklet9##", getrandom('blanklet9') , $letter);
        		$letter = str_ireplace("##randblanklet10##", getrandom('blanklet10') , $letter);

                $letter = random($letter);

                ##daerah subject
                $sender_inbox['subject'] = str_ireplace("##date##", date('D, F d, Y  g:i A') , $sender_inbox['subject']);
                $sender_inbox['subject'] = str_ireplace("##date2##", date('D, F d, Y') , $sender_inbox['subject']);
                $sender_inbox['subject'] = str_ireplace("##date3##", date('F d, Y  g:i A') , $sender_inbox['subject']);
                $sender_inbox['subject'] = str_ireplace("##date4##", date('F d, Y') , $sender_inbox['subject']);
				$sender_inbox['subject'] = str_ireplace("##randomsubject##", getrandom('inisubject') , $sender_inbox['subject']);
				$sender_inbox['subject'] = str_ireplace("##randblank1##", getrandom('blank1') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank2##", getrandom('blank2') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank3##", getrandom('blank3') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank4##", getrandom('blank4') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank5##", getrandom('blank5') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank6##", getrandom('blank6') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank7##", getrandom('blank7') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank8##", getrandom('blank8') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank9##", getrandom('blank9') , $sender_inbox['subject']);
        		$sender_inbox['subject'] = str_ireplace("##randblank10##", getrandom('blank10') , $sender_inbox['subject']);
                $sender_inbox['subject'] = random($sender_inbox['subject']);
				
				
			//$fakealt = file_get_contents('letter/'.$sender_inbox['alt']);
			//$fakealt = random($fakealt);
			//$bodialt = strip_tags($fakealt);
		    $mail->isHTML(true);    
			//$mail->getMailMIME(true);
		    $mail->AllowEmpty = true;
		    $mail->Subject = $sender_inbox['subject'];
		    $mail->Body    = $letter;
			//$mail->AltBody = $letter;
		    //$mail->AltBody = base64_encode($bodialt);
		    $mail->send();
			$mail->clearAddresses();
		    return array('status' => 'ok', 'info' => '');
		} catch (Exception $e) {
			file_put_contents('log/'.date('D F d Y').".txt", implode("\r\n", $mailist), FILE_APPEND);
			return array('status' => 'bad', 'info' => $mail->ErrorInfo);
		}
}
?>