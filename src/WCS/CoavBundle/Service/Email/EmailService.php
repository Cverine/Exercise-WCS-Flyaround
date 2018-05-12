<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 14/12/17
 * Time: 16:38
 */

namespace WCS\CoavBundle\Service\Email;


class EmailService
{
    const MAIL_FROM = "severinelab@gmail.com";

//    const TYPE_MAIL_NEW_USER = [
//        'key' => 1,
//        'renderHtml' => 'email/newUser.html.twig',
//        'renderTxt' => 'email/newUSer.txt.twig',
//    ];
//    const TYPE_MAIL_CONFIRM_PASSWORD = [
//        'key' => 2,
//        'renderHtml' => 'email/password.html.twig',
//        'renderTxt' => 'email/password.txt.twig',
//    ];

    protected $mailer;

    protected $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail($mail)
    {
        $message = \Swift_Message::newInstance()
            ->setTo($mail['to'])
            ->setCharset('utf-8')
            ->setFrom(self::MAIL_FROM);

        switch ($mail['type']) {
            case self::TYPE_MAIL_NEW_USER['key']:
                $message->setSubject($mail['Bienvenue chez FlyAround !']);
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_NEW_USER['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_NEW_USER['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;


            case self::TYPE_MAIL_CONFIRM_PASSWORD['key']:
                $message->setSubject("Confirmation du changement de votre mot de passe");
                $message->setBody(
                    $this->twig->render(self::TYPE_MAIL_CONFIRM_PASSWORD['renderHtml'], [
                            'message' => $mail['message'],
                        ]
                    ), 'text/html');
                $message->addPart(
                    $this->twig->render(self::TYPE_MAIL_CONFIRM_PASSWORD['renderTxt'], [
                        'message' => $mail['message'],
                    ]), 'text/plain');
                break;

            default:
                /** ET C'EST LE BUG */
                break;
        }
        $this->mailer->send($message);
    }
}