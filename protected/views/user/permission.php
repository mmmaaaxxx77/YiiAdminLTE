<div class="row">
    <div class="col-md-4">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-user"></i> 使用者 <span data-bind="text:showNowSelectedPermission()"></span></h3>

                <div class="box-tools pull-right">
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <span data-bind="visible:!showNowSelectedPermission()">Select a permission...</span>
                <table class="table" id="permissionUsersList">
                    <thead>
                    <tr style="border: 0px;">
                        <th class="text-center" style="width: 20%;">USERNAME</th>
                        <th class="text-center" style="width: 25%;"></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-expeditedssl"></i> 權限</h3>

                <div class="box-tools pull-right">
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table" id="permissionList">
                    <thead>
                    <tr style="border: 0px;">
                        <th class="text-center" style="width: 20%;">CODENAME</th>
                        <th class="text-center" style="width: 25%;">NAME</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
        </div>
    </div>
</div>
<br/>

<?php include "permissionUrls.php";?>