(function () {
  tinymce.PluginManager.add('lorem_ipsum', function (editor) {
    editor.addButton('lorem_ipsum', {
      text: 'Lorem ipsum',
      icon: false,
      onclick: function () {
        editor.insertContent('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id ligula nisl. Vivamus sit amet nisi metus. Vivamus vel metus tellus. Phasellus massa ante, elementum eget erat quis, ornare imperdiet nulla. Proin elementum vitae erat ac pharetra. Fusce mollis diam sit amet dui condimentum, a tristique nisl semper. Aenean a metus id orci vulputate suscipit nec id dolor.</p>' +
          '<p>Proin vitae eleifend ipsum. In hac habitasse platea dictumst. Integer sodales a erat quis porta. Proin fringilla consectetur mi non mattis. Vivamus tincidunt arcu velit, ut tristique libero porta at. Phasellus lorem nulla, fringilla id bibendum id, aliquet nec nisi. In at gravida odio, eget sollicitudin tortor.</p>' +
          '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi nec finibus elit. Ut at tortor luctus metus posuere tempus in id est. Nunc molestie gravida laoreet. Morbi pulvinar magna vitae justo pretium, quis ultrices lorem porttitor. Fusce a libero arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla facilisi. Donec auctor eros at tempor laoreet. Curabitur rhoncus rhoncus odio.</p>' +
          '<p>Aliquam luctus neque dolor, a molestie odio cursus eget. Sed et sollicitudin lorem, nec elementum ex. Fusce tristique faucibus lacus sed suscipit. Integer aliquet augue in enim imperdiet, nec commodo velit dictum. Vivamus at pharetra lectus, a ultrices sem. Aliquam purus dui, porta a mauris in, laoreet pellentesque urna. Sed quis volutpat nibh, sed egestas lacus. Duis scelerisque justo id ullamcorper dignissim. Donec eget arcu eget tortor cursus porttitor et sed tellus. Ut non urna purus. Cras rutrum lacus quis felis posuer, elementum faucibus tortor pharetra.</p>' +
          '<p>Phasellus auctor dignissim tortor, eget dapibus felis viverra id. Mauris quis diam a mi rhoncus condimentum id in mauris. Curabitur id ex ligula. Nullam vehicula tortor eget massa aliquet, vitae imperdiet augue mollis. Suspendisse ut nibh viverra, scelerisque nibh eu, molestie quam. Donec facilisis finibus sapien nec feugiat. Maecenas vulputate, turpis sed interdum vestibulum, libero quam euismod libero, nec hendrerit arcu sem ut nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur vehicula dolor ac nisl eleifend faucibus. Etiam vitae lectus dui. Ut ex arcu, accumsan eu pulvinar nec, auctor sed nisl. Nunc finibus imperdiet mi, id porta mauris sollicitudin id.</p>');
      }
    });
  });
})();
