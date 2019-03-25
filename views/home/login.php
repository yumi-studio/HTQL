<form action="?controller=home&action=identify" method="POST" id="login-form" class="text-light shadow-lg">
    <h4 class="card-title"><?php echo(isset($_SESSION['lang'])&&$_SESSION['lang']=="en"?"Welcome to TDTECH!":"Chào mừng đến với TDTECH!")?></h4>
    <div class="form-group">
        <label for=""><?php echo(isset($_SESSION['lang'])&&$_SESSION['lang']=="en"?"Username":"Tên đăng nhập")?></label>
        <input type="text" name="txtUsername" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for=""><?php echo(isset($_SESSION['lang'])&&$_SESSION['lang']=="en"?"Password":"Mật khẩu")?></label>
        <input type="password" name="txtPassword" id="" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" value="<?php echo(isset($_SESSION['lang'])&&$_SESSION['lang']=="en"?"Login":"Đăng nhập")?>" class="btn btn-danger" name="btnLogin">
    </div>
    <div class="form-group">
        <select name="lang" id="" onchange="langChange()" class="form-control">
            <?php
            if($_GET['lang']=="en"){
                echo '<option value="0" selected hidden>----------Select Language----------</option>
                <option value="en">English</option>
                <option value="vn">Vietnamese</option>';
            }
            if($_GET['lang']=="vn"){
                echo '<option value="0" selected hidden>----------Chọn ngôn ngữ----------</option>
                <option value="en">Tiếng anh</option>
                <option value="vn">Tiếng việt</option>';
            }
            ?>
            
        </select>
    </div>
</form>
<script>
function langChange(){
    var x = $('[name=lang]').val();
    console.log(x);
    if(x!=0) document.location.href="/htql/index.php?controller=home&action=login&lang="+x;
}
</script>