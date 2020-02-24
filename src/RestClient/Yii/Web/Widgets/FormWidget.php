<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\Widgets;

use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\AuthorizationServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\ProjectServiceInterface;
use Yii;
use yii\base\Widget;

class FormWidget extends Widget
{

    public $projectId;
    public $model;

    /** @var AuthorizationServiceInterface */
    protected $authorizationService;
    /** @var ProjectServiceInterface */
    protected $projectService;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->authorizationService = Yii::$container->get(AuthorizationServiceInterface::class);
        $this->projectService = Yii::$container->get(ProjectServiceInterface::class);
    }

    public function run()
    {
        $projectEntity = $this->projectService->oneById($this->projectId);
        return $this->renderFile(__DIR__ . '/../views/request/_form.php', [
            'model' => $this->model,
            'projectEntity' => $projectEntity,
            'authorization' => $this->authorizationService->allByProjectId($projectEntity->getId(), 'bearer'),
        ]);
    }

}
