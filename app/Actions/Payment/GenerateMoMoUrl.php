<?php

namespace App\Actions\Payment;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateMoMoUrl
{
    use AsAction;

    public function handle(array $data)
    {
        $endpoint =
            "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = env("MOMO_PARTNER_CODE");
        $accessKey = env("MOMO_ACCESS_KEY");
        $secretKey = env("MOMO_SECRET_KEY");

        // === INPUT PARAMETERS
        // return url
        $returnUrl = route("payment.info");
        $orderId = time() . "";
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "199000";

        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";

        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";

        // echo $serectkey;die;
        $rawHash =
            "partnerCode=" .
            $partnerCode .
            "&accessKey=" .
            $accessKey .
            "&requestId=" .
            $requestId .
            "&bankCode=" .
            $bankCode .
            "&amount=" .
            $amount .
            "&orderId=" .
            $orderId .
            "&orderInfo=" .
            $orderInfo .
            "&returnUrl=" .
            $returnUrl .
            // "&notifyUrl=" .
            // $notifyurl .
            "&extraData=" .
            $extraData .
            "&requestType=" .
            $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            "partnerCode" => $partnerCode,
            "accessKey" => $accessKey,
            "requestId" => $requestId,
            "amount" => $amount,
            "orderId" => $orderId,
            "orderInfo" => $orderInfo,
            "returnUrl" => $returnUrl,
            "bankCode" => $bankCode,
            // "notifyUrl" => $notifyurl,
            "extraData" => $extraData,
            "requestType" => $requestType,
            "signature" => $signature,
        ];
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true); // decode json

        return $jsonResult["payUrl"];
    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($data),
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
