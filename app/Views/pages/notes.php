<li class="breadcrumb-item"> <a class="text-light" href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item active" aria-current="page">Notes</li>
</ol>
</nav>

<form method="post" action="/k24/public/Notes/noteAction">
<div class ="card"> <h4> Total Notes: <?php echo count($notes);?> </h4> </div>
<div class="list-group">
<?php foreach($notes as $note) {?>
    <a href="" class="list-group-item list-group-item-action"> <?php echo $note->note_name;?>
    <div class="btn-group float-right" role="group" aria-label="Basic example">
    <!--
        <button type="submit" name="edit" value =<?php //echo $note->note_id ?> class="btn btn-primary">View</button>
    -->
    <?php echo base_url().'/'.$note->note_path?>
        <a href="<?php echo base_url().'/k24/writable/uploads/'.$note->note_path?>"> Open file</a>
        <button type="submit" name="edit" value =<?php echo $note->note_id ?> class="btn btn-danger">Edit</button>
    </div>
    </a>
<?php } ?>
</div>
<div class="form-group">
<button type="submit" name="add" value = "add" class="btn btn-primary <?php echo session()->user_id ==3? 'd-none' : ''?>"> Add </button>
</div>
</form>