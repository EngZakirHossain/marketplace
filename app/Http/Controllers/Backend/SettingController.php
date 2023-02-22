<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helpers;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SocialUpdateRequest;
use App\Http\Requests\MailSettingUpdateRequest;
use App\Http\Requests\GeneralSettingUpdateRequest;
use App\Http\Requests\SocialMediaSettingUpdateRequest;

class SettingController extends Controller
{
    public function general(){
        Gate::authorize('general-setting');
        return view('admin.pages.settings.general');
    }
    public function generalUpdate(GeneralSettingUpdateRequest $request){

        Gate::authorize('general-setting-update');
        Setting::updateOrCreate(
            ['key' => 'site_title'],
            ['value' => $request->site_title,]
        );
        Setting::updateOrCreate(
            ['key' => 'site_address'],
            ['value' => $request->site_address,]
        );
        Setting::updateOrCreate(
           [ 'key' => 'site_email'],
            ['value' => $request->site_email],
        );
        Setting::updateOrCreate(
            ['key' => 'site_phone'],
            ['value' => $request->site_phone],
        );
        Setting::updateOrCreate(
            ['key' => 'site_description'],
            ['value' => $request->site_description],
        );
        //company logo
        if($request->hasFile('site_logo')){
            if(setting('site_logo') !=null){
                Helpers::delete('uploads/company/'.setting('site_logo'));
            }
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => Helpers::upload('uploads/company/','png', $request->file('site_logo'))]
            );
        }
        //company favicon
        if($request->hasFile('site_favicon')){
            if(setting('site_favicon') !=null){
                Helpers::delete('uploads/company/'.setting('site_favicon'));
            }
            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => Helpers::upload('uploads/company/','png', $request->file('site_favicon'))]
            );
        }


        Toastr::success('Genarel Setting Update Successfully', 'Success',);
        return back();

    }

//social Media
    public function socialMedia(){
        Gate::authorize('social-media-setting');
        return view('admin.pages.settings.socialMedia');
    }
    public function socialMediaUpdate(SocialMediaSettingUpdateRequest $request){
        Gate::authorize('social-media-setting-update');
        Setting::updateOrCreate(
            ['key' => 'site_facebook_link'],
            ['value' => $request->site_facebook_link],
        );
        Setting::updateOrCreate(
            ['key' => 'site_twitter_link'],
            ['value' => $request->site_twitter_link],
        );
        Setting::updateOrCreate(
            ['key' => 'site_instragram_link'],
            ['value' => $request->site_instragram_link],
        );
        Setting::updateOrCreate(
            ['key' => 'site_behance_link'],
            ['value' => $request->site_behance_link],
        );
        Setting::updateOrCreate(
            ['key' => 'site_dribbble_link'],
            ['value' => $request->site_dribbble_link],
        );

        Toastr::success('Social Media Update Successfully', 'Success',);
        return back();

    }

    public function mailView()
    {
        Gate::authorize('mail-setting');
        return view('admin.pages.settings.mail');
    }

    public function mailUpdate(MailSettingUpdateRequest $request)
    {
        Gate::authorize('mail-setting-update');
        Setting::updateOrCreate(
            ['key' => 'mail_mailer'],
            ['value' => $request->mail_mailer],
        );
        Setting::updateOrCreate(
            ['key' => 'mail_host'],
            ['value' => $request->mail_host],
        );
        Setting::updateOrCreate(
            ['key' => 'mail_port'],
            ['value' => $request->mail_port],
        );
        Setting::updateOrCreate(
            ['key' => 'mail_username'],
            ['value' => $request->mail_username],
        );
        Setting::updateOrCreate(
            ['key' => 'mail_password'],
            ['value' => $request->mail_password],
        );
        Setting::updateOrCreate(
            ['key' => 'mail_encryption'],
            ['value' => $request->mail_encryption],
        );
        Setting::updateOrCreate(
            ['key' => 'mail_from_address'],
            ['value' => $request->mail_from_address],
        );


        // update ENV file
        $this->setEnvValue('MAIL_MAILER', $request->mail_mailer);
        $this->setEnvValue('MAIL_HOST', $request->mail_host);
        $this->setEnvValue('MAIL_PORT', $request->mail_port);
        $this->setEnvValue('MAIL_USERNAME', $request->mail_username);
        $this->setEnvValue('MAIL_PASSWORD', $request->mail_password);
        $this->setEnvValue('MAIL_ENCRYPTION', $request->mail_encryption);
        $this->setEnvValue('MAIL_FROM_ADDRESS', $request->mail_from_address);

        Toastr::success('Setting Updated Successfully!!!','success');
        return back();
    }

    /**
 * @param string $key
 * @param string $value
 */
    protected function setEnvValue(string $key, string $value)
    {
        $path = app()->environmentFilePath();
        $env = file_get_contents($path);

        $old_value = env($key);

        if (!str_contains($env, $key.'=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s',$key, $value), $env);
        }

        file_put_contents($path, $env);
    }

    public function socialiteView(){
        Gate::authorize('socialite-setting');
        return view('admin.pages.settings.3rdparty.socialite');
    }
    public function socialiteUpdate(SocialUpdateRequest $request){
        Gate::authorize('socialite-setting-update');
        Setting::updateOrCreate(
            ['key' => 'google_client_id'],
            ['value' => $request->google_client_id],
        );
        Setting::updateOrCreate(
            ['key' => 'google_client_screct'],
            ['value' => $request->google_client_screct],
        );
        Setting::updateOrCreate(
            ['key' => 'google_client_redirect'],
            ['value' => $request->google_client_redirect],
        );
        Setting::updateOrCreate(
            ['key' => 'github_client_id'],
            ['value' => $request->github_client_id],
        );
        Setting::updateOrCreate(
            ['key' => 'github_client_screct'],
            ['value' => $request->github_client_screct],
        );
        Setting::updateOrCreate(
            ['key' => 'github_client_redirect'],
            ['value' => $request->github_client_redirect],
        );
         // update ENV file
        $this->setEnvValue('GITHUB_CLIENT_ID', $request->github_client_id);
        $this->setEnvValue('GITHUB_CLIENT_SECRET', $request->github_client_screct);
        $this->setEnvValue('GITHUB_CLIENT_REDIRECT', $request->github_client_redirect);
        $this->setEnvValue('GOOGLE_CLIENT_ID', $request->google_client_id);
        $this->setEnvValue('GOOGLE_CLIENT_SECRET', $request->google_client_screct);
        $this->setEnvValue('GOOGLE_CLIENT_REDIRECT', $request->google_client_redirect);

        Toastr::success('Setting Updated Successfully!!!','success');
        return back();
    }

        public function payment_index()
    {
        return view('admin.pages.settings.3rdparty.payment');
    }

    public function payment_update(Request $request, $name)
    {

        if ($name == 'cash_on_delivery') {
            $payment = Setting::where('key', 'cash_on_delivery')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'cash_on_delivery',
                    'value'      => json_encode([
                        'status' => $request['status'],
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'cash_on_delivery'])->update([
                    'key'        => 'cash_on_delivery',
                    'value'      => json_encode([
                        'status' => $request['status'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'digital_payment') {
            $payment = Setting::where('key', 'digital_payment')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'digital_payment',
                    'value'      => json_encode([
                        'status' => $request['status'],
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'digital_payment'])->update([
                    'key'        => 'digital_payment',
                    'value'      => json_encode([
                        'status' => $request['status'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'ssl_commerz_payment') {
            $payment = Setting::where('key', 'ssl_commerz_payment')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'ssl_commerz_payment',
                    'value'      => json_encode([
                        'status'         => 1,
                        'store_id'       => '',
                        'store_password' => '',
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'ssl_commerz_payment'])->update([
                    'key'        => 'ssl_commerz_payment',
                    'value'      => json_encode([
                        'status'         => $request['status'],
                        'store_id'       => $request['store_id'],
                        'store_password' => $request['store_password'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'razor_pay') {
            $payment = Setting::where('key', 'razor_pay')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'razor_pay',
                    'value'      => json_encode([
                        'status'       => 1,
                        'razor_key'    => '',
                        'razor_secret' => '',
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'razor_pay'])->update([
                    'key'        => 'razor_pay',
                    'value'      => json_encode([
                        'status'       => $request['status'],
                        'razor_key'    => $request['razor_key'],
                        'razor_secret' => $request['razor_secret'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'paypal') {
            $payment = Setting::where('key', 'paypal')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'paypal',
                    'value'      => json_encode([
                        'status'           => 1,
                        'paypal_client_id' => '',
                        'paypal_secret'    => '',
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'paypal'])->update([
                    'key'        => 'paypal',
                    'value'      => json_encode([
                        'status'           => $request['status'],
                        'paypal_client_id' => $request['paypal_client_id'],
                        'paypal_secret'    => $request['paypal_secret'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'stripe') {
            $payment = Setting::where('key', 'stripe')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'stripe',
                    'value'      => json_encode([
                        'status'        => 1,
                        'api_key'       => '',
                        'published_key' => '',
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'stripe'])->update([
                    'key'        => 'stripe',
                    'value'      => json_encode([
                        'status'        => $request['status'],
                        'api_key'       => $request['api_key'],
                        'published_key' => $request['published_key'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'senang_pay') {
            $payment = Setting::where('key', 'senang_pay')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key'        => 'senang_pay',
                    'value'      => json_encode([
                        'status'      => 1,
                        'secret_key'  => '',
                        'merchant_id' => '',
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('settings')->where(['key' => 'senang_pay'])->update([
                    'key'        => 'senang_pay',
                    'value'      => json_encode([
                        'status'      => $request['status'],
                        'secret_key'  => $request['secret_key'],
                        'merchant_id' => $request['merchant_id'],
                    ]),
                    'updated_at' => now(),
                ]);
            }
        }elseif ($name == 'paystack') {
            $payment = Setting::where('key', 'paystack')->first();
            if (isset($payment) == false) {
                DB::table('settings')->insert([
                    'key' => 'paystack',
                    'value' => json_encode([
                        'status' => 1,
                        'publicKey' => '',
                        'secretKey' => '',
                        'paymentUrl' => '',
                        'merchantEmail' => '',
                    ]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                DB::table('settings')->where(['key' => 'paystack'])->update([
                    'key' => 'paystack',
                    'value' => json_encode([
                        'status' => $request['status'],
                        'publicKey' => $request['publicKey'],
                        'secretKey' => $request['secretKey'],
                        'paymentUrl' => $request['paymentUrl'],
                        'merchantEmail' => $request['merchantEmail'],
                    ]),
                    'updated_at' => now()
                ]);
            }
        } else if ($name == 'bkash') {
            DB::table('settings')->updateOrInsert(['key' => 'bkash'], [
                'value' => json_encode([
                    'status' => $request['status'],
                    'api_key' => $request['api_key'],
                    'api_secret' => $request['api_secret'],
                    'username' => $request['username'],
                    'password' => $request['password'],
                ])
            ]);
        } else if ($name == 'paymob') {
            DB::table('settings')->updateOrInsert(['key' => 'paymob'], [
                'value' => json_encode([
                    'status' => $request['status'],
                    'api_key' => $request['api_key'],
                    'iframe_id' => $request['iframe_id'],
                    'integration_id' => $request['integration_id'],
                    'hmac' => $request['hmac']
                ])
            ]);
        } else if ($name == 'flutterwave') {
            DB::table('settings')->updateOrInsert(['key' => 'flutterwave'], [
                'value' => json_encode([
                    'status' => $request['status'],
                    'public_key' => $request['public_key'],
                    'secret_key' => $request['secret_key'],
                    'hash' => $request['hash']
                ])
            ]);
        } else if ($name == 'mercadopago') {
            DB::table('settings')->updateOrInsert(['key' => 'mercadopago'], [
                'value' => json_encode([
                    'status' => $request['status'],
                    'public_key' => $request['public_key'],
                    'access_token' => $request['access_token']
                ])
            ]);
        }
        Toastr::success('payment settings updated!');
        return back();
    }
}
