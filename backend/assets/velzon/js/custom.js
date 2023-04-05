$(document).on('dblclick', '.grid-view tr', function () {
    var a = $(this).find('a[href*="view"]');
    if (!a.length) {
        a = $(this).find('a[href*="update"]');
    }
    a[0].click();
});

$(document).on('click', '.js-action', function (e) {
    e.preventDefault();
    var $this = $(this);
    var url = $this.attr('href');
    var csrfParam = $('meta[name="csrf-param"]').attr('content');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var data = {};
    data[csrfParam] = csrfToken;

    $.ajax({
        url: url,
        method: 'post',
        data: data,
        success: function (r) {
            if (r.success) {
                $.pjax.reload({
                    container: '#posts-list',
                    timeout: false,
                    scrollTo: function () {
                        return $this.parents('li').offset().top;
                    }
                });
                /*$(document).on('pjax:end', function () {
                    $.toast({
                        text: r.message,
                        position: 'top-center',
                        icon: 'success',
                        hideAfter: false,
                        stack: 15
                    });
                });*/
            } else {
                $.toast({
                    text: 'Возникла ошибка',
                    position: 'top-center',
                    icon: 'danger',
                    hideAfter: false,
                    stack: 15
                });
            }
        }
    });
});

$(document).on('click', '.js-batch-action', function (e) {
    e.preventDefault();
    var $this = $(this);
    var url = $this.attr('href');
    url += (url.indexOf('?') != -1 ? '&id=' : '?id=');
    var ids = $('.grid-view').yiiGridView('getSelectedRows');
    url += ids.join(',');
    if (ids.length) {
        yii.confirm($this.data('message'), function () {
            var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', url);
            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = $('meta[name=csrf-param]').attr('content');
            csrfInput.value = $('meta[name=csrf-token]').attr('content');
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        });
    }
});

$(document).on('change', '.js-batch-checkbox', function () {
    var $this = $(this);
    var buttons = $('.js-batch-action');
    var checkboxes = $('.js-batch-checkbox');
    var isChecked = false;

    checkboxes.each(function (i, checkbox) {
        if ($(checkbox).is(':checked')) {
            isChecked = true;
        }
    });

    if (isChecked) {
        buttons.removeClass('hidden');
    } else {
        buttons.addClass('hidden');
    }
});