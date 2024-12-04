(function ($, Drupal, once) {
  Drupal.behaviors.dsApp = {
    attach: function attach(context, settings) {
      var $context = $(context);
      for (let i = 0; i < settings.ds_app_paragraphs.length; ++i) {
        const appContainer = document.querySelector(`#ds-app-${ settings.ds_app_paragraphs[i] }`)
        
        try {
          const observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                  settings.plotly_json = JSON.parse(settings.plotly_json);
                  Plotly.newPlot(`ds-app-${ settings.ds_app_paragraphs[i] }`, settings.plotly_json.data, settings.plotly_json.layout);
                  observer.disconnect();
                }
            });
        }, {
            root: null,
            rootMargin: '200px',
            threshold: 0
        });
        observer.observe(appContainer);     
        } catch (err) {
          console.error(err);
        }
      }
    }
  };
})(jQuery, Drupal, once);
