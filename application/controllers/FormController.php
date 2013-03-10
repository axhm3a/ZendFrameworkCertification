<?php

class FormController extends Zend_Controller_Action
{
    public function simpleAction()
    {
        Zend_Layout::startMvc();

        // Override validation message templates
        $translate = new Zend_Translate('Zend_Translate_Adapter_Array', array(
            Zend_Validate_Alnum::NOT_ALNUM   => 'Das Feld darf nur aus Buchstaben und Zahlen bestehen',
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

        // Add custom Validator
        $username->addPrefixPath('Cert_Validate', 'Cert/Validate/', 'validate');
        $username->addValidator('test'); // Loads Cert_Validate_Test
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

        // Adding a subform
        $subForm = new Zend_Form_SubForm();
        $subForm->setLegend('Subform');
        $subForm->addElement(
            'Text',
            'lastName',
            array(
                'label'      => 'LastName Name:',
                'required'   => true,
                'validators' => array(
                    array('alnum')
                )
            )
        );
        $form->addSubForm($subForm, 'subformName');

        // Adding an element with config
        $form->addElement('Submit', 'submit', array());


        if ($this->getRequest()->isPost()) {
            if (!$form->isValid($_POST)) {
                $this->view->allFormErrors = $form->getMessages();
            }
        }
        $this->view->assign('form', $form);
    }
}
