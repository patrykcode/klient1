
<script>
<?php if (isset($errors)&&$errors->any()): ?>
    <?php foreach ($errors->all() as $key => $error): ?>
            ALERTS.show({type: 'danger', message: '<?= $error; ?>'});
    <?php endforeach; ?>
<?php endif; ?>

<?php foreach (['success', 'info', 'warning'] as $type): ?>
    <?php if (session()->has($type)): ?>
        <?php foreach (session($type) as $success): ?>
                ALERTS.show({type: '<?= $type; ?>', message: '<?= $success; ?>'});
        <?php endforeach; ?>
        <?php session()->forget($type); ?>
    <?php endif; ?>
<?php endforeach; ?>
</script>


