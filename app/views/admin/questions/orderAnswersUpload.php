<div class="row">
    <div class="large-12 columns">
        <?php
        echo Form::label('test' . 1, 'Событие №' . 1 . ' (Самое раннее):');
        echo Form::text('test' . 1, ${'test' . 1});
        for ($i = 2; $i <= 5; $i++) {
            echo Form::label('test' . $i, 'Событие № ' . $i . ':');
            echo Form::text('test' . $i, ${'test' . $i});
        }
        ?>
    </div>
</div>