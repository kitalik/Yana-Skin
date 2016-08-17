(function () {
  tinymce.PluginManager.add('boxes', function (editor) {
    editor.addButton('boxes', {
      // Select dropdown
      type: 'listbox',
      title: 'Add box for styling',
      text: 'Boxes',
      fixedWidth: true,
      icon: false,
      onselect: function (e) {
      },
      values: [
        // Wrapper
        {
          text: 'Wrapper',
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
                var content = '[wrapper' + css_class + ']' + selected_content + '[/wrapper]';
                editor.insertContent(content);
              }
            });
          }
        },
        // Block
        {
          text: 'Block',
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
                var content = '[block' + css_class + ']' + selected_content + '[/block]';
                editor.insertContent(content);
              }
            });
          }
        },
        // Text
        {
          text: 'Text',
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
                var content = '[text' + css_class + ']' + selected_content + '[/text]';
                editor.insertContent(content);
              }
            });
          }
        }
      ]

    });

  });
})();