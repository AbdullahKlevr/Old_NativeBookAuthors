<?php
$title = "Thank You";
?>
<?php
//Popup Form
if (isset($_POST['bannerform'])) {
    $from_email         = $_POST["email"]; 
    $recipient_email    = 'info@nativebookauthors.com'; 
    $subject = "Editing LP | Banner Form" ;
    $sender_name    = filter_var($_POST["cn"], FILTER_SANITIZE_STRING); 
    $reply_to_email = filter_var($_POST["em"], FILTER_SANITIZE_STRING); 
    $number        = filter_var($_POST["pn"], FILTER_SANITIZE_STRING);
    $msg        = filter_var($_POST["Message"], FILTER_SANITIZE_STRING);
    $title        = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
    $pageurl        = filter_var($_POST["pageurl"], FILTER_SANITIZE_STRING);
    $ip = $_POST['ip'];
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From:".$from_email."\r\n"; 
        $headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
        $headers .= "BCC: ,";
		$body .= "\n Name: " . $sender_name . "<br/>";
		$body .= "\n Email: " . $reply_to_email . "<br/>"; 
		$body .= "\n Contact Number: " . $number . "<br/>";
		$body .= "\n Message: " . $msg . "<br/>";
		$body .= "\n Page Url: " . $pageurl . "<br/>";
		$body .= "\n IP Address: " . $ip . "<br/>";
		$body .= "\n City: " . $details->city;
        $body .= "$boundary\r\n";
    $success = @mail($recipient_email, $subject, $body, $headers);
}

//Contact Form
if (isset($_POST['signupForm'])) {
    $from_email         = $_POST["email"]; 
    $recipient_email    = 'info@nativebookauthors.com'; 
    $subject = "Editing LP | POPUP FORM" ;
    $sender_name    = filter_var($_POST["popname"], FILTER_SANITIZE_STRING); 
    $reply_to_email = filter_var($_POST["popemail"], FILTER_SANITIZE_STRING); 
    $contact        = filter_var($_POST["popnumber"], FILTER_SANITIZE_STRING);
    $message        = filter_var($_POST["popmessage"], FILTER_SANITIZE_STRING);
    $title        = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
    $pageurl        = filter_var($_POST["pageurl"], FILTER_SANITIZE_STRING);
    $ip = $_POST['ip'];
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From:".$from_email."\r\n"; 
        $headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
        $headers .= "BCC: ,";
		$body .= "\n Name: " . $sender_name . "<br/>";
		$body .= "\n Email: " . $reply_to_email . "<br/>"; 
		$body .= "\n Contact Number: " . $contact . "<br/>";
		$body .= "\n Message: " . $message . "<br/>";
		$body .= "\n Page Url: " . $pageurl . "<br/>";
		$body .= "\n IP Address: " . $ip . "<br/>";
		$body .= "\n City: " . $details->city;
        $body .= "$boundary\r\n";
    $success = @mail($recipient_email, $subject, $body, $headers);
}


if (isset($success) && $success) { 
?>


<html class="no-js" lang="en">
<head>
<title>Thank You</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="./favicon.png" type="image/x-icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<section class="error-page onepage-screen-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                            <h4 class="thakyouhead"> Thank You <?php echo $sender_name; ?></h4>
                            <p>We can already envision a bright future ahead for you. Our customer support team will be in contact with you shortly. Now that you have sown the seeds of your success, we’ll ripen your fruit of prosperity.</p>
                            <a href="../" class="axil-btn btn-fill-primary">Go Back To Home</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                            <img src="thankyou.png" alt="404">
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php }
else 
{
?>
<H1>Your Request Can Not Be Submit. Please Try Again...</H1>
<?php }
?>
<style>
.thumbnail {border: 1px solid #e86236;}
.content p { font-size: 20px; line-height: 40px; margin-bottom: 25px; }h4.thakyouhead { font-size: 30px; margin: 20px 0px 20px; font-weight: 600; border-bottom: 2px solid #e86236; line-height: 1; padding-bottom: 10px; display: inline-block; }.onepage-screen-area {margin-top: 0px;padding: 0px 0 50px;}a.axil-btn.btn-fill-primary {border: none;box-shadow: none;padding: 13px 28px;border-radius: 5px;outline: none;letter-spacing: 1px;text-transform: uppercase;font-size: 17px; display: inline-block;margin: 0 auto!important;height: auto;color: #fff;font-weight: 600;background: linear-gradient(to right,#e86236 , #e86236);text-decoration: none;}.content {overflow: inherit;}.onepage-screen-area {position: relative;z-index: 1;background: var(--gradient-primary);min-height: 500px;height: 100vh;padding: 150px 0;display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-box-align: center;-webkit-align-items: center;-ms-flex-align: center;align-items: center;overflow: hidden;}
</style>
</body>
</html>
