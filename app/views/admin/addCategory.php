<?= View::make('admin.header') ?>
<?= Form::open(array('url' => 'admin/categories')) ?>
<?= Form::token() ?>
<div class="row">
    <div class="large-12 columns">
        <h5><?= $message ?></h5>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <?= Form::label('name', 'Название категории') ?>
        <?= Form::text('name', $newCatName) ?>
        <?= Form::submit('Добавить', array('class' => 'button') ) ?>
    </div>
</div>
<?= Form::close() ?>
<div class="row">
    <div class="large-12 columns">
        <h5>Категории:</h5>
        <ul>
            <?php
            foreach ($categories as $cat) {
                echo '<li><a href="/admin/categories/'.$cat->id.'"> '.$cat->name.' </a></li>';
            }
            ?>
        </ul>

    </div>
</div>

<?= View::make('admin.footer') ?>