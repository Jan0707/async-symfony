<?php

namespace AppBundle\Job;

use BCC\ResqueBundle\ContainerAwareJob;

class HeavyLiftingJob extends ContainerAwareJob
{
    /**
     * HeavyLiftingJob constructor.
     *
     * @param array $arguments
     */
    public function __construct(array $arguments = [])
    {
        $this->args = $arguments;
    }

    /**
     * @param array $args
     *
     * @throws \Exception
     */
    public function run($args)
    {
        if (!isset($args['name']) || !is_string($args['name'])) {
            throw new \Exception('Job has no name argument');
        }

        $this->getContainer()->get('app_bundle.heavy_lifting')->lift($args['name']);
    }
}
