<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-solid bg-teal-gradient">
            <div class="box-header ui-sortable-handle">
                <h3 class="box-title"><i class="fa fa-fw fa-plus"></i> 新增使用者</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" name="simpleUserCreate" id="simpleUserCreate">
                <div class="box-body">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Account</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id=""
                                       data-bind="value:newUser.name" placeholder="Account">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id=""
                                       data-bind="value:newUser.email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" password="password" id=""
                                       data-bind="value:newUser.password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Re Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" password="repassword" id=""
                                       data-bind="value:newUser.repassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Image input</label>

                            <div class="col-sm-10">
                                <input type="file" name="profile_image" id="profile_image">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="callout callout-info">
                            <h4><i class="icon fa fa-warning"></i> 帳號格式OK！</h4>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-border">
                    <button class="btn btn-info pull-right" data-bind="click:function(){bindSimpleUserCreate();}">
                        Add New
                    </button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-user"></i> 使用者</h3>

                <div class="box-tools pull-right">
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table" id="userList">
                    <thead>
                    <tr style="border: 0px;">
                        <th class="text-center" style="width: 20%;">ONLINE</th>
                        <th class="text-center" style="width: 20%;">USERNAME</th>
                        <th class="text-center" style="width: 25%;">EMAIL</th>
                        <th class="text-center" style="width: 15%;">LAST LOGIN</th>
                        <th class="text-center" style="width: 15%;">DATE JOINED</th>
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

<?php include "accountUrls.php"; ?>

<div class="modal fade" id="userDetailDialog" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">使用者資訊</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                 src=""
                                 data-bind="attr:{src:profileImage}" alt="User profile picture">

                            <h3 class="profile-username text-center" data-bind="text:userProfile.username">Johnny
                                Tsai</h3>

                            <p class="text-muted text-center"><span data-bind="text:userProfile.name"></span> (<span
                                    data-bind="text:userProfile.email">root@root.root</span>) </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <label>群組</label>
                                    <select class="form-control" id="groupList2" multiple
                                            data-bind="options: userProfile.groups, selectedOptions: userProfile.selectGroups, optionsText:'name', optionsValue:'name'">
                                    </select>
                                </li>
                                <li class="list-group-item">
                                    <label>權限</label>
                                    <select class="form-control" id="permissionList2" multiple
                                            data-bind="options: userProfile.permissions, selectedOptions: userProfile.selectPermissions, optionsText:'codename', optionsValue:'codename'">
                                    </select>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block" data-bind="click:function(){saveUser()}"><b>Save</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-primary" onClick="doOkFunction()">儲存</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="userEditDetailDialog" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">使用者資訊</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form class="form-horizontal" name="simpleUserCreate" id="simpleUserCreate">
                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                     src=""
                                     data-bind="attr:{src:editprofileImage}" alt="User profile picture">

                                <h3 class="profile-username text-center" data-bind="text:editUserProfile.username">Johnny
                                    Tsai</h3>

                                <p class="text-muted text-center"><input type="file" name="edit_profile_image" id="edit_profile_image"></p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <label>使用者名稱</label>
                                        <input type="text" class="form-control" name="name" id=""
                                               data-bind="value:editUserProfile.name" placeholder="請輸入姓名">
                                    </li>
                                    <li class="list-group-item">
                                        <label>EMAIL</label>
                                        <input type="text" class="form-control" name="email" id=""
                                               data-bind="value:editUserProfile.email" placeholder="請輸入EMAIL">
                                    </li>
                                    <li class="list-group-item">
                                        <label>群組</label>
                                        <select class="form-control" id="editGroupList" multiple
                                                data-bind="options: editUserProfile.groups, selectedOptions: editUserProfile.selectGroups, optionsText:'name', optionsValue:'id'">
                                        </select>
                                    </li>
                                    <li class="list-group-item">
                                        <label>權限</label>
                                        <select class="form-control" id="editPermissionList" multiple
                                                data-bind="options: editUserProfile.permissions, selectedOptions: editUserProfile.selectPermissions, optionsText:'codename', optionsValue:'id'">
                                        </select>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"
                                   data-bind="click:function(){saveUser()}"><b>儲存</b></a>
                                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">取消</button>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </form>
                    <!-- /.box -->
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

