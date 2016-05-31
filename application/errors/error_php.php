<?php
                $to      = 'dakasadaka@gmail.com';
                $subject = 'last error';
                $message = $severity .' <br />'. $message .' <br />'. $filepath .'<br />'. $line;
                $headers = 'From: webmaster@fenomenalno.com' . "\r\n" .
                'Reply-To: webmaster@fenomenalno.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
                ?>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

</div>
