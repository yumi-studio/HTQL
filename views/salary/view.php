<div class="row">
    <?php include "views/layout/navigator.php"?>
    <div class="col-9" id="content">
        <div class="card" id="mysalary">
            <div class="card-body">
                <div class="card-body border-bottom">
                    <h5 class="card-title">Lương cơ bản</h5>
                    <p class="card-text">$<?=$fixed_salary?></p>
                </div>
                <div class="card-body border-bottom">
                    <h5 class="card-title">Lương thưởng</h5>
                    <p class="card-text">$<?=$bonus*20?></p>
                </div>
                <div class="card-body border-bottom">
                    <h5 class="card-title">Trừ lương</h5>
                    <p class="card-text">$<?=$fines*50?></p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Lương tháng</h5>
                    <p class="card-text">$<?php echo ((int)$fixed_salary+(int)$bonus*20-(int)$fines*50);?></p>
                </div>
            </div>
        </div>
    </div>
</div>