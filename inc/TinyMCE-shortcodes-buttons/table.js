(function () {
  tinymce.PluginManager.add('table', function (editor) {
    editor.addButton('table', {
      title: 'Table',
      icon: 'dashicon dashicons-grid-view',
      onclick: function () {
        editor.windowManager.open({
          title: 'Additional attributes',
          body: [
            {
              type: 'textbox',
              name: 'css_class',
              label: 'Custom class (optional)'
            }
          ],
          onsubmit: function (e) {

            // Hint to hide empty attributes
            var css_class = e.data.css_class ? ' ' + e.data.css_class : '';

            // Output shortcode
            var content = '<div class="table' + css_class + '"><table width="600"><tr><th>#</th><th>Name</th><th>Type</th></tr><tr><td>01</td><td>Name 1</td><td>Type A</td></tr><tr><td>02</td><td>Name 2</td><td>Type B</td></tr><tr><td>03</td><td>Name 3</td><td>Type C</td></tr></table></div>';
            editor.insertContent(content);
          }
        });
      }
    });
  });
})();
