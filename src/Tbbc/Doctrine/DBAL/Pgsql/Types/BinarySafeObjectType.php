<?php

/**
 * This file is part of Tbbc Doctrine DBAL Pgsql Types.
 *
 * (c) The Big Brains Company <contact@thebigbrainscompany.org>
 *
 */

namespace Tbbc\Doctrine\DBAL\Pgsql\Types;

/**
 * Type that maps a PHP object to a binary safe clob SQL type.
 */
class BinarySafeObjectType extends BinarySafeArrayType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tbbc_pgsql_binary_safe_object';
    }
}
