<?php

return array(
        "listing"=>'Facebook|Google|Dropbox|Twitter',
        "base_url" => "http://cad.qeria.com/hybridauth",
        "providers" => array (
            "OpenID" => array (
                "enabled" => true
            ),

            "Facebook" => array (
                "enabled" => true,
                "keys" => array ( "id" => "183393598532429", "secret" => "1fc35b1f9e134ebd7b5a79fe84cde1cf" ),
                "scope" => " email, user_online_presence, friends_online_presence, user_about_me, user_birthday", // optional
                "display" => "popup"
            ),
            "Google" => array (
                "enabled" => true,
                "keys" => array ( "id" => "162841244135.apps.googleusercontent.com", "secret" => "UQiyyhdenqzSehjtyySJPh6j" ),
                "scope" => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                "https://www.googleapis.com/auth/userinfo.email" , // optional
                "access_type" => "offline", // optional
                "approval_prompt" => "force", // optional
                // "hd" => "domain.com",//Optional
                ),
            "Twitter" => array ( // 'key' is your twitter application consumer key
                "enabled" => true,
                "keys" => array ( "key" => "S39auf5Do7el5aTzhSVTCg", "secret" => "qO9x8wRaNPp9eBQMfJR5A78EnAbZSbj0d9E1t3VxKI" )
            ),

            ),
);