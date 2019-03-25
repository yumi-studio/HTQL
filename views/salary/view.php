<div class="row">
    <?php include "views/layout/navigator.php"?>
    <div class="col-9" id="content">
        <div class="card" id="mysalary">
            <div class="card-header">
                <button id="btnsave" class="btn btn-dark" disabled>Lưu thay đổi</button>
                <button class="btn btn-light float-right" disabled>CT Tính lương = Cơ bản + (điểm thưởng)*1000 - (điểm trừ)*500</button>
            </div>
            
            <div class="card-body">
                <div class="card-body border-bottom">
                    <h5 class="card-title">Lương cơ bản</h5>
                    <p class="card-text"><?=$fixed_salary?> VND</p>
                </div>
                <div class="card-body border-bottom">
                    <h5 class="card-title">Điểm thưởng</h5>
                    <p class="card-text"><?=$bonus?></p>
                </div>
                <div class="card-body border-bottom">
                    <h5 class="card-title">Số lỗi phạt</h5>
                    <p class="card-text"><?=$fines?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Tổng lương</h5>
                    <p class="card-text"><?php echo ((int)$fixed_salary+(int)$bonus-(int)$fines*1234);?> VND</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    var mode;
    $(document).ready(()=>{
        mode = $('.card').prop('id');
        $.ajax({
            url: "control/salarydata.php",
            type: "post",
            dataType: "text",
            data: {
                mode: mode
            },
            success: function(result){
                $('.card-body').html(result);
            }
        })
        $('#btnsave').click(function(){
            var list = $('tbody tr').toArray();
            list.forEach(pt => {
                $.ajax({
                    url: "control/updatesalary.php",
                    type: "post",
                    datatype: "text",
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
            return parseInt($(this).val())-1
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
</script> -->