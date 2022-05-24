    <main id="listwrapper">
        <?php if (empty($list)) : ?>
            <h2>Список пуст</h2><br>
        <?php else : ?>
            <?php foreach ($list as $value) :  ?>
                <table onclick="document.location='/main/post/<?php echo $value['id'] ?>'">
                    <tr>
                        <td rowspan="3" class="pic"> <img src="/application/pic/picture_<?php echo $value['id'] ?>.jpg"  class="icon"/></td>
                        <td>
                            <h3><?php echo htmlspecialchars($value['name']) ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4><?php echo htmlspecialchars($value['description']) ?></h4>
                        </td>
                    </tr>
                    <tr>
                    <td><?php echo preg_filter("/\s\S+$/u","...",mb_substr(htmlspecialchars($value['text']),0,150)); ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
    </main>



    <?php endif; ?>
    <?php if (@$_SESSION['sent']) : ?>

        <script>
            alert("Ваш пост будет опубликован после рассмотрения модератором, не позже, чем через двенадцать часов")
        </script>
        <?php unset($_SESSION['sent']); ?>
    <?php endif; ?>
    <?php echo $pagination; ?>