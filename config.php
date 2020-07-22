<?php

return [
  /*
   |------------------------------------------------------------------------
   | Page Access Token
   |------------------------------------------------------------------------
   |
   | Please provide your page access token for Giga.
   |
   */

  'page_access_token' => 'EAAIkxYStYngBANj9gKbIquc2WiAQsjU6dEvkGMoSmka8PxXu5RWk6vnM5bF8DGyhYk4zJY7ac8WjGWIaNoVhoYb8ZAxuGPptzorXCHefwiRcX3rJfwVjJ0xqd9ZCDJzrPcisfkyCJUptkH3ciTblK2vkonDvc9aQ9vgdrkzAZDZD',

  /*
   |------------------------------------------------------------------------
   | Page ID
   |------------------------------------------------------------------------
   |
   | Please provide your page id for Giga.
   |
   */

  'page_id' => '1587168904646042',

  /*
   |------------------------------------------------------------------------
   | Cache path
   |------------------------------------------------------------------------
   |
   | Please provide your cache directory for Giga. The cache directory should
   | be read-writable.
   |
   */

  'cache_path' => __DIR__ . '/cache/',

  /*
   |------------------------------------------------------------------------
   | Storage Driver
   |------------------------------------------------------------------------
   |
   | Currently, only accepts `mysql`
   |
   */

  'storage_driver' => 'mysql',

    /*
   |------------------------------------------------------------------------
   | MySQL Connection Configuration
   |------------------------------------------------------------------------
   |
   | If storage driver is `mysql`, set connection here
   |
   */
    'mysql' => [
        'host'      => 'localhost',
        'database'  => 'bini1010_ordering_system',
        'username'  => 'bini1010_admin',
        'password'  => '{}+u@#xvguT.',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],

    /*
     |------------------------------------------------------------------------
     | App ID
     |------------------------------------------------------------------------
     |
     | Please provide your Facebook App ID
     |
     */

  'app_id' => '603380706534008',

  /*
   |------------------------------------------------------------------------
   | Auto stop feature
   |------------------------------------------------------------------------
   |
   | Auto stop bot when Page's administrators response. Page's administrators
   | can turn bot back again by sending :)
   |
   */

  'auto_stop' => [
      'stop_when'     => '*',
        'restart_when'  => ':)'
    ],

  /*
   |------------------------------------------------------------------------
   | Cache offset
   |------------------------------------------------------------------------
   |
   | By default, bot automatically collects people info and store it
   | to database. This setting helps you set cache offset (in minutes)
   | for that info.
   |
   | Default: 10080 minutes
   |
   */

  'cache_offset' => 10080,


  /*
   |------------------------------------------------------------------------
   | Greeting Text
   |------------------------------------------------------------------------
   |
   | The Greeting Text is only rendered the first time the user interacts
   | with a the Page on Messenger. You can set it here.
   |
   | @see https://developers.facebook.com/docs/messenger-platform/thread-settings/greeting-text
   |
   */

  'greeting_text' => 'Welcome to Pizza Prototype! Your one stop online automated pizza ordering system',

  /*
   |------------------------------------------------------------------------
   | Get Started Button
   |------------------------------------------------------------------------
   |
   | The Get Started button is only rendered the first time the user interacts
   | with a the Page on Messenger. You can set it here.
   |
   | Note that you'll only need to enter button payload, in string.
   | To response people when they click Get Started Button. Simply use:
   |
   | $bot->answer('payload:GIGA_GET_STARTED_PAYLOAD', 'Your message');
   |
   | @see https://developers.facebook.com/docs/messenger-platform/thread-settings/get-started-button
   |
   */

  'get_started_button_payload' => 'GIGA_GET_STARTED_PAYLOAD',

  /*
   |------------------------------------------------------------------------
   | Persistent Menu.
   |------------------------------------------------------------------------
   |
   | The Persistent Menu is a menu that is always available to the user.
   | This menu should contain top-level actions that users can enact at any point.
   | Having a persistent menu easily communicates the basic capabilities of
   | your bot for first-time and returning users.
   |
   | The menu can be invoked by a user, by tapping on the 3-caret icon on the left of the composer.
   |
   | Please enter array of buttons for this value.
   |
   | @see https://developers.facebook.com/docs/messenger-platform/thread-settings/persistent-menu
   |
   */

    'persistent_menu' => [
        [
            'type'      => 'postback',
            'title'     => 'Get Started',
            'payload'   => 'GIGA_GET_STARTED_PAYLOAD'
        ],
        [
          'type' => 'postback',
          'title' => 'Show Orders',
          'paylaod' => 'SHOW_ORDERS_PAYLOAD'
        ],
        [
          'type' => 'postback',
          'title' => 'Clear Orders',
          'payload' => 'CLEAR_ORDERS_PAYLOAD'
        ]
    ],


    'whitelisted_domains' => [
        // Example: 'https://giga.ai'
    ],

    'account_linking_url' => 'YOUR_LOGIN_FORM_URL',
];