<?= View::make('admin.header', array('title' => $title) ) ?>
<?= Form::open(array('url' => 'admin/categories/' . $cat->id)) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5><?= $message ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <?= Form::label('name', 'Название категории') ?>
            <?= Form::text('name', $cat->name) ?>
            <?= Form::submit( 'Сохранить', array('class' => 'button') ) ?>
            <a href="/admin/categories" class="button secondary">Добавить новую</a>
            <a href="/admin/categories/del/<?=$cat->id?>" class="button alert">Удалить</a>
        </div>
    </div>
<?= Form::close() ?>

    <div class="row">
        <div class="large-12 columns">
            <h5>Категории:</h5>
            <ul>
                <?php
                foreach ($categories as $cat) {
                    echo '<li><a href="/admin/categories/' . $cat->id . '"> ' . $cat->name . ' </a></li>';
                }
                ?>
            </ul>

        </div>
    </div>

<?= View::make('admin.footer') ?>