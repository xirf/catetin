<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
                $sql = "SELECT * FROM tb_todo ORDER BY created_at DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card"
                            style="--color: <?= $row['color'] ?>"
                            data-color="<?= $row['color'] ?>"
                            data-id="<?= $row['id'] ?>">
                            <div id="todo"><?= $row['todo'] ?></div>
                            <div class="flex-center space-between">
                                <span class="time"><?= time_elapsed_string($row['created_at']) ?></span>
                                <button class="btn-primary" id="edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
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
        <form method="post" class="form-todo" action="new.php">
            <button class="close" type="button">
                <i class=" fas fa-times"></i>
            </button>
            <label for="todo">Tambah Catatan</label>
            <textarea type="text" name="todo" placeholder="Apa yang ingin kamu catat?"></textarea>
            <input type="hidden" name="color" value="#fec971">
            <button type="submit">Catat</button>
        </form>
    </dialog>

    <dialog id="form-edit">
        <form method="post" action="edit.php" class="form-todo">
            <button class="close" type="button">
                <i class=" fas fa-times"></i>
            </button>
            <label for="todo">Edit Catatan</label>
            <textarea type="text" name="todo" placeholder="Apa yang ingin kamu catat?"></textarea>
            <input type="hidden" name="color" value="#fec971">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit">Ubah</button>
        </form>
    </dialog>

    <dialog id="view-note">
        <div class="card nolimit relative" style="--color: <?= $row['color'] ?>">
            <button class="close" type="button">
                <i class=" fas fa-times"></i>
            </button>
            <div id="todo"></div>
            <div class="flex-center space-between">
                <span class="time"></span>
                <div class="flex gap-2">
                    <button class="btn-primary" id="edit">
                        <i class="fas fa-pen"></i>
                    </button>
                    <a class="btn-primary red" id="delete" href="delete.php?id=x">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </dialog>
</body>

<script>
    const buttons = document.querySelectorAll('.btn-small');
    const dialog = document.querySelector('#form-todo');
    const inputColor = dialog.querySelector('input[name="color"]');
    const close = dialog.querySelector('.close');

    const editform = document.querySelector('#form-edit');
    const editBtn = document.querySelectorAll('#edit');
    const editClose = editform.querySelector('.close');

    const viewNote = document.querySelector('#view-note');
    const cards = document.querySelectorAll('.card:not(.nolimit)');

    viewNote.querySelector('.close').addEventListener('click', function() {
        viewNote.close();
    });

    cards.forEach(card => {
        card.addEventListener('click', function() {
            const todo = card.querySelector('#todo').textContent;
            const time = card.querySelector('.time').textContent;
            const color = card.getAttribute('data-color');
            const id = card.getAttribute('data-id');

            viewNote.setAttribute('style', `--color: ${color}`);
            viewNote.querySelector('#todo').textContent = todo;
            viewNote.querySelector('.time').textContent = time;
            viewNote.querySelector('#delete').setAttribute('href', `delete.php?id=${id}`);

            viewNote.showModal();
        });
    });

    viewNote.querySelector('#delete').addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        if (confirm('Apakah kamu yakin ingin menghapus catatan ini?')) {
            window.location.href = href;
        }
    });

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const color = this.getAttribute('value');
            inputColor.value = color;
            dialog.setAttribute('style', `--color: ${color}`);
            dialog.showModal();
        });
    });

    editBtn.forEach(button => {
        button.addEventListener('click', function() {
            const todo = this.parentElement.parentElement.querySelector('#todo').textContent;
            const color = this.parentElement.parentElement.getAttribute('data-color');
            const id = this.parentElement.parentElement.getAttribute('data-id');

            editform.querySelector('textarea').value = todo;
            editform.querySelector('input[name="color"]').value = color;
            editform.querySelector('input[name="id"]').value = id;

            editform.setAttribute('style', `--color: ${color}`);



            editform.showModal();
            setTimeout(() => {
                viewNote.close();
            }, 1);
        });
    });

    close.addEventListener('click', function() {
        dialog.close();
    });

    editClose.addEventListener('click', function() {
        editform.close();
    });
</script>

</html>