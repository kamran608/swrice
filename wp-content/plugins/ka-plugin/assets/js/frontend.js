(function ($) {
    'use strict';

    const SwriceFrontend = {

        init() {
            this.bindEvents();
            this.initFAQ();
        },

        /** 
         * Bind all click events
         */
        bindEvents() {
            this.switchSwriceTab();
            this.updateRightArrow();
            this.clientReviewSlider();
        },

        /**
         * Client review slider
         */
        clientReviewSlider: function() {

            const $slides = $('.cr-slide');
            const total = $slides.length;
            let current = 0;
            let autoplaySpeed = 4500;
            let timer;
            let isAnimating = false;
            let isPaused = false;

            // initial state
            $slides.each(function (i) {
                $(this).addClass(i === 0 ? 'active' : 'right');
            });

            // dots
            $slides.each(function (i) {
                $('.cr-dots').append('<span data-index="' + i + '"></span>');
            });
            $('.cr-dots span').eq(0).addClass('active');

            function goToSlide(next) {
                if (isAnimating || next === current) return;
                isAnimating = true;

                const direction = next > current ? 'next' : 'prev';
                const $current = $slides.eq(current);
                const $next = $slides.eq(next);

                // Remove all position classes first
                $slides.removeClass('left right');

                if (direction === 'next') {
                    // Set initial position for next slide
                    $next.addClass('right');
                    
                    // Force reflow to ensure class is applied
                    void $next[0].offsetWidth;
                    
                    // Animate
                    $current.addClass('left');
                    $next.removeClass('right').addClass('active');
                    $current.removeClass('active');
                } else {
                    // Set initial position for previous slide
                    $next.addClass('left');
                    
                    // Force reflow
                    void $next[0].offsetWidth;
                    
                    // Animate
                    $current.addClass('right');
                    $next.removeClass('left').addClass('active');
                    $current.removeClass('active');
                }

                $('.cr-dots span')
                    .removeClass('active')
                    .eq(next).addClass('active');

                setTimeout(function () {
                    current = next;
                    isAnimating = false;
                    
                    // Clean up - set proper classes for all slides
                    $slides.each(function(i) {
                        $(this).removeClass('left right active');
                        if (i === current) {
                            $(this).addClass('active');
                        } else if (i < current) {
                            $(this).addClass('left');
                        } else {
                            $(this).addClass('right');
                        }
                    });
                }, 700);
            }

            function nextSlide() {
                goToSlide((current + 1) % total);
            }

            function startAutoplay() {
                if (!isPaused) {
                    clearInterval(timer);
                    timer = setInterval(nextSlide, autoplaySpeed);
                }
            }

            function stopAutoplay() {
                clearInterval(timer);
            }

            function resetAutoplay() {
                if (!isPaused) {
                    stopAutoplay();
                    startAutoplay();
                }
            }

            // Hover pe pause - yeh important part hai
            $('.cr-slider-wrapper').on('mouseenter', function() {
                isPaused = true;
                stopAutoplay();
            });

            $('.cr-slider-wrapper').on('mouseleave', function() {
                isPaused = false;
                startAutoplay();
            });

            $('.cr-nav.next').on('click', function () {
                resetAutoplay();
                nextSlide();
            });

            $('.cr-nav.prev').on('click', function () {
                resetAutoplay();
                goToSlide((current - 1 + total) % total);
            });

            $('.cr-dots').on('click', 'span', function () {
                resetAutoplay();
                goToSlide($(this).data('index'));
            });

            startAutoplay();
        },

        /**
         * FAQ Accordion (Yoast FAQ)
         */
        initFAQ() {

            if (!$('.schema-faq-section').length) {
                return;
            }

            $('.schema-faq-section').each(function (index) {

                const $section  = $(this);
                const $question = $section.find('.schema-faq-question');
                const $answer   = $section.find('.schema-faq-answer');

                // Prevent duplicate icons
                if (!$question.find('.faq-toggle-icon').length) {
                    $question.append('<span class="faq-toggle-icon">+</span>');
                }

                if (index === 0) {
                    $section.addClass('active');
                    $answer.show();
                    $question.find('.faq-toggle-icon').text('–');
                } else {
                    $answer.hide();
                }
            });

            $(document)
                .off('click.swriceFaq')
                .on('click.swriceFaq', '.schema-faq-question', function (e) {

                    e.preventDefault();

                    const $question = $(this);
                    const $section  = $question.closest('.schema-faq-section');
                    const $answer   = $section.find('.schema-faq-answer');
                    const $icon     = $question.find('.faq-toggle-icon');

                    if ($section.hasClass('active')) {
                        $section.removeClass('active');
                        $answer.stop(true, true).slideUp(250);
                        $icon.text('+');
                        return;
                    }

                    $('.schema-faq-section.active')
                        .removeClass('active')
                        .find('.schema-faq-answer')
                        .stop(true, true)
                        .slideUp(250);

                    $('.faq-toggle-icon').text('+');

                    $section.addClass('active');
                    $answer.stop(true, true).slideDown(250);
                    $icon.text('–');
                });
        },

        /**
         * Switch Tabs
         */
        switchSwriceTab() {

            $(document).on('click', '.swrice-tab', function () {

                const $tab = $(this);
                const tabIndex = parseInt($tab.text(), 10);

                $('.swrice-tab').removeClass('active');
                $tab.addClass('active');

                $('.tab-content, .tab-heading').hide();
                $('.tab-content-' + tabIndex).show();
                $('.tab-heading-' + tabIndex).show();
            });
        },

        /**
         * Client Review Slider Arrows
         */
        updateRightArrow() {

            const updateReviewContent = () => {
                const content = $('.main-client-img.user-2')
                    .find('.review-content')
                    .text();

                $('.review-section .content').fadeOut(200, function () {
                    $(this).html(content).fadeIn(200);
                });
            };

            $(document).on('click', '.right-arrow', function () {

                const totalReviews = parseInt(
                    $(this)
                        .closest('.clients-review-wrap')
                        .find('.client-list')
                        .data('total_reviews'),
                    10
                );

                $('.main-client-img').each(function () {

                    const currentClass = this.className.split(' ')[1];
                    const currentIndex = parseInt(currentClass.split('-')[1], 10);
                    const prevIndex    = currentIndex === 1 ? totalReviews : currentIndex - 1;

                    $(this)
                        .removeClass(currentClass)
                        .addClass('user-' + prevIndex);
                });

                updateReviewContent();
            });

            $(document).on('click', '.left-arrow', function () {

                const totalReviews = parseInt(
                    $(this)
                        .closest('.clients-review-wrap')
                        .find('.client-list')
                        .data('total_reviews'),
                    10
                );

                $('.main-client-img').each(function () {

                    const currentClass = this.className.split(' ')[1];
                    const currentIndex = parseInt(currentClass.split('-')[1], 10);
                    const nextIndex    = currentIndex === totalReviews ? 1 : currentIndex + 1;

                    $(this)
                        .removeClass(currentClass)
                        .addClass('user-' + nextIndex);
                });

                updateReviewContent();
            });
        }
    };

    $(document).ready(() => {
        SwriceFrontend.init();
    });

})(jQuery);
