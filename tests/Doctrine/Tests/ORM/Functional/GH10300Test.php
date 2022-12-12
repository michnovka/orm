<?php

declare(strict_types=1);

namespace Doctrine\Tests\ORM\Functional;

use Doctrine\Tests\Models\GH10300\PaymentModule;
use Doctrine\Tests\Models\GH10300\PaymentRequestReport;
use Doctrine\Tests\Models\GH10300\PaypalPaymentModule;
use Doctrine\Tests\Models\GH10300\Report;
use Doctrine\Tests\OrmFunctionalTestCase;

use function var_dump;

class GH10300Test extends OrmFunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->createSchemaForModels(
            Report::class,
            PaymentRequestReport::class,
            PaymentModule::class,
            PaypalPaymentModule::class
        );
    }

    public function testInheritanceMapping(): void
    {
        $paymentModule1 = new PaypalPaymentModule('name1');
        $paymentModule2 = new PaypalPaymentModule('name2');

        $this->_em->persist($paymentModule1);
        $this->_em->persist($paymentModule2);
        $this->_em->flush();

        $report = new PaymentRequestReport();

        $report->addPaymentModule($paymentModule1);
        $report->addPaymentModule($paymentModule2);
        $this->_em->persist($report);
        $this->_em->flush();
        $reportId = $report->getId();
        $this->_em->clear();

        $report = $this->_em->createQueryBuilder()
            ->select('r')
            ->from(Report::class, 'r')
            ->where('r.id = :reportId')
            ->setParameter('reportId', $reportId)
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleResult();

        self::assertInstanceOf(PaymentRequestReport::class, $report);
        $paymentModules = $report->getPaymentModules();
        self::assertEquals(2, $paymentModules->count());
    }
}
