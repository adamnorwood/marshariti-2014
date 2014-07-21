( function( $ ) {

    /**
     * Run all of the functionality needed when the site is
     * finished loading the HTML
     */
    $(document).ready(function() {
        setupNavButton();
        setupPortfolioCarousel();
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

    function setupPortfolioCarousel() {

        var portfolio = $('#home-portfolio');

        if ( !portfolio ) { return; }

        var fullSizeImage       = $('<img id="home-portfolio-fullsize-current" />');
        var fullSizeViewer      = $('<figure id="home-portfolio-fullsize"></figure>');
        var portfolioThumbnails = portfolio.find('.portfolio-thumbnail-link');
        var numberOfThumbnails  = portfolioThumbnails.length;
        var firstThumbnail      = portfolioThumbnails.first();

        fullSizeViewer.append(fullSizeImage).swipe( {
            swipeLeft:(function(){ updateSlide('next'); }),
            swipeRight:(function(){ updateSlide('prev'); })
        } );
        portfolio.append(fullSizeViewer);

        // Initialize the first image
        fullSizeImage.attr('src', firstThumbnail.attr('href'));
        firstThumbnail.addClass('portfolio-thumbnail-current');

        var currentSlide = 1;

        portfolioThumbnails.on('click', function(e) {
            e.preventDefault();

            var currentThumbnail = $(this);
            portfolioThumbnails.removeClass('portfolio-thumbnail-current');

            fullSizeImage.attr('src', currentThumbnail.attr('href') );

            currentThumbnail.addClass('portfolio-thumbnail-current');

            currentSlide = currentThumbnail.parent().index();

        });

        // Add keyboard navigation handling for the left/right arrow keys
        $(document).keydown(function(e) {
            switch (e.which) {
                case 37:
                    updateSlide('prev');
                    return false;
                    break;
                case 39:
                    updateSlide('next');
                    return false;
                    break;
            }
        });

        // Create the next/prev buttons
        var nextButton   = $('<button class="portfolio-control portfolio-control-next" role="button"><span>Next</span> →</button>')
                            .on('click', function(e) {
                              e.preventDefault();
                              updateSlide('next');
                            });

        var prevButton   = $('<button class="portfolio-control portfolio-control-prev" role="button">← <span>Previous</span></button>')
                            .on('click', function(e) {
                              e.preventDefault();
                              updateSlide('prev');
                            });

        var portfolioControls = $('<nav class="portfolio-controls" role="navigation" />');

        portfolioControls.prepend(nextButton).prepend(prevButton);

        $('.portfolio-thumbnails').prepend(portfolioControls);

        function updateSlide(action) {

            if (action === 'next') {
                currentSlide = ((currentSlide + 1) < numberOfThumbnails) ? currentSlide + 1 : 0;
            } else if (action === 'prev') {
                currentSlide = ((currentSlide - 1 < 0)) ? numberOfThumbnails - 1 : currentSlide - 1;
            }

            var currentThumbnail = portfolioThumbnails.eq(currentSlide - 1);
            portfolioThumbnails.removeClass('portfolio-thumbnail-current');

            fullSizeImage.attr('src', currentThumbnail.attr('href') );

            currentThumbnail.addClass('portfolio-thumbnail-current');

        }

    }
} )( jQuery );