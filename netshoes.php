<?php

use ApiMktpNetshoesV1\client\Configuration;

#API
use ApiMktpNetshoesV1\client\ApiClient;
use ApiMktpNetshoesV1\ProductsTemplatesApi;
use ApiMktpNetshoesV1\ProductsApi;
use ApiMktpNetshoesV1\SkusApi;
use ApiMktpNetshoesV1\OrdersApi;

#Recursos
use ApiMktpNetshoesV1\Model\ProductResource;
use ApiMktpNetshoesV1\Model\AttributeResource;
use ApiMktpNetshoesV1\Model\SkuResource;
use ApiMktpNetshoesV1\Model\ImageResource;
use ApiMktpNetshoesV1\Model\PriceResource;
use ApiMktpNetshoesV1\Model\StockResource;

require_once 'ApiMktpNetshoesV1.php';
/**
*
*/
class Netshoes
{

	public function criarProduto()
	{

		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');

		$product_resource = new ProductResource();
		$product_resource->product_id = '987456';
		$product_resource->department = 'Futebol';
		$product_resource->product_type = 'Agasalhos';
		$product_resource->brand = 'Adidas';

		$attribute_resource = new AttributeResource();
		$attribute_resource->name = 'SEXO';
		$attribute_resource->value = 'F';

		$product_resource->attributes = array(
			$attribute_resource
			);

		$product_resource->skus = array();

		$sku_resource = new SkuResource();
		$sku_resource->sku = '7891437342374';
		$sku_resource->name = 'Agasalho Teste 01 Adidas';
		$sku_resource->description = 'Agasalho, Branco, Adidas';
		$sku_resource->color = 'Branco';
		$sku_resource->gender = 'Mulher';
		$sku_resource->size = 'G';
		$sku_resource->ean_isbn = '16598198';

		$image_resource = new ImageResource();
		$image_resource->url = 'http://7-themes.com/data_images/out/42/6914793-tropical-beach-images.jpg';
		$sku_resource->images = array (
			$image_resource
			);

		$sku_resource->video = 'http://video/video1';
		$sku_resource->height = 20.0;
		$sku_resource->width = 10.0;
		$sku_resource->depth = 44.0;
		$sku_resource->weight = 65.0;

		array_push($product_resource->skus, $sku_resource);


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
			echo ($e->getMessage());
		}
	}

	public function atualizaEstoque($sku, $qnt)
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
			echo ($e->getMessage());
		}
	}

	public function recebeOrders()
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
		$orders_api = new OrdersApi($api_client);

		try {
		// Lista as ordens de D-1
			$order_list_resource = $orders_api->listOrders(0, 20, null,
				(new \DateTime('NOW'))->sub(new \DateInterval('P1D')), new \DateTime('NOW'),
				'Faturado', 'Venda');

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
	public function listarProdutos($page, $size, $expand)
	{
		Configuration::$apiKey['client_id'] = 'ubvaJ5F1OEgW';
		Configuration::$apiKey['access_token'] = 'DgMNBXzayO1O';

		$api_client = new ApiClient('http://api-sandbox.netshoes.com.br/api/v1');
		$products_api = new ProductsApi($api_client);
		try {

			$product_response = $products_api->listProducts($page, $size, $expand);
			var_dump($product_response->getName('skus'));

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
//$netshoes->criarProduto();
//$netshoes->atualizaPreco('7891437342374','407.00');
//$netshoes->atualizaEstoque('7891437342374', '30');
//$netshoes->recebeOrders();
$netshoes->listarProdutos(0,20,0);