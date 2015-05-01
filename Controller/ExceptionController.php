<?php

namespace Kamran\CoreBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as TwigExceptionController;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Request;



class ExceptionController extends TwigExceptionController{
    /**
     * @var HttpKernelInterface
     */
    protected $httpKernel;

    /**
     * @param HttpKernelInterface $httpKernel
     */
    public function setHttpKernel($httpKernel)
    {
        $this->httpKernel = $httpKernel;
    }


}