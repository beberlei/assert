# Upgrade notes

Dropped php 5.3 support.

Error code constants in `Assertion` class are now deprecated and will be removed in 4.0 release.
Preferred way is to use constants from `Assert\Assertion` namespace as follows:
```
# before 3.0:
\Assert\Assertion::INVALID_JSON_STRING

# 3.0:
\Assert\Assertion\INVALID_JSON_STRING
```
So you need to replace `::` with `\` before constant name.

These can be easily done with following regular expression search and replace: search for `Assertion::([A-Z_\d]+)` and replace with `Assertion\\$1`.
