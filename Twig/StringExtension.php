<?php

namespace Kamran\CoreBundle\Twig;


class StringExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('readable', array($this, 'readableFilter')),
        );
    }

    public function readableFilter($value)
    {
        if(!$value) return;
        $stringValue = strtolower(str_replace(" ","_",$value));
        return $stringValue;
    }

    public function getName()
    {
        return 'string_extension';
    }
}