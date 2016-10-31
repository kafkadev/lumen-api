<div class="col-md-12">
    <?php if ( isset($_SESSION['success']) ): ?>
        <div class="alert alert-success">
            <strong>Congratulation!</strong> <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif ?>
</div>
