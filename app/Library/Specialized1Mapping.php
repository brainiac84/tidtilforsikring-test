<?php
namespace App\Library;


class Specialized1Mapping extends BaseMapping
{
    protected function getYUseRFormula()
    {
        return  2 * $this->D + ($this->D * $this->E / 100);
    }
}