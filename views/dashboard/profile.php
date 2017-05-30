
<div class="jumbotron">
	<div class="container">
		<h1>Profile</h1>
		<p><?=$this->profile['first_name'];?> <?=$this->profile['last_name'];?></p>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table-striped">
				<tr>
					<td>Name</td>
					<td><?=$this->profile['first_name']?> <?=$this->profile['last_name'];?></td>
				</tr>
				<tr>
					<td>Bank Account Name</td>
					<td><?=$this->profile['account_name']?></td>
				</tr>
				<tr>
					<td>Bank Name</td>
					<td><?=$this->profile['bank_name']?></td>
				</tr>
				<tr>
					<td>Bank Account</td>
					<td><?=$this->profile['account_number']?></td>
				</tr>
			</table>
			<a href="#">+Edit</a>
		</div>
	</div>
</div>
<style type="text/css">
td{
	padding: 10px;
}
</style>
