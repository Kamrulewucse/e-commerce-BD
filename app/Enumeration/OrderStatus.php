<?php
namespace App\Enumeration;

class OrderStatus {
    public static int $PROCESSING = 1;
    public static int $SHIPPED = 2;
    public static int $DELIVERED = 3;
    public static int $RETURNED = 4;
    public static int $CANCELLED = 5;
    public static int $FAILED = 6;

    public static int $PENDING = 0;
    public static int $INIT = 1;
    public static int $APPROVED = 3;
    public static int $ON_SHIPPING =4;
    public static int $RETURNED_INIT = 9;
}
