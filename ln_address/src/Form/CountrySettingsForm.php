<?php

  namespace Drupal\ln_address\Form;

  use Drupal\Core\Form\ConfigFormBase;
  use Drupal\Core\Form\FormStateInterface;
  use Drupal\ln_address\Controller\LnAddressController;


  /**
   * Class CountrySettingsForm.
   *
   * @package Drupal\ln_address\Form
   */
  class CountrySettingsForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
      return 'ln_address_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
      return ['ln_address.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
      $config = $this->config('ln_address.settings');
      $country = $config->get('country');
      $form['country'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Country'),
        '#description' => $this->t('Enter country name here.'),
        '#default_value' => isset($country) ? $country : '',
        '#size' => 30,
        '#required' => true,
      ];

      $city = $config->get('city');
      $form['city'] = [
        '#type' => 'textfield',
        '#title' => $this->t('City'),
        '#description' => $this->t('Enter a city name here.'),
        '#default_value' => isset($city) ? $city : '',
        '#size' => 30,
        '#required' => true,
      ];

      $timeZoneList = LnAddressController::getTimezones();
      $updated_timeZoneList = $this->getTranslatedArrayOptions($timeZoneList);
      $timezone = $config->get('timezone');
      $form['timezone'] = [
        '#type' => 'select',
        '#title' => $this->t('Timezone'),
        '#description' => $this->t('Select timezone.'),
        '#default_value' => isset($timezone) ? $timezone : 0,
        '#options' => $updated_timeZoneList,
        '#required' => true,
      ];

      return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      // Save default form settings.
      $configSettings = $this->configFactory->getEditable('ln_address.settings');
      $configSettings->set('country', $form_state->getValue('country'))
        ->set('city', $form_state->getValue('city'))
        ->set('timezone', $form_state->getValue('timezone'));

      $configSettings->save();
      parent::submitForm($form, $form_state);
    }

    /**
     * Add translation on the option values.
     *
     * @param array $array_list
     *   Option array.
     *
     * @return array
     *   Return array.
     */
    public function getTranslatedArrayOptions(array $array_list) {
      $updatedList = [];
      foreach ($array_list as $code => $name) {
        $updatedList[$code] = $this->t($name);
      }
      return $updatedList;
    }

  }