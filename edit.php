<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan 1</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable();
        });
    </script>
    <?php
    require_once 'app/User.php';
    require_once 'app/Status.php';
    if (isset($_GET['id'])) {
        $edit_user = $user->show($_GET['id'])[0];
    } else {
        header('Location: index.php');
        exit();
    }
    if (isset($_POST['updateButton'])) $user->update($_POST);
    ?>

</head>

<body>
    <main>
        <div class="card m-auto my-5" style="width: 90%;">
            <form action="edit.php?id=<?= $edit_user['id'] ?>" method="POST" name="theForm" onsubmit="return validateSubmit()" enctype="multipart/form-data">
                <input type="text" name="id" value="<?= $edit_user['id'] ?>" hidden>
                <div class="card-header">
                    Data User
                </div>
                <div class="content">
                    <div class="container d-flex align-items-center justify-content-between gap-3">
                        <div style="width: 70%;">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $edit_user['nama'] ?>" id="nama" aria-describedby="emailHelp" oninput="checkName(this)">
                                <div id="namaError" class="form-text">
                                    ‎
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2" style="width: 100%;">
                                <div class="mb-3" style="width: 50%;">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" value="<?= $edit_user['password'] ?>" disabled name="password" id="password" aria-describedby="emailHelp" oninput="checkPassword()">
                                    <div id="passwordError" class="form-text">
                                        ‎
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 50%;">
                                    <label for="retypePassword" class="form-label">Retype Password</label>
                                    <input type="password" class="form-control" value="<?= $edit_user['password'] ?>" disabled id="retypePassword" aria-describedby="emailHelp" name="retypePassword" oninput="checkRetypePass(this)">
                                    <div id="retypePasswordError" class="form-text">
                                        ‎
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $edit_user['email'] ?>" id="email" aria-describedby="emailHelp" oninput="checkEmail(this)">
                                <div id="emailError" class="form-text">
                                    ‎
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= $edit_user['alamat'] ?>" id="alamat" placeholder="Alamat" aria-describedby="emailHelp">
                                <div id="alamatError" class="form-text">
                                    ‎
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="mb-3" style="width: 33%;">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control" name="kota" value="<?= $edit_user['kota'] ?>" id="kota" aria-describedby="emailHelp">
                                    <div id="kotaError" class="form-text">
                                        ‎
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 33%;">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option hidden>Pilih Bagian</option>
                                        <?php
                                        $all_status = $status->all();
                                        while ($stat = mysqli_fetch_assoc($all_status)) : ?>
                                            <option value="<?= $stat['id'] ?>" <?= ($edit_user['status'] == $stat['id'] ? 'selected' : '') ?>><?= $stat['nama'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <div id="statusError" class="form-text">
                                        ‎
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 33%;">
                                    <label for="telp" class="form-label">Telp.</label>
                                    <input type="text" class="form-control" id="telp" value="<?= $edit_user['telp'] ?>" aria-describedby="emailHelp" name="telp">
                                    <div id="telpError" class="form-text">
                                        ‎
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width: 30%;">
                            <img src="imgs/img-not-found.png" class="card-img-top" id="prevImg">
                            <div class="card-body">
                                <label for="upload" class="btn btn-primary">
                                    <input type="file" accept="image/*" id="upload" style="display: none;" oninput="prevImage()">
                                    Browse File
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit" style="width: 30%;" name="updateButton">Update</button>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>