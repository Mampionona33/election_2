<?php

namespace views;

use lib\BaseCard;
use model\CandidatModel;

final class CardResult extends BaseCard
{
    private $candidatModel;
    private $result;
    private $firstCandidat;
    private $candidatWithMaxPoint;
    private $firstCandidatPercentage;
    private $firstCandidatName;
    private $overCandidatWinPercentage;

    /**
     * setter and getter
     */
    public function setOverCandidatWinPercentage(int $overCandidatWinPercentage): void
    {
        $this->overCandidatWinPercentage = $overCandidatWinPercentage;
    }
    public function getOverCandidatWinPercentage(): int
    {
        return $this->overCandidatWinPercentage;
    }
    public function setFirstCandidatName(string $firstCandidatName): void
    {
        $this->firstCandidatName = $firstCandidatName;
    }
    public function getFirstCandidatName(): string
    {
        return $this->firstCandidatName;
    }
    public function setFirstCandidatPercentage(int $firstCandidatPercentage): void
    {
        $this->firstCandidatPercentage = $firstCandidatPercentage;
    }
    public function getFirstCandidatPercentage(): int
    {
        return $this->firstCandidatPercentage;
    }
    public function setCandidatWithMaxPoint(array $candidatWithMaxPoint): void
    {
        $this->candidatWithMaxPoint = $candidatWithMaxPoint;
    }
    public function getCandidatWithMaxPoint(): array
    {
        return $this->candidatWithMaxPoint;
    }
    public function setFirstCandidat(array $firstCandidat): void
    {
        $this->firstCandidat = $firstCandidat;
    }
    public function getFirstCandidat(): array
    {
        return $this->firstCandidat;
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
    // ---------------------------------------


    public function __construct()
    {
        $this->setCandidatModel(new CandidatModel());
        $this->setFirstCandidat($this->candidatModel->getFirstCandidat());
        $this->setCandidatWithMaxPoint($this->candidatModel->getCandidatWithMaxPoint());
        $this->setmessage($this->calculResult());
        $this->setTitle("Result pour le candidat : $this->firstCandidatName");
        $this->setIcon("how_to_vote");
        $this->setIconBackground("#bbb");
    }

    private function calculResult(): string
    {
        if (!empty($this->firstCandidat) && !empty($this->candidatWithMaxPoint)) {

            $this->setFirstCandidatPercentage($this->firstCandidat[0]["percentage"]);
            $this->setFirstCandidatName($this->firstCandidat[0]["name"]);
            $this->setOverCandidatWinPercentage($this->candidatWithMaxPoint[0]["percentage"]);

            if (!empty(array_diff($this->firstCandidat[0], $this->candidatWithMaxPoint[0]))) {
                if ($this->firstCandidat[0]["percentage"] >= 12.5) {
                    $this->setResult("Le candidat $this->firstCandidatName participe au deuxième tour en ballotage défavorable avec un suffrage de $this->firstCandidatPercentage %.");
                } else {
                    $this->setResult("Le candidat $this->firstCandidatName est battu à la première tour avec un suffrage de $this->firstCandidatPercentage %.");
                }
            } else {
                if ($this->firstCandidatPercentage >= 50) {
                    $this->setResult("$this->firstCandidatName est élu à la première tour avec un suffrage de $this->firstCandidatPercentage %.");
                } else {
                    $this->setResult("Le candidat $this->firstCandidatName participe au deuxième tour en ballotage favorable avec un suffrage de $this->firstCandidatPercentage %.");
                }
            }
        }
        return $this->result;
    }

    public function render(): string
    {
        return parent::render();
    }
}
