<?php
/**
 * ------------------------------------------------------------------------------------------------------------
 * |                                      ACCOUNT LINKING GUIDE
 * -------------------------------------------------------------------------------------------------------------
 * This is guide for Account Linking. It doesn't works by default because it need to integrate with your existing
 * login system.
 * You have to read and copy/edit file content to match with your system.
 *
 * Attention: Whilst it need to integrate with your existing system. This required more PHP knowledge than other
 * features.
 */

/**
 * From your login form controller. Include the bootstrap file. You should change the path to correct /bootstrap/bot.php
 *
 * @var  $bot
 */
$bot = require_once __DIR__ . '/../bootstrap/bot.php';

/**
 * In your login form controller, you should require add this to get received data from Facebook.
 * Because in Account Linking process. Facebook will open a window with `redirect_uri` URL parameter so we need to grab
 * that value to redirect back when login success or error.
 */
$data = \GigaAI\Http\Request::getReceivedData();

/**
 * If leads logged in your website successfully. You should redirect to Messenger. The $login_status is pseudo code.
 * Just to assume that lead logged in your website successfully.
 */
if ($login_status === 'success') {
    // Of course, when lead logged in, you'll have that user id, this is User ID of lead in your website
    $user_id = 1;
    
    // Redirect back to Messenger. You should add `authorization_code` parameter, with value formatted as:
    // user_id:{$user_id}
    header('location:' . $data['redirect_uri'] . '&authorization_code=user_id:' . $user_id);
    exit;
}

// Assume that user login failed
if ($login_status === 'failed') {
    // Just redirect back to Messenger without `authorization_code` parameter.
    header('location:' . $data['redirect_uri']);
    exit;
}