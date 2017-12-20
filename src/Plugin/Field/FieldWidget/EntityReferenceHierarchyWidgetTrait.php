<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldWidget;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EntityReferenceHierarchyWidgetTrait
 */
trait EntityReferenceHierarchyWidgetTrait {

  /**
   * Returns hierarchy related form elements.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $items
   * @param $delta
   * @param array $element
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return array
   */
  public function getHierarchyFormElements(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $result = [];

    $result['index'] = [
      '#type' => 'hidden',
      '#default_value' => isset($items[$delta]->index) ? $items[$delta]->index : $delta + 1,
      '#attributes' => [
        'class' => ['item-index'],
      ],
    ];

    $result['parent'] = [
      '#type' => 'hidden',
      '#default_value' => isset($items[$delta]->parent) ? $items[$delta]->parent : 0,
      '#attributes' => [
        'class' => ['item-parent'],
      ],
    ];

    $result['depth'] = [
      '#type' => 'hidden',
      '#default_value' => isset($items[$delta]->depth) ? $items[$delta]->depth : 0,
      '#attributes' => [
        'class' => ['item-depth'],
      ],
    ];

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Get parent values.
    $element = parent::formElement($items, $delta, $element, $form, $form_state);

    // Combine with hierarchy related form elements.
    $element += $this->getHierarchyFormElements($items, $delta, $element, $form, $form_state);

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function formMultipleElements(FieldItemListInterface $items, array &$form, FormStateInterface $form_state) {
    $element = parent::formMultipleElements($items, $form, $form_state);
    $element['#entity_reference_hierarchy'] = TRUE;

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function extractFormValues(FieldItemListInterface $items, array $form, FormStateInterface $form_state) {
    // Get user input.
    $user_input = &$form_state->getUserInput();

    // Get input to get the order of form elements.
    $parents = array_merge($form['#parents'], [$this->fieldDefinition->getName()]);

    // Get user input related to the field.
    if ($field_input_values = &NestedArray::getValue($user_input, $parents)) {
      // Get order in which values are submitted from input values.
      $input_order_index = array_flip(array_values(array_map(function($item) {
        return $item['index'];
      }, $field_input_values)));

      // Sort form state values by input order.
      $form_state_values = &$form_state->getValue($parents);
      uasort($form_state_values, function ($a, $b) use ($input_order_index) {
        // Non-array elements are not field list items.
        if (is_array($a) && is_array($b)) {
          $result = $input_order_index[$a['index']] > $input_order_index[$b['index']] ? 1 : -1;
          return $result;
        }
        return 0;
      });

      // Add weight to form state values according to input order.
      // @see parent::extractFormValues() where values are sorted by weight.
      $form_state_values = array_map(function ($item) {
        static $weight = 1;

        // Array elements with "_weight" property are field values.
        if (is_array($item) && isset($item['_weight'])) {
          // Assign weight.
          $item['_weight'] = $weight;
          $weight++;
        }
        return $item;
      }, $form_state_values);

      // Reset the numerical keys on input. This keeps the order preserved
      // in the form.
      $field_input_values = array_combine(range(0, count($field_input_values) - 1), $field_input_values);
    }

    parent::extractFormValues($items, $form, $form_state);
  }

}
