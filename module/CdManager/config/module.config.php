<?php

// module/CdManager/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'CdManager\Controller\CdManager' => 'CdManager\Controller\CdManagerController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'CdManager' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/CdManager[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'CdManager\Controller\CdManager',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'CdManager' => __DIR__ . '/../view',
        ),
    ),
);
