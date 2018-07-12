<?php

namespace App\Services;


class CurrencyPresenter
{
    public static function present(Currency $currency):array
    {
        $currencyPresentation = [];
        $currencyPresentation['id'] = $currency->getId();
        $currencyPresentation['name'] = $currency->getName();
        $currencyPresentation['short_name'] = $currency->getShortName();
        $currencyPresentation['actual_course'] = $currency->getActualCourse();
        $currencyPresentation['actual_course_date'] = $currency->getActualCourseDate();
        $currencyPresentation['active'] = $currency->isActive();
        return $currencyPresentation;
    }

}