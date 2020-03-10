<?php 
namespace Drupal\ucsf_samlauth\Form;
 
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
 
/**
* Configure settings for this site.
*/
class SettingsValidateAttribute extends ConfigFormBase {
/**
 * {@inheritdoc}
 */
  public function getFormId() {
    return 'ucsf_samlauth_settings';
  }
 
/**
 * {@inheritdoc}
 */
  protected function getEditableConfigNames() {
    return [
      'ucsf_samlauth.settings',
    ];
  }
 
/**
 * {@inheritdoc}
 */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ucsf_samlauth.settings');
 
    $form['ucsf_samlauth'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Drupal authentication - attribute name/values'),
      '#collapsible' => FALSE,
    ];
    $form['ucsf_samlauth']['attribute_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('SimpleSAMLphp attribute name'),
      '#description' => $this->t('SimpleSAMLphp attribute to be used for extra login validation'),
      '#default_value' => $config->get('attribute_name'),
    ];
    $form['ucsf_samlauth']['attribute_values'] = [
      '#type' => 'textarea',
      '#title' => $this->t('simpleSAMLphp attribute value(s)'),
      '#description' => $this->t('A pipe separated list of values.'),
      '#default_value' => $config->get('attribute_values'),
    ];

    return parent::buildForm($form, $form_state);
  }
 
/**
 * {@inheritdoc}
 */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      // Retrieve the configuration
      $this->configFactory->getEditable('ucsf_samlauth.settings')
      // Set the submitted configuration setting
      ->set('attribute_name', $form_state->getValue('attribute_name'))
      ->set('attribute_values', $form_state->getValue('attribute_values'))
      ->save();
 
    parent::submitForm($form, $form_state);
  }
}
