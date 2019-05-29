<tr>
    <td><?= $article['id']; ?></td>
    <td> 
        <?php if (\Auth::user()->can('articles.update')): ?>
            <a href="<?= route('articles.update', ['id' => $article['id'], 'lang' => $article['desc']->first()->lang]); ?>">
                <?php
                for ($i = 0; $i <= $lvl; $i++) {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                };
                ?><?= $article->descLang->name; ?>
            </a>
        <?php else: ?>
            <?php
            for ($i = 0; $i <= $lvl; $i++) {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            };
            ?>
            <?= $article->descLang->name; ?>
        <?php endif; ?>
    </td>
    <td>
        <?php foreach ($article->desc as $lang): ?> 
            @can('articles.update')
                <a href="<?= route('articles.update', ['id' => $article->id, 'lang' => $lang->lang]); ?>">
                   <img src="<?= url('/images/' . $lang->lang . '.jpg'); ?>" alt="">
                </a>
            @elsecan
                <img src="<?= url('/images/' . $lang->lang . '.jpg'); ?>" alt="">
            @endcan
        <?php endforeach; ?>
    </td>
    <td>
        <?= $article['menu_top'] ? '<i class="fs-14 fa fa-check text-success"></i>' : '<i class="fs-14 fa fa-minus text-dark"></i>'; ?>
    </td>
    <td>
        <?= $article['menu_bottom'] ? '<i class="fs-14 fa fa-check text-success"></i>' : '<i class="fs-14 fa fa-minus text-dark"></i>'; ?>
    </td>
     <td>
        <?= $article['menu_box'] ? '<i class="fs-14 fa fa-check text-success"></i>' : '<i class="fs-14 fa fa-minus text-dark"></i>'; ?>
    </td>
    <td>
        <input type="number" name="order[<?= $article->id; ?>]" class="form-control" value="<?= $article->order; ?>">
    </td>
    <td class="text-right">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            @can('articles.update')
                <a href="<?= route('articles.update', ['id' => $article->id, 'lang' => $article->descLang->lang]); ?>" class="btn-xs btn btn-outline-dark w-100">
                    Edytuj
                </a>
                <?php if ($article->id != 1): ?>
                    <div class="btn-group d-block" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a href="<?= route('articles.pub', ['id' => $article->id]); ?>" class="dropdown-item "><?= $article->pub ? 'Odpublikuj' : 'Publikuj'; ?></a>

                            @can('articles.delete')
                                <a href="<?= route('articles.delete', ['id' => $article->id]); ?>" class="dropdown-item" onclick="return confirm('Napewno usunać strone?')">Usuń</a>

                             @endcan
                        </div>
                    </div>
                <?php endif; ?>
            @endcan
        </div>
    </td>
</tr>