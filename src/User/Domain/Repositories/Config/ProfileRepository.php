<?php

namespace PhpLab\Sandbox\User\Domain\Repositories\Config;

use PhpLab\Sandbox\Common\Enums\TimeEnum;
use PhpLab\Sandbox\Crypt\Entities\JwtProfileEntity;
use PhpLab\Sandbox\Crypt\Entities\KeyEntity;

class ProfileRepository
{

    public function oneByName(string $profileName)  {
        $profileEntity = new JwtProfileEntity;
        $profileEntity->name = $profileName;
        $profileEntity->key = new KeyEntity;
        $profileEntity->key->private = 'W4PpvVwI82Rfl9fl2R9XeRqBI0VFBHP3';
        $profileEntity->life_time = TimeEnum::SECOND_PER_YEAR;
        return $profileEntity;
    }

}