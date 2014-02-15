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
class BinarySafeArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PostgreSqlPlatform
     */
    private $platform;

    /**
     * @var \Tbbc\Doctrine\DBAL\Pgsql\Types\BinarySafeArrayType
     */
    private $type;

    public static function setUpBeforeClass()
    {
        Type::addType('tbbc_pgsql_binary_safe_array', "Tbbc\\Doctrine\\DBAL\\Pgsql\\Types\\BinarySafeArrayType");
    }

    protected function setUp()
    {
        $this->platform = new PostgreSqlPlatform();
        $this->type = Type::getType('tbbc_pgsql_binary_safe_array');
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testDatabaseArrayValueConvertsToPHPValue($databaseValue, $phpValue)
    {
        $converted = $this->type->convertToPHPValue($databaseValue, $this->platform);
        $this->assertInternalType('array', $converted);
        $this->assertEquals($phpValue, $converted);
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testPHPArrayConvertsToDatabaseValue($databaseValue, $phpValue)
    {
        $converted = $this->type->convertToDatabaseValue($phpValue, $this->platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($databaseValue, $converted);
    }

    /**
     * Provider for conversion test values
     *
     * @return array
     */
    public static function databaseConvertProvider()
    {
        return array(
            array('a:1:{s:3:"foo";s:3:"bar";}', array('foo' => 'bar'))
        );
    }
}
