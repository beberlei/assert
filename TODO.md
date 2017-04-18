# TODO

- Refactor unit tests into sets of related assertions.
- Refactor all unit tests to use the new recommend exception testing pattern as the current `setExpectedException()` method is deprecated.
- Separate assertions into sets that deal with related themes:
  - Variable type (isInt, isString isBoolean, isArray, etc.)
  - Variable content (min, max, between, etc.)
  - Scalar structures (keyExists, keyIsSet etc),
  - Class/interface definition (classExists, subClassOf, etc).
  - Class/interface content (methodExists, propertyExists, propertyIsSettable, etc.)
