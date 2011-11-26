<?php

/*
	Plugin Name: Message Before Asking Questions
	Plugin URI: https://github.com/bahar/qa_text_before_ask
	Plugin Description: Provides a way to include a predefined message/guideline to show before asking a question
	Plugin Version: 1.0b1
	Plugin Date: 2011-11-30
	Plugin Author: Bahar
	Plugin Author URI: http://askbahar.com
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.4
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}


	qa_register_plugin_module('widget', 'qa-msg-before-ask.php', 'qa_msg_before_ask', 'Message To Show Before Asking Questions');
	qa_register_plugin_layer('qa-msg-layer.php', 'Message Before Ask Layer');	

/*
	Omit PHP closing tag to help avoid accidental output
*/