/* ViewModel */
var pageViewModel = null;
function PageViewModel(nowPage) {
    var viewModel = this;
    this._dummyObservable = ko.observable();
    this.nowPage = ko.observable(nowPage);
    this.newUser = {
        name: ko.observable(null),
        email: ko.observable(null),
        password: ko.observable(null),
        repassword: ko.observable(null)
    }
    this.userProfile = {
        name: ko.observable(null),
        email: ko.observable(null),
        profile_image: ko.observable(null)
        //groups: ko.observableArray([]),
        //selectGroups: [],
        //permissions: ko.observableArray([]),
        //selectPermissions: []
    }
    this.editUserProfile = {
        id: null,
        name: ko.observable(null),
        email: ko.observable(null),
        profile_image: ko.observable(null),
        groups: ko.observableArray([]),
        selectGroups: [],
        permissions: ko.observableArray([]),
        selectPermissions: []
    }
    this.editprofileImage = ko.pureComputed(function () {
        pageViewModel._dummyObservable();
        return _BASE_URL + this.editUserProfile.profile_image();
    }, this);
    this.profileImage = ko.pureComputed(function () {
        pageViewModel._dummyObservable();
        return _BASE_URL + this.userProfile.profile_image();
    }, this);

}

function bindingHandlers() {
}

/* Accounts */
$(function () {
    pageViewModel = new PageViewModel("帳號管理%>使用者");
    bindingHandlers();
    ko.applyBindings(getMainViewModel());
    ko.applyBindings(pageViewModel, document.getElementById("_subPage"));
    getUsers();
    //getWhoAmI();
    getGroups();
    getPermissions();

    $("#groupList").select2(
        {
            placeholder: "請選擇群組",
            allowClear: true,
            width: '100%'
        }
    );
    $("#permissionList").select2(
        {
            placeholder: "請選擇權限",
            allowClear: true,
            width: '100%'
        }
    );

    $("#editGroupList").select2(
        {
            placeholder: "請選擇群組",
            allowClear: true,
            width: '100%'
        }
    );
    $("#editPermissionList").select2(
        {
            placeholder: "請選擇權限",
            allowClear: true,
            width: '100%'
        }
    );
});

var datatable = null;
function getUsers() {
    var pageSize = 10;
    var ajaxFun = function (sSource, aoData, fnCallback) {
        var url = _URLS['getUsers']

        var startO = null;
        var lengthO = null;
        var drawO = null;
        aoData.forEach(function (item) {
            if (item.name == "start") {
                startO = item;
            }
            if (item.name == "length") {
                lengthO = item;
            }
            if (item.name == "draw") {
                drawO = item;
            }
        });

        var page = Math.floor(startO.value / lengthO.value);
        page++;

        $.ajax({
            type: 'GET',
            url: url + "&page=" + page + "&size=" + pageSize,
            contentType: 'application/json',
            success: function (result) {
                if (result.success) {
                    var modelresult = [];
                    for (var i = 0; i < result.result.length; i++) {
                        modelresult.push(new User(result.result[i]));
                    }
                    var dat = {
                        draw: drawO.value,
                        data: modelresult,
                        recordsTotal: result.totalPages*pageSize,
                        recordsFiltered: result.totalPages*pageSize
                    }
                    fnCallback(dat);
                } else {
                    alert("取得列表失敗。");
                    var dat = {
                        draw: drawO.value,
                        data: [],
                        recordsTotal: 0,
                        recordsFiltered: 0
                    }
                    fnCallback(dat);
                }
            },
            error: function (result) {
                alert("取得列表失敗。");
                var dat = {
                    draw: drawO.value,
                    data: [],
                    recordsTotal: 0,
                    recordsFiltered: 0
                }
                fnCallback(dat);
            }
        });
    }

    datatable = $('#userList').DataTable(
        {
            "bProcessing": true,
            "pageLength": pageSize,
            "bServerSide": true,
            "bFilter": false,
            "bLengthChange": false,
            "columnDefs": [
                {
                    "targets": 0,
                    "searchable": false,
                    "orderable": false,
                    "title": "狀態",
                    "data": "online",
                    "render": function (data, type, full, meta) {
                        if(data == "1" || data == true || data == 1)
                            return "<i class='fa fa-circle text-success'></i>  online";
                        return "<i class='fa fa-circle text-red'></i>  offline";

                    },
                    "width": "15%",
                    "className": "text-center"
                },
                {
                    "targets": 1,
                    "searchable": false,
                    "orderable": false,
                    "title": "使用者名稱",
                    "data": "name",
                    "render": function (data, type, full, meta) {
                        return data;
                    },
                    "width": "15%",
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "searchable": false,
                    "orderable": false,
                    "title": "EMAIL",
                    "data": "email",
                    "render": function (data, type, full, meta) {
                        return data;
                    },
                    "width": "30%",
                    "className": "text-center"
                },
                {
                    "targets": 3,
                    "searchable": false,
                    "orderable": false,
                    "title": "最後登入",
                    "data": "last_login",
                    "render": function (data, type, full, meta) {
                        return data != null ? moment(data).format('YYYY-MM-DD HH:mm:ss') : "";
                    },
                    "width": "15%",
                    "className": "text-center"
                },
                {
                    "targets": 4,
                    "searchable": false,
                    "orderable": false,
                    "title": "建立日期",
                    "data": "create_date",
                    "render": function (data, type, full, meta) {
                        return data != null ? moment(data).format('YYYY-MM-DD') : "";
                    },
                    "width": "15%",
                    "className": "text-center"
                },
                {
                    "targets": 5,
                    "searchable": false,
                    "orderable": false,
                    "title": "",
                    "data": "id",
                    "render": function (data, type, full, meta) {
                        var html = "";
                        html += '<button type="button" class="btn btn-xs btn-default deleteBtn" onClick="showEditWhoAmI(\'' + data + '\')"><i class="fa fa-fw fa-pencil"></i></button>'
                        html += '<button type="button" class="btn btn-xs btn-danger deleteBtn" onClick="deleteUser(\'' + data + '\')"><i class="fa fa-fw fa-remove"></i></button>'
                        return html;
                    },
                    "width": "20%",
                    "className": "text-center"
                }

            ],
            "fnServerData": ajaxFun
        });
    $('#userList tbody').on('mouseover', 'tr', function () {
        var data = datatable.row(this).data();
        //getWhoAmI(data.username);
    });

    $('#userList tbody').on( 'click', 'tr', function () {

            var data = datatable.row(this).data();

    } );
}

function deleteUser(id) {
    var fun = function () {
        $.ajax({
            url: _URLS['deleteUser'],
            type: 'POST',
            data: {'id': id},
            success: function (result) {
                displayMessageDialog("刪除成功");
                datatable.ajax.reload();
            }
        });
    }
    displayConfirmDialog("確認刪除？", fun);
}

function bindSimpleUserCreate() {

    var formData = new FormData();
    formData.append('name', pageViewModel.newUser.name());
    var password = CryptoJS.MD5(pageViewModel.newUser.password());
    formData.append('password', password);
    formData.append('email', pageViewModel.newUser.email());
    if ($("#profile_image")[0].files.length != 0)
        formData.append('file', $("#profile_image")[0].files[0]);

    var fun = function () {
        $.ajax({
            url: _URLS["newUser"],
            type: 'POST',
            data: formData,
            //async: false,
            success: function (data) {
                if (data.success) {
                    clearSimpleUserCreate();
                    datatable.ajax.reload();
                } else {

                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    displayConfirmDialog("確認新增？", fun);
}

function clearSimpleUserCreate() {
    pageViewModel.newUser.name(null);
    pageViewModel.newUser.email(null);
    pageViewModel.newUser.password(null);
    pageViewModel.newUser.repassword(null);
    $("#profile_image").val(null)
}

function getWhoAmI(id) {
    var url = _URLS['user'];
    if (id != null) {
        url = _URLS['user']+ "&id=" + id;
    }

    $.ajax({
        type: 'GET',
        url: url,
        contentType: 'application/json',
        success: function (result) {
            pageViewModel.userProfile.name(result.result.name);
            pageViewModel.userProfile.email(result.result.email);
            if(result.result.image != null)
                pageViewModel.userProfile.profile_image(result.result.image.path);
            else
                pageViewModel.userProfile.profile_image("/images/anonymous.png");

            /*groups = [];
            result.user.groups.forEach(function(item){
                groups[groups.length] = item.name;
            });
            pageViewModel.userProfile.selectGroups = groups;
            $("#groupList").select2("val", groups);

            permissions = [];
            result.user.user_permissions.forEach(function(item){
                permissions[permissions.length] = item.codename;
            });
            pageViewModel.userProfile.selectPermissions = permissions;
            $("#permissionList").select2("val", permissions);*/

            pageViewModel._dummyObservable.notifySubscribers();
            //$("#userEditDetailDialog").modal('show');

        },
        error: function (result) {
            alert("取得Profile失敗。");
        }
    });
}

function showWhoAmI(id){
    getWhoAmI(id);
}

function getEditWhoAmI(id) {
    var url = _URLS['user'];
    if (id != null) {
        url = _URLS['user']+ "&id=" + id;
    }

    $.ajax({
        type: 'GET',
        url: url,
        contentType: 'application/json',
        success: function (result) {
            $("#userEditDetailDialog").modal('show');

            pageViewModel.editUserProfile.id = result.result.id;
            pageViewModel.editUserProfile.name(result.result.name);
            pageViewModel.editUserProfile.email(result.result.email);
            if(result.result.image != null)
                pageViewModel.editUserProfile.profile_image(result.result.image.path);
            else
                pageViewModel.editUserProfile.profile_image("/images/anonymous.png");

            var groups = [];
            result.result.roles.forEach(function(item){
                groups[groups.length] = item.id;
            });
            $("#editGroupList").val(groups).trigger("change");

            var permissions = [];
            result.result.permissions.forEach(function(item){
                permissions[permissions.length] = item.id;
            });
            $("#editPermissionList").val(permissions).trigger("change");

            pageViewModel._dummyObservable.notifySubscribers();
            //$("#userEditDetailDialog").modal('show');

        },
        error: function (result) {
            alert("取得Profile失敗。");
        }
    });
}

function showEditWhoAmI(id){
    //getGroups();
    //getPermissions();
    getEditWhoAmI(id);
}

function getGroups() {
    $.ajax({
        type: 'GET',
        url: _URLS['getAllRoles'],
        contentType: 'application/json',
        success: function (result) {
            pageViewModel.editUserProfile.groups(result.result);
        },
        error: function (result) {
            alert("取得Group失敗。");
        }
    });
}

function getPermissions() {
    $.ajax({
        type: 'GET',
        url: _URLS['getAllPermissions'],
        contentType: 'application/json',
        success: function (result) {
            pageViewModel.editUserProfile.permissions(result.result);
        },
        error: function (result) {
            alert("取得Permission失敗。");
        }
    });
}

function saveUser(){

    var formData = new FormData();
    pageViewModel.editUserProfile.selectGroups.forEach(function(item){
        formData.append('roles[]', item);
    });
    //formData.append('roles', pageViewModel.editUserProfile.selectGroups);
    pageViewModel.editUserProfile.selectPermissions.forEach(function(item){
        formData.append('permissions[]', item);
    });
    //formData.append('permissions', pageViewModel.editUserProfile.selectPermissions);
    formData.append('id', pageViewModel.editUserProfile.id);
    formData.append('name', pageViewModel.editUserProfile.name());
    formData.append('email', pageViewModel.editUserProfile.email());
    if ($("#edit_profile_image")[0].files.length != 0)
        formData.append('file', $("#edit_profile_image")[0].files[0]);

    var fun = function () {
        $.ajax({
            url: _URLS['updateUser'],
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data.success) {
                    datatable.ajax.reload();
                    displayMessageDialog("修改成功");
                } else {
                    displayMessageDialog("修改失敗");
                }
                clearEditUser();
                $("#userEditDetailDialog").modal('hide');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    displayConfirmDialog("確認修改？", fun);
}

function clearEditUser() {
    pageViewModel.editUserProfile.name(null);
    pageViewModel.editUserProfile.email(null);
    $("#edit_profile_image").val(null)
}

function addUser() {
    $.ajax({
        url: _URLS["newUser"],
        type: 'POST',
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify({name: "test33", password: "test22", email: "123@123.com"}),
        success: function (result) {
            alert(result.result.name);
        }
    });
}