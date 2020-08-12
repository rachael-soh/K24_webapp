<li class="breadcrumb-item"> <a class="text-light" href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item active"> People </a></li>
</ol>
</nav>

<!-- errors & success-->
<?php if (session()->get('success')): ?>
    <div class="alert alert-success" role="alert">
    <?= session()->get('success') ?>
    </div>
<?php endif; ?>  
<?php  if (session()->get('error')): ?>
<div class="alert alert-danger" role="alert">
<?= session()->get('error') ?>
</div>
<?php endif; ?>

<div class="container p-1 <?php echo session()->isHost? '':'d-none'?>">
<form method = "post" action = "<?php echo site_url('classes/people')?>" class="form-inline m-1">
    <input type="email" class="form-control col-10 " id="user" name="user" placeholder="user@email.com">
    <button type="submit" name="invite" id = "invite" value = "invite" class=" btn btn-primary col-2 float-left text-light"><i class="fa fa-user-plus"></i></button>
</form>
</div>

<div class="list-group">
<?php foreach($peserta as $p){?>
<div class="list-group-item list-group-item-action  d-flex justify-content-between">
<p class="py-2 m-0 flex-grow-1 <?php echo $p->host == 1? 'font-weight-bold' : ''?>">
    <?php echo $p->fname.' '.$p->lname; ?> 
</p>

        <form method="post" action="<?php echo site_url('classes/people')?>">
        <button type="submit" name="host_request" value="<?php echo $p->user_id ?>" class="btn btn-outline-light text-success mx-2 <?php echo session()->get('isHost') == 0 || $p->host == 1? "d-none": "" ?>"> <i class="fa fa-unlock" aria-hidden="true"></i></button>
        <button type="submit" name="delete" value="<?php echo $p->user_id ?>" class="btn btn-outline-light text-danger mx-2 <?php echo session()->get('isHost') == 0 || $p->user_id == session()->get('user_id') || $p->host == 1? "d-none": "" ?>"> <i class="fa fa-times" aria-hidden="true"></i> </button>
        </form>
</div>
<?php }?>
</table>
<br>


