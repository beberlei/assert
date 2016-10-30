# TODO

- Refactor unit tests into sets of related assertions.
- Refactor all unit tests to use the new recommend exception testing pattern as the current `setExpectedException()` method is deprecated.
- Maybe refactor names to be isXxx - maybe - but probably too much BC issues. Aliases are an option for BC (separate function library).
  Not really sure of the mileage on this. May simply not be worth it for the sake of consistent naming.
- Separate assertions into sets that deal with related themes:
  - Variable type (isInt, isString isBoolean, isArray, etc.)
  - Variable content (min, max, between, etc.)
  - Scalar structures (keyExists, keyIsSet etc),
  - Class/interface definition (classExists, subClassOf, etc).
  - Class/interface content (methodExists, propertyExists, propertyIsSettable, etc.)
