<!DOCTYPE html>
<html>
    <head>
        <title><?php if (isset($title)) : echo $this->escape($title); endif; ?></title>
        <!-- bootstrap4 include -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <!-- favicon -->
        <link rel="shortcut icon" href="/img/brand.png">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <img src="/img/brand.png" width="30" height="30" class="d-inline-block align-top mr-1" alt="">
            <span class="navbar-brand mb-0 h1">Soiweb CMS</span>
            <div class="navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <?php if ($session->isAuthenticated()) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/logout">ログアウト</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="container">
            <?php echo $_content; ?>
        </div>
    </body>
</html>
