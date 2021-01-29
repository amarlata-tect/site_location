<?php

namespace Drupal\ln_address\Service;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class LnAddressService.
 *
 * @package Drupal\ln_address\Service
 */
class LnAddressService implements LnAddressServiceInterface {

  /**
   * Configuration state Drupal Site.
   *
   * @var object
   */

  protected $config;


  /**
   * LnAddressService constructor.
   *
   * @param object $config
   *   Config object.
   */
  public function __construct($config) {
    $this->config = $config->get('ln_address.settings');
  }

  /**
   * Get data and time by timezone.
   *
   * @return string
   *   return string.
   */
  public function generateDataTimeByTimezone() {
    $local_date_time = '';
    if (is_object($this->config) && $this->config->get('timezone')) {
      $configure_timezone = $this->config->get('timezone');
      $date = new DrupalDateTime();
      $date->setTimezone(new \DateTimeZone($configure_timezone));
      $local_date_time = $date->format('dS M Y - g:i A');
    }
    return $local_date_time;
  }

}
