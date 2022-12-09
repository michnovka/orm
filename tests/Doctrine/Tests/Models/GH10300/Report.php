<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\GH10300;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({
 *  "payment_request" = "PaymentRequestReport",
 * })
 */
abstract class Report
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
