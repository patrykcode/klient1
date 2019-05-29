@extends('cms::index') 
@section('content')
<div class="row">
    <div class="col-12">
        <?= Form::open(['route' => ['articles.updatepost', 'id' => $article->id], 'class' => 'my-3', 'enctype' => 'multipart/form-data']); ?>
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card card-default">
                    <div class="card-header separator">
                        <div class="card-title">Ustawienia</div>
                    </div>
                    <div class="card-body pt-3">
                        <div class="form-group row px-2">
                            <div class="col-2 ">
                                <label class="my-2">Język:</label> 
                                <?= Form::text('lang', old('lang') != '' ? old('lang') : $article->descLang->lang ?? 'pl', ['class' => 'form-control', 'readonly' => '']); ?>
                            </div>
                            <div class="col-10">
                                <label class="my-2">Tytuł:</label> 
                                <?= Form::text('name', old('name') != '' ? old('name') : $article->descLang->name ?? '', ['class' => 'form-control']); ?>
                                <?= Form::hidden('articles_id', old('articles_id') != '' ? old('articles_id') : $article->id ); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="my-2">pozycja w menu</label> 
                           
                            <select name="parent_id" class="form-control">
                                <option value="0">pozycja główna </option>
                                    <?php foreach ($articles as $article1): ?>
                                        <option value="<?= $article1['id']; ?>" <?= ($article1['id'] == $article->parent_id) ? 'selected="selected"' : '' ?> <?= ($article1['id'] == $article->id ?? 'n') ? 'disabled="disabled"' : '' ?>><?= $article1->descLang->name??'bład'; ?></option>
                                        <?php foreach ($article1->child as $art): ?>
                                            <option value="<?= $art['id']; ?>" <?= ($art['id'] == $article->parent_id) ? 'selected="selected"' : '' ?> <?= ($art['id'] == $article->id ?? 'n') ? 'disabled="disabled"' : '' ?>>&nbsp;&nbsp;&nbsp;<?= $art->descLang->name??'bład'; ?></option>
                                            <?php foreach ($art->child as $a): ?>
                                                <option value="<?= $a['id']; ?>" <?= ($a['id'] == $article->parent_id) ? 'selected="selected"' : '' ?> <?= ($a['id'] == $article->id ?? 'n') ? 'disabled="disabled"' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $a->descLang->name??'bład'; ?></option>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label class="my-2">Klasa CSS:</label> 
                            <?= Form::text('classes', old('classes') != '' ? old('classes') : $article->classes ?? '', ['class' => 'form-control']); ?>
                        </div>
                        <a class="btn btn-outline-secondary w-100 text-center" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            SEO <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <div class="card mt-3 border-0">
                                <div class="form-group ">
                                    <label class="my-2">Link do strony:</label> 
                                    <?= Form::text('slug', old('slug') != '' ? old('slug') : $article->descLang->slug ?? 'temp', ['class' => 'form-control', 'required' => 'required']); ?>
                                </div>
                                <div class="form-group ">
                                    <label class="my-2">Alternatywny link do strony (opcjonolnie np: https://google.pl):</label> 
                                    <?= Form::text('url', old('url') != '' ? old('url') : $article->descLang->url ?? '', ['class' => 'form-control']); ?>
                                </div>
                                <div class="form-group ">
                                    <label class="my-2">Meta description:</label> 
                                    <?= Form::text('meta_description', old('meta_description') != '' ? old('meta_description') : $article->descLang->meta_description ?? '', ['class' => 'form-control']); ?>
                                </div>
                                <div class="form-group ">
                                    <label class="my-2">Meta kewords:</label> 
                                    <?= Form::text('meta_keywords', old('meta_keywords') != '' ? old('meta_keywords') : $article->descLang->meta_keywords ?? '', ['class' => 'form-control']); ?>
                                </div>  
                                <div class="form-group ">
                                    <label for="">Podgląd SEO:</label>
                                    <h3 class="mt-3 mb-1" style="color:#609;"><?= $article->descLang->name ?? ''; ?></h3>
                                    <a href="" class="text-success"><?= url($article->descLang->slug ?? ''); ?></a>
                                    <p class="text-dutted"><?= $article->descLang->meta_description ?? ''; ?></p>
                                </div> 

                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class=" col-12">
                                <label for="">Wstęp</label>
                                <?= ckeditor('addmission', $article->descLang->addmission ?? ''); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col-12">
                                <label for="">Treść</label>
                                <?= ckeditor('description', $article->descLang->description ?? ''); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12  col-12">
                <div class="card card-default">
                    <div class="card-header separator">
                        <div class="card-title">Opcje</div> 
                        <?=buttons('articles');?>
                    </div>
                    <div class="card-body pt-3">
                        <div class="form-group text-left">
                            <label class="form-text text-muted">Ostatnio edytował:<?= $article->user->name?? ''; ?> <?= $article->updated_at; ?></label>
                        </div>
                        <div class="form-group">
                            <label> Edytuj inny jezyk:</label>
                            <?php if (isset($langs) && isset($article->id) ): ?>
                                <?php foreach ($langs as $lang): ?>
                                    <a href="<?= route('articles.update', ['id' => $article->id, 'lang' => $lang['code']]); ?>">
                                        <img src="<?= url('/assets/admin/images/' . $lang['code'] . '.jpg'); ?>" alt="">
                                    </a>
                                <?php endforeach; ?>  
                            <?php endif; ?>  
                        </div>
                        <div class="form-group row">
                            <div class="checkbox check-success">
                                <label for="menu_top">formularz kontaktowy&nbsp;</label>
                                <input type="radio" value="1" name="contact_form" id="contact_form1" <?= $article->contact_form ? 'checked' : '' ?>>
                                <label for="contact_form1">tak</label>
                                <input type="radio" value="0" name="contact_form" id="contact_form2" <?= $article->contact_form ? '' : 'checked' ?>>
                                <label for="contact_form2">nie</label>
                            </div><br/>
                            <div class="checkbox check-success">
                                <?= Form::checkbox('menu_top', null, $article->menu_top, ['id' => 'menu_top']); ?> 
                                <label for="menu_top">widoczny w menu</label>
                            </div><br/>
                            <div class="checkbox check-success">
                                <?= Form::checkbox('menu_bottom', null, $article->menu_bottom, ['id' => 'menu_bottom']); ?>
                                <label for="menu_bottom">widoczny w stopce</label>
                            </div><br/>
                            <div class="checkbox check-success">
                                <?= Form::checkbox('menu_box', null, $article->menu_box, ['id' => 'menu_box']); ?>
                                <label for="menu_box">umiesc jako box</label>
                            </div><br/>
                        </div> 
                        <div class="form-group">
                            <label for="menu_top">Zdjęcie użyte jako:&nbsp;</label>
                            <input type="radio" value="1" name="img_typ" id="img_typ1" <?= $article->img_typ ? 'checked' : '' ?>>
                            <label for="img_typ1">tło</label>
                            <input type="radio" value="0" name="img_typ" id="img_typ2" <?= $article->img_typ ? '' : 'checked' ?>>
                            <label for="img_typ2">obraz</label>
                        </div>
                        <div class="form-group">
                            <label>Zdjęcie główne (<?= $size[0]; ?>x<?= $size[1]; ?> px)</label>
                            <?= fileInput('img', $article->img, 'd-none', ['.png, .jpg, .jpeg'],$size); ?>
                        </div>
                        <div class="form-group">
                            <label>Zdjęcie box (<?= $size_box[0]; ?>x<?= $size_box[1]; ?> px)</label>
                            <?= fileInput('imgbox', $article->imgbox, 'd-none', ['.png, .jpg, .jpeg'],$size_box); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?= Form::close(); ?>
    </div>
</div>
<?= cropJavaScript(compact($size)); ?>

@endsection

