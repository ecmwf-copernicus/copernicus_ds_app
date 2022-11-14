# Copernicus Embed Data Store App

Embed a CDS/ADS Application into Drupal content using paragraphs.

### Usage

- select Embed Data Store App on referenced paragraph types
- manually fill App Slug field when adding a new paragraph
(app slug examples: app-c3s-global-temperature-trend-monitor, app-climate-mediterranean-sea-level, app-climate-mediterranean-vectors)
- App Configuration Link and Configuration JSON are automatically filled when losing focus on App Slug
- Configuration JSON can be customized as needed
- use Css Style to add inline css to app's parent container

### Overwrite settings

$settings['cds_app_base_url'] = 'https://cds.climate.copernicus.eu';
$settings['cds_app_workflow_path'] = '/workflows/c3s/';
