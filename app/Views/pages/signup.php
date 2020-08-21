<div class="container mx-2 px-2 mb-3">
	<div class="row">
	  	<div class="col-12 mt-3 p-1 bg-white from-wrapper">
        	<div class="container">
                <form class="" action="<?php echo site_url('pages/signup')?>" method="post">
                    <div class = "row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value = "<?= set_value('fname') ?>">
                            </div>
                        </div>
                    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value = "<?= set_value('lname') ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value = "<?= set_value('email') ?>">
                            </div>
                        </div>  
						<div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value = "">
                            </div>	
                        </div> 		
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password_confirm">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" value = "">
                            </div>	
                        </div> 	
                        <?php if (isset($validation)): ?>
                            <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                            </div>
                        <?php endif; ?>
                        </div>				
						<div class="row">
							<div class="col-4">
								<button type="submit" class="btn btn-success">Sign up</button>	
							</div>
						</div>		
		
						<div class= "col-12 col-sm-8 text-right">
							<a href="/k24/public/"> Already have an account? </a>
						</div>
		    	</form>
            </div>	
	  	</div>
	</div>
</div>