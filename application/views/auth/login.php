<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Page - TK AMALIA</title>

    <style>
        body {
            background-image: url(./assets/img/abc.jpg);
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body>

    <div class="card shadow-lg rounded" style="width: 600px; margin: 70px auto; background: #eaeaea;">
        <div class="row justify-content-center p-3 my-3">
            <div class="col-lg-10 col-md-10 col-12"><br>
                <!-- <h2 class="text-center">Login page</h2> -->
                <small style="margin-left: 139px; font-size: 12px; letter-spacing: 2px; text-transform: uppercase;">TK Amalia Kab. Bandung </small>
                <h1 class="text-center rounded pt-1" style="background-color: #ffff; color: #192a56; box-shadow: 1px 1px 3px #192a56; text-shadow: 1px 3px 3px azure; width: 230px; height:40px; margin: 2px auto; font-size: 22px; font-weight: 700 !important;"> <?= ucwords($cekLogin) ?></h1>
                <div class="px-5 py-3">
                    <div class="messageLogin">
                        <?php echo $this->session->flashdata('message') ?>
                    </div>
                    <?php if ($cekLogin == 'Login Admin') { ?>
                        <form action="<?= base_url('admin') ?>" method="post">
                        <?php } else { ?>
                            <form action="<?= base_url('login') ?>" method="post">
                            <?php } ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="nama@gmail.com" autocomplete="off" autofocus>
                                <?= form_error('email', '<small class="text-danger pl-2">', ' </small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="password">
                                <?= form_error('password', '<small class="text-danger pl-2">', ' </small>'); ?>
                            </div>
                            <button type="submit" class="btn text-white py-1 px-3" style="display: inline !important; background-color: #192a56;">Login</button>
                            <?php if ($cekLogin != 'Login Admin') { ?>
                                <a href="<?= base_url('register') ?>" class="text-decoration-none mt-2" style="display: inline !important; float: right; color: #000; margin-right:5px;">Daftar?</a>
                            <?php } ?>
                            </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
        setTimeout(function() {
            document.querySelector('.messageLogin').style.display = 'none';
        }, 3000)
    </script>
    <?php unset($_SESSION['message']); ?>
</body>

</html>