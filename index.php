<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php


    include 'koneksi.php';


    if (isset($_POST['todo'])) {
        $todo = $_POST['todo'];
        $color = $_POST['color'];

        $sql = "INSERT INTO tb_todo (todo, color) VALUES ('$todo', '$color')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Catatan berhasil ditambahkan!')</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($conn) . "')</script>";
        }
    }

    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'head.php'; ?>
</head>

<body>
    <div class="main">
        <aside>
            <h1 class="brand-name">Catetin</h1>
            <div class="relative">
                <input type="checkbox" id="btn" class="hide">
                <label class="btn-primary" for="btn">
                    <i class="fas fa-plus"></i>
                </label>
                <div class="dropdown">
                    <button class="btn-small" value="#fec971" style="--color: #fec971; --index: 0;"></button>
                    <button class="btn-small" value="#fe9b72" style="--color: #fe9b72; --index: 1;"></button>
                    <button class="btn-small" value="#b693fd" style="--color: #b693fd; --index: 2;"></button>
                    <button class="btn-small" value="#00d4fe" style="--color: #00d4fe; --index: 3;"></button>
                    <button class="btn-small" value="#e4ef8f" style="--color: #e4ef8f; --index: 4;"></button>
                </div>
            </div>
        </aside>


        <main>
            <div class="container">
                <?php
                $sql = "SELECT * FROM tb_todo";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card" style="--color: <?= $row['color'] ?>">
                            <p><?= $row['todo'] ?></p>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='empty'>Tidak ada catatan</p>";
                }
                ?>
            </div>
        </main>
    </div>



    <dialog id="form-todo">
        <form method="post" class="form-todo">
            <button class="close" type="button"">
                <i class=" fas fa-times"></i>
            </button>
            <label for="todo">Tambah Catatan</label>
            <textarea type="text" name="todo" placeholder="Apa yang ingin kamu catat?"></textarea>
            <input type="hidden" name="color" value="#fec971">
            <button type="submit">Catat</button>
        </form>
    </dialog>
</body>

<script>
    const buttons = document.querySelectorAll('.btn-small');
    const dialog = document.querySelector('#form-todo');
    const inputColor = dialog.querySelector('input[name="color"]');
    const close = dialog.querySelector('.close');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const color = this.getAttribute('value');
            inputColor.value = color;
            dialog.setAttribute('style', `--color: ${color}`);
            dialog.showModal();
        });
    });

    close.addEventListener('click', function() {
        dialog.close();
    });
</script>

</html>