<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Input;

use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class IsCrudServiceInputScenario extends BaseInputScenario
{

    protected function paramName()
    {
        return 'idCrudService';
    }

    protected function question(): Question
    {
        $question = new ConfirmationQuestion(
            'Is CRUD service? (y|n): ',
            false
        );
        return $question;
    }

}
