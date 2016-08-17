(function () {
  tinymce.PluginManager.add('add_content', function (editor) {
    editor.addButton('add_content', {
      title: 'Add content',
      icon: 'dashicon dashicons-book',
      type: 'menubutton',
      menu: [
        {
          text: 'Recent posts',
          icon: 'dashicon dashicons-wordpress',
          onclick: function () {
            editor.windowManager.open({
              title: 'Display content',
              body: [
                // Post type
                {
                  type: 'listbox',
                  name: 'post_type',
                  label: 'Post type slug',
                  values: window.postTypes
                },
                // Category
                {
                  type: 'textbox',
                  name: 'category',
                  label: 'Post category ID'
                },
                // Custom category
                {
                  type: 'textbox',
                  name: 'custom_category',
                  label: 'Custom post type category name'
                },
                // Layout
                {
                  type: 'listbox',
                  name: 'layout',
                  label: 'Layout',
                  values: [
                    {text: 'primary', value: 'primary'},
                    {text: 'secondary', value: 'secondary'},
                    //{text: 'testimonials-list', value: 'testimonials-list'}
                  ]
                },
                // Items quantity
                {
                  type: 'textbox',
                  name: 'num',
                  label: 'Items quantity'
                },
                // Meta
                {
                  type: 'listbox',
                  name: 'meta',
                  label: 'Display meta information',
                  values: [
                    {text: 'no', value: 'false'},
                    {text: 'yes', value: 'true'}
                  ]
                },
                // Thumbnail
                {
                  type: 'listbox',
                  name: 'thumb',
                  label: 'Display thumbnail',
                  values: [
                    {text: 'no', value: 'false'},
                    {text: 'yes', value: 'true'}
                  ]
                },
                // Thumbnail width
                {
                  type: 'textbox',
                  name: 'thumb_width',
                  label: 'Thumbnail width'
                },
                // Thumbnail height
                {
                  type: 'textbox',
                  name: 'thumb_height',
                  label: 'Thumbnail height'
                },
                // Excerpt words limit
                {
                  type: 'textbox',
                  name: 'excerpt_count',
                  label: 'Excerpt words limit'
                },
                // Content words limit
                {
                  type: 'textbox',
                  name: 'content_count',
                  label: 'Content words limit'
                },
                // Read more link text
                {
                  type: 'textbox',
                  name: 'more_text_single',
                  label: 'Read more link text'
                },
                // Wrapper CSS class
                {
                  type: 'textbox',
                  name: 'css_class',
                  label: 'Wrapper CSS class'
                },
                // Single item CSS class
                {
                  type: 'textbox',
                  name: 'class_item',
                  label: 'Single item CSS class'
                }


              ],
              onsubmit: function (e) {

                // Hint to hide empty attributes
                var post_type = e.data.post_type ? ' post_type="' + e.data.post_type + '"' : '';
                var category = e.data.category ? ' category="' + e.data.category + '"' : '';
                var custom_category = e.data.custom_category ? ' custom_category="' + e.data.custom_category + '"' : '';
                var layout = e.data.layout != 'primary' ? ' layout="' + e.data.layout + '"' : '';
                var num = e.data.num ? ' num="' + e.data.num + '"' : '';
                var meta = e.data.meta == 'true' ? ' meta="' + e.data.meta + '"' : '';
                var thumb = e.data.thumb == 'true' ? ' thumb="' + e.data.thumb + '"' : '';
                var thumb_width = e.data.thumb_width ? ' thumb_width="' + e.data.thumb_width + '"' : '';
                var thumb_height = e.data.thumb_height ? ' thumb_height="' + e.data.thumb_height + '"' : '';
                var excerpt_count = e.data.excerpt_count ? ' excerpt_count="' + e.data.excerpt_count + '"' : '';
                var content_count = e.data.content_count ? ' content_count="' + e.data.content_count + '"' : '';
                var more_text_single = e.data.more_text_single ? ' more_text_single="' + e.data.more_text_single + '"' : '';
                var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';
                var class_item = e.data.class_item ? ' class_item="' + e.data.class_item + '"' : '';

                // Output shortcode
                var content = '[content' + post_type + category + custom_category + layout + num + meta + thumb +
                  thumb_width + thumb_height + excerpt_count + content_count + more_text_single + css_class +
                  class_item + ']';
                editor.insertContent(content);
              }
            });
          }
        }
        // todo: add another content items here.
        /*
         {
         text: 'Categories',
         icon: 'dashicon dashicons-wordpress-alt',
         onclick: function () {
         editor.windowManager.open({
         title: 'List categories',
         body: [
         // Category
         {
         type: 'textbox',
         name: 'category',
         label: 'Category'
         },
         // CSS class
         {
         type: 'textbox',
         name: 'css_class',
         label: 'CSS class'
         }


         ],
         onsubmit: function (e) {
         var content = '[list_categories class="' + e.data.css_class + '" category="' + e.data.category + '"]';
         editor.insertContent(content);
         }
         });
         }
         }
         */
      ]

    });
  });
})();