<?php

namespace PhpLab\Sandbox\Generator\Domain\Scenarios\Input;

use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class DomainNameInputScenario extends BaseInputScenario
{

    protected function paramName()
    {
        return 'domainName';
    }

    protected function question(): Question
    {
        $question = new Question('Enter domain name: ', '');
        return $question;
    }

}
