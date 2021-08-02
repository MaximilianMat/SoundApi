<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Soundstream</title>

        <base href="/Soundstream/index.php/">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controller=adminPanel">Verwalten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controller=newSong">Hinzufügen</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?controller=logout">Logout</a>
                </li>
            </ul>
        </nav>
        <div class="container-sm pt-3">
            <br>
            <?= $this->_['content']; ?>
            <br><br>
        </div>

        <script src="/includes/js/load.js"></script>
    </body>
</html>

