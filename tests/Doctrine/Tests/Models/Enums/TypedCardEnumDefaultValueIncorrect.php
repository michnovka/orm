<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\Enums;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class TypedCardEnumDefaultValueIncorrect
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[Column(enumType: Suit::class, enumDefaultValue: Unit::Gram)]
    public Suit $suit;
}
