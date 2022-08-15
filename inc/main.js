/* global ajax_object */
jQuery(document).ready(function ($) {
    'use strict';

    $('.burger').on('click', function () {
        $(this).toggleClass('is-active');
        $('.header__menu').toggleClass('is-active');
        $('body').toggleClass('no-scroll');
        console.log('open 3');
    })

    // FILTER
    function ajaxFilter(e) {
        e.preventDefault();
        $(this).siblings().removeClass('active');

        $(this).toggleClass('active');

        var position = $('#positions .active').data('tag');
        var country = $('#countries .active').data('tag');

        console.log(position);
        console.log(country);

        $.ajax({
            url: ajax_object.ajax_url,
            data: {action: 'filter_ajax', country: country, position: position},
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

    $('.dropdown-toggle').on('click', function () {
        console.log('open drop');
        $(this).next('.dropdown').slideToggle();

    });
    $(document).click(function (e) {
        var target = e.target;
        if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle'))
//{ $('.dropdown').hide(); }
        {
            $('.dropdown').slideUp();
        }
    });

});



