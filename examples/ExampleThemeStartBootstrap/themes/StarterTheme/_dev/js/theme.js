/**
 * This is the entry point for specific javascript of theme
 */
// require('bootstrap');
// require('jquery');
import 'bootstrap';
import $ from 'jquery';

$(document).on('click', '.mega-dropdown', function(e) {
    e.stopPropagation()
});
$(document).on('click', '#prestashop_profiling a', (e) => {
    $(e.target).closest('.row').find('.table-condensed ').toggle();
});

$(document).ready(function(){

    $(".tb").hover(function(){
    
    $(".tb").removeClass("tb-active");
    $(this).addClass("tb-active");
    
    var current_fs = $("fieldset.active");
    var next_fs = $(this).attr('id');
    next_fs = "#" + next_fs + "1";
    
    $("fieldset").removeClass("active");
    $(next_fs).addClass("active");
    
    current_fs.animate({}, {
    step: function() {
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({
    'display': 'block'
    });
    }
    });
    });
    
});