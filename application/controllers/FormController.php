<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Christian
 * Date: 10.03.13
 * Time: 18:50
 * To change this template use File | Settings | File Templates.
 */
class FormController extends Zend_Controller_Action
{
    public function simpleAction()
    {
        $translate = new Zend_Translate('Zend_Translate_Adapter_Array', array(
            Zend_Validate_Alnum::NOT_ALNUM => 'Das Feld darf nur aus Buchstaben und Zahlen bestehen',
            Zend_Validate_NotEmpty::IS_EMPTY => 'Bitte fuellen Sie dieses Feld aus'
        ));

        Zend_Validate_Abstract::setDefaultTranslator($translate);

        // Not best practise putting this all here, just for demonstration purpose
        $form = new Zend_Form();
        $form->setMethod('post');

        // Adding an element with objects
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:');
        $username->setRequired(true);
        $username->addValidators(
            array(
                new Zend_Validate_Alnum(),
            )
        );
        $form->addElement($username);

        // Adding an element with config
        $form->addElement(
            'Text',
            'firstname',
            array(
                'label'      => 'First Name:',
                'required'   => true,
                'validators' => array('alnum')
            )
        );

        // Adding an element with config
        $form->addElement('Submit', 'submit', array());

        if ($form->isValid($_POST)) {

        }
        $this->view->assign('form', $form);
    }
}
