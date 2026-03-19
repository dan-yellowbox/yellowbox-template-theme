/* Styled Button */
(function() {
    tinymce.create('tinymce.plugins.yellowbox_button', {
        init: function(editor, url) {
            editor.addButton('yellowbox_button', {
                title: 'Add styled button',
                text: 'Insert Button',
                icon: false,
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insert Button',
                        body: [
                            {
                                type: 'textbox',
                                name: 'buttonText',
                                label: 'Button Text',
                                value: 'Click Here'
                            },
                            {
                                type: 'textbox',
                                name: 'buttonURL',
                                label: 'Button URL',
                                value: 'https://'
                            },
                            {
                                type: 'listbox',
                                name: 'buttonType',
                                label: 'Button Type',
                                'values': [ // This is the key property name
                                    {text: 'Primary', value: 'primary'},
                                    {text: 'Outline Primary', value: 'outline-primary'},
                                    {text: 'Light', value: 'light'},
                                    {text: 'Outline Light', value: 'outline-light'},
                                    {text: 'Dark', value: 'dark'},
                                    {text: 'Outline Dark', value: 'outline-dark'},
                                ]
                            },
                            {
                                type: 'checkbox',
                                name: 'openInNewTab',
                                label: 'Open In New Tab',
                            }
                        ],
                        onsubmit: function(e) {
                            // Get the target attribute if "Open In New Tab" is checked
                            var target = e.data.openInNewTab ? ' target="_blank" rel="noopener"' : '';
                            
                            // Use the selected button type from the dropdown
                            editor.insertContent(
                                '<a href="' + e.data.buttonURL + '"' + target +
                                ' class="btn btn-' + e.data.buttonType + '">' +
                                e.data.buttonText +
                                '</a>'
                            );
                        }
                    });
                }
            });
        }
    });
    tinymce.PluginManager.add('yellowbox_button', tinymce.plugins.yellowbox_button);
})();

// Checklist Button
(function() {
    tinymce.PluginManager.add('yellowbox_checklist', function(editor, url) {
        
        editor.addButton('yellowbox_checklist_btn', {
            text: 'Insert Checklist',
            tooltip: 'Insert Checklist',
            icon: false,
            onclick: function() {
                // Find if the cursor is currently inside a UL
                var selectedNode = editor.selection.getNode();
                var list = editor.dom.getParent(selectedNode, 'ul');

                if (list) {
                    // If a list exists, toggle the class
                    if (editor.dom.hasClass(list, 'list-checklist')) {
                        editor.dom.removeClass(list, 'list-checklist');
                    } else {
                        editor.dom.addClass(list, 'list-checklist');
                    }
                } else {
                    // If no list exists, create one with the class
                    editor.execCommand('InsertUnorderedList');
                    var newList = editor.dom.getParent(editor.selection.getNode(), 'ul');
                    if (newList) {
                        editor.dom.addClass(newList, 'list-checklist');
                    }
                }
            }
        });
    });
})();