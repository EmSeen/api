<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AbstractServiceTest extends TestCase
{
    protected function setEntityId(object $entity,int $value, $idField = 'id')
    {
        $class = new ReflectionClass($entity);
        $property = $class->getProperty($idField);
        $property->setAccessible(true);
        $property->setValue($entity, $value);
        $property->setAccessible(false);
    }
}
