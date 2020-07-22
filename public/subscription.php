<?php

$bot = require_once __DIR__ . '/../bootstrap/bot.php';

$bot->subscription->create([
    'content'       => 'A dummy midnight text. Disregard if being notified.',
    'to_channel'    => 1,
    'unique_id'     => '1181561681941300',
    'send_limit'    => 1
])->send();

// Done. Print message to the browser
dd('Notification sent!');