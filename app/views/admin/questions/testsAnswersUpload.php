<div class="row">
    <div class="large-12 columns">
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo Form::label('test' . $i, 'Тест ' . $i . ':');
            echo Form::text('test', ${'test' . $i});
        }
        ?>
    </div>
</div>