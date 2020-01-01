<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Input;

use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class TypeInputScenario extends BaseInputScenario
{

    protected function paramName()
    {
        return 'types';
    }

    protected function question(): Question
    {
        $typeArray = $this->buildDto->typeArray;
        $typeArray['a'] = 'all';
        $question = new ChoiceQuestion(
            'Select types',
            $typeArray,
            'a'
        );
        $question->setMultiselect(true);
        return $question;
    }

    public function run()
    {
        $question = $this->question();
        $types = $this->ask($question);
        //$types = ['a'];
        $this->buildDto->types = $this->filterValue($types);
    }

    private function filterValue($value) {
        if(in_array('a', $value)) {
            $value = array_keys($this->buildDto->typeArray);
        }
        $value = array_map(function ($item) {
            return intval($item);
        }, $value);
        return $value;
    }

}
