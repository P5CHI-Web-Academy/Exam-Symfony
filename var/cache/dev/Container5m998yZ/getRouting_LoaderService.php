<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'routing.loader' shared service.

$a = ($this->services['kernel'] ?? $this->get('kernel'));
$b = ($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService());

$c = new \Symfony\Component\HttpKernel\Config\FileLocator($a, '/application/src/Resources', array(0 => '/application/src'));

$d = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);

$e = new \Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader($b);

$f = new \Symfony\Component\Config\Loader\LoaderResolver();
$f->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($c));
$f->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($c));
$f->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($c));
$f->addLoader(new \Symfony\Component\Routing\Loader\GlobFileLoader($c));
$f->addLoader(new \Symfony\Component\Routing\Loader\DirectoryLoader($c));
$f->addLoader(new \Symfony\Component\Routing\Loader\DependencyInjection\ServiceRouterLoader($this));
$f->addLoader($d);
$f->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($c, $d));
$f->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($c, $d));
$f->addLoader($e);
$f->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($c, $e));
$f->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($c, $e));

return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader(($this->privates['controller_name_converter'] ?? $this->privates['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($a)), $f);
