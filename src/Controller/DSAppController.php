<?php

namespace Drupal\copernicus_ds_app\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\paragraphs\Entity\Paragraph;

class DSAppController extends ControllerBase {

  /**
   * Return configuration.json for embedded cds app
   */
  public function getConfigurationJSON(Request $request, $uuid) {
    return new JsonResponse(
      $this->getData($uuid)
    );
  }

  private function getData($uuid) {
    $paragraph = \Drupal::service('entity.repository')
      ->loadEntityByUuid('paragraph', $uuid);
    if ($paragraph->hasField('field_ds_config_json')) {
      // update the params (month + year) based on app's source code logic
      $json_array = json_decode($paragraph->field_ds_config_json->value, true);
      if (
        $json_array['name'] == 'global_temperature_trend' &&
        isset($json_array['params'])
      ) {
        $current_date = new \DateTime();
        $current_year =  $current_date->format("Y");
        $current_month =  $current_date->format("n");
        $current_day =  $current_date->format("j");
        $switch_month_day = 9;
        if ($current_day >= $switch_month_day) {
          $default_month = ($current_month - 2) % 12 + 1;
        }
        else {
          $default_month = ($current_month - 3) % 12 + 1;
        }
        if ($current_month < $default_month) {
          $default_year = $current_year - 1;
        }
        else {
          $default_year = $current_year;
        }
        foreach($json_array['params'] as $key => &$param) {
          if ($param['props']['name'] == 'month') {
            $param['props']['value'] = $default_month;
          }
          if ($param['props']['name'] == 'year') {
            $param['props']['value'] = $default_year;
          }
        }
      }
      return $json_array;
    }
  }
}
