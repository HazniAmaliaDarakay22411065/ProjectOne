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
            position: fixed;
            top: 56px;
            /* Tinggi navbar */
            left: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #1e3c72);
            color: white;
            padding-top: 1rem;
            z-index: 1040;
            overflow-y: auto;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 0.75rem 1.25rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar a:hover {
            background-color: #1e3c72;
            transform: translateX(5px);
            color: #000000;
        }

        .sidebar .dropdown-menu {
            background-color: #1e3c72 !important;
            border: none;
            min-width: 150px;
            font-size: 0.9rem;
        }

        .sidebar .dropdown-item {
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .sidebar .dropdown-item:hover {
            background-color: #0d6efd;
            color: #000000;
        }

        .navbar-custom {
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            height: 70px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1050;
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

        .content-wrapper {
            margin-left: 250px;
            padding: 90px 20px 20px 20px;
            /* Top: 70 navbar + 20 spacing */
            width: calc(100% - 250px);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('templates/admin_sidebar'); ?>

        <!-- Main content -->
        <div class="main w-100">
            <!-- Navbar -->
            <?php $this->load->view('templates/admin_navbar'); ?>
            <!-- Alert seharusnya di sini -->

            <!-- Content Area -->
            <div class="content-wrapper">
                <?php $this->load->view($page); ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>