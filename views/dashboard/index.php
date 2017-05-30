
<?php if (!Auth::isActivated()): ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-info alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p><strong>Activation Required!</strong> We have sent you an email. Please, check you email and follow the link to activate your account.</p>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Dashboard</h1>
				<p>All your transactions and more...</p>
				<a href="dashboard/x4dollar" class="btn btn-info">Exchange for Dollar</a>
				<a href="dashboard/x4naira" class="btn btn-info">Exchange for Naira</a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel-body">
	            <!-- Nav tabs -->
	            <ul class="nav nav-tabs">
	                <li class="active"><a href="#trans" data-toggle="tab">Transactions</a>
	                </li>
	                <li><a href="#trade" data-toggle="tab">Post a trade</a>
	                </li>
	            </ul>

	            <!-- Tab panes -->
	            <div class="tab-content">
	                <div class="tab-pane fade in active" id="trans">
	                    <div>!!!Transactions show here</div>
	                </div>
	                <div class="tab-pane fade" id="trade">
	                    <h2>Post a Trade</h2>
	                    <form method="post" action="dashboard/put">
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">I want to</div>
	                    		<div class="col-sm-3">
	                    			<label><input type="radio" name="xcurrency" value="Naira"> Exchange for Naira</label>
	                    			<label><input type="radio" name="xcurrency" value="Dollar"> Exchange for Dollar</label>
	                    		</div>
	                    		<div class="col-sm-7"><p>What kind of trade advertisement do you wish to create? If you exchange please make sure you have the required anmount bitcoins make sure you have bitcoins in your LocalBitcoins wallet.</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">Amount</div>
	                    		<div class="col-sm-3">
	                    			<input class="form-control" type="text" name="amount" placeholder="100000">
	                    		</div>
	                    		<div class="col-sm-7"><p>Set an amount you have available for a trade</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">Payment Method</div>
	                    		<div class="col-sm-3">
	                    			<select class="form-control" name="method">
	                    				<option value="Bank Transfer">Bank Transfer</option>
	                    			</select>
	                    		</div>
	                    		<div class="col-sm-7"><p>This is the only option for now.</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">Min. transaction limit</div>
	                    		<div class="col-sm-3">
	                    			<input class="form-control" type="number" name="min">
	                    		</div>
	                    		<div class="col-sm-7"><p>Optional. Minimum transaction limit in one trade.</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">Max. transaction limit</div>
	                    		<div class="col-sm-3">
	                    			<input class="form-control" type="number" name="max">
	                    		</div>
	                    		<div class="col-sm-7"><p>Optional. Maximum transaction limit in one trade. For online sells, your LocalBitcoins.com wallet balance may limit the maximum fundable trade also.</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">Restrict amounts to</div>
	                    		<div class="col-sm-3">
	                    			<input class="form-control" type="text" name="restrict">
	                    		</div>
	                    		<div class="col-sm-7"><p>Optional. Restrict trading amounts to specific comma-separated integers, for example 20,50,100. In fiat currency (USD/EUR/etc). Handy for coupons, gift cards, etc.</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-2">Terms of trade</div>
	                    		<div class="col-sm-3">
	                    			<textarea class="form-control" name="terms" rows="8"></textarea>
	                    		</div>
	                    		<div class="col-sm-7"><p>Other information you wish to tell about your trade. Example 1: This advertisement is only for cash trades. If you want to pay online, contact localbitcoins.com/ad/1234. Example 2: Please make request only when you can complete the payment with cash within 12 hours.</p></div>
	                    	</div>
	                    	<div class="row paddingTB">
	                    		<div class="col-sm-offset-2 col-sm-10">
	                    			<input class="btn btn-info" type="submit" value="Publish Advert">
	                    		</div>
	                    	</div>
	                    </form>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>