<?php

namespace Assert\Tests\Fixtures;

class OneCountable implements \Countable
{
    public function count()
    {
        return 1;
    }
}
