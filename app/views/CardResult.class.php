<?php

namespace views;

use lib\BaseCard;
use model\CandidatModel;

final class CardResult extends BaseCard
{
    private $candidatModel;
    private $result;
    private $firstCandidatPercentage;

    /**
     * setter and getter
     */
    public function setFirstCandidatPercentage(int $firstCandidatPercentage): void
    {
        $this->firstCandidatPercentage = $firstCandidatPercentage;
    }
    public function getFirstCandidatPercentage(): int
    {
        return $this->firstCandidatPercentage;
    }
    public function setResult(string $result): void
    {
        $this->result = $result;
    }
    public function  getResult(): string
    {
        return $this->result;
    }
    public function setCandidatModel(CandidatModel $candidatModel): void
    {
        $this->candidatModel = $candidatModel;
    }
    public function getCandidatModel(): CandidatModel
    {
        return $this->candidatModel;
    }

    public function __construct()
    {
        $this->setCandidatModel(new CandidatModel());
        $this->setTitle("Result");
        $this->setFirstCandidatPercentage($this->candidatModel->getFirstCandidatPercentage());
        $this->setmessage($this->calculResult());
    }

    private function calculResult(): string
    {
        if ($this->firstCandidatPercentage > 0) {
            $this->setResult($this->firstCandidatPercentage);
        }
        return $this->result;
    }


    public function render(): string
    {
        return parent::render();
    }
    // -----------------
}
