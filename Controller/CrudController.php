<?php

namespace Kamran\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PropertyAccess\PropertyAccess;


abstract class CrudController extends BaseController{


    private $bundleName;
    private $entityName;

    abstract protected function getEntity();



    protected function getBundleAndEntityName(){

        try {
            list($bundleName, $entityName) = explode(':', $this->getEntity());
        } catch (\Exception $e) {
            throw new \InvalidArgumentException(sprintf('Return format of method getEntity() is invalid. Expected a string of format BundleName:EntityName, got %s', $this->getEntity()));
        }

        return array('bundle' => $bundleName, 'entity' => $entityName);
    }

    protected function getBundleName()
    {
        if (!$this->bundleName) {
            $names = $this->getBundleAndEntityName();
            $this->bundleName = $names['bundle'];
        }

        return $this->bundleName;
    }




    public function doAdd(Request $request , $params = array()){

        $defaultCrudTemplate = 'KamranArticleBundle:Labs:crud.html.twig';
        $form = $this->createForm($params['form'], new $params['entity']);
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                echo "Form Submited";
            }
        }
        $params['form'] = $form->createView();

        return $this->renderForm($defaultCrudTemplate , $params);
    }


    public function renderForm($template,$data=array()){
        $layoutVars = array('themes'=>'KamranThemeBundle::themes/blue-developer/page.html.twig');
        return parent::render( $template ,array_merge($data,$layoutVars),null);
    }


}

