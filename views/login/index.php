<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<h2>Login</h2>
				<form class="form-horizontal" method="POST" action="login/login">
					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email" name="email" required value="johndoe@gmail.com" placeholder="example@mail.com">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="f_name">Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="password" name="password" required value="password">
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
</section>