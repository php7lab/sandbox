# Отправка уведомлений

Отправка почты:

```php
/** @var \PhpLab\Sandbox\Notify\Domain\Interfaces\Services\EmailServiceInterface $emailService */

$email = new EmailEntity;
$email->setFrom('from@mail.ru');
$email->setTo('example@yandex.ru');
$email->setSubject('Subject text');
$email->setBody('Body text');
$emailService->push($email);
```

Заметьте, что письмо не отправляется сразу,
а добавляется в очередь на отправку.

