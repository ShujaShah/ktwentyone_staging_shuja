<?php
/*
* Custom Homepage
*/
// set full width layout
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

// remove Genesis default loop
remove_action('genesis_loop', 'genesis_do_loop');

// add a custom loop
add_action('genesis_loop', 'wdm_hp_loop');

function wdm_hp_loop()
{

    echo '<div class="wdm-homepage">';

//* Widgetized homepage
    genesis_widget_area(
        'hp-1',
        array(
        'before' => '<div class="hp-1 widget-area">',
        'after' => '</div>',
        )
    );
    genesis_widget_area(
        'hp-2',
        array(
        'before' => '<div class="hp-2 widget-area">',
        'after' => '</div>',
        )
    );
    genesis_widget_area(
        'hp-3',
        array(
        'before' => '<div class="hp-3 widget-area">',
        'after' => '</div>',
        )
    );
    genesis_widget_area(
        'hp-4',
        array(
        'before' => '<div class="hp-4 widget-area">',
        'after' => '</div>',
        )
    );
    genesis_widget_area(
        'hp-5',
        array(
        'before' => '<div class="hp-5 widget-area">',
        'after' => '</div>',
        )
    );
    genesis_widget_area(
        'hp-6',
        array(
        'before' => '<div class="hp-6 widget-area">',
        'after' => '</div>',
        )
    );

    genesis_widget_area(
        'hp-7',
        array(
        'before' => '<div class="hp-7 widget-area">',
        'after' => '</div>',
        )
    );


    echo '</div>';

}

genesis();
