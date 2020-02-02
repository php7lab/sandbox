<?php

namespace PhpLab\Sandbox\Tests\rest\Messenger;

use PhpLab\Core\Common\Enums\Web\HttpStatusCodeEnum;
use PhpLab\Test\Base\BaseRestTest;

class ChatControllerTest extends BaseRestTest
{

    protected $basePath = 'api/v1/';

    public function testAll()
    {
        $response = $this->sendGet('messenger-chat', [
            'per-page' => '4',
            'page' => '2',
        ]);

        /*$actualBody = [
            [
                "id" => 5,
                "title" => 'chat 5',
                'type' => 'public',
            ],
            [
                "id" => 6,
                "title" => 'chat 6',
                'type' => 'public',
            ],
            [
                "id" => 7,
                "title" => 'chat 7',
                'type' => 'public',
            ],
            [
                "id" => 8,
                "title" => 'chat 8',
                'type' => 'public',
            ],
        ];
        $this->assertBody($response, $actualBody);
        $this->assertPagination($response, null, 2, 4);*/
        $this->assertEquals(HttpStatusCodeEnum::UNAUTHORIZED, $response->getStatusCode());
    }

}
