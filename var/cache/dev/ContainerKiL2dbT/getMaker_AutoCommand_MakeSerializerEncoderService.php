<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'maker.auto_command.make_serializer_encoder' shared service.

$this->privates['maker.auto_command.make_serializer_encoder'] = $instance = new \Symfony\Bundle\MakerBundle\Command\MakerCommand(new \Symfony\Bundle\MakerBundle\Maker\MakeSerializerEncoder(), ($this->privates['maker.file_manager'] ?? $this->load('getMaker_FileManagerService.php')), ($this->privates['maker.generator'] ?? $this->load('getMaker_GeneratorService.php')));

$instance->setName('make:serializer:encoder');

return $instance;
