$.noConflict();

jQuery(document).ready(function ($) {

    "use strict";

    [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
        new SelectFx(el);
    });

    jQuery('.selectpicker').selectpicker;


    $('#menuToggle').on('click', function (event) {
        $('body').toggleClass('open');
    });

    $('.search-trigger').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').addClass('open');
    });

    $('.search-close').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').removeClass('open');
    });
    $("#like1").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 1, selected: 1},
            success: function (html) {
                $("#likeCount").html(html);
            }
        });
    });
    $("#like2").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 1, selected: 2},
            success: function (html) {
                $("#likeCount").html(html);
            }
        });
    });
    $("#like3").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 1, selected: 3},
            success: function (html) {
                $("#likeCount").html(html);
            }
        });
    });
    $("#comment1").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 2, selected: 1},
            success: function (html) {
                $("#commentCount").html(html);
            }
        });
    });
    $("#comment2").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 2, selected: 2},
            success: function (html) {
                $("#commentCount").html(html);
            }
        });
    });
    $("#comment3").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 2, selected: 3},
            success: function (html) {
                $("#commentCount").html(html);
            }
        });
    });
    $("#article1").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 3, selected: 1},
            success: function (html) {
                $("#articleCount").html(html);
            }
        });
    });
    $("#article2").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 3, selected: 2},
            success: function (html) {
                $("#articleCount").html(html);
            }
        });
    });
    $("#article3").on("click", function () {
        $.ajax({
            type: 'post',
            url: 'count.php',
            data: {type: 3, selected: 3},
            success: function (html) {
                $("#articleCount").html(html);
            }
        });
    });
    $("#issueCover").on('change', function () {
        var issueId = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'addArticleData.php',
            data: 'issueId=' + issueId,
            success: function (html) {
                $('#articleData').html(html);
                $("#dataTable").DataTable();
            }
        });
    });
    $("#dataTable").DataTable();
    // $('.user-area> a').on('click', function(event) {
    // 	event.preventDefault();
    // 	event.stopPropagation();
    // 	$('.user-menu').parent().removeClass('open');
    // 	$('.user-menu').parent().toggleClass('open');
    // });


});