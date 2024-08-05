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
                  window.cds_toolbox.runApp(
                    'ds-app-' + settings.ds_app_paragraphs[i],
                    'ds-app/' + settings.ds_app_paragraphs[i] + '/configuration.json',
                    {
                      monitorViewport: false,
                      standalone: false,
                      workflowBase: settings.cds_app_base_url
                    }
                  );
                    observer.disconnect();
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
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
