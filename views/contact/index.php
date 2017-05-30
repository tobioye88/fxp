
<div class="jumbotron">
	<div class="container">
		<h1>Contact Us</h1>
		<p>Something inspirational here...</p>
	</div>
</div>
<div class="container">

	<form class="form-horizontal" action="contact/submit" method="post"  id="contact_form">
		<fieldset>

			<!-- Form Name -->
			<legend>Contact Us Today!</legend>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label">First Name</label>  
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input  name="name" placeholder="First Name" class="form-control"  type="text">
					</div>
				</div>
			</div>
			

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label">Email</label>  
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input name="email" placeholder="Email Address" class="form-control"  type="text">
					</div>
				</div>
			</div>

			<!-- Text input-->

			<div class="form-group">
				<label class="col-md-4 control-label">Phone #</label>  
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						<input name="phone" placeholder="08012345678" class="form-control" type="text">
					</div>
				</div>
			</div>
			<input type="hidden" name="u_id" value="">
			<div class="form-group"> 
				<label class="col-md-4 control-label">Type</label>
				<div class="col-md-4 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select name="type" class="form-control selectpicker" >
							<option value=" " >Please select a type</option>
							<option value="Report">Report</option>
                            <option value="Complaint">Complaint</option>
							<option value="Complaint">My Account has been blocked</option>
							<option value="Sudjestions">Sudjestions</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Subject</label>  
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
						<input  name="subject" placeholder="Subject" class="form-control"  type="text">
					</div>
				</div>
			</div>

			<!-- Text area -->

			<div class="form-group">
				<label class="col-md-4 control-label">Message</label>
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<textarea class="form-control" name="message" placeholder="Message"></textarea>
					</div>
				</div>
			</div>
			<!-- Button -->
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
				<div class="col-md-4">
					<button type="submit" class="btn btn-info" >Send <span class="glyphicon glyphicon-send"></span></button>
				</div>
			</div>

		</fieldset>
	</form>
</div><!-- /.container -->
<script type="text/javascript" src="public/js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
            subject: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please tell us what this message is about'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            type: {
                validators: {
                    notEmpty: {
                        message: 'Please select an option'
                    },
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    stringLength: {
                        min: 11,
                        max: 11,
                        message:'Please enter 11 digits'
                    },
                    digits: {
                        message: 'The value can contain only digits'
                    }
                }
            },
            message: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of your complaint'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
        	// console.log($(this));
            var btn = $(this).find('[type="submit"]');
        	btn.hide();
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            console.log($form.attr('action'));
            // Use Ajax to submit form data
            var sm = $('#success_message');
            sm.addClass('alert-warning');
            sm.html('Sending... Please wait');
            sm.show('fast');
            $.post($form.attr('action'), $form.serialize(), function(result) {
                // console.log(result);
                sm.removeClass('alert-warning');
                sm.addClass('alert-success');
                sm.html('Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.');
                setTimeout(function(){
                    $form[0].reset();
                    sm.hide('fast');
                    btn.show();
                }, 2000);
            });
        });
});
</script>