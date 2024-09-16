<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?> | <?php echo get_bloginfo('name') ?></title>
    <?php wp_head() ?>
</head>
<body <?php body_class() ?>>
<?php wp_body_open(); ?>

<?php HeaderComponent::display(); ?>