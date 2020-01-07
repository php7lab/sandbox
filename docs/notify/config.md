# Конфигурация

У каждого типа уведомлений есть несколько драйверов,
по меньшей мере 2:

* Боевой драйвер
* Драйвер для разработки

Когфигурация драйвера делается в файле `config/services.yaml`:

```yaml
    PhpLab\Sandbox\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface:
        class: PhpLab\Sandbox\Notify\Domain\Repositories\Dev\EmailRepository
        public: true
```

Тут мы указываем драйвер для отправки почты.
