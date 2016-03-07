<?php

namespace Modules\User\Controllers;

use Mindy\Base\Mindy;
use Modules\Core\Controllers\FrontendController;
use Modules\User\Forms\LoginForm;
use Modules\User\UserModule;

/**
 * Class AuthController
 * @package Modules\User
 */
class AuthController extends FrontendController
{
    public function allowedActions()
    {
        return ['login', 'logout'];
    }

    public function actionLogin()
    {
        $app = Mindy::app();
        if (!$app->user->isGuest) {
            $this->r->redirect('user:profile');
        }

        $this->addBreadcrumb(UserModule::t("Login"));

        $form = new LoginForm();
        if ($this->r->isPost && $form->populate($_POST)->isValid() && $form->login()) {
            $this->redirectNext();

            if ($this->r->isAjax) {
                echo $this->json([
                    'status' => 'success',
                    'title' => UserModule::t('You have successfully logged in to the site')
                ]);
            } else {
                $this->r->redirect('user:profile');
            }
        }

        echo $this->render('user/login.html', [
            'form' => $form
        ]);
    }

    /**
     * Logout the current user and redirect to returnLogoutUrl.
     */
    public function actionLogout()
    {
        $auth = Mindy::app()->auth;
        if ($auth->isGuest) {
            $this->redirectNext();
            $this->r->redirect(Mindy::app()->homeUrl);
        }

        $auth->logout($this->getModule()->destroySessionAfterLogout);
        $this->r->redirect('user:login');
    }
}
