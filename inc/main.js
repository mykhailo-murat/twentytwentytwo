/* global ajax_object */
console.log('1')
jQuery(document).ready(function ($) {
    'use strict';

    console.log('hello')


    // FILTER
    function ajaxFilter(e) {
        e.preventDefault();
        $('.speakers-tag.active').removeClass('active');
        $(this).toggleClass('active');
        var tag = $(this).data('tag');
        var tax = $(this).data('tax');
        console.log(tag);
        console.log(tax);
        $.ajax({
            url: ajax_object.ajax_url,
            data: { action: 'filter_ajax', tag: tag, tax:tax },
            type: 'post',
            success: function (result) {
                $('.speakers').html(result.data);
            },
            error: function (result) {
                console.log('PIZDEC');
                console.warn(result);
            },
        });
    }


    $('.speakers-tag').on('click', ajaxFilter);
});