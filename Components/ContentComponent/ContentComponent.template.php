<?php if (get_field('content') && have_rows('content')) :
    while (have_rows('content')) :
        the_row();
        if (get_row_layout() == 'Lorem') :
            LoremComponent::display();
        elseif (get_row_layout() == 'Ipsum') :
            IpsumComponent::display();
        endif;
    endwhile;
endif;
