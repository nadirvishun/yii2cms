<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
您好，<?= $user->username ?>,

请点击链接来重置您的密码：

<?= $resetLink ?>
