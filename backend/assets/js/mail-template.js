!function($) {
    $('.js-ck-insert').on('click', function() {
        CKEDITOR.instances['mailtemplate-text'].insertText($(this).text());
    });
}(jQuery)