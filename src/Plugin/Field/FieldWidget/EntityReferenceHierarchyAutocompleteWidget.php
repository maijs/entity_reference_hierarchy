<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldWidget;

use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;

/**
 * Plugin implementation of the 'entity_reference_hierarchy_autocomplete' widget.
 *
 * @FieldWidget(
 *   id = "entity_reference_hierarchy_autocomplete",
 *   label = @Translation("Autocomplete (hierarchy)"),
 *   description = @Translation("An autocomplete text field."),
 *   field_types = {
 *     "entity_reference_hierarchy"
 *   }
 * )
 */
class EntityReferenceHierarchyAutocompleteWidget extends EntityReferenceAutocompleteWidget {

  use EntityReferenceHierarchyWidgetTrait;

}
