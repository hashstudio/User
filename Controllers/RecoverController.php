<?php

namespace Modules\User\Controllers;

use Mindy\Base\Mindy;
use Modules\Core\Controllers\FrontendController;
use Modules\User\Forms\ChangePasswordForm;
use Modules\User\Forms\RecoverForm;
use Modules\User\Models\User;
use Modules\User\UserModule;

/**
 * Class RecoverController
 * @package Modules\User
 */
class RecoverController extends FrontendController
{
    public function actionIndex()
    {
        $this->addBreadcrumb(UserModule::t("Recover password"));

        $form = new RecoverForm();
        if ($this->r->isPost) {
            if ($form->populate($_POST)->isValid() && $form->send()) {
                $this->r->flash->success(UserModule::t("Message was sended to your email"));
                echo $this->render('user/recover_form_success.html');
                Mindy::app()->end();
            } else {
                $this->r->flash->error(UserModule::t("An error has occurred. Please try again later."));
            }
        }
        echo $this->render('user/recover_form.html', [
            'form' => $form
        ]);
    }

    public function actionActivate($key)
    {
        $model = User::objects()->filter(['activation_key' => $key])->get();
        if ($model === null) {
            $this->error(404);
        }

        if ($model->activation_key === $key) {
            $form = new ChangePasswordForm([
                'model' => $model
            ]);
            if ($this->r->isPost && $form->populate($_POST)->isValid() && $form->save()) {
                $this->r->flash->success(UserModule::t('Password changed'));
                $this->r->redirect('user:login');
            } else {
                echo $this->render('user/recover_change_password.html', [
                    'form' => $form,
                    'model' => $model,
                    'key' => $key
                ]);
            }
        } else {
            echo $this->render('user/change_password_incorrect.html');
        }
    }
}
