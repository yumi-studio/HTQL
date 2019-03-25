<div class="col-3 bg-dark rounded">
    <ul class="nav flex-column navbar-dark nav-pills nav-fill" style="padding:5px" id="navigator2">
        <li class="nav-item"><a href="?controller=home&action=profile" class="nav-link text-light">Thông tin cá nhân</a></li>
        <li class="nav-item"><a href="?controller=project&action=list" class="nav-link text-light">Danh sách dự án</a></li>
        <?php
        if($_SESSION['status']!=0){
        ?>
            <li class="nav-item"><a href="?controller=salary&action=view" class="nav-link text-light">Thông tin lương</a></li>
        <?php
        }
        if($_SESSION['status']==0 || $_SESSION['status']==1){
            ?>
            <li class="nav-item"><a href="?controller=salary&action=list" class="nav-link text-light">Bảng chấm công</a></li>
            <li class="nav-item"><a href="?controller=home&action=employee" class="nav-link text-light">Quản lý nhân viên</a></li>
            <?php
        }
        ?>
        <li class="nav-item"><a href="?controller=home&action=logout" class="nav-link text-light">Đăng xuất</a></li>
    </ul>
    <script>
    $(document).ready(function(){
        $('.nav-item a[href="?'+location.href.split('?')[1]+'"]').addClass("active");
    })
    </script>
</div>