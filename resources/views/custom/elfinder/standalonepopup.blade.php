<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <title>elFinder 2.0</title>

        <!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="{{ asset($dir . '/css/elfinder.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset($dir . '/css/theme.css') }}">

        <!-- elFinder JS (REQUIRED) -->
        <script src="{{ asset($dir . '/js/elfinder.min.js') }}"></script>

        @if($locale)
            <!-- elFinder translation (OPTIONAL) -->
            <script src="{{ asset($dir . "/js/i18n/elfinder.$locale.js") }}"></script>
        @endif
        <!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

        <script type="text/javascript">
            $().ready(function () {
                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}',
                    dialog: {width: 900, modal: true, title: 'Select a file'},
                    resizable: false,
                    commandsOptions: {
                        getfile: {
                            oncomplete: 'destroy'
                        }
                    },
                    getFileCallback: function (file, fm) {
                        console.log('getFileCallback called', file, fm);
                        try {
                            // Определяем родительское окно (для window.open используем opener, для iframe - parent)
                            var parentWindow = window.opener || window.parent;
                            
                            if (!parentWindow) {
                                console.error('Родительское окно не доступно');
                                return;
                            }
                            
                            console.log('Checking processSelectedFile in parent window:', typeof parentWindow.processSelectedFile);
                            
                            if (typeof parentWindow.processSelectedFile !== 'function') {
                                console.error('processSelectedFile function not found in parent window');
                                console.log('Available in parentWindow:', Object.keys(parentWindow).slice(0, 20));
                                return;
                            }
                            
                            // Получаем URL файла
                            var fileUrl = '';
                            
                            if (file && file.url) {
                                // Используем URL из объекта файла
                                // Если есть fm, нормализуем URL
                                if (fm && typeof fm.convAbsUrl === 'function') {
                                    fileUrl = fm.convAbsUrl(file.url);
                                } else {
                                    fileUrl = file.url;
                                }
                            } else if (file && typeof file === 'string') {
                                fileUrl = file;
                            } else {
                                console.error('Не удалось получить URL файла', file);
                                return;
                            }
                            
                            console.log('Calling processSelectedFile with:', fileUrl, '{{ $input_id  }}');
                            
                            // Вызываем функцию в родительском окне
                            parentWindow.processSelectedFile(fileUrl, '{{ $input_id  }}');
                            
                            // Закрываем окно popup с задержкой, чтобы дать время выполниться функции
                            setTimeout(function() {
                                try {
                                    if (window.opener) {
                                        window.close();
                                    }
                                    // Закрываем colorbox (если используется)
                                    if (parentWindow.jQuery && parentWindow.jQuery.colorbox) {
                                        parentWindow.jQuery.colorbox.close();
                                    }
                                } catch (e) {
                                    console.error('Ошибка при закрытии окна:', e);
                                }
                            }, 200);
                        } catch (error) {
                            console.error('Ошибка в getFileCallback:', error);
                            alert('Ошибка при выборе файла: ' + error.message);
                        }
                    }
                }).elfinder('instance');
            });
        </script>

    </head>
    <body>

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>

