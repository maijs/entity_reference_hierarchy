<?php

use Drupal\field\FieldStorageConfigInterface;

/**
 * Implements hook_field_views_data().
 *
 * @param \Drupal\field\FieldStorageConfigInterface $field_storage
 *
 * @return array
 */
function entity_reference_hierarchy_field_views_data(FieldStorageConfigInterface $field_storage) {
  if (\Drupal::moduleHandler()->moduleExists('entity_reference_revisions')) {
    module_load_include('inc', 'entity_reference_revisions', 'entity_reference_revisions.views');
    return entity_reference_revisions_field_views_data($field_storage);
  }
}
