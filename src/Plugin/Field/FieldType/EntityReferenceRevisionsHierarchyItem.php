<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldType;

use Drupal\entity_reference_revisions\Plugin\Field\FieldType\EntityReferenceRevisionsItem;

/**
 * Defines the 'entity_reference_revisions_hierarchy' entity field type.
 *
 * @FieldType(
 *   id = "entity_reference_revisions_hierarchy",
 *   label = @Translation("Entity reference revisions hierarchy"),
 *   description = @Translation("An entity field containing a hierarchical entity reference to a specific revision"),
 *   category = @Translation("Reference"),
 *   default_widget = "entity_reference_revisions_hierarchy_autocomplete",
 *   default_formatter = "entity_reference_label",
 *   list_class = "\Drupal\entity_reference_hierarchy\EntityReferenceRevisionsHierarchyFieldItemList",
 * )
 */
class EntityReferenceRevisionsHierarchyItem extends EntityReferenceRevisionsItem {

  use EntityReferenceHierarchyItemTrait;

}
