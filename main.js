(function(){
// test
  var $window = $(window),
      $col = $('#left');
  $(function(){
    $window.resize(function() {
      if ($window.width() > 768){
        $col.css('height', $window.height());
      } 
    }).resize();
  });

  (function(){
    if (!(window.history && history.pushState)) return; // History support
    var tpl = $('#tpl-image').html(),
        $images = $('#images'),
        $nav = $('#nav'),
        $col = $('#right'),
        load;

    // Ajax request
    load = function(state) {
      $.getJSON(state.ajaxUrl, function(data) {
        var html = '';
        for (var i=0; i < data.gifs.length; i++) {
          html += tpl.replace(/\{path\}/g, data.gifs[i].slice(0, -4))
                     .replace(/\{gif\}/g, data.gifs[i]);
        }
        $images.html(html);
        $nav.html(data.pagination);
        if (data.title) {
          document.title = data.title;
        }
        document.body.className = document.body.className.replace(' paginated', '');
        if (data.page != 1) {
          document.body.className += ' paginated';
        }
        $('html, body').scrollTop(0);
        $images.find('a:first').focus();
      });
    };

    // Click event
    $('#nav').on('click', 'a', function(e){
      e.preventDefault();
      var state = {
        url: this.href,
        ajaxUrl: this.href.replace(/\/$/, '') + '/json'
      };
      history.pushState(state, '', state.url);
      load(state);
    });

    // Popstate event
    window.onpopstate = function(e) {
      load({
        url: window.location.href,
        ajaxUrl: window.location.href.replace(/\/$/, '') + '/json'
      });
    };
  })();
})();
