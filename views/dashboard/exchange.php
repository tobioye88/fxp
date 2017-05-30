<div class="jumbotron">
	<div class="container">
		<h1>Exchange <?=(strtolower($this->details[0]['currency']) == 'naira')? '$': '&#x20A6';?> for <?=(strtolower($this->details[0]['currency']) == 'naira')? 'Naira': 'Dollars';?></h1>
		<p>from <?=$this->details[0]['names']?></p>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h3>How much do you want?</h3>
			<hr> 	
			<p>Payment Method: <?=$this->details[0]['method']?></p>
			<p>Rate: $1 / &#x20A6;500</p>
			<p>Rank: #1</p>
			<p>Trader's Limit: &#x20A6;<?=Utilities::formatMoney($this->details[0]['min'])?> - &#x20A6;<?=Utilities::formatMoney($this->details[0]['max'])?></p>
			<form class="form-horizontal" action="dashboard/transfer" method="post">
				<div class="input-group">
					<span class="input-group-addon"><?=(strtolower($this->details[0]['currency']) == 'naira')? '&#x20A6': '<i class="glyphicon glyphicon-usd">';?></i></span>
					<input 
						id="amount"
						class="form-control"
						type="number" 
						name="amount" 
						placeholder="Amount" 
						min="<?=$this->details[0]['min']?>" 
						max="<?=$this->details[0]['max']?>" 
						value="<?=$this->details[0]['max']?>">
					<span class="input-group-btn">
						<button 
							class="form-control btn btn-default" 
							type="submit" 
							name="exchange" 
							value="exchange">Exchange</button>
					</span>
					<span class="input-group-btn">
						<button class="form-control btn btn-primary" type="submit" name="exchange" value="special"><?=S_NAME?> Exchange</button>
					</span>
				</div>
				<small>Confirm Amount <span id="result"><?=$this->details[0]['max']?></span></small>
			</form>
		</div>
		<div class="col-sm-6">
    		<div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#terms" data-toggle="tab">Trader's Terms of Trade</a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">Trader's Profile</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="terms">
                        <div class="col-xs-12">
                        	<div><h2>Trader's Terms of Trade</h2></div>
                        	<p><?=$this->details[0]['terms']?></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <h2>Trader's Profile</h2>
                        <div>
                        	<p>Name:<?=$this->details[0]['names']?></p>
                        	<p>Reputation: </p>
                        	<p>Recomendation: </p>
                        	<p>No of Trades / No of succesful Trades: <?=$this->details[0]['trade_number']?>/<?=$this->details[0]['confirmed_trade_number']?></p>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2 class="text-center">Need Help???</h2>
		</div>
	</div>
</div>
<script type="text/javascript">

$(function(){
	function setAmount(){
		var val = +$('#amount').val();
		$('#result').html(val.formatMoney());
	}
	$('#amount').on('change', setAmount);
	setAmount();
});
</script>