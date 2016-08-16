<?php

namespace Gr8abbasi\Container\Exception;

use Interop\Container\Exception\NotFoundException as InteropNotFoundException;

class NotFoundException extends \Exception implements InteropNotFoundException
{
}
