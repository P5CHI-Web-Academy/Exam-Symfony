<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'maker.generator' shared service.

return $this->privates['maker.generator'] = new \Symfony\Bundle\MakerBundle\Generator(($this->privates['maker.file_manager'] ?? $this->load('getMaker_FileManagerService.php')), 'App');
