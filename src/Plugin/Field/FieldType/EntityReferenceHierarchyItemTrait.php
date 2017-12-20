<?php

namespace Drupal\entity_reference_hierarchy\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Class EntityReferenceHierarchyItemTrait
 */
trait EntityReferenceHierarchyItemTrait {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);

    $properties['index'] = DataDefinition::create('string')
      ->setLabel(t('Index'))
      ->setDescription(t('The index of a field item'));

    $properties['parent'] = DataDefinition::create('string')
      ->setLabel(t('Parent'))
      ->setDescription(t('The parent item of a field item'));

    $properties['depth'] = DataDefinition::create('integer')
      ->setLabel(t('Depth'))
      ->setDescription(t('The depth relative to the top level'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = parent::schema($field_definition);

    $schema['columns']['index'] = [
      'type' => 'int',
      'unsigned' => TRUE,
      'not null' => TRUE,
      'default' => 0,
    ];

    $schema['columns']['parent'] = [
      'type' => 'int',
      'unsigned' => TRUE,
      'not null' => TRUE,
      'default' => 0,
    ];

    $schema['columns']['depth'] = [
      'type' => 'int',
      'not null' => TRUE,
      'default' => 0,
      'size' => 'small',
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($values, $notify = TRUE) {
    parent::setValue($values, $notify);

    foreach (['index', 'parent', 'depth'] as $field) {
      $this->onChange($field, FALSE);
    }
  }

}
