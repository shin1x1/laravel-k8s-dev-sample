<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPoint;

interface AddPointPort
{
    /**
     * @param int $customerId
     * @return bool
     */
    public function existsId(int $customerId): bool;

    /**
     * @param int $customerId
     * @return int
     */
    public function findPoint(int $customerId): int;

    /**
     * @param int $customerId
     * @param int $addPoint
     */
    public function addPoint(int $customerId, int $addPoint): void;
}
