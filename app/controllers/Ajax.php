<?php
class Ajax extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['subject']) && isset($_POST['message'])) {
            $name = trim($_POST['name']);
            $subject = trim($_POST['subject']);
            $mailFrom = trim($_POST['mail']);
            $message = trim($_POST['message']);

            $mailTo = "info@officiallife.com";
            $headers = "From: " . $mailFrom;
            $txt = "You have received an e-mail from " . $name . ".\n\n" . $message;


            if (empty($name)) {
                echo "Please enter your name";
            } elseif (empty($mailFrom)) {
                echo "Please your email";
            } elseif (empty($subject)) {
                echo "Please the subject";
            } elseif (empty($message)) {
                echo "Please enter your message";
            } elseif (!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)) {
                echo "Enter proper e-mail!";
            } else {

                //create main functions
                mail($mailTo, $subject, $txt, $headers);
                echo "Thank you for contacting us";
            }
        }
    }
}
