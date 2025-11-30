$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if(link == location2){
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function () {
        var res = confirm('Подтвердите действия');
        if(!res){
            return false;
        }
    });

    // Простой обработчик для elFinder без Colorbox
    $('.popup_selector').on('click', function (e) {
        e.preventDefault();
        var inputId = $(this).data('inputid');
        var elfinderUrl = '/elfinder/popup/' + inputId;
        
        // Открываем в новом окне вместо Colorbox
        window.open(elfinderUrl, 'elfinder', 'width=900,height=600,scrollbars=yes');
        return false;
    });
})

ClassicEditor
    .create( document.querySelector( '#editor' ), {
        image: {
            toolbar: [ 'toggleImageCaption', 'imageTextAlternative' ]
        }
    } )
