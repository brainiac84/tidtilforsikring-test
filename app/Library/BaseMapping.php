<?php
namespace App\Library;

class BaseMapping
{
    protected $A, $B, $C, $D, $E, $F;

    /**
     * BaseRules constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->A = (bool)$values['A'];
        $this->B = (bool)$values['B'];
        $this->C = (bool)$values['C'];
        $this->D = (int)$values['D'];
        $this->E = (int)$values['E'];
        $this->F = (int)$values['F'];
    }

    /**
     * @return array
     */
    public function getResult()
    {
        if ($this->verifyS()) {
            return ['X' => 'S', 'Y' => $this->getYUseSFormula()];
        }

        if ($this->verifyR()) {
            return ['X' => 'R', 'Y' => $this->getYUseRFormula()];
        }

        if ($this->verifyT()) {
            return ['X' => 'T', 'Y' => $this->getYUseTFormula()];
        }

        throw new \LogicException("At least one of rules should be satisfied");
    }

    /**
     * @return bool
     */
    protected function verifyS()
    {
        return $this->A && $this->B && !$this->C;
    }

    /**
     * @return bool
     */
    protected function verifyR()
    {
        return $this->A && $this->B && $this->C;
    }

    /**
     * @return bool
     */
    protected function verifyT()
    {
        return !$this->A && $this->B && $this->C;
    }

    protected function getYUseSFormula()
    {
        return $this->D + ($this->D * $this->E / 100);
    }

    protected function getYUseRFormula()
    {
        return $this->D + ($this->D * ($this->E - $this->F) / 100);
    }

    protected function getYUseTFormula()
    {
        return $this->D - ($this->D * $this->F / 100);
    }
}