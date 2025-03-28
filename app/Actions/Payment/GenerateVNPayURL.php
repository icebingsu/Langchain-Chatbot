<?php

namespace App\Actions\Payment;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateVNPayURL
{
    use AsAction;

    public function handle(array $data)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $vnp_TmnCode = env("VNPAY_TMN_CODE"); //Mã website tại VNPAY
        $vnp_HashSecret = env("VNPAY_HASH_SECRET"); //Chuỗi bí mật

        // === INPUT PARAMETERS
        // Return URL with transaction info after payment complete
        $vnp_Returnurl = "http://localhost:8000/payment/info";
        //Order ID
        $vnp_TxnRef = rand(1, 99999);
        $vnp_OrderInfo = "Thanh toán gói đăng ký";
        $vnp_Amount = $data["amount"] * 100;

        $vnp_OrderType = 190004; //Thẻ học trực tuyến/thẻ hội viên
        $vnp_Locale = "VN";

        // $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER["REMOTE_ADDR"];
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date("YmdHis"),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData["vnp_BankCode"] = $vnp_BankCode;
        }

        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData["vnp_Bill_State"] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= "&" . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . "&";
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac("sha512", $hashdata, $vnp_HashSecret); //
            $vnp_Url .= "vnp_SecureHash=" . $vnpSecureHash;
        }

        return $vnp_Url;
    }
}
