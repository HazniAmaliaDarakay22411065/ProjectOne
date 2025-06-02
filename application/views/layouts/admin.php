<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Dashboard Admin' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            background-color: rgb(11, 34, 56);
        }

        .sidebar a {
            color: #ffffff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .main {
            flex-grow: 1;
            display: flex;
            flex-direction: row;
        }

        .navbar-custom {
            width: 100%;
            height: 70px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: bold;
            color: #333;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 10px;
        }

        .content {
            padding: 20px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('templates/admin_sidebar'); ?>

        <!-- Main content -->
        <div class="main flex-column w-100">
            <!-- Navbar horizontal sejajar dengan sidebar -->
            <?php $this->load->view('templates/admin_navbar'); ?>

            <!-- Dynamic content -->
            <div class="content">
                <?php $this->load->view($page); ?>
            </div>
        </div>
    </div>
</body>

</html>