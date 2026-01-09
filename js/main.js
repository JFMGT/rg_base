/**
 * PhysioTherapy Pro Theme JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Mobile Menu Toggle
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation').toggleClass('active');
            $('body').toggleClass('menu-open');
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.main-navigation, .menu-toggle').length) {
                $('.menu-toggle').removeClass('active');
                $('.main-navigation').removeClass('active');
                $('body').removeClass('menu-open');
            }
        });

        // Close mobile menu on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('.menu-toggle').removeClass('active');
                $('.main-navigation').removeClass('active');
                $('body').removeClass('menu-open');
            }
        });

        // Smooth scroll for anchor links
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(e) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && 
                location.hostname == this.hostname) {
                
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    e.preventDefault();
                    
                    // Close mobile menu if open
                    $('.menu-toggle').removeClass('active');
                    $('.main-navigation').removeClass('active');
                    $('body').removeClass('menu-open');
                    
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                }
            }
        });

        // Sticky header on scroll
        var header = $('.site-header');
        var headerHeight = header.outerHeight();
        var scrollThreshold = 100;

        $(window).on('scroll', function() {
            if ($(window).scrollTop() > scrollThreshold) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });

        // Add fade-in animation to elements when scrolling into view
        function checkVisibility() {
            $('.service-card, .team-member, .testimonial-card, .about-content').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('visible');
                }
            });
        }

        // Initial check
        checkVisibility();

        // Check on scroll
        $(window).on('scroll', function() {
            checkVisibility();
        });

        // Animate service cards on hover
        $('.service-card').on('mouseenter', function() {
            $(this).find('.service-icon').css('transform', 'scale(1.1) rotate(5deg)');
        }).on('mouseleave', function() {
            $(this).find('.service-icon').css('transform', 'scale(1) rotate(0deg)');
        });

        // Blog card hover effect
        $('.blog-card').on('mouseenter', function() {
            $(this).css({
                'transform': 'translateY(-8px)',
                'box-shadow': 'var(--shadow-lg)'
            });
        }).on('mouseleave', function() {
            $(this).css({
                'transform': 'translateY(0)',
                'box-shadow': 'var(--shadow-sm)'
            });
        });

        // Form validation enhancement
        $('form').on('submit', function(e) {
            var form = $(this);
            var valid = true;

            // Check required fields
            form.find('[required]').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).css('border-color', '#e74c3c');
                } else {
                    $(this).css('border-color', '');
                }
            });

            // Email validation
            form.find('input[type="email"]').each(function() {
                var email = $(this).val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    valid = false;
                    $(this).css('border-color', '#e74c3c');
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Bitte füllen Sie alle erforderlichen Felder korrekt aus.');
            }
        });

        // Remove error styling on input
        $('input, textarea, select').on('input change', function() {
            $(this).css('border-color', '');
        });

        // Back to top button (if exists)
        if ($('.back-to-top').length) {
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 300) {
                    $('.back-to-top').addClass('show');
                } else {
                    $('.back-to-top').removeClass('show');
                }
            });

            $('.back-to-top').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        }

        // Lazy load images with placeholder
        $('img[data-src]').each(function() {
            var img = $(this);
            var src = img.attr('data-src');
            
            img.attr('src', src).on('load', function() {
                img.addClass('loaded');
            });
        });

        // Add print styles helper
        $('.print-button').on('click', function() {
            window.print();
        });

        // Accessible menu enhancements
        $('.main-navigation a').on('focus', function() {
            $(this).parents('li').addClass('focus');
        }).on('blur', function() {
            $(this).parents('li').removeClass('focus');
        });

        // Add CSS transition for service icons
        $('.service-icon').css({
            'transition': 'transform 0.3s ease'
        });

        // ======================================================================
        // FAQ Accordion
        // ======================================================================

        // FAQ Toggle functionality
        $('.faq-question').on('click', function() {
            var $faqItem = $(this).closest('.faq-item');
            var $faqContainer = $faqItem.closest('.faq-container');
            var isOpen = $faqItem.hasClass('is-open');

            // Close all other FAQ items in the same container (accordion behavior)
            $faqContainer.find('.faq-item.is-open').not($faqItem).removeClass('is-open');

            // Toggle current FAQ item
            $faqItem.toggleClass('is-open');

            // If opening this item, scroll it into view smoothly
            if (!isOpen) {
                setTimeout(function() {
                    var headerOffset = 100;
                    var elementPosition = $faqItem.offset().top;
                    var offsetPosition = elementPosition - headerOffset;

                    $('html, body').animate({
                        scrollTop: offsetPosition
                    }, 600, 'swing');
                }, 100); // Small delay to allow the animation to start
            }
        });

        // Make FAQ questions keyboard accessible
        $('.faq-question').attr('tabindex', '0').on('keydown', function(e) {
            // Enter or Space key
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                $(this).click();
            }
        });

        // Add ARIA attributes for accessibility
        $('.faq-item').each(function(index) {
            var $item = $(this);
            var $question = $item.find('.faq-question');
            var $answer = $item.find('.faq-answer');

            // Generate unique IDs
            var questionId = 'faq-question-' + index;
            var answerId = 'faq-answer-' + index;

            // Set IDs
            $question.attr('id', questionId);
            $answer.attr('id', answerId);

            // Set ARIA attributes
            $question.attr({
                'role': 'button',
                'aria-expanded': 'false',
                'aria-controls': answerId
            });

            $answer.attr({
                'role': 'region',
                'aria-labelledby': questionId
            });
        });

        // Update ARIA attributes when FAQ items are toggled
        $('.faq-item').on('toggleClass', function() {
            var $item = $(this);
            var isOpen = $item.hasClass('is-open');
            $item.find('.faq-question').attr('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Custom event to track aria-expanded changes
        var originalToggleClass = $.fn.toggleClass;
        $.fn.toggleClass = function() {
            var result = originalToggleClass.apply(this, arguments);
            this.trigger('toggleClass');
            return result;
        };

        // Log theme loaded
        console.log('PhysioTherapy Pro Theme Loaded Successfully');
    });

})(jQuery);
