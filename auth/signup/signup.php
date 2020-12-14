<?php

require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/Html.php";
require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/styles/Configuration.php";
require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/styles/Modifier.php";
require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/styles/Style.php";

include "../../KeyCompassApp.php";
include "../../db/KeyCompassDB.php";
include "SignupViewModel.php";
include "../../di/Injector.php";

class SignUp {
    public const VIEW_ID = "Sign Up";

    private static $viewmodel;

    public static function display(string $signupTitle) {
        // initialize ViewModel
        SignUp::$viewmodel = Injector
    ::getViewModel(SignUp::VIEW_ID);

        // check if we need to sign up
        SignUp::checkForm();

        // initialize views and their styles
        $signupBodyElements = SignUp::initializeBodyElements();
        $signupStyles = SignUp::initializeSignUpStyles();

        return (new Html($signupTitle, $signupBodyElements, $signupStyles))->htmlStr;
    }

    private static function checkForm() {
        $formSent = !empty($_POST['user_name']) && !empty($_POST['email']) && !empty($_POST['password']);
        if ($formSent) {
            SignUp::$viewmodel->onFormSent($_POST['user_name'], $_POST['email'], $_POST['password']);
        }
    }

    private static function initializeBodyElements() {
        $body = new Element('body');
        return new ArrayOfElements([
            new Element('h1', 'Sign Up'),
            (new Element('form', '', [
                "action" => "signup.php",
                "method" => "post"
            ]))->appendChildren(new ArrayOfElements([
                    new Element('input', '', [
                        "type" => "text",
                        "name" => "user_name",
                        "placeholder" => "Enter your user name",
                    ]),
                    new Element('input', '', [
                        "type" => "text",
                        "name" => "email",
                        "placeholder" => "Enter your email",
                    ]),
                    new Element('input', '', [
                        "type" => "password",
                        "name" => "password",
                        "placeholder" => "Enter your password",
                    ]),
                    new Element('input', '', [
                        "type" => "password",
                        "name" => "confirm_password",
                        "placeholder" => "Confirm your password",
                    ]),
                    new Element('input', '', [
                        "type" => "submit",
                        "name" => "submit",
                        "value" => "Submit!",
                    ]),
                ])
            )
        ]);
    }

    private static function initializeSignUpStyles() {
        $style = new Style();
        Configuration::addViewModifiers(SignUp::VIEW_ID, new ArrayOfModifiers([
                new Modifier('body', [
                    'font-family' => 'verdana',
                    'font-size' => '18px',
                    'text-align' => 'center',
                    'margin' => '25px',
                    'padding' => '0'
                ]),
                new Modifier('input[type="text"], input[type="password"]', [
                    'outline' => 'none',
                    'padding' => '20px',
                    'display' => 'block',
                    'width' => '300px',
                    'border-radius' => '3px',
                    'border' => '1px solid #eee',
                    'margin' => '20px auto',
                ]),
                new Modifier('input[type="submit"]', [
                    'padding' => '10px',
                    'color' => '#fff',
                    'background' => '#0098cb',
                    'width' => '320px',
                    'margin' => '20px auto',
                    'margin-top' => '0',
                    'border' => '0',
                    'border-radius' => '3px',
                    'cursor' => 'pointer',
                ]),
                new Modifier('input[type="submit"]:hover', [
                    'background-color' => '#00b8eb',
                ]),
            ])
        );

        $style->addModifiers(Configuration::getViewModifiers(SignUp::VIEW_ID));
        return $style;
    }
}

echo SignUp::display(KeyCompassApp::APP_NAME." :: ".SignUp::VIEW_ID);

?>