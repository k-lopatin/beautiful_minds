<?=$headerTpl?>
<div class="row">
	<div class="large-12 columns">
		<h5><?=$message;?></h5>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<h6>Обновить индекс вопросов</h6>
		<?= Form::open(array('url' => '/admin/additional')) ?>
		<label><?= Form::checkbox('model[]', 'QuestionNumber') ?> QuestionNumber &nbsp;</label>
		<label><?= Form::checkbox('model[]', 'QuestionWord') ?> QuestionWord &nbsp;</label>
		<label><label><?= Form::checkbox('model[]', 'QuestionTest') ?> QuestionTest &nbsp;</label>
		<label><?= Form::checkbox('model[]', 'QuestionOrder') ?> QuestionOrder &nbsp;</label>
		<label><?= Form::checkbox('model[]', 'QuestionMap') ?> QuestionMap &nbsp; </label>
		<label><?= Form::checkbox('model[]', 'City') ?> City &nbsp; </label>
		<?= Form::submit( 'Обновить', array('class' => 'button alert') ) ?>
		<?= Form::close() ?>
	</div>
</div>
<?=$footerTpl?>