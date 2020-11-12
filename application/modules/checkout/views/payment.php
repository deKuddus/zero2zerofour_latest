<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function redirect_to_merchant($url) {

    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head><script type="text/javascript">
        function closethisasap() { document.forms["redirectpost"].submit(); }
      </script></head>
      <body onLoad="closethisasap();">
        <h4 class="text-center" style="font-size: 20px;color: #435061">You are redirecting to payment page ...</h4>
        <form name="redirectpost" method="post" action="<?php echo 'https://secure.aamarpay.com/' . $url; ?>"></form>
      </body>
    </html>
    <?php
exit;
}

$url           = 'https://secure.aamarpay.com/request.php';
$fields_string = '';
foreach ($fields as $key => $value) {$fields_string .= $key . '=' . $value . '&';}
$fields_string = rtrim($fields_string, '&');
$ch            = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
curl_close($ch);

redirect_to_merchant($url_forward);