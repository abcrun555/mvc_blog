<?php if(isset($errors)):?>
<?php foreach($errors as $key=>$val):?>
<p style="color:red; font-weight:bold;"><?php echo $val; ?><br></p>
<?php endforeach; ?>
<?php endif; ?>

    
    
    <form action="/main/send" method="post" enctype="multipart/form-data">
        <span>Имя:</span><br>
        <input type="text" class="info" name="name" value="<?php if(isset($errors)) echo $_POST['name']; ?>"><br>
        <span>Тема:</span><br>
        <input type="text" class="info" name="description" value="<?php if(isset($errors)) echo $_POST['description']; ?>"><br>
        <span>Текст:</span><br>
        <textarea  class="text" name="text"> <?php if(isset($errors)) echo $_POST['text']; ?></textarea><br>
        <input type="file" name="pic" value="<?php if(isset($errors)) $_FILES['pic']; ?>"><br><br>
        <input type="submit" value="Опубликовать" class="publish_button" name="send" onclick="localStorage.setItem('post', true)">
    </form>
    
    

