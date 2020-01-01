<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Input;

use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class NameInputScenario extends BaseInputScenario
{

    protected function paramName()
    {
        return 'name';
    }

    protected function question(): Question
    {
        $question = new Question('Enter unit name: ');
        return $question;
    }

}
