<?php

// Gravity Forms Bootstrap CSS Styles
add_filter("gform_field_content", "bootstrap_styles_for_gravityforms_fields", 10, 5);
function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){

	// Currently only applies to most common field types, but could be expanded.

	if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
		$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
		$content = str_replace('class=\'gfield_label', 'class=\'form-label gfield_label', $content);
	}

	if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
		$content = str_replace('class=\'large', 'class=\'form-control large', $content);
		$content = str_replace('class=\'gfield_label', 'class=\'form-label gfield_label', $content);

	}

	if($field["type"] == 'name' || $field["type"] == 'address') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
		$content = str_replace('class=\'gfield_label', 'class=\'form-label gfield_label', $content);
	}

	if($field["type"] == 'textarea') {
		$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
		$content = str_replace('class=\'gfield_label', 'class=\'form-label gfield_label', $content);
	}

	if($field["type"] == 'checkbox') {
		$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		$content = str_replace('class=\'gfield_label', 'class=\'form-label gfield_label', $content);
	}

	if($field["type"] == 'radio') {
		$content = str_replace('li class=\'', 'li class=\'radio ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
		$content = str_replace('class=\'gfield_label', 'class=\'form-label gfield_label', $content);
	}

	return $content;

}

// Button Styling
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
	if( $form['button']['width'] == 'full' ) {
		$width = 'w-100';
	} else {
		$width = '';
	}
	
	if( $form['button']['text'] ) {
		$text = $form['button']['text'];
	} else {
		$text = 'submit';
	}

    return "<button class='btn btn-primary " . $width . "' id='gform_submit_button_{$form["id"]}'><span>" . $text . "</span></button>";
}

// Floating Labels
add_filter('gform_field_content', 'floating_label_field', 10, 5);
function floating_label_field($content, $field, $value, $lead_id, $form_id) {
    if ($field->cssClass == 'floating') {
    	$placeholder = ( $field->placeholder ? $field->placeholder : 'Placeholder required' );
        $label_html = '<label for="input_' . $field->formId . '_' . $field->id . '">' . $placeholder . '</label>';

        // Move the label directly after the input element

	if($field["type"] == 'textarea') {
		$content = preg_replace(
            '/(<textarea[^>]*>.*?<\/textarea>)/',
            '${1}' . $label_html,
            $content
        );
	} else {
        $content = preg_replace(
            '/(<input[^>]*>)/',
            '${1}' . $label_html,
            $content
        );
    }

        // Add the form-floating class
        $content = str_replace('class=\'ginput_container ', 'class=\'ginput_container form-floating ', $content);
    }
    return $content;
}
