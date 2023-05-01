<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <a class="navbar-brand ps-3" href="index.php">富邦人壽後台管理</a>

    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="index.php">首頁</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="user-list.php">員工帳號清單</a>
                </li>

                <?php if(!isset($_SESSION['verified_user_id'])) : ?>
                <li class="nav-item">
                <a class="nav-link" href="register.php">註冊</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php">登入</a>
                </li>
                <?php else : ?>
                <li class="nav-item">
                <a class="nav-link" href="logout.php">登出</a>
                </li>  
                <?php endif; ?>
        </div>
    </div>
</nav>