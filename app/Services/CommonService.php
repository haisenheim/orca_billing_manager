<?php

namespace App\Services;

class CommonService
{
    public function sendOneSignalNotifications($contentMsg, $oneSignalId)
    {
        try {
            $content = array(
                "en" => $contentMsg
            );

            $fields = array(
                'app_id' => config('custom.onesignal_app_id'),
                'include_external_user_ids' => array($oneSignalId),
                'channel_for_external_user_ids' => 'push',
                'data' => array("foo" => "bar"),
                'contents' => $content
            );

            $fields =  json_encode($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic '.config('custom.onesignal_rest_api_key').'\''));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        } catch (\Exception $e) {
            report($e);
            return 'Could not generated';
        }
    }
}
