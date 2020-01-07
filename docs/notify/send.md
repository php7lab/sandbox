# Отправка уведомлений

Отправка почты:

```php
$email = new EmailEntity;
$email->setFrom('from@mail.ru');
$email->setTo('example@yandex.ru');
$email->setSubject('Subject text');
$email->setBody('Body text');
$this->emailService->push($email);

//$this->jobService->runAll('email');
```

Заметьте, что письмо не отправляется сразу,
а добавляется в очередь на отправку.

