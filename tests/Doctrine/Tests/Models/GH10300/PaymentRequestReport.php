<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\GH10300;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @Entity
 */
class PaymentRequestReport extends Report
{
    /**
     * @ManyToMany(targetEntity="PaymentModule")
     * @JoinTable(name="report_payment_request_payment_module")
     * @var Collection<int, PaymentModule> $paymentModules
     */
    private Collection $paymentModules;

    /** @Column(type="boolean") */
    private bool $includeInvoices = false;

    public function __construct()
    {
        $this->paymentModules = new ArrayCollection();
    }

    public function getPaymentModules(): Collection
    {
        return $this->paymentModules;
    }

    public function addPaymentModule(PaymentModule $paymentModule): self
    {
        if (! $this->paymentModules->contains($paymentModule)) {
            $this->paymentModules[] = $paymentModule;
        }

        return $this;
    }

    public function removePaymentModule(PaymentModule $paymentModule): self
    {
        $this->paymentModules->removeElement($paymentModule);

        return $this;
    }

    public function getIncludeInvoices(): bool
    {
        return $this->includeInvoices;
    }

    public function setIncludeInvoices(bool $includeInvoices): self
    {
        $this->includeInvoices = $includeInvoices;

        return $this;
    }
}
