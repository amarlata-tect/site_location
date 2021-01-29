<?php

namespace Drupal\ln_address\Service;

/**
 * Website address interface to extend or getting services.
 */
interface LnAddressServiceInterface {

  /**
   * Get data and time by timezone.
   */
  public function generateDataTimeByTimezone();


}
