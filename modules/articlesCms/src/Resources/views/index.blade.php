@extends('cms::index') 
@section('content')
<div class="row">

    <div class="col-12">
        <div class="card card-default">
            <div class="card-header  separator">
                <div class="card-title">Strony 
                    @can('articles.create')
                    <a href="<?= route('articles.update', ['id' => 'n', 'lang' => 'all']); ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> nowa </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <?= Form::open(['route' => 'articles.order', 'class' => 'my-3']); ?>
                        <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                            <thead>
                                <tr>
                                    <th width="30px">#</th>
                                    <th scope="">Nazwa</th>
                                    <th scope="">Edycja języka</th>
                                    <th width="5%">Menu</th>
                                    <th width="5%">Footer</th>
                                    <th  width="5%">Box</th>
                                    <th scope="" width="30px">Kolejnośc</th>
                                    <th width="5%">Opcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($articles as $article): ?>
                                    <!--pierwszy lvl główny-->
                                    <?= \View::make('articles::renderArticles', ['article' => $article, 'lvl' => 0]); ?>
                                    <?php foreach ($article->child as $article_child): ?>
                                        <!--Menu wyświetlane na stronie głównej-->
                                        <?= \View::make('articles::renderArticles', ['article' => $article_child, 'lvl' => 1]); ?>
                                        <?php foreach ($article_child->child as $article_child2): ?>
                                            <!--menu wyswietlane w drop box-->
                                            <?= \View::make('articles::renderArticles', ['article' => $article_child2, 'lvl' => 2]); ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                @can('articles.update')
                                <tr>
                                    <td colspan="7"><button class="btn btn-outline-primary pull-right" type="submit"> zapisz kolejność</button></td>
                                    <td></td>
                                </tr>
                                @endcan
                            </tbody>
                        </table>
                        <?= Form::close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

