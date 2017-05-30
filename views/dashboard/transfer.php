<div class="jumbotron">
	<div class="container">
		<h1>Confirm Transfer</h1>
		<?php if ($this->details['exchange'] == 'special'): ?>
			<p>Upload proof of confirmation</p>
		<?php else: ?>
			<p>Please confirm transaction</p>
		<?php endif ?>
	</div>
</div>

<div class="container">
	<div class="row">
	<?php if ($this->details['exchange'] == 'special'): ?>
		<div><?=$this->details['exchange']?></div>
		<div>Show special</div>
	<?php else: ?>
		<div><?=$this->details['exchange']?></div>
		<div>Show Normal exchange</div>
	<?php endif ?>
	</div>
</div>
