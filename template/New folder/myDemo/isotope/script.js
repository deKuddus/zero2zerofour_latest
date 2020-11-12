$(document).ready(function(){
    
    var $grid = $('.grid').isotope({
        itemSelector: '.filter-item',
        layoutMode: 'fitRows',

      });


      $('.filter-button-group').on( 'click', 'button', function() {
        var filterValue = $(this).attr('data-sort-by');
        $grid.isotope({ filter: filterValue });
      });
})