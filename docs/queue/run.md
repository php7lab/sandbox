# Выполнение задач

Обычно, очередь выполняется по CRON.

Можно это сделать в коде так:

```php
/** @var \PhpLab\Sandbox\Queue\Domain\Interfaces\JobServiceInterface $jobService */

$jobService->runAll('email');
```

либо выполнить команду:

```
php bin/console queue:run
```
