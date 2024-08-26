<?php
declare(strict_types=1);

namespace Echron\OrderComment\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class CheckoutConfigProvider implements ConfigProviderInterface
{

    private \Echron\OrderComment\Helper\Data $dataHelper;

    public function __construct(
        \Echron\OrderComment\Helper\Data $dataHelper,
    )
    {
        $this->dataHelper = $dataHelper;
    }

    public function getConfig()
    {
        $configArray = [];
        $configArray['orderComment'] = [
            'fieldLabel' => $this->dataHelper->getFieldLabel(),
            'lineCount' => $this->dataHelper->getLineCount(),
            'maxLength' => $this->dataHelper->getMaxLength(),
            'placeholder' => $this->dataHelper->getFieldPlaceholder(),
        ];
        return $configArray;
    }
}
