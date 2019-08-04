<?php ob_start() ?>
<section class="error">
    <span>OOPS!</span>
    <h1>404</h1>
    
</section>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>