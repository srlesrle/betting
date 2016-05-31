<?php
class MY_Log extends CI_Log {

    function MY_Log(){

        parent::__construct();

    }

    function write_log($level = 'error', $msg, $php_error = FALSE){

        $result = parent::write_log($level, $msg, $php_error);

        if ($result == TRUE && strtoupper($level) == 'ERROR') {

            $message = "An error occurred: \n\n";
            $message .= $level.' - '.date($this->_date_fmt). ' --> '.$msg."\n";

            $this->CI =& get_instance();
            $to = $this->CI->config->item('dakanadaka@gmail.com');
            $from_name = $this->CI->config->item('Webmaster Error fenom');
            $from_address = $this->CI->config->item('webmaster@fenomenalno.com');

            $subject = 'An error has occured';
            $headers = "From: $from_name <$from_address>" . "\r\n";
            $headers .= 'Content-type: text/plain; charset=utf-8\r\n';

            mail($to, $subject, $message, $headers);

        }

        return $result;

    }
}
?>
