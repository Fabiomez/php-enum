<?php

namespace Tests;

use Fabiomez\Enum\Enum;

/**
 * @method static self CONST_1
 * @method static self CONST_2
 * @method static self CONST_3
 */
class EnumSample2 extends Enum
{
    const CONST_1 = 'S2';
    const CONST_2 = 22;
    const CONST_3 = 2.3;
}
