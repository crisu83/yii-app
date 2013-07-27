<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * Performs ajax validation on the given model.
     * @param CModel $model the model to validate.
     * @param string $formId the form id.
     */
    public function performAjaxValidation($model, $formId)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $formId) {
            if (!is_array($model)) {
                $model = array($model);
            }
            foreach ($model as $m) {
                echo CActiveForm::validate($m);
            }
            app()->end();
        }
    }

    /**
     * Triggers a 404 (Page Not Found) error.
     * @throws CHttpException when invoked.
     */
    public function pageNotFound()
    {
        throw new CHttpException(404, t('error', 'Page not found.'));
    }

    /**
     * Triggers a 403 (Access Denied) error.
     * @throws CHttpException when invoked.
     */
    public function accessDenied()
    {
        throw new CHttpException(403, t('error', 'Access denied.'));
    }

    /**
     * Triggers a 400 (Bad Request) error.
     * @throws CHttpException when invoked.
     */
    public function badRequest()
    {
        throw new CHttpException(400, t('error', 'Invalid request.'));
    }
}