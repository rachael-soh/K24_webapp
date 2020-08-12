<div class="container">
	<div class="row">
	  	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
        	<div class="container">
				<h3> Login </h3>
				<hr>
				<?php if (session()->get('success')):?>
					<div class="alert alert-success">
						<?=session()->get('success') ?>
					</div>
				<?php endif; ?>
				<?php if (session()->get('error')): ?>
				<div class="alert alert-danger" role="alert">
				<?= session()->get('error') ?>
				</div>
				<?php endif; ?>
				<form class="" action="<?php echo site_url("pages/index")?>" method="post">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email" value = "<?= set_value('email') ?>">
						</div>
						
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" value = "">
						</div>	

						<?php if (isset($validation)): ?>
                            <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                            </div>
						<?php endif; ?>
								
						<div class="row">
							<div class="col-12 col-sm-4">
								<button type="submit" class="btn btn-primary">Login</button>	
							</div>
						</div>		
		
						<div class= "col-12 col-sm-8 text-right">
							<a href="pages/signup"> Don't have an account? </a>
						</div>
		    	</form>
            </div>	
	  	</div>
	</div>
</div>