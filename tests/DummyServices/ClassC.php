<?php

namespace Tests\DummyServices;

class ClassC
{
    public function __construct(ClassA $a, ClassB $b)
    {
        echo 'I\'m C!';
    }

}
