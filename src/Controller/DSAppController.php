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
      return json_decode($paragraph->field_ds_config_json->value, true);
    }
  }
}
