<?php


namespace Kamran\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BaseController extends Controller
{

    protected function renderJson($data, $status = 200, $headers = array())
    {
        if ($this->get('request')->get('_xml_http_request')
            && strpos($this->get('request')->headers->get('Content-Type'), 'multipart/form-data') === 0) {
            $headers['Content-Type'] = 'text/plain';
        } else {
            $headers['Content-Type'] = 'application/json';
        }

        return new Response(json_encode($data), $status, $headers);
    }

    protected function isXmlHttpRequest()
    {
        return $this->get('request')->isXmlHttpRequest() || $this->get('request')->get('_xml_http_request');
    }

    protected function getBaseTemplate()
    {
       // get own developed Layout/Themes
       /* if ($this->isXmlHttpRequest()) {
            return $this->admin->getTemplate('ajax');
        }

        return $this->admin->getTemplate('layout');*/
    }

    public function render($view, array $parameters = array(), Response $response = null)
    {
        // Inject your own sysmtem variables
        //$parameters['admin'] = isset($parameters['admin']) ? $parameters['admin'] : $this->admin;
        //$parameters['base_template'] = isset($parameters['base_template']) ? $parameters['base_template'] : $this->getBaseTemplate();
        //$parameters['admin_pool'] = $this->get('sonata.admin.pool');

        return parent::render($view, $parameters, $response);
    }

    protected function addFlash($type, $message)
    {
        $this->get('session')
            ->getFlashBag()
            ->add($type, $message);
    }


    protected function validateCsrfToken($intention)
    {
        if (!$this->container->has('form.csrf_provider')) {
            return;
        }

        if (!$this->container->get('form.csrf_provider')->isCsrfTokenValid($intention, $this->get('request')->request->get('_sonata_csrf_token', false))) {
            throw new HttpException(400, "The csrf token is not valid, CSRF attack ?");
        }
    }

    protected function getCsrfToken($intention)
    {
        if (!$this->container->has('form.csrf_provider')) {
            return false;
        }
        return $this->container->get('form.csrf_provider')->generateCsrfToken($intention);
    }


}
