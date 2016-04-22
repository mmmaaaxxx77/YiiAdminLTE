<script>
    _URLS = {
        "getUsers" : "<?php echo Yii::app()->createUrl('account/users');?>",
        "newUser" : "<?php echo Yii::app()->createUrl('account/newUser');?>",
        "deleteUser" : "<?php echo Yii::app()->createUrl('account/deleteUser');?>",
        "user" : "<?php echo Yii::app()->createUrl('account/user');?>",
        "updateUser" : "<?php echo Yii::app()->createUrl('account/updateUser');?>",
        "getAllPermissions" : "<?php echo Yii::app()->createUrl('permission/allPermissions');?>",
        "getAllRoles" : "<?php echo Yii::app()->createUrl('role/allRoles');?>"
    }
    _BASE_URL = "<?= Yii::app()->request->baseUrl; ?>";
</script>