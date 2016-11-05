<?php

return [
    'class-a'         => [
        'class'       => 'Tests\\DummyServices\\ClassA',
    ],
    'class-b'         => [
        'class'       => 'Tests\\DummyServices\\ClassB',
        'arguments'   => [
            'class-a'
        ]
    ],
    'class-c'         => [
        'class'       => 'Tests\\DummyServices\\ClassC',
        'arguments'   => [
            'class-a',
            'class-b'
        ]
    ],
];
