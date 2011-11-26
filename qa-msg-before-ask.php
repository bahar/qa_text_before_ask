<?php

class qa_msg_before_ask {

    function allow_template($template) {
        return ($template == 'ask');
    }

    function allow_region($region) {
        return ($region == 'main');
    }

    function admin_form(&$qa_content) {
        $ok = null;

        if (qa_clicked('pre_msg_save_button')) {
            qa_opt('msg_before_ask', qa_post_text('msg_before_ask'));
            qa_opt('msg_before_ask_css', qa_post_text('msg_before_ask_css'));
            qa_opt('disable_msg_before_ask', (bool) qa_post_text('disable_msg_before_ask'));
            $ok = qa_lang('admin/options_saved');
        }

        $fields = array();

        $fields[] = array(
            'label' => 'Custom CSS for the message',
            'tags' => 'NAME="msg_before_ask_css"',
            'value' => qa_opt('msg_before_ask_css'),
            'type' => 'textarea',
            'rows' => 10
        );

        $fields[] = array(
            'label' => 'Message to show before question asking:',
            'value' => qa_html(qa_opt('msg_before_ask')),
            'tags' => 'NAME="msg_before_ask"',
            'type' => 'textarea',
            'rows' => '25',
            'note' => 'Example Message: <a href="http://googlewebmastercentral.blogspot.com/2010/09/tips-for-getting-help-with-your-site.html" target="_blank">Google tips for getting help</a',
        );
        $fields[] = array(
            'label' => 'Disable showing message before asking questions:',
            'value' => qa_opt('disable_msg_before_ask'),
            'tags' => 'NAME="disable_msg_before_ask"',
            'type' => 'checkbox',
        );


        return array(
            'ok' => ($ok && !isset($error)) ? $ok : null,
            'fields' => $fields,
            'buttons' => array(
                array(
                    'label' => 'Save Message',
                    'tags' => 'NAME="pre_msg_save_button"',
                )
            ),
        );
    }

    function output_widget($region, $place, $themeobject, $template, $request, $qa_content) {
        $themeobject->output('<DIV STYLE="font-size:150%; line-height:150%;">');
        $this->output_count($themeobject, qa_opt('cache_qcount'), 'main/1_question', 'main/x_questions');
        $themeobject->output('<BR/>');
        $this->output_count($themeobject, qa_opt('cache_acount'), 'main/1_answer', 'main/x_answers');
        $themeobject->output('<BR/>');
        $this->output_count($themeobject, qa_opt('cache_ccount'), 'main/1_comment', 'main/x_comments');
        $themeobject->output('<BR/>');
        $this->output_count($themeobject, qa_opt('cache_userpointscount'), 'main/1_user', 'main/x_users');
        $themeobject->output('</DIV>');
    }

    function output_count($themeobject, $value, $langsingular, $langplural) {
        if ($value == 1)
            $themeobject->output(qa_lang_html_sub($langsingular, '<B>1</B>', '1'));
        else
            $themeobject->output(qa_lang_html_sub($langplural, '<B>' . number_format((int) $value) . '</B>'));
    }

}

?>
