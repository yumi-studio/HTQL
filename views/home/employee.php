<div class="row">
    <?php include "views/layout/navigator.php"?>
    <div class="col-sm-9" id="content">
        <div class="card">
            <div class="card-header">
                <form class="inline-form float-left" onsubmit="return false">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Tìm kiếm</div>
                    </div>
                    <div class="dropdown">
                        <input type="text" name="txtsearch" id="searchbox" class="form-control" onkeyup="search(this)" autocomplete="off">
                        <div class="dropdown-menu">
                        </div>
                    </div>
                    
                </div>
                </form>
                <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-dark float-right">Thêm nhân viên</button>
            </div>
            <div class="card-body">
                <table class="table bordered table-striped">
                    <thead class="">
                        <tr>
                            <th class="w-25">Họ và tên</th>
                            <th class="w-25">Chi nhánh</th>
                            <th class="w-25">Vị trí</th>
                            <th class="w-25"></th>
                        </tr>
                    </thead>
                    <tbody id="accountList">

                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<!-- ADD FORM -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">Thêm nhân viên mới</div>
        <form>
            <div class="modal-body">
                <div class="form-group row">
                        <label for="" class="col-sm-4">Tên đăng nhập</label>
                        <input type="text" name="txtuser" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Mật khẩu</label>
                        <input type="text" name="txtpass" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Họ và tên</label>
                        <input type="text" name="txtname" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Địa chỉ</label>
                        <input type="text" name="txtaddr" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Email</label>
                        <input type="text" name="txtemail" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Số điện thoại</label>
                        <input type="text" name="txtphone" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Chi nhánh</label>
                    <select name="txtbranch" id="" class="form-control col-sm-7" <?php if($_SESSION['status']!=0) echo("disabled")?>>
                        <?php
                        if($_SESSION['status']==0){
                            ?>
                            <option value="1">Miền Bắc</option>
                            <option value="2">Miền Trung</option>
                            <option value="3">Miền Nam</option>
                            <?php
                        }else{
                            switch($_SESSION['branch_id']){
                                case "1":
                                    echo '<option value="1">Miền Bắc</option>';
                                    break;
                                case "2":
                                    echo '<option value="2">Miền Trung</option>';
                                    break;
                                case "3":
                                    echo '<option value="3">Miền Nam</option>';
                                    break;
                            }
                        }
                        ?>
                        
                        
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Chức vụ</label>
                    <select name="txtrole" id="" class="form-control col-sm-7">
                    <?php if($_SESSION['status']==0) echo '<option value="1">Giám đốc</option>';?>
                        <option value="2">Nhân viên</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input type="button" value="Thêm" class="btn btn-success" name="btnadd" onclick="addAccount()" data-toggle="modal" data-target="#addModal" >
            </div>
        </form>
        </div>
    </div>
</div>

<!-- UPDATE FORM -->
<div class="modal fade" tabindex="-1" role="dialog" id="updateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form>
            <div class="modal-header">Sửa thông tin</div>
            <div class="modal-body">
                <div class="form-group row">
                        <label for="" class="col-sm-4">Tên đăng nhập</label>
                        <input type="text" name="txtuser" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Mật khẩu</label>
                        <input type="text" name="txtpass" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Họ và tên</label>
                        <input type="text" name="txtname" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Địa chỉ</label>
                        <input type="text" name="txtaddr" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Email</label>
                        <input type="text" name="txtemail" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                        <label for="" class="col-sm-4">Số điện thoại</label>
                        <input type="text" name="txtphone" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Chi nhánh</label>
                    <select name="txtbranch" id="" class="form-control col-sm-7" <?php if($_SESSION['status']!=0) echo("disabled")?>>
                        <option value="1">Miền Bắc</option>
                        <option value="2">Miền Trung</option>
                        <option value="3">Miền Nam</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Chức vụ</label>
                    <select name="txtrole" id="" class="form-control col-sm-7">
                        <?php if($_SESSION['status']==0) echo '<option value="1">Giám đốc</option>';?>
                        <option value="2">Nhân viên</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input type="button" value="Lưu" class="btn btn-success" onclick name="btnupdate" data-toggle="modal" data-target="#updateModal">
            </div>
        </form>
        </div>
    </div>
</div>
<script>
// Tải lại danh sách nhân viên
function loadEmployee() {
    $.ajax({
        type: "post",
        url: "?controller=account&action=getall",
        data: {},
        dataType: "json",
        success: function (response) {
            console.log(response);
            
            $('#accountList').html('');
            response.forEach(account => {
                let temp = `<tr>
                    <td class="align-middle">${account.name}</td>
                    <td class="align-middle">${account.branch_id==1?"Miền Bắc":account.branch_id==2?"Miền Trung":"Miền Nam"}</td>
                    <td class="align-middle">${account.position}</td>
                    <td class="btn-group text-light">
                        <a href="?controller=account&action=view&id=${account.id}" class="btn btn-info">Chi tiết</a>
                        <a type="" data-toggle="modal" data-target="#updateModal" class="btn btn-warning" onclick="setEdit(${account.id})">Sửa</a>
                        <a onclick="deleteAccount(${account.id})" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>`
                $('#accountList').append(temp);
            });
        }
    });
}

// Lấy dữ liệu từ database điền vào form
function setEdit(x){
    $.ajax({
        url: "?controller=account&action=getdata",
        type: "post",
        dataType: "json",
        data: {
            id: x
        },
        success: function(result){
            console.log(result);
            
            $('#updateModal [name=txtuser]').val(result.username);
            $('#updateModal [name=txtpass]').val(result.password);
            $('#updateModal [name=txtname]').val(result.name);
            $('#updateModal [name=txtaddr]').val(result.address);
            $('#updateModal [name=txtemail]').val(result.email);
            $('#updateModal [name=txtphone]').val(result.phone);
            $('#updateModal [name=txtbranch]').val(result.branch_id);
            $('#updateModal [name=txtrole]').val(result.status);
            $('#updateModal [name=btnupdate]').attr('onclick',`updateAccount(${result.id})`)
        }
    })
    // $("[name='txtname']").val(xhttp.responseText);
}

// Xóa tài khoản
function deleteAccount(x){
    $.ajax({
        type: "post",
        url: "?controller=account&action=delete",
        data: {
            id: x
        },
        dataType: "text",
        success: function (response) {
            loadEmployee();
        }
    });
}

// Thêm tài khoản vào database
function addAccount(){
    $.ajax({
        url:"?controller=account&action=create",
        type:"post",
        dataType:"text",
        data:{
            username:    $('#addModal [name=txtuser]').val(),
            password:    $('#addModal [name=txtpass]').val(),
            name:    $('#addModal [name=txtname]').val(),
            address:    $('#addModal [name=txtaddr]').val(),
            email:   $('#addModal [name=txtemail]').val(),
            phone:   $('#addModal [name=txtphone]').val(),
            branch:    $('#addModal [name=txtbranch]').val(),
            role:    $('#addModal [name=txtrole]').val(),
            btnadd:     "1"
        },
        success: function(data){
            loadEmployee();
        }
    })
}
function updateAccount(x){
    $.ajax({
        url:"?controller=account&action=update",
        type:"post",
        dataType:"text",
        data:{
            id:         x,
            username:    $('#updateModal [name=txtuser]').val(),
            password:    $('#updateModal [name=txtpass]').val(),
            name:    $('#updateModal [name=txtname]').val(),
            address:    $('#updateModal [name=txtaddr]').val(),
            email:   $('#updateModal [name=txtemail]').val(),
            phone:   $('#updateModal [name=txtphone]').val(),
            branch:   $('#updateModal [name=txtbranch]').val(),
            role:   $('#updateModal [name=txtrole]').val(),
            btnupdate:  "2"
        },
        success: function(data){
            loadEmployee();
        }
    })
}

function search(x){
    var q = $(x).val();
    $.ajax({
        url: "?controller=account&action=search",
        type: "post",
        dataType: "json",
        data:{
            q: q
        },
        success: function(response){
            var result = "";
            if(response.length==0){
                result = "<i>Không tìm thấy nhân viên phù hợp</i>";
            }else{
                $('.dropdown-menu').html('');
                response.forEach(account => {
                    $('.dropdown-menu').append(`<a href='?controller=account&action=view&id=${account.id}' class='dropdown-item'>${account.name}</a>`);
                });
                $('.dropdown-menu').addClass('d-block')
            }
        }
    })
}

$(document).ready(()=>{
    loadEmployee();
    $('#searchbox').focusout(function(){
        $('body').click(function(){
            $('.dropdown-menu').removeClass('d-block')
        })
    })
})
</script>