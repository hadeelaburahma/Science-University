//Counter function
function countChar(val) {
    var len = val.value.length;
    $('#charNum').text(len + ' Charecters');
};

$(document).ready(function () {
    //match heights
    $('.footer .col').matchHeight();
    $('.events .col .event-body').matchHeight();
    //form validation function
    $('#intouch-form').validate();

    $('a.fa-search').click(function () {
        if ($('a.fa-search').hasClass('close')) {
            $('#sdiv input').css({
                'width': '0',
                'border': 'none'
            });
            $('#mobile-search input').css({
                'width': '0',
                'border': 'none'
            });
            $('.fa-search').removeClass('close');
            if ($(window).width() < 767) {
                $('#mobile-search').css('display', 'none');
            }
        } else {
            $('#sdiv input').css({
                'width': '100%',
                'border': '2px solid #b6b6b6'
            });
            $('#mobile-search input').css({
                'width': '80%',
                'border': '2px solid #b6b6b6',
                'border-left': 'none'
            });
            $('.fa-search').addClass('close');
            if ($(window).width() < 767) {
                $('#mobile-search').css('display', 'inline-block');
            }
        }

    });

    //collapse footer
    //Explore Menu
    $('h4 .explore-btn').click(function () {
        $('.explore-list li').css({'display': 'block'});
        $('h4 .explore-ubtn').css({'display': 'inline-block'});
        $('h4 .explore-btn').css({'display': 'none'});
    });
    $('h4 .explore-ubtn').click(function () {
        $('.explore-list li').css({'display': 'none'});
        $('h4 .explore-ubtn').css({'display': 'none'});
        $('h4 .explore-btn').css({'display': 'inline-block'});
    });
//Quick links list
    $('h4 .quick-link-btn').click(function () {
        $('.quick-link-list li').css({'display': 'block'});
        $('h4 .quick-link-ubtn').css({'display': 'inline-block'});
        $('h4 .quick-link-btn').css({'display': 'none'});
    });
    $('h4 .quick-link-ubtn').click(function () {
        $('.quick-link-list li').css({'display': 'none'});
        $('h4 .quick-link-btn').css({'display': 'inline-block'});
        $('h4 .quick-link-ubtn').css({'display': 'none'});
    });
//using our site menu
    $('h4 .using-btn').click(function () {
        $('.site-list li').css({'display': 'block'});
        $('h4 .using-ubtn').css({'display': 'inline-block'});
        $('h4 .using-btn').css({'display': 'none'});
    });
    $('h4 .using-ubtn').click(function () {
        $('.site-list li').css({'display': 'none'});
        $('h4 .using-ubtn').css({'display': 'none'});
        $('h4 .using-btn').css({'display': 'inline-block'});
    });
//Find us list
    $('h4 .find-us-btn').click(function () {
        $('.find-us-list li').css({'display': 'block'});
        $('h4 .find-us-ubtn').css({'display': 'inline-block'});
        $('h4 .find-us-btn').css({'display': 'none'});
    });
    $('h4 .find-us-ubtn').click(function () {
        $('.find-us-list li').css({'display': 'none'});
        $('h4 .find-us-btn').css({'display': 'inline-block'});
        $('h4 .find-us-ubtn').css({'display': 'none'});
    });
//remove overflow when nav collapse is in
    $('button.navbar-toggle').click(function () {
        if ($('.navbar-collapse').hasClass('in')) {
            $('body').css('overflow', 'auto');
        } else {
            $('body').css('overflow', 'hidden');
        }
    });
    $('.single-item').slick({
        dots: true,
        infinite: true,
        arrows: false,
        lazyLoad: 'ondemand',
    });
});
