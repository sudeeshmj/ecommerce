<?php


if (!function_exists('uploadFile')) {

    function uploadFile($file, $folder)
    {
        try {
            $extension = $file->extension();
            $fileName = time() . '.' . $extension;
            $file->move(public_path($folder), $fileName);

            return $fileName;
        } catch (\Exception $e) {

            return false;
        }
    }
    if (!function_exists('renderOrderStatus')) {
        function renderOrderStatus($status)
        {
            return match ($status) {
                "Confirmed" => "badge badge-light-confirm",
                "Shipped" => "badge badge-light-warning",
                "Out For Delivery" => "badge badge-light-primary",
                "Delivered" => "badge badge-light-success",
                "Cancelled" => "badge badge-light-danger",
                "Return" => "badge badge-light-return",
                "Ready to Pickup" => "badge badge-light-info",
                "Refund" => "badge badge-light-refund",
                default => 'badge-default',
            };
        }
    }
}
