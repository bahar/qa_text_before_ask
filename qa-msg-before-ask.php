<?php

class qa_msg_before_ask {

    function allow_template($template) {
        return ($template == 'ask');
    }

    function allow_region($region) {
        return ($region == 'main');
    }

    function option_default($option) {
	    switch($option) {
            case 'msg_before_ask_label':
                return 'thanks, I will keep these tips in mind when asking';
            case 'msg_before_ask':
                return '<h1>Welcome to our support desk</h1>
<p>We&rsquo;d love to help you. But not every question on our Support Desk gets answered. To <strong>improve your chances</strong>, here are some tips:</p>
<h2>Do your homework</h2>
<br />
<p>Have you <b>thoroughly searched for an answer</b> <i>before</i> asking your question? Sharing your research helps everyone. Tell us what you found and why it didn&rsquo;t meet your needs. This demonstrates that you&rsquo;ve taken the time to try to help yourself, it saves us from reiterating obvious answers, and most of all it helps <i>you</i> get a more specific and relevant answer!</p>
<h2>Be specific</h2>
<br />
<p>If you ask a vague question, you&rsquo;ll get a vague answer. But if you give us details and context, we can provide a <i>useful</i> answer.</p>
<h2>Make it relevant to others</h2>
<p>We like to help as many people at a time as we can. Make it clear how your question is relevant to more people than just you, and more of us will be interested in your question and willing to look into it.</p>
<h2>Be on-topic</h2>
<br />
<p>Our support desk is defined by a specific set of topics in <a href="faq">the faq</a>; please try to stick to those topics. If your question is about the site itself, provide us <a href="http://thesixdegree.com/support/feedback">feedback</a>.</p>
<h2>Keep an open mind</h2>
<br />
<p>The answer to your question may not always be the one you wanted, but that doesn&rsquo;t mean it is wrong. A conclusive answer isn&rsquo;t always possible. When in doubt, ask people to cite their sources, or to explain how/where they learned something. Even if we don&rsquo;t agree with you, or tell you exactly what you wanted to hear, remember &ndash; we&rsquo;re just trying to help.</p>
<br />
<br />';
            case 'msg_before_ask_proceed':
                return 'proceed';
            default:
                return null;				
	    }
    }

    function admin_form(&$qa_content) {
        $ok = null;

        if (qa_clicked('pre_msg_save_button')) {
            qa_opt('enable_msg_before_ask', (bool) qa_post_text('enable_msg_before_ask'));
            qa_opt('msg_before_ask', qa_post_text('msg_before_ask'));
            qa_opt('msg_before_ask_css', qa_post_text('msg_before_ask_css'));
            qa_opt('msg_before_ask_proceed', qa_post_text('msg_before_ask_proceed'));
            qa_opt('msg_before_ask_label', qa_post_text('msg_before_ask_label'));
            $ok = qa_lang('admin/options_saved');
        }

        $fields = array();

        $fields[] = array(
            'label' => 'Enable showing message before asking questions',
            'value' => qa_opt('enable_msg_before_ask'),
            'tags' => 'NAME="enable_msg_before_ask"',
            'type' => 'checkbox',
        );

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
            'label' => 'checkbox label',
            'value' => qa_html(qa_opt('msg_before_ask_label')),
            'tags' => 'NAME="msg_before_ask_label"',
        );
        $fields[] = array(
            'label' => 'proceed text',
            'value' => qa_html(qa_opt('msg_before_ask_proceed')),
            'tags' => 'NAME="msg_before_ask_proceed"',
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
