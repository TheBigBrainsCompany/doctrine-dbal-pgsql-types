<?php

/**
 * This file is part of Tbbc Doctrine DBAL Pgsql Types.
 *
 * (c) The Big Brains Company <contact@thebigbrainscompany.org>
 *
 */

namespace Tbbc\Doctrine\Tests\DBAL\Pgsql\Types;

use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * @author Benjamin Dulau <benjamin@thebigbrainscompany.com>
 */
class BinarySafeObjectTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PostgreSqlPlatform
     */
    private $platform;

    /**
     * @var \Tbbc\Doctrine\DBAL\Pgsql\Types\BinarySafeObjectType
     */
    private $type;

    public static function setUpBeforeClass()
    {
        Type::addType('tbbc_pgsql_binary_safe_object', "Tbbc\\Doctrine\\DBAL\\Pgsql\\Types\\BinarySafeObjectType");
    }

    protected function setUp()
    {
        $this->platform = new PostgreSqlPlatform();
        $this->type = Type::getType('tbbc_pgsql_binary_safe_object');
    }

    public function testDatabaseObjectValueConvertsToPHPValue()
    {
        $databaseValue = 'O:40:"Tbbc\\\\Doctrine\\\\Tests\\\\DBAL\\\\Pgsql\\\\Types\\\\Foo":3:{s:45:"\\000Tbbc\\\\Doctrine\\\\Tests\\\\DBAL\\\\Pgsql\\\\Types\\\\Foo\\000foo";s:3:"foo";s:6:"\\000*\\000bar";s:3:"bar";s:3:"baz";s:3:"baz";}';
        $foo = new Foo();

        $converted = $this->type->convertToPHPValue($databaseValue, $this->platform);
        $this->assertInstanceOf("Tbbc\\Doctrine\\Tests\\DBAL\\Pgsql\\Types\\Foo", $converted);
        $this->assertEquals($foo, $converted);
    }

    public function testPHPObjectConvertsToDatabaseValue()
    {
        $databaseValue = 'O:40:"Tbbc\\\\\\\\Doctrine\\\\\\\\Tests\\\\\\\\DBAL\\\\\\\\Pgsql\\\\\\\\Types\\\\\\\\Foo":3:{s:45:"\\\\000Tbbc\\\\\\\\Doctrine\\\\\\\\Tests\\\\\\\\DBAL\\\\\\\\Pgsql\\\\\\\\Types\\\\\\\\Foo\\\\000foo";s:3:"foo";s:6:"\\\\000*\\\\000bar";s:3:"bar";s:3:"baz";s:3:"baz";}';
        $foo = new Foo();

        $converted = $this->type->convertToDatabaseValue($foo, $this->platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($databaseValue, $converted);
    }
}

class Foo
{
    private $foo;
    protected $bar;
    public $baz;

    public function __construct()
    {
        $this->foo = 'foo';
        $this->bar = 'bar';
        $this->baz = 'baz';
    }

    public function getFoo()
    {
        return $this->foo;
    }

    public function getBar()
    {
        return $this->bar;
    }
}
