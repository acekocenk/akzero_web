<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="/css/bootstrap-icons.css">

    <!-- sb-admin-2 -->
    <link rel="stylesheet" href="/css/sb-admin-2.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="/fontawesome/css/all.css">

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css">

    <!-- sweetalert -->
    <link rel="stylesheet" href="/css/sweetalert2.min.css">

    <!-- JS -->
    <script src="/js/jquery-3.5.1.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap5.min.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>

    <!-- sweetalert -->
    <script src="/js/sweetalert2.min.js"></script>

    <!-- sb-admin-2 -->
    <script src="/js/sb-admin-2.min.js"></script>
</head>

<body>
    <main>
        <?= $this->include('layout/navbar'); ?>
        <?= $this->renderSection('content'); ?>
    </main>
</body>

</html>