<div class="row">
    <div class="large-12 columns">
        <?php
        echo Form::label('test' . 1, 'Тест ' . 1 . '(правильный ответ):');
        echo Form::text('test' . 1, ${'test' . 1});
        for ($i = 2; $i <= 5; $i++) {
            echo Form::label('test' . $i, 'Тест ' . $i . ':');
            echo Form::text('test' . $i, ${'test' . $i});
        }
        ?>
    </div>
</div>