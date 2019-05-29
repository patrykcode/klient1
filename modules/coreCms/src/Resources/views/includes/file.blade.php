<div class="input-group group-file">
    <div class="input-group-prepend">
        <div class="btn-group sm-m-t-10">
            <button class="btn btn-outline-primary image_selector popup_selector"  <?= $server ? '' : 'disabled'; ?> type="button" data-upateimage="<?= $nameValue; ?>_feature_image"  data-inputid="<?= $nameValue; ?>_feature_image" data-toggle="tooltip" data-placement="top" title="Załaduj z serwera">
                <i class=" fs-14 fa fa-download" aria-hidden="true"></i>
            </button>
            <label class="btn btn-outline-dark" style="margin: 0;cursor:pointer;" for="<?= $nameValue; ?>_file"  data-toggle="tooltip" data-placement="top" title="Załaduj z dysku">
                <?= Form::file($nameValue . '_file', ['class' => $class, 'id' => $nameValue . '_file', 'onchange' => 'changeFile(event)', 'accept' => $accept]); ?>
                <i class="fs-14 fa fa-upload" aria-hidden="true"></i>
            </label>
        </div>
    </div>
    <input type="text" class="form-control file-name btn-radius" id="<?= $nameValue; ?>_feature_image" name="<?= $nameValue; ?>"   value="<?= $value; ?>" <?= $required ? 'required="required"' : ''; ?>>
</div>

<?php if ($del && !empty($value)): ?>
    <?php if ($crop): ?>
        <img src="<?= getImage($value, $size_crop); ?>" alt="" class="my-2 img-fluid"><br/>
        <a href="<?= '/' . $value ?>" class="crop btn btn-outline-primary col-6 " data-width='<?= $size_crop[0] ?? 1600; ?>' data-height='<?= $size_crop[1] ?? 400; ?>'>kadruj&nbsp;zdjęcie</a>
    <?php endif; ?>
    <div class="checkbox check-danger col-6 pull-right">
        <input type="checkbox" id="del-<?= $nameValue; ?>" name="del-<?= $nameValue; ?>">
        <label for="del-<?= $nameValue; ?>">
            usuń plik
        </label>
    </div>
<?php endif; ?>
<br/>