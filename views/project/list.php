<div class="row">
    <?php include "views/layout/navigator.php"?>
    <div class="col-sm-9">
        <div id="content">
            <div class="card">
                <div class="card-header">
                    <form class="float-left form-inline">
                        <label for="">Sắp xếp theo:</label>
                        <select name="sortmode" id="" class="form-control ml-3" onchange="sorting()">
                            <option value="-1" hidden>---------------</option>
                            <option value="0" selected >A-Z</option>
                            <option value="1">Z-A</option>
                            <option value="2">Ngày bắt đầu</option>
                            <option value="3">Vị trí</option>
                            <option value="4">Số lượng thành viên tham gia</option>
                        </select>
                        <div class="form-check ml-3">
                            <input type="radio" name="reg[]" id="" class="form-check-input" value="0" onclick="sorting()" checked>
                            <label for="" class="form-check-label">Đã đăng ký</label>
                        </div>  
                        <div class="form-check ml-3">
                            <input type="radio" name="reg[]" id="" class="form-check-input" value="1" onclick="sorting()">
                            <label for="" class="form-check-label">Chưa đăng ký</label>
                        </div>
                    </form>
                    <?php
                    if($_SESSION['status']==0){
                        echo('<button type="button" data-toggle="modal" data-target="#addProjectForm" class="btn btn-dark float-right">Thêm dự án</button> ');
                    }
                    ?>
                </div>
                <div id="projectList">
                </div>
            </div>
        </div>
        <div class='alert alert-danger' id="palert">Chưa đăng ký project.</div>
    </div>
</div>
<div class="modal fade" id="addProjectForm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Biểu mẫu thêm mới dự án</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4">Tên dự án</label>
                    <input type="text" name="txtname" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Địa điểm</label>
                    <input type="text" name="txtloc" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Mô tả dự án</label>
                    <textarea name="txtdesc" id="" rows="10" class="form-control col-sm-7"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="">Thời gian bắt đầu</label>
                        <input type="date" name="start" id="" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="">Thời gian kết thúc</label>
                        <input type="date" name="end" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input type="button" value="Thêm" class="btn btn-success" name="btnadd" onclick="addProject()" data-toggle="modal" data-target="#addProjectForm" >
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="updateProjectForm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Biểu mẫu sửa đổi dự án</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4">Tên dự án</label>
                    <input type="text" name="txtname" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Địa điểm</label>
                    <input type="text" name="txtloc" id="" class="form-control col-sm-7">
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4">Mô tả dự án</label>
                    <textarea name="txtdesc" id="" rows="10" class="form-control col-sm-7"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="">Thời gian bắt đầu</label>
                        <input type="date" name="start" id="" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="">Thời gian kết thúc</label>
                        <input type="date" name="end" id="" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input type="button" value="Lưu" class="btn btn-success" name="btnupdate" data-toggle="modal" data-target="#updateProjectForm" >
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="memberList" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Danh sách thành viên tham gia</h5>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
    </div>


<script>
    $(document).ready(function(){
        // loadProject()
        sorting();
    })

    // Thêm project
    function addProject(){
        $.ajax({
            url: "?controller=project&action=create",
            type: "post",
            dataType: "text",
            data: {
                pname: $('#addProjectForm [name=txtname]').val(),
                ploc: $('#addProjectForm [name=txtloc]').val(),
                pdesc: $('#addProjectForm [name=txtdesc]').val(),
                pstart: $('#addProjectForm [name=start]').val(),
                pend: $('#addProjectForm [name=end]').val(),
                mode: 1
            },
            success: function(result){
                console.log(result);
                sorting();
            }
        })
    }

    // Cập nhật thông tin project
    function updateProject(x){
        $.ajax({
            url: "?controller=project&action=update",
            type: "post",
            dataType: "text",
            data:{
                pid: x,
                pname: $('#updateProjectForm [name=txtname]').val(),
                ploc: $('#updateProjectForm [name=txtloc]').val(),
                pdesc: $('#updateProjectForm [name=txtdesc]').val(),
                pstart: $('#updateProjectForm [name=start]').val(),
                pend: $('#updateProjectForm [name=end]').val(),
                mode: 2
            },
            success: function(result){
                console.log(result);
                sorting();
            }
        })
    }

    // Xóa project
    function deleteProject(x){
        $.ajax({
            url: "?controller=project&action=delete",
            type: "post",
            dataType: "text",
            data: {
                id: x
            },
            success: function(result){
                console.log(result);
                sorting();
            }
        })
    }

    // Lấy dữ liệu project
    function takeProjectData(x){
        $.ajax({
            url: "?controller=project&action=getproject",
            type:"post",
            dataType: "json",
            data: {
                id: x
            },
            success: function(result){
                var start = result.start.split(" ")[0];
                var end = result.finish.split(" ")[0];
                $('#updateProjectForm [name=txtname]').val(result.name);
                $('#updateProjectForm [name=txtloc]').val(result.location);
                $('#updateProjectForm [name=txtdesc]').val(result.description);
                $('#updateProjectForm [name=start]').val(start);
                $('#updateProjectForm [name=end]').val(end);
                $('#updateProjectForm [name=btnupdate]').attr('onclick',`updateProject(${result.id})`)
            }
        })
    }

    // Hiển thị danh sách thành viên của dự án
    function showMember(x){
        $.ajax({
            url: "?controller=project&action=member",
            type: "post",
            dataType: "json",
            data: {id: x},
            success: function(result){
                var list = "";
                result.forEach(function (item) {
                    list += `<p>${item.username}</p>`
                })
                $('#memberList .modal-body').html(list);
            }
        })
    }

    // Sắp xếp project
    function sorting(){
        var mode= $('[name=sortmode]').val();
        var reg = $('[name="reg[]"]:checked').val();

        if(reg==undefined || mode==-1){
            return;
        }
        
        if(mode!=-1){
            $.ajax({
                url: "?controller=project&action=sort",
                type: "post",
                dataType: "json",
                data: {
                    mode: mode,
                    reg: reg
                },
                success: function(result){
                    function isRegister(x,y){
                        let res = false
                        y.forEach(function(value){
                            if(x==value.project_id){
                                res = true;
                                return
                            }
                        })
                        return res;
                    }
                    $('#projectList').html('');

                    let project = result['project'];
                    let registed = result['registed'];
                    let admin = result['admin'];
                    if(registed.length==0 & reg==0){
                        $("#palert").css('display','block');
                    }else{
                        $("#palert").css('display','none');
                        project.forEach(function(row){
                            let temp = `
                            <div class="card-body border-bottom">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h5 class="card-title">Tên dự án</h5>
                                    <p class="card-text">${row.name}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="card-title">Địa điểm</h5>
                                    <p class="card-text">${row.location}</p>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="card-title">Thời gian dự kiện</h5>
                                    <p class="card-text">from ${row.start.split(" ")[0]} to ${row.finish.split(" ")[0]}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="card-title">Mô tả</h5>
                                    <p class="card-text">${row.description}</p>
                                </div>
                                <div class="col-sm-12" style="padding-top:20px">
                                    ${isRegister(row.id,registed)?`<a href="?controller=project&action=register&id=${row.id}&regis=false"><button class="btn btn-warning">Hủy đăng ký</button></a>`:`<a href="?controller=project&action=register&id=${row.id}&regis=true"><button class="btn btn-success">Đăng ký</button></a>`}
                                    <button class="btn btn-info" onclick="showMember(${row.id})" data-toggle="modal" data-target="#memberList">Thành viên tham gia</button>
                                    ${admin==true?`<button class="btn btn-dark" onclick="takeProjectData(${row.id})" data-toggle="modal" data-target="#updateProjectForm">Sửa thông tin</button>
                                        <button class="btn btn-danger" onclick="deleteProject(${row.id})">Hủy dự án</button>`:``}
                                </div>
                            </div></div>`;
                            $("#projectList").append(temp);
                        }) 
                    }
                    
                }
            })
        }
    }
    </script>