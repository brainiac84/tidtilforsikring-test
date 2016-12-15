<?php
namespace App\Library;


class Specialized2Mapping extends BaseMapping
{
    protected function getYUseSFormula()
    {
        return  $this->F + $this->D + ($this->D * $this->E / 100);
    }

    protected function verifyT()
    {
        return $this->A && $this->B && !$this->C;
    }

    protected function verifyS()
    {
        return $this->A && !$this->B && $this->C;
    }

}