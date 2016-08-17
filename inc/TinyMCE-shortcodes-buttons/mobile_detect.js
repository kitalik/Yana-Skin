(function () {
  tinymce.PluginManager.add('mobile_detect', function (editor) {
    editor.addButton('mobile_detect', {
      title: 'Output content depending on browser or device type',
      type: 'menubutton',
      icon: 'dashicon dashicons-visibility',
      //text: 'Mobile detect',
      //fixedWidth: true,
      menu: [
        // Desktops or tablets
        {
          text: 'Desktops or tablets',
          //icon: 'dashicon dashicons-desktop dashicons-tablet',
          onclick: function () {
            // Wrap selected content with code.
            var selected_content = tinyMCE.activeEditor.selection.getContent();
            if (!selected_content) {
              selected_content = ' ';
            }
            // Output shortcode
            var content = '[notphone]' + selected_content + '[/notphone]';
            editor.insertContent(content);
          }
        },
        {
          text: 'Tablet & Mobile',
          onclick: function () {
            // Wrap selected content with code.
            var selected_content = tinyMCE.activeEditor.selection.getContent();
            if (!selected_content) {
              selected_content = ' ';
            }
            // Output shortcode
            var content = '[device]' + selected_content + '[/device]';
            editor.insertContent(content);
          }
        },
        {
          text: 'Desktop only',
          onclick: function () {
            // Wrap selected content with code.
            var selected_content = tinyMCE.activeEditor.selection.getContent();
            if (!selected_content) {
              selected_content = ' ';
            }
            // Output shortcode
            var content = '[desktop]' + selected_content + '[/desktop]';
            editor.insertContent(content);
          }
        },
        {
          text: 'Tablet only',
          onclick: function () {
            // Wrap selected content with code.
            var selected_content = tinyMCE.activeEditor.selection.getContent();
            if (!selected_content) {
              selected_content = ' ';
            }
            // Output shortcode
            var content = '[tablet]' + selected_content + '[/tablet]';
            editor.insertContent(content);
          }
        },
        {
          text: 'Phone only',
          onclick: function () {
            // Wrap selected content with code.
            var selected_content = tinyMCE.activeEditor.selection.getContent();
            if (!selected_content) {
              selected_content = ' ';
            }
            // Output shortcode
            var content = '[phone]' + selected_content + '[/phone]';
            editor.insertContent(content);
          }
        },
        {
          text: 'Advanced',
          title: 'Rules for iOS, android & miscellaneous browsers',
          //type: 'menubutton',
          menu: [
            {
              text: 'iOS devices',
              onclick: function () {
                // Wrap selected content with code.
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                // Output shortcode
                var content = '[ios]' + selected_content + '[/ios]';
                editor.insertContent(content);
              }
            },
            {
              text: 'iPhone',
              onclick: function () {
                // Wrap selected content with code.
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                // Output shortcode
                var content = '[iPhone]' + selected_content + '[/iPhone]';
                editor.insertContent(content);
              }
            },
            {
              text: 'iPad',
              onclick: function () {
                // Wrap selected content with code.
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                // Output shortcode
                var content = '[iPad]' + selected_content + '[/iPad]';
                editor.insertContent(content);
              }
            },
            {
              text: 'Android devices',
              onclick: function () {
                // Wrap selected content with code.
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                // Output shortcode
                var content = '[android]' + selected_content + '[/android]';
                editor.insertContent(content);
              }
            },
            {
              text: 'Windows mobile devices',
              onclick: function () {
                // Wrap selected content with code.
                var selected_content = tinyMCE.activeEditor.selection.getContent();
                if (!selected_content) {
                  selected_content = ' ';
                }
                // Output shortcode
                var content = '[windowsmobile]' + selected_content + '[/windowsmobile]';
                editor.insertContent(content);
              }
            },
            /*
             Mobile browsers.
             {
             text: 'Chrome browser',
             onclick: function () {
             // Wrap selected content with code.
             var selected_content = tinyMCE.activeEditor.selection.getContent();
             if (!selected_content) {
             selected_content = ' ';
             }
             // Output shortcode
             var content = '[chrome]' + selected_content + '[/chrome]';
             editor.insertContent(content);
             }
             },
             {
             text: 'IE',
             title: 'Internet Explorer browser',
             onclick: function () {
             // Wrap selected content with code.
             var selected_content = tinyMCE.activeEditor.selection.getContent();
             if (!selected_content) {
             selected_content = ' ';
             }
             // Output shortcode
             var content = '[ie]' + selected_content + '[/ie]';
             editor.insertContent(content);
             }
             },
             {
             text: 'Firefox',
             title: 'Firefox browser',
             onclick: function () {
             // Wrap selected content with code.
             var selected_content = tinyMCE.activeEditor.selection.getContent();
             if (!selected_content) {
             selected_content = ' ';
             }
             // Output shortcode
             var content = '[firefox]' + selected_content + '[/firefox]';
             editor.insertContent(content);
             }
             },
             {
             text: 'Safari',
             title: 'Safari browser',
             onclick: function () {
             // Wrap selected content with code.
             var selected_content = tinyMCE.activeEditor.selection.getContent();
             if (!selected_content) {
             selected_content = ' ';
             }
             // Output shortcode
             var content = '[safari]' + selected_content + '[/safari]';
             editor.insertContent(content);
             }
             },*/
          ]
        }
      ]

    });

  });
})();