<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldType;

use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;

/**
 * @FieldType(
 *   id = "entity_reference_hierarchy",
 *   label = @Translation("Entity reference hierarchy"),
 *   description = @Translation("An entity field containing an hierarchical entity reference."),
 *   category = @Translation("Reference"),
 *   default_widget = "entity_reference_hierarchy_autocomplete",
 *   default_formatter = "entity_reference_label",
 *   list_class = "\Drupal\entity_reference_hierarchy\EntityReferenceHierarchyFieldItemList",
 * )
 */
class EntityReferenceHierarchyItem extends EntityReferenceItem {

  use EntityReferenceHierarchyItemTrait;

}
