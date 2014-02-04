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
            console.dir(e);
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
        var portfolioThumbnails = portfolio.find('.portfolio-image-link');
        var firstThumbnail      = portfolioThumbnails.first();

        fullSizeViewer.append(fullSizeImage);
        portfolio.append(fullSizeViewer);

        // Initialize the first image
        fullSizeImage.attr('src', firstThumbnail.attr('href'));
        firstThumbnail.addClass('portfolio-current');

        portfolioThumbnails.on('click', function(e) {
            e.preventDefault();

            var currentThumbnail = $(this);
            portfolioThumbnails.removeClass('portfolio-current');

            fullSizeImage.attr('src', currentThumbnail.attr('href') );

            currentThumbnail.addClass('portfolio-current');

        });
    }
} )( jQuery );