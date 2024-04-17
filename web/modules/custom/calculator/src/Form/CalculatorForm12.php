<?php 

namespace Drupal\calculator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Implements an calculator form.
 */
class CalculatorForm12 extends FormBase {

 
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'calculator_test';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
 
    $form['first_number'] = [
      '#type' => 'number',
      '#title' => $this->t('Enter your first number'),
      '#required' => TRUE,
    ];

    $form['second_number'] = [
      '#type' => 'number',
      '#title' => $this->t('Enter your second number'),
      '#required' => TRUE,
    ];

    $form['operation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter the operation you want to perform(add/sub/mul/div)'),
      'required' => TRUE,
    ];

    // $form['operation'] = [
    //   '#type' => 'select',
    //   '#title' => $this->t('Operation'),
    //   '#options' => [
    //     'add' => $this->t('Addition'),
    //     'sub' => $this->t('Subtraction'),
    //     'mul' => $this->t('Multiply'),
    //     'div' => $this->t('Divide'),
    //   ],
    //   '#required' => TRUE,
    // ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Calculate'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  
    //1.
    // if ($form_state->getValue('operation') != 'add' && 
    //     $form_state->getValue('operation') != 'sub' &&
    //     $form_state->getValue('operation') != 'mul' &&
    //     $form_state->getValue('operation') != 'div'){
    //   $form_state->setErrorByName(('operation'), $this->t('Please enter the correct operation either add, sub , mul or div, not anything else'));
    // }

    // Get the value of the text input field.
    // $input_value = $form_state->getValue('operation');
    // // 2. Check if the input value is one of the restricted values.
    // if (!in_array(strtolower($input_value), ['add', 'sub', 'mul', 'div'])) {
    //   // Add an error to the text input field.
    //   $form_state->setErrorByName('operation', $this->t('The value cannot be "add", "sub", "mul", or "div". Please enter a different value.'));
    // }
    // }

    $operation = $form_state->getValue('operation');
    // Check if the operation is valid.
    if ($operation != 'add' && $operation != 'sub' && $operation != 'mul' && $operation != 'div') {
      // Display error message if operation is not valid.
      $form_state->setErrorByName('operation', $this->t('Invalid operation. Please enter "add","sub", "mul", "div".'));
    }
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->messenger()->addStatus($this->t('Your operation is @number', ['@number' => $form_state->getValue('operation')]));
    $first_num = $form_state->getValue('first_number');
    $second_num = $form_state->getValue('second_number');
    $operation = $form_state->getValue('operation');


    switch ($operation) {
      case 'add':
        $result = $first_num + $second_num;
        break;
      case 'sub':
        $result = $first_num - $second_num;
        break;
      case 'mul':
        $result = $first_num * $second_num;
        break;
      case 'div':
        $result = $first_num / $second_num;
        break;
    }

   $this->messenger()->addStatus($this->t('Your result is @result', ['@result' => $result])); 
  // drupal_set_message($this->t('The result is: @result', ['@result' => $result]));
  }
}
