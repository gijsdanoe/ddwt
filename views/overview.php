<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Own CSS -->
    <link rel="stylesheet" href="/DDWT18/ddwt18_project/css/main.css">

    <title><?= $page_title ?></title>
</head>
<body>
<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">

    <div class="row">

        <!-- Left column -->
        <div class="col-md-8 pt-4">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>
            <h1><?= $page_title ?></h1>
            <h4><?= $page_subtitle ?></h4>
            <?php if(isset($left_content)){echo $left_content;} ?>
        </div>
        <!-- Right column -->
        <div class="container col-sm-12 col-md-3">

            <div class="py-5 col-sm-17 col-md-17">
                <div class="card row">
                    <div class="card-header">
                        Search room
                    </div>
                    <div class="card-body">
                        <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="city" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Groningen">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label">Max. price in €</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="375">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="size" class="col-sm-3 col-form-label">Min. size in m2</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="size" name="size" placeholder="20">
                                </div>
                            </div>
                            <?php if(isset($room_id)){ ?><input type="hidden" name="room_id" value="<?php echo $room_id ?>"><?php } ?>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary"><?= $submit_btn ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="card row">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        <p class="count">Our community already has</p>
                        <h2><?= $nbr_users ?></h2>
                        <p>active users</p>
                        <?php if (!isset($_SESSION['user_id'])) { ?><a href="/DDWT18/ddwt18_project/register/" class="btn btn-primary">Join now</a><?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include $footer ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>