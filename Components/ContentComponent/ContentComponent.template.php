<?php if (have_rows('content')) :
    while (have_rows('content')) :
        the_row();
        if (get_row_layout() == 'test') :
            TestComponent::display();
        endif;
    endwhile;
endif;
