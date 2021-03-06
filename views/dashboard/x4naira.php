<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Exchange $ for Naira</h1>
				<p>You have Dollars and you want Naira</p> 
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<form action="" method="POST">
				<div class="col-sm-3">
					<input class="form-control" type="text" name="amount" placeholder="Amount" title="Amount">
				</div>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="currency" readonly value="Naira">
				</div>
				<div class="col-sm-3">
					<select class="form-control" name="method">
						<option value="Bank Transfer">Bank Transfer</option>
					</select>
				</div>
				<div class="col-sm-3">
					<input class="form-control btn btn-info" type="submit" name="submit" value="Search">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Sell &#x20A6; to any of these Buyers</h2>

			<?php foreach($this->list as $row):?>
				<div class="col-sm-12 paddingTB">
					<div class="col-sm-3"><?=$row['name']?></div>
					<div class="col-sm-3"><?=$row['method']?></div>
					<div class="col-sm-3">&#x20A6;<?=Utilities::formatMoney($row['amount'])?> (<?=Utilities::formatMoney($row['min'])?> - <?=Utilities::formatMoney($row['max'])?>)</div>
					<div class="col-sm-3 text-right"><a class="btn btn-default" href="dashboard/exchange/<?=$row['id']?>">Contact</a></div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
</div>