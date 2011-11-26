<?php

class qa_html_theme_layer extends qa_html_theme_base {

    // theme replacement functions

    function head_script() { // add a Javascript file from plugin directory
        qa_html_theme_base::head_script();
        $proceed = '<input type="checkbox" name="advised" id="advised" value="advised"><label for="advised" id="adviseLabel">&nbsp; thanks, I will keep these tips in mind when asking</label><div style="text-align:right; width:100%; color:#888"><a href="#" onclick="showAskForm();"><b>proceed &raquo;</b></a></div>';

        $final = qa_opt('msg_before_ask'); //.$proceed;
        $custom = " var divClone = '';
            $(document).ready(function() {
                 divClone = $('div.qa-main').clone();
                 $('div.qa-main').html('$final');
                 $('div.qa-main').append('$proceed');
                 })";

        $proceedMsg = "
            function showAskForm() {
                 if($('#advised').is(':checked')) $('div.qa-main').replaceWith(divClone);
                 else($('#adviseLabel').attr('style','color:red; font-weight:bold;'))
                 }";

        if ($this->template == 'ask' && !qa_opt('disable_msg_before_ask')) {
            $this->output('<SCRIPT TYPE="text/javascript">', $custom, '</SCRIPT>');
            $this->output('<SCRIPT TYPE="text/javascript">', $proceedMsg, '</SCRIPT>');
        }
    }

    function head_css() {
        qa_html_theme_base::head_css();
        if ($this->template == 'ask' && !qa_opt('disable_msg_before_ask')) {
            $this->output('<style>', qa_opt('msg_before_ask_css'), '</style>');
        }
    }

}

