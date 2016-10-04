# TODO

- Upgrade assertions to return true on successful assertion to allow this library to be used with PHP7's assert() functionality.
- Refactor unit tests into sets of related assertions.
- Maybe refactor names to be isXxx - maybe - but probably too much BC issues. Aliases are an option for BC (separate function library).
  Not really sure of the mileage on this. May simply not be worth it for the sake of consistent naming.
- Separate assertions into sets that deal with related themes:
  - Variable type (isInt, isString isBoolean, isArray, etc.)
  - Variable content (min, max, between, etc.)
  - Scalar structures (keyExists, keyIsSet etc),
  - Class/interface definition (classExists, subClassOf, etc).
  - Class/interface content (methodExists, propertyExists, propertyIsSettable, etc.)
