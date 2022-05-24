<main id="mainarticle">
    <div id="pack">
        <time><?php echo htmlspecialchars($post['time']) ?></time>
        <article>
            <h2 id="description"><?php echo htmlspecialchars($post['description']) ?></h2>
            <h4 id="name"><?php echo htmlspecialchars($post['name']) ?></h4>
            <img src="/application/pic/<?php echo  $post['id'] ?>.jpg">
            <div id="text"><?php echo htmlspecialchars($post['text']) ?></div>
        </article>
    </div>
</main>


<?php if (@$_SESSION['admin']) : ?>
    <div id="admin">
        <button class="admbutton" onclick="transform()">Update</button>
        <button class="admbutton" onclick="window.location = '/admin/delete/<?php echo $post['id'] ?>'">Delete</button>
        <button class="admbutton" onclick="window.location = '/admin/approve/<?php echo $post['id'] ?>'">Approve</button>
    </div>
<?php endif; ?>