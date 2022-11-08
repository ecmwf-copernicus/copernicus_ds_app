(function ($, Drupal, once) {
  Drupal.behaviors.dsApp = {
    attach: function attach(context, settings) {
      var $context = $(context);
      for (let i = 0; i < settings.ds_app_paragraphs.length; ++i) {
        try {
          window.cds_toolbox.runApp(
            'ds-app-' + settings.ds_app_paragraphs[i],
            // TODO: get Drupal's public folder here
            '/sites/default/files/ds_app/' + settings.ds_app_paragraphs[i] + '/configuration.json',
            {
              monitorViewport: true,
              standalone: true,
              workflowBase: 'https://cds.climate.copernicus.eu/'
            }
          );
        } catch (err) {
          console.error(err);
        }
      }
    }
  };
})(jQuery, Drupal, once);
