<li class="breadcrumb-item"> <a href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a href="/k24/public/TestReport/tests"> Tests </a> </li>
<li class="breadcrumb-item"> <a href="/k24/public/TestReport/editTest"> Edit test </a> </li>
<li class="breadcrumb-item active" aria-current="page">Edit Question</li>
</ol>
</nav>
<div class='container'>
<form method="post" action="/k24/public/Questions/editQuestion">
<div class="form-group row">
    <label for="question" class="col-sm-2 col-lg-2 col-form-label">Question</label>
    <div class="col-sm-10 col-lg-10"> 
        <input class ="col-lg-10" type="text" id = "question" name= "question" placeholder="<?php if(isset($question)) { echo $question->question;}?>"> 
    </div>
</div>

<?php $count = 0;?>
<div class="table-responsive text-center">  
    <table class="table table-bordered text-center" id="dynamic_field">  
        <tr> 
            <th> # </th>
            <th>Option </th>
            <th>Answer </th>
            <th> Remove </th>
</tr>  
    <?php foreach($options as $option){?>
        <tr>  
            <td><?php $count++; echo $count;?> <input type="hidden" name="options_id[]" value=<?php echo $option->option_id;?>> </td>
            <td><input type="text" name="options[]" placeholder=<?php echo $option->option_desc;?> class="form-control options_list" > </td> 
            <td><input class="form-check-input" type="checkbox" name="option_ans[]" value=<?php echo $option->option_id;?> <?php echo $option->ans == 1 ? 'checked' : ''; ?> ></td>
            <td><button type='submit' name="remove" value="<?php echo $option->option_id?>" class='btn btn-danger btn_remove'> <i class="fa fa-minus-circle"></i></button></td>
                    </tr>  
    <?php } ?>
    </table>  
    <td><button type="button" name="add" id="add" class="btn btn-success" onclick="addOption(); ">Add More</button></td>  
     
    <button type="submit" value="submit" class="btn btn-primary"> Submit </button>
</div>  

</form>
</div>
<script>  
    var option_num = <?php echo count($options); ?>;
    function addOption(){
        option_num++;
        var html= "<tr>";
            html +=  "<td>" + option_num + "</td>";
            html+= "<td> <input type='text'required name='newOptions[]' placeholder='option' class='form-control options_list' /></td>  ";
            html += "<td> <input class='form-check-input' name='newAns[]' type='hidden' value='0'> <input class='form-check-input' name='newAns[]' type='checkbox' value='1'> </td>";
            html += "<td><button type='button' onclick='deleteRow(this);' class='btn btn-danger btn_remove'><i class="fa fa-minus-circle"></i><</button></td>";
            html+= "</tr>";
        document.getElementById('dynamic_field').insertRow().innerHTML = html;
    }
 </script>
 <script>

 function deleteRow(self) {
        option_num--;
        self.parentElement.parentElement.remove();
    }
</script>