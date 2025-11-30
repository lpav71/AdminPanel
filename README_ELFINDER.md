# Инструкция по сохранению изменений elFinder после composer update

## Проблема
Файлы в `resources/views/vendor/elfinder/` могут быть перезаписаны при выполнении:
- `composer update`
- `php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=views --force`

## Решение
Кастомные (измененные) файлы elFinder сохранены в `resources/views/custom/elfinder/`:
- `filepicker.blade.php`
- `standalonepopup.blade.php`

## Что делать после composer update

Если после `composer update` elFinder перестал работать, выполните:

```bash
# Windows (PowerShell)
Copy-Item resources/views/custom/elfinder/filepicker.blade.php resources/views/vendor/elfinder/filepicker.blade.php -Force
Copy-Item resources/views/custom/elfinder/filepicker.php resources/views/vendor/elfinder/filepicker.php -Force
Copy-Item resources/views/custom/elfinder/standalonepopup.blade.php resources/views/vendor/elfinder/standalonepopup.blade.php -Force
Copy-Item resources/views/custom/elfinder/standalonepopup.php resources/views/vendor/elfinder/standalonepopup.php -Force

# Linux/Mac
cp resources/views/custom/elfinder/filepicker.blade.php resources/views/vendor/elfinder/filepicker.blade.php
cp resources/views/custom/elfinder/filepicker.php resources/views/vendor/elfinder/filepicker.php
cp resources/views/custom/elfinder/standalonepopup.blade.php resources/views/vendor/elfinder/standalonepopup.blade.php
cp resources/views/custom/elfinder/standalonepopup.php resources/views/vendor/elfinder/standalonepopup.php
```

Или вручную скопируйте содержимое из `resources/views/custom/elfinder/` в `resources/views/vendor/elfinder/`.

## Изменения в файлах

Основные изменения:
1. Исправлена функция `getFileCallback` для правильной работы с `window.opener`
2. Добавлена поддержка функции `processSelectedFile` из родительского окна
3. Улучшена обработка ошибок и логирование

## Альтернативное решение

Можно добавить скрипт в `composer.json` для автоматического копирования:

```json
{
    "scripts": {
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=elfinder-views --force",
            "cp resources/views/custom/elfinder/*.blade.php resources/views/vendor/elfinder/",
            "cp resources/views/custom/elfinder/*.php resources/views/vendor/elfinder/"
        ]
    }
}
```

