<?php

namespace PhpLab\Sandbox\Crypt\Services;

use PhpLab\Sandbox\Common\Traits\ClassAttribute\MagicSetTrait;
use PhpLab\Sandbox\Crypt\Entities\JwtEntity;
use PhpLab\Sandbox\Crypt\Helpers\JwtEncodeHelper;
use PhpLab\Sandbox\Crypt\Helpers\JwtHelper;
use PhpLab\Sandbox\Crypt\Libs\ProfileContainer;

class JwtService
{

    use MagicSetTrait;

    /** @var ProfileContainer */
    private $profileContainer;

    public function sign(JwtEntity $jwtEntity, string $profileName): string
    {
        $profileEntity = $this->profileContainer->get($profileName);
        $token = JwtHelper::sign($jwtEntity, $profileEntity);
        return $token;
    }

    public function verify(string $token, string $profileName): JwtEntity
    {
        $profileEntity = $this->profileContainer->get($profileName);
        $jwtEntity = JwtHelper::decode($token, $profileEntity);
        return $jwtEntity;
    }

    public function decode(string $token)
    {
        $jwtEntity = JwtEncodeHelper::decode($token);
        return $jwtEntity;
    }

    public function setProfiles($profiles)
    {
        if (is_array($profiles)) {
            $this->profileContainer = new ProfileContainer($profiles);
        } else {
            $this->profileContainer = $profiles;
        }
    }

    public function __construct($profiles = [])
    {
        $this->setProfiles($profiles);
    }

}
