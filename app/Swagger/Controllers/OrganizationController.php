<?php

namespace App\Swagger\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoordinateRequest;
use OpenApi\Attributes as OA;

#[OA\Info(version: '1.0', title: 'Organizations')]
class OrganizationController extends Controller
{
    #[OA\Get(
        path: '/api/v1/{token}/organizations/building/{building_id}',
        description: 'Возвращает список организаций, связанных с конкретным зданием.',
        summary: 'Получить организации по ID здания',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'token', description: 'По умолчания - aboba', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'building_id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: [
                    new OA\JsonContent(properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'code', type: 'integer', example: 200),
                        new OA\Property(property: 'message', type: 'string', example: 'Запрос прошел успешно'),
                        new OA\Property(property: 'data', type: 'string', example: []),
                    ])
                ]
            ),
        ]
    )]
    public function showByBuilding(string $token, int $buildingId): void
    {

    }

    #[OA\Get(
        path: '/api/v1/{token}/organizations/activity/{activity_id}',
        description: 'Возвращает список организаций, связанных с конкретной активностью.',
        summary: 'Получить организации по ID активности',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'token', description: 'По умолчания - aboba', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'activity_id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: [
                    new OA\JsonContent(properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'code', type: 'integer', example: 200),
                        new OA\Property(property: 'message', type: 'string', example: 'Запрос прошел успешно'),
                        new OA\Property(property: 'data', type: 'string', example: []),
                    ])
                ]
            ),
        ]
    )]
    public function showByActivity(string $token, int $activityId): void
    {

    }

    #[OA\Get(
        path: '/api/v1/{token}/organizations/{organization_id}',
        description: 'Возвращает данные конкретной организации.',
        summary: 'Получить информацию об организации по её ID',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'token', description: 'По умолчания - aboba', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'organization_id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: [
                    new OA\JsonContent(properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'code', type: 'integer', example: 200),
                        new OA\Property(property: 'message', type: 'string', example: 'Запрос прошел успешно'),
                        new OA\Property(property: 'data', type: 'string', example: []),
                    ])
                ]
            ),
        ]
    )]
    public function show(string $token, int $organizationId): void
    {

    }

    #[OA\Get(
        path: '/api/v1/{token}/organizations/activity/{activity_id}/recursive',
        description: 'Возвращает список организаций, связанных с конкретной активностью (учитывает вложенность).',
        summary: 'Получить организации по ID активности (учитывает вложенность)',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'token', description: 'По умолчания - aboba', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'activity_id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: [
                    new OA\JsonContent(properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'code', type: 'integer', example: 200),
                        new OA\Property(property: 'message', type: 'string', example: 'Запрос прошел успешно'),
                        new OA\Property(property: 'data', type: 'string', example: []),
                    ])
                ]
            ),
        ]
    )]
    public function showByActivityRecursive(string $token, int $activityId): void
    {

    }

    #[OA\Get(
        path: '/api/v1/{token}/organizations/search/{text}',
        description: 'Ищет организации по названию',
        summary: 'Поиск организаций по названию',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'token', description: 'По умолчания - aboba', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'text', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: [
                    new OA\JsonContent(properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'code', type: 'integer', example: 200),
                        new OA\Property(property: 'message', type: 'string', example: 'Запрос прошел успешно'),
                        new OA\Property(property: 'data', type: 'string', example: []),
                    ])
                ]
            ),
        ]
    )]
    public function searchOrganizations(string $token, string $text): void
    {

    }

    #[OA\Get(
        path: '/api/v1/{token}/organizations/coordinates',
        description: 'озвращает список организаций, находящихся в пределах указанных координат.',
        summary: 'Получить организации по координатам',
        tags: ['Organizations'],
        parameters: [
            new OA\Parameter(name: 'token', description: 'По умолчания - aboba', in: 'path', required: true, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'lat_min', description: 'Минимальная широта', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'lat_max', description: 'Максимальная широта', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'lng_min', description: 'Минимальная долгота', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'lng_max', description: 'Максимальная долгота', in: 'query', required: true, schema: new OA\Schema(type: 'number')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Успешный ответ',
                content: [
                    new OA\JsonContent(properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'code', type: 'integer', example: 200),
                        new OA\Property(property: 'message', type: 'string', example: 'Запрос прошел успешно'),
                        new OA\Property(property: 'data', type: 'string', example: []),
                    ])
                ]
            ),
        ]
    )]
    public function showByCoordinates(string $token, CoordinateRequest $request): void
    {

    }
}
