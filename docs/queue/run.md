# Выполнение задач

Обычно, очередь выполняется по CRON,
но можно это сделать в коде так:

```php
$this->jobService->runAll('email');
```

либо выполнить команду:

```
php console queue:run
```
