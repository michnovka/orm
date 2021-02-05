<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional;

use Doctrine\Common\Collections\Collection;
use Doctrine\Tests\OrmFunctionalTestCase;

use function count;

/**
 * Base class for testing a many-to-many association mapping (without inheritance).
 */
class AbstractManyToManyAssociationTestCase extends OrmFunctionalTestCase
{
    protected $_firstField;
    protected $_secondField;
    protected $_table;

    public function assertForeignKeysContain($firstId, $secondId): void
    {
        $this->assertEquals(1, $this->_countForeignKeys($firstId, $secondId));
    }

    public function assertForeignKeysNotContain($firstId, $secondId): void
    {
        $this->assertEquals(0, $this->_countForeignKeys($firstId, $secondId));
    }

    protected function _countForeignKeys($firstId, $secondId)
    {
        return count($this->_em->getConnection()->executeQuery("
            SELECT {$this->_firstField}
              FROM {$this->_table}
             WHERE {$this->_firstField} = ?
               AND {$this->_secondField} = ?
        ", [$firstId, $secondId])->fetchAll());
    }

    public function assertCollectionEquals(Collection $first, Collection $second)
    {
        return $first->forAll(static function ($k, $e) use ($second) {
            return $second->contains($e);
        });
    }
}
