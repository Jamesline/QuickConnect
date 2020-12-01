<?php
 include_once "vendor/autoload.php";
 /*
  * Create the body of the message (a plain-text and an HTML version).
  * $text is your plain-text email
  * $html is your html version of the email
  * If the receiver is able to view html emails then only the html
  * email will be displayed
  */
 $text = "Thank you for your request\nA super member of the Cluster Reply team will contact shortly.\n";
 $html = "<html>
       <head></head>
       <body>
           <pThank you for your request<br>
           A member of the Cluster Reply team will contact shortly.<br>
           </p>
       </body>
       </html>";
 // This is your From email address
 $from = array('info.cluster.uk@reply.com' => 'Cluster Reply Info');
 // Email recipients
 $to = array(
       'a.james@reply.eu'=>'Destination 1 Name',
       'admin@jamesline'=>'Destination 2 Name'
 );
 // Email subject
 $subject = 'Info Request';

 // Login credentials
 $username = 'apikey';
 $password = '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';

 // Setup Swift mailer parameters
 $transport = (new Swift_SmtpTransport('smtp.sendgrid.net', 587));
 $transport->setUsername($username);
 $transport->setPassword($password);
 $swift = (new Swift_Mailer($transport));

 // Create a message (subject)
 $message = new Swift_Message($subject);

 // attach the body of the email
 $message->setFrom($from);
 $message->setBody($html, 'text/html');
 $message->setTo($to);
 $message->addPart($text, 'text/plain');

 // send message
 if ($recipients = $swift->send($message, $failures))
 {
     // This will let us know how many users received this message
     echo 'Message sent out to '.$recipients.' users';
 }
 // something went wrong =(
 else
 {
     echo "Something went wrong - ";
     print_r($failures);
 }