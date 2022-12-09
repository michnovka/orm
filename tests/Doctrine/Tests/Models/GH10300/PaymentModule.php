<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\GH10300;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity
 */
class PaymentModule
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
