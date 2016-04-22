<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-solid bg-teal-gradient">
            <div class="box-header ui-sortable-handle">
                <h3 class="box-title"><i class="fa fa-fw fa-plus"></i> 新增群組</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" name="simpleGroupCreate" id="simpleGroupCreate">
                <div class="box-body">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id=""
                                       data-bind="value:newGroup.name" placeholder="Group Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="callout callout-info">
                            <h4><i class="icon fa fa-warning"></i> 名稱格式OK！</h4>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-border">
                    <button class="btn btn-info pull-right" data-bind="click:function(){createGroup();}">
                        Add New
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-expeditedssl"></i> 權限 <span
                        data-bind="text:showNowSelectedGroup()"></span></h3>

                <div class="box-tools pull-right">
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <span data-bind="visible:!showNowSelectedGroup()">Select a group...</span>

                <ul class="list-group list-group-unbordered" data-bind="visible:showNowSelectedGroup()">
                    <li class="list-group-item">
                        <select class="form-control" id="permissionList" multiple
                                data-bind="options: nowSelectedGroupPermission.permissions, selectedOptions: nowSelectedGroupPermission.selectPermissions, optionsText:'codename', optionsValue:'codename'">
                        </select>
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block"
                   data-bind="visible:showNowSelectedGroup(), click:function(){saveGroup()}"><b>Save</b></a>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-user"></i> 使用者 <span
                        data-bind="text:showNowSelectedGroup()"></span></h3>

                <div class="box-tools pull-right">
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <span data-bind="visible:!showNowSelectedGroup()">Select a group...</span>
                <table class="table" id="groupUsersList">
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
                <h3 class="box-title"><i class="fa fa-fw fa-group"></i> 群組</h3>

                <div class="box-tools pull-right">
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table" id="groupList">
                    <thead>
                    <tr style="border: 0px;">
                        <th class="text-center" style="width: 20%;">NAME</th>
                        <th class="text-center" style="width: 25%;"></th>
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

<?php include "roleUrls.php";?>