<?php

namespace SilverShop\Discounts\Form;

use SilverStripe\Forms\RequiredFields;

class GiftVoucherFormValidator extends RequiredFields
{
    public function php($data)
    {
        $valid =  parent::php($data);
        if ($valid) {
            $controller = $this->form->Controller();
            if ($controller->VariableAmount) {
                $giftvalue = $data['UnitPrice'];
                if ($controller->MinimumAmount > 0 && $giftvalue < $controller->MinimumAmount) {
                    $this->validationError("UnitPrice", _t('GiftVoucherProduct.MinimumAmountError', 'Gift value must be at least {MinimumAmount}', ['MinimumAmount' => $controller->MinimumAmount]));
                    return false;
                }
                if ($giftvalue <= 0) {
                    $this->validationError("UnitPrice", "Gift value must be greater than 0");
                    return false;
                }
            }
        }
        return $valid;
    }
}