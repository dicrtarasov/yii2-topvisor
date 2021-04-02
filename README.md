# TopVisor APIv2 для Yii2

Реализованы только методы получения данных: https://topvisor.com/ru/api/v2/

## Конфигурация

```php
$config = [
    'components' => [
        'topvisor' => [
            'class' => dicr\topvisor\TopVisorApi::class,
            'userId' => '<UserID из личного кабинета>',
            'apiKey' => '<ключ API из личного кабинета>'
        ]
    ]
];
```

## Использование

```php
/** @var dicr\topvisor\TopVisorApi */
$api = Yii::$app->get('topvisor');

// получение списка проектов
/** @var dicr\topvisor\entity\GetProjectsRequest $request */
$request = $api->request([
    'class' => dicr\topvisor\entity\GetProjectsRequest::class,
    'fields' => ['id', 'name'],
    'limit' => 10
]);

// отправляем запрос
/** @var dicr\topvisor\entity\GetProjectsResponse $response */
$response = $request->send();

// выводим результат
foreach ($response->result as $project) {
    echo 'Проект id=' . $project->id . ', name=' . $project->name . "\n";
}
```
