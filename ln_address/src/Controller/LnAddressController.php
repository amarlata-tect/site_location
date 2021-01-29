<?php

namespace Drupal\ln_address\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\Yaml\Yaml;

/**
 * Defines a generic controller for Address.
 *
 * @package Drupal\ln_address\Controller
 */
class LnAddressController extends ControllerBase {

   /**
   * Return an array with the available site zones keyed by acronym.
   *
   * @return array|mixed
   *   return array.
   */
  public static function getTimezones() {
    $zones = drupal_get_path('module', 'ln_address') . '/datasets/timezones.yml';
    $zonesList = file_exists($zones) ? Yaml::parseFile($zones) : [];
    return $zonesList;
  }

}
