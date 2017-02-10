<?php

//php mail发送邮件和多个附件
//先安装sendmail

$from = 'admin@admin.com';
$to = ['aa.aa@aa.com','bb.bb@bb.com'];

// 定义分界线 
$boundary = time(); //分界线是一串无规律的字符
//设置header

$header = "Content-type: multipart/mixed; boundary= {$boundary}\r\n";
$header .= "From:{$from}\r\n";

$file1 = 'a.jpg';
$fp1 = fopen($file1, "rb"); //打开文件
$read1 = fread($fp1, filesize($file1)); //读入文件
$read1 = base64_encode($read1); //base64编码 
$read1 = chunk_split($read1); //切割字符串

$file2 = 'b.jpg';
$fp2 = fopen($file2, "rb"); //打开文件
$read2 = fread($fp2, filesize($file2)); //读入文件
$read2 = base64_encode($read2); //base64编码 
$read2 = chunk_split($read2); //切割字符串

$file3 = 'c.jpg';
$fp3 = fopen($file3, "rb"); //打开文件
$read3 = fread($fp3, filesize($file3)); //读入文件
$read3 = base64_encode($read3); //base64编码 
$read3 = chunk_split($read3); //切割字符串

$file4 = 'd.txt';
$fp4 = fopen($file4, "rb"); //打开文件
$read4 = fread($fp4, filesize($file4)); //读入文件
$read4 = base64_encode($read4); //base64编码 
$read4 = chunk_split($read4); //切割字符串

$msg = "测试邮件内容";

//建立邮件的主体，分为邮件内容和附件内容两部分
$body = "--{$boundary}
Content-type: text/html; charset=utf-8
Content-transfer-encoding: 7bit\n
{$msg}
--{$boundary}
Content-type: application/octet-stream; name={$file1}
Content-disposition: attachment; filename={$file1}
Content-transfer-encoding: base64\n
{$read1}
--{$boundary}
Content-type: application/octet-stream; name={$file2}
Content-disposition: attachment; filename={$file2}
Content-transfer-encoding: base64\n
{$read2}
--{$boundary}
Content-type: application/octet-stream; name={$file3}
Content-disposition: attachment; filename={$file3}
Content-transfer-encoding: base64\n
{$read3}
--{$boundary}
Content-type: application/octet-stream; name={$file4}
Content-disposition: attachment; filename={$file4}
Content-transfer-encoding: base64\n
{$read4}
--{$boundary}--
";

echo $body;

//发送邮件 并输出是否发送成功的信息
foreach ($to as $mail) {
	if (mail($mail, 'test', $body, $header)) {
	    echo "信件发送成功";
	} else {
	    echo "信件发送失败";
	}
}


/*上面是一个，下面是多个*/


//$from = 'admin@admin.com';
//$to = 'jianling.tan@fengjr.com';
//
//// 定义分界线 
//$boundary = time(); //分界线是一串无规律的字符
////设置header
//$header = "From:{$from}\r\n";
//$header .= "Content-type: multipart/mixed; boundary= {$boundary}\r\n";
//
//$file1 = 'a.jpg';
//$fp1 = fopen($file1, "rb"); //打开文件
//$read1 = fread($fp1, filesize($file1)); //读入文件
//$read1 = base64_encode($read1); //base64编码 
//$read1 = chunk_split($read1); //切割字符串
//
//$file2 = 'b.jpg';
//$fp2 = fopen($file2, "rb"); //打开文件
//$read2 = fread($fp2, filesize($file2)); //读入文件
//$read2 = base64_encode($read2); //base64编码 
//$read2 = chunk_split($read2); //切割字符串
//
//$file3 = 'c.jpg';
//$fp3 = fopen($file3, "rb"); //打开文件
//$read3 = fread($fp3, filesize($file3)); //读入文件
//$read3 = base64_encode($read3); //base64编码 
//$read3 = chunk_split($read3); //切割字符串
//
//$msg = "测试邮件内容";
//
////建立邮件的主体，分为邮件内容和附件内容两部分
//$body = "
//Content-type: text/plain; charset=iso-8859-1
//Content-transfer-encoding: 7bit
//--{$boundary}\n
//{$msg}\n
//--{$boundary}\n
//Content-type: application/octet-stream; name={$file1}\n
//Content-disposition: attachment; filename={$file1}\n\n
//Content-transfer-encoding: base64\n
//{$read1}\n
//--{$boundary}\n
//Content-type: application/octet-stream; name={$file2}\n
//Content-disposition: attachment; filename={$file2}\n\n
//Content-transfer-encoding: base64\n
//{$read2}\n
//--{$boundary}\n
//Content-type: application/octet-stream; name={$file3}\n
//Content-disposition: attachment; filename={$file3}\n\n
//Content-transfer-encoding: base64\n
//{$read3}\n
//--{$boundary}--\n
//";
//
//echo $body;
//
////发送邮件 并输出是否发送成功的信息
//if (mail($to, 'test', $body, $header)) {
//    echo "信件发送成功";
//} else {
//    echo "信件发送失败";
//}


//class Util_CCMail{
//    protected $mime_boundary;
//    protected $part_boundary;
//    protected $headers;
//    protected $subject;
//    protected $sendto;
//    protected $sendfrom;
//    protected $message;
//    protected $mimetype;
//    protected $plaintype;
//    protected $charset;
//
//    /**
//     * 初始化
//     * subject 主题
//     * sendto 要送达的用户
//     * sendfrom 发送用户
//     * message 邮件主题
//     * filename 附件文件名
//     * downname 附件下载的名称
//     * mimetype minme的类型
//     */
//    public function __construct($subject,$sendto,$sendfrom,$message,$filename = '',$downname = '',$mimetype='application/octet-stream',$plaintype='text/html',$charset='utf-8'){
//        $semi_rand = md5(time());
//        $this->mime_boundary = "==Mix_Multipart_Boundary_x{$semi_rand}x";
//        $this->part_boundary = "==Alt_Multipart_Boundary_x{$semi_rand}x";
//        $this->subject = $subject;
//        $this->sendto = $sendto;
//        $this->sendfrom = $sendfrom;
//        $this->message = $message;
//        $this->mimetype = $mimetype;
//        $this->plaintype = $plaintype;
//        $this->charset   = $charset;
//        $this->headers = $this->writeMimeHeader($this->sendfrom);
//        $this->message = $this->writeBody($this->message);
//        if(!empty($filename)){
//            $filedata = $this->encodeFile($filename);
//            $this->message .= $this->attachFile($filename,$filedata,$downname);
//        }
//    }
//    /**
//     *头信息
//     */
//    public function writeMimeHeader($sendform){
//        $out  = "From: ".$sendform;
//        $out .= "\nMIME-Version: 1.0\n";
//        $out .= "Content-Type: multipart/mixed;\n";
//        $out .= " boundary=\"{$this->mime_boundary}\"";
//        return $out;
//    }
//    /**
//     * body信息
//     */
//    public function writeBody($msgtext) {
//        $out = "--" . $this->mime_boundary . "\n";
//        $out = $out . "Content-Type: ".$this->plaintype."; charset=\"".$this->charset."\"\n\n";
//        $out = $out . $msgtext . "\n";
//        return $out;
//    }
//
//    /**
//     * 附件流
//     */
//    public function encodeFile($sourcefiles){
//        $encoded = [];
//        if(!empty($sourcefiles)){
//            $sourcefiles = !is_array($sourcefiles) ? array($sourcefiles) : $sourcefiles;
//            foreach($sourcefiles as $key=>$sourcefile){
//                if(empty($sourcefile)) continue;
//                if (is_readable($sourcefile)) {
//                    $fd = fopen($sourcefile, "rb");
//                    $contents = fread($fd, filesize($sourcefile));
//                    $encoded[] = chunk_split(base64_encode($contents));
//                    fclose($fd);
//                }
//            }
//        }
//
//        return $encoded;
//    }
//
//    /**
//     * 添加附件
//     */
//    public function attachFile($filename,$filedata,$downname= array()){
//        $email_message = "";
//        if(!empty($filename)){
//            $filename = !is_array($filename) ? array($filename) : $filename;
//            $email_message .= "--{$this->mime_boundary}\n";
//            $email_message .= "Content-Type: multipart/alternative; boundary=\"{$this->part_boundary}\"\n";
//            /*
//            $email_message .= "\n\n"."--{$this->part_boundary}\n" ;
//            $email_message .= "Content-Type:text/plain; charset=\"iso-8859-1\"\n";
//            $email_message .= "Content-Transfer-Encoding: 7bit\n\n";
//            $email_message .= "\n\n"."--{$this->part_boundary}\n";
//            $email_message .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
//            $email_message .= "Content-Transfer-Encoding: 7bit\n\n";
//            */
//            $email_message .= "--{$this->part_boundary}--\n";
//            foreach($filename as $key=>$file){
//                if(empty($file)) continue;
//                $file_temp_name  = strrchr($file,'/');
//                $down_link = empty($file_temp_name) ? $file : ltrim($file_temp_name,'/');
//                $download_name = isset($downname[$key]) ? $downname[$key] : $down_link;
//                $email_message .= "--{$this->mime_boundary}\n";
//                $email_message .= "Content-Type: {$this->mimetype};\n";
//                $email_message .= " name=\"{$download_name}\"\n";
//                $email_message .= "Content-Transfer-Encoding: base64\n\n" ;
//                $email_message .= $filedata[$key] . "\n\n";
//            }
//            $email_message .= "--{$this->mime_boundary}--\n";
//        }
//        return $email_message;
//    }
//
//    /**
//     *邮件发送
//     */
//    public function sendFile(){
//        //$this->subject = "=?UTF-8?B?" . base64_encode($this->subject) . "?=";
//        echo $this->message;
//        $ok = mail($this->sendto, $this->subject, $this->message, $this->headers, $this->sendfrom);
//        return $ok;
//    }
//}
//
//$subject = "subject";
//
////收件人
//$sendto = 'jianling.tan@fengjr.com';
//
////發件人
//$replyto = 'admin@admin.com';
//
////內容
//$message = "测试邮件内容";
//
////附件
//$filename = ['a.jpg'];
//
////附件類別
////$mimetype = ["image/jpeg","image/jpeg"];
//
//$excelname = ['a.jpg'];
//
//$mailfile = new Util_CCMail($subject,$sendto,$replyto,$message,$filename,$excelname);
////$mailfile = new Util_CCMail($subject,$sendto,$replyto,$message);
//$mailfile->sendFile();