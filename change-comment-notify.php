<?php
/*
Plugin Name: Change Comment Notify email
Plugin URI: http://www.ip2country.cc/coments/
Description: This plugin change the Comment Notify message so that you'll get a link to verify the commenter's country before approving the comment. This is useful to prevent comments spam.
Version: 1.0.2
Author: Andrey Shipilov
Author URI: 
*/

/**
* Plugin main class
**/
class Change_Comment_Notify {

    function Change_Comment_Notify() {
        __construct();
    }

	/**
	 * PHP 5 constructor
	 **/
	function __construct() {
        add_filter( 'comment_moderation_text', array( &$this, 'change_notify_text' ), 99, 2 );
        add_filter( 'comment_notification_text', array( &$this, 'change_notify_text' ), 99, 2 );
	}

    /**
     * Change notify text
     **/
    function change_notify_text( $notify_text, $comment_id ) {
        $comment = get_comment( $comment_id );  
        $line = "Country : http://www.ip2country.cc/?s=wp&q=" . $comment->comment_author_IP . "\r\nWhois";
        $notify_text = str_replace( 'Whois', $line, $notify_text );
        return $notify_text;
    }

}

$change_comment_notify =& New Change_Comment_Notify;
?>
