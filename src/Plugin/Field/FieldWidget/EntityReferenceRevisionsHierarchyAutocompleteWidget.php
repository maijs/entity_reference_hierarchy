<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldWidget;

use Drupal\entity_reference_revisions\Plugin\Field\FieldWidget\EntityReferenceRevisionsAutocompleteWidget;

/**
 * Plugin implementation of the 'entity_reference_revisions_hierarchy_autocomplete' widget.
 *
 * @FieldWidget(
 *   id = "entity_reference_revisions_hierarchy_autocomplete",
 *   label = @Translation("Autocomplete (hierarchy, revisioned)"),
 *   description = @Translation("An autocomplete text field."),
 *   field_types = {
 *     "entity_reference_revisions_hierarchy"
 *   }
 * )
 */
class EntityReferenceRevisionsHierarchyAutocompleteWidget extends EntityReferenceRevisionsAutocompleteWidget {

  use EntityReferenceHierarchyWidgetTrait;

}
