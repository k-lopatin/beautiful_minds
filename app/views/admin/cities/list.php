<?= View::make('admin.header', array('title' => $title)) ?>
<div class="row">
    <div class="large-12 columns">
        <h4><?=$typeTitle?> (<b> <?=$count?> </b>) | <a href="/admin/<?=$linkToQ?>">Добавить новый</a></h4>
    </div>
</div>
<br />
<div class="row">
    <div class="large-8 columns">
        <?= Form::open(array('url' => '/admin/clist', 'method' => 'get')) ?>
        <?= Form::hidden('type', $linkType) ?>
        <?= Form::hidden('category', $linkCategory) ?>
        <?= Form::hidden('complexity', $linkComplexity) ?>
        <?= Form::label('s', 'Поиск:') ?>
        <?= Form::text('s', $search) ?>
        <?= Form::close() ?>
        <table>
            <thead>
                <th>Страна</th>
                <th>Город</th>
                <th>Население</th>
                <th>Статус</th>

            </thead>
            <?php
                foreach ($questions as $q) {
                    echo '<tr>';
                    echo '<td>' . $q->country . ' </td>';
                    echo '<td><a href="/admin/cities/' . $q->id . '"> ' . $q->name . ' </a></td>';
                    echo '<td>' . $q->population . ' </td>';
                    if($q->is_free == 0){
                        echo '<td> Свободен </td>';
                    } else {
                        echo '<td> Занят </td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
        Страницы:&nbsp;&nbsp;
        <?php
        $pages = $questions->getLastPage();
        for ($i=1; $i <= $pages; $i++) {
            if($questions->getCurrentPage() === $i){
                echo $i.'</a>&nbsp;&nbsp;';
            } else {
                echo '<a href="?type='.$linkType.'&category='.$linkCategory.'&complexity='.$linkComplexity.'&page='.$i.'&s='.$search.'">'.$i.'</a>&nbsp;&nbsp;';
            }

        }
        ?>
    </div>

    </div>

</div>

<?= View::make('admin.footer') ?>