# Assert

Travis Status: [![Build Status](https://secure.travis-ci.org/beberlei/assert.png?branch=master)](http://travis-ci.org/beberlei/assert)

A simple php library which contains assertions and guard methods for input validation (not filtering!) in business-model, libraries and application low-level code.
The library can be used to implement pre-/post-conditions on input data.

Idea is to reduce the amount of code for implementing assertions in your model and also simplify the code paths to implement assertions. When assertions fail, an exception is thrown, removing the necessity for if-clauses in your code.

The library is not using Symfony or Zend Validators for a reason: The checks have to be low-level, fast, non-object-oriented code to be used everywhere necessary. Using any of the two libraries requires instantiation of several objects, using a locale component, translations, you name it. Its too much bloat.

## Installation

Using Composer:

    {
        "require": {
            "beberlei/assert": "*"
        }
    }

## Example usages

    <?php
    use Assert\Assertion;

    function duplicateFile($file, $times)
    {
        Assertion::file($file);
        Assertion::digit($times);

        for ($i = 0; $i < $times; $i++) {
            copy($file, $file . $i);
        }
    }

Real time usage with [Azure Blob Storage](https://github.com/beberlei/azure-blob-storage/blob/master/lib/Beberlei/AzureBlobStorage/BlobClient.php#L571):

    public function putBlob($containerName = '', $blobName = '', $localFileName = '', $metadata = array(), $leaseId = null, $additionalHeaders = array())
    {
        Assertion::notEmpty($containerName, 'Container name is not specified');
        self::assertValidContainerName($containerName);
        Assertion::notEmpty($blobName, 'Blob name is not specified.');
        Assertion::notEmpty($localFileName, 'Local file name is not specified.');
        Assertion::file($localFileName, 'Local file name is not specified.');
        self::assertValidRootContainerBlobName($containerName, $blobName);

        // Check file size
        if (filesize($localFileName) >= self::MAX_BLOB_SIZE) {
            return $this->putLargeBlob($containerName, $blobName, $localFileName, $metadata, $leaseId, $additionalHeaders);
        }

        // Put the data to Windows Azure Storage
        return $this->putBlobData($containerName, $blobName, file_get_contents($localFileName), $metadata, $leaseId, $additionalHeaders);
    }

## List of assertions

    <?php
    use Assert\Assertion;

    Assertion::integer($value);
    Assertion::digit($value);
    Assertion::integerish($value);
    Assertion::range($value, $minValue, $maxValue);
    Assertion::boolean($value);
    Assertion::notEmpty($value);
    Assertion::notNull($value);
    Assertion::regex($value, $regex);
    Assertion::minLength($value, $length);
    Assertion::maxLength($value, $length);
    Assertion::betweenLength($value, $minLength, $maxLength);
    Assertion::startsWith($value, $needle);
    Assertion::isArray($value);
    Assertion::contains($value, $needle);
    Assertion::choice($value, $choices);
    Assertion::numeric($value);
    Assertion::keyExists($value, $key);
    Assertion::notBlank($value);
    Assertion::isInstanceOf($value, $className);
    Assertion::classExists($value);
    Assertion::subclassOf($value, $className);
    Assertion::directory($value);
    Assertion::file($value);
    Assertion::readable($value);
    Assertion::writeable($value);
    Assertion::email($value);
    Assertion::alnum($value);
    Assertion::true($value);

Remember: When a configuration parameter is necessary, it is always passed AFTER the value. The value is always the first parameter.

## Exception & Error Handling

If any of the assertions fails a subclass of `InvalidArgumentException` is thrown. You can pass a last argument to any assertion to control the message. Every exception contains a message code by default.

    <?php
    use Assert\Assertion;
    use Assert\InvalidArgumentException;

    try {
        Assertion::integer($value, "The pressure of gas is measured in integers.");
    } catch(InvalidArgumentException $e) {
        // error handling
    }

