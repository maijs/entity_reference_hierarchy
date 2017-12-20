<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldFormatter;

use Drupal\entity_reference_revisions\Plugin\Field\FieldFormatter\EntityReferenceRevisionsFormatterBase;

/**
 * Class EntityReferenceRevisionsHierarchyFormatterBase
 */
abstract class EntityReferenceRevisionsHierarchyFormatterBase extends EntityReferenceRevisionsFormatterBase {

  use EntityReferenceHierarchyFormatterTrait;

}
