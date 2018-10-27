$(function () {

    'use strict';

    $('#process-btn').on('click', function () {
        var $this = $(this);
        $this.button('loading');

        var model = {
            inputText: $('#input-text').val(),
            rules: {
                textCase: $('select.text-case option:selected').val(),
                space: $('select.space option:selected').val(),
                lineBreak: $('select.line-break option:selected').val(),
                sort: $('select.sort option:selected').val(),
                removeDuplicateLines: $('#remove-duplicate-lines').is(":checked"),
                show: {
                    wordCount: $('#show-word-count').val(),
                    characterCount: $('#show-character-count').val(),
                },
                remove: {
                    wordCount: $('#remove-word-count').val(),
                    characterCount: $('#remove-character-count').val(),
                },
            }
        };

        $.ajax({
            url: "actions.php", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: model,
            success: function (result) {
                setTimeout(function () {    //will be used to act as a "delay"
                    $('#output-text').val(result);
                    $('#result-character-count').html($('#output-text').val().length);
                    $this.button('reset');
                }, 2000);
            }
        });
    });

    $('#reset-btn').on('click', function () {
        $('#input-text').val('');
        $('#output-text').val('');

        $('#character-count').html(0);
        $('#result-character-count').html(0);
    });

    $('#input-text').keyup(function () {
        $('#character-count').html($('#input-text').val().length);
    });

});
