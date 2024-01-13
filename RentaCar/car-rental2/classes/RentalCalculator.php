

<?php

class RentalCalculator
{
    public static function calculateRentalCost($carPricePerMonth, $startDate, $endDate)
    {
        $pricePerDay = ($carPricePerMonth * 12) / 365;
        $rentalPeriod = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24); // Calculate days

        return $pricePerDay * $rentalPeriod;
    }
}

?>
    