( function( $ ) {

    /**
     * Run all of the functionality needed when the site is
     * finished loading the HTML
     */
    $(document).ready(function() {
        setupNavButton();
        setupPortfolio();
    });

    /**
     * Uses jQuery to find and setup the Menu navigation button
     * that will be used for toggling the dropdown when the site
     * is displayed at narrower breakpoints
     */
    function setupNavButton() {
        var nav = $( '#sitewide-navigation' ), button, menu, container;

        if ( !nav ) { return; }

        button = nav.find( '.menu-toggle' );
        if ( ! button ){ return; }

        // Hide button if menu is missing or empty.
        menu = nav.find( '.nav-menu' );
        if ( ! menu || ! menu.children().length ) {
            button.hide();
            return;
        }

        container = nav.find('.menu-primary-menu-container');

        button.on( 'click.marshariti, keydown.marshariti', function(e) {
            if (e.type !== 'click' && e.which !== 13) { return; }
            container.toggleClass( 'toggled-on' );
            menu.toggleClass( 'toggled-on' );
            button.toggleClass( 'toggled-on' );
        } );
    }


    function setupPortfolio() {

            var portfolio = $('#home-portfolio');

            // Test for the portfolio's existence before progressing
            if ( !portfolio ) { return; }

            // Gather some infos about our existing thumbnail links
            var portfolioThumbnails = portfolio.find('.portfolio-thumbnail-link');
            var numOfThumbnails     = portfolioThumbnails.length;

            // Create the HTML containers for our full-size images
            var fullSizeViewer     = $('<figure id="home-portfolio-fullsize"></figure>');
            var fullSizeImage      = $('<img>');
            var offscreenImage     = $('<img>');

            fullSizeViewer.append(fullSizeImage);

            // Add swipe functionality via the jQuery touchSwipe plugin
            fullSizeViewer.swipe({
                allowPageScroll: 'vertical',
                swipeStatus: enableDragging,
                threshold: 64
            });

            // Via the touchSwipe JS demo: labs.rampinteractive.co.uk/touchSwipe/demos/Image_gallery_example.html
            function enableDragging(event, phase, direction, distance) {
                if (phase == 'move' && (direction == 'left' || direction == 'right')) {
                    if (direction == 'left') {
                        scrollImages(distance);
                    } else if (direction == 'right') {
                        scrollImages(-distance);
                    }
                } else if (phase == 'end') {

                    fullSizeViewer.css('transform', 'none');
                    if (direction == 'left') {
                        swapSlide('next');
                    } else if (direction == 'right') {
                        swapSlide('prev');
                    }

                } else if (phase == 'cancel') {
                    fullSizeViewer.css('transform', 'none');
                }
            }

            function scrollImages(distance) {
                var value = (distance < 0 ? '' : '-') + Math.abs(distance).toString();
                fullSizeViewer.css('transform', 'translate(' + value + 'px, 0)');
            }

            // Add the viewer to the homepage portfolio section
            portfolio.append(fullSizeViewer);

            portfolioThumbnails.each(function(index) {
                var thisThumbnail = $(this);
                thisThumbnail.data('index', index);
                thisThumbnail.on('click', function(e) {
                    e.preventDefault();
                    swapSlide( thisThumbnail );
                });
            });

            // Pop in the first image!
            swapSlide(portfolioThumbnails.first());

            function swapSlide(slide) {

                // Handle the magic next/prev functionality
                if (slide == 'prev') {
                    slide = portfolioThumbnails.eq(fullSizeViewer.data('prevIndex'));
                } else if (slide == 'next') {
                    slide = portfolioThumbnails.eq(fullSizeViewer.data('nextIndex'));
                }

                // Style up the current thumbnail
                $('.portfolio-thumbnail-current').removeClass('portfolio-thumbnail-current');
                slide.addClass('portfolio-thumbnail-current');

                fullSizeViewer.addClass('is-loading');

                fullSizeImage.fadeOut(0);

                // Swap out the images
                var $newImg = $('<img>').attr('src', slide.attr('href')).load(function() {
                    fullSizeImage.attr('src', slide.attr('href')).fadeIn(250);
                    fullSizeViewer.removeClass('is-loading');
                });

                // Update the prev/next indexes
                var index = slide.data('index');
                fullSizeViewer.data('nextIndex', (index == numOfThumbnails - 1) ? 0 : (index + 1));
                fullSizeViewer.data('prevIndex', (index == 0) ? (numOfThumbnails - 1) : (index - 1));

            }

            // If the display isn't large enough to have thumbnails
            // (as determined by the Conditional CSS media query trick),
            // then they won't load...yay, performance!
            // Code inspired by: css-tricks.com/examples/ConditionalCSS/
            $(window).on('resize', function() {
                var size = window.getComputedStyle(document.body, ':after').getPropertyValue('content');

                /* Ridiculous thing to deal with inconsistent returning of
                   value from query. Some browsers have quotes some don't */
                size = size.replace(/"/g, "");
                size = size.replace(/'/g, "");
                if (size == 'wide') {
                    $('.portfolio-thumbnail-image').each(function() {
                        var $currentThumbnail = $(this);
                        $currentThumbnail.attr('src', $currentThumbnail.attr('data-src'));
                    });
                }

            }).resize();

            // Create the next/prev buttons
            var nextButton   = $('<button class="portfolio-control portfolio-control-next" role="button"><span>Next</span> →</button>')
                                .on('click', function(e) {
                                  e.preventDefault();
                                  swapSlide('next');
                                });

            var prevButton   = $('<button class="portfolio-control portfolio-control-prev" role="button">← <span>Previous</span></button>')
                                .on('click', function(e) {
                                  e.preventDefault();
                                  swapSlide('prev');
                                });

            var portfolioControls = $('<nav class="portfolio-controls" role="navigation" />');

            portfolioControls.prepend(nextButton).prepend(prevButton);

            $('.portfolio-thumbnails').prepend(portfolioControls);

            // Add keyboard navigation handling for the left/right arrow keys
            $(document).keydown(function(e) {
                switch (e.which) {
                    case 37:
                        swapSlide('prev');
                        return false;
                        break;
                    case 39:
                        swapSlide('next');
                        return false;
                        break;
                }
            });

    }

} )( jQuery );