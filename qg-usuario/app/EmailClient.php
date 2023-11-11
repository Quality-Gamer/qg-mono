<?php

namespace App;
require_once('../vendor/autoload.php');

use Illuminate\Database\Eloquent\Model;
use Postmark\PostmarkClient;

class EmailClient extends Model {
    protected $table = 'test';

    public function sendEmail($to,$subject,$html,$text) {
        $client = new PostmarkClient("92f6a1d3-ea3d-4776-92c1-7c8142cade1c");
        $fromEmail = "iagoagualuza@id.uff.br";
        $toEmail = $to;
        $subject = $subject;
        $htmlBody = $html;
        $textBody = $text;
        $tag = "email-tag";
        $trackOpens = true;
        $trackLinks = "None";
        $messageStream = "outbound";

        // Send an email:
        $sendResult = $client->sendEmail(
        $fromEmail,
        $toEmail,
        $subject,
        $htmlBody,
        $textBody,
        $tag,
        $trackOpens,
        NULL, // Reply To
        NULL, // CC
        NULL, // BCC
        NULL, // Header array
        NULL, // Attachment array
        $trackLinks,
        NULL, // Metadata array
        $messageStream
        );
    }

}
