<?php

namespace Drupal\entity_reference_hierarchy;

/**
 * Class EntityReferenceHierarchyFieldItemListTrait
 */
trait EntityReferenceHierarchyFieldItemListTrait {

  /**
   * Returns a hierarchical outline array, keyed by field item delta.
   *
   * @return array
   */
  public function getFieldHierarchyOutline() {
    // @todo Implement caching mechanism.
    $flat = [];
    $tree = [];

    // Store delta/index map.
    $delta_index_map = [];

    foreach ($this as $delta => $item) {
      $index = $item->get('index')->getValue();
      $parent = $item->get('parent')->getValue();
      $parent = !empty($parent) ? $parent : NULL;
      $delta_index_map[$index] = $delta;

      if (!isset($flat[$delta])) {
        $flat[$delta] = [];
      }

      if (!empty($parent)) {
        $flat[$delta_index_map[$parent]][$delta] = &$flat[$delta];
      } else {
        $tree[$delta] = &$flat[$delta];
      }
    }

    return $tree;
  }

  /**
   * {@inheritdoc}
   *
   * Resets the index, fixes broken index/parent relationships and calculates
   * proper depth.
   */
  public function setValue($values, $notify = TRUE) {
    // Mapping storage.
    $index_map = [];
    $depth_map = [];
    // Index counter.
    $index = 1;

    foreach ($values as $delta => $void) {
      // Shortcut to value.
      $value = &$values[$delta];

      // Ignore empty values.
      if (!$this->createItem(0, $value)->isEmpty()) {
        // Change index.
        $index_map[$value['index']] = $value['index'] = $index;
        $index++;
        // Change parent.
        $value['parent'] = isset($index_map[$value['parent']]) ? $index_map[$value['parent']] : 0;
        // Change depth.
        $depth_map[$value['index']] = !empty($value['parent']) ? $depth_map[$value['parent']] +  1 : 0;
        $value['depth'] = $depth_map[$value['index']];
      }
    }

    parent::setValue($values, $notify);
  }

}
