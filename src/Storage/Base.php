<?php

namespace AccountModule\Storage;

class Base
{
    protected $ds;

    public function __construct($ds)
    {
        $this->ds = $ds;
    }
}
