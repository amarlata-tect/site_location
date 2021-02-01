<?php

  namespace Drupal\ln_address\Plugin\Block;

  use Drupal;
  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
  use Drupal\ln_address\Service\LnAddressService;
  use Symfony\Component\DependencyInjection\ContainerInterface;
  use Drupal\Core\Config\ConfigFactoryInterface;
  use Drupal\Core\Cache\Cache;

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
  class Location extends BlockBase implements ContainerFactoryPluginInterface {

    /**
     * @var LnAddressService $configAddress
     */
    protected $configAddress;

    /**
     * @var ConfigFactoryInterface $configFactory
     */
    protected $configFactory ;

    /**
     * Location constructor.
     *
     * @param array $configuration
     * @param $plugin_id
     * @param $plugin_definition
     * @param \Drupal\ln_address\Service\LnAddressService $configAddress
     * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, LnAddressService $configAddress, ConfigFactoryInterface $configFactory) {
      parent::__construct($configuration, $plugin_id, $plugin_definition);
      $this->configAddress = $configAddress;
      $this->configFactory = $configFactory;
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     *
     * @return static
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
      return new static(
        $configuration,
        $plugin_id,
        $plugin_definition,
        $container->get('ln_address'),
        $container->get('config.factory')
      );
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
      $date = $this->configAddress->generateDataTimeByTimezone();
      $config = $this->configFactory->get('ln_address.settings');
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

    /**
     * @return int
     */
    public function getCacheMaxAge() {
      return 0;
    }
  }
