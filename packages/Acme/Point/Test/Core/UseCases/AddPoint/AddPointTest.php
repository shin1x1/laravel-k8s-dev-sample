<?php

namespace Acme\Test\Core\UseCasses\AddPoint;

use Acme\Point\Core\UseCases\AddPoint\AddPointPort;
use Acme\Point\Core\UseCases\AddPoint\AddPointUseCase;
use PHPUnit\Framework\TestCase;

class AddPointUseCaseTest extends TestCase
{
    private AddPointPort $mockAdapter;

    protected function setUp()
    {
        parent::setUp();

        $this->mockAdapter = new class implements AddPointPort
        {
            public function existsId(int $customerId): bool
            {
                return true;
            }

            public function findPoint(int $customerId): int
            {
                return 200;
            }

            public function addPoint(int $customerId, int $addPoint): void
            {
            }
        };
    }


    /**
     * @test
     * @throws \Acme\Point\Domain\Exception\DomainRuleException
     */
    public function run_()
    {
        $useCase = new AddPointUseCase(
            $this->mockAdapter,
            );

        $actual = $useCase->run(1, 100);

        $this->assertSame(200, $actual);
    }

    /**
     * @test
     * @throws \Acme\Point\Domain\Exception\DomainRuleException
     * @expectedException \Acme\Point\Domain\Exception\DomainRuleException
     */
    public function run_with_negative_point()
    {
        $useCase = new AddPointUseCase(
            $this->mockAdapter,
            );

        $useCase->run(1, -1);
    }

    /**
     * @test
     * @throws \Acme\Point\Domain\Exception\DomainRuleException
     * @expectedException \Acme\Point\Domain\Exception\DomainRuleException
     */
    public function run_with_no_exists_customer_id()
    {
        $useCase = new AddPointUseCase(
            new class implements AddPointPort
            {
                public function existsId(int $customerId): bool
                {
                    return false;
                }

                public function findPoint(int $customerId): int
                {
                    return 0;
                }

                public function addPoint(int $customerId, int $addPoint): void
                {
                }
            },
            );

        $useCase->run(1, 10);
    }
}
