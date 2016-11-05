<?php

namespace Tests\DummyServices;

class ClassB
{
    public function __construct(ClassA $a)
    {
        echo 'I\'m B!';
    }

}
