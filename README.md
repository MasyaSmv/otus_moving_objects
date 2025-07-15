# otus\_moving\_objects

**Space Battle Server** — учебный проект по лекции «Определение абстракций, устойчивых к изменениям требований» (Otus).
Реализована логика движения и поворота игровых объектов (SOLID, адаптеры, полиморфизм).

## Содержание

* [Описание](#описание)
* [Требования](#требования)
* [Установка](#установка)
* [Структура проекта](#структура-проекта)
* [Использование](#использование)
* [Тестирование](#тестирование)
* [Статический анализ](#статический-анализ)
* [Дальнейшее развитие](#дальнейшее-развитие)
* [Лицензия](#лицензия)

## Описание

В проекте реализован серверный движок для игры «Космическая битва». Ключевые возможности:

* Прямолинейное равномерное движение объектов (`Mover`) по вектору скорости.
* Поворот объектов вокруг своей оси (`Rotator`) с учётом нормализации угла.
* Архитектура на основе интерфейсов (`Positionable`, `VelocityAware`, `Rotatable`) и Value Object (`Vector2D`).
* Тесты покрытия всего функционала (PHPUnit).
* CI/CD: GitHub Actions (PHPUnit + Psalm).

## Требования

* PHP ≥ 8.3
* Composer
* PHPUnit
* Psalm

## Установка

1. Клонировать репозиторий:

   ```bash
   git clone https://github.com/MasyaSmv/otus_moving_objects.git
   cd otus_moving_objects
   ```
2. Установить зависимости:

   ```bash
   composer install
   ```

## Структура проекта

```
├── src/                   # Исходный код
│   ├── Contract/          # Интерфейсы
│   ├── Service/           # Классы-реализации (Mover, Rotator)
│   └── ValueObject/       # Непосредственно Vector2D
├── tests/Unit/            # Unit-тесты
├── .github/workflows/ci.yml # CI-конфиг
├── composer.json          # Зависимости и автозагрузка
└── psalm.xml              # Конфиг статического анализатора
```

## Использование

Пример использования `Mover` и `Rotator`:

```php
use App\Service\Mover;
use App\Service\Rotator;
use App\Contract\Positionable;
use App\Contract\VelocityAware;
use App\Contract\Rotatable;
use App\ValueObject\Vector2D;

// Пример корабля:
class Ship implements Positionable, VelocityAware, Rotatable {
    use App\Trait\HasPosition;
    use App\Trait\HasVelocity;
    use App\Trait\HasAngle;

    public function __construct() {
        $this->setPosition(new Vector2D(0, 0));
        $this->velocity = new Vector2D(1, 0);
    }
}

$ship = new Ship();

$mover = new Mover();
$mover->move($ship);

$rotator = new Rotator();
$rotator->rotate($ship, 45);
```

## Тестирование

Запуск всех тестов:

```bash
vendor/bin/phpunit --colors=always
```

## Статический анализ

Запуск Psalm для проверки типов и качества кода:

```bash
vendor/bin/psalm --shepherd --stats
```

## Лицензия

MIT © MasyaSmv
