<?php
declare(strict_types=1);

namespace Echron\OrderComment\Model;

use Echron\OrderComment\Helper\Data;
use Magento\Checkout\Model\ConfigProviderInterface;

class CheckoutConfigProvider implements ConfigProviderInterface
{

    public function __construct(
        private Data $dataHelper,
    )
    {

    }

    public function getConfig(): array
    {
        $configArray = [];
        $configArray['orderComment'] = [
            'fieldLabel' => $this->dataHelper->getFieldLabel(),
            'lineCount' => $this->dataHelper->getLineCount(),
            'maxLength' => $this->dataHelper->getMaxLength(),
            'fieldPlaceholder' => $this->dataHelper->getFieldPlaceholder(),
        ];
        return $configArray;
    }
}
