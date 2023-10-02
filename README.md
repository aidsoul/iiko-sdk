
# iiko-sdk
**For install:**
```
composer require aidsoul/iiko-sdk
```

**Calling the constructor to get started**

```
include "vendor/autoload.php";

use AidSoul\Iiko\Cloud\Cloud;
use AidSoul\Iiko\Card\Card;
use AidSoul\Iiko\ApiProvider;
use AidSoul\Iiko\CardApiProvider;
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => "https://api-ru.iiko.services",
    'verify' => false,
    'timeout'  => 30.0,
]);

$apiProviderCloud = new ApiProvider($client, 'API_KEY');
```
**Dictionary IIKO Cloud**
```
$getDiscountData = $iikoCloud->dictionary->discount->get();
$getOrderData = $iikoCloud->dictionary->order->get();
$getPaymentData = $iikoCloud->dictionary->payment->get();
$getRemovalData = $iikoCloud->dictionary->removal->get();
```
**Nomenclature**
```
$nomeclature = new AidSoul\Iiko\Cloud\Nomenclature\Nomenclature($client, '14324f43');
$nomeclature->getNomenclature();
$nomeclature->getGroups();
$nomeclature->getProductCategories();
$nomeclature->getProducts();
$nomeclature->getRevision();
$nomeclature->getSizes();
```
**Menu**
```
$menu = new AidSoul\Iiko\Cloud\Menu\Menu($apiProviderCloud);
$menu->getMenu();
$menu->getMenuById();
```
**Order**
```
$order = $iikoCloud->order;

# Create order
## Set order container
    $order->orderData->setCustomerInfo(['id' => 'Customer id from iiko']);
    $order->orderData->setCustomerInfo(['name' => 'Customer name']);

    $order->orderData->setPhone('+79996288989');
    $order->orderData->setDeliveryPoint([
        'street' => [
            'city' => City,
            'name' => Street name (Street must be filled in the Streets directory
        ],
        'house' => house,
        'building' => building,
        'floor' => floor,
        'entrance' => entrance
    ]);

    $order->orderData->setComment('comment');
    $order->orderData->setItems([
        [
            'productId' => product_id,
            'price' => price,
            'amount' => amount,
            'type' => 'Product'
        ]
    ]);

    $order->orderData->setOrderServiceType( 'DeliveryByCourier' OR 'DeliveryByClient' );
    $order->orderData->setTerminalGroupId($iikoCloud->terminalGroup->getFirstTerminalGroup());
    
    $order->orderData->setDiscount($fields['coupon']);

    $order->orderData->setPayments([
        [
            'paymentTypeKind' => 'Card',
            'sum' => sum,
            'paymentTypeId' => paymentTypeId (FROM payment dictionary),
            'isProcessedExternal' => false,
            'paymentAdditionalData' => [ //optional
                "credential" => '+79999999999',
                "searchScope" => "Phone"
            ]
        ],
        [
            'paymentTypeKind' => 'IikoCard',
            'sum' => sum,
            'paymentTypeId' => paymentTypeId (FROM payment dictionary),
            'isProcessedExternal' => false
        ],
        [
            'paymentTypeKind' => 'Cash',
            'sum' => sum,
            'paymentTypeId' => paymentTypeId (FROM payment dictionary),
            'isProcessedExternal' => false
        ]
    ]);

#Order actions
$order->check();
$order->create();

$order->calculate(); //If you use coupon
$order->searchOrder($id); //Use order_id to search for an order

```
**Customers**

# Login | Get customers info use phone number
```
$userData = $iikoCloud->authorization->login->login('phone_number');
```

# Registration
```
$userInfo = new CustomerForImport([
    'name' => 'Name',
    'phone' => 'Phone',
    'birthday' => 'YYYY-MM-DD',
]);
$userId = $iikoCard->registration->registration($userInfo);
```