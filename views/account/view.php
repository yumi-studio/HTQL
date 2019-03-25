<div class="row">
    <?php include "views/layout/navigator.php"?>
    <div class="col-5" id="content">
        <div class="card">
            <div class="card-body border-bottom">
                <h5 class="card-title">Họ và tên</h5>
                <p class="card-text"><?=$name?></p>
            </div>
            <div class="card-body border-bottom">
                <h5 class="card-title">Email</h5>
                <p class="card-text"><?=$email?></p>
            </div>
            <div class="card-body border-bottom">
                <h5 class="card-title">Số điện thoại</h5>
                <p class="card-text"><?=$phone?></p>
            </div>
            <div class="card-body border-bottom">
                <h5 class="card-title">Địa chỉ</h5>
                <p class="card-text"><?=$address?></p>
            </div>
            <div class="card-body">
                <h5 class="card-title">Vị trí công tác</h5>
                <p class="card-text"><?=$position?></p>
            </div>
        </div>
    </div>
    <div class="col-3" id="avatar">
        <div class="card">
            <div class="card-body">
                <div id="frame">
                    <img src="image/avatar.png" alt="Đây là avatar">
                </div>
                
            </div>
            <div class="card-body">
                <form action="control/changeAvatar.php" method="post" enctype='multipart/form-data'>
                    <div class="input-group">
                        <input type="file" name="image" id="" class="form-control">
                        <input type="submit" value="Lưu thay đổi" class="btn btn-success w-100">
                    </div>
                </form>
                <script>
                    
                </script>
            </div>
        </div>
    </div>
</div>