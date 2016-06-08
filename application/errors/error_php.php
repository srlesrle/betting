<?php
                $to      = 'xxxx@gmail.com';
                $subject = 'last error';
                $message = $severity .' <br />'. $message .' <br />'. $filepath .'<br />'. $line;
                $headers = 'From: xxxx@gmail.com' . "\r\n" .
                'Reply-To: xxxx@gmail.com' . "\r\n" .
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
