<?php

return array(
    'class-a' => array(
        'class'=>'Tests\\DummyServices\\ClassA',
    ),
    'class-b' => array(
        'class'=>'Tests\\DummyServices\\ClassB',
        'arguments' => array(
            'class-a'
        )
    ),
    'class-c' => array(
        'class'=>'Tests\\DummyServices\\ClassC',
        'arguments' => array(
            'class-b'
        )
    ),
);
