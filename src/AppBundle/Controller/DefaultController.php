<?php

namespace AppBundle\Controller;

use AppBundle\Job\HeavyLiftingJob;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/v1/hello/{name}", name="synchronous")
     *
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function synchronousAction($name)
    {
        $this->get('app_bundle.heavy_lifting')->lift($name);

        return $this->render('default/index.html.twig', [
            'name' => $name
        ]);
    }

    /**
     * @Route("/v2/hello/{name}", name="unsafe_asynchronous")
     *
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function unsafeAsynchronousAction($name)
    {
        $this->get('event_dispatcher')->addSubscriber($this->get('app_bundle.listener.heavy_lifting'));

        return $this->render('default/index.html.twig', [
            'name' => $name
        ]);
    }

    /**
     * @Route("/v3/hello/{name}", name="safe_asynchronous")
     *
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function safeAsynchronousAction($name)
    {
        $resque = $this->get('bcc_resque.resque');

        $job    = new HeavyLiftingJob([
            'name' => $name
        ]);

        $resque->enqueue($job);

        return $this->render('default/index.html.twig', [
            'name' => $name
        ]);
    }
}
