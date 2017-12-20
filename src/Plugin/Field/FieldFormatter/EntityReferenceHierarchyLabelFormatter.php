<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;

/**
 * Plugin implementation of the 'entity reference revisions rendered entity' formatter.
 *
 * @FieldFormatter(
 *   id = "entity_reference_hierarchy_label",
 *   label = @Translation("Label (with hierarchy)"),
 *   description = @Translation("Display the label of the referenced entities in hierarchical tree."),
 *   field_types = {
 *     "entity_reference_hierarchy"
 *   }
 * )
 */
class EntityReferenceHierarchyLabelFormatter extends EntityReferenceLabelFormatter {

  use EntityReferenceHierarchyFormatterTrait;

}
