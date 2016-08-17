(function () {
  // todo: 1) add hints to the fields;
  tinymce.PluginManager.add('grid_elements', function (editor, url) {
    editor.addButton('grid_elements', {
      title: 'Grid elements',
      type: 'menubutton',
      icon: 'dashicon dashicons-welcome-widgets-menus',
      menu: [
        // Container
        {
          text: 'Container',
          onclick: function () {
            editor.windowManager.open({
              title: 'Additional attributes',
              body: [
                {
                  type: 'textbox',
                  name: 'css_class',
                  label: 'Custom class'
                }
              ],
              onsubmit: function (e) {
                // Wrap selected content with tags
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }

                // Hint to hide empty attributes
                var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                // Output shortcode
                var content = '[container' + css_class + ']' + selected_content + '[/container]';
                editor.insertContent(content);
              }
            });
          }
        },
        // Row
        {
          text: 'Row',
          onclick: function () {
            editor.windowManager.open({
              title: 'Additional attributes',
              body: [
                {
                  type: 'textbox',
                  name: 'css_class',
                  label: 'Custom class'
                }
              ],
              onsubmit: function (e) {
                // Wrap selected content with tags
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }

                // Hint to hide empty attributes
                var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                // Output shortcode
                var content = '[row' + css_class + ']' + selected_content + '[/row]';
                editor.insertContent(content);
              }
            });
          }
        },
        // Row inner
        {
          text: 'Row inner',
          onclick: function () {
            editor.windowManager.open({
              title: 'Additional attributes',
              body: [
                {
                  type: 'textbox',
                  name: 'css_class',
                  label: 'Custom class'
                }
              ],
              onsubmit: function (e) {
                // Wrap selected content with tags
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }

                // Hint to hide empty attributes
                var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                // Output shortcode
                var content = '[row_inner' + css_class + ']' + selected_content + '[/row_inner]';
                editor.insertContent(content);
              }
            });
          }
        },
        // Column
        {
          text: 'Column',
          onclick: function () {
            editor.windowManager.open({
              title: 'Insert column',
              body: [
                {
                  type: 'listbox',
                  name: 'column_width',
                  label: 'Column width',
                  fixedWidth: true,
                  //classes: 'btn widget fixed-width',
                  'values': [
                    {text: '1', value: '1'},
                    {text: '2', value: '2'},
                    {text: '3', value: '3'},
                    {text: '4', value: '4'},
                    {text: '5', value: '5'},
                    {text: '6', value: '6'},
                    {text: '7', value: '7'},
                    {text: '8', value: '8'},
                    {text: '9', value: '9'},
                    {text: '10', value: '10'},
                    {text: '11', value: '11'},
                    {text: '12', value: '12'}
                  ]
                }
              ],
              onsubmit: function (e) {
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                editor.insertContent('[column class="col-sm-' + e.data.column_width + '"] ' + selected_content + ' [/column]');
              }
            });
          }
        },
        // Column inner
        {
          text: 'Column inner',
          onclick: function () {
            editor.windowManager.open({
              title: 'Insert column',
              body: [
                {
                  type: 'listbox',
                  name: 'column_width',
                  label: 'Column width',
                  fixedWidth: true,
                  'values': [
                    {text: '1', value: '1'},
                    {text: '2', value: '2'},
                    {text: '3', value: '3'},
                    {text: '4', value: '4'},
                    {text: '5', value: '5'},
                    {text: '6', value: '6'},
                    {text: '7', value: '7'},
                    {text: '8', value: '8'},
                    {text: '9', value: '9'},
                    {text: '10', value: '10'},
                    {text: '11', value: '11'},
                    {text: '12', value: '12'}
                  ]
                }
              ],
              onsubmit: function (e) {
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                editor.insertContent('[column_inner class="col-sm-' + e.data.column_width + '"] ' + selected_content + ' [/column_inner]');
              }
            });
          }
        },
        // Clear
        {
          text: 'Clear',
          onclick: function () {
            editor.insertContent('[clear]');
          }
        },
        // Spacer
        {
          text: 'Spacer',
          onclick: function () {
            editor.insertContent('[spacer]');
          }
        },
        // Divider
        {
          text: 'Divider',
          onclick: function () {
            editor.insertContent('[divider]');
          }
        } 
      ]
    });

  });
})();