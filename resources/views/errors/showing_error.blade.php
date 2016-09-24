<?php if ( isset($_SESSION['errors']) ): ?>
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif ?>
