<?php
declare(strict_types=1);

namespace App\Adapters;

use Acme\Point\Core\UseCases\AddPoint\AddPointPort;
use App\Eloquents\EloquentCustomer;
use App\Eloquents\EloquentCustomerPoint;

final class AddPointAdapter implements AddPointPort
{
    /** @var EloquentCustomer */
    private $customer;

    /** @var EloquentCustomerPoint */
    private $customerPoint;

    /**
     * @param EloquentCustomer $customer
     * @param EloquentCustomerPoint $customerPoint
     */
    public function __construct(EloquentCustomer $customer, EloquentCustomerPoint $customerPoint)
    {
        $this->customer = $customer;
        $this->customerPoint = $customerPoint;
    }

    /**
     * @param int $customerId
     * @return bool
     */
    public function existsId(int $customerId): bool
    {
        return $this->customer->existsId($customerId);
    }

    /**
     * @param int $customerId
     * @return int
     */
    public function findPoint(int $customerId): int
    {
        return $this->customerPoint->findPoint($customerId);
    }

    /**
     * @param int $customerId
     * @param int $addPoint
     */
    public function addPoint(int $customerId, int $addPoint): void
    {
        $this->customerPoint->addPoint($customerId, $addPoint);
    }
}
