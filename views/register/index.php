
<div class="jumbotron">
	<div class="container">
		<h1>Register With Us</h1>
		<p>Something inspirational here...</p>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
			<form class="form-horizontal" autocomplete="off" method="POST" action="<?=URL?>register/signup">
			  <div class="form-group">
			  	<div class="col-sm-offset-3 col-sm-9">
				    <label class="control-label" for="type"><input type="radio" id="type" name="type" required value="Naira" checked> Naira to Dollar</label> 
				    <label class="control-label" for="type"><input type="radio" id="type" name="type" required value="Dollar"> Dollar to Naira</label>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="f_name">First Name:</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="f_name" name="first_name" required value="John">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="s_name">Surname:</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="s_name" name="last_name" required value="Doe">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="s_name">Phone Number:</label>
			    <div class="col-sm-9">
			    	<input type="tel" class="form-control" id="phone" name="phone" required value="08033334444">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="a_name">Account Name:</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="a_name" name="bank_account_name" required value="John Doe">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="a_name">Bank Name:</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="b_name" name="bank_name" required value="GTBank">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="a_number">Account Number:</label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control" id="a_number" name="bank_account_number" required value="0123456789">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="email">Email Address:</label>
			    <div class="col-sm-9">
			    	<input type="email" class="form-control" id="email" name="email" required value="johndoe@gmail.com">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="pwd">Password:</label>
			    <div class="col-sm-9">
			    	<input type="password" class="form-control" name="password" id="pwd" required value="password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-3" for="repwd">rePassword:</label>
			    <div class="col-sm-9">
			    	<input type="password" class="form-control" name="repassword" id="repwd" required value="password">
			    </div>
			  </div>
			  <div class="form-group"> 
			      <div class="col-sm-offset-3 col-sm-9">
			        <button type="submit" class="btn btn-default">Submit</button>
			      </div>
			    </div>
			</form>
		</div>
	</div>
</div>