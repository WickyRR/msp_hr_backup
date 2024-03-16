<?php

namespace App\Http\Controllers;

use App\Models\MailAddress;
use App\Utilities\Workspace\RoundCube\RoundcubeAutoLogin;
use Illuminate\Http\Request;

class MailAddressController extends Controller {

    /**
     * Redirect to MSP Mail Service RoundCube interface with login
     * This route needs to be protected using middlewares to only allow certain roles to access
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function authenticateRoundCubeAndRedirect($mail_id) {
        $mail_address = MailAddress::find($mail_id);
        if($mail_address == null) abort(404);

        //Validate and Check whether the current person has relevant permissions to this endpoint
        //Implement

        //If all is valid,
        $email_username = $mail_address->email_username;
        $enc_password = $mail_address->enc_password;
        //Decrypt Password (Encryption should be AES)
        $dec_password = $enc_password;

        //Initiate Roundcube Autologin
        //roundcube_link should pass from .env file. Don't hardcode.
        $roundCubeAutoLogin = new RoundcubeAutoLogin('https://mailservice.moraspirit.com');
        $cookies = $roundCubeAutoLogin->login($email_username, $dec_password);

        $cookies_to_send = [];

        if(array_key_exists("roundcube_sessid", $cookies) and array_key_exists("roundcube_sessauth", $cookies)){
            foreach($cookies as $cookie_name => $cookie_value) {
                //setcookie($cookie_name, $cookie_value, 0, '/', 'mailservice.moraspirit.com', true, true);
                array_push($cookies_to_send, [
                    "hris_authentication_key_name" => $cookie_name,
                    "hris_authentication_key_value" => $cookie_value,
                ]);
            }

            $encoded_cookies_to_send = base64_encode(json_encode($cookies_to_send));
            $redirect_link = $roundCubeAutoLogin->redirect_link();
            $redirect_link .= '&hris_auth_token='.$encoded_cookies_to_send;

            return redirect($redirect_link);
        }else {
            abort(403);
        }



    }

}
