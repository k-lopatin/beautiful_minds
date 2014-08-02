<?= View::make('admin.header', array('title' => $title)) ?>
<?= Form::open(array('url' => 'admin/cities/'.$id, 'files'=> true )) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h4>Редактировать город | <a href="/admin/qlist?type=city">Все города</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h5><?= $message ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-7 columns">
           <?= Form::label('name', 'Название') ?>
           <?= Form::text('name', $name) ?>

           <?= Form::label('country', 'Страна') ?>
           <?= Form::text('country', $country) ?>

           <?= Form::label('population', 'Население') ?>
           <?= Form::text('population', $population) ?>

           <?= Form::label('description', 'Описание') ?>
           <?= Form::text('description', $description) ?>

           <?= Form::submit('Добавить', array('class' => 'button')) ?>
            <a href="/admin/cities" class="button secondary">Добавить новый город</a>
            <a href="/admin/cities/del/<?=$id?>" class="button alert">Удалить</a>
        </div>
         <?= $filesView ?>
    </div>
<?= Form::close() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5>Последние города: | <a href="/admin/qlist?type=city">Все города</a></h5>
            <table>
                <?php
                    foreach ($questions as $q) {
                        echo '<tr>';
                        echo '<td>Страна:<a href="/admin/cities/' . $q->id . '"> ' . $q->country . ' </a></td>';
                        echo '<td>Город:' . $q->name . ' </td>';
                        echo '</tr>';
                    }
                ?>
            </table>

        </div>

    </div>

<?= View::make('admin.footer') ?>