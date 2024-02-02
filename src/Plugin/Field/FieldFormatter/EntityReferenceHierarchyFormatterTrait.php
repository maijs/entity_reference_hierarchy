<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Class EntityReferenceHierarchyFormatterTrait
 */
trait EntityReferenceHierarchyFormatterTrait {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    /** @var \Drupal\entity_reference_hierarchy\EntityReferenceRevisionsHierarchyFieldItemList $items */

    $elements = parent::viewElements($items, $langcode);

    // Get outline.
    $outline = $items->getFieldHierarchyOutline();

    // Build list items according to the outline.
    $list_items = $this->getNestedListItemElements($items, $elements, $outline);

    return $this->viewNestedElements($list_items);
  }

  /**
   * Prepares items to be rendered by "item_list" theme.
   *
   * @param FieldItemListInterface $items
   * @param array $elements
   * @param array $delta_outline
   *
   * @return array
   */
  public function getNestedListItemElements(FieldItemListInterface $items, array $elements, array $delta_outline) {
    $result = [];

    foreach ($delta_outline as $delta => $branch) {
      $item = is_array($elements[$delta]) ? $elements[$delta] : [$elements[$delta]];

      // Add children if available.
      if (!empty($branch)) {
        $item[]['#items'] = $this->getNestedListItemElements($items, $elements, $branch);
      }

      $result[] = $item;
    }

    return $result;
  }

  /**
   * Returns nested form elements.
   *
   * @param array $item_list_items
   *
   * @return array@return array
   */
  public function viewNestedElements(array $item_list_items) {
    return [
      '#theme' => 'item_list',
      '#items' => $item_list_items,
    ];
  }

}
