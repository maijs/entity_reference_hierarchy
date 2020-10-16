# Entity reference hierarchy
This is a Drupal module that provides hierarchical entity reference field.

Entity reference field that comes with Drupal core allows creating a linear
list of entity references. This module allows creating hierarchical entity
references where each entity reference can be in a parent/child relationship
with another entity reference. It also supports revisions if used together
with [Entity reference revisions](https://www.drupal.org/project/entity_reference_revisions) module.

## Example

- Reference (delta 0)
- Reference (1)
  - Reference (2)
  - Reference (3)
    - Reference (4)
    - Reference (5)
  - Reference (6)
- Reference (7)

Entity reference items can be dragged and dropped with the same UI that
handles taxonomy menu links hierarchy.

## Installation
Download and enable as any other Drupal module.

## Configuration
- Add a field of type *Entity reference hierarchy* or *Entity reference revisions hierarchy* to your entity.
- That's it. Start entering content.
