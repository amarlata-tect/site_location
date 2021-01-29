<?php

  namespace Drupal\ln_address\Plugin\Block;

  use Drupal;
  use Drupal\Core\Block\BlockBase;

  /**
   * Provides a 'Location' block.
   *
   * @Block(
   *   id = "ln_address_location",
   *   admin_label = @Translation("Site Location"),
   *   category = @Translation("Site Location"),
   *   module = "ln_address_location",
   * )
   */
  class Location extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
      $date = \Drupal::service('ln_address')->generateDataTimeByTimezone();
      $config = \Drupal::config('ln_address.settings');
      $data = (!empty($config) && is_object($config) && !empty($config->get('country'))) ? true : false;
      $site_address_details = [
        '#theme'             => 'site_address_block',
        '#country'           => $config->get('country'),
        '#city'              => $config->get('city'),
        '#timezone'          => $config->get('timezone'),
        '#time'              => $date,
        '#is_data'           => $data

      ];
      return $site_address_details;
    }
  }
