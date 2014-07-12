<?php

class SwiftEmail 
{
    private static $env = [];

    public static function bootstrap()
    {
        $config = include dirname(__FILE__) . '/../email_settings.php';
        self::$env = $config['email'];
    }

    public static function get_message($from, $to, $subject = '', $content = '')
    {
        $message = Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setCharset('utf-8')
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($content);

        return $message;
    }

    public static function get_mailer()
    {
        $transport = Swift_SmtpTransport::newInstance(
            self::$env['host'],
            self::$env['port'],
            self::$env['security']
        )->setUsername(self::$env['username'])
         ->setPassword(self::$env['password']);

        $mailer = Swift_Mailer::newInstance($transport);

        return $mailer;
    }
}
