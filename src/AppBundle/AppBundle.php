<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use AppBundle\DependencyInjection\AppExtension;

class AppBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new AppExtension();
    }
}
