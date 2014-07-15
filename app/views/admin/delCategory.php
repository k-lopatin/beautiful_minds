<?= View::make('admin.header', array('title' => $title) ) ?>
<?= Form::open(array('url' => 'admin/categories/del/' . $cat->id)) ?>
<?= Form::token() ?>
    <div class="row">
        <div class="large-12 columns">
            <h5>Вы действительно хотите удалить категорию "<?=$cat->name?>"?</h5>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <?= Form::hidden('is', 1) ?>
            <?= Form::submit( 'Да, удалить', array('class' => 'button alert') ) ?>
            <a href="/admin/categories" class="button">Нет, верни меня обратно</a>
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