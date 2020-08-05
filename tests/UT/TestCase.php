<?php

namespace Tests\WGT\UT;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use Tests\WGT\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var mixed
     */
    protected $testedClass;

    /**
     * @var string
     */
    protected $testedClassName;

    /**
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * @var boolean
     */
    protected $activeReflection = false;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadTestedClass();
        $this->loadReflection();
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function loadTestedClass(): bool
    {
        if (empty($this->testedClassName)) {
            throw new Exception('The testedClassName field needs to be defined.');
        }

        $this->testedClass = app($this->testedClassName);

        return true;
    }

    /**
     * @return bool
     */
    protected function loadReflection(): bool
    {
        if (!$this->activeReflection) {
            return false;
        }

        $this->reflection = new ReflectionClass($this->testedClass);

        return true;
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        $this->testedClass = null;
        $this->reflection = null;
    }

    /**
     * @param string $property
     * @return ReflectionProperty
     */
    protected function accessProperty(string $property): ReflectionProperty
    {
        $this->activeReflection = true;
        $this->loadReflection();

        $reflectionProperty = $this->reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty;
    }

    /**
     * @param string method
     * @return ReflectionMethod
     */
    protected function accessMethod(string $method): ReflectionMethod
    {
        $this->activeReflection = true;
        $this->loadReflection();

        $reflectionMethod = $this->reflection->getMethod($method);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod;
    }
}
