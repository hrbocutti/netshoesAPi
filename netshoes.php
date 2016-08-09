<?php

use ApiMktpNetshoesV1\client\ApiException;
use ApiMktpNetshoesV1\client\Configuration;

#API
use ApiMktpNetshoesV1\client\ApiClient;
use ApiMktpNetshoesV1\model\CustomerResource;
use ApiMktpNetshoesV1\model\OrderItemResource;
use ApiMktpNetshoesV1\model\OrderResource;
use ApiMktpNetshoesV1\model\ShippingResource;
use ApiMktpNetshoesV1\model\TransportResource;
use ApiMktpNetshoesV1\ProductsTemplatesApi;
use ApiMktpNetshoesV1\ProductsApi;
use ApiMktpNetshoesV1\SkusApi;
use ApiMktpNetshoesV1\OrdersApi;

#Recursos
use ApiMktpNetshoesV1\Model\ProductResource;
use ApiMktpNetshoesV1\Model\SkuResource;
use ApiMktpNetshoesV1\Model\ImageResource;
use ApiMktpNetshoesV1\Model\PriceResource;
use ApiMktpNetshoesV1\Model\StockResource;

require_once 'ApiMktpNetshoesV1.php';

class Netshoes
{

    public function criarProduto($listProdutos)
    {

        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

        $product_resource = new ProductResource();
        $product_resource->product_id = $listProdutos['sku'];
        $product_resource->department = $listProdutos['categoriaPai'];
        $product_resource->product_type = $listProdutos['categoriaFinal'];
        $product_resource->brand = $listProdutos['marca'];

        $product_resource->skus = $this->retrieveArrayProducts($listProdutos);

        $products_api = new ProductsApi($api_client);
        try {
            $product_response = $products_api->saveProduct($product_resource);
            var_dump($product_response);

        } catch (ApiException $e) {
            $error_resource = deserializeError($e->getResponseBody(), $api_client);
            if ($error_resource == null) {
                var_dump($e);
            } else {
                var_dump($error_resource);
            }
        }

    }

    public function retrieveArrayProducts($listProdutos)
    {

        $skus = array();

        //Sku1
        $sku_resource = new SkuResource();
        $sku_resource->sku = $listProdutos['sku'];
        $sku_resource->name = $listProdutos['nome'];
        $sku_resource->description = $listProdutos['descricao'];
        $sku_resource->color = $listProdutos['cor'];
        $sku_resource->gender = $listProdutos['gender'];
        $sku_resource->size = $listProdutos['tamanho'];
        $sku_resource->ean_isbn = $listProdutos['ean'];

        $image_resource = new ImageResource();
        $image_resource->url = $listProdutos['imgUrl'];
        $sku_resource->images = array(
            $image_resource
        );

        $sku_resource->height = $listProdutos['altura'];
        $sku_resource->width = $listProdutos['largura'];
        $sku_resource->depth = $listProdutos['profundidade'];
        $sku_resource->weight = $listProdutos['peso'];

        $listDeProduto1 = array(
            'sku' => 'Z4377BRH',
            'categoriaPai' => 'Tennis e Squash',
            'categoriaFinal' => 'Garrafas',
            'marca' => 'Wilson',
            'nome' => 'Garrafa Wilson 500ML Azul - Wilson',
            'descricao' => 'A Garrafa Wilson 500 ml Natural é a forma mais prática para armazenar água, isotônico ou sucos.',
            'cor' => 'Vermelho',
            'gender' => 'Unissex',
            'tamanho' => 'P',
            'ean' => '7897135800895',
            'imgUrl' => 'http://www.polihouse.com.br/media/extendware/ewimageopt/media/inline/28/8/garrafa-wilson-500ml-amarelo-wilson-53e.jpg',
            'altura' => '15',
            'largura' => '15',
            'profundidade' => '15',
            'peso' => '100');

        //Sku2
        $sku_resource1 = new SkuResource();
        $sku_resource1->sku = $listDeProduto1['sku'];
        $sku_resource1->name = $listDeProduto1['nome'];
        $sku_resource1->description = $listDeProduto1['descricao'];
        $sku_resource1->color = $listDeProduto1['cor'];
        $sku_resource1->gender = $listDeProduto1['gender'];
        $sku_resource1->size = $listDeProduto1['tamanho'];
        $sku_resource1->ean_isbn = $listDeProduto1['ean'];

        $image_resource1 = new ImageResource();
        $image_resource1->url = $listProdutos['imgUrl'];
        $sku_resource1->images = array(
            $image_resource
        );

        $sku_resource1->height = $listProdutos['altura'];
        $sku_resource1->width = $listProdutos['largura'];
        $sku_resource1->depth = $listProdutos['profundidade'];
        $sku_resource1->weight = $listProdutos['peso'];

        $listDeProduto2 = array(
            'sku' => 'Z4377BRG',
            'categoriaPai' => 'Tennis e Squash',
            'categoriaFinal' => 'Garrafas',
            'marca' => 'Wilson',
            'nome' => 'Garrafa Wilson 500ML Azul - Wilson',
            'descricao' => 'A Garrafa Wilson 500 ml Natural é a forma mais prática para armazenar água, isotônico ou sucos.',
            'cor' => 'Branco',
            'gender' => 'Unissex',
            'tamanho' => 'M',
            'ean' => '7897135800895',
            'imgUrl' => 'http://www.polihouse.com.br/media/extendware/ewimageopt/media/inline/28/8/garrafa-wilson-500ml-amarelo-wilson-53e.jpg',
            'altura' => '15',
            'largura' => '15',
            'profundidade' => '15',
            'peso' => '100');

        //Sku3
        $sku_resource2 = new SkuResource();
        $sku_resource2->sku = $listDeProduto2['sku'];
        $sku_resource2->name = $listDeProduto2['nome'];
        $sku_resource2->description = $listDeProduto2['descricao'];
        $sku_resource2->color = $listDeProduto2['cor'];
        $sku_resource2->gender = $listDeProduto2['gender'];
        $sku_resource2->size = $listDeProduto2['tamanho'];
        $sku_resource2->ean_isbn = $listDeProduto2['ean'];

        $image_resource1 = new ImageResource();
        $image_resource1->url = $listDeProduto2['imgUrl'];
        $sku_resource2->images = array(
            $image_resource
        );

        $sku_resource2->height = $listDeProduto2['altura'];
        $sku_resource2->width = $listDeProduto2['largura'];
        $sku_resource2->depth = $listDeProduto2['profundidade'];
        $sku_resource2->weight = $listDeProduto2['peso'];

        $listDeProduto3 = array(
            'sku' => 'Z4377BRF',
            'categoriaPai' => 'Tennis e Squash',
            'categoriaFinal' => 'Garrafas',
            'marca' => 'Wilson',
            'nome' => 'Garrafa Wilson 500ML Azul - Wilson',
            'descricao' => 'A Garrafa Wilson 500 ml Natural é a forma mais prática para armazenar água, isotônico ou sucos.',
            'cor' => 'Amarelo',
            'gender' => 'Unissex',
            'tamanho' => 'M',
            'ean' => '7897135800895',
            'imgUrl' => 'http://www.polihouse.com.br/media/extendware/ewimageopt/media/inline/28/8/garrafa-wilson-500ml-amarelo-wilson-53e.jpg',
            'altura' => '15',
            'largura' => '15',
            'profundidade' => '15',
            'peso' => '100');

        //Sku4
        $sku_resource3 = new SkuResource();
        $sku_resource3->sku = $listDeProduto3['sku'];
        $sku_resource3->name = $listDeProduto3['nome'];
        $sku_resource3->description = $listDeProduto3['descricao'];
        $sku_resource3->color = $listDeProduto3['cor'];
        $sku_resource3->gender = $listDeProduto3['gender'];
        $sku_resource3->size = $listDeProduto3['tamanho'];
        $sku_resource3->ean_isbn = $listDeProduto3['ean'];

        $image_resource1 = new ImageResource();
        $image_resource1->url = $listProdutos['imgUrl'];
        $sku_resource3->images = array(
            $image_resource
        );

        $sku_resource3->height = $listDeProduto3['altura'];
        $sku_resource3->width = $listDeProduto3['largura'];
        $sku_resource3->depth = $listDeProduto3['profundidade'];
        $sku_resource3->weight = $listDeProduto3['peso'];

        array_push($skus, $sku_resource, $sku_resource1, $sku_resource2, $sku_resource3);

        return $skus;
    }

    public function atualizaPreco($sku, $preco)
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

        $skus_api = new SkusApi($api_client);

        $price_resource = new PriceResource();
        $price_resource->price = $preco;

        try {
            $price_response = $skus_api->updatePrice($sku, $price_resource);
            var_dump($price_response);
        } catch (ApiException $e) {
            echo($e->getMessage());
        }
    }

    public function saveOrder()
    {

        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $ordersApi = new OrdersApi($api_client);

        $orderResource = $this->retrieveOrderResourceArray();

        try {
            $response = $ordersApi->saveOrder($orderResource);
            var_dump($response);
        } catch (ApiException $e) {
            var_dump($e);
        }

    }

    private function retrieveOrderResourceArray()
    {
        $orderResource = new OrderResource();

        $orderResource->agreed_date = "2016-08-08T12:12:02.106Z";
        //$orderResource->business_unit = "UN";
        $orderResource->devolution_requested = false;
        $orderResource->exchange_requested = false;
        $orderResource->order_date = "2016-08-08T12:12:02.106Z";
        //$orderResource->number = "0";
        //$orderResource->status = "0";
        $orderResource->order_type = "Venda";
        //$orderResource->origin_number = "0";
        $orderResource->origin_site = "NETSHOES";
        $orderResource->payment_data = "2016-08-08T12:12:02.106Z";
        $orderResource->shippings = $this->retrieveShippingResource();
        //$orderResource->total_commission = "0";
        //$orderResource->total_discount = "0";
        $orderResource->total_freight = "1";
        $orderResource->total_gross = "2";
        $orderResource->total_net = "1";
        $orderResource->total_quantity = 1;

        return $orderResource;
    }

    private function retrieveShippingResource()
    {

        $shippings = array();

        $shippingResource = new ShippingResource();
        //$shippingResource->cancellation_reason = "0";
        $shippingResource->country = "BR";
        //$shippingResource->customer = $this->retrieveCustomerResource();
        //$shippingResource->transport = $this->retrieveTransportResource();
        $shippingResource->items = $this->retrieveOrderItemResource();
        //$shippingResource->status = "0";
        //$shippingResource->shipping_code = 1;

        array_push($shippings, $shippingResource);
        return $shippings;
    }

    private function retrieveOrderItemResource()
    {
        $itens = array();

        $orderItemResource = new OrderItemResource();
        //$orderItemResource->brand = 'Wilson';
        $orderItemResource->color = 'Vermelho';
        //$orderItemResource->department_code = '1';
        //$orderItemResource->department_name = 'Teste';
        //$orderItemResource->discount_unit_value = '1';
        $orderItemResource->ean = '7897135800895';
        //$orderItemResource->flavor = '1';
        //$orderItemResource->gross_unit_value = '1';
        //$orderItemResource->item_id = '01';
        //$orderItemResource->manufacturer_code = '1';
        $orderItemResource->name = 'Garrafa Wilson 500ML Azul - Wilson';
        $orderItemResource->quantity = '1';
        $orderItemResource->size = 'p';
        $orderItemResource->sku = 'Z4377BRH';

        $orderItemResource1 = new OrderItemResource();
        //$orderItemResource->brand = 'Wilson';
        $orderItemResource1->color = 'Amarelo';
        //$orderItemResource->department_code = '1';
        //$orderItemResource->department_name = 'Teste';
        //$orderItemResource->discount_unit_value = '1';
        $orderItemResource1->ean = '7897135800895';
        //$orderItemResource->flavor = '1';
        //$orderItemResource->gross_unit_value = '1';
        //$orderItemResource->item_id = '01';
        //$orderItemResource->manufacturer_code = '1';
        $orderItemResource1->name = 'Garrafa Wilson 500ML Azul - Wilson';
        $orderItemResource->quantity = '1';
        $orderItemResource1->size = 'M';
        $orderItemResource1->sku = 'Z4377BRF';

        array_push($itens, $orderItemResource, $orderItemResource1);
        return $itens;
    }

    public function getColors()
    {

        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $productsTemplateApi = new ProductsTemplatesApi($api_client);

        try {
            $colors = $productsTemplateApi->listColors();
            var_dump($colors);
        } catch (ApiException $e) {
            var_dump($e);
        }

    }

    public function getBrands()
    {

        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $productsTemplateApi = new ProductsTemplatesApi($api_client);

        try {
            $colors = $productsTemplateApi->listBrands();
            var_dump($colors);
        } catch (ApiException $e) {
            var_dump($e);
        }

    }

    public function getFlavors()
    {

        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $productsTemplateApi = new ProductsTemplatesApi($api_client);

        try {
            $colors = $productsTemplateApi->listFlavors();
            var_dump($colors);
        } catch (ApiException $e) {
            var_dump($e);
        }

    }

    public function getSizes()
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $productsTemplateApi = new ProductsTemplatesApi($api_client);

        try {
            $colors = $productsTemplateApi->listSizes();
            var_dump($colors);
        } catch (ApiException $e) {
            var_dump($e);
        }
    }

    public function getPriceBySku($sku)
    {

        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $api = new SkusApi($api_client);

        try {

            $result = $api->listPrices($sku);
            var_dump($result);

        } catch (ApiException $e) {
            var_dump($e);
        }

    }

    private function retrieveCustomerResource()
    {

        $customerResource = new CustomerResource();
        $customerResource->cell_phone = "19999999999";
        $customerResource->customer_name = "String";
        $customerResource->document = "String";
        $customerResource->landline = "1";
        $customerResource->recipient_name = "1";
        $customerResource->state_inscription = "1";
        $customerResource->trade_name = "1";

        return $customerResource;
    }

    private function retrieveTransportResource()
    {

        $transportResource = new TransportResource();

        $transportResource->carrier = "String";
        $transportResource->delivery_date = "String";
        $transportResource->delivery_service = "String";
        $transportResource->ship_date = "2016-08-08";
        $transportResource->tracking_link = "String";
        $transportResource->tracking_number = "1";
        $transportResource->tracking_ship_date = "2016-08-08";

        return $transportResource;
    }

    public function updateStock($sku, $qnt)
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

        $skus_api = new SkusApi($api_client);

        $stock_resource = new StockResource();
        $stock_resource->available = $qnt;
        $stock_resource->country = 'BR';
        var_dump($stock_resource);

        try {
            $stock_response = $skus_api->updateStock($sku, $stock_resource);
            var_dump($stock_response);
        } catch (ApiException $e) {
            echo($e->getMessage());
        }
    }

    public function getOrders()
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $orders_api = new OrdersApi($api_client);

        try {
            // Lista as ordens de D-1
            $order_list_resource = $orders_api->listOrders(0, 20, 'shippings', null, null,
                'Created', 'Venda');

            var_dump($order_list_resource);

        } catch (ApiException $e) {
            $error_resource = deserializeError($e->getResponseBody(), $api_client);
            if ($error_resource == null) {
                var_dump($e);
            } else {
                var_dump($error_resource);
            }
        }
    }

    public function getStockProduct($sku)
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $api = new SkusApi($api_client);

        try {
            $result = $api->getStock($sku);
            var_dump($result);

        } catch (ApiException $e) {
            var_dump($e);
        }
    }

    public function listarProdutos($page, $size, $expand)
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $products_api = new ProductsApi($api_client);
        try {

            $product_response = $products_api->listProducts($page, $size, $expand);
            //var_dump($product_response->items);

            foreach ($product_response->items as $key) {
                foreach ($key as $key => $value) {
                    print_r($value) . "<br>";
                }
            }
        } catch (ApiException $e) {
            $error_resource = deserializeError($e->getResponseBody(), $api_client);
            if ($error_resource == null) {
                var_dump($e);
            } else {
                var_dump($error_resource);
            }
        }
    }

    public function listarDepartamentos()
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
        $products_templates_api = new ProductsTemplatesApi($api_client);

        try {

            $department_list_resource = $products_templates_api->listDepartments("NS");
            var_dump($department_list_resource);

        } catch (ApiException $e) {
            echo($e->getMessage());
        }
    }

    public function patchProduct($listProdutos, $sku)
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

        $product_resource = new ProductResource();
        $product_resource->product_id = $listProdutos['sku'];
        $product_resource->department = "Teste";
        $product_resource->product_type = $listProdutos['categoriaFinal'];
        $product_resource->brand = $listProdutos['marca'];

        $product_resource->skus = array();

        $sku_resource = new SkuResource();
        $sku_resource->sku = $listProdutos['sku'];
        $sku_resource->name = $listProdutos['nome'];
        $sku_resource->description = $listProdutos['descricao'];
        $sku_resource->color = $listProdutos['cor'];
        $sku_resource->gender = $listProdutos['gender'];
        $sku_resource->size = $listProdutos['tamanho'];
        $sku_resource->ean_isbn = $listProdutos['ean'];

        $image_resource = new ImageResource();
        $image_resource->url = $listProdutos['imgUrl'];
        $sku_resource->images = array(
            $image_resource
        );

        $sku_resource->height = $listProdutos['altura'];
        $sku_resource->width = $listProdutos['largura'];
        $sku_resource->depth = $listProdutos['profundidade'];
        $sku_resource->weight = $listProdutos['peso'];

        array_push($product_resource->skus, $sku_resource);


        $products_api = new ProductsApi($api_client);
        try {
            $product_response = $products_api->patchProduct($sku, $product_resource);
            var_dump($product_response);

        } catch (ApiException $e) {
            $error_resource = deserializeError($e->getResponseBody(), $api_client);
            if ($error_resource == null) {
                var_dump($e);
            } else {
                var_dump($error_resource);
            }
        }
    }

    public function updateProduct($listProdutos, $sku)
    {
        Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
        Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

        $api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

        $product_resource = new ProductResource();
        $product_resource->product_id = $listProdutos['sku'];
        $product_resource->department = $listProdutos['categoriaPai'];
        $product_resource->product_type = $listProdutos['categoriaFinal'];
        $product_resource->brand = $listProdutos['marca'];

        $product_resource->skus = array();

        $sku_resource = new SkuResource();
        $sku_resource->sku = $listProdutos['sku'];
        $sku_resource->name = $listProdutos['nome'];
        $sku_resource->description = $listProdutos['descricao'];
        $sku_resource->color = $listProdutos['cor'];
        $sku_resource->gender = $listProdutos['gender'];
        $sku_resource->size = $listProdutos['tamanho'];
        $sku_resource->ean_isbn = $listProdutos['ean'];

        $image_resource = new ImageResource();
        $image_resource->url = $listProdutos['imgUrl'];
        $sku_resource->images = array(
            $image_resource
        );

        $sku_resource->height = $listProdutos['altura'];
        $sku_resource->width = $listProdutos['largura'];
        $sku_resource->depth = $listProdutos['profundidade'];
        $sku_resource->weight = $listProdutos['peso'];

        array_push($product_resource->skus, $sku_resource);

        $products_api = new ProductsApi($api_client);
        try {
            $product_response = $products_api->updateProduct($sku, $product_resource);
            var_dump($product_response);

        } catch (ApiException $e) {
            $error_resource = deserializeError($e->getResponseBody(), $api_client);
            if ($error_resource == null) {
                var_dump($e);
            } else {
                var_dump($error_resource);
            }
        }
    }
}

$netshoes = new Netshoes();
$listaDeProduto = array(
    'sku' => 'Z4377BRE',
    'categoriaPai' => 'Tennis e Squash',
    'categoriaFinal' => 'Garrafas',
    'marca' => 'Wilson',
    'nome' => 'Garrafa Wilson 500ML Azul - Wilson - Teste',
    'descricao' => 'A Garrafa Wilson 500 ml Natural é a forma mais prática para armazenar água, isotônico ou sucos.',
    'cor' => 'Azul',
    'gender' => 'Unissex',
    'tamanho' => 'G',
    'ean' => '7897135800895',
    'imgUrl' => 'http://www.polihouse.com.br/media/extendware/ewimageopt/media/inline/28/8/garrafa-wilson-500ml-amarelo-wilson-53e.jpg',
    'altura' => '15',
    'largura' => '15',
    'profundidade' => '15',
    'peso' => '100');
$sku = 'Z4377BRE';

//$netshoes->getSizes(); //Ok
//$netshoes->getFlavors(); //Ok
//$netshoes->getBrands(); //Ok
//$netshoes->getColors(); //Ok
$netshoes->getPriceBySku('Z4377BRH'); //Ok
//$netshoes->getStockProduct('Z4377BRH'); // Ok
//$netshoes->saveOrder(); // incompleto
//$netshoes->getOrders(); // Ok
//$netshoes->patchProduct($listaDeProduto , $sku); //Ok
//$netshoes->updateProduct($listaDeProduto , $sku); // Ok --
//$netshoes->updateStock('Z4377BRH', '11170'); //Ok
//$netshoes->atualizaPreco('Z4377BRH','690.00'); //Ok
//$netshoes->listarDepartamentos(); //Ok
//$netshoes->listarProdutos(0,100,'items'); // Ok
//$netshoes->criarProduto($listaDeProduto); // Ok --
