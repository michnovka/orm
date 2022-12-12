<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\GH10300;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 */
class PaypalPaymentModule extends PaymentModule
{
    /** @Column(type="string") */
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
