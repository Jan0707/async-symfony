<?php

namespace AppBundle\Service;

use Psr\Log\LoggerInterface;

class HeavyLiftingService
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * HeavyLiftingService constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $name
     */
    public function lift($name)
    {
        $this->logger->notice('Beginning heavy lifting...');

        foreach (str_split($name) as $char) {
            $this->logger->notice($char);
            sleep(1);
        }

        $this->logger->notice('...ended heavy lifting.');
    }
}
