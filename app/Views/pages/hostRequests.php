<li class="breadcrumb-item"><a class="text-light" href="/k24/public/Dashboard/manageUsers">Manage User & Permission</a></li>
<li class="breadcrumb-item active" aria-current="page">Host Request</li>
</ol>
</nav>

<table class="table">
<thead>
    <tr class="column">
        <th class="cell">Name</th>
        <th class="cell">Email</th>
        <th class="cell">Info </th>
        <th class="cell">Action</th>
        <!-- <th class="cell">Permissions</th> -->
    </tr>
</thead>

<form method='post' action='/k24/public/ManageUsers/hostRequests'>

<tbody>
<?php foreach ($hostReqs as $user) { ?>
    <tr>
        <td class="cell"><?php echo $user->fname.' '.$user->lname; ?> </td>
        <td class="cell"><?php echo $user->email; ?> </td>
        <td class="cell"> Class info? </td>
        <td class="cell">
        <div class="btn-group-vertical btn-group-sm d-flex">
            <?php
            echo '<button type="submit" name="approve" value="'.$user->user_id.'" class="btn btn-success"> Approve </button>';
            echo '<button type="submit" name="reject" value = "'.$user->user_id.'" class="btn btn-danger"> Reject </button>';
            ?>
            </div>
        </td>
        </form>
        
    </tr>
    <?php } ?>
</tbody>

