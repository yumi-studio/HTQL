<div class="row">
    <?php include 'views/layout/navigator.php';?>
    <div class="col-sm-9" id="content">
        <div class="card" id="salarylist">
            <div class="card-header">
                <button id="btnsave" class="btn btn-dark" disabled>Lưu thay đổi</button>
                <button class="btn btn-light float-right" disabled>CT Tính lương = Cơ bản + (điểm thưởng)*1000 - (điểm trừ)*500</button>
            </div>
            
            <div class="card-body">
            <table class="table table-bordered table-striped" style="table-layout: fixed">
                <thead>
                    <tr><th>Họ và tên</th><th>Cơ bản</th><th>Điểm thưởng</th><th>Điểm trừ</th><th>Tổng cộng</th></tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($salaries as $key => $value) {
                        # code...

                        //CT Tính lương
                        $total = $value['fixed_salary']+$value['bonus']*1000-$value['fines']*500;
                    ?>
                        <tr id="<?php echo $value['sid']?>">
                            <td><?php echo $value['name']?></td>
                            <td id="fs"><?php echo $value['fixed_salary']?></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend"><input class="btn" type="button" value="-" name="-" onclick="decrease(this)"></div>
                                    <input class="form-control" type="text" name="bonus" id="" value="<?php echo $value['bonus']?>">
                                    <div class="input-group-append"><input class="btn" type="button" value="+" name="+" onclick="increase(this)"></div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend"><input class="btn" type="button" value="-" onclick="decrease(this)"></div>
                                    <input class="form-control" type="text" name="fines" id="" value="<?php echo $value['fines']?>">
                                    <div class="input-group-append"><input class="btn" type="button" value="+" onclick="increase(this)"></div>
                                </div>
                            </td>
                            <td><?php echo $total?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<script>
    var mode;
    $(document).ready(()=>{
        mode = $('.card').prop('id');
        // $.ajax({
        //     url: "control/salarydata.php",
        //     type: "post",
        //     dataType: "text",
        //     data: {
        //         mode: mode
        //     },
        //     success: function(result){
        //         $('.card-body').html(result);
        //     }
        // })
        $('#btnsave').click(function(){
            var list = $('tbody tr').toArray();
            list.forEach(pt => {
                $.ajax({
                    url: "?controller=salary&action=update",
                    type: "post",
                    dataType: "text",
                    data: {
                        id: $(pt).prop('id'),
                        bonus: $(pt).find('[name=bonus]').val(),
                        fines: $(pt).find('[name=fines]').val()
                    },
                    success: function(result){
                        console.log(result)
                    }
                })
            });
            $('#btnsave').prop('disabled',true)
            alert("Đã cập nhật!")
        })
    })

    function increase(x){
        var input = $(x).parent().siblings()[1];
        $(input).val(function(){
            return parseInt($(this).val())+1
        })
        updateSalary($(x).parents()[3]);
    }
    function decrease(x){
        var input = $(x).parent().siblings()[0];
        $(input).val(function(){
            return $(this).val()==0?0:parseInt($(this).val())-1;
        })
        updateSalary($(x).parents()[3]);
    }
    function updateSalary(x){
        var fixed = $(x).children('#fs').html();
        var bonus = $(x).find('input[name=bonus]').val();
        var fines = $(x).find('input[name=fines]').val();

        // CT tính lương
        var total = parseInt(fixed)+parseInt(bonus)*1000-parseInt(fines)*500;
        $(x).children(':last-child').html(total);
        $('#btnsave').prop("disabled",false)
    }
    
</script>