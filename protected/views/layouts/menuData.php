<script>
    var MENU_LIST = [
        /* header Dashboard */
        {
            id : "HEADER",
            title : "DASHBOARD",
        },
        {
            title : "Dashboard",
            description : "Dashboard",
            url : "<?php echo Yii::app()->homeUrl;?>",
            icon : "fa fa-dashboard"
        },

        /* header crawler */
        /*{
            id : "HEADER",
            title : "CRAWLER",
        },
        {
            title : "爬蟲任務",
            description : "Dashboard",
            url : "{{ BASE_URL_BACKEND }}" + "/dashboard/",
            icon : "fa fa-fw fa-bug"
        },
        {
            title : "客製程式管理",
            description : "Dashboard",
            url : "{{ SE_URL_BACKEND }}" + "/dashboard/",
            icon : "fa fa-fw fa-bug"
        },*/
        /* header 基本設定 */
        {
            id : "HEADER",
            title : "BASIC SETTING",
        },
        {
            id : "1",
            title : "帳號管理",
            description : "test",
            url : "#",
            icon : "fa fa-fw fa-legal",
            subMenus : [
                {
                    id : "1-1",
                    title : "使用者",
                    description : "User Management",
                    url : "<?php echo Yii::app()->createUrl('account/index');?>",
                    icon : "fa fa-fw fa-user"
                },
                {
                    id : "1-2",
                    title : "權限",
                    description : "Permission Management",
                    url : "{{ BASE_URL_BACKEND }}" + "/account/permission/",
                    icon : "fa fa-fw fa-expeditedssl"
                },
                {
                    id : "1-3",
                    title : "群組",
                    description : "Group Management",
                    url : "{{ BASE_URL_BACKEND }}" + "/account/group/",
                    icon : "fa fa-fw fa-group"
                }
            ]
        },
        {
            title : "CHAT",
            url : "{{ BASE_URL_BACKEND }}" + "/account/",
            icon : "glyphicon glyphicon-bullhorn",
            subMenus : [
                {
                    id : "1",
                    title : "sub1",
                    url : "{{ BASE_URL_BACKEND }}" + "/account/",
                    icon : "glyphicon glyphicon-bullhorn"
                },
                {
                    title : "sub2",
                    url : "{{ BASE_URL_BACKEND }}" + "/account/",
                    icon : "glyphicon glyphicon-bullhorn"
                }
            ]
        }
    ];
</script>