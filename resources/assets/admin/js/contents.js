import $ from 'jquery';
import '@toast-ui/jquery-editor';

export const contents = (function () {
    function load_markdown_editor(link, options) {

        $('#' + link + '_editor').toastuiEditor($.extend(options, {
            initialEditType: 'markdown',
            previewStyle: 'vertical',
            initialValue: $('#' + link).val(),
            events: {
                change: function() {
                    $('#' + link).val($('#' + link + '_editor').toastuiEditor('getMarkdown'))
                }
            }
        }));
    }

    return {
        load_markdown_editor: load_markdown_editor,
    };
});

window.contents = contents;
