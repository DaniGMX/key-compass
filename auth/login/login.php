
<?php

require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/Html.php";
require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/styles/Configuration.php";
require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/styles/Modifier.php";
require $_SERVER['DOCUMENT_ROOT']."/PAPI/libs/web/styles/Style.php";

include "../../KeyCompassApp.php";

class Login {
    public const VIEW_ID = "Login";

    public static function display(string $loginTitle) {
        // initialize views and their styles
        $loginBodyElements = Login::initialize_body_elements();
        $loginStyles = Login::initialize_login_styles();

        return (new Html($loginTitle, $loginBodyElements, $loginStyles))->htmlStr;
    }

    private static function initialize_body_elements() {
        $body = new Element('body');
        return new ArrayOfElements([
            // TODO add the elements
            new Element('h1', 'Login'),
            (new Element('form', '', [
                "action" => "login.php",
                "method" => "post"
            ]))->appendChildren(new ArrayOfElements([
                    new Element('input', '', [
                        "type" => "text",
                        "name" => "email",
                        "placeholder" => "Enter your email here",
                    ]),
                    new Element('input', '', [
                        "type" => "password",
                        "name" => "password",
                        "placeholder" => "Enter your password here",
                    ]),
                ])
            )
        ]);
    }

    private static function initialize_login_styles() {
        $style = new Style();
        Configuration::addViewModifiers(Login::VIEW_ID, new ArrayOfModifiers([
                // TODO add the modifiers
                new Modifier('body', [
                    'font-family' => 'verdana',
                    'font-size' => '18px',
                    'margin' => '0',
                    'padding' => '0'
                ])
            ])
        );

        $style->addModifiers(Configuration::getViewModifiers(Login::VIEW_ID));
        return $style;
    }
}

echo Login::display(KeyCompassApp::APP_NAME."::".Login::VIEW_ID);

?>
