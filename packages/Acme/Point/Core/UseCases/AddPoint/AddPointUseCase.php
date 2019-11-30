<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPoint;

use Acme\Point\Domain\Exception\DomainRuleException;

final class AddPointUseCase
{
    private AddPointPort $port;

    /**
     * @param AddPointPort $port
     */
    public function __construct(AddPointPort $port)
    {
        $this->port = $port;
    }

    /**
     * @param int $customerId
     * @param int $addPoint
     * @return int
     * @throws DomainRuleException
     */
    public function run(int $customerId, int $addPoint): int
    {
        if ($addPoint <= 0) {
            throw new DomainRuleException('add_point should be equals or greater than 1');
        }

        if (!$this->port->existsId($customerId)) {
            $message = sprintf('customer_id:%d does not exists', $customerId);
            throw new DomainRuleException($message);
        }

        $this->port->addPoint($customerId, $addPoint);

        return $this->port->findPoint($customerId);
    }
}
