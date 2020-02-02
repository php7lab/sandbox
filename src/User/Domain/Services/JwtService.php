<?php

namespace PhpLab\Sandbox\User\Domain\Services;

//use PhpLab\Core\Legacy\Traits\ClassAttribute\MagicSetTrait;
use PhpLab\Sandbox\Crypt\Entities\JwtEntity;
use PhpLab\Sandbox\Crypt\Helpers\JwtEncodeHelper;
use PhpLab\Sandbox\Crypt\Helpers\JwtHelper;
use PhpLab\Sandbox\Crypt\Libs\ProfileContainer;
use PhpLab\Sandbox\User\Domain\Repositories\Config\ProfileRepository;

class JwtService
{

    //use MagicSetTrait;

    private $profileRepository;

    public function sign(JwtEntity $jwtEntity, string $profileName): string
    {
        $profileEntity = $this->profileRepository->oneByName($profileName);
        //print_r($profileEntity);exit;

        //print_r($profileEntity);exit;
        $token = JwtHelper::sign($jwtEntity, $profileEntity);
        return $token;
    }

    public function verify(string $token, string $profileName): JwtEntity
    {
        $profileEntity = $this->profileRepository->oneByName($profileName);
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

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

}
